#ifndef LIBNFDB_IFEEDCONTROLLER
#define LIBNFDB_IFEEDCONTROLLER

#include "feed.h"

class IFeedController
{
	public:
		virtual Feed GetFeedById(int id) = 0;
		virtual void UpdateFeed(Feed& feed) = 0;
		virtual void AddFeed(Feed& feed) = 0;
};

#endif
