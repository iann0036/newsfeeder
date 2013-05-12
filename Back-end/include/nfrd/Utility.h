/**
 * @file	Utility.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	24/08/12
 *
 * @section	DESCRIPTION
 *
 * A namespace contains all utility functions
 */

#ifndef nfrd_Utility_h
#define nfrd_Utility_h
#include <vector>
#include <string>
#include <istream>
#include <memory>
#include <stdexcept>

namespace nfrd { namespace misc { namespace Utility {
	/**
	 * Read the content of the url and write to the container.
	 * Note:	The container will not be cleared by this function.
	 *		All it does is to append data to the container.<br>
	 * This function will follow the url redirections (max -> 255).
	 * @param url		URL of the file
	 * @param container	where the data write to
	 * @return true		if success
	 * @return false	if fails to obtain the file
	 */
	bool Read(const char* url, std::vector<char>& container);
	/**
	 * This function overloads and calls
	 * bool nfrd::misc::Utility::Read(const char* url,
	 *				  std::vector<char>& container).
	 * It takes std::string for url instead of const char*
	 * @param url		URL of the file
	 * @param container	where the data write to
	 * @return true		if success
	 * @return false	if fails to obtain the file
	 */
	bool Read(const std::string& url, std::vector<char>& container);
	/**
	 * This function overloads and calls
	 * bool nfrd::misc::Utility::Read(const char* url,
	 *				  std::vector<char>& container).
	 * Instead of passing container to the function, it returns the data via
	 * an auto pointer.
	 * @param url		URL of the file
	 * @return the file data 
	 * @throw length_error	if fail to fetch the data that url points to
	 */
	std::auto_ptr<std::vector<char> > Read(const std::string& url);
	
	/**
	 * String to integer.
	 * This function is equivalent to atoi(str.c_str());
	 * @param str	source string
	 * @return converted integer
	 */
	int ToInt(const std::string& str);
	
	/**
	 * String to boolean.
	 * This function is equivalent to (bool)atoi(str.c_str());
	 * @param str	source string
	 * @return converted boolean
	 */
	bool ToBool(const std::string& str);
	
	/**
	 * Get arguments from a line of a stream. It works like a bash
	 * interpretor on Unix in operations of quotes (" and ') and backslash
	 * Note: @a args will be truncated
	 * @param in	whether the arguments comes from
	 * @param args	where the arguments writes to
	 */
	void GetArguments(std::istream& in, std::vector<std::string>& args);
	
	/**
	 * Trim the trailing and ending whitespaces and return a new string.
	 * @param str	source string
	 * @return trimmed string
	 */
	std::string Trim(const std::string& str);
}}}

#endif
