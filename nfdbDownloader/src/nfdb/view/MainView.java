package nfdb.view;

import nfdb.model.*;

import javax.swing.*;
import javax.swing.border.*;
import javax.swing.text.StyleConstants.ColorConstants;

import java.awt.*;
import java.awt.event.*;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;

public class MainView extends NewsFeederView
{
	private ScollablePanel sheetViewPanel;
	private SheetView sheetView;
	
	public void SetupBodyPanel(JPanel bodyPanel)
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
		
		JScrollPane scroller = new JScrollPane(this.sheetViewPanel);
		scroller.setOpaque(false);
		scroller.getViewport().setOpaque(false);
		scroller.setHorizontalScrollBarPolicy(JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);
		scroller.setBorder(BorderFactory.createEmptyBorder());
		
		bodyPanel.add(scroller, constraints);
	}
	
	public void SetupSidePanel(JPanel sidePanel)
	{
		sidePanel.setMinimumSize(new Dimension(180,0));
		sidePanel.setPreferredSize(new Dimension(180, 0));
		sidePanel.setOpaque(false);
	}
	
	public void LoadSheetView(SheetViewModel sheetModel)
	{
		this.sheetViewPanel.setLayout(new BorderLayout());
		this.sheetViewPanel.setOpaque(false);
		this.sheetView = new SheetView(sheetModel);
		this.sheetViewPanel.add(sheetView, BorderLayout.CENTER);
	}
}
