/**
 * @file	NotificationController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find notifications.
 */

#ifndef LIBNFDB_NOTIFICATIONCONTROLLER
#define LIBNFDB_NOTIFICATIONCONTROLLER

#include "Notification.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>
#include <string>

namespace nfdb {

/**
 * A class called to create, update, delete or find notifications.
 */
class NotificationController
{
	public:
		/**
		 * Initialising Constructor for NotificationController, opens a database connection
		 */
		NotificationController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~NotificationController();

		/**
		 * Find the notification with that id
		 * @param id	primary key id of the notification
		 * @return the notification with that id
		 */
		Notification* GetNotificationById(int id);

		/**
		 * Find all notifications that belong to the sheet of that id
		 * @param sheetId	id of the sheet to find notifications for
		 * @return the notifications that belong to that sheet
		 */
		std::vector<Notification*> GetNotificationsBySheetId(int sheetId);

		/**
		 * Find all notifications that belong to the user of that username
		 * @param username	username of the user to find notifications for
		 * @return the notifications that belong to that user
		 */
		std::vector<Notification*> GetNotificationsByUsername(std::string username);

		/**
		 * Find all notifications
		 * @return all notifications in the database
		 */
		std::vector<Notification*> GetAllNotifications();

		/**
		 * Insert the notification into the database
		 * @param notification	notification to be added to the database
		 * @return id of the newly added notification, -1 for an error
		 */
		int AddNotification(Notification& notification);

		/**
		 * Update the relevant notification in the database
		 * @param notification	notification to be updated
		 */
		void UpdateNotification(Notification& notification);

		/**
		 * Update the relevant notification in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the notification
		 * @param username	string representing the username of the user this notification relates to, nullable
		 * @param sheetId	int representing the id of the sheet this notification relates to, nullable
		 */
		void UpdateNotification(int id, std::string* username, int* sheetId);

		/**
		 * Delete the notification from the database
		 * @param id	id of the notification to be removed from the database
		 */
		void RemoveNotification(int id);

		/**
		 * Insert notifications based on the feed updated
		 * @param feedid	id of the feed that was updated
		 */
		void AddFeedUpdateNotifications(int feedid);

		/**
		 * Generate a notification based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a notification
		 * @return the generated notification
		 */
		Notification* GenerateNotification(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
