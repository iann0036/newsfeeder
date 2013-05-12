/**
 * @file	AdminService.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	30/04/12
 *
 * @section	DESCRIPTION
 *
 * A class to manage sockets talk to the front end and interacts with other
 * components.
 * @see @ref protocol
 */

#ifndef nfrd_AdminService_h
#define nfrd_AdminService_h
#include <string>
#include <set>
#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/asio.hpp>
#include <boost/thread.hpp>
#include <boost/thread/condition.hpp>
#pragma GCC diagnostic pop
#include "nfrd/Module.h"
#include "nfrd/AdminServiceThread.h"

namespace nfrd
{ 
	// Forward reference
	class Master;
}

namespace nfrd { namespace module
{
	/**
	 * Manage sockets talk to the front end and interacts with other
	 * components.
	 */
	class AdminService : public Module
	{
	public:
		/**
		 * Initialising Constructor for AdminService
		 * @param master	Master of nfrd
		 * @param config	config manager
		 * @param log		logger
		 */
		AdminService(Master& master,
			     const config::ConfigManager& config,
			     const log::LogManager& log);
		/**
		 * Delete all dynamic memory, if any
		 */
		~AdminService();
		void operator()();
		void Stop();
		/**
		 * Authenticate the username and password
		 * @param username	username from front-end
		 * @param password	password from front-end
		 * @return true if passed. Otherwise, fail returned
		 */
		bool Authenticate(const std::string& username,
				  const std::string& password) const;
		/**
		 * Register the thread in the member: threads
	 	 * @param thread	AdminServiceThread just started
		 */
		void Register(AdminServiceThread* thread) const;
		/**
		 * This function should be call when a thread exits.
		 * If dynamic is true, then no more operations are allowed on
		 * the instance.
		 * @param thread	finished AdminServiceThread
		 * @param dynamic	whether the thread is dynamic allocated
		 *			if true. delete is called
		 */
		void Exit(AdminServiceThread* thread, bool dynamic = true)const;
	private:
		/// A reference to Master. Hence, be able to control Master
		Master& master;
		/// A pointer to the acceptor used in operator()()
		boost::asio::ip::tcp::acceptor* acceptor;
		/// Track all detached threads;
		mutable std::set<AdminServiceThread*> threads;
		/// A mutex for operating on the member: threads
		mutable boost::mutex thread_mutex;
		/// Condition variable that used in Stop() for waiting all
		/// AdminServiceThreads
		mutable boost::condition condition;
		/// Authentication username
		std::string username;
		/// Authentication password
		std::string password;
	};
}}

#endif
