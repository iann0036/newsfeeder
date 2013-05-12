/**
 * @file	FeedParser.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	14/09/12
 *
 * @section	DESCRIPTION
 *
 * Classes related to parsing web feeds with Patch and Match feature.<br>
 * FeedItem is a part of FeedParser (as a container).<br>
 * FeedParser is a class that parse web feeds.
 * @see Parser.h
 */

#ifndef nfrd_FeedParser_h
#define nfrd_FeedParser_h
#include <rapidxml.hpp>
#include "nfrd/Parser.h"

namespace nfrd { namespace parser
{
	/**
	 * A class to store details of an item obtained by the FeedParser.
	 * @see Item
	 */
	class FeedItem : public Item
	{
	public:
		/**
		 * Initialising Constructor for FeedItem.
		 * Initialise everything to zero/null.
		 */
		FeedItem();
		/**
		 * Delete all dynamic memory, if any
		 */
		virtual ~FeedItem();
		const std::string& GetGeoLocation() const;
		const std::list<Image>& GetImageList() const;
		/**
		 * Set the content of the item.
		 * @param source	content of the item
		 */
		virtual void SetContent(const std::string& source) = 0;
		/**
		 * Set the geographical location of the item.
		 * @param source	geographical location of the item
		 * @see FeedItem
		 */
		void SetGeoLocation(const std::string& source);
		/**
		 * Set whether the content is the full version.
		 * @param hasFullContent whether the content is the full version
		 */
		void SetFullContent(bool hasFullContent);
		/**
		 * Add an URL of an image to the image list, auto generating
		 * thumbnail.
		 * @param source	url of an image to be added
		 */
		void AddImage(const std::string& source);
		/**
		 * Remove an URL of an image from the image list.
		 * @param source	url of an image to be removed
		 */
		void RemoveImage(const std::string& source);
		/**
		 * Clear the image list.
		 * Note: This operation actually purge the image list.
		 */
		void ClearImage();
		bool HasGeoLocation() const;
		bool HasImageList() const;
		/**
		 * Whether the content is the full version or not.
		 * @return true if the content of the item is the full version.
		 */
		bool HasFullContent() const;
	private:
		/// Geographical location of the item.
		std::string* geo_location;
		/// Images in the item
		/// Optional in RSS. Original tag in RSS: media:content
		std::list<Image>* image_list;
		/// Whether the content is the full version.
		bool full_content;
	};
	
	/**
	 * A parser to parse web feeds.
	 * @see Parser
	 */
	class FeedParser : public Parser
	{
	public:
		/**
		 * Initialising Constructor for RSSParser.
		 */
		FeedParser();
		/**
		 * Delete all dynamic memory, if any
		 */
		virtual ~FeedParser();
		virtual void ReadURL(const std::string& url);
		const std::list<Item*>& GetItemList() const;
		/**
		 * Parse feed from a dom tree (xml document) into a list of Item
		 * @param doc	parsed xml document of the feed resource
		 * @throws InvalidSource	if the dom or the feed resource
		 *				is invalid
		 */
		virtual void ReadDom(const rapidxml::xml_document<>& doc) = 0;
	protected:
		/// URL of the source
		std::string* url;
		/// Items of the RSS feed
		/// Required in RSS. Original tag in RSS: item
		std::list<Item*> item;	// Optional
	};
}}

#endif
