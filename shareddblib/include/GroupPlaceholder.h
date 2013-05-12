/**
 * @file	GroupPlaceholder.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a GroupPlaceholder record
 */

#ifndef LIBNFDB_GROUPPLACEHOLDER
#define LIBNFDB_GROUPPLACEHOLDER

namespace nfdb {

/**
 * A class representing a row in the GroupPlaceholders table
 */
class GroupPlaceholder
{
	public:
		int id;
	
		/**
		 * Initialising Constructor for GroupPlaceholder
		 */
		GroupPlaceholder()
		{
		}

		/**
		 * Non-Default Constructor for GroupPlaceholder
		 * @param id	int identifier of the group placeholder
		 */
		GroupPlaceholder(int id)
		{
			this->id = id;
		}

		/**
		 * Destructor for GroupPlaceholder, does not perform any actions
		 */
		~GroupPlaceholder()
		{
		}

		/**
		 * Cleans up any memory held by the GroupPlaceholder
		 */
		void Destroy()
		{
		}
};

}

#endif

