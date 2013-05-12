package newsfeeder.downloader.model;

import java.util.TimerTask;

import newsfeeder.downloader.controller.CacheController;
import newsfeeder.downloader.controller.MainController;

public class SynchronizeTimerTask  extends TimerTask
{
	private MainController controller;

	public SynchronizeTimerTask(MainController controller) 
	{
		this.controller = controller;
	}

	public void run() 
	{
		CacheController cacheController = new CacheController();
		DownloaderCache cache = cacheController.Synchronize();
		
		// If not in focus, do a reload of the sheets
		// Otherwise the user can trigger it when they try and change sheets
		if(!this.controller.getParentFrame().isFocused())
		{
			this.controller.LoadMainView(cache);
		}
	}
}
