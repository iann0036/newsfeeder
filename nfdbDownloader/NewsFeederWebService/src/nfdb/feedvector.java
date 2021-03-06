/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */

package nfdb;

public class feedvector {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected feedvector(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(feedvector obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_feedvector(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public feedvector() {
    this(libnfdbJNI.new_feedvector__SWIG_0(), true);
  }

  public feedvector(long n) {
    this(libnfdbJNI.new_feedvector__SWIG_1(n), true);
  }

  public long size() {
    return libnfdbJNI.feedvector_size(swigCPtr, this);
  }

  public long capacity() {
    return libnfdbJNI.feedvector_capacity(swigCPtr, this);
  }

  public void reserve(long n) {
    libnfdbJNI.feedvector_reserve(swigCPtr, this, n);
  }

  public boolean isEmpty() {
    return libnfdbJNI.feedvector_isEmpty(swigCPtr, this);
  }

  public void clear() {
    libnfdbJNI.feedvector_clear(swigCPtr, this);
  }

  public void add(Feed x) {
    libnfdbJNI.feedvector_add(swigCPtr, this, Feed.getCPtr(x), x);
  }

  public Feed get(int i) {
    long cPtr = libnfdbJNI.feedvector_get(swigCPtr, this, i);
    return (cPtr == 0) ? null : new Feed(cPtr, false);
  }

  public void set(int i, Feed val) {
    libnfdbJNI.feedvector_set(swigCPtr, this, i, Feed.getCPtr(val), val);
  }

}
