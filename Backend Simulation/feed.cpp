#include "feed.h"

using namespace newsreader;

void Feed::incrementPriority()
{
	timeSpentInQueue++;
	generatedPriority = timeSpentInQueue / contentUpdateAverage;
}
