#ifndef LIBNFDB_ISHEETCONTROLLER
#define LIBNFDB_ISHEETCONTROLLER

#include "sheet.h"

class ISheetController
{
	public:
		virtual Sheet GetSheetById(int id) = 0;
		virtual void UpdateSheet(Sheet& sheet) = 0;
		virtual void AddSheet(Sheet& sheet) = 0;
};

#endif
