/**
 * @file	nfrd.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	30/04/12
 *
 * @section	DESCRIPTION
 *
 * Program entrance of News Feeder Refresh Daemon(nfrd).
 * The main function will calls interface of nfrd::Master
 */

#include <iostream>
#include <signal.h>
#include <unistd.h>
#include <errno.h>
#include "nfrd/Master.h"
using namespace std;

/// Global tracking on nfrd master instance
static nfrd::Master* tracker = 0;

/**
 * A signal handler to safely terminate this program
 * @param signo	signal number
 */
extern "C" void Terminate(int signo);	

/**
 * Print the usage of nfrd.
 * @param prog	the excutable name of the program
 */
void PrintUsage(const char prog[]);

/**
 * Program entrance that initialises nfrd::Master and run it
 * @param argc	count number of arguments taken from command line
 * @param argv	value of arguments taken from command line
 * @return 0 if program terminated without error 
 */
int main(int argc, char* argv[])
{
	int arg;
	const char* config = 0;
	bool daemon = false;
	
	while ((arg = getopt(argc, argv, "df:hv")) != -1)
		switch (arg)
		{
			case 'd':
				daemon = true;
				break;
			case 'f':
				config = optarg;
				break;
			case 'h':
				PrintUsage(argv[0]);
				return 0;
			case 'v':
				cout << "version: "
					<< nfrd::Master::GetVersion() << endl;
				return 0;
			case '?':
				if (optopt == 'f')
					cerr << "option -f requires filename"
						<< endl;
				else
					cerr << "invalid command" << endl;
			default:
				PrintUsage(argv[0]);
				return 1;
				break;
		}
	
	// Ignore SIGHUP signal to run as a daemon
	if (signal(SIGHUP, SIG_IGN) != 0)
		cerr << "Warning: Fail to ignore signal SIGHUP: "
			<< strerror(errno) << endl;
	
	// Catch other signal to safely terminate the program
	if (signal(SIGINT, Terminate) != 0)
		cerr << "Warning: Fail to ignore signal SIGINT "
			<< "(may be unsafe when terminated by Control-C): "
			<< strerror(errno) << endl;
	if (signal(SIGTERM, Terminate) != 0)
		cerr << "Warning: Fail to ignore signal SIGTERM "
			<< "(may be unsafe when terminated by kill): "
			<< strerror(errno) << endl;
	
	// Run in daemon mode
	if (daemon)
	{
		if (signal(SIGCHLD, SIG_IGN) != 0)
			cerr << "Warning: Fail to ignore signal SIGCHLD "
				<< "(daemon mode canceled): "
				<< strerror(errno) << endl;
		
		pid_t pid = fork();
		if (pid != 0)	// Parent process
		{
			if (pid < 0)	// (pid == -1) error occurs
				cerr << "Warning: Daemon mode canceled due to "
					<< "failure of first fork(): "
					<< strerror(errno) << endl;
			else
				exit(0);
		}
		else if ((pid = fork()) != 0)	// First child process
		{
			if (pid < 0)	// (pid == -1) error occurs
				cerr << "Warning: Daemon mode canceled due to "
					<< "failure of second fork(): "
					<< strerror(errno) << endl;
			else
				exit(0);
		}
	}
	
	// Run nfrd
	try
	{
		nfrd::Master master;
		tracker = &master;
		master.Main(config == 0 ? "nfrd.cfg" : config);
		return 0;
	}
	catch (const exception& err)
	{
		cerr << "Error: " << err.what() << endl;
		return 2;
	}
}

// Print the usage of nfrd
void PrintUsage(const char prog[])
{
	cerr << "usage: " << prog << " [options]" << endl;
	cerr << "options:" << endl;
	cerr << "   -d          run in daemon mode" << endl;
	cerr << "   -f file     use specified config file" << endl;
	cerr << "   -h          show this help" << endl;
	cerr << "   -v          print the version" << endl;
}

// A signal handler to safely terminate this program
extern "C" void Terminate(int signo)
{
	tracker->Terminate();
}
