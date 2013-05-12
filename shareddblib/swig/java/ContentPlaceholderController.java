/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class ContentPlaceholderController {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public ContentPlaceholderController(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(ContentPlaceholderController obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_ContentPlaceholderController(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public ContentPlaceholderController() {
    this(libnfdbJNI.new_ContentPlaceholderController(), true);
  }

  public ContentPlaceholder GetContentPlaceholderById(int id) {
    long cPtr = libnfdbJNI.ContentPlaceholderController_GetContentPlaceholderById(swigCPtr, this, id);
    return (cPtr == 0) ? null : new ContentPlaceholder(cPtr, false);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__ContentPlaceholder_p_t GetContentPlaceholdersBySheetId(int sheetId) {
    return new SWIGTYPE_p_std__vectorT_nfdb__ContentPlaceholder_p_t(libnfdbJNI.ContentPlaceholderController_GetContentPlaceholdersBySheetId(swigCPtr, this, sheetId), true);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__ContentPlaceholder_p_t GetAllContentPlaceholders() {
    return new SWIGTYPE_p_std__vectorT_nfdb__ContentPlaceholder_p_t(libnfdbJNI.ContentPlaceholderController_GetAllContentPlaceholders(swigCPtr, this), true);
  }

  public int AddContentPlaceholder(ContentPlaceholder contentPlaceholder) {
    return libnfdbJNI.ContentPlaceholderController_AddContentPlaceholder(swigCPtr, this, ContentPlaceholder.getCPtr(contentPlaceholder), contentPlaceholder);
  }

  public void UpdateContentPlaceholder(ContentPlaceholder contentPlaceholder) {
    libnfdbJNI.ContentPlaceholderController_UpdateContentPlaceholder__SWIG_0(swigCPtr, this, ContentPlaceholder.getCPtr(contentPlaceholder), contentPlaceholder);
  }

  public void UpdateContentPlaceholder(int id, SWIGTYPE_p_int sheetId, SWIGTYPE_p_int wid, SWIGTYPE_p_bool column, SWIGTYPE_p_int order) {
    libnfdbJNI.ContentPlaceholderController_UpdateContentPlaceholder__SWIG_1(swigCPtr, this, id, SWIGTYPE_p_int.getCPtr(sheetId), SWIGTYPE_p_int.getCPtr(wid), SWIGTYPE_p_bool.getCPtr(column), SWIGTYPE_p_int.getCPtr(order));
  }

  public void RemoveContentPlaceholder(int id) {
    libnfdbJNI.ContentPlaceholderController_RemoveContentPlaceholder(swigCPtr, this, id);
  }

  public ContentPlaceholder GenerateContentPlaceholder(SWIGTYPE_p_sql__ResultSet rs) {
    long cPtr = libnfdbJNI.ContentPlaceholderController_GenerateContentPlaceholder(swigCPtr, this, SWIGTYPE_p_sql__ResultSet.getCPtr(rs));
    return (cPtr == 0) ? null : new ContentPlaceholder(cPtr, false);
  }

}
