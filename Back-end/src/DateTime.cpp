/**
 * @file	DateTime.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	09/08/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of DateTime class
 */

#include <sstream>
#include <iomanip>
#include <cctype>
#include <cstdlib>
#include <stdexcept>
#include "nfrd/DateTime.h"
using namespace std;
using namespace nfrd::misc;

// Default Constructor
DateTime::DateTime() :
	second(0), minute(0), hour(0), day(1), month(1), year(0)
{
}

// Copy constructor
DateTime::DateTime(const DateTime& rhs) :
	second(rhs.second), minute(rhs.minute), hour(rhs.hour), day(rhs.day),
	month(rhs.month), year(rhs.year)
{
}

// Delete all dynamic memory, if any
DateTime::~DateTime()
{
}

// Export a string with the format for MySQL datatime type.
// e.g. 2000-01-01 00:00:00 or 2000-1-1 0:0:0 both are OK.
string DateTime::ExportToMySQL() const
{
	ostringstream sout;
	
	sout << setfill('0') << setw(4) << year << '-'
		<< setw(2) << month << '-' << setw(2) << day << ' ' << setw(2)
		<< hour << ':' << setw(2) << minute << ':' << setw(2) << second;
	
	return sout.str();
}

// Parse date time from a string from MySQL.
// Sample: 2000-01-01 00:00:00
void DateTime::ImportFromMySQL(const std::string& source)
{
	istringstream sin(source);
	string str;
	int day, month, year, hour, minute, second;
	
	sin.exceptions(ios::failbit | ios::badbit);
	try
	{
		getline(sin, str, '-');
		year = atoi(str.c_str());
		getline(sin, str, '-');
		month = atoi(str.c_str());
		getline(sin, str, ' ');
		day = atoi(str.c_str());
		getline(sin, str, ':');
		hour = atoi(str.c_str());
		getline(sin, str, ':');
		minute = atoi(str.c_str());
		sin >> second;
	}
	catch (const exception&)
	{
		throw domain_error(string("DateTime: Unable to parse: ")
				   .append(source));
	}
	
	// Export data
	this->year = year;
	this->month = month;
	this->day = day;
	this->hour = hour;
	this->minute = minute;
	this->second = second;
	
	// Justify
	JustifyTime();
	JustifyDate();
}

// Parse date time from a string by auto detecting standard
void DateTime::ParseFromString(const std::string& source)
{
	if (source.find(' ') == string::npos)
		ParseFromRFC3339(source);
	else
		ParseFromRFC822(source);
}

// Parse date time from a string using the RFC822 standard.
// Sample: Sat, 07 Sep 2002 09:42:31 +0000
void DateTime::ParseFromRFC822(const std::string& source)
{
	istringstream sin(source);
	string str;
	int day, month, year, hour, minute, second;
	
	sin.exceptions(ios::failbit | ios::badbit);
	try
	{
		sin >> str;	// Read in week
		sin >> day;	// Read in day
		sin >> str;	// Read in month
		if (str == "Jan")
			month = 1;
		else if (str == "Feb")
			month = 2;
		else if (str == "Mar")
			month = 3;
		else if (str == "Apr")
			month = 4;
		else if (str == "May")
			month = 5;
		else if (str == "Jun")
			month = 6;
		else if (str == "Jul")
			month = 7;
		else if (str == "Aug")
			month = 8;
		else if (str == "Sep")
			month = 9;
		else if (str == "Oct")
			month = 10;
		else if (str == "Nov")
			month = 11;
		else if (str == "Dec")
			month = 12;
		else
			throw domain_error("Bad month");
		sin >> year;
		getline(sin, str, ':');
		hour = atoi(str.c_str());
		getline(sin, str, ':');
		minute = atoi(str.c_str());
		sin >> second;
	}
	catch (const domain_error& err)
	{
		throw domain_error(string("DateTime: Unable to parse: ")
				   .append(err.what()).append(": ")
				   .append(source));
	}
	catch (const exception&)
	{
		throw domain_error(string("DateTime: Unable to parse: ")
				   .append(source));
	}
	
	// Export data
	this->year = year;
	this->month = month;
	this->day = day;
	this->hour = hour;
	this->minute = minute;
	this->second = second;
	
	// Set timezone/offset
	try
	{
		sin >> str;	// Read in Timezone
	}
	catch (const exception&)	// No timezone set
	{
		// Justify
		JustifyTime();
		JustifyDate();
		return;
	}
	if (str.length() == 5 && (str[0] == '-' || str[0] == '+')
	    && isdigit(str[1]) && isdigit(str[2])
	    && isdigit(str[3]) && isdigit(str[4]))
	{
		if (str[0] == '+')
			SetTimeOffset(-atoi(str.substr(1,2).c_str()),
				      -atoi(str.substr(3,2).c_str()));
		else
			SetTimeOffset(+atoi(str.substr(1,2).c_str()),
				      +atoi(str.substr(3,2).c_str()));
	}
	else if (str.length() == 1 && isalpha(str[0]))	// Military
	{
		char zone = toupper(str[0]);
		if (zone == 'J')
			throw domain_error(string("DateTime: Unable to parse: ")
					   .append("Bad timezone: ")
					   .append(source));
		else if (zone == 'Z')	// Z = UT
			JustifyTime();
		else
		{
			if (zone < 'J')	// A->B, ..., H->J
				zone++;
			if (zone < 'N')	// A(B):-0100 M:-1200
				SetTimeOffset(zone - 'A');
			else		// N:+0100 Y:+1200
				SetTimeOffset('M' - zone);
		}
	}
	else if (str == "UT" || str == "GMT")	// Universal Time
		JustifyTime();
	else if (str == "EDT")		// All below if-else statements are
		SetTimeOffset(4);	// specified in America
	else if (str == "EST" || str == "CDT")
		SetTimeOffset(5);
	else if (str == "CST" || str == "MDT")
		SetTimeOffset(6);
	else if (str == "MST" || str == "PDT")
		SetTimeOffset(7);
	else if (str == "PST")
		SetTimeOffset(8);
	else
		throw domain_error(string("DateTime: Unable to parse: ")
				   .append("Bad or unknown timezone: ")
				   .append(source));
	
	// Justify
	JustifyDate();
}

