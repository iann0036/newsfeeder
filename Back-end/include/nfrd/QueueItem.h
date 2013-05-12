/**
 * @file	QueueItem.h
 * @author	Aron Hardy-Bardsley <ajrhb957@uow.edu.au>
 * @date	15/08/12
 *
 * @section	DESCRIPTION
 *
 * Represents a compact version of a feed for use with the queueing model<br/>
 * (implemented by crawler)
 */
 
#ifndef nfrd_QueueItem_h
#define nfrd_QueueItem_h
#ifdef X_CODE
#include <QueueItem.h>
#else
#include <libnfdb/QueueItem.h>
#endif

namespace nfrd 
{ 
namespace module
{
	class QueueItem
	{
	public:
		/**
		* Initialise the queue item as a copy of the given queue item
		*/
		QueueItem(nfdb::QueueItem &item);
		
		/**
		* Initialise the queue item with the required values to<br/>
		* calculate the item's priority
		*/
		QueueItem(unsigned int, short feedType, 
			float contentUpdateAverage, int numUsers);
		/**
		* Increment the priority of this queue item, done every<br/>
		* time the heap is sorted
		* @param maxpop	Factor in the time it has been since last sort
		*/
		void IncrementPriority(int maxpop);
		/**
		* Calculate the constant part of the priority, based on <br/>
		* the values that do not change very often
		*/
		void CalculateConstant(int numUsersInSystem);
		/**
		* Get the feed id of the item
		*/
		int GetFeedID() const;
		/**
		* Set a new value for content update average
		*/
		void SetContentUpdateAverage(float contentUpdateAverage);
		/**
		* Set the type of feed represented
		*/
		void SetFeedType(short feedType);
		/**
		* Set the number of users affected by the feed
		*/
		void SetUsersAffected(int usersAffected);
		
		/**
		* Compare two feeds based on thier priority
		*/ 
		static bool feed_comparer(QueueItem* itemA, QueueItem* itemB)
		{
			return (itemA->priority > itemB->priority);
		}
		
		void ResetPriority();
	private:
		/// ID of the represented feed
		unsigned int id;
		/// Calculated priority value for sorting
		float priority;
		/// Constant priority value, used in the priority calculation
		float priorityConstant;
		/// The relative amount of time spent in the queue (iterations)
		float timeSpentInQueue;

		/// The average time between updates for the feed
		float contentUpdateAverage;
		/// The type of feed represented
		short feedType;
		/// The number of users affected by the feed
		int usersAffected;
	};
}
}

#endif