/**
 * @file	ConfigManager.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	01/05/12
 *
 * @section	DESCRIPTION
 *
 * ConfigManager that manages config files.<br>
 * ConfigSector is a part of ConfigManager (as a container).<br>
 * ConfigException is for general exceptions.<br>
 * IOException is for Input/Output exceptions.<br>
 * ItemNotFound is for Item not found exceptions.
 */
 
#ifndef nfrd_ConfigManager_h
#define nfrd_ConfigManager_h
#include <string>
#include <map>
#include <iostream>

namespace nfrd { namespace config
{
	/**
	 * A part of ConfigManager (as a container)
	 */
	class ConfigSector
	{
	public:
		/**
		 * Initialising Constructor for ConfigSector
		 */
		ConfigSector();
		/**
		 * Delete all dynamic memory, if any
		 */
		~ConfigSector();
		/**
		 * Write out ConfigSector
		 * @param out	Write ConfigSector to this stream
		 */
		void Write(std::ostream& out) const;
		/**
		 * Read in ConfigSector
		 * @param in	Read ConfigSector from this stream
		 * @throws IOException	If argument is not correctly formated
		 */
		void Read(std::istream& in);
		/**
		 * Fetch the content of the sector.
		 * If the argument name is not existed, a new entry will be
		 * created.
		 * @param arg	Argument name
		 * @return	Value of fetched argument
		 */
		std::string& operator[](const std::string& arg);
		/**
		 * Fetch the content of the sector.
		 * @param arg	Argument name
		 * @return	Value of fetched argument
		 * @throws ItemNotFound	If the argument does not exist
		 */
		const std::string& operator[](const std::string& arg) const;
		
		/// Iteraor
		typedef std::map<std::string, std::string>::iterator iterator;
		/// Constant iterator
		typedef std::map<std::string, std::string>::const_iterator
			const_iterator;
		/**
		 * Returns an iterator referring to the first element in the 
		 * ConfigSector container
		 * @return	an iterator referring to the first element in
		 *		the container
		 */
		iterator begin();
		/**
		 * Returns an constant iterator referring to the first element 
		 * in the ConfigSector container
		 * @return	an constant iterator referring to the first 
		 *		element in the container
		 */
		const_iterator begin() const;
		/**
		 * Returns an iterator referring to the past-the-end element in
		 * the ConfigSector container.
		 * @return	an iterator to the element past the end of the 
		 *		container
		 */
		iterator end();
		/**
		 * Returns an constant iterator referring to the past-the-end
		 * element in the ConfigSector container.
		 * @return	an constant iterator to the element past the end
		 *		of the container
		 */
		const_iterator end() const;
	private:
		/// Sector name
		std::string name;
		/// a container to store all arguments with their values
		std::map<std::string, std::string> value;
	};
	
	/**
	 * Manages config files (core class).
	 * Note: The config is stored in the memory.
	 */
	class ConfigManager
	{
	public:
		/**
		 * Default Constructor for ConfigManager.
		 * This constructor does not sepecify the filename of the
		 * config. Hence, SetFileName() should be called befor Write()
		 * or Read()
		 * @see Write()
		 * @see Read()
		 * @see SetFileName()
		 */
		ConfigManager();
		/**
		 * Initialising Constructor for ConfigManager
		 * @param filename	Default filename to Write() or Read()
		 */
		ConfigManager(const std::string& filename);
		/**
		 * Delete all dynamic memory, if any
		 */
		~ConfigManager();
		/**
		 * Write out ConfigManager to file with default settings
		 * @throws IOException	If filename is not specified or unable
		 *			to write file.
		 */
		void Write() const;
		/**
		 * Write out ConfigManager to file
		 * @param filename	The name of the file to be writted
		 * @throws IOException	If unable to write file.
		 */
		void Write(const std::string& filename) const;
		/**
		 * Read in ConfigManager from file with default settings
		 * @throws IOException	If filename is not specified or file
		 *			does not exist or file corrupted.
		 */
		void Read();
		/**
		 * Read in ConfigManager from file
		 * @param filename	The name of the file to read
		 * @throws IOException	If file does not exist or file
		 *			corrputed.
		 */
		void Read(const std::string& filename);
		/**
		 * Externally set the file name of the config file
		 * @param filename	The name of the file that will be used
		 *			by Write() and Read() as default
		 */
		void SetFileName(const std::string& filename);
		/**
		 * Fetch the sector of the config
		 * If the sector is not existed, a new entry will be created.
		 * @param sector	Sector name
		 * @return	A ConfigSector instance of the sector
		 */
		ConfigSector& operator[](const std::string& sector);
		/**
		 * Fetch the sector of the config in const form
		 * If the sector is not existed, a new entry will be created.
		 * @param sector	Sector name
		 * @return	A ConfigSector instance of the sector
		 * @throws ItemNotFound	If the sector does not exist
		 */
		const ConfigSector& operator[](const std::string& sector) const;
	private:
		/// File name of the config file.
		std::string configFile;
		/// A container contains all ConfigSector instances.
		std::map<std::string, ConfigSector> value;
	};
	
	/**
	 * General exception for config
	 */
	class ConfigException : public std::exception
	{
	public:
		/**
		 * Default Constructor for ConfigException, recording the error
		 * message.
		 * @param message	Error message
		 */
		explicit ConfigException(const std::string& message);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~ConfigException() throw();
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
	class IOException : public ConfigException
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
	
	/**
	 * Item not found
	 */
	class ItemNotFound : public ConfigException
	{
	public:
		/**
		 * Default Constructor for ItemNotFound, recording the error
		 * message.
		 * @param msg	Error message
		 */
		explicit ItemNotFound(const std::string& msg);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~ItemNotFound() throw();
	};
}}

#endif
