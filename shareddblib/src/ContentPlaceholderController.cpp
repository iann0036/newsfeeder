#include "ContentPlaceholderController.h"
#include <cppconn/prepared_statement.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for ContentPlaceholderController, opens a database connection
 */
ContentPlaceholderController::ContentPlaceholderController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
ContentPlaceholderController::~ContentPlaceholderController()
{
	delete dbc;
}

/**
 * Find the content placeholder with that id
 */
ContentPlaceholder* ContentPlaceholderController::GetContentPlaceholderById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM cph WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//Return the content placeholder retrieved by the query
			ContentPlaceholder* c = GenerateContentPlaceholder(*rs);
			delete rs;
			return c;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all content placeholders that belong to the sheet of that id
 */
vector<ContentPlaceholder*> ContentPlaceholderController::GetContentPlaceholdersBySheetId(int sheetId)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM cph WHERE sheetid = ?");
	
	stmt->setInt(1, sheetId);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	vector<ContentPlaceholder*> cphs;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//For all content placeholders matching the query, add them to the vector
			cphs.push_back(GenerateContentPlaceholder(*rs));
		}

		delete rs;
	}

	return cphs;

}

/**
 * Find all content placeholders
 */
vector<ContentPlaceholder*> ContentPlaceholderController::GetAllContentPlaceholders()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM cph");

	delete stmt;

	vector<ContentPlaceholder*> cphs;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all content placeholders to a vector
			cphs.push_back(GenerateContentPlaceholder(*rs));
		}
		delete rs;
	}

	return cphs;
}

/**
 * Insert the content placeholder into the database
 */
int ContentPlaceholderController::AddContentPlaceholder(ContentPlaceholder& cph)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO cphs (sheetid, type, column, order) VALUES (?,?,?,?)");
	
	//Set provided parameters
	stmt->setInt(1, cph.sheetId);
	stmt->setInt(2, cph.type);
	stmt->setInt(3, cph.column);
	stmt->setInt(4, cph.order);

	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Perform another query to get the index of the inserted content placeholder
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
 * Update the relevant content placeholder in the database
 */
void ContentPlaceholderController::UpdateContentPlaceholder(ContentPlaceholder& cph)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE cphs SET sheetid = ?, type = ?, column = ?, order = ? WHERE id = ?");
	//Update with all parameters
	stmt->setInt(1, cph.sheetId);
	stmt->setInt(2, cph.type);
	stmt->setInt(3, cph.column);
	stmt->setInt(4, cph.order);
	stmt->setInt(5, cph.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant content placeholder in the database, NULLs passed if that parameter is not to be updated
 */
void ContentPlaceholderController::UpdateContentPlaceholder(int id, int* sheetId, int* wid, bool* column, int* order)
{
	string query = "UPDATE cph SET ";
	//For each parameter, check if it is provided, if it is add to the UPDATE statement
	if(sheetId != NULL)
	{
		query += "sheetid = ?";
	}
	else
	{
		query += "sheetid = sheetid";
	}
	if(wid != NULL)
	{
		query += ", wid = ?";
	}
	else
	{
		query += ", wid = wid";
	}
	if(column != NULL)
	{
		query += ", column = ?";
	}
	else
	{
		query += ", column = column";
	}
	if(order != NULL)
	{
		query += ", order = ?";
	}
	else
	{
		query += ", order = order";
	}
	query += " WHERE id = ?";

	PreparedStatement* stmt = conn->prepareStatement(query);
	int param = 1;
	//Populate the parameters in the statement
	if(sheetId != NULL)
	{
		stmt->setInt(param, *sheetId);
		param++;
	}
	if(wid != NULL)
	{
		stmt->setInt(param, *wid);
		param++;
	}
	if(column != NULL)
	{
		stmt->setInt(param, *column);
		param++;
	}
	if(order != NULL)
	{	
		stmt->setInt(param, *order);
		param++;
	}
	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the content placeholder from the database
 */
void ContentPlaceholderController::RemoveContentPlaceholder(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM cph WHERE id = ?");
	
	stmt->setInt(1, id);
	//Remove the record by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Generate a content placeholder based on the data in a result set row
 */
ContentPlaceholder* ContentPlaceholderController::GenerateContentPlaceholder(ResultSet& rs)
{
	ContentPlaceholder* c = new ContentPlaceholder();
	//Create a new content placeholder and populate the variables using the result set
	c->id = rs.getInt("id");
	c->sheetId = rs.getInt("sheetid");
	c->type = rs.getInt("wid");
	c->column = rs.getInt("column");
	c->order = rs.getInt("order");

	return c;
}

