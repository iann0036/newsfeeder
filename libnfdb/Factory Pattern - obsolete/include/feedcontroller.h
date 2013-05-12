#ifndef LIBNFDB_FEEDCONTROLLER
#define LIBNFDB_FEEDCONTROLLER

#include "feed.h"
#include "ifeedcontroller.h"

class FeedController : public IFeedController
{
	public:
		Feed GetFeedById(int id);
		void UpdateFeed(Feed& feed);
		void AddFeed(Feed& feed);
};

#endif
