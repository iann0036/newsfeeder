/* compile with: g++ test.cpp -I/usr/include/cppconn -I/usr/include/boost -L/usr/lib -lmysqlcppconn */

#include "DatabaseController.h"
#include <cppconn/exception.h>

using namespace std;
using namespace sql;
using namespace nfdb;

const string DBHOST = "tcp://CENSORED.cs.uow.edu.au:3306";
const string USER = "test";
const string PASSWORD = "CENSORED";
const string DATABASE = "test_nf";

/**
 * Initialising Constructor for DatabaseController
 */
DatabaseController::DatabaseController()
{

}

/**
 * Deallocates any dynamic memory
 */
DatabaseController::~DatabaseController()
{
	if(this->conn != NULL)
	{
		delete this->conn;
		this->conn = NULL;
	}
}

/**
 * Connects to the database and returns the active connection
 */
Connection* DatabaseController::Connect()
{
	sql::Driver* driver;

	try {
		driver = get_driver_instance();
		
		//create a database connection using the driver
		this->conn = driver->connect(DBHOST, USER, PASSWORD);

		//select the appropriate database schema
		this->conn->setSchema(DATABASE);

		return this->conn;
	}
	catch (SQLException &e)
	{
		cout << "ERROR: SQLException in " << __FILE__;
		cout << " (" << __func__<< ") on line " << __LINE__ << endl;
		cout << "ERROR: " << e.what();
		cout << " (MySQL error code: " << e.getErrorCode();
		cout << ", SQLState: " << e.getSQLState() << ")" << endl;

		return NULL;
	}
}

/**
 * Disconnects from the database
 */
void DatabaseController::Disconnect()
{
	this->conn->close();
}
