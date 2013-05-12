public class Main 
{
	public static void main(String argv[]) 
	{
		System.loadLibrary("nfdb_java");
		IFeedController feedController = DBFactory.GetFeedController();

		Feed f = new Feed();
		feedController.UpdateFeed(f);
	}
}
