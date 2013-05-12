# Author Name: Shiwei Zhang
# Modification Date: 18/10/12
# File Description: makefile to compile program "nfrd"

# When use CC as compiler, please comment the CHECK variable
#CC	= CC
CC	= g++
CHECK	= -Wall -ansi -Wno-pragmas

# cc is used to compile C libraries (although it is not used for nfrd)
#cc	= cc
cc	= gcc

# External Path
# Boost header and library
HBOOST	= /usr/local/include
LBOOST	= /ust/local/lib

# Path
HNFRD	= include/nfrd

# Compile flags
INCLUDE	= -Iinclude -I$(HBOOST) -I/usr/include
CEXTRA	= -O2
CFLAG	= $(INCLUDE) $(CHECK) $(CEXTRA)
# -D QUEUEING_SIMULATION=1

# Link flags
# Note: to force compiling using static library, add "-static" to LFLAG
# Use /usr/lib instead of lib to use installed libs instead of project libs
LIBRARY	= -L$(LBOOST) -L/usr/lib -Llib -L/usr/lib/libnfdb
LINK	= -lboost_system -lboost_thread -lcurl -lnfdb -lmysqlcppconn -lgd \
	  -lhtmlcxx
LFLAG	= $(LIBRARY) $(LINK)

# Object
OCONFIG	= obj/ConfigManager.o
OMODULE	= obj/AdminService.o obj/AdminServiceThread.o obj/Crawler.o \
	  obj/Module.o obj/Master.o obj/QueueItem.o obj/CrawlerThread.o \
	  obj/FeedPriorityQueue.o obj/Statistics.o
OLOG	= obj/LogManager.o
OMISC	= obj/DateTime.o obj/Utility.o obj/Image.o
OPARSER	= obj/Parser.o obj/RSSParser.o obj/AtomParser.o obj/FeedParser.o \
	  obj/FeedXParser.o
ONFRD	= obj/nfrd.o
OBJECTS	= $(OCONFIG) $(OMODULE) $(OLOG) $(OMISC) $(OPARSER) $(ONFRD) $(ODB)

# Make rules
all:	object nfrd
object:
	mkdir -p obj

# News Feeder Refresh Daemon
nfrd:	$(OBJECTS)
	$(CC) $(OBJECTS) $(LFLAG) -o nfrd

# config
obj/ConfigManager.o:	$(HNFRD)/ConfigManager.h src/ConfigManager.cpp
	$(CC) $(CFLAG) -c src/ConfigManager.cpp -o obj/ConfigManager.o

# module
obj/AdminService.o:	$(HNFRD)/AdminService.h $(HNFRD)/Module.h \
			$(HNFRD)/AdminServiceThread.h $(HNFRD)/ConfigManager.h \
			$(HNFRD)/LogManager.h $(HNFRD)/Master.h \
			$(HNFRD)/Utility.h src/AdminService.cpp
	$(CC) $(CFLAG) -c src/AdminService.cpp -o obj/AdminService.o

obj/AdminServiceThread.o:	$(HNFRD)/AdminService.h $(HNFRD)/Module.h \
				$(HNFRD)/AdminServiceThread.h \
				$(HNFRD)/ConfigManager.h $(HNFRD)/LogManager.h \
				$(HNFRD)/Master.h $(HNFRD)/Utility.h \
				$(HNFRD)/Crawler.h src/AdminServiceThread.cpp
	$(CC) $(CFLAG) -c src/AdminServiceThread.cpp -o obj/AdminServiceThread.o
	
obj/Module.o:	$(HNFRD)/Module.h $(HNFRD)/ConfigManager.h \
		$(HNFRD)/LogManager.h src/Module.cpp
	$(CC) $(CFLAG) -c src/Module.cpp -o obj/Module.o

obj/Master.o:	$(HNFRD)/Master.h $(HNFRD)/Utility.h $(HNFRD)/ConfigManager.h \
		$(HNFRD)/LogManager.h $(HNFRD)/Module.h \
		$(HNFRD)/AdminService.h $(HNFRD)/Crawler.h \
		$(HNFRD)/Statistics.h src/Master.cpp
	$(CC) $(CFLAG) -c src/Master.cpp -o obj/Master.o

obj/Statistics.o:	$(HNFRD)/Statistics.h $(HNFRD)/Module.h \
			$(HNFRD)/ConfigManager.h $(HNFRD)/LogManager.h \
			$(HNFRD)/Utility.h src/Statistics.cpp
	$(CC) $(CFLAG) -c src/Statistics.cpp -o obj/Statistics.o

