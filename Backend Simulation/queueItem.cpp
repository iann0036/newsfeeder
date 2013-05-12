#include "queueItem.h"

using namespace newsreader;

//Constant for now, this will also be populated by the database transactions
const int numUsersInSystem = 10000;

QueueItem::QueueItem(unsigned int feedId)
{
	id = feedId;

	CalculateConstant();
	
}

//Increment operation performed for all feeds in queue to recalculate the priority
void QueueItem::IncrementPriority()
{
	timeSpentInQueue++;
	priority = priorityConstant * timeSpentInQueue / contentUpdateAverage;
	
	/* Alternatively we can calculate this by using:
	timeSpentInQueue++;
	priority += priorityConstant / contentUpdateAverage;
	*/
}

//Calculates the prioirity constant based on the current values
void QueueItem::CalculateConstant()
{
	UpdateValues();
	
	//priority constant will always be greater than 1
	priorityConstant = feedType * (1 + numUsers / numUsersInSystem);
}

//Calls the database to get the relevant feed values
void QueueItem::UpdateValues()
{
	
}
