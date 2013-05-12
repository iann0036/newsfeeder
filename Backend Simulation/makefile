VPATH = 
OBJS=queueoperator.o crawler.o feed.o main.o
CC=g++
CFLAGS= 
LFLAGS= -lpthread -l:libboost_thread.so.1.42.0
crawler : $(OBJS)
	$(CC) $(LFLAGS) -o crawler $(OBJS)

main.o : main.cpp queueoperator.o
	$(CC) $(CFLAGS) -c main.cpp

queueoperator.o : queueoperator.cpp crawler.o feed.o
	$(CC) $(CFLAGS) -c queueoperator.cpp

crawler.o : crawler.cpp feed.o
	$(CC) $(CFLAGS) -c crawler.cpp

feed.o : feed.cpp
	$(CC) $(CFLAGS) -c feed.cpp

clean : 
	rm *.o crawler
