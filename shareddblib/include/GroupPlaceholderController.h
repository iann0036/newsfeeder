/**
 * @file	GroupPlaceholderController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find group placeholders.
 */

#ifndef LIBNFDB_GROUPPLACEHOLDERCONTROLLER
#define LIBNFDB_GROUPPLACEHOLDERCONTROLLER

#include "GroupPlaceholder.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>

namespace nfdb {

/**
 * A class called to create, update, delete or find group placeholders.
 */
class GroupPlaceholderController
{
	public:
		/**
		 * Initialising Constructor for GroupPlaceholderController, opens a database connection
		 */
		GroupPlaceholderController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~GroupPlaceholderController();

		/**
		 * Find the group placeholder with that id
		 * @param id	primary key id of the group placeholder
		 * @return the group placeholder with that id
		 */
		GroupPlaceholder GetGroupPlaceholderById(int id);

		/**
		 * Find all group placeholders
		 * @return all group placeholders in the database
		 */
		std::vector<GroupPlaceholder> GetAllGroupPlaceholders();

		/**
		 * Insert the group placeholder into the database
		 * @param groupPlaceholder	group placeholder to be added to the database
		 */
		void AddGroupPlaceholder(GroupPlaceholder& groupPlaceholder);

		/**
		 * Update the relevant group placeholder in the database
		 * @param groupPlaceholder	group placeholder to be updated
		 */
		void UpdateGroupPlaceholder(GroupPlaceholder& groupPlaceholder);

		/**
		 * Delete the group placeholder from the database
		 * @param groupPlaceholder	group placeholder to be removed from the database
		 */
		void RemoveGroupPlaceholder(GroupPlaceholder& groupPlaceholder);

		/**
		 * Generate a group placeholder based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a group placeholder
		 * @return the generated group placeholder
		 */
		GroupPlaceholder GenerateGroupPlaceholder(sql::ResultSet& rs);		

	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
