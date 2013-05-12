/**
 * @file	Comment.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing a Comment record
 */

#ifndef LIBNFDB_COMMENT
#define LIBNFDB_COMMENT

#include <string>
#include "nfrd/DateTime.h"

namespace nfdb {

/**
 * A class representing a row in the Comments table
 */
class Comment
{
	public:	
		int id;
		int itemId;
		std::string author;
		std::string via;
		nfrd::misc::DateTime date;
		std::string comment;
		char* avatar;
		int avatarSize;

		/**
		 * Initialising Constructor for Comment. Sets avatar to NULL
		 */
		Comment()
		{
			avatar = NULL;
		}

		/**
		 * Non-Default Constructor for Comment
		 * @param id	int identifier of the comment
		 * @param itemId	int representing the id of the item the comment was made on
		 * @param author	string representing who made the comment
		 * @param via	string representing where the comment was made
		 * @param date	datetime of the date the comment was made
		 * @param comment	string representing the actual comment text
		 * @param avatar	char* representing the avatar image of who sent the comment, nullable
		 * @param avatarSize	int representing the number of bytes in the avatar image, 0 if not included
		 */
		Comment(int id, int itemId, std::string author, std::string via, nfrd::misc::DateTime date, std::string comment, char* avatar, int avatarSize)
		{
			this->id = id;
			this->itemId = itemId;
			this->author = author;
			this->via = via;
			this->date = date;
			this->comment = comment;
			this->avatar = avatar;
			this->avatarSize = avatarSize;
		}

		/**
		 * Destructor for Comment. Does not perform any actions
		 */
		~Comment()
		{
			//Commented out to stop any issues regarding auto pointers freeing inappropriately
			//Destroy();
		}

		/**
		 * Cleans up any memory held by the Comment
		 */
		void Destroy()
		{
			if(avatar != NULL)
			{
				delete[] avatar;
				avatar = NULL;
			}
		}

};

}

#endif

