/**
 * @file	Sheet.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Sheet record
 */

#ifndef LIBNFDB_SHEET
#define LIBNFDB_SHEET

#include <string>
#include "nfrd/DateTime.h"

namespace nfdb {

/**
 * A class representing a row in the Sheet table
 */
class Sheet
{
	public:
		int id;
		std::string name;
		std::string username;
		nfrd::misc::DateTime updated;
		int layoutId;

		/**
		 * Initialising Constructor for Sheet
		 */
		Sheet()
		{
		}
	
		/**
		 * Non-Default Constructor for Sheet
		 * @param id	int identifier of the sheet
		 * @param name	string representing the display name of the sheet
		 * @param username	string representing the username of the user this sheet relates to
		 * @param updated	datetime representing the time that sheet was last updated
		 * @param layoutid	int representing the identifier of the layout the sheet uses
		 */
		Sheet(int id, std::string name, std::string username, nfrd::misc::DateTime updated, int layoutId)
		{
			this->id = id;
			this->name = name;
			this->username = username;
			this->updated = updated;
			this->layoutId = layoutId;
		}

		/**
		 * Destructor for Sheet, does not perform any actions
		 */
		~Sheet()
		{
		}

		/**
		 * Cleans up any memory held by the Sheet
		 */
		void Destroy()
		{
		}
};

}

#endif
