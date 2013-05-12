OBJS=dbconnection.o usercontroller.o sheetcontroller.o feedcontroller.o querybuilder.o dbfactory.o datetime.o
CC=g++
CFLAGS= -I/usr/include/mysql -I/usr/include/mysql++ -I.
LFLAGS= -I/usr/include/mysql -I/usr/include/mysql++ -lmysqlpp -shared -fpic

libnfdb : $(OBJS)
	$(CC) $(LFLAGS) -o bin/libnfdb.so $(OBJS)

java : libnfdb
	swig -java -c++ $(CFLAGS) swig/java/java.i
	$(CC) -c -fpic swig/java/java_wrap.cxx -I/usr/lib/jvm/java-6-openjdk/include -I/usr/lib/jvm/java-6-openjdk/include/linux -I.
	$(CC) -shared $(OBJS) java_wrap.o -o bin/libnfdb_java.so

php : libnfdb
	swig -php -c++ $(CFLAGS) swig/php/php.i
	$(CC) -c -fpic swig/php/php_wrap.cpp -I/usr/include/php5/Zend -I/usr/include/php5/TSRM -I/usr/include/php5 -I/usr/include/php5/ext -I/usr/include/php5/main -I.
	$(CC) -shared $(OBJS) php_wrap.o -o bin/libnfdb_php.so

example : 
	make -C examples/c++

all	: libnfdb java php example
	

install :
	mkdir -p /usr/include/libnfdb
	mkdir -p /usr/lib/libnfdb
	mkdir -p /usr/include/libnfdb/java
	mkdir -p /usr/include/libnfdb/php
	cp -u include/datetime.h /usr/include/libnfdb/datetime.h
	cp -u include/sheet.h /usr/include/libnfdb/sheet.h
	cp -u include/feed.h /usr/include/libnfdb/feed.h
	cp -u include/user.h /usr/include/libnfdb/user.h
	cp -u include/ifeedcontroller.h /usr/include/libnfdb/ifeedcontroller.h
	cp -u include/iusercontroller.h /usr/include/libnfdb/iusercontroller.h
	cp -u include/isheetcontroller.h /usr/include/libnfdb/isheetcontroller.h
	cp -u include/dbfactory.h /usr/include/libnfdb/dbfactory.h
	cp -u bin/* /usr/lib/libnfdb
	cp -u swig/java/*.java /usr/include/libnfdb/java
	cp -u swig/php/*.php /usr/include/libnfdb/php

uninstall : 
	rm -R /usr/include/libnfdb
	rm -R /usr/lib/libnfdb

dbconnection.o : 
	$(CC) $(CFLAGS) -c util/dbconnection.cpp

dbfactory.o : usercontroller.o sheetcontroller.o feedcontroller.o
	$(CC) $(CFLAGS) -c factory/dbfactory.cpp

usercontroller.o : datetime.o
	$(CC) $(CFLAGS) -c controller/usercontroller.cpp

sheetcontroller.o : datetime.o
	$(CC) $(CFLAGS) -c controller/sheetcontroller.cpp

feedcontroller.o : datetime.o
	$(CC) $(CFLAGS) -c controller/feedcontroller.cpp

querybuilder.o : datetime.o
	$(CC) $(CFLAGS) -c util/querybuilder.cpp

datetime.o : 
	$(CC) $(CFLAGS) -c util/datetime.cpp

clean : 
	rm -f *.o
	rm -f libnfdb
	rm -f bin/*
	rm -f swig/java/*.java
	rm -f swig/java/*.cxx
	rm -f swig/php/*.h
	rm -f swig/php/*.cpp
	rm -f swig/php/*.php
	make -C examples/c++ clean
