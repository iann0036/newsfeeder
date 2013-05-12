/**
 * @file	SheetController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find sheets.
 */

#ifndef LIBNFDB_SHEETCONTROLLER
#define LIBNFDB_SHEETCONTROLLER

#include "Sheet.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>
#include <string>

namespace nfdb {

/**
 * A class called to create, update, delete or find sheets.
 */
class SheetController
{
	public:
		/**
		 * Initialising Constructor for SheetController, opens a database connection
		 */
		SheetController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~SheetController();

		/**
		 * Find the sheet with that id
		 * @param id	primary key id of the sheet
		 * @return the sheet with that id
		 */
		Sheet* GetSheetById(int id);

		/**
		 * Find all sheets that belong to that user
		 * @param username	username of the user to find sheets for
		 * @return the sheets that belong to that user
		 */
		std::vector<Sheet*> GetSheetsByUsername(std::string username);

		/**
		 * Find all sheets
		 * @return all sheets in the database
		 */
		std::vector<Sheet*> GetAllSheets();

		/**
		 * Insert the sheet into the database
		 * @param sheet	sheet to be added to the database
		 * @return id of the newly added sheet, -1 for an error
		 */
		int AddSheet(Sheet& sheet);

		/**
		 * Update the relevant sheet in the database
		 * @param sheet	sheet to be updated
		 */
		void UpdateSheet(Sheet& sheet);

		/**
		 * Update the relevant sheet in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the sheet
		 * @param name	string representing the display name of the sheet, nullable
		 * @param username	string representing the username of the user this sheet relates to, nullable
		 * @param updated	datetime representing the time that sheet was last updated, nullable
		 * @param layoutid	int representing the identifier of the layout the sheet uses, nullable
		 */
		void UpdateSheet(int id, std::string* name, std::string* username, nfrd::misc::DateTime* updated, int* layoutId);

		/**
		 * Delete the sheet from the database
		 * @param sheet	sheet to be removed from the database
		 */
		void RemoveSheet(int id);

		/**
		 * Generate a sheet based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a sheet
		 * @return the generated sheet
		 */
		Sheet* GenerateSheet(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
