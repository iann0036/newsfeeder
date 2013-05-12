#include <iostream>
#include "queueoperator.h"

using namespace std;
using namespace newsreader;

int main()
{
	QueueOperator* queueop = new QueueOperator();

	boost::thread_group threads;
	threads.create_thread(boost::bind(&QueueOperator::initialiseCrawl, queueop));


	while(true)
	{
		boost::this_thread::sleep(boost::posix_time::seconds(100));
	}

	return 0;
}
