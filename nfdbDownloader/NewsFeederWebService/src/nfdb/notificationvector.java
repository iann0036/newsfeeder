/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */

package nfdb;

public class notificationvector {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected notificationvector(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(notificationvector obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_notificationvector(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public notificationvector() {
    this(libnfdbJNI.new_notificationvector__SWIG_0(), true);
  }

  public notificationvector(long n) {
    this(libnfdbJNI.new_notificationvector__SWIG_1(n), true);
  }

  public long size() {
    return libnfdbJNI.notificationvector_size(swigCPtr, this);
  }

  public long capacity() {
    return libnfdbJNI.notificationvector_capacity(swigCPtr, this);
  }

  public void reserve(long n) {
    libnfdbJNI.notificationvector_reserve(swigCPtr, this, n);
  }

  public boolean isEmpty() {
    return libnfdbJNI.notificationvector_isEmpty(swigCPtr, this);
  }

  public void clear() {
    libnfdbJNI.notificationvector_clear(swigCPtr, this);
  }

  public void add(Notification x) {
    libnfdbJNI.notificationvector_add(swigCPtr, this, Notification.getCPtr(x), x);
  }

  public Notification get(int i) {
    long cPtr = libnfdbJNI.notificationvector_get(swigCPtr, this, i);
    return (cPtr == 0) ? null : new Notification(cPtr, false);
  }

  public void set(int i, Notification val) {
    libnfdbJNI.notificationvector_set(swigCPtr, this, i, Notification.getCPtr(val), val);
  }

}
