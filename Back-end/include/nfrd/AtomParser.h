/**
 * @file	AtomParser.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	22/08/12
 *
 * @section	DESCRIPTION
 *
 * Classes related to parsing Atom feeds.<br>
 * AtomItem is a part of AtomParser (as a container).<br>
 * AtomParser is a class that parse Atom feeds.
 * @see Parser.h
 */

#ifndef nfrd_AtomParser_h
#define nfrd_AtomParser_h
#include "nfrd/FeedParser.h"

namespace nfrd { namespace parser
{
	/**
	 * A class to store details of an item obtained by the AtomParser.
	 * Note: All item components are actually stored in the AtomParser::doc
	 * @see FeedItem
	 */
	class AtomItem : public FeedItem
	{
	public:
		/**
		 * Initialising Constructor for AtomItem.
		 * Initialise everything to zero/null.
		 */
		AtomItem();
		/**
		 * Delete all dynamic memory, if any
		 */
		~AtomItem();
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
		/// Required in Atom. Original tag in Atom: title
		std::string* title;
		/// URL of the item.
		/// Optional in Atom. Original tag in Atom: link rel="alternate"
		std::string* url;
		/// Content of the item.
		/// Optional in Atom. Original tag in Atom: content
		std::string* content;
		/// Post date of the item.
		/// Required in Atom. Original tag in Atom: updated
		misc::DateTime* postDate;
		/// Author of the item.
		/// Required in Atom. Original tag in Atom: author | name
		std::string* author;
	};
	
	/**
	 * A parser to parse Atom feeds.
	 * Standard:	http://tools.ietf.org/html/rfc4287
	 * @see Parser
	 */
	class AtomParser : public FeedParser
	{
	public:
		/**
		 * Initialising Constructor for AtomParser.
		 */
		AtomParser();
		/**
		 * Delete all dynamic memory, if any
		 */
		virtual ~AtomParser();
		void ReadDom(const rapidxml::xml_document<>& doc);
		const misc::DateTime& GetLastBuildDate() const;
	protected:
		/// Last build date of the Atom feed
		/// Required in Atom. Original tag in Atom: updated
		misc::DateTime* lastBuildDate;
	};
}}

#endif
