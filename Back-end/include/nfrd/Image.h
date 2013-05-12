/**
 * @file	Image.h
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	24/08/12
 *
 * @section	DESCRIPTION
 *
 * A class to store image and process image
 */

#ifndef nfrd_Image_h
#define nfrd_Image_h
#include <string>
#include <vector>
#include <memory>
#include <gd.h>

namespace nfrd { namespace misc
{
	/**
	 * A class to store image and process image
	 */
	class Image
	{
	public:
		/**
		 * Types of Image
		 */
		enum Type
		{
			/// Unknown format
			UNKNOWN,
			/// GD format: .gd
			GD,
			/// GD2 format: .gd2
			GD2,
			/// Graphics Interchange format: .gif
			GIF,
			/// JPEG format: .jpg, .jpeg, .jpe .jif, .jfif, .jfi
			JPEG,
			/// Portable Network Graphics format: .png
			PNG,
			/// Wireless Application Protocol Bitmap format: .wbmp
			WBMP
		};
		/**
		 * A class to represent an image file (as an ownner)
		 */
		class File
		{
		public:
			/**
			 * Construct image file by owning a block of memory
			 * @warning	this constructor should only be used
			 *		with libgd
			 * @param data	starting memory address of the file
			 * @param size	size of the memory block
			 * @param type	type of the image
			 */
			File(void* data, int size, Type type = UNKNOWN);
			/**
			 * Delete all dynamic memory, if any
			 */
			~File();
			/**
			 * Get the memory block of the file
			 * @return the starting address of the memory
			 */
			const void* GetData() const;
			/**
			 * Get the size of the memory block
			 * @return size of the memory block
			 */
			int GetSize() const;
			/**
			 * Get the image type
			 * @return image type
			 */
			Type GetType() const;
		private:
			/**
			 * Copy Constructor for File
			 * @warning copy constructor is disabled
			 * @param file	source file
			 * @throw ImageException	if fail to copy
			 */
			File(File& file);
			/**
			 * Copy an image file from another image file.
			 * @warning assignment operator is disabled
			 * @param file	source file
			 * @return *this
			 * @throw ImageException	if fail to copy
			 */
			File& operator=(File& file);
			/// memory block of the file
			void* data;
			/// size of the memory block
			int size;
			/// image type
			Type type;
		};
		/**
		 * Dafault Constructor for Image.
		 */
		Image();
		/**
		 * Copy Constructor for Image
		 * @param rhs	Source instance to copy
		 * @throw ImageException	if fail to copy
		 */
		Image(const Image& rhs);
		/**
		 * Delete all dynamic memory, if any
		 */
		~Image();
		/**
		 * Load image from file mapped in memory.
		 * @param file	file that contains a memory block of image
		 * @throw ImageException	if fail to load
		 */
		void Load(const File& file);
		/**
		 * Load image from specified URL.
		 * @param url	url address of the image
		 * @param type	type of the image
		 * @throw ImageException	if fail to load
		 */
		void Load(std::string url, Type type = UNKNOWN);
		/**
		 * Load image from file mapped in memory.
		 * @param data	memory block of the file
		 * @param type	type of the image
		 * @throw ImageException	if fail to load
		 */
		void Load(const std::vector<char>& data, Type type = UNKNOWN);
		/**
		 * Load image from file mapped in memory.
		 * @param data	starting memory address of the file
		 * @param size	size of the memory block
		 * @param type	type of the image
		 * @throw ImageException	if fail to load
		 */
		void Load(const void* data, int size, Type type = UNKNOWN);
		/**
		 * Export the image as a JPEG file
		 * @param quality	quality of jpeg in range of [0, 95]
		 * @return an auto pointer to JPEG file
		 * @throw ImageException	if fail to allocate memory
		 */
		std::auto_ptr<File> ExportJpeg(int quality = 80) const;
		/**
		 * Export the image as a PNG file
		 * @param compression	compression level in range of [0, 9]
		 *			-1 means default by zlib
		 * @return an auto pointer to PNG file
		 * @throw ImageException	if fail to allocate memory
		 */
		std::auto_ptr<File> ExportPng(int compression = -1) const;
		/**
		 * Fit into the specified size, retaining the ratio with black
		 * padding. If the image is smaller than the specified size,
		 * the original picture will not be resized.
		 * @param width		specified size
		 * @param height	specified height
		 * @return resized image
		 * @throw ImageException	if fail to allocate memory
		 */
		std::auto_ptr<Image> FitSize(int width, int height);
		/**
		 * Get the width of the image
		 * @return width of the image
		 */
		int GetWidth() const;
		/**
		 * Get the height of the image
		 * @return height of the image
		 */
		int GetHeight() const;
		/**
		 * Copy an image from another image.
		 * @param image	source image
		 * @return *this
		 * @throw ImageException	if fail to copy
		 */
		Image& operator=(const Image& image);
	private:
		/// A pointer to gdImage
		mutable gdImagePtr im;
	};
	
	/**
	 * General exception for Image
	 */
	class ImageException : public std::exception
	{
	public:
		/**
		 * Default Constructor for ImageException, recording the error
		 * message.
		 * @param message	Error message
		 */
		explicit ImageException(const std::string& message);
		/**
		 * Delete dynamic memories, if any
		 */
		virtual ~ImageException() throw();
		/**
		 * Return error message
		 * @return Error message
		 */
		virtual const char* what() const throw();
	private:
		/// Error message
		std::string msg;
	};
}}

#endif
