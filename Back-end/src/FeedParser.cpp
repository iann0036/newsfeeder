/**
 * @file	FeedParser.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	20/09/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of FeedItem and FeedParser
 */

#include <cstring>
#include "nfrd/FeedParser.h"
#include "nfrd/Utility.h"
using namespace std;
using namespace nfrd::parser;
using namespace nfrd::misc;

// Default Constructor
FeedItem::FeedItem() : geo_location(0), image_list(0), full_content(false)
{
}

// Delete all dynamic memory, if any
FeedItem::~FeedItem()
{
	if (geo_location != 0)
		delete geo_location;
	ClearImage();
}

// Getter Sector
const std::string& FeedItem::GetGeoLocation() const
{
	if (geo_location == 0)
		throw HasNoValue
			("FeedItem: Geographical location does not exist");
	else
		return *geo_location;
}

const list<Item::Image>& FeedItem::GetImageList() const
{
	if (image_list == 0)
		throw HasNoValue("FeedItem: Image list does not exist");
	else
		return *image_list;
}

// Setter Sector
void FeedItem::SetGeoLocation(const std::string& source)
{
	if (geo_location == 0)
		geo_location = new string(source);
	else
		*geo_location = source;
}

void FeedItem::SetFullContent(bool isFullContent)
{
	full_content = isFullContent;
}

// Image list related functions
// Add an URL of an image to the image list, auto generating thumbnail.
void FeedItem::AddImage(const std::string& source)
{
	if (image_list == 0)
		image_list = new list<Item::Image>;

	misc::Image::File* file = 0;
	try
	{
		misc::Image image;
		image.Load(source);
		file = image.FitSize(100, 100)->ExportJpeg(80).release();
	}
	catch (const exception&) {}
	image_list->push_back(Item::Image(source, file));
}

// Remove an URL of an image from the image list.
void FeedItem::RemoveImage(const std::string& source)
{
	if (image_list == 0)
		return;
	for (list<Item::Image>::iterator i = image_list->begin();
	     i != image_list->end(); ++i)
		if (i->first == source)
		{
			if (i->second != 0)
				delete i->second;
			image_list->erase(i);
		}
	if (image_list->empty())
		ClearImage();
}

// Clear the image list.
void FeedItem::ClearImage()
{
	if (image_list == 0)
		return;
	for (list<Item::Image>::iterator i = image_list->begin();
	     i != image_list->end(); ++i)
		if (i->second != 0)
			delete i->second;
	delete image_list;
	image_list = 0;
}

// Check Sector
bool FeedItem::HasGeoLocation() const
{
	return geo_location != 0;
}

bool FeedItem::HasImageList() const
{
	return image_list != 0;
}

bool FeedItem::HasFullContent() const {
	return full_content;
}

// Default Constructor
FeedParser::FeedParser() : url(0)
{
}

// Delete all dynamic memory, if any
FeedParser::~FeedParser()
{
	if (url != 0)
		delete url;
}

// Read feed from a specified url and parse it
void FeedParser::ReadURL(const string& source)
{
	// Clean up
	if (url == 0)
		url = new string(source);
	else
		*url = source;
	
	// Read from url
	vector<char> container;
	if (!Utility::Read(source, container))
		throw InvalidSource(string("FeedParser: Cannot connect \"")
				    .append(source).append("\""));
	if (container.size() == 0)
		throw InvalidSource(string("FeedParser: \"").append(source)
				    .append("\" contains nothing"));
	container.push_back(0);
	
	// Start parsing header of rss
	rapidxml::xml_document<> doc;
	try
	{
		doc.parse<0>(&container[0]);
	}
	catch (const exception&)
	{
		throw InvalidSource(string("FeedParser: Unable to parse \"")
				    .append(source).append("\""));
	}
	ReadDom(doc);
}

// Getter Sector
const list<Item*>& FeedParser::GetItemList() const
{
	return item;
}
