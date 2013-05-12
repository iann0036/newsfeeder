/**
 * @file	QueueItem.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a QueueItem record, derived from the Item class
 */

#ifndef LIBNFDB_QUEUEITEM
#define LIBNFDB_QUEUEITEM

#include <string>
#include "nfrd/DateTime.h"

namespace nfdb {

/**
 * A class representing a QueueItem for the queue, derived from the Item table
 */
class QueueItem
{
	public:

		int id;
		int frequency;
		int* type;
		int numUsers;

		/**
		 * Initialising Constructor for QueueItem, sets type to NULL
		 */
		QueueItem()
		{
			type = NULL;
		}

		/**
		 * Non-Default Constructor for QueueItem
		 * @param id	int identifier of the queue item, gotten from item id
		 * @param frequency	int representing the frequency of updates on this item
		 * @param type	int* representing the type of item, nullable
		 * @param numUsers	int representing the number of users who are using that item
		 */
		QueueItem(int id, int frequency, int* type, int numUsers)
		{
			this->id = id;
			this->frequency = frequency;
			this->type = type;
			this->numUsers = numUsers;
		}

		/**
		 * Destructor for QueueItem, does not perform any actions
		 */
		~QueueItem()
		{
			//Commented out to stop any issues regarding auto pointers freeing inappropriately
			//Destroy();
		}
	
		/**
		 * Cleans up any memory held by the QueueItem
		 */
		void Destroy()
		{
			if(type != NULL)
			{
				delete type;
				type = NULL;
			}
		}
};

}

#endif
