/**
 * @file	Feed.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Feed record
 */

#ifndef LIBNFDB_FEED
#define LIBNFDB_FEED

#include <string>
#include "nfrd/DateTime.h"

namespace nfdb {

/**
 * A class representing a row in the Feeds table
 */
class Feed
{
	public:
		int id;
		std::string url;
		std::string name;
		int frequency;
		nfrd::misc::DateTime* lastUpdate;
		std::string* category;
		int* type;
		char* favIcon;
		int iconSize;

		/**
		 * Initialising Constructor for Feed. Sets lastUpdate, category, type and favIcon to NULL
		 */
		Feed()
		{
			lastUpdate = NULL;
			category = NULL;
			type = NULL;
			favIcon = NULL;
		}

		/**
		 * Non-Default Constructor for Feed
		 * @param id	int identifier of the feed
		 * @param url	string representing the url of the RSS feed
		 * @param name	string representing the display name of the feed
		 * @param frequency	int representing how often this feed is updated
		 * @param lastUpdate	datetime representing when this feed was last crawled/updated, nullable
		 * @param category	string* representing what category this feed is in, nullable
		 * @param type	int* representing the type of feed, nullable
		 * @param favIcon	char* representing the favourite icon image of that feed, nullable
		 * @param iconSize	int representing the size of the feed's favourite icon, 0 if no icon is provided
		 */
		Feed(int id, std::string url, std::string name, int frequency, nfrd::misc::DateTime* lastUpdate, std::string* category, int* type, char* favIcon, int iconSize)
		{
			this->id = id;
			this->url = url;
			this->name = name;
			this->frequency = frequency;
			this->lastUpdate = lastUpdate;
			this->category = category;
			this->type = type;
			this->favIcon = favIcon;
			this->iconSize = iconSize;
		}

		/**
		 * Destructor for Feed. Does not perform any actions
		 */
		~Feed()
		{
			//Commented out to stop any issues regarding auto pointers freeing inappropriately
			//Destroy();
		}

		/**
		 * Cleans up any memory held by the Feed
		 */
		void Destroy()
		{
			if(lastUpdate != NULL)
			{
				delete lastUpdate;
				lastUpdate = NULL;
			}
			if(category != NULL)
			{
				delete category;
				category = NULL;
			}
			if(type != NULL)
			{
				delete type;
				type = NULL;
			}
			if(favIcon != NULL)
			{
				delete[] favIcon;
				favIcon = NULL;
			}
		}
};

}

#endif
