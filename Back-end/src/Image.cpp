/**
 * @file	Image.cpp
 * @author	Shiwei Zhang <sz653@uow.edu.au>
 * @date	24/08/12
 *
 * @section	DESCRIPTION
 *
 * Implementation of Image class
 */

#include <cstring>
#include "nfrd/Image.h"
#include "nfrd/Utility.h"
using namespace nfrd::misc;
using namespace std;

// Construct image file by owning a block of memory
Image::File::File(void* data, int size, Type type) :
	data(data), size(size), type(type)
{
}

// Delete all dynamic memory, if any
Image::File::~File()
{
	if (data != 0)
		gdFree(data);
}

// Get the memory block of the file
const void* Image::File::GetData() const
{
	return data;
}

// Get the size of the memory block
int Image::File::GetSize() const
{
	return size;
}

// Get the image type
Image::Type Image::File::GetType() const
{
	return type;
}

// Dafault Constructor for Image.
Image::Image() : im(0)
{
}

// Copy Constructor for Image
Image::Image(const Image& rhs)
{
	operator=(rhs);
}

// Delete all dynamic memory, if any
Image::~Image()
{
	if (im != 0)
		gdImageDestroy(im);
}

// Load image from file mapped in memory.
void Image::Load(const File& file)
{
	Load(file.GetData(), file.GetSize(), file.GetType());
}

// Load image from specified URL.
void Image::Load(std::string url, Type type)
{
	vector<char> container;
	if (!Utility::Read(url, container))
		throw ImageException(string("Image: Cannot connect \"")
				     .append(url).append("\""));
	Load(container, type);
}

// Load image from file mapped in memory.
void Image::Load(const std::vector<char>& data, Type type)
{
	Load(&data[0], (int)data.size(), type);
}

// Load image from file mapped in memory.
void Image::Load(const void* data, int size, Type type)
{
	if (data == 0)
		throw ImageException("Image: load the image from null");

	gdImagePtr im = 0;
	
	switch (type) {
		case GD:
			im = gdImageCreateFromGdPtr(size, (void*)data);
			break;
		case GD2:
			im = gdImageCreateFromGd2Ptr(size, (void*)data);
			break;
		case GIF:
			im = gdImageCreateFromGifPtr(size, (void*)data);
			break;
		case JPEG:
			im = gdImageCreateFromJpegPtr(size, (void*)data);
			break;
		case PNG:
			im = gdImageCreateFromPngPtr(size, (void*)data);
			break;
		case WBMP:
			im = gdImageCreateFromWBMPPtr(size, (void*)data);
			break;
		case UNKNOWN:
		default:	// Auto detecting type
			if (size >= 6 && (memcmp(data, "GIF89a", 6) == 0 ||
					  memcmp(data, "GIF87a", 6) == 0))
				im = gdImageCreateFromGifPtr(size, (void*)data);
			else if (size >= 8 && memcmp(data, "\211PNG\r\n\032\n",
						     8) == 0)
				im = gdImageCreateFromPngPtr(size, (void*)data);
			else if (size >= 4 && ((memcmp(data, "\xff\xd8",
						       2) == 0 &&
						memcmp((char*)data + size - 2,
						       "\xff\xd9", 2) == 0) ||
					       memcmp(data, "JFIF", 4) == 0 ||
					       memcmp(data, "Exif", 4) == 0))
				im = gdImageCreateFromJpegPtr(size,
							      (void*)data);
			break;
	}
	if (im == 0)
		throw ImageException("Image: Unable to load the image");
	else if (this->im != 0)
		gdImageDestroy(this->im);
	this->im = im;
}

// Export the image as a JPEG file
std::auto_ptr<Image::File> Image::ExportJpeg(int quality) const
{
	if (im == 0)
		throw ImageException("Image: image not loaded");
	
	int size;
	void* data = gdImageJpegPtr(im, &size, quality);
	if (data == 0)
		throw ImageException("Image: fail to export jpeg image");
	File* file;
	try
	{
		file = new File(data, size, JPEG);
	}
	catch (const exception& e)
	{
		gdFree(data);
		throw ImageException("Image: fail to export jpeg image: " +
				     string(e.what()));
	}
	return auto_ptr<File>(file);
}

// Export the image as a PNG file
std::auto_ptr<Image::File> Image::ExportPng(int compression) const
{
	if (im == 0)
		throw ImageException("Image: image not loaded");

	int size;
	void* data = gdImagePngPtrEx(im, &size, compression);
	if (data == 0)
		throw ImageException("Image: fail to export png image");
	File* file;
	try
	{
		file = new File(data, size, PNG);
	}
	catch (const exception& e)
	{
		gdFree(data);
		throw ImageException(string("Image: fail to export png image: ")
				     .append(e.what()));
	}
	return auto_ptr<File>(file);
}

// Fit into the specified size, retaining the ratio with black
// padding. If the image is smaller than the specified size,
// the original picture will not be resized.
std::auto_ptr<Image> Image::FitSize(int width, int height)
{
	if (im == 0)
		throw ImageException("Image: image not loaded");
	
	// Allocate memory
	gdImagePtr target;
	if ((target = gdImageCreateTrueColor(width, height)) == 0)
		throw ImageException("Image: fail to allocate memory");
	Image* target_image;
	try
	{
		target_image = new Image();
		target_image->im = target;
	}
	catch (const exception& e)
	{
		gdImageDestroy(target);
		throw ImageException(string("Image: fail to allocate memory: ")
				     .append(e.what()));
	}
	
	// Fit size
	int x, y;
	double ratio = (double)im->sx / im->sy;
	if (ratio > 1)
	{
		x = ((im->sx > width) ? width: im->sx);
		y = x / ratio;
	}
	else
	{
		y = ((im->sy > height) ? height : im->sy);
		x = y * ratio;
	}
	gdImageCopyResampled(target, im, (width - x) / 2, (height - y) / 2,
			     0, 0, x, y, im->sx, im->sy);
	
	return auto_ptr<Image>(target_image);
}

// Get the width of the image
int Image::GetWidth() const
{
	if (im == 0)
		return 0;
	else
		return im->sx;
}

// Get the height of the image
int Image::GetHeight() const
{
	if (im == 0)
		return 0;
	else
		return im->sy;
}

// Copy an image from another image.
Image& Image::operator=(const Image& image)
{
	// Avoid self copying
	if (this == &image)
		return *this;

	// Start copying
	if (image.im == 0)
	{
		if (im != 0)
			gdImageDestroy(im);
		im = 0;
		return *this;
	}

	// Allocate memory
	gdImagePtr target;
	if ((target = gdImageCreateTrueColor(image.im->sx, image.im->sy)) == 0)
		throw ImageException("Image: fail to allocate memory");
	if (im != 0)
		gdImageDestroy(im);
	im = target;
	
	// Deep copy
	gdImageCopy(im, image.im, 0, 0, 0, 0, im->sx, im->sy);
	
	return *this;
}

// Default Constructor for ImageException, recording the error message.
ImageException::ImageException(const std::string& message) : msg(message)
{
}

// Delete dynamic memories, if any
ImageException::~ImageException() throw()
{
}

// Return error message
const char* ImageException::what() const throw()
{
	return msg.c_str();
}
