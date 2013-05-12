TOP := $(lastword $(MAKEFILE_LIST))
JC=javac

default: 
	$(JC) -d . /usr/include/libnfdb/java/*.java Main.java

clean:
	rm *.class
