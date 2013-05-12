#include <libnfdb/feedcontroller.h>
#include <libnfdb/feed.h>

int main()
{
	FeedController feedController;
	Feed f;

	feedController.UpdateFeed(f);

	return 0;
}
