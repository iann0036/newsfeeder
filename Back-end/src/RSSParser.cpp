/**
 * @file	RSSParser.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	22/08/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of RSS Parser
 */

#include <cstring>
#include "nfrd/RSSParser.h"
#include "nfrd/Utility.h"
using namespace std;
using namespace nfrd::parser;
using namespace nfrd::misc;

// Default Constructor
RSSItem::RSSItem() :
	title(0), url(0), content(0), postDate(0), author(0)
{
}

// Delete all dynamic memory, if any
RSSItem::~RSSItem()
{
	if (title != 0)
		delete title;
	if (url	!= 0)
		delete url;
	if (content != 0)
		delete content;
	if (postDate != 0)
		delete postDate;
	if (author != 0)
		delete author;
}

// Getter Sector
const string& RSSItem::GetTitle() const
{
	if (title == 0)
		throw HasNoValue("RSSItem: Title does not exist");
	else
		return *title;
}

const string& RSSItem::GetURL() const
{
	if (url == 0)
		throw HasNoValue("RSSItem: URL does not exist");
	else
		return *url;
}

const string& RSSItem::GetContent() const
{
	if (content == 0)
		throw HasNoValue("RSSItem: Content does not exist");
	else
		return *content;
}

const DateTime& RSSItem::GetPostDate() const
{
	if (postDate == 0)
		throw HasNoValue("RSSItem: Post date does not exist");
	else
		return *postDate;
}

const string& RSSItem::GetAuthor() const
{
	if (author == 0)
		throw HasNoValue("RSSItem: Author does not exist");
	else
		return *author;
}

// Setter Sector
void RSSItem::SetTitle(const char* source)
{
	if (source == 0)
	{
		if (title != 0)
		{
			delete title;
			title = 0;
		}
	}
	else if (title == 0)
		title = new string(source);
	else
		*title = source;
}

void RSSItem::SetURL(const char* source)
{
	if (source == 0)
	{
		if (url != 0)
		{
			delete url;
			url = 0;
		}
	}
	else if (url == 0)
		url = new string(source);
	else
		*url = source;
}

void RSSItem::SetContent(const char* source)
{
	if (source == 0)
	{
		if (content != 0)
		{
			delete content;
			content = 0;
		}
	}
	else if (content == 0)
		content = new string(source);
	else
		*content = source;
}

void RSSItem::SetContent(const string& source)
{
	SetContent(source.c_str());
}

void RSSItem::SetPostDate(const DateTime* source)
{
	if (source == 0)
	{
		if (postDate != 0)
		{
			delete postDate;
			postDate = 0;
		}
	}
	if (postDate == 0)
		postDate = new DateTime(*source);
	else
		*postDate = *source;
}

void RSSItem::SetAuthor(const char* source)
{
	if (source == 0)
	{
		if (author != 0)
		{
			delete author;
			author = 0;
		}
	}
	if (author == 0)
		author = new string(source);
	else
		*author = source;
}

// Check Sector
bool RSSItem::HasTitle() const
{
	return title != 0;
}

bool RSSItem::HasURL() const
{
	return url != 0;
}

bool RSSItem::HasContent() const
{
	return content != 0;
}

bool RSSItem::HasPostDate() const
{
	return postDate != 0;
}

bool RSSItem::HasAuthor() const
{
	return author != 0;
}

// Default Constructor
RSSParser::RSSParser() : lastBuildDate(0)
{
}

// Delete all dynamic memory, if any
RSSParser::~RSSParser()
{
	if (lastBuildDate != 0)
		delete lastBuildDate;
	for (list<Item*>::iterator i = item.begin(); i != item.end(); ++i)
		delete (RSSItem*)*i;
}

