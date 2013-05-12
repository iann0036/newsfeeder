#include "SessionController.h"
#include <cppconn/prepared_statement.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for SessionController, opens a database connection
 */
SessionController::SessionController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
SessionController::~SessionController()
{
	delete dbc;
}

/**
 * Find the session with that id
 */
Session* SessionController::GetSessionById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM sessions WHERE id = ?");
	
	stmt->setInt(1, id);

	delete stmt;

	ResultSet* rs = stmt->executeQuery();

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If a session matches the id, return it
			Session* s = GenerateSession(*rs);
			delete rs;
			return s;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all sessions that belong to the item of that id
 */
vector<Session*> SessionController::GetSessionsByUsername(string username)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM sessions WHERE username = ?");
	
	stmt->setString(1, username);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	vector<Session*> sessions;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//For each matching session, add to a vector
			sessions.push_back(GenerateSession(*rs));
		}
		delete rs;
	}
	return sessions;

}

/**
 * Find the sessions with that key
 */
Session* SessionController::GetSessionByKey(string key)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM sessions WHERE key = ?");
	
	stmt->setString(1, key);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If a session matches that key, return it
			Session* s = GenerateSession(*rs);
			delete rs;
			return s;
		}
		delete rs;
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all sessions
 */
vector<Session*> SessionController::GetAllSessions()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM sessions");

	delete stmt;

	vector<Session*> sessions;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all sessions to a vector
			sessions.push_back(GenerateSession(*rs));
		}
		delete rs;
	}
	return sessions;
}

/**
 * Insert the session into the database
 */
int SessionController::AddSession(Session& session)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO sessions (username, key) VALUES (?,?)");
	
	stmt->setString(1, session.username);
	stmt->setString(2, session.key);
	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Create a statement to get the id of the inserted session
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
 * Update the relevant session in the database
 */
void SessionController::UpdateSession(Session& session)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE sessions SET username = ?, key = ?, time = ? WHERE id = ?");
	//Populate the query with values for the passed session
	stmt->setString(1, session.username);
	stmt->setString(2, session.key);
	stmt->setString(3, session.time.ExportToMySQL());
	stmt->setInt(4, session.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant session in the database, NULLs passed if that parameter is not to be updated
 */
void SessionController::UpdateSession(int id, string* username, string* key, nfrd::misc::DateTime* time)
{
	//Generate the update query
	string query = "UPDATE sessions SET ";

	//If the value is null, set the parameter to equal its current value
	if(username != NULL)
	{
		query += "username = ?";
	}
	else
	{
		query += "username = username";
	}
	if(key != NULL)
	{
		query += ", key = ?";
	}
	else
	{
		query += ", key = key";
	}
	if(time != NULL)
	{
		query += ", time = ?";
	}
	else
	{
		query += ", time = time";
	}
	query += " WHERE id = ?";

	//Add the values to the query
	PreparedStatement* stmt = conn->prepareStatement(query);
	int param = 1;
	if(username != NULL)
	{
		stmt->setString(param, *username);
		param++;
	}
	if(key != NULL)
	{
		stmt->setString(param, *key);
		param++;
	}
	if(key != NULL)
	{
		stmt->setString(param, time->ExportToMySQL());
		param++;
	}
	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the session from the database
 */
void SessionController::RemoveSession(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM sessions WHERE id = ?");
	
	stmt->setInt(1, id);
	//Delete by id
	stmt->executeUpdate();
}

/**
 * Generate a session based on the data in a result set row
 */
Session* SessionController::GenerateSession(ResultSet& rs)
{
	Session* s = new Session();
	//Populate the new session from the result set
	s->id = rs.getInt("id");
	s->username = rs.getString("username");
	s->key = rs.getString("key");
	s->time.ImportFromMySQL(rs.getString("time"));

	return s;
}

