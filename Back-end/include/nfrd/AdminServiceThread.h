/**
 * @file	AdminServiceThread.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	01/05/12
 *
 * @section	DESCRIPTION
 *
 * A class to handle front-end requests.
 * @see AdminService
 */

#ifndef nfrd_AdminServiceThread_h
#define nfrd_AdminServiceThread_h
#include <string>
#include <vector>
#pragma GCC diagnostic push
#pragma GCC diagnostic ignored "-Wconversion"
#include <boost/asio.hpp>
#pragma GCC diagnostic pop
#include "nfrd/Module.h"

namespace nfrd
{ 
	// Forward reference
	class Master;
}

namespace nfrd { namespace module
{
	// Forward reference
	class AdminService;

	/**
	 * Handle sockets talk to the front end and interacts with other
	 * components.
	 * @see @ref protocol
	 */
	class AdminServiceThread : public Module
	{
	public:
		/**
		 * Initialising Constructor for AdminServiceThread
		 * @param parent	parent of this thread
		 * @param master	Master of nfrd to be controled
		 * @param timeout	timeout on socket operation
		 * @param dynamic	is this instance dynamically allocated
		 */
		AdminServiceThread(const AdminService& parent, Master& master,
				   unsigned int timeout = 60,
				   bool dynamic = true);
		/**
		 * Delete all dynamic memory, if any
		 */
		~AdminServiceThread();
		/**
		 * Handle baisc communication and do authentication
		 */
		void operator()();
		/**
		 * Get the stream associated in this thread
		 * @return socket stream
		 */
		boost::asio::ip::tcp::iostream& GetStream();
	private:
		/**
		 * Handle commands request from the front-end
		 */
		void Handle();
		/**
		 * Use the socket stream as istream, refreshing time expire.
		 * @return istream of stream
		 */
		std::istream& sin();
		/**
		 * Use the socket stream as ostream, refreshing time expire.
		 * @return ostream of stream
		 */
		std::ostream& sout();
		/// Socket stream
		boost::asio::ip::tcp::iostream stream;
		/// Keep reference to its parrent
		const AdminService& parent;
		/// Keep reference to the Master to be handled
		Master& master;
		/// General operation time out limit
		boost::posix_time::seconds timeout;
		/// Whether this instance is dynamically allocated
		bool dynamic;
		/// Keep track of the address of the remote host
		std::string remote_address;
		
		// Supported command list
		/**
		 * status - Check the status
		 * @param args	argument list
		 * @see @ref protocol_status
		 */
		void status_main(const std::vector<std::string>& args);
		/**
		 * crawler - Control the crawler
		 * @param args	argument list
		 * @see @ref protocol_crawler
		 */
		void crawler_main(const std::vector<std::string>& args);
		/**
		 * config - Configure back-end
		 * @param args	argument list
		 * @see @ref protocol_config
		 */
		void config_main(const std::vector<std::string>& args);
		/**
		 * shutdown - Shutdown back-end
		 * @param args	argument list
		 * @see @ref protocol_shutdown
		 */
		void shutdown_main(const std::vector<std::string>& args);
		
		// Misc functions
		/**
		 * Used by status_main(), sending status of a module.
		 * For example: name:	unloaded
		 * @param name	module name
		 */
		void status_send_module_status(const std::string& name);
	};
}}

#endif
