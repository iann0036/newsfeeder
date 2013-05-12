/**
 * @file	Statistics.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	18/10/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of Statistics
 */

#ifdef X_CODE
#include <StatController.h>
#else
#include <libnfdb/StatController.h>
#endif
#include "nfrd/Statistics.h"
#include "nfrd/Utility.h"
using namespace nfrd::module;
using namespace nfrd::misc;
using nfrd::log::LogManager;

// Default Constructor
Statistics::Statistics(const nfrd::config::ConfigManager& config,
		       const nfrd::log::LogManager& log) :
	Module("Statistics", config, log)
{
}

// Delete all dynamic memory, if any
Statistics::~Statistics()
{
}

// Start the service/module
void Statistics::operator()()
{
	try
	{
		status = STARTING;
		log("Starting", Module::name);
		
		// Load configuration
		try
		{
			period = Utility::ToInt
				(config["Statistics"]["period"]);
		}
		catch (const nfrd::config::ItemNotFound&)
		{
			period = 3600;
		}
		
		// Start
		status = RUNNING;
		log("Started", Module::name);
		
		while (status == RUNNING) {
			nfdb::StatController().GenerateNewStat();
			boost::this_thread::sleep
				(boost::posix_time::seconds(period));
		}
	}
	catch (const std::exception& err)
	{
		status = STOPPED;
		log(err.what(), Module::name, nfrd::log::LogManager::ERROR);
	}
}

// Stop the service/module
void Statistics::Stop()
{
	if (status != RUNNING)
		return;
	status = STOPPING;
	log("Stopping", Module::name);
	
	thread.interrupt();
	
	Module::Stop();
	status = STOPPED;
	log("Stopped", Module::name);
}
