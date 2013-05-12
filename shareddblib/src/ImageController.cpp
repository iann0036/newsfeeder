#include "ImageController.h"
#include <cppconn/prepared_statement.h>
#include <sstream>

using namespace std;
using namespace sql;
using namespace nfdb;

/**
 * Initialising Constructor for ImageController, opens a database connection
 */
ImageController::ImageController()
{
	dbc = new DatabaseController();
	conn = dbc->Connect();
}

/**
 * Deallocates any dynamic memory and closes the database connection
 */
ImageController::~ImageController()
{
	delete dbc;
}

/**
 * Find the image with that id
 */
Image* ImageController::GetImageById(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM images WHERE id = ?");
	
	stmt->setInt(1, id);

	ResultSet* rs = stmt->executeQuery();

	delete stmt;

	if(rs != NULL)
	{
		while(rs->next())
		{
			//If there is a image with that ID return it
			Image* i = GenerateImage(*rs);
			delete rs;
			return i;
		}
	}
	else
	{
		return NULL;
	}

	return NULL;
}

/**
 * Find all images that belong to the item of that id
 */
vector<Image*> ImageController::GetImagesByItemId(int itemId)
{
	PreparedStatement* stmt = conn->prepareStatement("SELECT * FROM images WHERE itemid = ?");
	
	stmt->setInt(1, itemId);

	ResultSet* rs = stmt->executeQuery();

	vector<Image*> images;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//For each result add to a vector
			images.push_back(GenerateImage(*rs));
		}
	}

	delete stmt;
	delete rs;

	return images;

}

/**
 * Find all images
 */
vector<Image*> ImageController::GetAllImages()
{
	Statement* stmt = conn->createStatement();

	ResultSet* rs = stmt->executeQuery("SELECT * FROM images");

	vector<Image*> images;
	if(rs != NULL)
	{
		while(rs->next())
		{
			//Add all images to a vector
			images.push_back(GenerateImage(*rs));
		}
	}

	delete stmt;
	delete rs;

	return images;
}

/**
 * Insert the image into the database
 */
int ImageController::AddImage(Image& image)
{
	PreparedStatement* stmt = conn->prepareStatement("INSERT INTO images (itemid, image, url) VALUES (?,?,?)");

	stmt->setInt(1, image.itemId);
	//Populate the blob
	istringstream tempBlob(string(image.image, image.imageSize));
	stmt->setBlob(2, &tempBlob);

	stmt->setString(3, image.url);
	//Insert
	stmt->executeUpdate();

	delete stmt;

	//Create another query and get the id of the inserted image
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
 * Update the relevant image in the database
 */
void ImageController::UpdateImage(Image& image)
{

	PreparedStatement* stmt = conn->prepareStatement("UPDATE images SET itemid = ?, image = ?, url = ? WHERE id = ?");

	stmt->setInt(1, image.itemId);
	//Set the image blob
	istringstream tempBlob(string(image.image, image.imageSize));
	stmt->setBlob(2, &tempBlob);

	stmt->setString(3, image.url);
	stmt->setInt(4, image.id);

	stmt->executeUpdate();

	delete stmt;
}

/**
 * Update the relevant image in the database, NULLs passed if that parameter is not to be updated
 */
void ImageController::UpdateImage(int id, int* itemId, char* image, int* imageSize, string* url)
{
	//Generate the update query based on parameters input
	string query = "Update images SET ";
	if(itemId != NULL)
	{
		query += "itemid = ? ";
	}
	else
	{
		query += "itemid = itemid ";
	}
	if(image != NULL)
	{
		query += ", image = ? ";
	}
	else
	{
		query += ", image = image ";
	}
	if(url != NULL)
	{
		query += ", url = ? ";
	}
	else
	{
		query += ", url = url ";
	}
	query += "WHERE id = ?";

	PreparedStatement* stmt = conn->prepareStatement(query);
	
	int param = 1;
	//Set the parameter values
	if(itemId != NULL)
	{
		stmt->setInt(param, *itemId);
		param++;
	}
	if(image != NULL)
	{
		istringstream tempBlob(string(image, *imageSize));
		stmt->setBlob(param, &tempBlob);
		param++;
	}
	if(url != NULL)
	{
		stmt->setString(param, *url);
		param++;
	}

	stmt->setInt(param, id);

	stmt->executeUpdate();

	delete stmt;

}

/**
 * Delete the image from the database
 */
void ImageController::RemoveImage(int id)
{
	PreparedStatement* stmt = conn->prepareStatement("DELETE FROM images WHERE id = ?");
	
	stmt->setInt(1, id);
	//Remove by ID
	stmt->executeUpdate();

	delete stmt;
}

/**
 * Generate a image based on the data in a result set row
 */
Image* ImageController::GenerateImage(ResultSet& rs)
{
	Image* i = new Image();
	//Populate the new Image based on the results
	i->id = rs.getInt("id");
	i->itemId = rs.getInt("itemid");
	//Get the blob and convert to char*
	istream* is = rs.getBlob("image");
	is->seekg(0, ios::end);
	int length = (int)is->tellg();
	is->seekg(0, ios::beg);
	char* buffer = new char[length];
	is->read(buffer, length);
	i->image = buffer;
	i->imageSize = length;
	delete is;
	i->url = rs.getString("url");

	return i;
}

