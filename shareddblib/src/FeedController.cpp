#include "FeedController.h"
#include <cppconn/prepared_statement.h>
#include <sstream>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for FeedController, opens a database connection
 */
FeedController::FeedController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
FeedController::~FeedController()
{
	delete dbc;
}

/**
 * Find the feed with that id
 */
Feed* FeedController::GetFeedById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM feeds WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If there is a matching content placeholder return it
			Feed* f = GenerateFeed(*rs);
			delete rs;
			return f;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all feeds that are contained within that CPH
 */
vector<Feed*> FeedController::GetFeedsByCphId(int cphId)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT feeds.id AS id, feeds.url AS url, feeds.name AS name, feeds.frequency AS frequency, feeds.lastupdate AS lastupdate, feeds.category AS category, feeds.type AS TYPE , feeds.favicon AS favicon FROM feeds INNER JOIN cph_feeds ON feeds.id = cph_feeds.feedid WHERE cph_feeds.cphid = ?");
	
	stmt->setInt(1, cphId);
	//JOIN all relevant tables, find by cphId
	ResultSet* rs = stmt->executeQuery();

	vector<Feed*> feeds;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all results to a vector
			feeds.push_back(GenerateFeed(*rs));
		}
	}
	delete stmt;
	delete rs;
	return feeds;

}

/**
 * Find all feeds that belong to the user of that username
 */
vector<Feed*> FeedController::GetFeedsByUsername(string username)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT feeds.id AS id, feeds.url AS url, feeds.name AS name, feeds.frequency AS frequency, feeds.lastupdate AS lastupdate, feeds.category AS category, feeds.type AS TYPE , feeds.favicon AS favicon FROM feeds INNER JOIN userfeeds ON feeds.id = userfeeds.feedid WHERE userfeeds.username = ?");
	//Join onto the user table
	stmt->setString(1, username);

	ResultSet* rs = stmt->executeQuery();

	vector<Feed*> feeds;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all results to a vector
			feeds.push_back(GenerateFeed(*rs));
		}
	}
	delete stmt;
	delete rs;
	return feeds;

}

/**
 * Find all feeds
 */
vector<Feed*> FeedController::GetAllFeeds()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM feeds");

	vector<Feed*> feeds;
	if(rs != NULL)
	{
		while(rs->next())
		{	
			//Add all results to a vector
			feeds.push_back(GenerateFeed(*rs));
		}
	}

	delete stmt;
	delete rs;
	return feeds;
}

/**
 * Get all of the feeds which are newer than the passed id
 */
vector<Feed*> FeedController::GetNewFeeds(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM feeds WHERE id > ?");
	stmt->setInt(1, id);
	//Query for freshly added feeds (i.e. the ID is later than the current one)
	ResultSet* rs = stmt->executeQuery();

	vector<Feed*> feeds;
	if(rs != NULL)
	{
		while(rs->next())
		{	
			feeds.push_back(GenerateFeed(*rs));
		}
	}

	delete stmt;
	delete rs;
	return feeds;
}

/**
 * Find all feeds which are due to be crawled again
 */
vector<QueueItem*> FeedController::GetQueueFeeds()
{

	Statement* stmt = conn->createStatement();
	
	ResultSet* rs = stmt->executeQuery("SELECT id, frequency, type FROM feeds");
	
	vector<QueueItem*> feeds;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Get all feeds to populate the queue
			feeds.push_back(GenerateQueueItem(*rs));
		}
	}

	delete stmt;
	delete rs;
	return feeds;
}

/**
 * Insert the feed into the database
 */
int FeedController::AddFeed(Feed& feed)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO feeds (url, name, frequency, lastupdate, category, type, favicon) VALUES (?,?,?,?,?,?,?)");

	stmt->setString(1, feed.url);
	stmt->setString(2, feed.name);
	stmt->setInt(3, feed.frequency);
	//Allow for nullable values
	if(feed.lastUpdate != NULL)
	{
		stmt->setString(4, feed.lastUpdate->ExportToMySQL());
	}
	else
	{
		stmt->setNull(4, 0);
	}
	if(feed.category != NULL)
	{
		stmt->setString(5, *feed.category);
	}
	else
	{
		stmt->setNull(5, 0);
	}
	if(feed.type != NULL)
	{
		stmt->setInt(6, *feed.type);
	}
	else
	{
		stmt->setNull(6, 0);
	}
	if(feed.favIcon != NULL)
	{
		istringstream tempBlob(string(feed.favIcon, feed.iconSize));
		stmt->setBlob(7, &tempBlob);
	}
	else
	{
		stmt->setNull(7, 0);
	}
	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Perform another query to get the Id of the inserted row
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
 * Update the relevant feed in the database
 */
