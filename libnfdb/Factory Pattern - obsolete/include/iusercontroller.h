#ifndef LIBNFDB_IUSERCONTROLLER
#define LIBNFDB_IUSERCONTROLLER

#include "user.h"

class IUserController
{
	public:
		virtual User GetUserById(int id) = 0;
		virtual User GetUserByUsername(string username) = 0;
		virtual void UpdateUser(User& user) = 0;
		virtual void AddUser(User& user) = 0;
};

#endif