// Parse date time from a string using the RFC3339 standard.
// Sample: 1937-01-01T12:00:27.87+00:20
void DateTime::ParseFromRFC3339(const std::string& source)
{
	istringstream sin(source);
	string str;
	size_t pos;
	int day, month, year, hour, minute, second;
	
	sin.exceptions(ios::failbit | ios::badbit);
	try
	{
		getline(sin, str, '-');
		year = atoi(str.c_str());
		getline(sin, str, '-');
		month = atoi(str.c_str());
		getline(sin, str, 'T');
		day = atoi(str.c_str());
		getline(sin, str, ':');
		hour = atoi(str.c_str());
		getline(sin, str, ':');
		minute = atoi(str.c_str());
		sin >> str;	// Read in second and time zone
		// Parse second
		string second_string;
		pos = str.find_first_not_of("0123456789.");
		if (pos == string::npos)
			throw domain_error("Timezone not found");
		second_string = str.substr(0, pos);
		str = str.substr(pos);
		pos = second_string.find('.');
		if (pos == string::npos)
			second = atoi(second_string.c_str());
		else
			second = atoi(second_string.substr(0, pos).c_str());
	}
	catch (const domain_error& err)
	{
		throw domain_error(string("DateTime: Unable to parse: ")
				   .append(err.what()).append(": ")
				   .append(source));
	}
	catch (const exception&)
	{
		throw domain_error(string("DateTime: Unable to parse: ")
				   .append(source));
	}
	
	// Export data
	this->year = year;
	this->month = month;
	this->day = day;
	this->hour = hour;
	this->minute = minute;
	this->second = second;
	
	// Set timezone/offset
	if (str.length() == 1 && toupper(str[0]) == 'Z')
	{
		// Justify
		JustifyTime();
		JustifyDate();
		return;
	}
	pos = str.find(':');
	if (str.length() < 4 || !(str[0] == '-' || str[0] == '+') ||
	    pos == string::npos)
		throw domain_error(string("DateTime: Unable to parse: ")
				   .append("Bad or unknown timezone: ")
				   .append(source));
	hour = atoi(str.substr(1, pos - 1).c_str());
	minute = atoi(str.substr(pos + 1).c_str());
	if (str[0] == '+')
		SetTimeOffset(-hour, -minute);
	else
		SetTimeOffset(+hour, +minute);

	// Justify
	JustifyDate();
}

// Getter Sector
int DateTime::GetSecond() const
{
	return second;
}

int DateTime::GetMinute() const
{
	return minute;
}

int DateTime::GetHour() const
{
	return hour;
}

int DateTime::GetDay() const
{
	return day;
}

int DateTime::GetMonth() const
{
	return month;
}

int DateTime::GetYear() const
{
	return year;
}

// Setter Sector: May throw std::domain_error for wrong domain
void DateTime::SetSecond(int sec)
{
	if (sec < 0 || sec > 59)
		throw domain_error("DateTime: Bad second");
	second = sec;
}

void DateTime::SetMinute(int min)
{
	if (min < 0 || min > 59)
		throw domain_error("DateTime: Bad minute");
	minute = min;
}

