package newsfeeder.downloader.model;

import java.util.Date;

import newsfeeder.lib.model.SheetViewModelCollection;

public class DownloaderCache 
{
	public SheetViewModelCollection SheetCache;
	public Date LastUpdated;
	public String Username;
	public int DefaultSheetID;
}
