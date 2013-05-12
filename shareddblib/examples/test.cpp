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
/*	FeedController* fc = new FeedController();
	vector<Feed> feeds = fc->GetAllFeeds();
	for(vector<Feed>::iterator it = feeds.begin(); it < feeds.end(); it++)
	{
		cout << *it->name << endl;
		it->Destroy();
	}

	delete fc;
*/
/*	misc::DateTime* d = new misc::DateTime();
	d->ImportFromMySQL("2012-08-09 21:54:45");
	Feed ff;
	cout << "YAY" << endl;
	ff.url = new string("yay9");
	ff.name = new string("yay9");
	ff.frequency = new int(3);
	ff.lastUpdate = d;
	cout << "YAY" << endl;
	cout << fc->AddFeed(ff) << endl;
	cout << "YAY" << endl;
	delete fc;
	cout << "YAY" << endl;
	ff.Destroy();
	cout << "YAY" << endl;		*/


/*	Image im;
	im.itemId = new int(4405);
	ifstream file("test.gif", ios::in|ios::binary);
	file.seekg(0, ios::end);
	int length = file.tellg();
	file.seekg(0, ios::beg);

	char* buff = new char[length];
	file.read(buff, length);
//	istream_iterator<char> it(file);
//	istream_iterator<char> endit;
//	string yay(it, endit);
//	cout << yay.size() << endl;
	im.image = buff;
	im.imageSize = new int(length);	*/
/*
	ImageController* imc = new ImageController();
	Image im = imc->GetImageById(10);

	ofstream file("test2.gif", ios::out|ios::binary);
	cout << "YAY" << endl;
	file.write(im.image, *im.imageSize);
	cout << "YAY" << endl;
	file.close();
	cout << "YAY" << endl;
	//imc->AddImage(im);	*/

	return 0;
}
