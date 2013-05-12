/**
 * @file	User.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a User record
 */

#ifndef LIBNFDB_USER
#define LIBNFDB_USER

#include <string>
#include "nfrd/DateTime.h"

namespace nfdb {

/**
 * A class representing a row in the User table
 */
class User
{
	public:
		std::string username;
		std::string password;
		char* picture;
		int pictureSize;
		nfrd::misc::DateTime registered;
		std::string realname;
		std::string email;
		int layout;
		bool admin;
		bool https;

		/**
		 * Initialising Constructor for User, sets picture to NULL
		 */
		User()
		{
			picture = NULL;
		}

		/**
		 * Non-Default Constructor for User
		 * @param username	string identifier of the user
		 * @param password	string representing the password of this user
		 * @param picture	char* representing this users avatar, nullable
		 * @param pictureSize	int representing the size in bytes of this users avatar, 0 for no picture
		 * @param registered	datetime representing the date this user registered
		 * @param realname	string representing the full name of this user
		 * @param email	string representing the email address of this user
		 * @param layout	int representing the which layout, dark or light, the user is using
		 * @param admin	bool representing whether this user is an administrator
		 * @param https	bool representing whether this user has ssl activated on their account
		 */
		User(std::string username, std::string password, char* picture, int pictureSize, nfrd::misc::DateTime registered, std::string realname, std::string email, int layout, bool admin, bool https)
		{
			this->username = username;
			this->password = password;
			this->picture = picture;
			this->pictureSize = pictureSize;
			this->registered = registered;
			this->realname = realname;
			this->email = email;
			this->layout = layout;
			this->admin = admin;
			this->https = https;
		}
		
		/**
		 * Destructor for User, does not perform any actions
		 */
		~User()
		{
			//Commented out to stop any issues regarding auto pointers freeing inappropriately
			//Destroy();
		}

		/**
		 * Cleans up any memory held by the User
		 */
		void Destroy()
		{
			if(picture != NULL)
			{
				delete[] picture;
				picture = NULL;
			}
		}
};

}

#endif
