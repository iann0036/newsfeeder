public class Main 
{
	public static void main(String argv[]) 
	{
		System.loadLibrary("nfdb_java");
		FeedController feedController = new FeedController();

		Feed f = new Feed();
		feedController.UpdateFeed(f);
	}
}
