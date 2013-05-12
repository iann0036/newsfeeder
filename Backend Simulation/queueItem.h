#ifndef QUEUEITEM_H
#define QUEUEITEM_H

namespace newsreader
{
	class QueueItem
	{
		public:
			QueueItem(unsigned int);
			void IncrementPriority();
			void CalculateConstant();
			
		private:
			unsigned int id;		//Feed's ID in the database
			float priority;
			float priorityConstant;
			float timeSpentInQueue;
			float contentUpdateAverage;
			short feedType;
			/*Feed type is based off an enum in the datbase:
				1 - user feed
				2 - default feed
				100 - first crawl
			*/
			int numberOfUsers;	
			
			void UpdateValues();
	};

}

#endif