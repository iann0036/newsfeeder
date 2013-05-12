/**
 * @file	CommentController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to connect and disconnect from the database.
 */


#ifndef LIBNFDB_DATABASECONTROLLER
#define LIBNFDB_DATABASECONTROLLER

#include <cppconn/driver.h>
#include <cppconn/connection.h>
#include <string>

namespace nfdb {

/**
 * A class called to connect and disconnect from the database.
 */
class DatabaseController
{
	public:
		/**
		 * Initialising Constructor for DatabaseController
		 */
		DatabaseController();

		/**
		 * Deallocates any dynamic memory
		 */
		~DatabaseController();

		/**
		 * Connects to the database and returns the active connection
		 * @return the connection to the database
		 */
		sql::Connection* Connect();

		/**
		 * Disconnects from the database
		 */
		void Disconnect();
	private:
		/// Active connection to the database
		sql::Connection* conn;
		
		
};

}

#endif
