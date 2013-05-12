/**
 * @file	FeedXParser.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	20/09/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of RSS X Parser
 */

#include <cstring>
#include <utility>
#include <stack>
#include <boost/algorithm/string/predicate.hpp>
#include <boost/algorithm/string/case_conv.hpp>
#include "nfrd/FeedXParser.h"
#include "nfrd/RSSParser.h"
#include "nfrd/AtomParser.h"
#include "nfrd/Utility.h"
using namespace std;
using namespace htmlcxx;
using namespace nfrd::parser;
using namespace nfrd::misc;

/// The tags that will not be changed.
/// @see void FeedXParser::BuildStaticMember()
static const char* ALLOWED_TAGS[] = {
	"b",	"i",	"p",	"a",	"strong",	"u",	"br",
	"strike",	"s",	"q",	"ul",	"li",	"pre"
};
/// The tags that will not be changed.
std::set<std::string> FeedXParser::allowed_tags(ALLOWED_TAGS, ALLOWED_TAGS +
						sizeof(ALLOWED_TAGS) /
						sizeof(const char*));

/// The tage that only text part is kept.
/// @see void FeedXParser::BuildStaticMember()
static const char* TRIMMED_TAGS[] = {
	"html",	"body",	"div",	"h1",	"h2",	"h3",	"h4",	"h5",	"h6",
	"small",	"font",	"center",	"table",	"tr",	"td",
	"img",	"span",	"",	// "" is used for none container
};
/// The tage that only text part is kept.
std::set<std::string> FeedXParser::trimmed_tags(TRIMMED_TAGS, TRIMMED_TAGS +
						sizeof(TRIMMED_TAGS) /
						sizeof(const char*));

/// The right paragraph shoud be SIZE_MODIFIER times larger than the
/// abstract article in the rss item when processing patch and match algorithm.
/// @see void FeedXParser::PatchAndMatch(RSSItem& item)
static const string::size_type SIZE_MODIFIER = 3;

// Default Constructor
FeedXParser::FeedXParser() : parser(0)
{
}

// Delete all dynamic memory, if any
FeedXParser::~FeedXParser()
{
	if (parser != 0)
		delete parser;
}

// Read rss feed from a specified url and parse it with  Patch and Match feature
void FeedXParser::ReadURL(const string& source)
{
	// Clean up
	if (parser != 0)
	{
		delete parser;
		parser = 0;
	}

	// Read from url
	vector<char> container;
	if (!Utility::Read(source, container))
		throw InvalidSource(string("FeedXParser: Cannot connect \"")
				    .append(source).append("\""));
	if (container.size() == 0)
		throw InvalidSource(string("FeedXParser: \"").append(source)
				    .append("\" contains nothing"));
	container.push_back(0);
	
	// Start parsing header of feed
	rapidxml::xml_document<> doc;
	try
	{
		doc.parse<0>(&container[0]);
	}
	catch (const exception&)
	{
		throw InvalidSource(string("FeedXParser: Invalid XML file \"")
				    .append(source).append("\""));
	}
	
	// Detect feed type
	if (doc.first_node("rss") != 0)
		parser = new RSSParser();
	else if (doc.first_node("feed") != 0)
		parser = new AtomParser();
	else
		throw InvalidSource(string("FeedXParser: \"").append(source)
				    .append("\" is not a valid feed"));

	// Get original feeds
	parser->ReadDom(doc);
	
	// Patch and Match
	for (list<Item*>::const_iterator i = parser->GetItemList().begin();
	     i != parser->GetItemList().end(); ++i)
		if (((FeedItem*)*i)->HasFullContent())
			RefineFeed((FeedItem*)*i);
		else
		{
			try // Try patch and match
			{
				PatchAndMatch((FeedItem*)*i);
			}
			catch (const exception&) {}
			if (!((FeedItem*)*i)->HasFullContent())
				RefineFeed((FeedItem*)*i);
		}
}

