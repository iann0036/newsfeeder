/**
 * @file	DateTime.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	09/08/12
 *
 * @section	DESCRIPTION
 *
 * A class to store date and time
 */

#ifndef nfrd_DateTime_h
#define nfrd_DateTime_h
#include <string>

namespace nfrd { namespace misc
{
	/**
	 * A class to store date and time
	 */
	class DateTime
	{
	public:
		/**
		 * Dafault Constructor for Datatime.
		 * The time will be initialised to 01/01/0000 
		 */
		DateTime();
		/**
		 * Initialising Constructor for DateTime
		 * @param rhs	Source instance to copy
		 */
		DateTime(const DateTime& rhs);
		/**
		 * Delete all dynamic memory, if any
		 */
		~DateTime();
		/**
		 * Export a string with the format for MySQL datatime type.
		 * e.g. 2000-01-01 00:00:00 or 2000-1-1 0:0:0 both are OK.<br>
		 * This format can be parsed by mysql in a single SQL statement.
		 * @return Time string suitable for mysql
		 */
		std::string ExportToMySQL() const;
		/**
		 * Parse date time from a string from MySQL.
		 * Sample: 2000-01-01 00:00:00
		 * @param source	original date time string
		 * @throw std::domain_error if @param source is corrupted
		 */
		void ImportFromMySQL(const std::string& source);
		/**
		 * Parse date time from a string by auto detecting standard.
		 * Note: The date time will be forced coverneted to UTC+0000.
		 * @param source	original date time string
		 * @throw std::domain_error if @param source is corrupted
		 */
		void ParseFromString(const std::string& source);
		/**
		 * Parse date time from a string using the RFC822 standard.
		 * Note: The date time will be forced coverneted to UTC+0000.
		 * Sample: Sat, 07 Sep 2002 09:42:31 +0000
		 * @param source	original date time string
		 * @throw std::domain_error if @param source is corrupted
		 * @see http://www.ietf.org/rfc/rfc822.txt
		 */
		void ParseFromRFC822(const std::string& source);
		/**
		 * Parse date time from a string using the RFC3339 standard.
		 * Note: The date time will be forced coverneted to UTC+0000.
		 * Sample: 1937-01-01T12:00:27.87+00:20
		 * @param source	original date time string
		 * @throw std::domain_error if @param source is corrupted
		 * @see http://www.ietf.org/rfc/rfc3339.txt
		 */
		void ParseFromRFC3339(const std::string& source);
		/**
		 * Return the second part of the DateTime
		 * @return second part
		 */
		int GetSecond() const;
		/**
		 * Return the minute part of the DateTime
		 * @return minute part
		 */
		int GetMinute() const;
		/**
		 * Return the hour part of the DateTime
		 * @return hour part
		 */
		int GetHour() const;
		/**
		 * Return the day part of the DateTime
		 * @return day part
		 */
		int GetDay() const;
		/**
		 * Return the month part of the DateTime
		 * @return month part
		 */
		int GetMonth() const;
		/**
		 * Return the year part of the DateTime
		 * @return year part
		 */
		int GetYear() const;
		/**
		 * Set the second part of the DateTime.
		 * Note: The function does NOT do the roundings.
		 * The domain range of this attribute is 0-59.
		 * @param sec	second part
		 * @throws std::domain_error	for wrong domain
		 */
		void SetSecond(int sec);
		/**
		 * Set the minute part of the DateTime.
		 * Note: The function does NOT do the roundings.
		 * The domain range of this attribute is 0-59.
		 * @param min	minute part
		 * @throws std::domain_error	for wrong domain
		 */
		void SetMinute(int min);
		/**
		 * Set the hour part of the DateTime.
		 * Note: The function does NOT do the roundings.
		 * The domain range of this attribute is 0-23.
		 * @param h	hour part
		 * @throws std::domain_error	for wrong domain
		 */
		void SetHour(int h);
		/**
		 * Set the day part of the DateTime.
		 * Note: The function does NOT do the roundings.<br>
		 * The domain range of this attribute is as following.<br><pre>
		 *	Month			Range
		 *	1,3,5,7,8,10,12	1-31
		 *	4,6,9,11		1-30
		 *	2(leap year)		1-29
		 *	2(not leap year)	1-28</pre>
		 * If the day to be set is not sure for the month or year,
		 * use Set() or SetDateOffset() to safely set the day.
		 * @param d	day part
		 * @throws std::domain_error	for wrong domain
		 * @see Set()
		 * @see SetDateOffset()
		 */
		void SetDay(int d);
		/**
		 * Set the month part of the DateTime.
		 * Note: The function does NOT do the roundings.
		 * The domain range of this attribute is 1-12.
		 * The day part of the Datetime will automatically rounded.
		 * e.g. 30/03/2012 will become 01/03/2012 if month is set to 2.
		 * @param m	month part
		 * @throws std::domain_error	for wrong domain
		 */
		void SetMonth(int m);
		/**
		 * Set the year part of the DateTime.
		 * The year could be nagetive which means BC.
		 * @param y	year part
		 */
		void SetYear(int y);
		/**
		 * Set up all data in the DateTime.
		 * This function will DO the roundings by calling JustifyTime()
		 * and JustifyDate(). Hence, There is no domain restricted.
		 * @param y	year
		 * @param n	month
		 * @param d	day
		 * @param h	hour
		 * @param m	minute
		 * @param s	second
		 */
		void Set(int y, int n, int d, int h, int m, int s);
		/**
		 * Add time to the current DateTime.
		 * e.g. For DateTime 12:30:00, SetTimeOffset(2,45,30) will
		 * result in 15:15:30.<br>
		 * The function will do roundings automatically.<br>
		 * Note: Negative numbers are accepted as subtraction.
		 * @param h	hour
		 * @param m	minute
		 * @param s	second
		 */
		void SetTimeOffset(int h, int m=0, int s=0);
		/**
		 * Add date to the current DateTime.
		 * e.g. For DateTime 25/12/2011, SetDateOffset(10,1,0) will
		 * result in 04/02/2012.<br>
		 * The function will do roundings automatically.<br>
		 * Note: Negative numbers are accepted as subtraction.
		 * @param d	day
		 * @param m	month
		 * @param y	yeaar
		 */
		void SetDateOffset(int d, int m=0, int y=0);
		/**
		 * Compare two DateTime instances whether the current DateTime
		 * is before the specified DateTime.
		 * @param rhs	DateTime instance to be compared
		 * @return true	If the current DateTime is before the specified
		 *		DateTime.
		 */
		bool operator<(const DateTime& rhs) const;
		/**
		 * Compare two DateTime instances whether the current DateTime
		 * is after the specified DateTime.
		 * @param rhs	DateTime instance to be compared
		 * @return true	If the current DateTime is after the specified
		 *		DateTime.
		 */
		bool operator>(const DateTime& rhs) const;
		/**
		 * Compare two DateTime instances whether the current DateTime
		 * is equal to the specified DateTime.
		 * @param rhs	DateTime instance to be compared
		 * @return true	If the current DateTime is equal to the
		 *		specified DateTime.
		 */
		bool operator==(const DateTime& rhs) const;
		/**
		 * Compare two DateTime instances whether the current DateTime
		 * is not equal to the specified DateTime.
		 * @param rhs	DateTime instance to be compared
		 * @return true	If the current DateTime is not equal to the
		 *		specified DateTime.
		 */
		bool operator!=(const DateTime& rhs) const;
	private:
		/**
		 * Rounding the Time part of the DateTime.
		 * If necessary, it will call JusityDate() via SetDateOffset()
		 * for rounding the Date part.
		 */
		void JustifyTime();
		/**
		 * Rounding the Date part of the DateTime
		 */
		void JustifyDate();
		/// Second part of DateTime
		int second;
		/// Minute part of DateTime
		int minute;
		/// Hour part of DateTime
		int hour;
		/// Day part of DateTime
		int day;
		/// Month part of DateTime
		int month;
		/// Year part of DateTime
		int year;
	};
}}

#endif
