/**
 * @file	Crawler.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @author	Aaron
 * @date	21/08/12
 *
 * @section	DESCRIPTION
 *
 * A class to crawl feeds from the source obtained from the database and insert
 * the data back to the databse.
 * @warning This is a prototype file (Originally MySQLUpdater)
 */

#ifndef nfrd_Crawler_h
#define nfrd_Crawler_h

#include <list>
#include <queue>
#include <vector>

#include <mysql_connection.h>
#include <cppconn/resultset.h>
#include <cppconn/prepared_statement.h>
#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/thread.hpp>
#pragma GCC diagnostic pop

#include "nfrd/Module.h"
#include "nfrd/CrawlerThread.h"
#include "nfrd/QueueItem.h"
#include "nfrd/FeedPriorityQueue.h"

namespace nfrd
{ 
namespace module
{
	/**
	* The main class representing the crawler module
	* The responsibilities of this class:<br/>
	* - Management of priority queue
	* - Management of worker threads<br/>
	* - Responsible for maintaining priority queue health
	*/
	class Crawler : public Module
	{
	public:
		/**
		* Initialising Constructor for Crawler
		* @param config	The config manager to use
		* @param log	The log manager to use
		*/
		Crawler(const config::ConfigManager& config, 
			const log::LogManager& log);
		/**
		* Delete all dynamic memory, if any
		*/
		~Crawler();
		/**
		* Called on module start, sets up and runs the queue
		*/
		void operator()();
		/**
		* Module stop, shuts down all activities safely
		*/
		void Stop();
	private:
		/**
		* The main loop for this thread, ensure that the queue items 
		* are kept up to date and that any new items are placed into
		* the queue.
		*/
		void MainLoop();
		/**
		* Run some maintenance tasks on the priortiy queue
		*/
		void RunMaintenanceTasks();
		/**
		* Setup and run all queue worker threads (CrawlerThread)
		*/
		void StartThreads();
		/**
		* Persist the queue back to the database
		*/
		void PersistQueue();
		/**
		* Initialise the queue by pulling out a list of all items<br/>
		* from the DB
		*/
		void InitialiseQueue();

		/// Group of worker threads 
		mutable boost::thread_group threads;
		/// CrawlerThread classes, each one represents a worker thread
		std::list<CrawlerThread*> crawlers;
		/// The priority queue used for delegating work
		FeedPriorityQueue* priorityQueue;

		/// Mutex mainly used for the healthThreadCondition
		mutable boost::mutex healthMutex;
		/// Condition for running maintenance tasks
		mutable boost::condition_variable healthThreadCondition;

		/// Flag for whether the crawler thread is alive
		bool isAlive;
		/// The time, in milliseconds to wait until health tasks are 
		/// executed
		const int WAITTIME;

	};
}
}

#endif
