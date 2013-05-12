/**
 * @file	CrawlerThread.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>, <br/>
 *		Aron Hardy-Bardsley <ajrhb957@uowmail.edu.au>
 * @date	15/08/12
 *
 * @section	DESCRIPTION
 *
 * Crawler thread polls the queue (crawler) for work and executes the parser
 */

#ifndef nfrd_CrawlerThread_h
#define nfrd_CrawlerThread_h
#include <list>
#include <mysql_connection.h>
#include <cppconn/resultset.h>
#include <cppconn/prepared_statement.h>
#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/thread.hpp>
#pragma GCC diagnostic pop
#include "nfrd/QueueItem.h"
#include "nfrd/LogManager.h"
#include "nfrd/ConfigManager.h"
#include "nfrd/FeedPriorityQueue.h"

#ifdef X_CODE
#include <FeedController.h>
#include <Feed.h>
#else
#include <libnfdb/FeedController.h>
#include <libnfdb/Feed.h>
#endif

#ifdef QUEUEING_SIMULATION
#include <ctime>
#endif

namespace nfrd 
{
namespace module
{
	class Crawler;

	/**
	* A worker class representing a thread. This class will poll<br/>
	* the priority queue for more work and then execute the work.
	*/
	class CrawlerThread
	{
	public:
		/**
		* Initialising Constructor for Crawler
		* @param config	The config manager to use
		* @param log	The log manager to use
		* @param crawler	The crawler to use (prority queue)
		*/
		CrawlerThread(const config::ConfigManager& config, 
			const log::LogManager& log, int id, 
			FeedPriorityQueue* priorityqueue);
		/**
		* Free any dynamic memory
		*/
		~CrawlerThread();
		/**
		* Initialise this crawler thread for processing
		*/
		void Initialise();
		/**
		* Stop this crawler thread from processing
		*/
		void Stop();
		/**
		* Get the Id of this crawler thread
		*/
		int GetId();

#ifdef QUEUEING_SIMULATION
		struct timeval start;
		struct timeval end;
		long timeSpent;
		int total;
#endif
	private:
		/**
		* Updated the item with details from the feed
		* @param item	Item to update
		* @param feed	Feed to use when updating item
		*/
		void UpdateItem(QueueItem* item, nfdb::Feed* feed);
		/**
		* Main loop, continuously request for more feeds
		*/
		void Request();
		/**
		* Crawl the given feed
		*/
		void Crawl(nfdb::FeedController* feedDataController, nfdb::Feed* feed);

		/// The priority queue to request more work from
		FeedPriorityQueue* priorityQueue;
		/// The id of this crawler thread
		int id;
		/// A config to use to obtain configuration settings
		const config::ConfigManager& config;
		/// A log to use for logging out errors
		const log::LogManager& log;
		/// Whether the crawler thread is alive or not
		bool isAlive;
	};
}
}

#endif
