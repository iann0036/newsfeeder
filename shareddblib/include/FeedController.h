/**
 * @file	FeedController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find feeds.
 */

#ifndef LIBNFDB_FEEDCONTROLLER
#define LIBNFDB_FEEDCONTROLLER

#include "Feed.h"
#include "QueueItem.h"
#include "DatabaseController.h"
#include "nfrd/DateTime.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>
#include <string>

namespace nfdb {

/**
 * A class called to create, update, delete or find feeds.
 */
class FeedController
{
	public:
		/**
		 * Initialising Constructor for FeedController, opens a database connection
		 */
		FeedController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~FeedController();

		/**
		 * Find the feed with that id
		 * @param id	primary key id of the feed
		 * @return the feed with that id
		 */
		Feed* GetFeedById(int id);

		/**
		 * Find all feeds that are contained within that CPH
		 * @param cphId	id of the cph to find feeds for
		 * @return the feeds that belong to that cph
		 */
		std::vector<Feed*> GetFeedsByCphId(int cphId);

		/**
		 * Find all feeds that belong to the user of that username
		 * @param username	username of the user to find feeds for
		 * @return the feeds that belong to that user
		 */
		std::vector<Feed*> GetFeedsByUsername(std::string username);

		/**
		 * Find all feeds
		 * @return all feeds in the database
		 */
		std::vector<Feed*> GetAllFeeds();

		/**
		 * Find all feeds which are due to be crawled again
		 * @return feeds which are due to be crawled again
		 */
		std::vector<QueueItem*> GetQueueFeeds();

		/**
		 * Get all of the feeds which are newer than the passed id
		 * @param id	the id of the last feed that has been added to the queue
		 * @return feeds which are newer than the passed id
		 */
		std::vector<Feed*> GetNewFeeds(int id);

		/**
		 * Insert the feed into the database
		 * @param feed	feed to be added to the database
		 * @return id of the added feed, -1 for an error
		 */
		int AddFeed(Feed& feed);

		/**
		 * Update the relevant feed in the database
		 * @param feed	feed to be updated
		 */
		void UpdateFeed(Feed& feed);

		/**
		 * Update the relevant feed in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the feed
		 * @param url	string representing the url of the RSS feed, nullable
		 * @param name	string representing the display name of the feed, nullable
		 * @param frequency	int representing how often this feed is updated, nullable
		 * @param lastUpdate	datetime representing when this feed was last crawled/updated, nullable
		 * @param category	string* representing what category this feed is in, nullable
		 * @param type	int* representing the type of feed, nullable
		 * @param favIcon	char* representing the favourite icon image of that feed, nullable
		 * @param iconSize	int representing the size of the feed's favourite icon, 0 if no icon is provided
		 */
		void UpdateFeed(int id, std::string* url, std::string* name, int* frequency, nfrd::misc::DateTime* lastUpdate, std::string* category, int* type, char* favIcon, int* iconSize);

		/**
		 * Delete the feed from the database
		 * @param feed	feed to be removed from the database
		 */
		void RemoveFeed(int id);

		/**
		 * Generate a feed based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a feed
		 * @return the generated feed
		 */
		Feed* GenerateFeed(sql::ResultSet& rs);

		/**
		 * Generate a queue item based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a feed
		 * @return the generated queue item
		 */
		QueueItem* GenerateQueueItem(sql::ResultSet& rs);

		/**
		 * Get the number of users currently subscribed to that feed
		 * @param id	int identifying the feed
		 * @return the number of users who have that feed
		 */
		int GetNumberOfFeedUsers(int id);		
		
		/**
		 * Touch the feed, setting lastupdate to now
		 * @param feedid	int identifying the feed
		 */
		void UpdateLastUpdateTime(int feedid);

	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
