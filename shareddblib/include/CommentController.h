/**
 * @file	CommentController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find comments.
 */

#ifndef LIBNFDB_COMMENTCONTROLLER
#define LIBNFDB_COMMENTCONTROLLER

#include "Comment.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>
#include <string>

namespace nfdb {

/**
 * A class called to create, update, delete or find comments.
 */
class CommentController
{
	public:
		/**
		 * Initialising Constructor for CommentController, opens a database connection
		 */
		CommentController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~CommentController();

		/**
		 * Find the comment with that id
		 * @param id	primary key id of the comment
		 * @return the comment with that id
		 */
		Comment* GetCommentById(int id);

		/**
		 * Find all comments that belong to the item of that id
		 * @param itemId	id of the item to find comments for
		 * @return the comments that belong to that item
		 */
		std::vector<Comment*> GetCommentsByItemId(int itemId);

		/**
		 * Find all comments
		 * @return all comments in the database
		 */
		std::vector<Comment*> GetAllComments();

		/**
		 * Insert the comment into the database
		 * @param comment	comment to be added to the database
		 * @return id of the newly added comment, -1 for error
		 */
		int AddComment(Comment& comment);

		/**
		 * Update the relevant comment in the database
		 * @param comment	comment to be updated
		 */
		void UpdateComment(Comment& comment);

		/**
		 * Update the relevant comment in the database, NULLS passed if that parameter is not to be updated
		 * @param id	int identifier of the comment
		 * @param itemId	int* representing the id of the item the comment was made on, nullable
		 * @param author	string* representing who made the comment, nullable
		 * @param via	string* representing where the comment was made, nullable
		 * @param date	datetime of the date the comment was made, nullable
		 * @param comment	string* representing the actual comment text, nullable
		 * @param avatar	char* representing the avatar image of who sent the comment, nullable
		 * @param avatarSize	int representing the number of bytes in the avatar image, 0 if not included
		 */
		void UpdateComment(int id, int* itemId, std::string* author, std::string* via, nfrd::misc::DateTime* date, std::string* comment, char* avatar, int avatarSize);

		/**
		 * Delete the comment from the database
		 * @param comment	comment to be removed from the database
		 */
		void RemoveComment(int id);

		/**
		 * Generate a comment based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a comment
		 * @return the generated comment
		 */
		Comment* GenerateComment(sql::ResultSet& rs);
		
	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
