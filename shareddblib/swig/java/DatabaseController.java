/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class DatabaseController {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public DatabaseController(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(DatabaseController obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_DatabaseController(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public DatabaseController() {
    this(libnfdbJNI.new_DatabaseController(), true);
  }

  public SWIGTYPE_p_sql__Connection Connect() {
    long cPtr = libnfdbJNI.DatabaseController_Connect(swigCPtr, this);
    return (cPtr == 0) ? null : new SWIGTYPE_p_sql__Connection(cPtr, false);
  }

  public void Disconnect() {
    libnfdbJNI.DatabaseController_Disconnect(swigCPtr, this);
  }

}
