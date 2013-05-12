# Author: Michael Boge
# Modification Date: 9/9/12

CC	= g++

# External Path Libraries
# Boost header and library
HBOOST	= /usr/include/boost
LBOOST	= /usr/lib
# mysqlcppconn header and library
HMYSQL = /usr/include/cppconn
LMYSQL = /usr/lib
LIBMYSQL = mysqlcppconn

# Compile flags
INCLUDE	= -I$(HMYSQL) -I$(HBOOST) -I./include
LIBRARIES = -L$(LMYSQL) -L$(LBOOST)

all	: libnfdb


libnfdb	:
	$(CC) -Wall -pedantic $(INCLUDE) $(LIBRARIES) -shared -fpic -o bin/libnfdb.so -l$(LIBMYSQL) ./src/*.cpp

java	: libnfdb
	swig -java -package nfdb -c++ $(CFLAGS) swig/java/java.i
# use this command to generate a jar to use in the web service project
# jar cf nfdb.jar nfdb
# note you need to put the generated class files into an nfdb directory


#Before you can execute this add the line 'using namespace nfdb;' to the java_wrap.cxx file after the #includes (around line 250)
java2	:
	$(CC) -c -fpic swig/java/java_wrap.cxx -I/usr/lib/jvm/jdk1.7.0/include/linux -I/usr/lib/jvm/jdk1.7.0/include -I/usr/include/cppconn -I/usr/include/boost -I.
	$(CC) -Wall -pedantic $(INCLUDE) $(LIBRARIES) -l$(LIBMYSQL) -c ./src/*.cpp
	$(CC) -Wall -pedantic $(LIBRARIES) -shared -fpic *.o -o bin/libnfdb_java.so -l$(LIBMYSQL)
# -Bstatic 
php	: libnfdb
	swig -php -c++ $(CFLAGS) swig/php/php.i

install	:
	mkdir -p /usr/include/libnfdb
	mkdir -p /usr/lib/libnfdb
	cp -u include/*.h /usr/include/libnfdb
	cp -u bin/*.so /usr/lib/libnfdb

clean	:
	rm ./src/*.o

