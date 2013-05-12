#ifndef LIBNFDB_SHEET
#define LIBNFDB_SHEET

#include <string>
#include "datetime.h"

using namespace std;

class Sheet
{
	private:
		int id;
		string name;
		DateTime updated;
};

#endif
