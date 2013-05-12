package newsfeeder.downloader.controller;

import java.awt.Component;
import java.awt.Dimension;
import java.awt.event.ComponentEvent;
import java.awt.event.ComponentListener;
import java.util.Timer;

import newsfeeder.downloader.model.DownloaderCache;
import newsfeeder.downloader.model.SynchronizeTimerTask;
import newsfeeder.downloader.view.*;

import javax.swing.JEditorPane;
import javax.swing.JFrame;

import newsfeeder.lib.model.SheetViewModel;

public class MainController
{
	private Timer syncTimer;
	private MainView view;
	private JFrame frame;
	
	private static MainController latestInstance;
	
	private static int DELAY = 300000;
	
	public MainController(JFrame frame)
	{
		this.frame = frame;
		this.view = new MainView();
		
		this.syncTimer = new Timer();
		this.syncTimer.schedule(new SynchronizeTimerTask(this), 180000, DELAY);
		
		this.latestInstance = this;
	}
	
	/*
	 * Load the main view with the passed in downloader cache
	 */
	public void LoadMainView(DownloaderCache cache)
	{
		this.view.SetLastUpdatedDate(cache.LastUpdated);
		this.view.SetSheetOptions(cache.SheetCache.Sheets.toArray(new SheetViewModel[0]));
	}
	
	/*
	 * Load the main view by retrieving the cache and passing to the view
	 */
	public void LoadMainView()
	{
		CacheController cacheController = new CacheController();
		DownloaderCache cache = cacheController.GetSheetsCache();
		
		this.view.SetSheetView(cache.DefaultSheetID, false);
		LoadMainView(cache);
	}
	
	/*
	 * Display the main view, replaces the current view with the main view
	 */
	public void Display()
	{
		frame.getContentPane().removeAll();
		frame.add(this.view);
		frame.setVisible(true);
		frame.validate();
	}
	
	public static MainController getInstance()
	{
		return latestInstance;
	}
	
	public JFrame getParentFrame()
	{
		return this.frame;
	}
}
