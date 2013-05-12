#include "SheetController.h"
#include <cppconn/prepared_statement.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for SheetController, opens a database connection
 */
SheetController::SheetController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
SheetController::~SheetController()
{
	delete dbc;
}

/**
 * Find the sheet with that id
 */
Sheet* SheetController::GetSheetById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM sheets WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If a sheet matches the id, return it
			Sheet* s = GenerateSheet(*rs);
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
 * Find all sheets that belong to that user
 */
vector<Sheet*> SheetController::GetSheetsByUsername(string username)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM sheets WHERE username = ?");
	
	stmt->setString(1, username);

	ResultSet* rs = stmt->executeQuery();

	vector<Sheet*> sheets;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add matching sheets to a vector
			sheets.push_back(GenerateSheet(*rs));
		}
	}

	delete stmt;
	delete rs;

	return sheets;

}

/**
 * Find all sheets
 */
vector<Sheet*> SheetController::GetAllSheets()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM sheets");

	vector<Sheet*> sheets;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all sheets to a vector
			sheets.push_back(GenerateSheet(*rs));
		}
	}

	delete stmt;
	delete rs;

	return sheets;
}

/**
 * Insert the sheet into the database
 */
int SheetController::AddSheet(Sheet& sheet)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO sheets (name, username, layoutid) VALUES (?,?,?)");
	//Populate the query with the values from the passed sheet
	stmt->setString(1, sheet.name);
	stmt->setString(2, sheet.username);
	stmt->setInt(3, sheet.layoutId);
	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Create another query to get the ID of the inserted sheet
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
 * Update the relevant sheet in the database
 */
void SheetController::UpdateSheet(Sheet& sheet)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE Sheets SET name = ?, username = ?, updated = ?, layoutid = ? WHERE id = ?");
	//Populate the query with the values from the passed sheet
	stmt->setString(1, sheet.name);
	stmt->setString(2, sheet.username);
	stmt->setString(3, sheet.updated.ExportToMySQL());
	stmt->setInt(4, sheet.layoutId);
	stmt->setInt(5, sheet.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant sheet in the database, NULLs passed if that parameter is not to be updated
 */
void SheetController::UpdateSheet(int id, string* name, string* username, nfrd::misc::DateTime* updated, int* layoutId)
{
	//Generate the update query
	string query = "UPDATE Sheets SET ";
	//If the value is null, set it to the existing value
	if(name != NULL)
	{
		query += "name = ?";
	}
	else
	{
		query += "name = name";
	}
	if(username != NULL)
	{
		query += ", username = ?";
	}
	else
	{
		query += ", username = username";
	}
	if(updated != NULL)
	{
		query += ", updated = ?";
	}
	else
	{
		query += ", updated = updated";
	}
	if(layoutId != NULL)
	{
		query += ", layoutid = ?";
	}
	else
	{
		query += ", layoutid = layoutid";
	}
	query += " WHERE id = ?";

	PreparedStatement* stmt = conn->prepareStatement(query);
	
	int param = 1;
	//Add the values to the query
	if(name != NULL)
	{
		stmt->setString(param, *name);
		param++;
	}
	if(username != NULL)
	{
		stmt->setString(param, *username);
		param++;
	}
	if(updated != NULL)
	{
		stmt->setString(param, updated->ExportToMySQL());
		param++;
	}
	if(layoutId != NULL)
	{
		stmt->setInt(param, *layoutId);
		param++;
	}
	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the sheet from the database
 */
void SheetController::RemoveSheet(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM sheets WHERE id = ?");
	
	stmt->setInt(1, id);
	//Delete by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Generate a sheet based on the data in a result set row
 */
Sheet* SheetController::GenerateSheet(ResultSet& rs)
{
	Sheet* s = new Sheet();
	//Populate the new sheet with the result set values
	s->id = rs.getInt("id");
	s->name = rs.getString("name");
	s->updated.ImportFromMySQL(rs.getString("updated"));
	s->layoutId = rs.getInt("layoutid");

	return s;
}

