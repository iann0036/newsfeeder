/**
 * @file	Parser.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	24/08/12
 *
 * @section	DESCRIPTION
 *
 * Abstract/Interface Parser class and related stuff.<br>
 * Item is a part of Parser (as a container).<br>
 * Parser is a generalised parser reading source form an URL.<br>
 * ParserException is for general exceptions.<br>
 * HasNoValue is thrown when the attribute has no value.<br>
 * InvalidSource is thrown when the resource cannot be parsed by the parser.
 */

#ifndef nfrd_Parser_h
#define nfrd_Parser_h
#include <string>
#include <list>
#include <utility>
#include "nfrd/DateTime.h"
#include "nfrd/Image.h"

namespace nfrd { namespace parser
{
	/**
	 * A class to store details of an item obtained by the Parser.
	 * The relationship with Parser is many-to-one, that Parser can have
	 * many Item.
	 * The attribute can be added to this class at anytime and it will not
	 * make subclasses unable to compile. Instead, all subclasses will
	 * automatical derive new attributes.
	 */
	class Item
	{
	public:
		/**
		 * A Image type is a pair of URL and image file.
		 * Notice: image file part can be null that the image only
		 * contains URL, not the file.
		 * The image file could be a thumbnail and not the image that
		 * the URL points to.
		 */
		typedef std::pair<std::string, misc::Image::File*> Image;
		/**
		 * Delete all dynamic memory, if any
		 */
		virtual ~Item();
		/**
		 * Get the title of the item.
		 * @return title
		 * @throws HasNoValue	if the item has no title
		 *			or if this function is not overrided
		 */
		virtual const std::string& GetTitle() const;
		/**
		 * Get the URL where full edition of the item is.
		 * @return URL
		 * @throws HasNoValue	if the item has no URL
		 *			or if this function is not overrided
		 */
		virtual const std::string& GetURL() const;
		/**
		 * Get the content of the item.
		 * @return content
		 * @throws HasNoValue	if the item has no content
		 *			or if this function is not overrided
		 */
		virtual const std::string& GetContent() const;
		/**
		 * Get the post date of the item.
		 * @return post date
		 * @throws HasNoValue	if the item has no post date
		 *			or if this function is not overrided
		 */
		virtual const misc::DateTime& GetPostDate() const;
		/**
		 * Get the author of the item.
		 * @return author
		 * @throws HasNoValue	if the item has no author
		 *			or if this function is not overrided
		 */
		virtual const std::string& GetAuthor() const;
		/**
		 * Get the geographical location of the item.
		 * @return geographical location
		 * @throws HasNoValue	if the item has no geographical location
		 *			or if this function is not overrided
		 */
		virtual const std::string& GetGeoLocation() const;
		/**
		 * Get the image list of the item.
		 * The relationship between the item and the image is
		 * one-to-many.
		 * @return image list
		 * @throws HasNoValue	if the item has no image list
		 *			or if this function is not overrided
		 */
		virtual const std::list<Image>& GetImageList() const;
		/**
		 * Test the item has title or not.
		 * @return true		If the item has title
		 * @return false	If the item has no title
		 *			or this function is not overrided
		 */
		virtual bool HasTitle() const;
		/**
		 * Test the item has URL or not.
		 * @return true		If the item has URL
		 * @return false	If the item has no URL
		 *			or this function is not overrided
		 */
		virtual bool HasURL() const;
		/**
		 * Test the item has content or not.
		 * @return true		If the item has content
		 * @return false	If the item has no content
		 *			or this function is not overrided
		 */
		virtual bool HasContent() const;
		/**
		 * Test the item has post date or not.
		 * @return true		If the item has post date
		 * @return false	If the item has no post date
		 *			or this function is not overrided
		 */
		virtual bool HasPostDate() const;
		/**
		 * Test the item has author or not.
		 * @return true		If the item has author
		 * @return false	If the item has no title
		 *			or this function is not overrided
		 */
		virtual bool HasAuthor() const;
		/**
		 * Test the item has geographical location or not.
		 * @return true		If the item has geographical location
		 * @return false	If the item has no geographical location
		 *			or this function is not overrided
		 */
		virtual bool HasGeoLocation() const;
		/**
		 * Test the item has image list or not.
		 * @return true		If the item has image list
		 * @return false	If the item has no image list
		 *			or this function is not overrided
		 */
		virtual bool HasImageList() const;
	};
	
	/**
	 * A generalised parser interface class, providing all the interfaces of
	 * a class that reads resource from an URL and parse it into a list of
	 * Item.
	 * Since it is an abstract class, all pure virtual functions have to be
	 * implemented by the subclasses. 
	 */
	class Parser
	{
	public:
		/**
		 * Delete all dynamic memory, if any
		 */
		virtual ~Parser();
		/**
		 * Read resouce from an URL and parse into a list of Item
		 * @param url	URL address of the feed resource
		 * @throws InvalidSource	if the url or the feed resource
		 *				is invalid
		 */
		virtual void ReadURL(const std::string& url) = 0;
		/**
		 * Get the last build date of the feed resource.
		 * Usually, this data is provided in the feed resource, telling
		 * when the feed resource is generated. Some subclasses may use
		 * pseudo-LastBuildDate that the date is the post date of the 
		 * latest item.
		 * @return last build date of the feed resource
		 * @throws HasNoValue	if the item has no last build date
		 */
		virtual const misc::DateTime& GetLastBuildDate() const;
		/**
		 * Get the item list of parsed feed.
		 * @return item list
		 * @throws HasNoValue	if the feed has no item list
		 */
		virtual const std::list<Item*>& GetItemList() const;
	};
	
	/**
	 * General exception for parser
	 */
	class ParserException : public std::exception
	{
	public:
		/**
		 * Default Constructor for ParserException, recording the error
		 * message.
		 * @param message	Error message
		 */
		explicit ParserException(const std::string& message);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~ParserException() throw();
		/**
		 * Return error message
		 * @return Error message
		 */
		virtual const char* what() const throw();
	private:
		/// Error message
		std::string msg;
	};
	
	/**
	 * Has no value exception.
	 * HasNoValue is thrown when the attribute has no value.
	 */
	class HasNoValue : public ParserException
	{
	public:
		/**
		 * Default Constructor for HasNoValue, recording the error
		 * message.
		 * @param msg	Error message
		 */
		explicit HasNoValue(const std::string& msg);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~HasNoValue() throw();
	};
	
	/**
	 * Invalid source exception.
	 * InvalidSource is thrown when the resource cannot be parsed by the
	 * parser.
	 */
	class InvalidSource : public ParserException
	{
	public:
		/**
		 * Default Constructor for InvalidSource, recording the error
		 * message.
		 * @param msg	Error message
		 */
		explicit InvalidSource(const std::string& msg);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~InvalidSource() throw();
	};
}}

#endif
