/**
 * @file	LogManager.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	30/04/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of LogManager and associated stuffs
 */

#include <cstring>
#include <errno.h>
#include <ctime>
#include "nfrd/LogManager.h"
using namespace nfrd::log;
using namespace std;

// Default Constructor
LogManager::LogManager() : enabled(false)
{
}

// Delete all dynamic memory, if any
LogManager::~LogManager()
{
	Disable();
}

// Enable logging, writing logs to filename.
void LogManager::Enable(std::string& filename)
{
	if (enabled)
		Disable();
	
	fout.open(filename.c_str(), ofstream::out | ofstream::app);
	if (!fout.good())
		throw IOException(
			string("LogManager: Unable to write to file \"")
			.append(filename).append("\": ")
			.append(strerror(errno)));
	
	enabled = true;
}

// Disable logging system
void LogManager::Disable()
{
	if (!enabled)
		return;
	fout.close();
	enabled = false;
}

// Test the logging system is enabled or not
bool LogManager::isEnabled() const
{
	return enabled;
}

// Log the message.
const LogManager& LogManager::operator()(const std::string& message,
					 Type type, const char title[]) const
{
	if (!enabled)
		return *this;

	time_t now = time(0);
	char time_buf[26];
	ctime_r(&now, time_buf);
	time_buf[24] = 0;
	
	{
		boost::mutex::scoped_lock io_lock(io_mutex);
		 
		fout << '[' << time_buf << ']';
		switch (type)
		{
			case ERROR:
				fout << "[ERR]";
				break;
			case WARNING:
				fout << "[WRN]";
				break;

			case NORMAL:
			default:
				fout << "[LOG]";
				break;
		}
		fout << ' ';
		if (title != 0)
			fout << title << ": ";
		fout << message << endl;
	}

	return *this;
}

// Log the message.
const LogManager& LogManager::operator()(const std::string& message,
					 const std::string& title,
					  Type type) const
{
	return operator()(message, type, title.c_str());
}

// General exception
LogException::LogException(const std::string& message) : msg(message)
{
}

// Delete dynamic memories, if any
LogException::~LogException() throw()
{	
}

// Return message
const char* LogException::what() const throw()
{
	return msg.c_str();
}

// Input/Output exception
IOException::IOException(const std::string& msg) : LogException(msg)
{
}

// Delete dynamic memories, if any
IOException::~IOException() throw()
{	
}
