/**
 * @file	LayoutController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find layouts.
 */

#ifndef LIBNFDB_LAYOUTCONTROLLER
#define LIBNFDB_LAYOUTCONTROLLER

#include "Layout.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>

namespace nfdb {

/**
 * A class called to create, update, delete or find layouts.
 */
class LayoutController
{
	public:

		/**
		 * Initialising Constructor for LayoutController, opens a database connection
		 */
		LayoutController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~LayoutController();

		/**
		 * Find the layout with that id
		 * @param id	primary key id of the layout
		 * @return the layout with that id
		 */
		Layout GetLayoutById(int id);

		/**
		 * Find all layouts
		 * @return all layouts in the database
		 */
		std::vector<Layout> GetAllLayouts();

		/**
		 * Insert the layout into the database
		 * @param layout	layout to be added to the database
		 */
		void AddLayout(Layout& layout);

		/**
		 * Update the relevant layout in the database
		 * @param layout	layout to be updated
		 */
		void UpdateLayout(Layout& layout);

		/**
		 * Delete the layout from the database
		 * @param layout	layout to be removed from the database
		 */
		void RemoveLayout(Layout& layout);

		/**
		 * Generate a layout based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a layout
		 * @return the generated layout
		 */
		Layout GenerateLayout(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
