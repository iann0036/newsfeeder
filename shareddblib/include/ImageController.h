/**
 * @file	ImageController.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines a class called to create, update, delete or find images.
 */

#ifndef LIBNFDB_IMAGECONTROLLER
#define LIBNFDB_IMAGECONTROLLER

#include "Image.h"
#include "DatabaseController.h"
#include <cppconn/connection.h>
#include <cppconn/resultset.h>
#include <vector>

namespace nfdb {

/**
 * A class called to create, update, delete or find images.
 */
class ImageController
{
	public:
		/**
		 * Initialising Constructor for ImageController, opens a database connection
		 */
		ImageController();

		/**
		 * Deallocates any dynamic memory and closes the database connection
		 */
		~ImageController();

		/**
		 * Find the image with that id
		 * @param id	primary key id of the image
		 * @return the image with that id
		 */
		Image* GetImageById(int id);

		/**
		 * Find all images that belong to the item of that id
		 * @param itemId	id of the item to find images for
		 * @return the images that belong to that item
		 */
		std::vector<Image*> GetImagesByItemId(int itemId);

		/**
		 * Find all images
		 * @return all images in the database
		 */
		std::vector<Image*> GetAllImages();

		/**
		 * Insert the image into the database
		 * @param image	image to be added to the database
		 * @return id of the newly added image, -1 for an error
		 */
		int AddImage(Image& image);

		/**
		 * Update the relevant image in the database
		 * @param image	image to be updated
		 */
		void UpdateImage(Image& image);

		/**
		 * Update the relevant image in the database, NULLs passed if that parameter is not to be updated
		 * @param id	int identifier of the image
		 * @param itemId	int representing the id of the item this image relates to, nullable
		 * @param image	char* representing the actual image array, nullable
		 * @param imageSize	int representing the size of the image in bytes, 0 if no image supplied
		 * @param url	string representing the url of the image, nullable
		 */
		void UpdateImage(int id, int* itemId, char* image, int* imageSize, std::string* url);

		/**
		 * Delete the image from the database
		 * @param image	image to be removed from the database
		 */
		void RemoveImage(int id);

		/**
		 * Generate a image based on the data in a result set row
		 * @param rs	result set pointing at the current row for generating a image
		 * @return the generated image
		 */
		Image* GenerateImage(sql::ResultSet& rs);

	private:
		/// Database controller used to connect to the database
		DatabaseController* dbc;
		/// Connection to the database
		sql::Connection* conn;
};

}

#endif
