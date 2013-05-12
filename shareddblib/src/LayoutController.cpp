#include "LayoutController.h"
#include <cppconn/prepared_statement.h>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for LayoutController, opens a database connection
 */
LayoutController::LayoutController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
LayoutController::~LayoutController()
{
	delete dbc;
}

/**
 * Find the layout with that id
 */
Layout LayoutController::GetLayoutById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM layouts WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();
	delete stmt;
	
	if(rs != NULL)
	{
		while(rs->next())
		{
			//If a layout matches that id, return it
			return GenerateLayout(*rs);
		}
	}
	else
	{
		Layout l;
		return l;
	}

	Layout l;
	return l;
}

/**
 * Find all layouts
 * @return all layouts in the database
 */
vector<Layout> LayoutController::GetAllLayouts()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM layouts");

	vector<Layout> layouts;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all layouts to a vector
			layouts.push_back(GenerateLayout(*rs));
		}
	}
	return layouts;
}

/**
 * Insert the layout into the database
 */
void LayoutController::AddLayout(Layout& layout)
{

}

/**
 * Update the relevant layout in the database
 */
void LayoutController::UpdateLayout(Layout& layout)
{

}

/**
 * Delete the layout from the database
 */
void LayoutController::RemoveLayout(Layout& layout)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM layouts WHERE id = ?");
	
	stmt->setInt(1, layout.id);
	//Delete by ID
	stmt->executeUpdate();
}

/**
 * Generate a layout based on the data in a result set row
 */
Layout LayoutController::GenerateLayout(ResultSet& rs)
{
	Layout l;

	l.id = rs.getInt("id");

	return l;
}

