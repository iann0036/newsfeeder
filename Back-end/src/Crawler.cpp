/**
 * @file	Crawler.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @author	Aron Hardy-Bardsley <ajrhb957@uowmail.edu.au>
 * @date	06/09/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of Crawler
 */

#include <string>
#include <cppconn/exception.h>
#include <cppconn/driver.h>
#include "nfrd/Crawler.h"
#include "nfrd/RSSParser.h"
#include "nfrd/FeedPriorityQueue.h"

#ifdef X_CODE
#include <FeedController.h>
#include <Feed.h>
#else
#include <libnfdb/FeedController.h>
#include <libnfdb/Feed.h>
#endif

using namespace nfdb;
using namespace nfrd::module;
using namespace nfrd::parser;
using namespace nfrd::misc;
using namespace nfrd::config;
using namespace std;

// Initialization Constructor
Crawler::Crawler(const nfrd::config::ConfigManager& config, 
	const nfrd::log::LogManager& log) : Module("Crawler", config, log),
	WAITTIME(atoi(config["Crawler"]["healthwait"].c_str()))
{
}

// Delete all dynamic memory, if any
Crawler::~Crawler()
{
	list<CrawlerThread*>::iterator it;
	for (it = crawlers.begin(); it != crawlers.end(); it++)
	{
		delete (*it);
	}

	delete priorityQueue;
}

// Start this crawler module
void Crawler::operator()()
{
	status = STARTING;
	log("Starting", Module::name);

	try
	{
		InitialiseQueue();

		StartThreads();

		status = RUNNING;
		log("Started", Module::name);
		isAlive = true;

		MainLoop();
	}
	catch (const exception& err)
	{
		status = STOPPED;
		log(err.what(), Module::name, nfrd::log::LogManager::ERROR);
	}
}

// Start the number of threads as specified in the config file
void Crawler::StartThreads()
{
	int threadCount = atoi(config["Crawler"]["thread"].c_str());

	for(int i = 0; i < threadCount; i++)
	{
		CrawlerThread* crawlerThread = new CrawlerThread(config, log, 
			i, priorityQueue);
		crawlers.push_front(crawlerThread);

		threads.create_thread(boost::bind(&CrawlerThread::Initialise, 
			crawlerThread));
	}
}

// The main loop of the crawler thread, used to maintain the health of the
// priority queue
void Crawler::MainLoop()
{
	while(isAlive)
	{
		RunMaintenanceTasks();

		{
			boost::mutex::scoped_lock lock(healthMutex);

			boost::system_time const timeout = 
				boost::get_system_time() + 
				boost::posix_time::milliseconds(WAITTIME);

			healthThreadCondition.timed_wait(lock, timeout);

		}
	}
}

// Maintain the health of the priority queue
void Crawler::RunMaintenanceTasks()
{
	//FeedController feedController;

	// Check for new items

	// Update the number of users in the system
	//priorityQueue->SetNumberOfUsersInSystem(feedController.GetNumberOfUsersInSystem());
}

// Initialise the queue items by retrieving from the database
void Crawler::InitialiseQueue()
{
	vector<nfdb::QueueItem*>::iterator it;
	FeedController controller;

	vector<nfdb::QueueItem*> queueitems = controller.GetQueueFeeds();
	
	priorityQueue = new FeedPriorityQueue(config, log, (int)queueitems.size());
	
	// Add and initialise all queue items
	for (it = queueitems.begin(); it != queueitems.end(); it++)
	{
		priorityQueue->PushFeed(new nfrd::module::QueueItem(*(*it)));
		(*it)->Destroy();
		delete (*it);
	}
	
	priorityQueue->Start();
}

// Persist the queue items to the database
void Crawler::PersistQueue()
{
	list<QueueItem*> queueItems;
	vector<QueueItem*> itemQueue = priorityQueue->GetAllItems();

	vector<QueueItem*>::iterator qit;
	for (qit = itemQueue.begin(); qit < itemQueue.end(); qit++)
	{
		queueItems.push_back((*qit));
	}

	//FeedDataController feedDataController;
	//feedDataController.PersistQueueItems(queueItems);
}

// Override stop from the module class 
void Crawler::Stop()
{
	if(status != RUNNING)
	{
		return;
	}

	log("Stopping", Module::name);
	status = STOPPING;

	// Kill this crawler thread
	this->isAlive = false;
	{
		boost::mutex::scoped_lock lock(healthMutex);
		healthThreadCondition.notify_one();
	}
	Module::Stop(); // thread.join the health thread

	// Kill all of the worker threads and wait for them to end
	list<CrawlerThread*>::iterator it;
	for (it = crawlers.begin(); it != crawlers.end(); it++)
	{
		(*it)->Stop();
	}

	threads.join_all();

	// Stop and join the priority queue thread
	priorityQueue->Stop();

	// Persist the queue to the db (storing any priority values)
	log("Persisting queue to database.", Module::name);
	PersistQueue();

	log("Stopped", Module::name);
	status = STOPPED;
	
#ifdef QUEUEING_SIMULATION
	list<CrawlerThread*>::iterator itc;
	int avgtotalms = 0;
	int avgprocms = 0;
	int avgtotal = 0;
	for (itc = crawlers.begin(); itc != crawlers.end(); itc++)
	{
		int totalMilliseconds = (((*itc)->end.tv_sec  - 
			(*itc)->start.tv_sec) * 1000 + ((*itc)->end.tv_usec - 
			(*itc)->start.tv_usec)/1000.0) + 0.5;

		int processingMilliseconds = (*itc)->timeSpent;

		cout << "Thread " << (*itc)->GetId() << "\t" << totalMilliseconds
			<< "\t" << processingMilliseconds << "\t" 
			<< (*itc)->total << endl;

		avgtotalms += totalMilliseconds;
		avgprocms += processingMilliseconds;
		avgtotal += (*itc)->total;
	}

	cout << "Thread total " << "\t" << avgtotalms << "\t" << avgprocms 
		<< "\t" << avgtotal << endl;

	avgtotalms = avgtotalms / crawlers.size();
	avgprocms = avgprocms / crawlers.size();
	avgtotal = avgtotal / crawlers.size();

	cout << "Thread avg " << "\t" << avgtotalms << "\t" << avgprocms 
		<< "\t" << avgtotal << endl;
#endif
}