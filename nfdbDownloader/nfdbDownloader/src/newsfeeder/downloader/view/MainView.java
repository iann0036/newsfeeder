package newsfeeder.downloader.view;


import javax.swing.*;
import javax.swing.border.*;
import javax.swing.text.StyleConstants.ColorConstants;

import newsfeeder.downloader.controller.CacheController;
import newsfeeder.downloader.model.*;
import newsfeeder.downloader.util.ScrollTopViewPort;
import newsfeeder.lib.model.SheetViewModel;

import java.awt.*;
import java.awt.event.*;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.Date;

public class MainView extends NewsFeederView
{
	private ScollablePanel sheetViewPanel;
	private int selectedSheetID;
	private SheetView sheetView;
	private SheetViewModel[] sheetOptions;
	private JComboBox<SheetViewModel> sheetSelector;
	private JScrollPane scroller;
	
	protected void SetupBodyPanel(JPanel bodyPanel)
	{
		bodyPanel.setLayout(new GridBagLayout());
		bodyPanel.setOpaque(false);
		
		JPanel sidePane = new JPanel();
		SetupSidePanel(sidePane);
		
		GridBagConstraints constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 1;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 0;
		constraints.weighty = 1;
		
		bodyPanel.add(sidePane, constraints);
		
		this.sheetViewPanel = new ScollablePanel();
		this.sheetViewPanel.setBorder(BorderFactory.createEmptyBorder(15,15,15,15));
		
		constraints = new GridBagConstraints();
		constraints.gridx = 2;
		constraints.gridy = 1;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		scroller = new JScrollPane(this.sheetViewPanel);
		//scroller.setViewport(new ScrollTopViewPort());
		//scroller.getViewport().setView(this.sheetViewPanel);
		scroller.setOpaque(false);
		scroller.getViewport().setOpaque(false);
		scroller.setHorizontalScrollBarPolicy(JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);
		scroller.setBorder(BorderFactory.createEmptyBorder());
		
		bodyPanel.add(scroller, constraints);
	}
	
	protected void SetupMenuPanel(JPanel menuPanel)
	{
		super.SetupMenuPanel(menuPanel);
		
		menuPanel.setLayout(new GridBagLayout());
		
		JPanel floatRight = new JPanel();
		floatRight.setOpaque(false);
		floatRight.setLayout(new BorderLayout());
		floatRight.setBorder(BorderFactory.createEmptyBorder(0,0,0,5));
		
		GridBagConstraints constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 1;
		constraints.fill = GridBagConstraints.HORIZONTAL;
		constraints.weightx = 1;
		constraints.weighty = 1;

		this.sheetSelector = new JComboBox<SheetViewModel>();
		this.sheetSelector.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent arg0)
			{
				if(sheetSelector.getSelectedItem() != null)
				{
					SetSheetView(((SheetViewModel)sheetSelector.getSelectedItem()).getSheetID(), true);
					revalidate();
				}
			}
		});
		
		floatRight.add(sheetSelector, BorderLayout.EAST);
		menuPanel.add(floatRight, constraints);
	}
	
	protected void SetupSidePanel(JPanel sidePanel)
	{
		//sidePanel.setMinimumSize(new Dimension(180,0));
		//sidePanel.setPreferredSize(new Dimension(180, 0));
		sidePanel.setOpaque(false);
	}
	
	public void SetSheetOptions(SheetViewModel[] options)
	{
		this.sheetOptions = options;
		
		this.sheetSelector.removeAllItems();
		
		for(SheetViewModel s : options)
		{
			this.sheetSelector.addItem(s);
		}
		
		SetSheetView(this.selectedSheetID, false);
	}
	
	public void SetLastUpdatedDate(Date dateLastUpdated)
	{
		this.dateLastUpdated = dateLastUpdated;
		this.dateLastUpdatedLabel.setText(this.dateLastUpdated.toString());
	}
	
	public void SetSheetView(int sheetID, boolean cacheRefresh)
	{
		if(cacheRefresh)
		{
			// Check the cache first
			CacheController cacheController = new CacheController();
			DownloaderCache cache = cacheController.GetSheetsCache();
			SetSheetOptions(cache.SheetCache.Sheets.toArray(new SheetViewModel[0]));
		}
		
		this.selectedSheetID = sheetID;
		
		if(this.sheetOptions == null)
		{
			return;
		}
		
		for(SheetViewModel s : this.sheetOptions)
		{
			if(s.getSheetID() == sheetID)
			{
				LoadSheetView(s);
				this.sheetSelector.setSelectedItem(s);
			}
		}
	}
	
	private void LoadSheetView(SheetViewModel sheetModel)
	{
		this.sheetViewPanel.setLayout(new BorderLayout());
		this.sheetViewPanel.setOpaque(false);
		this.sheetViewPanel.removeAll();
		this.sheetView = new SheetView(sheetModel);
		this.sheetViewPanel.add(sheetView, BorderLayout.CENTER);
		
		javax.swing.SwingUtilities.invokeLater(new Runnable() {
			   public void run() { 
			       scroller.getVerticalScrollBar().setValue(0);
			   }
			});
	}
}
