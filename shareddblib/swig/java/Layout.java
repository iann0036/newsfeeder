/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class Layout {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public Layout(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(Layout obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_Layout(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public void setId(int value) {
    libnfdbJNI.Layout_id_set(swigCPtr, this, value);
  }

  public int getId() {
    return libnfdbJNI.Layout_id_get(swigCPtr, this);
  }

  public Layout() {
    this(libnfdbJNI.new_Layout__SWIG_0(), true);
  }

  public Layout(int id) {
    this(libnfdbJNI.new_Layout__SWIG_1(id), true);
  }

  public void Destroy() {
    libnfdbJNI.Layout_Destroy(swigCPtr, this);
  }

}