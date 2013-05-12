#include "StatController.h"
#include <cppconn/prepared_statement.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for StatController, opens a database connection
 */
StatController::StatController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
StatController::~StatController()
{
	delete dbc;
}

/**
 * Find the stat with that id
 */
Stat* StatController::GetStatById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM stats WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If a stat matches this id, return it
			Stat* s = GenerateStat(*rs);
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
 * Find the latest statistic
 */
Stat* StatController::GetLatestStat()
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM stats ORDER BY id DESC LIMIT 1");

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//Return the latest statistic (by id)
			Stat* s = GenerateStat(*rs);
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
 * Find all stats
 */
vector<Stat*> StatController::GetAllStats()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM stats");

	delete stmt;

	vector<Stat*> stats;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all stats to a vector
			stats.push_back(GenerateStat(*rs));
		}
		delete rs;
	}
	return stats;
}

/**
 * Insert the stat into the database
 */
int StatController::AddStat(Stat& stat)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO stats (users, sheets, feeds, items, comments) VALUES (?,?,?,?,?)");
	//Populate the query based on the passed stat
	stmt->setInt(1, stat.users);
	stmt->setInt(2, stat.sheets);
	stmt->setInt(3, stat.feeds);
	stmt->setInt(4, stat.items);
	stmt->setInt(5, stat.comments);
	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Create another query to get the ID of the inserted stat
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
 * Update the relevant stat in the database
 */
void StatController::UpdateStat(Stat& stat)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE stats SET users = ?, sheets = ?, feeds = ?, items = ?, comments = ? WHERE id = ?");
	//Populate the query values using the passed stat
	stmt->setInt(1, stat.users);
	stmt->setInt(2, stat.sheets);
	stmt->setInt(3, stat.feeds);
	stmt->setInt(4, stat.items);
	stmt->setInt(5, stat.comments);
	stmt->setInt(6, stat.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant stat in the database, NULLs passed if that parameter is not to be updated
 */
void StatController::UpdateStat(int id, int* users, int* sheets, int* feeds, int* items, int* comments)
{
	//Generate the update query
	string query = "UPDATE stats SET ";
	//If values are null, set the columns to equal their existing values
	if(users != NULL)
	{
		query += "users = ?";
	}
	else
	{
		query += "users = users";
	}
	if(sheets != NULL)
	{
		query += ", sheets = ?";
	}
	else
	{
		query += ", sheets = sheets";
	}
	if(feeds != NULL)
	{
		query += ", feeds = ?";
	}
	else
	{
		query += ", feeds = feeds";
	}
	if(items != NULL)
	{
		query += ", items = ?";
	}
	else
	{
		query += ", items = items";
	}
	if(comments != NULL)
	{
		query += ", comments = ?";
	}
	else
	{
		query += ", comments = comments";
	}
	query += " WHERE id = ?";

	//Add the values to the statement
	PreparedStatement* stmt = conn->prepareStatement(query);
	int param = 1;
	if(users != NULL)
	{
		stmt->setInt(param, *users);
		param++;
	}
	if(sheets != NULL)
	{
		stmt->setInt(param, *sheets);
		param++;
	}
	if(feeds != NULL)
	{
		stmt->setInt(param, *feeds);
		param++;
	}
	if(items != NULL)
	{
		stmt->setInt(param, *items);
		param++;
	}
	if(comments != NULL)
	{
		stmt->setInt(param, *comments);
		param++;
	}
	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the stat from the database
 */
void StatController::RemoveStat(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM stats WHERE id = ?");
	
	stmt->setInt(1, id);
	//Delete by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Generate the new statistics and store in the database
 */
void StatController::GenerateNewStat()
{
	Statement* stmt = conn->createStatement();
	//Get the counts of users, sheets, feeds, items and comments and insert into the database
	stmt->executeUpdate("INSERT INTO stats (users, sheets, feeds, items, comments) VALUES ((SELECT count(*) FROM users), (SELECT count(*) FROM sheets), (SELECT count(*) FROM feeds), (SELECT count(*) FROM items), (SELECT count(*) FROM comments))");

	delete stmt;
}

/**
 * Generate a stat based on the data in a result set row
 */
Stat* StatController::GenerateStat(ResultSet& rs)
{
	Stat* s = new Stat();
	//Populate the values of the new statistic from the result set
	s->id = rs.getInt("id");
	s->users = rs.getInt("users");
	s->sheets = rs.getInt("sheets");
	s->feeds = rs.getInt("feeds");
	s->items = rs.getInt("items");
	s->comments = rs.getInt("comments");

	return s;
}

