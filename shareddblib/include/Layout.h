/**
 * @file	Layout.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Layout record
 */

#ifndef LIBNFDB_LAYOUT
#define LIBNFDB_LAYOUT

namespace nfdb {

/**
 * A class representing a row in the Layout table
 */
class Layout
{
	public:
		int id;

		/**
		 * Initialising Constructor for Layout
		 */
		Layout()
		{
		}
	
		/**
		 * Non-Default Constructor for Layout
		 * @param id	int identifier of the layout
		 */
		Layout(int id)
		{
			this->id = id;
		}
		
		/**
		 * Destructor for Layout, does not perform any actions
		 */
		~Layout()
		{
		}

		/**
		 * Cleans up any memory held by the Layout
		 */
		void Destroy()
		{
		}
};

}

#endif

