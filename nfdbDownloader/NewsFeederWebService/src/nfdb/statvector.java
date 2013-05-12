/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */

package nfdb;

public class statvector {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected statvector(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(statvector obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_statvector(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public statvector() {
    this(libnfdbJNI.new_statvector__SWIG_0(), true);
  }

  public statvector(long n) {
    this(libnfdbJNI.new_statvector__SWIG_1(n), true);
  }

  public long size() {
    return libnfdbJNI.statvector_size(swigCPtr, this);
  }

  public long capacity() {
    return libnfdbJNI.statvector_capacity(swigCPtr, this);
  }

  public void reserve(long n) {
    libnfdbJNI.statvector_reserve(swigCPtr, this, n);
  }

  public boolean isEmpty() {
    return libnfdbJNI.statvector_isEmpty(swigCPtr, this);
  }

  public void clear() {
    libnfdbJNI.statvector_clear(swigCPtr, this);
  }

  public void add(Stat x) {
    libnfdbJNI.statvector_add(swigCPtr, this, Stat.getCPtr(x), x);
  }

  public Stat get(int i) {
    long cPtr = libnfdbJNI.statvector_get(swigCPtr, this, i);
    return (cPtr == 0) ? null : new Stat(cPtr, false);
  }

  public void set(int i, Stat val) {
    libnfdbJNI.statvector_set(swigCPtr, this, i, Stat.getCPtr(val), val);
  }

}
