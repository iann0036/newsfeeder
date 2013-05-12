/**
 * @file	StatController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find stats.
 */

#ifndef LIBNFDB_STATCONTROLLER
#define LIBNFDB_STATCONTROLLER

#include "Stat.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>

namespace nfdb {

/**
 * A class called to create, update, delete or find stats.
 */
class StatController
{
	public:
		/**
		 * Initialising Constructor for StatController, opens a database connection
		 */
		StatController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~StatController();

		/**
		 * Find the stat with that id
		 * @param id	primary key id of the stat
		 * @return the stat with that id
		 */
		Stat* GetStatById(int id);

		/**
		 * Find the latest statistic
		 * @return the stat with the latest id
		 */
		Stat* GetLatestStat();

		/**
		 * Find all stats
		 * @return all stats in the database
		 */
		std::vector<Stat*> GetAllStats();

		/**
		 * Insert the stat into the database
		 * @param stat	stat to be added to the database
		 * @return id of the newly added stat, -1 for an error
		 */
		int AddStat(Stat& stat);

		/**
		 * Update the relevant stat in the database
		 * @param stat	stat to be updated
		 */
		void UpdateStat(Stat& stat);

		/**
		 * Update the relevant stat in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the stat
		 * @param users	int representing the number of users in the database, nullable
		 * @param sheets	int representing the number of sheets in the database, nullable
		 * @param feeds	int representing the number of feeds in the database, nullable
		 * @param items	int representing the number of items in the database, nullable
		 * @param comments	int representing the number of comments in the database, nullable
		 */
		void UpdateStat(int id, int* users, int* sheets, int* feeds, int* items, int* comments);

		/**
		 * Delete the stat from the database
		 * @param stat	stat to be removed from the database
		 */
		void RemoveStat(int id);

		/**
		 * Generate the new statistics and store in the database
		 */
		void GenerateNewStat();

		/**
		 * Generate a stat based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a stat
		 * @return the generated stat
		 */
		Stat* GenerateStat(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
