/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class QueueItem {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public QueueItem(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(QueueItem obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_QueueItem(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public void setId(int value) {
    libnfdbJNI.QueueItem_id_set(swigCPtr, this, value);
  }

  public int getId() {
    return libnfdbJNI.QueueItem_id_get(swigCPtr, this);
  }

  public void setFrequency(int value) {
    libnfdbJNI.QueueItem_frequency_set(swigCPtr, this, value);
  }

  public int getFrequency() {
    return libnfdbJNI.QueueItem_frequency_get(swigCPtr, this);
  }

  public void setType(SWIGTYPE_p_int value) {
    libnfdbJNI.QueueItem_type_set(swigCPtr, this, SWIGTYPE_p_int.getCPtr(value));
  }

  public SWIGTYPE_p_int getType() {
    long cPtr = libnfdbJNI.QueueItem_type_get(swigCPtr, this);
    return (cPtr == 0) ? null : new SWIGTYPE_p_int(cPtr, false);
  }

  public void setNumUsers(int value) {
    libnfdbJNI.QueueItem_numUsers_set(swigCPtr, this, value);
  }

  public int getNumUsers() {
    return libnfdbJNI.QueueItem_numUsers_get(swigCPtr, this);
  }

  public QueueItem() {
    this(libnfdbJNI.new_QueueItem__SWIG_0(), true);
  }

  public QueueItem(int id, int frequency, SWIGTYPE_p_int type, int numUsers) {
    this(libnfdbJNI.new_QueueItem__SWIG_1(id, frequency, SWIGTYPE_p_int.getCPtr(type), numUsers), true);
  }

  public void Destroy() {
    libnfdbJNI.QueueItem_Destroy(swigCPtr, this);
  }

}
