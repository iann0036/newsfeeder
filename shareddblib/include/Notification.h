/**
 * @file	Notification.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Notification record
 */

#ifndef LIBNFDB_NOTIFICATION
#define LIBNFDB_NOTIFICATION

#include <string>

namespace nfdb {

/**
 * A class representing a row in the Notification table
 */
class Notification
{
	public:
		int id;
		std::string username;
		int sheetId;

		/**
		 * Initialising Constructor for Notification
		 */
		Notification()
		{
		}
		
		/**
		 * Non-Default Constructor for Notification
		 * @param id	int identifier of the notification
		 * @param username	string representing the username of the user this notification relates to
		 * @param sheetId	int representing the id of the sheet this notification relates to
		 */
		Notification(int id, std::string username, int sheetId)
		{
			this->id = id;
			this->username = username;
			this->sheetId = sheetId;
		}

		/**
		 * Destructor for Notification, does not perform any actions
		 */
		~Notification()
		{
		}

		/**
		 * Cleans up any memory held by the Notification
		 */
		void Destroy()
		{
		}
};

}

#endif

