#include "ItemController.h"
#include <cppconn/prepared_statement.h>
#include <cppconn/exception.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for ItemController, opens a database connection
 */
ItemController::ItemController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
ItemController::~ItemController()
{
	delete dbc;
}

/**
 * Find the item with that id
 */
Item* ItemController::GetItemById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM items WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If there is an item matching the id, return it
			Item* i = GenerateItem(*rs);
			delete rs;
			return i;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all items that belong to the feed of that id
 */
vector<Item*> ItemController::GetItemsByFeedId(int feedId)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM items WHERE feedid = ?");
	
	stmt->setInt(1, feedId);

	ResultSet* rs = stmt->executeQuery();

	vector<Item*> items;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add returned items to a vector
			items.push_back(GenerateItem(*rs));
		}
	}

	delete stmt;
	delete rs;

	return items;

}

/**
 * Find all items
 */
vector<Item*> ItemController::GetAllItems()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM items");

	vector<Item*> items;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all items to a vector
			items.push_back(GenerateItem(*rs));
		}
	}
	
	delete stmt;
	delete rs;

	return items;
}

/**
 * Insert the item into the database
 */
int ItemController::AddItem(Item& item)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO items (feedid, title, url, content, postdate, author, geolocation) VALUES (?,?,?,?,?,?,?)");
	
	//Populate the query with the values of the passed item
	stmt->setInt(1, item.feedId);
	stmt->setString(2, item.title);
	stmt->setString(3, item.url);
	stmt->setString(4, item.content);
	if(item.postDate != NULL)
	{
		stmt->setString(5, item.postDate->ExportToMySQL());
	}
	else
	{
		stmt->setNull(5, 0);
	}
	if(item.author != NULL)
	{
		stmt->setString(6, *item.author);
	}
	else
	{
		stmt->setNull(6, 0);
	}
	if(item.geolocation != NULL)
	{
		stmt->setString(7, *item.geolocation);
	}
	else
	{
		stmt->setNull(7, 0);
	}

	//Catch any exceptions from the inser
	try
	{
		stmt->executeUpdate();
	}
	catch(SQLException& e)
	{
		//Free the stmt to prevent a memory leak
		delete stmt;
		throw e;
	}

	delete stmt;

	//Create another statement that gets the id of the inserted item
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
 * Update the relevant item in the database
 */
void ItemController::UpdateItem(Item& item)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE items SET feedid = ?, title = ?, url = ?, content = ?, postdate = ?, author = ?, geolocation = ? WHERE id = ?");
	
	//Populate the query based on the passed item
	stmt->setInt(1, item.feedId);
	stmt->setString(2, item.title);
	stmt->setString(3, item.url);
	stmt->setString(4, item.content);
	//If the value is nullable, ensure query values are set to null
	if(item.postDate != NULL)
	{
		stmt->setString(5, item.postDate->ExportToMySQL());
	}
	else
	{
		stmt->setNull(5, 0);
	}
	if(item.author != NULL)
	{
		stmt->setString(6, *item.author);
	}
	else
	{
		stmt->setNull(6, 0);
	}
	if(item.geolocation != NULL)
	{
		stmt->setString(7, *item.geolocation);
	}
	else
	{
		stmt->setNull(7, 0);
	}
	stmt->setInt(8, item.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant item in the database, NULLs passed if that parameter is not to be updated
 */
void ItemController::UpdateItem(int id, int* feedId, string* title, string* url, string* content, nfrd::misc::DateTime* postDate, string* author, string* geolocation)
{
	//Generate the update query based on parameters
	string query = "UPDATE items SET ";
	//If the value passed is null, set that field to its current value
	if(feedId != NULL)
	{
		query += "feedid = ?";
	}
	else
	{
		query += "feedid = feedid";
	}
	if(title != NULL)
	{
		query += ", title = ?";
	}
	else
	{
		query += ", title = title";
	}
	if(url != NULL)
	{
		query += ", url = ?";
	}
	else
	{
		query += ", url = url";
	}
	if(content != NULL)
	{
		query += ", content = ?";
	}
	else
	{
		query += ", content = content";
	}
	if(postDate != NULL)
	{
		query += ", postdate = ?";
	}
	else
	{
		query += ", postdate = postdate";
	}
	if(author != NULL)
	{
		query += ", author = ?";
	}
	else
	{
		query += ", author = author";
	}
	if(geolocation != NULL)
	{
		query += ", geolocation = ?";
	}
	else
	{
		query += ", geolocation = geolocation";
	}
	query += " WHERE id = ?";

	PreparedStatement* stmt = conn->prepareStatement(query);
	
	int param = 1;
	//Populate the query values based on input
	if(feedId != NULL)
	{
		stmt->setInt(param, *feedId);
		param++;
	}
	if(title != NULL)
	{
		stmt->setString(param, *title);
		param++;
	}
	if(url != NULL)
	{
		stmt->setString(param, *url);
		param++;
	}
	if(content != NULL)
	{
		stmt->setString(param, *content);
		param++;
	}
	if(postDate != NULL)
	{
		stmt->setString(param, postDate->ExportToMySQL());
		param++;
	}
	if(author != NULL)
	{
		stmt->setString(param, *author);
		param++;
	}
	if(geolocation != NULL)
	{
		stmt->setString(param, *geolocation);
		param++;
	}
	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the item from the database
 */
void ItemController::RemoveItem(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM items WHERE id = ?");
	
	stmt->setInt(1, id);
	//Delete by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Generate a item based on the data in a result set row
 */
Item* ItemController::GenerateItem(ResultSet& rs)
{
	Item* i = new Item();
	//Populate the new item from the results
	i->id = rs.getInt("id");
	i->feedId = rs.getInt("feedid");
	i->title = rs.getString("title");
	i->url = rs.getString("url");
	i->content = rs.getString("content");
	//Allow nullable fields to be set if provided
	if(!rs.isNull("postdate"))
	{
		i->postDate = new nfrd::misc::DateTime();
		i->postDate->ImportFromMySQL(rs.getString("postdate"));
	}
	if(!rs.isNull("author"))
	{
		i->author = new string(rs.getString("author"));
	}
	if(!rs.isNull("geolocation"))
	{
		i->geolocation = new string(rs.getString("geolocation"));
	}

	return i;
}

