/**
 * @file	RSSParser.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	22/08/12
 *
 * @section	DESCRIPTION
 *
 * Classes related to parsing RSS feeds.<br>
 * RSSItem is a part of RSSParser (as a container).<br>
 * RSSParser is a class that parse RSS feeds.
 * @see Parser.h
 */

#ifndef nfrd_RSSParser_h
#define nfrd_RSSParser_h
#include "nfrd/FeedParser.h"

namespace nfrd { namespace parser
{
	/**
	 * A class to store details of an item obtained by the RSSParser.
	 * @see FeedItem
	 */
	class RSSItem : public FeedItem
	{
	public:
		/**
		 * Initialising Constructor for RSSItem.
		 * Initialise everything to zero/null.
		 */
		RSSItem();
		/**
		 * Delete all dynamic memory, if any
		 */
		~RSSItem();
		const std::string& GetTitle() const;
		const std::string& GetURL() const;
		const std::string& GetContent() const;
		const misc::DateTime& GetPostDate() const;
		const std::string& GetAuthor() const;
		/**
		 * Set the title of the item.
		 * @param source	title of the item
		 */
		void SetTitle(const char* source);
		/**
		 * Set the url of the item.
		 * @param source	url of the item
		 */
		void SetURL(const char* source);
		/**
		 * Set the content of the item.
		 * @param source	content of the item
		 */
		void SetContent(const char* source);
		/**
		 * Set the content of the item.
		 * @param source	content of the item
		 * @see FeedItem
		 */
		void SetContent(const std::string& source);
		/**
		 * Set the post date of the item.
		 * @param source	post date of the item
		 */
		void SetPostDate(const misc::DateTime* source);
		/**
		 * Set the author of the item.
		 * @param source	author of the item
		 */
		void SetAuthor(const char* source);
		bool HasTitle() const;
		bool HasURL() const;
		bool HasContent() const;
		bool HasPostDate() const;
		bool HasAuthor() const;
	private:
		/// Title of the item.
		/// Optional in RSS. Original tag in RSS: title
		std::string* title;
		/// URL of the item.
		/// Optional in RSS. Original tag in RSS: link
		std::string* url;
		/// Content of the item.
		/// Optional in RSS. Original tag in RSS: description or
		///					  content:encoded
		std::string* content;
		/// Post date of the item.
		/// Optional in RSS. Original tag in RSS: pubDate
		misc::DateTime* postDate;
		/// Author of the item.
		/// Optional in RSS. Original tag in RSS: author or dc:creator
		std::string* author;
	};
	
	/**
	 * A parser to parse RSS feeds.
	 * Standard:	http://cyber.law.harvard.edu/rss/rss.html
	 * @see Parser
	 */
	class RSSParser : public FeedParser
	{
	public:
		/**
		 * Initialising Constructor for RSSParser.
		 */
		RSSParser();
		/**
		 * Delete all dynamic memory, if any
		 */
		virtual ~RSSParser();
		void ReadDom(const rapidxml::xml_document<>& doc);
		const misc::DateTime& GetLastBuildDate() const;
	protected:
		/// Last build date of the RSS feed
		/// Required in RSS. Original tag in RSS: lastBuildDate
		misc::DateTime* lastBuildDate;
	private:
		/**
		 * Get the text value from a node.
		 * If a node has multiple of CDATA nodes, the value will be
		 * appended together.
		 * @param node		the node for getting value
		 * @return	value from @a node.
		 */
		const char* GetValue(rapidxml::xml_node<>* node);
		/// String buffer used by GetValue().
		std::string buffer;
	};
}}

#endif
