/**
 * @file	UserController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find users.
 */

#ifndef LIBNFDB_USERCONTROLLER
#define LIBNFDB_USERCONTROLLER

#include "User.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>
#include <string>

namespace nfdb {

/**
 * A class called to create, update, delete or find users.
 */
class UserController
{
	public:
		/**
		 * Initialising Constructor for UserController, opens a database connection
		 */
		UserController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~UserController();

		/**
		 * Find the user with that id
		 * @param id	primary key id of the user
		 * @return the user with that id
		 */
		User* GetUserByUsername(std::string username);

		/**
		 * Find all users
		 * @return all users in the database
		 */
		std::vector<User*> GetAllUsers();

		/**
		 * Insert the user into the database
		 * @param user	user to be added to the database
		 * @return id of the newly added user, -1 for an error
		 */
		int AddUser(User& user);

		/**
		 * Update the relevant user in the database
		 * @param user	user to be updated
		 */
		void UpdateUser(User& user);

		/**
		 * Update the relevant user in the database, NULLs passed if that parameter is not to be updated
		 * @param username	string identifier of the user
		 * @param password	string representing the password of this user, nullable
		 * @param picture	char* representing this users avatar, nullable
		 * @param pictureSize	int representing the size in bytes of this users avatar, 0 for no picture
		 * @param registered	datetime representing the date this user registered, nullable
		 * @param realname	string representing the full name of this user, nullable
		 * @param email	string representing the email address of this user, nullable
		 * @param layout	int representing the which layout, dark or light, the user is using, nullable
		 * @param admin	bool representing whether this user is an administrator, nullable
		 * @param https	bool representing whether this user has ssl activated on their account, nullable
		 */
		void UpdateUser(std::string username, std::string* password, char* picture, int* pictureSize, nfrd::misc::DateTime* registered, std::string* realname, std::string* email, int* layout, bool* admin, bool* https);

		/**
		 * Delete the user from the database
		 * @param user	user to be removed from the database
		 */
		void RemoveUser(std::string username);

		/**
		 * Get the current number of users in the database
		 * @return	the number of users in the database
		 */
		int GetNumberOfUsers();

		/**
		 * Generate a user based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a user
		 * @return the generated user
		 */
		User* GenerateUser(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
