/**
 * @file	Image.h
 * @author	Michael Boge <mjb932@uow.edu.au>
 * @date	5/8/12
 *
 * @section	DESCRIPTION
 *
 * Defines the struct class representing an Image record
 */

#ifndef LIBNFDB_IMAGE
#define LIBNFDB_IMAGE

#include <cstdlib>
#include <string>

namespace nfdb {

/**
 * A class representing a row in the Images table
 */
class Image
{
	public:
		int id;
		int itemId;
		char* image;
		int imageSize;
		std::string url;

		/**
		 * Initialising Constructor for Image, sets image to NULL
		 */
		Image()
		{
			image = NULL;
		}

		/**
		 * Non-Default Constructor for Image
		 * @param id	int identifier of the image
		 * @param itemId	int representing the id of the item this image relates to
		 * @param image	char* representing the actual image array, nullable
		 * @param imageSize	int representing the size of the image in bytes, 0 if no image supplied
		 * @param url	string representing the url of the image
		 */
		Image(int id, int itemId, char* image, int imageSize, std::string url)
		{
			this->id = id;
			this->itemId = itemId;
			this->image = image;
			this->imageSize = imageSize;
			this->url = url;
		}

		/**
		 * Destructor for Image, does not perform any actions
		 */
		~Image()
		{
			//Commented out to stop any issues regarding auto pointers freeing inappropriately
			//Destroy();
		}

		/**
		 * Cleans up any memory held by the Image
		 */
		void Destroy()
		{
			if(image != NULL)
			{
				delete[] image;
				image = NULL;
			}
		}
};

}

#endif

