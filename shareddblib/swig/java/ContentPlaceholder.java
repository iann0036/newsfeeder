/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class ContentPlaceholder {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public ContentPlaceholder(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(ContentPlaceholder obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_ContentPlaceholder(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public void setId(int value) {
    libnfdbJNI.ContentPlaceholder_id_set(swigCPtr, this, value);
  }

  public int getId() {
    return libnfdbJNI.ContentPlaceholder_id_get(swigCPtr, this);
  }

  public void setSheetId(int value) {
    libnfdbJNI.ContentPlaceholder_sheetId_set(swigCPtr, this, value);
  }

  public int getSheetId() {
    return libnfdbJNI.ContentPlaceholder_sheetId_get(swigCPtr, this);
  }

  public void setType(int value) {
    libnfdbJNI.ContentPlaceholder_type_set(swigCPtr, this, value);
  }

  public int getType() {
    return libnfdbJNI.ContentPlaceholder_type_get(swigCPtr, this);
  }

  public void setColumn(int value) {
    libnfdbJNI.ContentPlaceholder_column_set(swigCPtr, this, value);
  }

  public int getColumn() {
    return libnfdbJNI.ContentPlaceholder_column_get(swigCPtr, this);
  }

  public void setOrder(int value) {
    libnfdbJNI.ContentPlaceholder_order_set(swigCPtr, this, value);
  }

  public int getOrder() {
    return libnfdbJNI.ContentPlaceholder_order_get(swigCPtr, this);
  }

  public ContentPlaceholder() {
    this(libnfdbJNI.new_ContentPlaceholder__SWIG_0(), true);
  }

  public ContentPlaceholder(int id, int sheetId, int type, int column, int order) {
    this(libnfdbJNI.new_ContentPlaceholder__SWIG_1(id, sheetId, type, column, order), true);
  }

  public void Destroy() {
    libnfdbJNI.ContentPlaceholder_Destroy(swigCPtr, this);
  }

}
