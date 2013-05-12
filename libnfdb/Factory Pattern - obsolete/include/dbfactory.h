#ifndef LIBNFDB_DBFACTORY
#define LIBNFDB_DBFACTORY

#include "ifeedcontroller.h"
#include "isheetcontroller.h"
#include "iusercontroller.h"

class DBFactory
{
	public: 
		static IFeedController* GetFeedController();
		static ISheetController* GetSheetController();
		static IUserController* GetUserController();
};

#endif
