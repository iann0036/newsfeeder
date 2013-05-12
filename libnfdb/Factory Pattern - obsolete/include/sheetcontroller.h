#ifndef LIBNFDB_SHEETCONTROLLER
#define LIBNFDB_SHEETCONTROLLER

#include "sheet.h"

class SheetController
{
	public:
		Sheet GetSheetById(int id);
		void UpdateSheet(Sheet& sheet);
		void AddSheet(Sheet& sheet);
};

#endif
