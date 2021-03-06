/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */

package nfdb;

public class uservector {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected uservector(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(uservector obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_uservector(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public uservector() {
    this(libnfdbJNI.new_uservector__SWIG_0(), true);
  }

  public uservector(long n) {
    this(libnfdbJNI.new_uservector__SWIG_1(n), true);
  }

  public long size() {
    return libnfdbJNI.uservector_size(swigCPtr, this);
  }

  public long capacity() {
    return libnfdbJNI.uservector_capacity(swigCPtr, this);
  }

  public void reserve(long n) {
    libnfdbJNI.uservector_reserve(swigCPtr, this, n);
  }

  public boolean isEmpty() {
    return libnfdbJNI.uservector_isEmpty(swigCPtr, this);
  }

  public void clear() {
    libnfdbJNI.uservector_clear(swigCPtr, this);
  }

  public void add(User x) {
    libnfdbJNI.uservector_add(swigCPtr, this, User.getCPtr(x), x);
  }

  public User get(int i) {
    long cPtr = libnfdbJNI.uservector_get(swigCPtr, this, i);
    return (cPtr == 0) ? null : new User(cPtr, false);
  }

  public void set(int i, User val) {
    libnfdbJNI.uservector_set(swigCPtr, this, i, User.getCPtr(val), val);
  }

}