// Get the last build date of the feed resource.
const DateTime& FeedXParser::GetLastBuildDate() const
{
	if (parser == 0)
		throw HasNoValue("FeedXParser: Nothing parsed");
	else
		return parser->GetLastBuildDate();
}

// Get the item list of parsed feed.
const std::list<Item*>& FeedXParser::GetItemList() const
{
	if (parser == 0)
		throw HasNoValue("FeedXParser: Nothing parsed");
	else
		return parser->GetItemList();
}

// Patch an rss item using Patch and Match (Match and Patch) algorithm
void FeedXParser::PatchAndMatch(FeedItem* item)
{
	// Check
	if (item == 0 || !item->HasURL() || !item->HasContent())
		return;

	// Extract content from original link
	HTML::ParserDom parser;
	vector<char> container;
	if (!Utility::Read(item->GetURL().c_str(), container))
		return;
	container.push_back(0);
	const tree<HTML::Node>& dom = parser.parseTree(&container[0]);

	// Match
	string match_string = Utility::Trim(GetLongestText(item->GetContent()));
	if (match_string.size() > 3 &&
	    match_string.compare(match_string.size() - 3, 3, "...") == 0)
		match_string.erase(match_string.size() - 3);
	if (match_string.size() == 0)
		return;
	tree<HTML::Node>::iterator it, end = dom.end();
	for (it = dom.begin(); it != end; ++it)
		if (!it->isTag() && !it->isComment() &&
		    it->text().find(match_string) != string::npos)
			break;
	if (it == end)	// No match found
	{	// Cut off the match_string and try again
		it = AdvancedMatchLine(dom, match_string);
		if (it == end)	// No match found
		{	// Divide the match_string and try again
			it = AdvancedMatchDivide(dom, match_string);
			if (it == end)	// Still no match found --> Give up
				return;
		}
	}
	
	// Try to engage more text (likelihood the right paragraph)
	string::size_type content_size = match_string.size();
	content_size *= SIZE_MODIFIER;
	do 
	{
		it = dom.parent(it);
	} while (it != end && TextSize(it) < content_size);
	if (it == end)	// No match found
		return;
		
	// Re-construct html source code
	string content;
	Construct(it, content);
	
	// Trim all empty a or div tags, since img tags are gone.
	content = TrimEmptyTag(content);
	
	// Patch
	// Modify item
	item->SetContent(content.c_str());
	item->SetFullContent(true);
	
	// Dig out images
	ExtractImages(item, it);
	
	// Extract geographical location
	ExtractGeoLocation(item, it);
}

// Construct html source code from a html tree using all child nodes of a root
// node.
void FeedXParser::Construct(const IteratorPair& iterator_pair,
			    string& content)
{
	stack<IteratorPair> parent_nodes;
	bool is_allowed_tag;
	
	parent_nodes.push(iterator_pair);
	while (!parent_nodes.empty())
	{
		tree<HTML::Node>::iterator& it = parent_nodes.top().it;
		tree<HTML::Node>::iterator& end = parent_nodes.top().end;
		for (; it != end; it.skip_children(), ++it)
		{
			if (it->isComment())
				continue;
			else if (it->isTag())
			{
				if (allowed_tags.count(boost::to_lower_copy
						       (it->tagName())))
				{
					if (boost::iequals(it->tagName(), "a"))
					{
						it->parseAttributes();
						pair<bool, string> attr =
							it->attribute("href");
						if (!attr.first) // not found
							continue;
						content.append("<a href=\"")
						       .append(attr.second)
						       .append("\">");
					}
					else
						content.append("<")
						       .append(it->tagName())
						       .append(">");
					parent_nodes.push(IteratorPair(it,
								       true));
					break;
				}
				else if (trimmed_tags.count(boost::to_lower_copy
							    (it->tagName())))
				{
					parent_nodes.push(IteratorPair(it));
					break;
				}
			}
			else
				content.append(it->text());
		}
		if (it != end)
			continue;
		is_allowed_tag = parent_nodes.top().is_allowed_tag;
		parent_nodes.pop();
		
		// Return to parent node
		if (!parent_nodes.empty())
		{
			tree<HTML::Node>::iterator& it = parent_nodes.top().it;
			if (is_allowed_tag)
				content.append(it->closingText());
			it.skip_children();
			++it;
		}
	}
}

