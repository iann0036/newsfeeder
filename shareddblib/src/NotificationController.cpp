#include "NotificationController.h"
#include <cppconn/prepared_statement.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for NotificationController, opens a database connection
 */
NotificationController::NotificationController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
NotificationController::~NotificationController()
{
	delete dbc;
}

/**
 * Find the notification with that id
 */
Notification* NotificationController::GetNotificationById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM notifications WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If a notification matches the id, return it
			Notification* n = GenerateNotification(*rs);
			delete rs;
			return n;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all notifications that belong to the sheet of that id
 */
vector<Notification*> NotificationController::GetNotificationsBySheetId(int sheetId)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM notifications WHERE sheetid = ?");
	
	stmt->setInt(1, sheetId);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	vector<Notification*> notifications;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add matching notifications to a vector
			notifications.push_back(GenerateNotification(*rs));
		}
		delete rs;
	}
	return notifications;
}

/**
 * Find all notifications that belong to the user of that username
 */
vector<Notification*> NotificationController::GetNotificationsByUsername(string username)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM notifications WHERE username = ?");
	
	stmt->setString(1, username);

	ResultSet* rs = stmt->executeQuery();

	vector<Notification*> notifications;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all matching notifications to a vector
			notifications.push_back(GenerateNotification(*rs));
		}
		delete rs;
	}
	return notifications;

}

/**
 * Find all notifications
 */
vector<Notification*> NotificationController::GetAllNotifications()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM notifications");

	delete stmt;

	vector<Notification*> notifications;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all notifications to a vector
			notifications.push_back(GenerateNotification(*rs));
		}
		delete rs;
	}
	return notifications;
}

/**
 * Insert the notification into the database
 */
int NotificationController::AddNotification(Notification& notification)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO notifications (sheetid, username) VALUES (?,?)");
	
	stmt->setInt(1, notification.sheetId);
	stmt->setString(2, notification.username);

	stmt->executeUpdate();

	delete stmt;

	//Create another statement to get the ID of the inserted notification
	Statement* lastStmt = conn->createStatement();
	ResultSet* rs = lastStmt->executeQuery("SELECT LAST_INSERT_ID()");
	if(rs != NULL)
	{
		while(rs->next())
		{
			int lastId = rs->getInt("LAST_INSERT_ID()");
			delete rs;
			delete lastStmt;
			return lastId;
		}
	}
	else
	{
		delete lastStmt;
		return -1;
	}

	return -1;
}

/**
 * Update the relevant notification in the database
 */
void NotificationController::UpdateNotification(Notification& notification)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE notifications SET sheetid = ?, username = ? WHERE id = ?");
	//Populate the query with the values from the passed notification
	stmt->setInt(1, notification.sheetId);
	stmt->setString(2, notification.username);
	stmt->setInt(3, notification.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant notification in the database, NULLs passed if that parameter is not to be updated
 */
void NotificationController::UpdateNotification(int id, string* username, int* sheetId)
{
	//Generate the update query
	string query = "UPDATE notifications SET ";

	//If values are null set the value to the current value
	if(sheetId != NULL)
	{
		query += "sheetid = ?";
	}
	else
	{
		query += "sheetid = sheetid";
	}
	if(username != NULL)
	{
		query += ", username = ?";
	}
	else
	{
		query += ", username = username";
	}
	query += " WHERE id = ?";

	//Add values to the generated query
	PreparedStatement* stmt = conn->prepareStatement(query);
	int param = 1;
	if(sheetId != NULL)
	{
		stmt->setInt(param, *sheetId);
		param++;
	}
	if(username != NULL)
	{
		stmt->setString(param, *username);
		param++;
	}
	stmt->setInt(param, id);

	stmt->executeUpdate();
	
	delete stmt;
}

/**
 * Delete the notification from the database
 */
void NotificationController::RemoveNotification(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM notifications WHERE id = ?");
	
	stmt->setInt(1, id);
	//Delete by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Insert notifications based on the feed updated
 */
void NotificationController::AddFeedUpdateNotifications(int feedid)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT sheets.username AS username, sheets.id AS sheetid FROM sheets INNER JOIN cph ON sheets.id = cph.sheetid INNER JOIN cph_feeds ON cph.id = cph_feeds.cphid WHERE cph_feeds.feedid = ?");
	
	stmt->setInt(1, feedid);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		//Loop through all sheets that contain this feed
		while(rs->next())
		{
			//For each, insert a new notification
			stmt = conn->prepareStatement("INSERT IGNORE INTO notification (sheetid, username) VALUES (?, ?)");
			stmt->setInt(1, rs->getInt("sheetid"));
			stmt->setString(2, rs->getString("username"));

			stmt->executeUpdate();

			delete stmt;
		}
		delete rs;
	}

}

/**
 * Generate a notification based on the data in a result set row
 */
Notification* NotificationController::GenerateNotification(ResultSet& rs)
{
	Notification* n = new Notification();
	//Populate the new notification using the result set
	n->id = rs.getInt("id");
	n->sheetId = rs.getInt("sheetid");
	n->username = rs.getString("username");

	return n;
}

