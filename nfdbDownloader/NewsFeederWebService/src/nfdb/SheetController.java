/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */

package nfdb;

public class SheetController {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  protected SheetController(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  protected static long getCPtr(SheetController obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_SheetController(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public SheetController() {
    this(libnfdbJNI.new_SheetController(), true);
  }

  public Sheet GetSheetById(int id) {
    long cPtr = libnfdbJNI.SheetController_GetSheetById(swigCPtr, this, id);
    return (cPtr == 0) ? null : new Sheet(cPtr, false);
  }

  public sheetvector GetSheetsByUsername(String username) {
    return new sheetvector(libnfdbJNI.SheetController_GetSheetsByUsername(swigCPtr, this, username), true);
  }

  public sheetvector GetAllSheets() {
    return new sheetvector(libnfdbJNI.SheetController_GetAllSheets(swigCPtr, this), true);
  }

  public int AddSheet(Sheet sheet) {
    return libnfdbJNI.SheetController_AddSheet(swigCPtr, this, Sheet.getCPtr(sheet), sheet);
  }

  public void UpdateSheet(Sheet sheet) {
    libnfdbJNI.SheetController_UpdateSheet__SWIG_0(swigCPtr, this, Sheet.getCPtr(sheet), sheet);
  }

  public void UpdateSheet(int id, SWIGTYPE_p_std__string name, SWIGTYPE_p_std__string username, DateTime updated, SWIGTYPE_p_int layoutId) {
    libnfdbJNI.SheetController_UpdateSheet__SWIG_1(swigCPtr, this, id, SWIGTYPE_p_std__string.getCPtr(name), SWIGTYPE_p_std__string.getCPtr(username), DateTime.getCPtr(updated), updated, SWIGTYPE_p_int.getCPtr(layoutId));
  }

  public void RemoveSheet(int id) {
    libnfdbJNI.SheetController_RemoveSheet(swigCPtr, this, id);
  }

  public Sheet GenerateSheet(SWIGTYPE_p_sql__ResultSet rs) {
    long cPtr = libnfdbJNI.SheetController_GenerateSheet(swigCPtr, this, SWIGTYPE_p_sql__ResultSet.getCPtr(rs));
    return (cPtr == 0) ? null : new Sheet(cPtr, false);
  }

}
