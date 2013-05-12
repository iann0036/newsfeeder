/**
 * @file	ContentPlaceholderController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find content placeholders.
 */


#ifndef LIBNFDB_CONTENTPLACEHOLDERCONTROLLER
#define LIBNFDB_CONTENTPLACEHOLDERCONTROLLER

#include "ContentPlaceholder.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>

namespace nfdb {

/**
 * A class called to create, update, delete or find content placeholders.
 */
class ContentPlaceholderController
{
	public:
		/**
		 * Initialising Constructor for ContentPlaceholderController, opens a database connection
		 */
		ContentPlaceholderController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~ContentPlaceholderController();

		/**
		 * Find the content placeholder with that id
		 * @param id	primary key id of the content placeholder
		 * @return the content placeholder with that id
		 */
		ContentPlaceholder* GetContentPlaceholderById(int id);

		/**
		 * Find all content placeholders that belong to the sheet of that id
		 * @param sheetId	id of the sheet to find content placeholders for
		 * @return the content placeholders that belong to that sheet
		 */
		std::vector<ContentPlaceholder*> GetContentPlaceholdersBySheetId(int sheetId);

		/**
		 * Find all content placeholders
		 * @return all content placeholders in the database
		 */
		std::vector<ContentPlaceholder*> GetAllContentPlaceholders();

		/**
		 * Insert the content placeholder into the database
		 * @param content placeholder	content placeholder to be added to the database
		 * @return id of the added content placeholder, -1 for error
		 */
		int AddContentPlaceholder(ContentPlaceholder& contentPlaceholder);

		/**
		 * Update the relevant content placeholder in the database
		 * @param contentPlaceholder	content placeholder to be updated
		 */
		void UpdateContentPlaceholder(ContentPlaceholder& contentPlaceholder);

		/**
		 * Update the relevant content placeholder in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the contentplaceholder
		 * @param sheetId	int representing the id of the sheet this placeholder is located on, nullable
		 * @param type	int representing what type of content placeholder it is, nullable
		 * @param column	int representing which column the placeholder is located in, nullable
		 * @param order	int representing what order this placeholder is in the column, nullable
		 */
		void UpdateContentPlaceholder(int id, int* sheetId, int* wid, bool* column, int* order);

		/**
		 * Delete the content placeholder from the database
		 * @param contentPlaceholder	content placeholder to be removed from the database
		 */
		void RemoveContentPlaceholder(int id);

		/**
		 * Generate a content placeholder based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a content placeholder
		 * @return the generated content placeholder
		 */
		ContentPlaceholder* GenerateContentPlaceholder(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
