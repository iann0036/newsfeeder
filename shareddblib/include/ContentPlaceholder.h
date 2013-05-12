/**
 * @file	ContentPlaceholder.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Comment record
 */

#ifndef LIBNFDB_CONTENTPLACEHOLDER
#define LIBNFDB_CONTENTPLACEHOLDER

namespace nfdb {

/**
 * A class representing a row in the ContentPlaceholders table
 */
class ContentPlaceholder
{
	public:
		int id;
		int sheetId;
		int type;
		int column;
		int order;

		/**
		 * Initialising Constructor for ContentPlaceholder
		 */
		ContentPlaceholder()
		{
		}

		/**
		 * Non-Default Constructor for ContentPlaceholder
		 * @param id	int identifier of the contentplaceholder
		 * @param sheetId	int representing the id of the sheet this placeholder is located on
		 * @param type	int representing what type of content placeholder it is
		 * @param column	int representing which column the placeholder is located in
		 * @param order	int representing what order this placeholder is in the column
		 */
		ContentPlaceholder(int id, int sheetId, int type, int column, int order)
		{
			this->id = id;
			this->sheetId = sheetId;
			this->type = type;
			this->column = column;
			this->order = order;
		}

		/**
		 * Destructor for ContentPlaceholder, does not perform any actions
		 */
		~ContentPlaceholder()
		{
		}
		
		/**
		 * Cleans up any memory held by the ContentPlaceholder
		 */
		void Destroy()
		{
			//Performs no action, added for use by DB_Pointer
		}
};

}

#endif

