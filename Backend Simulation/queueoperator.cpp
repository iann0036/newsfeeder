#include <boost/thread/thread.hpp>
#include <algorithm>
#include <vector>
#include <iostream>
#include "queueoperator.h"
#include "feed.h"
#include "crawler.h"
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

using namespace std;
using namespace newsreader;

const int THREADCOUNT = 20;
int currentCount = 0;

void QueueOperator::initialiseCrawl()
{
	srand (time(NULL));
	hasPopped = true;

	startThreads();
	initialiseQueue();
	continuousCrawl();
}

void QueueOperator::startThreads()
{
	for(int i = 0; i < THREADCOUNT; i++)
	{
		Crawler* crawler = new Crawler(this);
		crawlers.push_front(crawler);

		threads.create_thread(boost::bind(&Crawler::initialiseCrawling, crawler));
	}
}

void QueueOperator::initialiseQueue()
{
	for(int i = 0; i < 200000; i++)
	{
		Feed* feed = new Feed();
		//Initialise with random values
		feed->timeSpentInQueue = 0;
		feed->contentUpdateAverage = rand() % 100 + 1;

		feedQueue.push_back(feed);
	}
}

void QueueOperator::continuousCrawl()
{
	while(true)
	{
		iterateonce();
		//check for new feeds
	}
}

bool feed_comparer(Feed* feedA, Feed* feedB)
{
	return (feedA->generatedPriority > feedB->generatedPriority);
}

void QueueOperator::beginIterateLoop()
{
	cout << "Notified" << endl;
	removeFromQueueCondition.notify_one();
	cout << "Notified" << endl;
}

void QueueOperator::iterateonce()
{
	vector<Feed*>::iterator it;
	boost::mutex::scoped_lock lock(queueMutex);
	
	//while(!hasPopped)
	//{
	//
	//}

	if(hasPopped)
	{
		cout << "iterating" << endl;
		//Loop through and recalculate..
		for (it = feedQueue.begin(); it < feedQueue.end(); it++)
		{
			(*it)->incrementPriority();
		}

		make_heap (feedQueue.begin(), feedQueue.end(), feed_comparer);

		hasPopped = false;
	}

	queueCondition.notify_one();
}

void QueueOperator::getFeed(Feed*& feed)
{
	boost::mutex::scoped_lock lock(queueMutex);

	//While we are waiting for something to pop...
	while(hasPopped)
	{
		queueCondition.wait(lock);
	}

	currentCount++;
	if(currentCount % 100 == 0)
	{
		cout << "REACHED " << currentCount << endl;
	}

	feed = feedQueue.back();
	pop_heap (feedQueue.begin(),feedQueue.end());
	feedQueue.pop_back();

	hasPopped = true;

	//removeFromQueueCondition.notify_one();
}