// Parse rss feed from a dom tree
void RSSParser::ReadDom(const rapidxml::xml_document<>& doc)
{
	// Clean up
	for (list<Item*>::iterator i = item.begin(); i != item.end(); ++i)
		delete (RSSItem*)*i;
	if (lastBuildDate != 0)
		delete lastBuildDate;
	lastBuildDate = 0;
	
	// Start parsing header of rss
	rapidxml::xml_node<>* cur_node;
	rapidxml::xml_node<>* cur_item;
	rapidxml::xml_attribute<>* cur_attr;
	
	if ((cur_node = doc.first_node("rss")) == 0)
		throw InvalidSource(string("RSSParser: \"").append((url == 0) ?
								   "" : *url)
				    .append("\" is not a RSS feed"));
	if ((cur_node = cur_node->first_node("channel")) == 0)
		return;	// Nothing in this RSS feed
	cur_item = cur_node->first_node("item");
	cur_node = cur_node->first_node("lastBuildDate");
	if (cur_node != 0)
	{
		if (lastBuildDate == 0)
			lastBuildDate = new DateTime();
		try
		{
			lastBuildDate->ParseFromRFC822(cur_node->value());
		}
		catch (const exception&)
		{
			delete lastBuildDate;
			lastBuildDate = 0;
		}
	}
	
	// parsing items
	RSSItem* new_item;
	
	while (cur_item != 0)
	{
		new_item = new RSSItem();
		try
		{
			if ((cur_node = cur_item->first_node("title")) != 0)
				new_item->SetTitle(GetValue(cur_node));
			if ((cur_node = cur_item->first_node("link")) != 0)
				new_item->SetURL(GetValue(cur_node));
			if ((cur_node = cur_item->first_node("content:encoded"))
			    != 0)
			{
				new_item->SetContent(GetValue(cur_node));
				new_item->SetFullContent(true);
			}
			else if ((cur_node = cur_item->first_node("description")
				  ) != 0)
				new_item->SetContent(GetValue(cur_node));
			if ((cur_node = cur_item->first_node("pubDate")) != 0)
			{
				try
				{
					DateTime dateTime;
					dateTime.ParseFromRFC822(
						cur_node->value());
					new_item->SetPostDate(&dateTime);
				}
				catch (const exception&) {}
			}
			if ((cur_node = cur_item->first_node("dc:creator"))
			    != 0)
				new_item->SetAuthor(GetValue(cur_node));
			else if ((cur_node = cur_item->first_node("author"))
				 != 0)
				new_item->SetAuthor(GetValue(cur_node));
			if ((cur_node = cur_item->first_node("media:content"))
			    != 0 &&
			    (cur_attr = cur_node->first_attribute("medium"))
			    != 0 &&
			    strcmp(cur_attr->value(), "image") == 0 &&
			    (cur_attr = cur_node->first_attribute("url")) != 0)
				new_item->AddImage(cur_attr->value());
			cur_item = cur_item->next_sibling("item");
			
			// Put the new item in the list
			item.push_back(new_item);
		}
		catch (const exception&)
		{
			delete new_item;
		}
	}
	
	// Try to recover last build date
	if (lastBuildDate != 0)
		return;
	for (list<Item*>::iterator i = item.begin(); i != item.end(); ++i)
		if ((*i)->HasPostDate())
		{
			if (lastBuildDate == 0)
			{
				lastBuildDate = new DateTime();
				*lastBuildDate = (*i)->GetPostDate();
			}
			else if (*lastBuildDate < (*i)->GetPostDate())
				*lastBuildDate = (*i)->GetPostDate();
		}
		else
		{
			if (lastBuildDate != 0)
			{
				delete lastBuildDate;
				lastBuildDate = 0;
			}
			break;
		}
}

// Getter Sector
const DateTime& RSSParser::GetLastBuildDate() const
{
	if (lastBuildDate == 0)
		throw HasNoValue("RSSParser: Last build date does not exist");
	else
		return *lastBuildDate;
}

// Get the text value from a node.
const char* RSSParser::GetValue(rapidxml::xml_node<>* node)
{
	if (node->value()[0] == 0)
	{	// Try to find CDATA part
		if ((node = node->first_node()) == 0)
			return 0;
		else if (node->next_sibling() == 0)
			return node->value();
		else
		{
			buffer.clear();
			do
			{
				buffer.append(node->value());
			} while ((node = node->next_sibling()) != 0);
			return buffer.c_str();
		}
	}
	else
		return node->value();
}
