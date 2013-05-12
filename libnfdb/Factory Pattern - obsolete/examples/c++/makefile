OBJS=main.o
CC=g++
CFLAGS= -I/usr/include/libnfdb
LFLAGS= -I/usr/include/libnfdb -L/usr/lib/libnfdb -lnfdb -Wl,--rpath=/usr/lib/libnfdb 

cppexample : main.o
	$(CC) $(LFLAGS) -o cppexample $(OBJS)

main.o : 
	$(CC) $(CFLAGS) -c main.cpp

clean : 
	rm -f *.o
	rm -f cppexample
