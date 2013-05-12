/**
 * @file	AdminServiceThread.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	20/09/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of AdminServiceThread
 */

#include <memory>
#include <ctime>
#include "nfrd/AdminServiceThread.h"
#include "nfrd/AdminService.h"
#include "nfrd/Master.h"
#include "nfrd/Utility.h"
using namespace nfrd::module;
using namespace std;
using nfrd::misc::Utility::GetArguments;

// Initialising Constructor for AdminServiceThread
AdminServiceThread::AdminServiceThread(const AdminService& parent,
				       Master& master,
				       unsigned int timeout,
				       bool dynamic) :
	Module("AdminServiceThread", parent),
	parent(parent), master(master), timeout(timeout), dynamic(dynamic)
{
	stream.exceptions(std::ios::failbit | std::ios::badbit);
}

// Delete all dynamic memory, if any
AdminServiceThread::~AdminServiceThread()
{
}

// Handle baisc communication and do authentication
void AdminServiceThread::operator()() 
{
	try
	{
		status = STARTING;
		parent.Register(this);
		remote_address = stream.rdbuf()->remote_endpoint().address()
					.to_string();
		log("Accepted: " + remote_address, Module::name);
		status = RUNNING;
		
		string username;
		getline(sin(), username, '\n');
		if (*username.rbegin() == '\r')
			username.erase(username.end()-1);
		sout() << "pass" << endl;
		string password;
		getline(sin(), password, '\n');
		if (*password.rbegin() == '\r')
			password.erase(password.end()-1);
		if (parent.Authenticate(username, password))
		{
			log(remote_address + ": Authenticated", Module::name);
			sout() << "success" << endl;
			Handle();
		}
		else
		{
			log(remote_address + ": Denied", Module::name);
			sout() << "deny" << endl;
		}
	}
	catch (const std::exception& err)
	{
		status = STOPPED;
		log(remote_address + ": " + err.what(), Module::name,
		    nfrd::log::LogManager::WARNING);
	}
	try
	{
		stream.close();
	}
	catch (const std::exception&) {}
	log("Leaving: " + remote_address, Module::name);
	status = STOPPING;
	if (dynamic)
		parent.Exit(this);
	else {
		parent.Exit(this, false);
		status = STOPPED;
	}
}

// Get the stream associated in this thread
boost::asio::ip::tcp::iostream& AdminServiceThread::GetStream()
{
	return stream;
}

// Handle commands request from the front-end
void AdminServiceThread::Handle()
{
	bool alive = true;
	vector<string> args;
	
	while (alive)
	{
		GetArguments(sin(), args);
		if (args.size() == 0)
			continue;
		else if (args[0] == "status")
			status_main(args);
		else if (args[0] == "crawler")
			crawler_main(args);
		else if (args[0] == "config")
			config_main(args);
		else if (args[0] == "shutdown")
			shutdown_main(args);
		else if (args[0] == "quit")
			alive = false;
		else
			sout() << "unknown command" << endl;
	}
}

// Use the socket stream as istream, refreshing time expire.
std::istream& AdminServiceThread::sin()
{
	stream.expires_from_now(timeout);
	return stream;
}

// Use the socket stream as ostream, refreshing time expire.
std::ostream& AdminServiceThread::sout()
{
	stream.expires_from_now(timeout);
	return stream;
}

// Supported command list
// status - Check the status
void AdminServiceThread::status_main(const std::vector<std::string>& args)
{
	if (args.size() == 1)
	{
		char timestr[26];
		ctime_r(&master.GetStartTime(), timestr);
		timestr[24] = 0;
		sout() << "Back-End started at:\t" << timestr << "<br>";
		stream << "-- Module status --<br>";
		status_send_module_status("AdminService");
		stream << "<br>";
		status_send_module_status("Crawler");
		stream << endl;
		return;
	}
	else if (args.size() == 2)
	{
		if (args[1] == "crawler")
		{
			Module* module = master.GetModule("Crawler");
			if (module == 0)
				sout() << "unloaded" << endl;
			else
				sout() << module->GetStatusString() << endl;
			return;
		}
		else if (args[1] == "uptime")
		{
			sout() << time(0) - master.GetStartTime() << endl;
			return;
		}
	}
	sout() << "fail: invalid args" << endl;
}

