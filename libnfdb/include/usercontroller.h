#ifndef LIBNFDB_USERCONTROLLER
#define LIBNFDB_USERCONTROLLER

#include "user.h"

class UserController
{
	public:
		User GetUserById(int id);
		User GetUserByUsername(string username);
		void UpdateUser(User& user);
		void AddUser(User& user);
};

#endif
