/**
 * @file	Stat.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Stat record
 */

#ifndef LIBNFDB_STAT
#define LIBNFDB_STAT

namespace nfdb {

/**
 * A class representing a row in the Stat table
 */
class Stat
{
	public:
		int id;
		int users;
		int sheets;
		int feeds;
		int items;
		int comments;

		/**
		 * Initialising Constructor for Stat
		 */
		Stat()
		{
		}

		/**
		 * Non-Default Constructor for Stat
		 * @param id	int identifier of the stat
		 * @param users	int representing the number of users in the database
		 * @param sheets	int representing the number of sheets in the database
		 * @param feeds	int representing the number of feeds in the database
		 * @param items	int representing the number of items in the database
		 * @param comments	int representing the number of comments in the database
		 */
		Stat(int id, int users, int sheets, int feeds, int items, int comments)
		{
			this->id = id;
			this->users = users;
			this->sheets = sheets;
			this->feeds = feeds;
			this->items = items;
			this->comments = comments;
		}

		/**
		 * Destructor for Stat, does not perform any actions
		 */
		~Stat()
		{
		}
	
		/**
		 * Cleans up any memory held by the Stat
		 */
		void Destroy()
		{
		}
};

}

#endif

