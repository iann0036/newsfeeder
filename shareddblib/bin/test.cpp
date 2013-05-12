//#include "DatabaseController.h"
#include "FeedController.h"
#include "ItemController.h"
#include "ImageController.h"
#include "Entities.h"
#include "DateTime.h"
#include <iostream>
#include <iterator>
#include <fstream>
#include <string>
#include <vector>
//#include "connection.h"
//#include "driver.h"
//#include "statement.h"

using namespace std;
using namespace sql;
using namespace nfrd;

int main()
{
	FeedController* fc = new FeedController();

	Feed f = fc->GetFeedById(34);
	cout << f.name << endl;

	misc::DateTime* d = new misc::DateTime();
	d->ImportFromMySQL("2012-08-09 21:54:45");
//	Feed ff;
//	ff.url = "yay2";
//	ff.name = "yay2";
//	ff.frequency = 2;
//	ff.lastUpdate = *d;
//	ff.category = "yay2";
//	ff.type = 2;
//	fc->AddFeed(ff);

	vector<Feed> vf = fc->GetQueueFeeds();
	cout << vf.size() << endl;

	Item ii;
//	ii.feedId = 34;
//	ii.title = "YAY";
//	ii.url = "YAY";
//	ii.content = "YAY";
//	ii.postDate = *d;
//	ii.author = "MR YAY";
//	ii.geolocation = "YAY";
	
//	ItemController* ic = new ItemController();
//	ic->AddItem(ii);

//	delete ic;

	Image im;
	im.itemId = 4405;
	ifstream file("test.gif", ios::in|ios::binary);
	file.seekg(0, ios::end);
	int length = file.tellg();
	file.seekg(0, ios::beg);

	istream_iterator<char> it(file);
	istream_iterator<char> endit;
	string yay(it, endit);
	cout << yay.size() << endl;
	im.image = yay;

//	cout << im.image << " - " << length << endl;
//	cout << im.image.size() << endl;
	ImageController* imc = new ImageController();
	imc->AddImage(im);

	file.close();
//	ofstream file2("test2.gif", ios::out|ios::binary);
//	file2.write(im.image.c_str(), im.image.size());
//	file2.close();

	delete fc;
	delete d;

	return 0;
}
