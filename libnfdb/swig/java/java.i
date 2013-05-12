#define JAVASWIG

%module libnfdb
%{
	#include "include/user.h"
	#include "include/sheet.h"
	#include "include/feed.h"
	#include "include/datetime.h"
	#include "include/usercontroller.h"
	#include "include/sheetcontroller.h"
	#include "include/feedcontroller.h"
%}

%include "include/datetime.h"

%include "include/user.h"
%include "include/sheet.h"
%include "include/feed.h"

%include "include/sheetcontroller.h"
%include "include/usercontroller.h"
%include "include/feedcontroller.h"
