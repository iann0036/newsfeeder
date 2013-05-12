/**
 * @file	AtomParser.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	09/08/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of Atom Parser
 */

#include <cstring>
#include "nfrd/AtomParser.h"
#include "nfrd/Utility.h"
using namespace std;
using namespace nfrd::parser;
using namespace nfrd::misc;

// Default Constructor
AtomItem::AtomItem() :
	title(0), url(0), content(0), postDate(0), author(0)
{
}

// Delete all dynamic memory, if any
AtomItem::~AtomItem()
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
const string& AtomItem::GetTitle() const
{
	if (title == 0)
		throw HasNoValue("AtomItem: Title does not exist");
	else
		return *title;
}

const string& AtomItem::GetURL() const
{
	if (url == 0)
		throw HasNoValue("AtomItem: URL does not exist");
	else
		return *url;
}

const string& AtomItem::GetContent() const
{
	if (content == 0)
		throw HasNoValue("AtomItem: Content does not exist");
	else
		return *content;
}

const DateTime& AtomItem::GetPostDate() const
{
	if (postDate == 0)
		throw HasNoValue("AtomItem: Post date does not exist");
	else
		return *postDate;
}

const string& AtomItem::GetAuthor() const
{
	if (author == 0)
		throw HasNoValue("AtomItem: Author does not exist");
	else
		return *author;
}

// Setter Sector
void AtomItem::SetTitle(const char* source)
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

void AtomItem::SetURL(const char* source)
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

void AtomItem::SetContent(const char* source)
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

void AtomItem::SetContent(const string& source)
{
	SetContent(source.c_str());
}

void AtomItem::SetPostDate(const DateTime* source)
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

void AtomItem::SetAuthor(const char* source)
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
bool AtomItem::HasTitle() const
{
	return title != 0;
}

bool AtomItem::HasURL() const
{
	return url != 0;
}

bool AtomItem::HasContent() const
{
	return content != 0;
}

bool AtomItem::HasPostDate() const
{
	return postDate != 0;
}

bool AtomItem::HasAuthor() const
{
	return author != 0;
}

// Default Constructor
AtomParser::AtomParser() : lastBuildDate(0)
{
}

// Delete all dynamic memory, if any
AtomParser::~AtomParser()
{
	if (lastBuildDate != 0)
		delete lastBuildDate;
	for (list<Item*>::iterator i = item.begin(); i != item.end(); ++i)
		delete *i;
}

// Parse Atom feed from a dom tree
void AtomParser::ReadDom(const rapidxml::xml_document<>& doc)
{
	// Clean up
	for (list<Item*>::iterator i = item.begin(); i != item.end(); ++i)
		delete (AtomItem*)*i;
	if (lastBuildDate != 0)
		delete lastBuildDate;
	lastBuildDate = 0;
	
	// Start parsing header of Atom
	rapidxml::xml_node<>* cur_node;
	rapidxml::xml_node<>* cur_item;
	rapidxml::xml_attribute<>* cur_attr;
	
	if ((cur_node = doc.first_node("feed")) == 0)
		throw InvalidSource(string("AtomParser: \"").append((url == 0) ?
								   "" : *url)
				    .append("\" is not a Atom feed"));
	cur_item = cur_node->first_node("entry");
	cur_node = cur_node->first_node("lastBuildDate");
	if (cur_node != 0)
	{
		if (lastBuildDate == 0)
			lastBuildDate = new DateTime();
		try
		{
			lastBuildDate->ParseFromString(cur_node->value());
		}
		catch (const exception&)
		{
			delete lastBuildDate;
			lastBuildDate = 0;
		}
	}
	
	// parsing items
	AtomItem* new_item;
	
	while (cur_item != 0)
	{
		new_item = new AtomItem();
		try
		{
			if ((cur_node = cur_item->first_node("title")) != 0)
				new_item->SetTitle(cur_node->value());
			cur_node = cur_item->first_node("link");
			while (cur_node != 0) {
				cur_attr = cur_node->first_attribute("rel");
				if (cur_attr != 0 && strcmp(cur_attr->value(),
							    "alternate") == 0 &&
				    (cur_attr =
				     cur_node->first_attribute("href")) != 0) {
					new_item->SetURL(cur_attr->value());
					break;
				}
				cur_node = cur_node->next_sibling("link");
			}
			if ((cur_node = cur_item->first_node("content")) != 0)
			{
				new_item->SetContent(cur_node->value());
				new_item->SetFullContent(true);
			}
			else if ((cur_node = cur_item->first_node("summary"))
				 != 0)
				new_item->SetContent(cur_node->value());
			if ((cur_node = cur_item->first_node("updated")) != 0)
			{
				try
				{
					DateTime dateTime;
					dateTime.ParseFromRFC3339(
						cur_node->value());
					new_item->SetPostDate(&dateTime);
				}
				catch (const exception&) {}
			}
			if ((cur_node = cur_item->first_node("author")) != 0 &&
			    (cur_node = cur_item->first_node("name")) != 0)
				new_item->SetAuthor(cur_node->value());

			cur_item = cur_item->next_sibling("entry");
			
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
const DateTime& AtomParser::GetLastBuildDate() const
{
	if (lastBuildDate == 0)
		throw HasNoValue("AtomParser: Last build date does not exist");
	else
		return *lastBuildDate;
}
