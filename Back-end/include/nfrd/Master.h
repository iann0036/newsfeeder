/**
 * @file	Master.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	01/05/12
 *
 * @section	DESCRIPTION
 *
 * A class to manage, contain and access all components of nfrd.
 */

#ifndef nfrd_Master_h
#define nfrd_Master_h
#include <string>
#include <queue>
#include <utility>
#include <ctime>
#include <map>
#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/thread.hpp>
#include <boost/thread/condition.hpp>
#pragma GCC diagnostic pop
#include "nfrd/ConfigManager.h"
#include "nfrd/LogManager.h"
#include "nfrd/Module.h"

namespace nfrd
{
	/**
	 * Manage, contain and access all components of nfrd.
	 */
	class Master
	{
	public:
		/**
		 * Initialising Constructor for Master
		 */
		Master();
		/**
		 * Delete all dynamic memory, if any
		 */
		~Master();
		/**
		 * Program entrance, loading everything according to the
		 * configuration file.
		 * @param configFile	filename of the config file
		 * @throws ModuleException	if unable to proceed config
		 *				module or log module
		 */
		void Main(const std::string& configFile);
		/**
		 * Send terminate signal to the Master
		 */
		void Terminate();
		/**
		 * Test the master is online or not
		 * @return true if online
		 */
		bool IsOnline() const;
		/**
		 * Get the version of the nfrd
		 * @return version string
		 */
		static const char* GetVersion();
		/**
		 * Get start time of Master
		 * @return start time
		 */
		const time_t& GetStartTime() const;
		/**
		 * Get the access to config module
		 * @return config module
		 */
		config::ConfigManager& GetConfig();
		/**
		 * Get the access to a module
		 * @param name	name of module to be accessed
		 * @return a pointer to the module. NULL if module not found
		 */
		module::Module* GetModule(const std::string& name);
		/**
		 * Set a module to start or stop
		 * @param name	module name
		 * @param start start the module if true, else stop the module
		 * @throws ModuleException	if module not found
		 */
		void SetModule(const std::string& name, bool start);
		/**
		 * Set a module to start or stop
		 * @param module	module to be operated
		 * @param start		start the module if true,
		 *			else stop the module
		 */
		void SetModule(module::Module* module, bool start);
	private:
		/**
		 * Load a specified module according to config.
		 * If a module exists, it will be reloaded.
		 * @param name	name of module to be loaded
		 * @throws ModuleException	if fail to load or module not
		 *				found
		 * @return a pointer to newly loaded module
		 */
		module::Module* LoadModule(const std::string& name);
		/**
		 * Unload a specified module.
		 * @param name	name of module to be unloaded
		 * @throws ModuleException	if fail to load or module not
		 *				loaded
		 */
		void UnloadModule(const std::string& name);
		/**
		 * Load modules according to config.
		 */
		void LoadModules();
		/**
		 * Unload modules.
		 */
		void UnloadModules();
		
		/// Configuration Module (required)
		config::ConfigManager config;
		/// Logging Module (required)
		log::LogManager log;
		/// Service Modules
		std::map<std::string, module::Module*> module;
		
		/// Provide convenience to have pair frequently used in task
		typedef std::pair<module::Module*, bool> Task;
		/**
		 * Task queue.
		 * Every element in the task queue is a pair of Controller* and 
		 * bool. The bool value indicate the switch of the Controller
		 * whether to start(true) or stop(false) the module.
		 */
		std::queue<Task> task_queue;
		
		/// Indicate Master is online or not
		bool online;
		/// Start time
		time_t start_time;
		
		/// Mutex in Main()
		boost::mutex mutex;
		/// Condition variable that controls the main thread flow
		boost::condition condition;
	};
}

#endif