void DateTime::SetHour(int h)
{
	if (h < 0 || h > 23)
		throw domain_error("DateTime: Bad hour");
	hour = h;
}

void DateTime::SetDay(int d)
{
	switch (month)
	{
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
			if (d < 1 || d > 31)
				throw domain_error("DateTime: Bad Day");
			break;
		case 4:
		case 6:
		case 9:
		case 11:
			if (d < 1 || d > 30)
				throw domain_error("DateTime: Bad Day");
			break;
		case 2:
			if ((year % 4 == 0 && year % 100 != 0) ||
			    (year % 400 == 0 && year % 3200 != 0) ||
			    year % 172800 == 0)	// Leap year
			{
				if (d < 1 || d > 29)
					throw domain_error("DateTime: Bad Day");
			}
			else
			{
				if (d < 1 || d > 28)
					throw domain_error("DateTime: Bad Day");
			}
			break;
		default:
			throw domain_error("DateTime: Bad Day");
	}
	day = d;
}

void DateTime::SetMonth(int m)
{
	if (m < 1 || m > 12)
		throw domain_error("DateTime: Bad month");
	month = m;
	
	// Justify
	JustifyDate();
}

void DateTime::SetYear(int y)
{
	year = y;
}

void DateTime::Set(int y, int n, int d, int h, int m, int s)
{
	year = y;
	month = n;
	day = d;
	hour = h;
	minute = m;
	second = s;
	
	// Justify
	JustifyTime();
	JustifyDate();
}

// Set time offset
void DateTime::SetTimeOffset(int h, int m, int s)
{
	// Add offset
	second += s;
	minute += m;
	hour += h;
	
	// Justify
	JustifyTime();
}

// Set Date Offset
void DateTime::SetDateOffset(int d, int m, int y)
{
	// Add offset
	day += d;
	month += m;
	year += y;
	
	// Justify
	JustifyDate();
}

// Comparision operators
bool DateTime::operator<(const DateTime& rhs) const
{
	if (year != rhs.year)
		return year < rhs.year;
	else if (month != rhs.month)
		return month < rhs.month;
	else if (day != rhs.day)
		return day < rhs.day;
	else if (hour != rhs.hour)
		return hour < rhs.hour;
	else if (minute != rhs.minute)
		return minute < rhs.minute;
	else
		return second < rhs.second;
}

bool DateTime::operator>(const DateTime& rhs) const
{
	if (year != rhs.year)
		return year > rhs.year;
	else if (month != rhs.month)
		return month > rhs.month;
	else if (day != rhs.day)
		return day > rhs.day;
	else if (hour != rhs.hour)
		return hour > rhs.hour;
	else if (minute != rhs.minute)
		return minute > rhs.minute;
	else
		return second > rhs.second;
}

bool DateTime::operator==(const DateTime& rhs) const
{
	return (year == rhs.year && month == rhs.month && day == rhs.day &&
		hour == rhs.hour && minute == rhs.minute &&
		second == rhs.second);
}

bool DateTime::operator!=(const DateTime& rhs) const
{
	return (year != rhs.year || month != rhs.month || day != rhs.day ||
		hour != rhs.hour || minute != rhs.minute ||
		second != rhs.second);
}

// Justify Time
void DateTime::JustifyTime()
{
	int day_offset = 0;
	
	minute += second / 60;
	second %= 60;
	if (second < 0)
	{
		second += 60;
		minute--;
	}
	hour += minute / 60;
	minute %= 60;
	if (minute < 0)
	{
		minute += 60;
		hour--;
	}
	day_offset += hour / 24;
	hour %= 24;
	if (hour < 0)
	{
		hour += 24;
		day_offset--;
	}
	if (day_offset != 0)
		SetDateOffset(day_offset);
}

// Justify Date
void DateTime::JustifyDate()
{
	month += (day - 1) / 31;
	day = (day - 1) % 31 + 1;
	if (day < 1)
	{
		day += 31;
		month--;
	}
	year += (month - 1) / 12;
	month = (month - 1) % 12 + 1;
	if (month < 1)
	{
		month += 12;
		year--;
	}
	switch (month) {
		case 2:
			if ((year % 4 == 0 && year % 100 != 0) ||
			    (year % 400 == 0 && year % 3200 != 0) ||
			    year % 172800 == 0)	// Leap year
			{
				if (day > 29)
				{
					month = 3;
					day -= 29;
				}
			}
			else if (day > 28)
			{
				month = 3;
				day -= 28;
			}
			break;
		case 4:
		case 6:
		case 9:
		case 11:
			if (day > 30)
			{
				month++;
				day = 1;
			}
			break;
		default:
			break;
	}
}
