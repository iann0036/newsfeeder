/**
 * @file	FeedXParser.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	14/09/12
 *
 * @section	DESCRIPTION
 *
 * Classes related to parsing web feeds with Patch and Match feature.<br>
 * @see Parser.h
 * @see FeedParser.h
 */

#ifndef nfrd_FeedXParser_h
#define nfrd_FeedXParser_h
#include <set>
#include <string>
#include "htmlcxx/html/ParserDom.h"
#include "nfrd/Parser.h"
#include "nfrd/FeedParser.h"

namespace nfrd { namespace parser
{
	/**
	 * A parser to parse web feeds with Patch and Match feature.
	 * This parser will automatically identify feed type (RSS or Atom).
	 * @see FeedParser
	 */
	class FeedXParser : public Parser
	{
	public:
		/**
		 * Initialising Constructor for FeedParser.
		 */
		FeedXParser();
		/**
		 * Delete all dynamic memory, if any
		 */
		~FeedXParser();
		void ReadURL(const std::string& url);
		const misc::DateTime& GetLastBuildDate() const;
		const std::list<Item*>& GetItemList() const;
	private:
		/**
		 * A iterator pair structure used in Construct() to store
		 * iterators for parent nodes.
		 * @see Construct()
		 */
		struct IteratorPair {
			/**
			 * Initialising Constructor for IteratorPair using a
			 * iterator of a node.
			 * @param iterator	where it and end are extracted
			 * @param is_allowed_tag	whether the parent node
			 *				is an allowed tag
			 */
			IteratorPair(const tree<htmlcxx::HTML::Node>::iterator&
				     iterator,
				     bool is_allowed_tag = false);
			/**
			 * Initialising Constructor for IteratorPair using a
			 * node.
			 * @param node	where it and end are extracted
			 * @param is_allowed_tag	whether the parent node
			 *				is an allowed tag
			 */
			IteratorPair(const tree<htmlcxx::HTML::Node>& node,
				     bool is_allowed_tag = false);
			/// Current working iterator
			tree<htmlcxx::HTML::Node>::iterator it;
			/// The end mark of the current working iterator
			tree<htmlcxx::HTML::Node>::iterator end;
			/// Whether the parent node is an allowed tag
			bool is_allowed_tag;
		};
		/**
		 * Patch an rss item using Patch and Match (Match and Patch)
		 * algorithm.
		 * @param item	an item to be patched.
		 */
		static void PatchAndMatch(FeedItem* item);
		/**
		 * Construct html source code from a html tree using all child
		 * nodes of a root node.
		 * Note:	Remember to empty the @a content before call
		 *		this function
		 * @param iterator_pair	a iterator pair of the root node
		 * @param content	whether to put constructed html code
		 */
		static void Construct(const IteratorPair& iterator_pair,
				      std::string& content);
		/**
		 * Get the total text size of a html tree, counting all child
		 * nodes of a root node.
		 * @param iterator	a iterator of the root node
		 */
		static std::string::size_type
			TextSize(const tree<htmlcxx::HTML::Node>::iterator&
				 iterator);
		/**
		 * Get the longest text from a html source code
		 * @param source	html source code
		 * @return	the longest text in @a source
		 */
		static std::string GetLongestText(const std::string& source);
		/**
		 * Trim all empty a or div tags in the source.
		 * @param source	html source code
		 * @return trimmed html source code
		 */
		static std::string TrimEmptyTag(const std::string& source);
		/**
		 * Extract images from the given tree and add to the item.
		 * @param item		where to add images
		 * @param iterator_pair	tree source
		 */
		static void ExtractImages(FeedItem* item,
					  const IteratorPair& iterator_pair);
		/**
		 * Extract geographical location from the given tree and add
		 * to the item.
		 * @param item		where to add geographical location
		 * @param iterator_pair	tree source
		 */
		static void ExtractGeoLocation(FeedItem* item,
			const IteratorPair& iterator_pair);
		/**
		 * Refine a feed by stripping tags and extracting images.
		 * @param item	an item to be refined.
		 */
		static void RefineFeed(FeedItem* item);
		/**
		 * Find the matched content block in a dom tree
		 * This method will modified @a match_string to the longest line 
		 * in @a match_string
		 * @param dom		source dom tree
		 * @param match_string	the string to test the dom tree
		 * @return the lowest level of node which match the string
		 * @return dom.end() if not matched.
		 */
		static tree<htmlcxx::HTML::Node>::iterator
			AdvancedMatchLine(const tree<htmlcxx::HTML::Node>& dom,
					  std::string& match_string);
		/**
		 * Find the matched content block in a dom tree
		 * This method will modified @a match_string to the mid part of
		 * @a match_string
		 * @param dom		source dom tree
		 * @param match_string	the string to test the dom tree
		 * @return the lowest level of node which match the string
		 * @return dom.end() if not matched.
		 */
		static tree<htmlcxx::HTML::Node>::iterator
			AdvancedMatchDivide(const tree<htmlcxx::HTML::Node>&
					    dom, std::string& match_string);
		/// The tags that will not be changed.
		static std::set<std::string> allowed_tags;
		/// The tage that only text part is kept.
		static std::set<std::string> trimmed_tags;
		/// Feed parser to parse the actual feed
		FeedParser* parser;
	};
}}

#endif
