/**
 * @file	SessionController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find sessions.
 */

#ifndef LIBNFDB_SESSIONCONTROLLER
#define LIBNFDB_SESSIONCONTROLLER

#include "Session.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>
#include <string>

namespace nfdb {

/**
 * A class called to create, update, delete or find sessions.
 */
class SessionController
{
	public:
		/**
		 * Initialising Constructor for SessionController, opens a database connection
		 */
		SessionController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~SessionController();

		/**
		 * Find the session with that id
		 * @param id	primary key id of the session
		 * @return the session with that id
		 */
		Session* GetSessionById(int id);

		/**
		 * Find all sessions that belong to the item of that id
		 * @param username	username of the user to find sessions for
		 * @return the sessions that belong to that user
		 */
		std::vector<Session*> GetSessionsByUsername(std::string username);

		/**
		 * Find the sessions with that key
		 * @param key	key of the session
		 * @return the session with that key
		 */
		Session* GetSessionByKey(std::string key);

		/**
		 * Find all sessions
		 * @return all sessions in the database
		 */
		std::vector<Session*> GetAllSessions();

		/**
		 * Insert the session into the database
		 * @param session	session to be added to the database
		 * @return id of the newly added session, -1 for an error
		 */
		int AddSession(Session& session);

		/**
		 * Update the relevant session in the database
		 * @param session	session to be updated
		 */
		void UpdateSession(Session& session);

		/**
		 * Update the relevant session in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the session
		 * @param username	string representing the username of the user this session relates to, nullable
		 * @param key	string representing the unique key of the session, nullable
		 * @param time	datetime representing the time the session was created, nullable
		 */
		void UpdateSession(int id, std::string* username, std::string* key, nfrd::misc::DateTime* time);

		/**
		 * Delete the session from the database
		 * @param session	session to be removed from the database
		 */
		void RemoveSession(int id);

		/**
		 * Generate a session based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a session
		 * @return the generated session
		 */
		Session* GenerateSession(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
