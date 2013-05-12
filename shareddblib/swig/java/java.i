#define JAVASWIG

%module libnfdb

%rename(LessThan) operator<;
%rename(GreaterThan) operator>;
%rename(EqualsEquals) operator==;
%rename(NotEquals) operator!=;

%{
	#include "/usr/include/libnfdb/DateTime.h"
	#include "include/Comment.h"
	#include "include/CommentController.h"
	#include "include/ContentPlaceholder.h"
	#include "include/ContentPlaceholderController.h"
	#include "include/DatabaseController.h"
	#include "include/Feed.h"
	#include "include/FeedController.h"
	#include "include/GroupPlaceholder.h"
	#include "include/GroupPlaceholderController.h"
	#include "include/Image.h"
	#include "include/ImageController.h"
	#include "include/Item.h"
	#include "include/ItemController.h"
	#include "include/Layout.h"
	#include "include/LayoutController.h"
	#include "include/Notification.h"
	#include "include/NotificationController.h"
	#include "include/QueueItem.h"
	#include "include/Session.h"
	#include "include/SessionController.h"
	#include "include/Sheet.h"
	#include "include/SheetController.h"
	#include "include/Stat.h"
	#include "include/StatController.h"
	#include "include/User.h"
	#include "include/UserController.h"
%}

%include "std_string.i"
%include "std_vector.i"
namespace std {
	%template(commentvector) vector<nfdb::Comment*>;
	%template(cphvector) vector<nfdb::ContentPlaceholder*>;
	%template(feedvector) vector<nfdb::Feed*>;
	%template(gphvector) vector<nfdb::GroupPlaceholder*>;
	%template(imagevector) vector<nfdb::Image*>;
	%template(itemvector) vector<nfdb::Item*>;
	%template(layoutvector) vector<nfdb::Layout*>;
	%template(notificationvector) vector<nfdb::Notification*>;
	%template(queueitemvector) vector<nfdb::QueueItem*>;
	%template(sessionvector) vector<nfdb::Session*>;
	%template(sheetvector) vector<nfdb::Sheet*>;
	%template(statvector) vector<nfdb::Stat*>;
	%template(uservector) vector<nfdb::User*>;
};

%include "/usr/include/libnfdb/DateTime.h"

%include "include/Comment.h"
%include "include/CommentController.h"
%include "include/ContentPlaceholder.h"
%include "include/ContentPlaceholderController.h"
%include "include/DatabaseController.h"
%include "include/Feed.h"
%include "include/FeedController.h"
%include "include/GroupPlaceholder.h"
%include "include/GroupPlaceholderController.h"
%include "include/Image.h"
%include "include/ImageController.h"
%include "include/Item.h"
%include "include/ItemController.h"
%include "include/Layout.h"
%include "include/LayoutController.h"
%include "include/Notification.h"
%include "include/NotificationController.h"
%include "include/QueueItem.h"
%include "include/Session.h"
%include "include/SessionController.h"
%include "include/Sheet.h"
%include "include/SheetController.h"
%include "include/Stat.h"
%include "include/StatController.h"
%include "include/User.h"
%include "include/UserController.h"

%rename (FeedController) nfdb::FeedController;

