News Feeder
==========

News Feeder is a news feed aggregator service, which compiles content from multiple online content sources. Its main purpose is to provide a single location and format to view news content instead of users having to access multiple websites for their specific news. News Feeder was a University of Wollongong CSCI321 project.

==========

/*****************************************************************************
The following document outlines what sections of code were written the team
members.
*****************************************************************************/
/*****************************************************************************
FRONT-END	(/Front-end)
*****************************************************************************/
All files within the following directories were written by Ian Mckay:
/abuse
/account
/admin
/classes (except /class/thirdparty)
/contact
/faq
/members
/misc
/settings
/templates
.htaccess
error.php
index.php
robots.txt
sitemap.xml

/*****************************************************************************
BACK-END	(/Back-end)
*****************************************************************************/
All files within this section were written by Shiwei Zhang and Aron Bardsley
The exceptions being:
- Files in the lib directory
- All files in the include directory excluding those in include/nfrd

Aron Bardsley's files (both headers and source) were:
- FeedPriorityQueue
- QueueItem

Joint files were:
- Crawler
- CrawlerThread

Shiwei Zhang's files were:
The remaining files

/*****************************************************************************
SHARED DATABASE LIBRARY	(/shareddblib)
*****************************************************************************/
All files within the include and src directories were written by Michael Boge
Other C++ and Java files were automatically generated by SWIG

/*****************************************************************************
DOWNLOADER APPLICATION	(/nfdbDownloader)
*****************************************************************************/

/*****************************************************************************
WEB SERVICE	(/WebService)
*****************************************************************************/