#ifndef CRAWLER_H
#define CRAWLER_H

#include "queueoperator.h"

namespace newsreader
{
	class QueueOperator;
	class Crawler
	{
		public: 
			Crawler(QueueOperator* queueop);
			void initialiseCrawling();
		private:
			void request();
			void crawl(Feed* feed);
			QueueOperator* queueoperator;
	};
}

#endif
