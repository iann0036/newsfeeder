/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.4
 *
 * Do not make changes to this file unless you know what you are doing--modify
 * the SWIG interface file instead.
 * ----------------------------------------------------------------------------- */


public class FeedController {
  private long swigCPtr;
  protected boolean swigCMemOwn;

  public FeedController(long cPtr, boolean cMemoryOwn) {
    swigCMemOwn = cMemoryOwn;
    swigCPtr = cPtr;
  }

  public static long getCPtr(FeedController obj) {
    return (obj == null) ? 0 : obj.swigCPtr;
  }

  protected void finalize() {
    delete();
  }

  public synchronized void delete() {
    if (swigCPtr != 0) {
      if (swigCMemOwn) {
        swigCMemOwn = false;
        libnfdbJNI.delete_FeedController(swigCPtr);
      }
      swigCPtr = 0;
    }
  }

  public FeedController() {
    this(libnfdbJNI.new_FeedController(), true);
  }

  public Feed GetFeedById(int id) {
    long cPtr = libnfdbJNI.FeedController_GetFeedById(swigCPtr, this, id);
    return (cPtr == 0) ? null : new Feed(cPtr, false);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t GetFeedsByCphId(int cphId) {
    return new SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t(libnfdbJNI.FeedController_GetFeedsByCphId(swigCPtr, this, cphId), true);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t GetFeedsByUsername(String username) {
    return new SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t(libnfdbJNI.FeedController_GetFeedsByUsername(swigCPtr, this, username), true);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t GetAllFeeds() {
    return new SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t(libnfdbJNI.FeedController_GetAllFeeds(swigCPtr, this), true);
  }

  public SWIGTYPE_p_std__vectorT_QueueItem_p_t GetQueueFeeds() {
    return new SWIGTYPE_p_std__vectorT_QueueItem_p_t(libnfdbJNI.FeedController_GetQueueFeeds(swigCPtr, this), true);
  }

  public SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t GetNewFeeds(int id) {
    return new SWIGTYPE_p_std__vectorT_nfdb__Feed_p_t(libnfdbJNI.FeedController_GetNewFeeds(swigCPtr, this, id), true);
  }

  public int AddFeed(Feed feed) {
    return libnfdbJNI.FeedController_AddFeed(swigCPtr, this, Feed.getCPtr(feed), feed);
  }

  public void UpdateFeed(Feed feed) {
    libnfdbJNI.FeedController_UpdateFeed__SWIG_0(swigCPtr, this, Feed.getCPtr(feed), feed);
  }

  public void UpdateFeed(int id, SWIGTYPE_p_std__string url, SWIGTYPE_p_std__string name, SWIGTYPE_p_int frequency, DateTime lastUpdate, SWIGTYPE_p_std__string category, SWIGTYPE_p_int type, String favIcon, SWIGTYPE_p_int iconSize) {
    libnfdbJNI.FeedController_UpdateFeed__SWIG_1(swigCPtr, this, id, SWIGTYPE_p_std__string.getCPtr(url), SWIGTYPE_p_std__string.getCPtr(name), SWIGTYPE_p_int.getCPtr(frequency), DateTime.getCPtr(lastUpdate), lastUpdate, SWIGTYPE_p_std__string.getCPtr(category), SWIGTYPE_p_int.getCPtr(type), favIcon, SWIGTYPE_p_int.getCPtr(iconSize));
  }

  public void RemoveFeed(int id) {
    libnfdbJNI.FeedController_RemoveFeed(swigCPtr, this, id);
  }

  public Feed GenerateFeed(SWIGTYPE_p_sql__ResultSet rs) {
    long cPtr = libnfdbJNI.FeedController_GenerateFeed(swigCPtr, this, SWIGTYPE_p_sql__ResultSet.getCPtr(rs));
    return (cPtr == 0) ? null : new Feed(cPtr, false);
  }

  public SWIGTYPE_p_QueueItem GenerateQueueItem(SWIGTYPE_p_sql__ResultSet rs) {
    long cPtr = libnfdbJNI.FeedController_GenerateQueueItem(swigCPtr, this, SWIGTYPE_p_sql__ResultSet.getCPtr(rs));
    return (cPtr == 0) ? null : new SWIGTYPE_p_QueueItem(cPtr, false);
  }

  public int GetNumberOfFeedUsers(int id) {
    return libnfdbJNI.FeedController_GetNumberOfFeedUsers(swigCPtr, this, id);
  }

  public void UpdateLastUpdateTime(int feedid) {
    libnfdbJNI.FeedController_UpdateLastUpdateTime(swigCPtr, this, feedid);
  }

}
