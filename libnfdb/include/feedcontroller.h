#ifndef LIBNFDB_FEEDCONTROLLER
#define LIBNFDB_FEEDCONTROLLER

#include "feed.h"

class FeedController
{
	public:
		Feed GetFeedById(int id);
		void UpdateFeed(Feed& feed);
		void AddFeed(Feed& feed);
};

#endif
