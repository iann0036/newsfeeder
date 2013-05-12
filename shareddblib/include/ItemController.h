/**
 * @file	ItemController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find items.
 */

#ifndef LIBNFDB_ITEMCONTROLLER
#define LIBNFDB_ITEMCONTROLLER

#include "Item.h"
#include "DatabaseController.h"
#include "nfrd/DateTime.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>
#include <string>

namespace nfdb {

/**
 * A class called to create, update, delete or find items.
 */
class ItemController
{
	public:
		/**
		 * Initialising Constructor for ItemController, opens a database connection
		 */
		ItemController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~ItemController();

		/**
		 * Find the item with that id
		 * @param id	primary key id of the item
		 * @return the item with that id
		 */
		Item* GetItemById(int id);

		/**
		 * Find all items that belong to the feed of that id
		 * @param feedId	id of the feed to find items for
		 * @return the items that belong to that feed
		 */
		std::vector<Item*> GetItemsByFeedId(int feedId);

		/**
		 * Find all items
		 * @return all items in the database
		 */
		std::vector<Item*> GetAllItems();

		/**
		 * Insert the item into the database
		 * @param item	item to be added to the database
		 * @return id of the newly added item, -1 for an error
		 */
		int AddItem(Item& item);

		/**
		 * Update the relevant item in the database
		 * @param item	item to be updated
		 */
		void UpdateItem(Item& item);

		/**
		 * Update the relevant item in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the item
		 * @param feedId	int representing the id of the feed this item relates to, nullable
		 * @param title	string representing the display name of the item, nullable
		 * @param url	string representing the url of the item, nullable
		 * @param content	string representing the body content of the item, nullable
		 * @param postDate	datetime representing the date the item was published, nullable
		 * @param author	string* representing the author of the item, nullable
		 * @param geolocation	string* representing the geolocation information parsed for that item, nullable
		 */
		void UpdateItem(int id, int* feedId, std::string* title, std::string* url, std::string* content, nfrd::misc::DateTime* postDate, std::string* author, std::string* geolocation);

		/**
		 * Delete the item from the database
		 * @param item	item to be removed from the database
		 */
		void RemoveItem(int id);

		/**
		 * Generate a item based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a item
		 * @return the generated item
		 */
		Item* GenerateItem(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
