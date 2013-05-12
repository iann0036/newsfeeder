#include "UserController.h"
#include <cppconn/prepared_statement.h>
#include <iostream>
#include <sstream>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for UserController, opens a database connection
 */
UserController::UserController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
UserController::~UserController()
{
	delete dbc;
}

/**
 * Find the user with that id
 */
User* UserController::GetUserByUsername(string username)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM users WHERE username = ?");
	
	stmt->setString(1, username);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If a user matches the username, return it
			User* u = GenerateUser(*rs);
			delete rs;
			return u;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all users
 */
vector<User*> UserController::GetAllUsers()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM users");

	vector<User*> Users;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all users to a vector
			Users.push_back(GenerateUser(*rs));
		}
	}

	delete stmt;
	delete rs;
	return Users;
}

/**
 * Insert the user into the database
 */
int UserController::AddUser(User& user)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO users (password, picture, realname, email) VALUES (?,?,?,?)");
	
	//Populate the query from the passed user
	stmt->setString(1, user.password);
	if(user.picture != NULL)
	{
		//Convert the char* into an istream
		istringstream tempBlob(string(user.picture, user.pictureSize));
		stmt->setBlob(2, &tempBlob);
	}
	else
	{
		stmt->setNull(2, 0);
	}
	stmt->setString(3, user.realname);
	stmt->setString(4, user.email);
	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Create new query to get the id of the inserted user
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
 * Update the relevant user in the database
 */
void UserController::UpdateUser(User& user)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE users SET password = ?, picture = ?, registered = ?, realname = ?, email = ?, layout = ?, admin = ?, https = ? WHERE username = ?");
	
	//Populate the query using the passed user
	stmt->setString(1, user.password);
	if(user.picture != NULL)
	{
		//Convert char* to istream
		istringstream tempBlob(string(user.picture, user.pictureSize));
		stmt->setBlob(2, &tempBlob);
	}
	else
	{
		stmt->setNull(2, 0);
	}
	stmt->setString(3, user.registered.ExportToMySQL());
	stmt->setString(4, user.realname);
	stmt->setString(5, user.email);
	stmt->setInt(6, user.layout);
	stmt->setBoolean(7, user.admin);
	stmt->setBoolean(8, user.https);
	stmt->setString(9, user.username);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant user in the database, NULLs passed if that parameter is not to be updated
 */
void UserController::UpdateUser(string username, string* password, char* picture, int* pictureSize, nfrd::misc::DateTime* registered, string* realname, string* email, int* layout, bool* admin, bool* https)
{
	//Generate the update query
	string query = "UPDATE users SET";
	//If the value is null set that column to its existing value
	if(password != NULL)
	{
		query += " password = ? ";
	}
	else
	{
		query += " password = password";
	}
	if(picture != NULL)
	{
		query += ", picture = ?";
	}
	else
	{
		query += ", picture = picture";
	}
	if(registered != NULL)
	{
		query += ", registered = ?";
	}
	else
	{
		query += ", registered = registered";
	}
	if(realname != NULL)
	{
		query += ", realname = ?";
	}
	else
	{
		query += ", realname = realname";
	}
	if(email != NULL)
	{
		query += ", email = ?";
	}
	else
	{
		query += ", email = email";
	}
	if(layout != NULL)
	{
		query += ", layout = ?";
	}
	else
	{
		query += ", layout = layout";
	}
	if(admin != NULL)
	{
		query += ", admin = ?";
	}
	else
	{
		query += ", admin = admin";
	}
	if(https != NULL)
	{
		query += ", https = ?";
	}
	else
	{
		query += ", https = https";
	}
	
	query += " WHERE username = ?";
	PreparedStatement* stmt = conn->prepareStatement(query);
	int param = 1;	
	//Populate the query values
	if(password != NULL)
	{
		stmt->setString(param, *password);
		param++;
	}
	if(picture != NULL)
	{
		istringstream tempBlob(string(picture, *pictureSize));
		stmt->setBlob(param, &tempBlob);
		param++;
	}
	if(registered != NULL)
	{
		stmt->setString(param, registered->ExportToMySQL());
		param++;
	}
	if(realname != NULL)
	{
		stmt->setString(param, *realname);
		param++;
	}
	if(email != NULL)
	{
		stmt->setString(param, *email);
		param++;
	}
	if(layout != NULL)
	{
		stmt->setInt(param, *layout);
		param++;
	}
	if(admin != NULL)
	{
		stmt->setBoolean(param, *admin);
		param++;
	}
	if(https != NULL)
	{
		stmt->setBoolean(param, *https);
		param++;
	}
	if(username != NULL)
	{
		stmt->setString(param, username);
		param++;
	}

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the user from the database
 */
void UserController::RemoveUser(string username)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM users WHERE username = ?");
	
	stmt->setString(1, username);
	//Delete by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Get the current number of users in the database
 */
int UserController::GetNumberOfUsers()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT COUNT(*) AS numusers FROM users");
	
	int numUsers = 0;
	while(rs->next())
	{
		//Get the user count
		numUsers = rs->getInt("numusers");
	}
	
	delete stmt;
	delete rs;

	return numUsers;
}

/**
 * Generate a user based on the data in a result set row
 */
User* UserController::GenerateUser(ResultSet& rs)
{
	User* u = new User;
	//Populate the new user from the result set
	u->username = rs.getString("username");
	u->password = rs.getString("password");

	if(!rs.isNull("picture"))
	{
		//If the picture is provided, convert the blob into a char*
		istream* is = rs.getBlob("picture");
		is->seekg(0, ios::end);
		int length = (int)is->tellg();
		is->seekg(0, ios::beg);
		char* buffer = new char[length];
		is->read(buffer, length);
		u->picture = buffer;
		u->pictureSize = length;
		delete is;
	}
	u->registered.ImportFromMySQL(rs.getString("registered"));
	u->realname = rs.getString("realname");
	u->email = rs.getString("email");
	u->layout = rs.getInt("layout");
	u->admin = rs.getBoolean("admin");
	u->https = rs.getBoolean("https");

	return u;
}

