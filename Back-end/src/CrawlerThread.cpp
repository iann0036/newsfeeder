/**
 * @file	CrawlerThread.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>, <br/>
 *		Aron Hardy-Bardsley <ajrhb957@uowmail.edu.au>
 * @date	20/09/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of Crawler Thread
 */

#include <string>
#include <memory>
#include <cppconn/exception.h>
#include <cppconn/driver.h>
#include "nfrd/CrawlerThread.h"
#include "nfrd/FeedXParser.h"
#include "nfrd/LogManager.h"
#include "nfrd/ConfigManager.h"
#include "nfrd/FeedPriorityQueue.h"
#include "nfrd/AutoDB.h"

#ifdef X_CODE
#include <FeedController.h>
#include <ItemController.h>
#include <ImageController.h>
#include <NotificationController.h>
#include <Feed.h>
#else
#include <libnfdb/FeedController.h>
#include <libnfdb/ItemController.h>
#include <libnfdb/ImageController.h>
#include <libnfdb/NotificationController.h>
#include <libnfdb/Feed.h>
#endif

#ifdef DEBUG
#include <iostream>
#include <iomanip>
#endif

using namespace nfrd::module;
using namespace nfrd::parser;
using namespace nfrd::misc;
using namespace nfrd::config;
using namespace nfdb;
using namespace std;

// Initialization Constructor
CrawlerThread::CrawlerThread(const nfrd::config::ConfigManager& config, 
	const nfrd::log::LogManager& log, 
	int id, FeedPriorityQueue* priorityQueue) : config(config), log(log)
{
	this->priorityQueue = priorityQueue;
	this->isAlive = false;
	this->id = id;

#ifdef QUEUEING_SIMULATION
	timeSpent = 0;
	total = 0;
#endif
}

// Destructor - Cleanup memory
CrawlerThread::~CrawlerThread()
{
}

// Initialise the crawler thread to start requesting feeds to crawl
void CrawlerThread::Initialise()
{
	this->isAlive = true;
	try
	{
		Request();
	}
	catch (const exception& err)
	{
		log(err.what(), "Crawler Thread", log.ERROR);
		return;
	}
}

// Execute the main loop of the worker thread, continuously request for work
void CrawlerThread::Request()
{
#ifdef QUEUEING_SIMULATION
	gettimeofday(&start, NULL);
#endif

	QueueItem* item = 0;

	FeedController feedController;
	while(this->isAlive)
	{
		this->priorityQueue->PopFeed(item);

		if(item == 0)
		{
			continue;
		}

		// Obtain the latest feed information from the db about the item
		AutoDB<Feed> feed(feedController.GetFeedById
				  (item->GetFeedID()));

		// Determine whether the feed was deleted from the database
		if(feed.get() == 0)
		{
			//Note that we do not add the item back to the queue
			continue;
		}

		UpdateItem(item, feed.get());
		try
		{
			Crawl(&feedController, feed.get());
		}
		catch (const exception& err)
		{
			log(err.what(), "Crawler Thread", log.WARNING);
			return;
		}

		this->priorityQueue->PushFeed(item);
	}

#ifdef QUEUEING_SIMULATION
	gettimeofday(&end, NULL);
#endif
}

