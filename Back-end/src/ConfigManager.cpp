/**
 * @file	ConfigManager.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	01/05/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of ConfigManager and associated stuffs
 */

#include <cctype>
#include <iostream>
#include <fstream>
#include <cstring>
#include <errno.h>
#include "nfrd/ConfigManager.h"
using namespace nfrd::config;
using namespace std;

/**
 * Define whitespace character string.
 * This variable is to indicate whitespace characters when parsing config file.
 * @see config::ConfigSector::Read()
 */
const string WHITESPACES = " \t\f\v\n\r";

// Initialising Constructor for ConfigSector
ConfigSector::ConfigSector()
{
}

// Delete all dynamic memory, if any
ConfigSector::~ConfigSector()
{
}

// Write out ConfigSector
void ConfigSector::Write(ostream& out) const
{
	for (map<string, string>::const_iterator i = value.begin();
	     i != value.end(); ++i)
	{
		if (i->second.size() == 0)
			continue;
		
		out << i->first << '=';
		if (i->second.find_first_of(WHITESPACES) == string::npos)
			out << i->second << endl; 
		else
			out << '"' << i->second << '"' << endl;
	}
}

// Read in ConfigSector
void ConfigSector::Read(istream& in)
{
	char head;	// Head character of the line
	string line;	// The whole line contains the argument and value
	size_t pos;	// The position that "=" is. Sometimes be used as temp
	string arg,val;	// argument and value
	
	head = in.get();
	while (!in.eof())
	{
		if (head == '[')
		{
			in.unget();
			return;
		}
		else if (!isspace(head))
		{
			in.unget();
			getline(in, line, '\n');
			pos = line.find_first_of('=');
			if (pos != string::npos)
			{
				// Parse argument and value
				arg = line.substr(0,pos);
				val = line.substr(pos+1);
				
				// Erase trailing white-spaces of arg
				pos = arg.find_last_not_of(WHITESPACES);
				if (pos != string::npos)
					arg.erase(pos + 1);
				else
					throw IOException(string(
						"ConfigSector: Bad argument: ")
						.append(line));
				
				// Erase leading & trailing white-spaces of val
				pos = val.find_first_not_of(WHITESPACES);
				if (pos != string::npos)
					val.erase(0, pos);
				else
					val.clear();
				pos = val.find_last_not_of(WHITESPACES);
				if (pos != string::npos)
					val.erase(pos + 1);
				else
					val.clear();
				
				// Record value
				if (val.size() > 1 && *val.begin() == '"'
				    && *val.rbegin() == '"')
					value[arg] = val.substr(1,val.size()-2);
				else
					value[arg] = val;
			}
		}
		head = in.get();
	}
}

// Fetch the content of the sector
std::string & ConfigSector::operator[](const std::string &arg)
{
	return value[arg];
}

// Fetch the content of the sector in const form
const std::string & ConfigSector::operator[](const std::string &arg) const
{
	const_iterator iter = value.find(arg);
	
	if (iter == value.end())
		throw ItemNotFound(string("ConfigSector: Argument \"").
				   append(arg).append("\" not found"));
	
	return iter->second;
}

// Returns an iterator referring to the first element in the ConfigSector
// container
ConfigSector::iterator ConfigSector::begin()
{
	return value.begin();
}

// Returns an constant iterator referring to the first element in the
// ConfigSector container
ConfigSector::const_iterator ConfigSector::begin() const
{
	return value.begin();
}

// Returns an iterator referring to the past-the-end element in the ConfigSector
// container.
ConfigSector::iterator ConfigSector::end()
{
	return value.end();
}

// Returns an constant iterator referring to the past-the-end element in the
// ConfigSector container.
ConfigSector::const_iterator ConfigSector::end() const
{
	return value.end();
}

// Default Constructor for ConfigManager
ConfigManager::ConfigManager() : configFile("")
{
}

// Initialising Constructor for ConfigManager
ConfigManager::ConfigManager(const std::string& filename) : configFile(filename)
{
}

// Delete all dynamic memory, if any
ConfigManager::~ConfigManager()
{
}

// Write out ConfigManager to file with default settings
void ConfigManager::Write() const
{
	if (configFile == "")
		throw IOException("ConfigManager: File is not specified");
	
	this->Write(configFile);
}

// Write out ConfigManager to file
void ConfigManager::Write(const std::string& filename) const
{
	ofstream fout;
	
	// Open file
	fout.open(filename.c_str());
	if (!fout.good())
		throw IOException(
			string("ConfigManager: Unable to create file \"")
			.append(filename).append("\": ")
			.append(strerror(errno)));
	
	// Write to file
	for (map<string, ConfigSector>::const_iterator i = value.begin();
	     i != value.end(); ++i)
	{
		if (i != value.begin())
			fout << endl;
		fout << '[' << i->first << ']' << endl;
		i->second.Write(fout);
	}
	
	// Last check
	if (!fout.good())
		throw IOException(
			string("ConfigManager: Unable to write to file \"")
			.append(filename).append("\": ")
			.append(strerror(errno)));

	// Close file
	fout.close();
}

// Read in ConfigManager from file with default settings
void ConfigManager::Read()
{
	if (configFile == "")
		throw IOException("ConfigManager: File is not specified");
	
	this->Read(configFile);
}

// Read in ConfigManager from file
void ConfigManager::Read(const std::string& filename)
{
	char head;	// Head character of the line
	string sector;	// The name of the sector
	size_t pos;	// The position that "]" is.
	ifstream fin;
	
	// Open file
	fin.open(filename.c_str());
	if (!fin.good())
		throw IOException(
			string("ConfigManager: Unable to open file \"")
			.append(filename).append("\": ")
			.append(strerror(errno)));
	
	// Read file
	head = fin.get();
	while (!fin.eof())
	{
		if (head == '[')
		{
			getline(fin, sector, '\n');
			pos = sector.find_last_of(']');
			if (pos != string::npos)
				sector.erase(pos);
			else
				throw IOException(
					string("ConfigManager: Corrupt file \'")
					.append(filename).append("\""));
			value[sector].Read(fin);
		}
		else if (!isspace(head))
			throw IOException(
				string("ConfigManager: Bad config file \"")
				.append(filename).append("\""));
		head = fin.get();
	}
	
	// Close file
	fin.close();
}

// Externally set the file name of the config file
void ConfigManager::SetFileName(const string& filename)
{
	configFile = filename;
}

// Fetch the sector of the config
ConfigSector& ConfigManager::operator[](const std::string& sector)
{
	return value[sector];
}

// Fetch the sector of the config in const form
const ConfigSector& ConfigManager::operator[](const std::string& sector) const
{
	map<string, ConfigSector>::const_iterator iter = value.find(sector);
	
	if (iter == value.end())
		throw ItemNotFound(string("ConfigManager: Sector \"").
				   append(sector).append("\" not found"));
	
	return iter->second;
}

// General exception
ConfigException::ConfigException(const std::string& message) : msg(message)
{
}

// Delete dynamic memories, if any
ConfigException::~ConfigException() throw()
{	
}

// Return message
const char* ConfigException::what() const throw()
{
	return msg.c_str();
}

// Input/Output exception
IOException::IOException(const std::string& msg) : ConfigException(msg)
{
}

// Delete dynamic memories, if any
IOException::~IOException() throw()
{	
}

// Item not found
ItemNotFound::ItemNotFound(const std::string& msg) : ConfigException(msg)
{
}

// Delete dynamic memories, if any
ItemNotFound::~ItemNotFound() throw()
{	
}
