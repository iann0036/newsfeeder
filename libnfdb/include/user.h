#ifndef LIBNFBD_USER
#define LIBNFBD_USER

#include <string>
#include "datetime.h"

using namespace std;

class User
{
	private:
		int id;
		string username;
		string password;
		char* picture;
		DateTime registered;
		string name;
		string email;
		bool isAdmin;
		bool useHttps;
		int layout;		
};

#endif
