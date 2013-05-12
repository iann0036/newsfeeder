/**
 * @file	FeedPriorityQueue.h
 * @author	Aron Hardy-Bardsley <ajrhb957@uowmail.edu.au>
 * @date	15/08/12
 *
 * @section	DESCRIPTION
 *
 * The FeedPriorityQueue class is the implementation of the queueing model.<br/>
 * It handles feed priorities and delegates work (which is then <br/>
 * <b>consumed</b> by some other entity for processing
 */

#ifndef nfrd_FeedPriorityQueue_h
#define nfrd_FeedPriorityQueue_h

#include <list>
#include <queue>
#include <vector>

#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/thread.hpp>
#pragma GCC diagnostic pop

#include "nfrd/LogManager.h"
#include "nfrd/ConfigManager.h"
#include "nfrd/QueueItem.h"

namespace nfrd
{ 
namespace module
{
	/**
	* Implements a queueing/threading model. The model was designed to <br/>
	* sort and prioritise the feeds in the background while providing a<br/>
	* fast way of delegating work to background feeds. So to summarise <br/>
	* the responsibilities of this class:<br/>
	* - Proritising all feeds for processing<br/>
	* - Delegating work to threads (in a consumer/producer type model)
	*/
	class FeedPriorityQueue
	{
	public:
		/**
		* Initialising Constructor for FeedPriorityQueue
		* @param config	The config manager to use
		* @param log	The log manager to use
		*/
		FeedPriorityQueue(const nfrd::config::ConfigManager& config, 
			const nfrd::log::LogManager& log, int reserve = 0);
		/**
		* Delete all dynamic memory, if any
		*/
		~FeedPriorityQueue();
		/**
		* Removes a feed from the prioritised queue for processing
		* @param item	Pop an item off the heap and populate item
		*/
		void PopFeed(QueueItem*& item);
		/**
		* Adds a feed on to the queue
		* @param item	Put the given item onto the heap
		*/
		void PushFeed(QueueItem* item);
		/**
		* Start the priority queue/thread
		*/
		void Start();
		/**
		* Stop the priority queue/thread<br/>
		* Only call priority queue stop when you are 100% sure that<br/>
		* nothing else is using the queue
		*/
		void Stop();
		/**
		* Get the thread that this priority queue is running under
		*/
		boost::thread* GetThread();
		/**
		* Get a vector of all queue items. Note the queue should be<br/>
		* stopped before calling this function
		*/
		std::vector<QueueItem*> GetAllItems();
		/**
		* Set the number of users in the system
		*/
		void SetNumberOfUsersInSystem(int numberOfUsersInSystem);
	private:
		/**
		* The main loop for the main queueing thread of the crawler <br/>
		* waits for work executes IterateOnce when it has some.<br/>
		* "Work" is classified as:<br/>
		* - PopFeed is executed<br/>
		* - PushFeed is executed
		*/
		void MainLoop();
		/**
		* Processes the priority queue (aka heap, aka vector) and<br/>
		* the incoming and outgoing queues to ensure that they are<br/>
		* all up to date. Can be broken down into these operations:<br/>
		* - Process incoming queue<br/>
		* - Re-calculate feed priority and re-sort the queue<br/>
		* - Process outgoing queue
		*/
		void IterateOnce();
		/**
		* Setup and run all queue worker threads (CrawlerThread)
		*/
		void StartThreads();
		/**
		* When this module is stopped, cleanup queue is called to <br/>
		* persist items back to the database
		*/
		void CleanupQueue();

		/// Mutex to synchronise access to the incoming queue
		mutable boost::mutex incomingMutex;
		/// Mutex to synchronise access to the outgoing queue
		mutable boost::mutex outgoingMutex;
		/// Mutex to synchronise access to the outgoingHasChanged and
		/// incomingHasChanged variables
		mutable boost::mutex updatedMutex;
		/// Mutex to synchronise access to the internal heap
		mutable boost::mutex heapMutex;
		/// Condition for waiting on more items to be available in the
		/// outgoing queue for the worker threads (notified by the main
		/// queueing thread)
		mutable boost::condition_variable outgoingQueueCondition;
		/// Condition for the main queueing thread to wait on 
		/// PushFeed and PopFeed executions (notified by the worker
		/// threads)
		mutable boost::condition_variable queueUpdateCondition;

		/// The main priority queue (heap) only the main queueing thread
		/// is allowed to touch this!
		std::vector<QueueItem*> itemQueue;
		/// A buffer queue for any incoming (PushFeed) items
		std::queue<QueueItem*> incomingQueue;
		/// A temporary array used for performance reasons by the
		/// main queueing thread
		std::vector<QueueItem*> tempOutgoingQueue;
		/// A buffer queue for any outgoing (PopFeed) items
		std::queue<QueueItem*> outgoingQueue;

		/// Configuration access
		const nfrd::config::ConfigManager& config;
		/// Access to logging system
		const nfrd::log::LogManager& log;		
		
		/// Used internally, the number of items which have been popped
		/// from the heap and put on the outgoing queue since the heap
		/// was last prioritised/sorted
		int itemsPopped;
		/// Used to help synchronise the main queueing thread so that it
		/// only iterates when there is work to do. Updated by PopFeed
		bool outgoingHasChanged;
		/// Used to help synchronise the main queueing thread so that it
		/// only iterates when there is work to do. Updated by PushFeed
		bool incomingHasChanged;
		/// Used to keep the main queueing thread alive. Cannot use 
		/// the module's "status" as this is being used by another 
		/// section of the code, if both used the same variable/value
		/// then the main queueing thead would not safely stop.
		bool isAlive;
		/// The maximum number of items to pop into the outgoing
		/// queue before requiring a prioritise/sort on the heap. 
		/// Also represents the maximum number of items allowed in the
		/// outgoing queue at once. Changing this number to a higher 
		/// number will be more effecient but will make the overall
		/// prioritising algorithm less effective. Making it smaller
		/// will in turn, decrease performance. This is configurable
		/// in the config, but changes to this are not currently 
		/// supported during module runtime.
		const int MAXPOP;
		/// The number of users in the system, used to help priority
		/// calculations
		int numberOfUsersInSystem;

		/// The main queueing thread dedicated to this object
		boost::thread priorityQueueThread;
	};
}
}

#endif