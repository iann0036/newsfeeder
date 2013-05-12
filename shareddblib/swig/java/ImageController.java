/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class ImageController {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public ImageController(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(ImageController obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_ImageController(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public ImageController() {
    this(libnfdbJNI.new_ImageController(), true);
  }

  public Image GetImageById(int id) {
    long cPtr = libnfdbJNI.ImageController_GetImageById(swigCPtr, this, id);
    return (cPtr == 0) ? null : new Image(cPtr, false);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__Image_p_t GetImagesByItemId(int itemId) {
    return new SWIGTYPE_p_std__vectorT_nfdb__Image_p_t(libnfdbJNI.ImageController_GetImagesByItemId(swigCPtr, this, itemId), true);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__Image_p_t GetAllImages() {
    return new SWIGTYPE_p_std__vectorT_nfdb__Image_p_t(libnfdbJNI.ImageController_GetAllImages(swigCPtr, this), true);
  }

  public int AddImage(Image image) {
    return libnfdbJNI.ImageController_AddImage(swigCPtr, this, Image.getCPtr(image), image);
  }

  public void UpdateImage(Image image) {
    libnfdbJNI.ImageController_UpdateImage__SWIG_0(swigCPtr, this, Image.getCPtr(image), image);
  }

  public void UpdateImage(int id, SWIGTYPE_p_int itemId, String image, SWIGTYPE_p_int imageSize, SWIGTYPE_p_std__string url) {
    libnfdbJNI.ImageController_UpdateImage__SWIG_1(swigCPtr, this, id, SWIGTYPE_p_int.getCPtr(itemId), image, SWIGTYPE_p_int.getCPtr(imageSize), SWIGTYPE_p_std__string.getCPtr(url));
  }

  public void RemoveImage(int id) {
    libnfdbJNI.ImageController_RemoveImage(swigCPtr, this, id);
  }

  public Image GenerateImage(SWIGTYPE_p_sql__ResultSet rs) {
    long cPtr = libnfdbJNI.ImageController_GenerateImage(swigCPtr, this, SWIGTYPE_p_sql__ResultSet.getCPtr(rs));
    return (cPtr == 0) ? null : new Image(cPtr, false);
  }

}