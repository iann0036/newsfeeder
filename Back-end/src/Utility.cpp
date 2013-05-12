/**
 * @file	Utility.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	24/08/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of all utility functions.
 */
 
#include <curl/curl.h>
#include <cstdlib>
#include "nfrd/Utility.h"
using namespace std;

/**
 * Define whitespace character string.
 * This variable is to indicate whitespace characters when parsing config file.
 * @see std::string nfrd::misc::Utility::Trim(const std::string& str)
 */
static const string WHITESPACES = " \t\f\v\n\r";

/**
 * Callback function used by
 * bool nfrd::misc::Utility::Read(const char* url,
 *				  std::vector<char>& container).
 * This is a callback function for cURL easy inteface API. The functionality is
 * to write bytes obtain from the url to the container.
 * This function is static, meaning that this function is only accessable in
 * this file.
 * @param ptr		data pointer
 * @param size		size of a memory block
 * @param nmemb		number of memory block
 * @param stream	container/stream the function writes data to
 * @return number of data successfully writed to the container/stream
 * @see bool nfrd::misc::Utility::Read(const char* url,
 *				       std::vector<char>& container)
 */
static size_t _write_data(void *ptr, size_t size, size_t nmemb, void *stream)
{
	char* p = (char*)ptr;
	vector<char>& data = *(vector<char>*)stream;
	size_t original = data.size();
	for (size_t i = 0; i < size * nmemb; i++)
		data.push_back(*p++);
	
	return data.size() - original;
}

// Read the content of the url and write to the container.
bool nfrd::misc::Utility::Read(const char* url, std::vector<char>& container)
{
	CURL *curl;
	CURLcode res;
	curl = curl_easy_init();
	if(curl)
	{
		curl_easy_setopt(curl, CURLOPT_URL, url);
		curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, _write_data);
		curl_easy_setopt(curl, CURLOPT_FILE, &container);
		curl_easy_setopt(curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_easy_setopt(curl, CURLOPT_MAXREDIRS, 255);
		res = curl_easy_perform(curl);
		curl_easy_cleanup(curl);
		return res == 0;
	}
	else
		return false;
}

bool nfrd::misc::Utility::Read(const std::string& url,
			       std::vector<char>& container)
{
	return Read(url.c_str(), container);
}

std::auto_ptr<std::vector<char> > nfrd::misc::Utility::Read(const string& url)
{
	std::auto_ptr<std::vector<char> > container(new std::vector<char>);
	if (Read(url, *container))
		return container;
	else
		throw length_error("fail to fetch: " + url);
}

// String to integer.
int nfrd::misc::Utility::ToInt(const std::string& str)
{
	return atoi(str.c_str());
}

// String to boolean.
bool nfrd::misc::Utility::ToBool(const std::string& str)
{
	return atoi(str.c_str());
}

// Get arguments from a line of a strean. It works like a bash interpretor on 
// Unix in operations of quotes (" and ') and backslash
void nfrd::misc::Utility::GetArguments(std::istream& in,
				       std::vector<std::string>& args)
{
	bool inString;
	char quote;
	char now;
	
	args.clear();
	while (!in.eof()) {
		string arg;
		inString = false;
		
		// Jump over whitesspaces
		now = in.get();
		while (!in.eof())
		{
			if (!isspace(now))
				break;
			else if (now == '\n')
				return;
			now = in.get();
		}
		
		// Parse argument string
		while (!in.eof())
		{
			if (isspace(now) && !inString)
			{
				in.unget();
				break;
			}
			else if (now == '"' || now == '\'')
			{
				if (inString)
				{
					if (quote == now)
						inString = false;
					else
						arg.push_back(now);
				}
				else
				{
					inString = true;
					quote = now;
				}
			}
			else if (inString && quote == '\'')
				arg.push_back(now);
			else if (now == '\\')
			{
				now = in.get();
				if (in.eof())
					arg.push_back('\\');
				else
					arg.push_back(now);
			}
			else
				arg.push_back(now);
			now = in.get();
		}
		args.push_back(arg);
	}
}

// Trim the trailing and ending whitespaces and return a new string.
std::string nfrd::misc::Utility::Trim(const std::string& str)
{
	size_t pos = str.find_first_not_of(WHITESPACES);
	if (pos == string::npos)
		return "";
	else
		return str.substr(pos, str.find_last_not_of(WHITESPACES)-pos+1);
}
