/**
 * @file	AdminService.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	30/04/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of AdminService and associated stuffs
 */

#include "nfrd/AdminService.h"
#include "nfrd/Utility.h"
using namespace nfrd::module;
using namespace nfrd::misc;
using boost::asio::ip::tcp;
using nfrd::log::LogManager;

// Default Constructor
AdminService::AdminService(Master& master,
			   const nfrd::config::ConfigManager& config,
			   const nfrd::log::LogManager& log) :
	Module("AdminService", config, log), master(master), acceptor(0)
{
}

// Delete all dynamic memory, if any
AdminService::~AdminService()
{
}

// Start the service/module
void AdminService::operator()()
{
	try
	{
		status = STARTING;
		log("Starting", Module::name);
		
		// Load configuration
		nfrd::config::ConfigSector sector = config["AdminService"];
		
		// Get tcp listenning port
		int port = Utility::ToInt(sector["port"]);
		
		// Get authentication details
		username = sector["username"];
		password = sector["password"];
		int timeout = Utility::ToInt(sector["timeout"]);
		try
		{
			timeout = Utility::ToInt(sector["timeout"]);
		}
		catch (const nfrd::config::ItemNotFound&)
		{
			timeout = 60;
		}
		
		// Set up
		boost::asio::io_service io_service;
		tcp::endpoint endpoint(tcp::v4(), port);
		if (acceptor != 0) {
			delete acceptor;
			acceptor = 0;
		}
		acceptor = new tcp::acceptor(io_service, endpoint);
		
		status = RUNNING;
		log("Started", Module::name);
		
		// Start accepting
		while (status == RUNNING)
		{
			AdminServiceThread* service = 0;
			try
			{
				service = new AdminServiceThread(*this, master,
								 timeout);
				boost::system::error_code ec;
				acceptor->accept(*service->GetStream().rdbuf(),
						 ec);
				if (ec)
				{
					if (service != 0)
					{
						delete service;
						service = 0;
					}
					if (status == RUNNING)
						log(ec.message(), Module::name,
						    nfrd::log::LogManager::
						    WARNING);
				}
				else
					service->Start();
			}
			catch (const std::exception& err)
			{
				if (service != 0)
				{
					delete service;
					service = 0;
				}
				log(err.what(), Module::name,
				    nfrd::log::LogManager::WARNING);
			}
		}
		if (acceptor != 0) {
			delete acceptor;
			acceptor = 0;
		}
	}
	catch (const std::exception& err)
	{
		if (acceptor != 0) {
			delete acceptor;
			acceptor = 0;
		}
		status = STOPPED;
		log(err.what(), Module::name, nfrd::log::LogManager::ERROR);
	}
}

// Stop the service/module
void AdminService::Stop()
{
	if (status != RUNNING)
		return;
	status = STOPPING;
	log("Stopping", Module::name);
	if (acceptor != 0)
		acceptor->close();
	{
		boost::mutex::scoped_lock lock(thread_mutex);
		for (std::set<AdminServiceThread*>::iterator
		     i = threads.begin(); i != threads.end(); ++i)
			try
			{
				(*i)->GetStream().close();
			}
			catch (const std::exception&) {}
		while (!threads.empty())
			condition.wait(lock);
	}
	Module::Stop();
	status = STOPPED;
	log("Stopped", Module::name);
}

// Authenticate the username and password
bool AdminService::Authenticate(const std::string& username,
				const std::string& password) const
{
	return username == this->username && password == this->password;
}

// Register the thread in the member: threads
void AdminService::Register(AdminServiceThread* thread) const
{
	boost::mutex::scoped_lock lock(thread_mutex);
	threads.insert(thread);
}

// This function should be call when a thread exits.
void AdminService::Exit(AdminServiceThread* thread, bool dynamic) const
{
	{
		boost::mutex::scoped_lock lock(thread_mutex);
		threads.erase(thread);
		condition.notify_one();
	}
	if (dynamic)
		delete thread;
}
