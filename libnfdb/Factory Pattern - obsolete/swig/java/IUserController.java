/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class IUserController {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected IUserController(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(IUserController obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_IUserController(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public User GetUserById(int id) {
    return new User(libnfdbJNI.IUserController_GetUserById(swigCPtr, this, id), true);
  }

  public User GetUserByUsername(SWIGTYPE_p_string username) {
    return new User(libnfdbJNI.IUserController_GetUserByUsername(swigCPtr, this, SWIGTYPE_p_string.getCPtr(username)), true);
  }

  public void UpdateUser(User user) {
    libnfdbJNI.IUserController_UpdateUser(swigCPtr, this, User.getCPtr(user), user);
  }

  public void AddUser(User user) {
    libnfdbJNI.IUserController_AddUser(swigCPtr, this, User.getCPtr(user), user);
  }

}
