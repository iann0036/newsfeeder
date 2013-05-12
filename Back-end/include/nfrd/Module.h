/**
 * @file	Module.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	30/04/12
 *
 * @section	DESCRIPTION
 *
 * Abstract/Interface Controller class and related stuff.<br>
 * ControllerException is for general exceptions.
 */
 
#ifndef nfrd_Controller_h
#define nfrd_Controller_h
#include <string>
#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/thread.hpp>
#pragma GCC diagnostic pop
#include "nfrd/ConfigManager.h"
#include "nfrd/LogManager.h"

namespace nfrd { namespace module
{
	/**
	 * A generalised module interface class, providing all the
	 * interfaces of a module that start or stop.
	 * Since it is an abstract class, all pure virtual functions have to be
	 * implemented by the subclasses. 
	 */
	class Module
	{
	public:
		/**
		 * Running status of the module
		 */
		enum Status
		{
			/// The module is running
			RUNNING		= 1,
			/// The module is stoped
			STOPPED		= 0,
			/// The module is starting
			STARTING	= 2,
			/// The module is stopping
			STOPPING	= 3
		};
	
		/**
		 * Initialising Constructor for Module.
		 * Initialise status to false (not running).
		 * @param name		module name
		 * @param config	config manager
		 * @param log		logger
		 */
		Module(const std::string& name,
		       const config::ConfigManager& config,
		       const log::LogManager& log);
		/**
		 * Initialising Constructor for Module.
		 * Initialise status to false (not running).
		 * Using the same config and log as @a module
		 * @param name		module name
		 * @param module	other module
		 */
		Module(const std::string& name, const Module& module);
		
		/**
		 * Delete all dynamic memory, if any
		 */
		virtual ~Module();
		/**
		 * Start the service/module in current thread
		 */
		virtual void operator()() = 0;
		/**
		 * Start the service/module in a new thread
		 */
		virtual void Start();
		/**
		 * Stop the service/module, joining the thread.
		 */
		virtual void Stop();
		/**
		 * Get the name of the module
		 * @return module name
		 */
		const std::string& GetName() const;
		/**
		 * Get the thread for the module (used in multi-threaded
		 * condition)
		 * @return running thread
		 */
		boost::thread& GetThread();
		/**
		 * Get the running status
		 * @return running status
		 */
		Status GetStatus() const;
		/**
		 * Get the running status in string form
		 * @return running status in string form
		 */
		const char* GetStatusString() const;
	protected:
		/// Module name
		const std::string name;
		/// Running thread
		boost::thread thread;
		/// Running status
		Status status;
		/// Configuration access
		const config::ConfigManager& config;
		/// Access to logging system
		const log::LogManager& log;
	};
	
	/**
	 * General exception for module
	 */
	class ModuleException : public std::exception
	{
	public:
		/**
		 * Default Constructor for ModuleException, recording the error 
		 * message.
		 * @param message	Error message
		 */
		explicit ModuleException(const std::string& message);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~ModuleException() throw();
		/**
		 * Return error message
		 * @return Error message
		 */
		virtual const char* what() const throw();
	private:
		/// Error message
		std::string msg;
	};
}}

#endif