// Get the total text size of a html tree, counting all child nodes of a root
// node.
string::size_type FeedXParser::TextSize(const tree<HTML::Node>::iterator&
				       iterator)
{
	string::size_type size = 0;
	tree<HTML::Node>::iterator end = iterator.end();
	
	for (tree<HTML::Node>::iterator it = iterator.begin(); it != end; ++it)
	{
		if (it->isTag())
		{
			if (!(allowed_tags.count(boost::to_lower_copy
						 (it->tagName())) ||
			      trimmed_tags.count(boost::to_lower_copy
						 (it->tagName()))))
				it.skip_children();
		}
		else if (!it->isComment())
			size += it->text().size();
	}
	
	return size;
}

// Get the longest text from a html source code
std::string FeedXParser::GetLongestText(const std::string& source)
{
	HTML::ParserDom parser;
	const tree<HTML::Node>& dom = parser.parseTree(source);
	string::size_type max_size = 0;
	const string* longest_text = 0;
	tree<HTML::Node>::iterator end = dom.end();
	for (tree<HTML::Node>::iterator it = dom.begin(); it != end; ++it)
		if ((!it->isTag()) && (!it->isComment()) &&
		    it->text().size() > max_size)
		{
			longest_text = &it->text();
			max_size = longest_text->size();
		}
	return ((longest_text == 0) ? "" : *longest_text);
}

// Trim all empty a or div tags in the source.
std::string FeedXParser::TrimEmptyTag(const std::string& source)
{
	HTML::ParserDom parser;
	const tree<HTML::Node>& dom = parser.parseTree(source);
	string content;
	stack<IteratorPair> parent_nodes;
	
	parent_nodes.push(IteratorPair(dom));
	while (!parent_nodes.empty())
	{
		tree<HTML::Node>::iterator& it = parent_nodes.top().it;
		tree<HTML::Node>::iterator& end = parent_nodes.top().end;
		for (; it != end; it.skip_children(), ++it)
		{
			if (it->isComment())
				continue;
			else if (it->isTag())
			{
				if (!(boost::iequals(it->tagName(), "a") ||
				      boost::iequals(it->tagName(), "div")) ||
				    TextSize(it) != 0)
				{
					content.append(it->text());
					parent_nodes.push(IteratorPair(it));
					break;
				}
			}
			else
				content.append(it->text());
		}
		if (it != end)
			continue;
		parent_nodes.pop();
		
		// Return to parent node
		if (!parent_nodes.empty())
		{
			tree<HTML::Node>::iterator& it = parent_nodes.top().it;
			content.append(it->closingText());
			it.skip_children();
			++it;
		}
	}
	
	return content;
}

// Dig out images from the given tree and add to the item.
void FeedXParser::ExtractImages(FeedItem* item,
				const IteratorPair& iterator_pair)
{
	tree<HTML::Node>::iterator  end = iterator_pair.end;
	for (tree<HTML::Node>::iterator it = iterator_pair.it; it != end; ++it)
		if (it->isTag() && it->tagName() == "img")
		{
			it->parseAttributes();
			pair<bool, string> attr = it->attribute("src");
			if (attr.first)
			{
				// src found
				if (strncmp(attr.second.c_str(), "http://", 7)
				    == 0 ||
				    strncmp(attr.second.c_str(), "https://", 8)
				    == 0)
					item->AddImage(attr.second);
				else
					item->AddImage(item->GetURL().substr(0,
						item->GetURL().find_last_of('/')
						) + attr.second);
			}
		}
}

