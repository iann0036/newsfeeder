/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class User {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public User(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(User obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_User(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public void setUsername(String value) {
    libnfdbJNI.User_username_set(swigCPtr, this, value);
  }

  public String getUsername() {
    return libnfdbJNI.User_username_get(swigCPtr, this);
  }

  public void setPassword(String value) {
    libnfdbJNI.User_password_set(swigCPtr, this, value);
  }

  public String getPassword() {
    return libnfdbJNI.User_password_get(swigCPtr, this);
  }

  public void setPicture(String value) {
    libnfdbJNI.User_picture_set(swigCPtr, this, value);
  }

  public String getPicture() {
    return libnfdbJNI.User_picture_get(swigCPtr, this);
  }

  public void setPictureSize(int value) {
    libnfdbJNI.User_pictureSize_set(swigCPtr, this, value);
  }

  public int getPictureSize() {
    return libnfdbJNI.User_pictureSize_get(swigCPtr, this);
  }

  public void setRegistered(DateTime value) {
    libnfdbJNI.User_registered_set(swigCPtr, this, DateTime.getCPtr(value), value);
  }

  public DateTime getRegistered() {
    long cPtr = libnfdbJNI.User_registered_get(swigCPtr, this);
    return (cPtr == 0) ? null : new DateTime(cPtr, false);
  }

  public void setRealname(String value) {
    libnfdbJNI.User_realname_set(swigCPtr, this, value);
  }

  public String getRealname() {
    return libnfdbJNI.User_realname_get(swigCPtr, this);
  }

  public void setEmail(String value) {
    libnfdbJNI.User_email_set(swigCPtr, this, value);
  }

  public String getEmail() {
    return libnfdbJNI.User_email_get(swigCPtr, this);
  }

  public void setLayout(int value) {
    libnfdbJNI.User_layout_set(swigCPtr, this, value);
  }

  public int getLayout() {
    return libnfdbJNI.User_layout_get(swigCPtr, this);
  }

  public void setAdmin(boolean value) {
    libnfdbJNI.User_admin_set(swigCPtr, this, value);
  }

  public boolean getAdmin() {
    return libnfdbJNI.User_admin_get(swigCPtr, this);
  }

  public void setHttps(boolean value) {
    libnfdbJNI.User_https_set(swigCPtr, this, value);
  }

  public boolean getHttps() {
    return libnfdbJNI.User_https_get(swigCPtr, this);
  }

  public User() {
    this(libnfdbJNI.new_User__SWIG_0(), true);
  }

  public User(String username, String password, String picture, int pictureSize, DateTime registered, String realname, String email, int layout, boolean admin, boolean https) {
    this(libnfdbJNI.new_User__SWIG_1(username, password, picture, pictureSize, DateTime.getCPtr(registered), registered, realname, email, layout, admin, https), true);
  }

  public void Destroy() {
    libnfdbJNI.User_Destroy(swigCPtr, this);
  }

}