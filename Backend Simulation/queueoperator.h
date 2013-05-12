#ifndef QUEUEOPERATOR_H
#define QUEUEOPERATOR_H

#include <boost/thread/thread.hpp>
#include <queue>
#include <list>
#include "feed.h"
#include "crawler.h"

using namespace std;

namespace newsreader
{
	class Crawler;

	class QueueOperator
	{
		public:
			void initialiseCrawl();
			void getFeed(Feed*& feed);
			void beginIterateLoop();

		private:
			void iterateonce();
			void initialiseQueue();
			void continuousCrawl();
			void startThreads();
			mutable boost::mutex queueMutex;
			boost::condition_variable queueCondition;
			boost::thread_group threads;
			list<Crawler*> crawlers;
			vector<Feed*> feedQueue;
			boost::condition_variable removeFromQueueCondition;
			bool hasPopped;
	};
}

#endif
