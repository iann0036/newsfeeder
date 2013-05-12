/**
 * @file	FeedPriorityQueue.cpp
 * @author	Aron Hardy-Bardsley <ajrhb957@uowmail.edu.au>
 * @date	17/08/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of the FeedPriorityQueue class.
 */

#include "nfrd/FeedPriorityQueue.h"
#include <vector>

#ifdef X_CODE
#include <UserController.h>
#else
#include <libnfdb/UserController.h>
#endif

using namespace std; 
using namespace nfrd::module;
 
// Initialization Constructor, reserve some memory if needed
FeedPriorityQueue::FeedPriorityQueue(const nfrd::config::ConfigManager& c, 
	const nfrd::log::LogManager& l, int reserve) : config(c), log(l), 
	MAXPOP(atoi(c["Crawler"]["maxpop"].c_str()))
{
	this->isAlive = false;

	this->itemQueue.reserve(reserve);
	this->tempOutgoingQueue.reserve(MAXPOP);
	
	this->numberOfUsersInSystem = nfdb::UserController().GetNumberOfUsers();

}

// Delete all dynamic memory, if any
FeedPriorityQueue::~FeedPriorityQueue()
{
}

// Start the priority queue/thread
void FeedPriorityQueue::Start()
{
	if(isAlive)
	{
		return;
	}

	this->itemsPopped = MAXPOP;
	isAlive = true;
	incomingHasChanged = false;
	outgoingHasChanged = false;

	priorityQueueThread = boost::thread(
		boost::bind(&FeedPriorityQueue::MainLoop, this));
}

// Execute the main loop of the queueing thread
void FeedPriorityQueue::MainLoop()
{
	while(isAlive)
	{
		IterateOnce();

		// Block until stuff changes
		{
			boost::mutex::scoped_lock lock(updatedMutex);
				
			while((!incomingHasChanged && !outgoingHasChanged) 
				&& isAlive)
			{
				queueUpdateCondition.wait(lock);
			}
		}
	}
}

// Iterate once on the queue, keeping the outgoing/incoming queue's processed
// while keeping the heap up to date.
void FeedPriorityQueue::IterateOnce()
{
	// Check the incoming queue to see if we need to add anything back
	// to the heap
	if(!incomingQueue.empty())
	{
#ifdef QUEUEING_SIMULATION
		cout << "Processing incoming queue" << endl;
#endif
		int itemsPushed = 0;

		{
			boost::mutex::scoped_lock lock(incomingMutex);

			itemsPushed = incomingQueue.size();

			while(!incomingQueue.empty())
			{
				itemQueue.push_back(incomingQueue.front());
				incomingQueue.pop();
			}

			// Change the updated variable for the incoming queue
			{
				boost::mutex::scoped_lock lock(updatedMutex);
				incomingHasChanged = false;
			}
		}

		// Retain the heap property, we do this outside the incoming
		// queue scoped lock to decrease worker thread bottlenecks
		{
			boost::mutex::scoped_lock lock(heapMutex);
			
			while(itemsPushed != 0)
			{
				QueueItem* tempItem = *(itemQueue.end() - 
					itemsPushed);
				tempItem->CalculateConstant(numberOfUsersInSystem);
				tempItem->ResetPriority(); //Restart priority
				tempItem->IncrementPriority(1);

				push_heap (itemQueue.begin(), itemQueue.end() - 
					(itemsPushed - 1));
				itemsPushed--;
			}
		}
	}

	// Sort if the number of pops (from the heap to the outgoing queue) hits
	// MAXPOP
	if(itemsPopped == MAXPOP)
	{
		boost::mutex::scoped_lock lock(heapMutex);

#ifdef QUEUEING_SIMULATION
		cout << "Sorting the heap" << endl;
#endif

		vector<QueueItem*>::iterator it;
		for (it = itemQueue.begin(); it < itemQueue.end(); it++)
		{
			(*it)->IncrementPriority(1);
		}

		make_heap(itemQueue.begin(), itemQueue.end(), QueueItem::feed_comparer);

		itemsPopped = 0;
	}

	// Pop items off the heap until we reach either the items popped
	// or outgoing queue size limit (which is the same as MAXPOP)
	if(itemsPopped != MAXPOP && (int)outgoingQueue.size() != MAXPOP)
	{
#ifdef QUEUEING_SIMULATION
		cout << "Populating outgoing queue" << endl;
#endif
		int itemCount = MAXPOP - outgoingQueue.size();
		
		if(MAXPOP - itemsPopped < itemCount)
		{
			itemCount = MAXPOP - itemsPopped;
		}

		{
			boost::mutex::scoped_lock lock(heapMutex);

			for(int i = 0; i < itemCount; i++)
			{
				pop_heap (itemQueue.begin(), itemQueue.end());
				tempOutgoingQueue[i] = itemQueue.back();
				itemQueue.pop_back();
			}
		}

		// Transfer of items from the temp array to the outgoing queue
		{
			boost::mutex::scoped_lock lock(outgoingMutex);

			for(int i = 0; i < itemCount; i++)
			{
				outgoingQueue.push(tempOutgoingQueue[i]);
			}

			// Change the updated variable for the outgoing queue
			{
				boost::mutex::scoped_lock lock(updatedMutex);
				outgoingHasChanged = false;
			}

			// Notify all threads waiting on the outgoing queue
			outgoingQueueCondition.notify_all();
		}

		itemsPopped += itemCount;
	}
}

