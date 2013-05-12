/**
 * @file	Module.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	30/04/12
 *
 * @section	DESCRIPTION
 *
 * Part implementation of Abstract/Interface Module class and related stuff
 */

#include "nfrd/Module.h"
using namespace nfrd::module;
using namespace std;

// Initialising Constructor for Module.
Module::Module(const std::string& name,
	       const nfrd::config::ConfigManager& config,
	       const nfrd::log::LogManager& log) :
	name(name), status(STOPPED), config(config), log(log)
{
}

// Initialising Constructor for Module. Using the same config and log as module
Module::Module(const std::string& name, const Module& module) :
	name(name), status(STOPPED), config(module.config), log(module.log)
{
}

// Delete all dynamic memory, if any
Module::~Module()
{
}

// Start the service/module in a new thread
void Module::Start()
{
	thread = boost::thread(boost::ref(*this));
}

// Stop the service/module
void Module::Stop()
{
	thread.join();
}

// Get the name of the module
const std::string& Module::GetName() const
{
	return name;
}

// Get the thread for the module (used in multi-threaded condition)
boost::thread& Module::GetThread()
{
	return thread;
}


// Get the running status
Module::Status Module::GetStatus() const
{
	return status;
}

// Get the running status in string form
const char* Module::GetStatusString() const
{
	switch (status)
	{
		case RUNNING:
			return "running";
		case STARTING:
			return "starting";
		case STOPPED:
			return "stopped";
		case STOPPING:
			return "stopping";
		default:
			break;
	}
	
	return "unknown";
}

// General exception
ModuleException::ModuleException(const string& message) : msg(message)
{
}

// Delete dynamic memories, if any
ModuleException::~ModuleException() throw()
{	
}

// Return message
const char* ModuleException::what() const throw()
{
	return msg.c_str();
}