// Extract geographical location from the given tree and add to the item.
void FeedXParser::ExtractGeoLocation(FeedItem* item,
				     const IteratorPair& iterator_pair)
{
	tree<HTML::Node>::iterator  end = iterator_pair.end;
	for (tree<HTML::Node>::iterator it = iterator_pair.it; it != end; ++it)
		if (it->isTag() && it->tagName() == "a")
		{
			it->parseAttributes();
			pair<bool, string> attr = it->attribute("href");
			if (!attr.first)
				continue;
			
			// src found
			string& url = attr.second;
			size_t start = url.find("maps.google.com");
			if (start == string::npos)
				continue;
			start = url.find("?", start + 1);
			if (start == string::npos)
				continue;
			string attribute, value;
			size_t end_p = url.find("=", ++start);
			while (end_p != string::npos)
			{
				attribute = url.substr(start, end_p - start);
				start = end_p + 1;
				end_p = url.find("&amp;", start);
				if (end_p == string::npos)
					value = url.substr(start);
				else
				{
					value = url.substr(start,end_p - start);
					start = end_p + 5;
					end_p = url.find("=", start);
				}
				if (attribute == "q")
				{
					item->SetGeoLocation(value);
					return;
				}
			}
		}
}

// Refine a feed by stripping tags and extracting images.
void FeedXParser::RefineFeed(FeedItem* item)
{
	if (item == 0 || !item->HasContent())
		return;

	HTML::ParserDom parser;
	const tree<HTML::Node>& dom = parser.parseTree(item->GetContent());
	
	// Re-construct html source code, stripping tags
	string content;
	Construct(dom, content);
	
	// Trim all empty a or div tags, since img tags are gone.
	content = TrimEmptyTag(content);

	// Modify item
	item->SetContent(content.c_str());
	
	// Dig out images
	ExtractImages(item, dom);
	
	// Extract geographical location
	ExtractGeoLocation(item, dom);
}

// Find the matched content block in a dom tree
// This method will modified match_string to the longest line in match_string
tree<htmlcxx::HTML::Node>::iterator
FeedXParser::AdvancedMatchLine(const tree<htmlcxx::HTML::Node>& dom,
			       std::string& match_string)
{
	size_t pos = match_string.find('\n');
	if (pos == string::npos)
		return dom.end();
	string longest_string;
	while (pos != string::npos)
	{
		if (pos > longest_string.size())
			longest_string = Utility::Trim(match_string
						       .substr(0, pos));
		match_string = Utility::Trim(match_string.substr(pos + 1));
		pos = match_string.find('\n');
	}
	match_string = longest_string;
	if (match_string.size() == 0)
		return dom.end();
	tree<HTML::Node>::iterator it, end = dom.end();
	for (it = dom.begin(); it != end; ++it)
		if (!it->isTag() && !it->isComment() &&
		    it->text().find(match_string) != string::npos)
			return it;
	return end;
}

// Find the matched content block in a dom tree
// This method will modified match_string to the mid part of match_string
tree<htmlcxx::HTML::Node>::iterator
FeedXParser::AdvancedMatchDivide(const tree<htmlcxx::HTML::Node>& dom,
				 std::string& match_string)
{
	size_t size = match_string.size() / (SIZE_MODIFIER - 1);
	match_string =
		match_string.substr((match_string.size() - size) / 2, size);
	if (match_string.size() == 0)
		return dom.end();
	tree<HTML::Node>::iterator it, end = dom.end();
	for (it = dom.begin(); it != end; ++it)
		if (!it->isTag() && !it->isComment() &&
		    it->text().find(match_string) != string::npos)
			return it;
	return end;
}

// Initialising Constructor for IteratorPair using a iterator of a node.
FeedXParser::IteratorPair::IteratorPair(const tree<HTML::Node>::iterator&
				       iterator,
				       bool is_allowed_tag) :
	it(iterator.begin()), end(iterator.end()),
	is_allowed_tag(is_allowed_tag)
{
}

// Initialising Constructor for IteratorPair using a node.
FeedXParser::IteratorPair::IteratorPair(const tree<HTML::Node>& node,
				       bool is_allowed_tag) :
	it(node.begin()), end(node.end()), is_allowed_tag(is_allowed_tag)
{
}
