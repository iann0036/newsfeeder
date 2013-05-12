#ifndef FEED_H
#define FEED_H

namespace newsreader
{
	class Feed
	{
		public:
			void incrementPriority();

			//float timeSinceLastUpdate;
			//int numberOfUsers;
			float contentUpdateAverage;
			int timeSpentInQueue;

			float generatedPriority;
	};
}

#endif