// Crawl the given feed
void CrawlerThread::Crawl(FeedController* feedDataController, Feed* feed)
{

// keep this for simulation and testing
#ifdef QUEUEING_SIMULATION
	struct timeval startProc, endProc;
	gettimeofday(&startProc, NULL);
	boost::this_thread::sleep(boost::posix_time::milliseconds(500 +
		rand() % 1000 + 1));
	gettimeofday(&endProc, NULL);

	timeSpent += ((endProc.tv_sec  - startProc.tv_sec) * 1000 + 
		(endProc.tv_usec - startProc.tv_usec)/1000.0) + 0.5;
	total += 1;
	return;
#endif

	auto_ptr<Parser> parser;
	
	try
	{		
		// Crawl the feed
#ifdef DEBUG
		cout << "[" << setw(3) << feed->id << "][Parsing] "
			<< setw(60) << left << feed->url << right << endl;
#endif
		parser = auto_ptr<Parser>(new FeedXParser());
		parser->ReadURL(feed->url);
	}
	catch (const ParserException& err)
	{
		log(err.what(), "Crawler Thread", log.WARNING);
		return;
	}
	
	// Parse the feed and its items
	const list<nfrd::parser::Item*>& items = parser->GetItemList();
	
	size_t item_updated = 0;
	ItemController item_controller;
	ImageController image_controller;
	for (list<nfrd::parser::Item*>::const_iterator i = items.begin();
	     i != items.end(); ++i)
	{
		try
		{
			nfrd::parser::Item* item = *i;
			
			// Check item
			if (!item->HasTitle() || !item->HasURL() ||
			    !item->HasContent())
				continue;
			
			// If the feed item is already in the database, skip
			// over it
			if (item->HasPostDate() && feed->lastUpdate != 0 &&
			    item->GetPostDate() < *(feed->lastUpdate))
				continue;
			
			nfdb::Item db_item(0, feed->id,
					   (string&)item->GetTitle(),
					   (string&)item->GetURL(),
					   (string&)item->GetContent(),
					   (item->HasPostDate() ? (DateTime*)
					    &item->GetPostDate() : 0),
					   (item->HasAuthor() ? (string*)
					    &item->GetAuthor() : 0),
					   (item->HasGeoLocation() ? (string*)
					    &item->GetGeoLocation() : 0));
			
			db_item.id = item_controller.AddItem(db_item);
			item_updated++;
#ifdef DEBUG
			cout << "[" << setw(3) << feed->id << "][Item] "
				<< setw(58) << left << item->GetTitle()
				<< right 
				<< "[" << setw(4) << db_item.id << "][√]"
				<< endl;
#endif
			
			// Insert images
			if (!item->HasImageList())
				continue;
			const list<nfrd::parser::Item::Image>& images =
			item->GetImageList();
			for (list<nfrd::parser::Item::Image>::const_iterator
			     image = images.begin(); image != images.end();
			     ++image)
			{
#ifdef DEBUG
				if (image->second == 0)
					cout << "[" << setw(4) << db_item.id
						<< "][Image] " << setw(62)
						<< left
						<< image->first << right
						<< "[x]" << endl;
#endif
				if (image->second == 0)
					continue;
				
				nfdb::Image db_image(0, db_item.id, (char*)
						     image->second->GetData(),
						     image->second->GetSize(),
						     image->first);
				
				image_controller.AddImage(db_image);
#ifdef DEBUG
				cout << "[" << setw(4) << db_item.id
					<< "][Image] " << setw(62) << left
					<< image->first << right << "[√]"
					<< endl;
#endif
			}
		}
		catch (const exception& err)
		{	// If the error is not because of the unique check
			if(string(err.what()).find("UNIQUE_FEED_CHK")
			   == string::npos)
			{
				log(string("Item: ") + err.what(), 
					"Crawler Thread", log.WARNING);
			}
		}
	}
	if (item_updated > 0)
	{
		try
		{
		
			NotificationController().AddFeedUpdateNotifications
				(feed->id);
#ifdef DEBUG
			cout << "[" << setw(3) << feed->id << "] Notified"
				<< endl;
#endif
		}
		catch (const exception& err)
		{
			log(string("Notification: ") + err.what(),
			    "Crawler Thread", log.WARNING);
		}
		try
		{
			feedDataController->UpdateLastUpdateTime(feed->id);
		}
		catch (const exception& err)
		{
			log(string("Feed Update: ") + err.what(),
			    "Crawler Thread", log.WARNING);
		}
	}
}

// Update the given queue item with the latest info from the feed
void CrawlerThread::UpdateItem(QueueItem* item, nfdb::Feed* feed)
{
	// Update affected users property
	// Update state property (so change new feed to existing feed etc)
}

// Stop the crawler thread from executing
void CrawlerThread::Stop()
{
	this->isAlive = false;
}

// Get the ID of the crawler thread
int CrawlerThread::GetId()
{
	return this->id;
}