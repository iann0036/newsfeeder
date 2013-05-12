/**
 * @file	QueueItem.cpp
 * @author	Aron Hardy-Bardsley <ajrhb957@uowmail.edu.au>
 * @date	16/08/12
 *
 * @section	DESCRIPTION
 *
 * A light weight object for representing a feed in the queue
 */

#include "nfrd/QueueItem.h"

using namespace nfrd::module;

// Copy constructor!
QueueItem::QueueItem(nfdb::QueueItem &item)
{
	this->id = item.id;
	this->priority = 1;
	this->timeSpentInQueue = 0;
	this->contentUpdateAverage = 1;
	
	if(item.type != 0)
	{
		this->feedType = *(item.type);
	}
	
	this->usersAffected = 1;
	priorityConstant = 1;
}

QueueItem::QueueItem(unsigned int feedId, short feedType,
	float contentUpdateAverage, int usersAffected)
{
	id = feedId;
	priority = 1;
	timeSpentInQueue = 0;
	contentUpdateAverage = 1;
	feedType = feedType;
	usersAffected = usersAffected;
	priorityConstant = 1;
}

void QueueItem::ResetPriority()
{
	timeSpentInQueue = 0;
}

//Increment operation performed for feeds in queue to recalculate the priority
void QueueItem::IncrementPriority(int maxpop)
{
	timeSpentInQueue += maxpop;
	priority = priorityConstant * timeSpentInQueue / contentUpdateAverage;
}

//Calculates the prioirity constant based on the current values
//priority constant will always be greater than 1
void QueueItem::CalculateConstant(int numUsersInSystem)
{
	priorityConstant = feedType * (1 + usersAffected / numUsersInSystem);
}

// Obtain the feed ID from the object
int QueueItem::GetFeedID() const
{
	return this->id;
}

// Set the content update average
void QueueItem::SetContentUpdateAverage(float contentUpdateAverage)
{
	this->contentUpdateAverage = contentUpdateAverage;
}

// Set the feed type
void QueueItem::SetFeedType(short feedType)
{
	this->feedType = feedType;
}

// Set the affected users count
void QueueItem::SetUsersAffected(int usersAffected)
{
	this->usersAffected = usersAffected;
}