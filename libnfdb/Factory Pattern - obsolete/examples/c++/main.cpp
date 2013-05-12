#include <libnfdb/dbfactory.h>

int main()
{
	IFeedController* feedController = DBFactory::GetFeedController();
	Feed f;

	feedController->UpdateFeed(f);

	return 0;
}