# Crawler
obj/Crawler.o:	$(HNFRD)/Crawler.h $(HNFRD)/ConfigManager.h \
		$(HNFRD)/LogManager.h $(HNFRD)/Module.h $(HNFRD)/Parser.h \
		$(HNFRD)/FeedPriorityQueue.h $(HNFRD)/RSSParser.h \
		 $(HNFRD)/DateTime.h src/Crawler.cpp
	$(CC) $(CFLAG) -c src/Crawler.cpp -o obj/Crawler.o

obj/CrawlerThread.o:	$(HNFRD)/CrawlerThread.h $(HNFRD)/QueueItem.h \
		$(HNFRD)/LogManager.h $(HNFRD)/ConfigManager.h \
		$(HNFRD)/FeedPriorityQueue.h src/CrawlerThread.cpp
	$(CC) $(CFLAG) -c src/CrawlerThread.cpp -o obj/CrawlerThread.o

obj/FeedPriorityQueue.o:	$(HNFRD)/FeedPriorityQueue.h $(HNFRD)/QueueItem.h \
		$(HNFRD)/LogManager.h $(HNFRD)/ConfigManager.h \
		src/FeedPriorityQueue.cpp
	$(CC) $(CFLAG) -c src/FeedPriorityQueue.cpp -o obj/FeedPriorityQueue.o
	
obj/QueueItem.o:	$(HNFRD)/QueueItem.h src/QueueItem.cpp
	$(CC) $(CFLAG) -c src/QueueItem.cpp -o obj/QueueItem.o
	
# log
obj/LogManager.o:	$(HNFRD)/LogManager.h src/LogManager.cpp
	$(CC) $(CFLAG) -c src/LogManager.cpp -o obj/LogManager.o

# misc
obj/DateTime.o:	$(HNFRD)/DateTime.h src/DateTime.cpp
	$(CC) $(CFLAG) -c src/DateTime.cpp -o obj/DateTime.o

obj/Utility.o:	$(HNFRD)/Utility.h src/Utility.cpp
	$(CC) $(CFLAG) -c src/Utility.cpp -o obj/Utility.o

obj/Image.o:	$(HNFRD)/Image.h $(HNFRD)/Utility.h src/Image.cpp
	$(CC) $(CFLAG) -c src/Image.cpp -o obj/Image.o

# parser
obj/Parser.o:	$(HNFRD)/Parser.h $(HNFRD)/Image.h src/Parser.cpp
	$(CC) $(CFLAG) -c src/Parser.cpp -o obj/Parser.o
	
obj/FeedParser.o:	$(HNFRD)/FeedParser.h $(HNFRD)/Parser.h \
			$(HNFRD)/DateTime.h $(HNFRD)/Utility.h src/FeedParser.cpp
	$(CC) $(CFLAG) -c src/FeedParser.cpp -o obj/FeedParser.o

obj/RSSParser.o:	$(HNFRD)/RSSParser.h $(HNFRD)/Parser.h \
			$(HNFRD)/FeedParser.h $(HNFRD)/DateTime.h \
			$(HNFRD)/Utility.h src/RSSParser.cpp
	$(CC) $(CFLAG) -c src/RSSParser.cpp -o obj/RSSParser.o

obj/AtomParser.o:	$(HNFRD)/AtomParser.h $(HNFRD)/Parser.h \
			$(HNFRD)/FeedParser.h $(HNFRD)/DateTime.h \
			$(HNFRD)/Utility.h src/AtomParser.cpp
	$(CC) $(CFLAG) -c src/AtomParser.cpp -o obj/AtomParser.o

obj/FeedXParser.o:	$(HNFRD)/RSSParser.h $(HNFRD)/AtomParser.h \
			$(HNFRD)/Parser.h \
			$(HNFRD)/FeedParser.h $(HNFRD)/DateTime.h \
			$(HNFRD)/Utility.h src/FeedXParser.cpp
	$(CC) $(CFLAG) -c src/FeedXParser.cpp -o obj/FeedXParser.o
	
# nfrd main
obj/nfrd.o:	$(HNFRD)/Master.h src/nfrd.cpp
	$(CC) $(CFLAG) -c src/nfrd.cpp -o obj/nfrd.o
	
# Clean
cleanobj:
	rm -rf obj
clean:
	rm -rf obj nfrd
