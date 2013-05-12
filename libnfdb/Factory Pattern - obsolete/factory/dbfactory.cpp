#include "include/dbfactory.h"

#include "include/ifeedcontroller.h"
#include "include/isheetcontroller.h"
#include "include/iusercontroller.h"

#include "include/feedcontroller.h"
#include "include/sheetcontroller.h"
#include "include/usercontroller.h"


IFeedController* DBFactory::GetFeedController()
{
	return (IFeedController*) new FeedController();
}

IUserController* DBFactory::GetUserController()
{
	return (IUserController*) new UserController();
}

ISheetController* DBFactory::GetSheetController()
{
	return (ISheetController*) new SheetController();
}
