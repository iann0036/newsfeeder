/**
 * @file	Session.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Session record
 */

#ifndef LIBNFDB_SESSION
#define LIBNFDB_SESSION

#include <string>
#include "nfrd/DateTime.h"

namespace nfdb {

/**
 * A class representing a row in the Session table
 */
class Session
{
	public:

		int id;
		std::string username;
		std::string key;
		nfrd::misc::DateTime time;

		/**
		 * Initialising Constructor for Session
		 */
		Session()
		{
		}

		/**
		 * Non-Default Constructor for Session
		 * @param id	int identifier of the session
		 * @param username	string representing the username of the user this session relates to
		 * @param key	string representing the unique key of the session
		 * @param time	datetime representing the time the session was created
		 */
		Session(int id, std::string username, std::string key, nfrd::misc::DateTime time)
		{
			this->id = id;
			this->username = username;
			this->key = key;
			this->time = time;
		}

		/**
		 * Destructor for Session, does not perform any actions
		 */
		~Session()
		{
		}

		/**
		 * Cleans up any memory held by the Session
		 */
		void Destroy()
		{
		}

};

}

#endif

