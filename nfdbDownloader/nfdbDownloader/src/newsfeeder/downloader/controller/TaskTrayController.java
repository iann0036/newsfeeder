package newsfeeder.downloader.controller;

import java.awt.AWTException;
import java.awt.CheckboxMenuItem;
import java.awt.Menu;
import java.awt.MenuItem;
import java.awt.PopupMenu;
import java.awt.SystemTray;
import java.awt.TrayIcon;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.ImageIcon;
import javax.swing.JFrame;

import newsfeeder.downloader.model.DownloaderCache;
import newsfeeder.lib.model.SheetViewModel;

public class TaskTrayController 
{
	private JFrame downloaderFrame;

	public TaskTrayController(JFrame downloaderFrame)
	{
		this.downloaderFrame = downloaderFrame;
	}
	
	public void Setup()
	{
        if (!SystemTray.isSupported())
        {
            return;
        }
        
        final PopupMenu popup = new PopupMenu();
        final TrayIcon trayIcon = new TrayIcon(new ImageIcon(getClass().getResource("/images/newsfeeder.gif")).getImage());
        trayIcon.setImageAutoSize(true);
        final SystemTray tray = SystemTray.getSystemTray();
        
        trayIcon.addActionListener(new ActionListener()
        {
			public void actionPerformed(ActionEvent arg0)
			{
				downloaderFrame.setVisible(true);
			}
        });

        MenuItem showItem = new MenuItem("Show");
        showItem.addActionListener(new ActionListener()
        {
        	public void actionPerformed(ActionEvent arg0)
			{
        		downloaderFrame.setVisible(true);
			}
        });
        
        MenuItem synchronizeItem = new MenuItem("Synchronize");
        synchronizeItem.addActionListener(new ActionListener()
        {
			public void actionPerformed(ActionEvent arg0)
			{
				CacheController cacheController = new CacheController();
				DownloaderCache cache = cacheController.Synchronize();
				
				MainController.getInstance().LoadMainView(cache);
			}
        });
        
        MenuItem exitItem = new MenuItem("Exit");
        exitItem.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent arg0)
			{
				System.exit(0);
			}
        });
       
        popup.add(showItem);
        popup.add(synchronizeItem);
        popup.addSeparator();
        popup.add(exitItem);
       
        trayIcon.setPopupMenu(popup);
       
        try 
        {
            tray.add(trayIcon);
        } 
        catch (AWTException e) 
        {
            //Couldn't add tray icon
        }
	}
}
