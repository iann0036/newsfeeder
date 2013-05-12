#include "GroupPlaceholderController.h"
#include <cppconn/prepared_statement.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for GroupPlaceholderController, opens a database connection
 */
GroupPlaceholderController::GroupPlaceholderController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
GroupPlaceholderController::~GroupPlaceholderController()
{
	delete dbc;
}

/**
 * Find the group placeholder with that id
 */
GroupPlaceholder GroupPlaceholderController::GetGroupPlaceholderById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM gphs WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();
	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//Get the latest ID
			delete rs;
			return GenerateGroupPlaceholder(*rs);
		}
	}
	else
	{
		GroupPlaceholder g;
		return g;
	}

	GroupPlaceholder g;
	return g;
}

/**
 * Find all group placeholders
 */
vector<GroupPlaceholder> GroupPlaceholderController::GetAllGroupPlaceholders()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM gphs");
	delete stmt;
	
	vector<GroupPlaceholder> gphs;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all group placeholders to a vector
			gphs.push_back(GenerateGroupPlaceholder(*rs));
		}
	}
	delete rs;
	return gphs;
}

/**
 * Insert the group placeholder into the database
 */
void GroupPlaceholderController::AddGroupPlaceholder(GroupPlaceholder& gph)
{

}

/**
 * Update the relevant group placeholder in the database
 */
void GroupPlaceholderController::UpdateGroupPlaceholder(GroupPlaceholder& gph)
{

}

/**
 * Delete the group placeholder from the database
 */
void GroupPlaceholderController::RemoveGroupPlaceholder(GroupPlaceholder& gph)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM gphs WHERE id = ?");
	
	stmt->setInt(1, gph.id);
	//Delete by ID
	stmt->executeUpdate();
}

/**
 * Generate a group placeholder based on the data in a result set row
 */
GroupPlaceholder GroupPlaceholderController::GenerateGroupPlaceholder(ResultSet& rs)
{
	GroupPlaceholder g;
	//Populate placeholder with values
	g.id = rs.getInt("id");

	return g;
}