// Safely cleanup and persist the current queue state to the database
void FeedPriorityQueue::CleanupQueue()
{
	boost::mutex::scoped_lock lock(heapMutex);

	// Put all outgoing queue items back on to the heap
	while(!outgoingQueue.empty())
	{
		itemQueue.push_back(outgoingQueue.front());
		outgoingQueue.pop();
	}

	// Put all incoming queue items back on the heap
	while(!incomingQueue.empty())
	{
		itemQueue.push_back(incomingQueue.front());
		incomingQueue.pop();
	}
}

// Allow the crawler thread to retrieve a queue item to work with
// from the outgoing queue
void FeedPriorityQueue::PopFeed(QueueItem*& item)
{
	boost::mutex::scoped_lock lock(outgoingMutex);

	while(outgoingQueue.empty())
	{
		outgoingQueueCondition.wait(lock);
	}

	item = outgoingQueue.front();
	outgoingQueue.pop();

	// Notify the main queueing thread of a change
	{
		boost::mutex::scoped_lock lock(updatedMutex);
		outgoingHasChanged = true;
		queueUpdateCondition.notify_one();
	}
}

// When a thread is done working with a feed, it will be pushed back onto the
// queue
void FeedPriorityQueue::PushFeed(QueueItem* item)
{
	boost::mutex::scoped_lock lock(incomingMutex);
	incomingQueue.push(item);

	// Notify the main queueing thread of a change
	{
		boost::mutex::scoped_lock lock(updatedMutex);
		incomingHasChanged = true;
		queueUpdateCondition.notify_one();
	}
}

// Stop the queue processing
void FeedPriorityQueue::Stop()
{
	isAlive = false;

	{
		boost::mutex::scoped_lock lock(updatedMutex);
		queueUpdateCondition.notify_one();
	}

	priorityQueueThread.join();
	
	//Cleanup the queue so everything is back in one vector
	CleanupQueue();
}

// Return the thread this priority queue is running under
boost::thread* FeedPriorityQueue::GetThread()
{
	return &(this->priorityQueueThread);
}

// Get all items from the queue
vector<QueueItem*> FeedPriorityQueue::GetAllItems()
{
	boost::mutex::scoped_lock lock(heapMutex);

	return this->itemQueue;
}

// Set the number of users in the system
void FeedPriorityQueue::SetNumberOfUsersInSystem(int numberOfUsersInSystem)
{
	boost::mutex::scoped_lock lock(heapMutex);

	this->numberOfUsersInSystem = numberOfUsersInSystem;
}