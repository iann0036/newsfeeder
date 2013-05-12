/**
 * @file	LogManager.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	11/04/12
 *
 * @section	DESCRIPTION
 *
 * A class to manage logs.
 */

#ifndef nfrd_LogManager_h
#define nfrd_LogManager_h
#include <string>
#include <fstream>
#include <iostream>
#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/thread.hpp>
#pragma GCC diagnostic pop

namespace nfrd { namespace log {
	/**
	 * Manage logs
	 */
	class LogManager
	{
	public:
		/**
		 * Type of log
		 */
		enum Type
		{
			/// Normal log.		Marked as [LOG]
			NORMAL	= 0,
			/// Error log.		Marked as [ERR]
			ERROR	= 1,
			/// Warning log.	Marked as [WRN]
			WARNING	= 2
		};
		/**
		 * Initialising Constructor for LogManager
		 */
		LogManager();
		/**
		 * Delete all dynamic memory, if any
		 */
		~LogManager();
		/**
		 * Enable logging, writing logs to @a filename.
		 * @param filename where logs will be written to.
		 * @throws IOException	If unable to write file.
		 */
		void Enable(std::string& filename);
		/**
		 * Disable logging system
		 */
		void Disable();
		/**
		 * Test the logging system is enabled or not
		 */
		bool isEnabled() const;
		/**
		 * Log the message.
		 * For example:
		 * @code
		 * LogManager log;
		 * log.Enable("logfile.log");
		 * log("started", NORMAL, "LogManager");
		 * @endcode
		 * will output<br>
		 * [Sat May 20 15:21:51 2000][LOG] LogManager: started
		 * @param message	message to log
		 * @param type		log type
		 * @param title		title of the log
		 * @return a reference to self
		 */
		const LogManager& operator()(const std::string& message,
					     Type type = NORMAL,
					     const char title[] = 0) const;
		/**
		 * Log the message.
		 * @param message	message to log
 		 * @param title		title (module name) of the log
		 * @param type		log type
		 * @return a reference to self
		 * @see const LogManager& operator()(const std::string& message,
		 *				Type type = NORMAL,
		 *				const char title[] = 0) const;
		 */
		const LogManager& operator()(const std::string& message,
					     const std::string& title,
					     Type type = NORMAL) const;
	private:
		/// Logging is enabled or not
		bool enabled;
		/// File stream where the logs are written to
		mutable std::ofstream fout;
		/// I/O mutex
		mutable boost::mutex io_mutex;
	};

	/**
	 * General exception for log
	 */
	class LogException : public std::exception
	{
	public:
		/**
		 * Default Constructor for LogException, recording the error
		 * message.
		 * @param message	Error message
		 */
		explicit LogException(const std::string& message);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~LogException() throw();
		/**
		 * Return error message
		 * @return Error message
		 */
		virtual const char* what() const throw();
	private:
		/// Error message
		std::string msg;
	};
	
	/**
	 * Input/Output exception for config
	 */
	class IOException : public LogException
	{
	public:
		/**
		 * Default Constructor for IOException, recording the error
		 * message.
		 * @param msg	Error message
		 */
		explicit IOException(const std::string& msg);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~IOException() throw();
	};
}}

#endif