void FeedController::UpdateFeed(Feed& feed)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE feeds SET url = ?, name = ?, frequency = ?, lastupdate = ?, category = ?, type = ?, favIcon = ? WHERE id = ?");
	//Populate the query values based on input from the passed feed
	stmt->setString(1, feed.url);
	stmt->setString(2, feed.name);
	stmt->setInt(3, feed.frequency);
	//If the value is null, set it to the same value it is currently
	if(feed.lastUpdate != NULL)
	{
		stmt->setString(4, feed.lastUpdate->ExportToMySQL());
	}
	else
	{
		stmt->setNull(4, 0);
	}
	if(feed.category != NULL)
	{
		stmt->setString(5, *feed.category);
	}
	else
	{
		stmt->setNull(5, 0);
	}
	if(feed.type != NULL)
	{
		stmt->setInt(6, *feed.type);
	}
	else
	{
		stmt->setNull(6, 0);
	}
	if(feed.favIcon != NULL)
	{
		istringstream tempBlob(string(feed.favIcon, feed.iconSize));
		stmt->setBlob(7, &tempBlob);
	}
	else
	{
		stmt->setNull(7, 0);
	}

	stmt->setInt(8, feed.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant feed in the database, NULLs passed if that parameter is not to be updated
 */
void FeedController::UpdateFeed(int id, string* url, string* name, int* frequency, nfrd::misc::DateTime* lastUpdate, string* category, int* type, char* favIcon, int* iconSize)
{
	//Generate the query based on the provided parameters
	string query = "UPDATE users SET";
	if(url != NULL)
	{
		query += " url = ? ";
	}
	else
	{
		query += " url = url";
	}
	if(name != NULL)
	{
		query += ", name = ?";
	}
	else
	{
		query += ", name = name";
	}
	if(frequency != NULL)
	{
		query += ", frequency = ?";
	}
	else
	{
		query += ", frequency = frequency";
	}
	if(lastUpdate != NULL)
	{
		query += ", lastupdate = ?";
	}
	else
	{
		query += ", lastupdate = lastupdate";
	}
	if(category != NULL)
	{
		query += ", category = ?";
	}
	else
	{
		query += ", category = category";
	}
	if(type != NULL)
	{
		query += ", type = ?";
	}
	else
	{
		query += ", type = type";
	}
	if(favIcon != NULL)
	{
		query += ", favIcon = ?";
	}
	else
	{
		query += ", favIcon = favIcon";
	}
	
	query += " WHERE id = ?";

	PreparedStatement* stmt = conn->prepareStatement(query);
	int param = 1;
	//Populate the query values
	if(url != NULL)
	{
		stmt->setString(param, *url);
		param++;
	}
	if(name != NULL)
	{
		stmt->setString(param, *name);
		param++;
	}
	if(frequency != NULL)
	{
		stmt->setInt(param, *frequency);
		param++;
	}
	if(lastUpdate != NULL)
	{
		stmt->setString(param, lastUpdate->ExportToMySQL());
		param++;
	}
	if(category != NULL)
	{
		stmt->setString(param, *category);
		param++;
	}
	if(type != NULL)
	{
		stmt->setInt(param, *type);
		param++;
	}
	if(favIcon != NULL)
	{
		istringstream tempBlob(string(favIcon, *iconSize));
		stmt->setBlob(param, &tempBlob);
		param++;
	}

	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the feed from the database
 */
void FeedController::RemoveFeed(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM feeds WHERE id = ?");
	
	stmt->setInt(1, id);
	//Delete by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Generate a feed based on the data in a result set row
 */
Feed* FeedController::GenerateFeed(ResultSet& rs)
{
	Feed* f = new Feed();
	//Populate the new feed based on the result set
	f->id = rs.getInt("id");
	f->url = rs.getString("url");
	f->name = rs.getString("name");
	f->frequency = rs.getInt("frequency");
	if(!rs.isNull("lastupdate"))
	{
		f->lastUpdate = new nfrd::misc::DateTime();
		f->lastUpdate->ImportFromMySQL(rs.getString("lastupdate"));
	}
	if(!rs.isNull("category"))
	{
		f->category = new string(rs.getString("category"));
	}
	if(!rs.isNull("type"))
	{
		f->type = new int(rs.getInt("type"));
	}
	if(!rs.isNull("favicon"))
	{
		//Get blob and convert to char*
		istream* is = rs.getBlob("favicon");
		is->seekg(0, ios::end);
		int length = (int)is->tellg();
		is->seekg(0, ios::beg);
		char* buffer = new char[length];
		is->read(buffer, length);
		f->favIcon = buffer;
		f->iconSize = length;
		delete is;
	}

	return f;
}

/**
 * Generate a queue item based on the data in a result set row
 */
QueueItem* FeedController::GenerateQueueItem(ResultSet& rs)
{
	QueueItem* q = new QueueItem();
	//Create new queue item based on result
	q->id = rs.getInt("id");
	q->frequency = rs.getInt("frequency");
	if(!rs.isNull("type"))
	{
		q->type = new int(rs.getInt("type"));
	}
	q->numUsers = GetNumberOfFeedUsers(q->id);

	return q;	
}

/**
 * Get the number of users currently subscribed to that feed
 */
int FeedController::GetNumberOfFeedUsers(int id)
{
	//JOIN to users table and query for count of distinct users using this feed
	PreparedStatement* stmt = conn->prepareStatement("SELECT COUNT(DISTINCT users.username) FROM feeds JOIN cph_feeds ON feeds.id = cph_feeds.feedid JOIN cph ON cph.id = cph_feeds.cphid JOIN sheets ON sheets.id = cph.sheetid JOIN users ON users.username = sheets.username WHERE feeds.id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//Get count and return
			int num = rs->getInt("COUNT(DISTINCT users.username)");
			delete rs;
			return num;
		}
	}
	else
	{
		return 0;
	}	

	return 0;
}

/**
 * Touch the feed, setting lastupdate to now
 */
void FeedController::UpdateLastUpdateTime(int feedid)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE feeds SET lastupdate = now() WHERE id = ?");
	//Update the lastupdate time to NOW
	stmt->setInt(1, feedid);

	stmt->executeUpdate();

	delete stmt;
}
