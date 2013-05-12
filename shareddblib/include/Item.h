/**
 * @file	Item.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing an Item record
 */

#ifndef LIBNFDB_ITEM
#define LIBNFDB_ITEM

#include <string>
#include "nfrd/DateTime.h"

namespace nfdb {

/**
 * A class representing a row in the Items table
 */
class Item
{
	public:

		int id;
		int feedId;
		std::string title;
		std::string url;
		std::string content;
		nfrd::misc::DateTime* postDate;
		std::string* author;
		std::string* geolocation;

		/**
		 * Initialising Constructor for Item, sets postDate, author and geolocation to NULL
		 */
		Item()
		{
			postDate = NULL;
			author = NULL;
			geolocation = NULL;
		}

		/**
		 * Non-Default Constructor for Item
		 * @param id	int identifier of the item
		 * @param feedId	int representing the id of the feed this item relates to
		 * @param title	string representing the display name of the item
		 * @param url	string representing the url of the item
		 * @param content	string representing the body content of the item
		 * @param postDate	datetime representing the date the item was published, nullable
		 * @param author	string* representing the author of the item, nullable
		 * @param geolocation	string* representing the geolocation information parsed for that item, nullable
		 */
		Item(int id, int feedId, std::string title, std::string url, std::string content, nfrd::misc::DateTime* postDate, std::string* author, std::string* geolocation)
		{
			this->id = id;
			this->feedId = feedId;
			this->title = title;
			this->url = url;
			this->content = content;
			this->postDate = postDate;
			this->author = author;
			this->geolocation = geolocation;
		}

		/**
		 * Destructor for Item, does not perform any actions
		 */
		~Item()
		{
			//Commented out to stop any issues regarding auto pointers freeing inappropriately
			//Destroy();
		}
	
		/**
		 * Cleans up any memory held by the Item
		 */
		void Destroy()
		{
			if(postDate != NULL)
			{
				delete postDate;
				postDate = NULL;
			}
			if(author != NULL)
			{
				delete author;
				author = NULL;
			}
			if(geolocation != NULL)
			{
				delete geolocation;
				geolocation = NULL;
			}
		}
};

}

#endif
