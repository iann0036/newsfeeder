#define PHPSWIG

%module libnfdb
%{
	#include "include/user.h"
	#include "include/sheet.h"
	#include "include/feed.h"
	#include "include/datetime.h"
	#include "include/iusercontroller.h"
	#include "include/isheetcontroller.h"
	#include "include/ifeedcontroller.h"
	#include "include/dbfactory.h"
%}

%include "include/datetime.h"

%include "include/user.h"
%include "include/sheet.h"
%include "include/feed.h"

%include "include/isheetcontroller.h"
%include "include/iusercontroller.h"
%include "include/ifeedcontroller.h"

%include "include/dbfactory.h"
