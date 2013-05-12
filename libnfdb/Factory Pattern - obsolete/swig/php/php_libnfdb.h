/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 * 
 * This file is not intended to be easily readable and contains a number of 
 * coding conventions designed to improve portability and efficiency. Do not make
 * changes to this file unless you know what you are doing--modify the SWIG 
 * interface file instead. 
 * ----------------------------------------------------------------------------- */

#ifndef PHP_LIBNFDB_H
#define PHP_LIBNFDB_H

extern zend_module_entry libnfdb_module_entry;
#define phpext_libnfdb_ptr &libnfdb_module_entry

#ifdef PHP_WIN32
# define PHP_LIBNFDB_API __declspec(dllexport)
#else
# define PHP_LIBNFDB_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_MINIT_FUNCTION(libnfdb);
PHP_MSHUTDOWN_FUNCTION(libnfdb);
PHP_RINIT_FUNCTION(libnfdb);
PHP_RSHUTDOWN_FUNCTION(libnfdb);
PHP_MINFO_FUNCTION(libnfdb);

ZEND_NAMED_FUNCTION(_wrap_new_DateTime);
ZEND_NAMED_FUNCTION(_wrap_DateTime_ExportToMySQL);
ZEND_NAMED_FUNCTION(_wrap_DateTime_ImportFromMySQL);
ZEND_NAMED_FUNCTION(_wrap_DateTime_ParseFromString);
ZEND_NAMED_FUNCTION(_wrap_DateTime_GetSecond);
ZEND_NAMED_FUNCTION(_wrap_DateTime_GetMinute);
ZEND_NAMED_FUNCTION(_wrap_DateTime_GetHour);
ZEND_NAMED_FUNCTION(_wrap_DateTime_GetDay);
ZEND_NAMED_FUNCTION(_wrap_DateTime_GetMonth);
ZEND_NAMED_FUNCTION(_wrap_DateTime_GetYear);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetSecond);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetMinute);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetHour);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetDay);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetMonth);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetYear);
ZEND_NAMED_FUNCTION(_wrap_DateTime_Set);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetTimeOffset);
ZEND_NAMED_FUNCTION(_wrap_DateTime_SetDateOffset);
ZEND_NAMED_FUNCTION(_wrap_new_User);
ZEND_NAMED_FUNCTION(_wrap_new_Sheet);
ZEND_NAMED_FUNCTION(_wrap_new_Feed);
ZEND_NAMED_FUNCTION(_wrap_ISheetController_GetSheetById);
ZEND_NAMED_FUNCTION(_wrap_ISheetController_UpdateSheet);
ZEND_NAMED_FUNCTION(_wrap_ISheetController_AddSheet);
ZEND_NAMED_FUNCTION(_wrap_IUserController_GetUserById);
ZEND_NAMED_FUNCTION(_wrap_IUserController_GetUserByUsername);
ZEND_NAMED_FUNCTION(_wrap_IUserController_UpdateUser);
ZEND_NAMED_FUNCTION(_wrap_IUserController_AddUser);
ZEND_NAMED_FUNCTION(_wrap_IFeedController_GetFeedById);
ZEND_NAMED_FUNCTION(_wrap_IFeedController_UpdateFeed);
ZEND_NAMED_FUNCTION(_wrap_IFeedController_AddFeed);
ZEND_NAMED_FUNCTION(_wrap_DBFactory_GetFeedController);
ZEND_NAMED_FUNCTION(_wrap_DBFactory_GetSheetController);
ZEND_NAMED_FUNCTION(_wrap_DBFactory_GetUserController);
ZEND_NAMED_FUNCTION(_wrap_new_DBFactory);
#endif /* PHP_LIBNFDB_H */
