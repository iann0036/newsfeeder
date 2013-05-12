/**
 * @file	Master.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	01/05/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of Master and associated stuffs
 */

#include "nfrd/Master.h"
#include "nfrd/Utility.h"
#include "nfrd/AdminService.h"
#include "nfrd/Crawler.h"
#include "nfrd/Statistics.h"
using namespace nfrd;
using namespace nfrd::module;
using namespace nfrd::misc;
using namespace std;

// Default Constructor
Master::Master() : online(false)
{
}

// Delete all dynamic memory, if any
Master::~Master()
{
	if (!module.empty())
	{
		UnloadModules();
		log("News Feeder Refresh Daemon (nfrd) stopped",
		    log::LogManager::WARNING);
	}
}

// Program entrance
void Master::Main(const std::string& configFile)
{
	// Initialise
	boost::mutex::scoped_lock lock(mutex);
	time(&start_time);
	online = true;
	try
	{
		// Read config file
		config.Read(configFile);
	
		// Initialse logging module
		string filename = config["master"]["log"];
		if (filename.size() != 0)
			log.Enable(filename);
	}
	catch (const exception& err)
	{
		throw ModuleException(err.what());
	}
	log("News Feeder Refresh Daemon (nfrd) started");
	
	// Load modules
	LoadModules();
	
	// Run modules according to task list
	while (online)
	{
		while (!task_queue.empty())
		{
			Task& task = task_queue.front();
			if (task.second)	// Start
				task.first->Start();
			else	// Stop
				task.first->Stop();
			task_queue.pop();
		}
		condition.wait(lock);
	}
	
	// Unload modules
	UnloadModules();
	log("News Feeder Refresh Daemon (nfrd) stopped normally");
}

// Send terminate signal to the Master
void Master::Terminate()
{
	online = false;
	log("Terminate requested");
	condition.notify_one();
}

// Test the master is online or not
bool Master::IsOnline() const
{
	return online;
}

// Get the version of the nfrd
const char* Master::GetVersion()
{
	return "0.12.04.30";
}

// Get start time of Master
const time_t& Master::GetStartTime() const
{
	return start_time;
}

// Get the access to config module
config::ConfigManager& Master::GetConfig()
{
	return config;
}

// Get the access to a module
module::Module* Master::GetModule(const std::string& name)
{
	map<string, Module*>::iterator curr = module.find(name);
	if (curr == module.end())
		return 0;
	else
		return curr->second;
}

// Set a module to start or stop
void Master::SetModule(const std::string& name, bool start)
{
	Module* module = GetModule(name);
	if (module == 0)
		throw ModuleException("Module \"" + name + "\" not found");
	SetModule(module, start);
}

// Set a module to start or stop
void Master::SetModule(module::Module* module, bool start)
{
	task_queue.push(Task(module, start));
	condition.notify_one();
}

// Load a specified module according to config.
Module* Master::LoadModule(const std::string& name)
{
	Module* new_module;

	log("Loading " + name + "...");
	if (name == "AdminService")
		new_module = new AdminService(*this, config, log);
	else if (name == "Crawler")
		new_module = new Crawler(config, log);
	else if (name == "Statistics")
		new_module = new Statistics(config, log);
	else
		throw ModuleException("Module \"" + name + "\" not found"); 
	pair<map<string, Module*>::iterator,bool> m_pair
		= module.insert(pair<string, Module*>(name, new_module));
	if (m_pair.second == false) {
		delete m_pair.first->second;
		m_pair.first->second = new_module;
	}
	
	return new_module;
}

// Unload a specified module.
void Master::UnloadModule(const std::string& name)
{
	log("Unloading " + name + "...");
	map<string, Module*>::iterator curr = module.find(name);
	if (curr == module.end())
		throw ModuleException("Module \"" + name + "\" is not loaded");
	curr->second->Stop();
	delete curr->second;
	module.erase(curr);
}

// Loading modules according to config.
void Master::LoadModules()
{
	// Loading modules
	log("Loading modules...");
	config::ConfigSector& module_sector = config["module"];
	for (config::ConfigSector::iterator i = module_sector.begin();
	     i != module_sector.end(); ++i)
		if (Utility::ToBool(i->second))
		{
			try
			{
				task_queue.push(Task(LoadModule(i->first),
						     true));
			}
			catch (const exception& err)
			{
				log(err.what(), log::LogManager::ERROR);
			}
		}
	log("Modules loaded");
}

// Unload modules
void Master::UnloadModules()
{
	log("Unloading modules...");
	for (map<string, Module*>::iterator
	     i = module.begin(); i != module.end(); ++i)
	{
		log("Unloading " + i->first + "...");
		try
		{
			i->second->Stop();
			delete i->second;
			module.erase(i);
		}
		catch (const exception& err)
		{
			log(err.what(), log::LogManager::WARNING);
		}
	}
	log("Modules unloaded");
}
