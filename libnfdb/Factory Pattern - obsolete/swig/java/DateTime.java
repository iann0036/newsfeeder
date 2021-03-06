/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class DateTime {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected DateTime(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(DateTime obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_DateTime(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public DateTime() {
    this(libnfdbJNI.new_DateTime__SWIG_0(), true);
  }

  public DateTime(DateTime rhs) {
    this(libnfdbJNI.new_DateTime__SWIG_1(DateTime.getCPtr(rhs), rhs), true);
  }

  public SWIGTYPE_p_std__string ExportToMySQL() {
    return new SWIGTYPE_p_std__string(libnfdbJNI.DateTime_ExportToMySQL(swigCPtr, this), true);
  }

  public void ImportFromMySQL(SWIGTYPE_p_std__string source) {
    libnfdbJNI.DateTime_ImportFromMySQL(swigCPtr, this, SWIGTYPE_p_std__string.getCPtr(source));
  }

  public void ParseFromString(String source) {
    libnfdbJNI.DateTime_ParseFromString(swigCPtr, this, source);
  }

  public int GetSecond() {
    return libnfdbJNI.DateTime_GetSecond(swigCPtr, this);
  }

  public int GetMinute() {
    return libnfdbJNI.DateTime_GetMinute(swigCPtr, this);
  }

  public int GetHour() {
    return libnfdbJNI.DateTime_GetHour(swigCPtr, this);
  }

  public int GetDay() {
    return libnfdbJNI.DateTime_GetDay(swigCPtr, this);
  }

  public int GetMonth() {
    return libnfdbJNI.DateTime_GetMonth(swigCPtr, this);
  }

  public int GetYear() {
    return libnfdbJNI.DateTime_GetYear(swigCPtr, this);
  }

  public void SetSecond(int sec) {
    libnfdbJNI.DateTime_SetSecond(swigCPtr, this, sec);
  }

  public void SetMinute(int min) {
    libnfdbJNI.DateTime_SetMinute(swigCPtr, this, min);
  }

  public void SetHour(int h) {
    libnfdbJNI.DateTime_SetHour(swigCPtr, this, h);
  }

  public void SetDay(int d) {
    libnfdbJNI.DateTime_SetDay(swigCPtr, this, d);
  }

  public void SetMonth(int m) {
    libnfdbJNI.DateTime_SetMonth(swigCPtr, this, m);
  }

  public void SetYear(int y) {
    libnfdbJNI.DateTime_SetYear(swigCPtr, this, y);
  }

  public void Set(int y, int n, int d, int h, int m, int s) {
    libnfdbJNI.DateTime_Set(swigCPtr, this, y, n, d, h, m, s);
  }

  public void SetTimeOffset(int h, int m, int s) {
    libnfdbJNI.DateTime_SetTimeOffset__SWIG_0(swigCPtr, this, h, m, s);
  }

  public void SetTimeOffset(int h, int m) {
    libnfdbJNI.DateTime_SetTimeOffset__SWIG_1(swigCPtr, this, h, m);
  }

  public void SetTimeOffset(int h) {
    libnfdbJNI.DateTime_SetTimeOffset__SWIG_2(swigCPtr, this, h);
  }

  public void SetDateOffset(int d, int m, int y) {
    libnfdbJNI.DateTime_SetDateOffset__SWIG_0(swigCPtr, this, d, m, y);
  }

  public void SetDateOffset(int d, int m) {
    libnfdbJNI.DateTime_SetDateOffset__SWIG_1(swigCPtr, this, d, m);
  }

  public void SetDateOffset(int d) {
    libnfdbJNI.DateTime_SetDateOffset__SWIG_2(swigCPtr, this, d);
  }

}
