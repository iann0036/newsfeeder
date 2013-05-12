#include "CommentController.h"
#include <cppconn/prepared_statement.h>
#include <sstream>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for CommentController, opens a database connection
 */
CommentController::CommentController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
CommentController::~CommentController()
{
	delete dbc;
}

/**
 * Find the comment with that id
 */
Comment* CommentController::GetCommentById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM comments WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If we get a result matching, return the generated comment
			Comment* c = GenerateComment(*rs);
			delete rs;
			return c;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all comments that belong to the item of that id
 */
vector<Comment*> CommentController::GetCommentsByItemId(int itemId)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM comments WHERE itemid = ?");
	
	stmt->setInt(1, itemId);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	vector<Comment*> comments;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//For each result add a comment to the vector
			comments.push_back(GenerateComment(*rs));
		}
		delete rs;
	}

	return comments;

}

/**
 * Find all comments
 */
vector<Comment*> CommentController::GetAllComments()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM comments");

	delete stmt;

	vector<Comment*> comments;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all comments in the database to a vector
			comments.push_back(GenerateComment(*rs));
		}
		delete rs;
	}

	return comments;
}

/**
 * Insert the comment into the database
 */
int CommentController::AddComment(Comment& comment)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO comments (itemid, author, via, date, comment, avatar) VALUES (?,?,?,?,?,?)");
	
	//Set all parameters based on the passed comment
	stmt->setInt(1, comment.itemId);
	stmt->setString(2, comment.author);
	stmt->setString(3, comment.via);
	stmt->setString(4, comment.date.ExportToMySQL());
	stmt->setString(5, comment.comment);
	stmt->setString(6, comment.avatar);

	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Perform another query to get the ID of the inserted record
	Statement* lastStmt = conn->createStatement();
	ResultSet* rs = lastStmt->executeQuery("SELECT LAST_INSERT_ID()");
	if(rs != NULL)
	{
		while(rs->next())
		{
			int lastId = rs->getInt("LAST_INSERT_ID()");
			delete rs;
			delete lastStmt;
			return lastId;
		}
	}
	else
	{
		delete lastStmt;
		return -1;
	}

	return -1;
}

/**
 * Update the relevant comment in the database
 */
void CommentController::UpdateComment(Comment& comment)
{
	PreparedStatement* stmt = conn->prepareStatement("UPDATE comments SET itemid = ?, author = ?, via = ?, date = ?, comment = ?, avatar = ? WHERE id = ?");
	//Set parameters based on passed comment
	stmt->setInt(1, comment.itemId);
	stmt->setString(2, comment.author);
	stmt->setString(3, comment.via);
	stmt->setString(4, comment.date.ExportToMySQL());
	stmt->setString(5, comment.comment);
	stmt->setString(6, comment.avatar);
	stmt->setInt(7, comment.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant comment in the database, NULLS passed if that parameter is not to be updated
 */
void CommentController::UpdateComment(int id, int* itemId, string* author, string* via, nfrd::misc::DateTime* date, string* comment, char* avatar, int avatarSize)
{
	string query = "UPDATE comments SET ";
	//For each parameter to be changed (not null) add it to the query
	if(itemId != NULL)
	{
		query += "itemid = ?";
	}
	else
	{
		query += "itemid = itemid";
	}
	if(author != NULL)
	{
		query += ", author = ?";
	}
	else
	{
		query += ", author = author";
	}
	if(via != NULL)
	{
		query += ", via = ?";
	}
	else
	{
		query += ", via = via";
	}
	if(date != NULL)
	{
		query += ", date = ?";
	}
	else
	{
		query += ", date = date";
	}
	if(comment != NULL)
	{
		query += ", comment = ?";
	}
	else
	{
		query += ", comment = comment";
	}
	if(avatar != NULL)
	{
		query += ", avatar = ?";
	}
	else
	{
		query += ", avatar = avatar";
	}	
	query += " WHERE id = ?";

	PreparedStatement* stmt = conn->prepareStatement(query);
	int param = 1;	
	//Add each value to the query generated
	if(itemId != NULL)
	{
		stmt->setInt(param, *itemId);
		param++;
	}
	if(author != NULL)
	{
		stmt->setString(param, *author);
		param++;
	}
	if(via != NULL)
	{
		stmt->setString(param, *via);
		param++;
	}
	if(date != NULL)
	{
		stmt->setString(param, date->ExportToMySQL());
		param++;
	}
	if(comment != NULL)
	{
		stmt->setString(param, *comment);
		param++;
	}
	if(avatar != NULL)
	{
		//Retrieve the istream and pass as a blob
		istringstream tempBlob(string(avatar, avatarSize));
		stmt->setBlob(param, &tempBlob);
		param++;
	}
	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Delete the comment from the database
 */
void CommentController::RemoveComment(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM comments WHERE id = ?");

	stmt->setInt(1, id);
	//Delete by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Generate a comment based on the data in a result set row
 */
Comment* CommentController::GenerateComment(ResultSet& rs)
{
	Comment* comm = new Comment();
	//Generate a new comment using the result set data
	comm->id = rs.getInt("id");
	comm->itemId = rs.getInt("itemid");
	comm->author = rs.getString("author");
	comm->via = rs.getString("via");
	comm->date.ImportFromMySQL(rs.getString("date"));
	comm->comment = rs.getString("comment");

	//Retrieve the blob and convert it into a char*
	istream* is = rs.getBlob("avatar");
	is->seekg(0, ios::end);
	int length = (int)is->tellg();
	is->seekg(0, ios::beg);
	char* buffer = new char[length];
	is->read(buffer, length);
	comm->avatar = buffer;
	comm->avatarSize = length;
	delete buffer;
	delete is;

	return comm;
}

