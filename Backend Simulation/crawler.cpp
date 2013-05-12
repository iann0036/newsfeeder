#include <boost/thread/thread.hpp>
#include <iostream>
#include "crawler.h"

using namespace std;
using namespace newsreader;

Crawler::Crawler(QueueOperator* queueop)
{
	this->queueoperator = queueop;
}

void Crawler::initialiseCrawling()
{
	request();
}

void Crawler::request()
{
	Feed* feed;

	while(true)
	{
		this->queueoperator->getFeed(feed);

		crawl(feed);
	}
}

void Crawler::crawl(Feed* feed)
{
	//do crawling stuff here...
	boost::this_thread::sleep(boost::posix_time::milliseconds(500 + rand() % 1000 + 1));
	cout << feed->generatedPriority << " " << feed->timeSpentInQueue << " " << feed->contentUpdateAverage << endl;
}
