/**
 * @file	Parser.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	24/08/12
 *
 * @section	DESCRIPTION
 *
 * Part implementation of Abstract/Interface Parser class and related stuff
 */
 
#include "nfrd/Parser.h"
using namespace nfrd::parser;
using namespace nfrd::misc;
using namespace std;

// Destructor of Item
Item::~Item()
{
}

// Item default processes
const string& Item::GetTitle() const
{
	throw HasNoValue("Item: Title is not provided");
}

const string& Item::GetURL() const
{
	throw HasNoValue("Item: URL is not provided");
}

const string& Item::GetContent() const
{
	throw HasNoValue("Item: Content is not provided");
}

const DateTime& Item::GetPostDate() const
{
	throw HasNoValue("Item: Post date is not provided");
}

const string& Item::GetAuthor() const
{
	throw HasNoValue("Item: Author is not provided");
}

const string& Item::GetGeoLocation() const
{
	throw HasNoValue("Item: GeoLocation is not provided");
}

const list<Item::Image>& Item::GetImageList() const
{
	throw HasNoValue("Item: ImageList is not provided");
}

bool Item::HasTitle() const
{
	return false;
}

bool Item::HasURL() const
{
	return false;
}

bool Item::HasContent() const
{
	return false;
}

bool Item::HasPostDate() const
{
	return false;
}

bool Item::HasAuthor() const
{
	return false;
}

bool Item::HasGeoLocation() const
{
	return false;
}

bool Item::HasImageList() const
{
	return false;
}

// Destructor of Parser
Parser::~Parser()
{
}

// Parser default processes
const DateTime& Parser::GetLastBuildDate() const
{
	throw HasNoValue("Parser: Last build date does not exist");
}

const std::list<Item*>& Parser::GetItemList() const
{
	throw HasNoValue("Parser: Item list does not exist");
}

// General exception
ParserException::ParserException(const string& message) : msg(message)
{
}

// Delete dynamic memories, if any
ParserException::~ParserException() throw()
{
}

// Return message
const char* ParserException::what() const throw()
{
	return msg.c_str();
}

// Has no value exception
HasNoValue::HasNoValue(const string& msg) : ParserException(msg)
{
}

// Delete dynamic memories, if any
HasNoValue::~HasNoValue() throw()
{	
}

// Invalid source exception
InvalidSource::InvalidSource(const string& msg) : ParserException(msg)
{
}

// Delete dynamic memories, if any
InvalidSource::~InvalidSource() throw()
{	
}