// crawler - Control the crawler
void AdminServiceThread::crawler_main(const std::vector<std::string>& args)
{
	if (args.size() == 2)
	{
		if (args[1] == "start" || args[1] == "stop")
		{
			bool start = (args[1] == "start");
			Module* crawler = master.GetModule("Crawler");
			if (crawler == 0)
				sout() << "fail: Crawler module unloaded"
					<< endl;
			else if ((crawler->GetStatus() == STOPPED && start) ||
				 (!start && crawler->GetStatus() == RUNNING))
			{
				try
				{
					master.SetModule(crawler, start);
				}
				catch (const std::exception& err)
				{
					log(remote_address + ": " + err.what(),
					    Module::name,
					    nfrd::log::LogManager::WARNING);
					sout() << "fail: " << err.what()
						<< endl;
					return;
				}
				sout() << "success" << endl;
			}
			else
				sout() << "fail: crawler status: " 
					<< crawler->GetStatusString() << endl;
			return;
		}
		else if (args[1] == "status")
		{
			vector<string> redirect;
			redirect.push_back("status");
			redirect.push_back("crawler");
			status_main(redirect);
			return;
		}
		else if (args[1] == "load")
		{	// More implementation needed
			sout() << "50" << endl;
			return;
		}
	}
	sout() << "fail: invalid args" << endl;
}

// config - Configure back-end
void AdminServiceThread::config_main(const std::vector<std::string>& args)
{
	if (args.size() > 1)
	{
		nfrd::config::ConfigManager& config = master.GetConfig();
	
		if (args[1] == "add" && args.size() == 5)
		{
			try
			{
				config[args[2]][args[3]] = args[4];
			}
			catch (const std::exception& err)
			{
				log(remote_address + ": " + err.what(),
				    Module::name,
				    nfrd::log::LogManager::WARNING);
				sout() << "fail: " << err.what() << endl;
				return;
			}
			sout() << "success" << endl;
			return;
		}
		else if (args[1] == "get" && args.size() == 4)
		{
			string value;
			try
			{
				value = this->config[args[2]][args[3]];
			}
			catch (const nfrd::config::ItemNotFound& err)
			{
				sout() << "fail: " << err.what() << endl;
				return;
			}
			catch (const std::exception& err)
			{
				log(remote_address + ": " + err.what(),
				    Module::name,
				    nfrd::log::LogManager::WARNING);
				sout() << "fail: " << err.what() << endl;
				return;
			}
			sout() << "success" << endl;
			string feedback;
			getline(sin(), feedback, '\n');
			if (*feedback.rbegin() == '\r')
				feedback.erase(feedback.end()-1);
			if (feedback == "transfer")
				sout() << value << endl;
			return;
		}
		else if (args[1] == "load" &&
			 (args.size() == 2 || args.size() == 3))
		{
			try
			{
				if (args.size() == 2)
					config.Read();
				else if (args.size() == 3)
					config.Read(args[2]);
			}
			catch (const nfrd::config::IOException& err)
			{
				sout() << "fail: " << err.what() << endl;
				return;
			}
			catch (const std::exception& err)
			{
				log(remote_address + ": " + err.what(),
				    Module::name,
				    nfrd::log::LogManager::WARNING);
				sout() << "fail: " << err.what() << endl;
				return;
			}
			sout() << "success" << endl;
			return;
		}
		else if (args[1] == "save" &&
			 (args.size() == 2 || args.size() == 3))
		{
			try
			{
				if (args.size() == 2)
					config.Write();
				else if (args.size() == 3)
					config.Write(args[2]);
			}
			catch (const nfrd::config::IOException& err)
			{
				sout() << "fail: " << err.what() << endl;
				return;
			}
			catch (const std::exception& err)
			{
				log(remote_address + ": " + err.what(),
				    Module::name,
				    nfrd::log::LogManager::WARNING);
				sout() << "fail: " << err.what() << endl;
				return;
			}
			sout() << "success" << endl;
			return;
		}
	}
	sout() << "fail: invalid args" << endl;
}

// shutdown - Shutdown back-end
void AdminServiceThread::shutdown_main(const std::vector<std::string>& args)
{
	
	log(remote_address + ": Terminate requested", Module::name);
	if (master.IsOnline())
	{
		master.Terminate();
		sout() << "success" << endl;
	}
	else 
		sout() << "fail: termninate signal already sent" << endl;
}

// Misc functions
// Used by status_main(), sending status of a module.
void AdminServiceThread::status_send_module_status(const std::string& name)
{
	stream << name << ":\t";
	Module* module = master.GetModule(name);
	if (module == 0)
		stream << "unloaded";
	else
		stream << module->GetStatusString();
}
