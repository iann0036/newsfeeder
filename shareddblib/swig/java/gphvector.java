/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class gphvector {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public gphvector(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(gphvector obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_gphvector(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public gphvector() {
    this(libnfdbJNI.new_gphvector__SWIG_0(), true);
  }

  public gphvector(long n) {
    this(libnfdbJNI.new_gphvector__SWIG_1(n), true);
  }

  public long size() {
    return libnfdbJNI.gphvector_size(swigCPtr, this);
  }

  public long capacity() {
    return libnfdbJNI.gphvector_capacity(swigCPtr, this);
  }

  public void reserve(long n) {
    libnfdbJNI.gphvector_reserve(swigCPtr, this, n);
  }

  public boolean isEmpty() {
    return libnfdbJNI.gphvector_isEmpty(swigCPtr, this);
  }

  public void clear() {
    libnfdbJNI.gphvector_clear(swigCPtr, this);
  }

  public void add(GroupPlaceholder x) {
    libnfdbJNI.gphvector_add(swigCPtr, this, GroupPlaceholder.getCPtr(x), x);
  }

  public GroupPlaceholder get(int i) {
    return new GroupPlaceholder(libnfdbJNI.gphvector_get(swigCPtr, this, i), false);
  }

  public void set(int i, GroupPlaceholder val) {
    libnfdbJNI.gphvector_set(swigCPtr, this, i, GroupPlaceholder.getCPtr(val), val);
  }

}
