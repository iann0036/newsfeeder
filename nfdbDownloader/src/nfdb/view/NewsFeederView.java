package nfdb.view;

import nfdb.util.*;
import java.awt.*;
import java.awt.event.*;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;

import javax.swing.*;
import javax.swing.border.Border;


public abstract class NewsFeederView extends JPanel
{
	public NewsFeederView()
	{
		super();
		SetupMainPanels();
	}
	
	private void SetupMainPanels()
	{
		this.setLayout(new GridBagLayout());
		
		BackgroundJPanel panelTop = new BackgroundJPanel("/images/topNav.jpg", true);
		panelTop.setBorder(BorderFactory.createMatteBorder(0, 0, 1, 0, new Color(0x4A4F51)));
		SetupMenuPanel(panelTop);
		
		GridBagConstraints constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 1;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		this.add(panelTop, constraints);
		
		BackgroundJPanel panelMiddle = new BackgroundJPanel("/images/bodyBg.jpg", true);
		SetupBodyPanel(panelMiddle);
		
		constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 2;
		constraints.fill =  GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		this.add(panelMiddle, constraints);
		
		BackgroundJPanel panelBottom = new BackgroundJPanel("/images/topNav.jpg", true);
		
		try 
		{
			SetupFooterPanel(panelBottom);
		} 
		catch (URISyntaxException e) { }
		
		constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = 3;
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		this.add(panelBottom, constraints);
	}
	
	protected void SetupMenuPanel(JPanel menuPanel)
	{
		menuPanel.setPreferredSize(new Dimension(0, 36));
	}
	
	protected void SetupBodyPanel(JPanel bodyPanel)
	{
	}

	protected void SetupFooterPanel(JPanel footerPanel) throws URISyntaxException
	{
		final URI newsFeederURI = new URI("http://newsfeeder.co");
		
		footerPanel.setLayout(new FlowLayout(FlowLayout.LEFT, 0, 0));
		footerPanel.setPreferredSize(new Dimension(0, 36));
		
		footerPanel.add(Box.createRigidArea(new Dimension(15, 36)));
		
		JLabel copyright = new JLabel("Copyright © 2012");
		copyright.setForeground(new Color(0x696969));
		copyright.setFont(new Font("Arial", Font.PLAIN, 11));
		footerPanel.add(copyright, BorderLayout.WEST);
		
		footerPanel.add(Box.createRigidArea(new Dimension(4, 36)));
		
		JButton newsFeederLink = new JButton("News Feeder Co.");
		newsFeederLink.setForeground(new Color(0xFFFFFF));
		newsFeederLink.setContentAreaFilled(false);
		newsFeederLink.setBorder(BorderFactory.createEmptyBorder());
		newsFeederLink.setFocusPainted(false);
		newsFeederLink.setFont(new Font("Arial", Font.PLAIN, 11));
		
		class OpenUrlAction implements ActionListener 
		{
		      public void actionPerformed(ActionEvent e) 
		      {
		    	  open(newsFeederURI);
		      }
	    }
		newsFeederLink.addActionListener(new OpenUrlAction());
		footerPanel.add(newsFeederLink);
		
		footerPanel.add(Box.createRigidArea(new Dimension(4, 36)));
		
		JLabel rightsReserved = new JLabel("all rights reserved.");
		rightsReserved.setForeground(new Color(0x696969));
		rightsReserved.setFont(new Font("Arial", Font.PLAIN, 11));
		footerPanel.add(rightsReserved);
		

	}
	
	private static void open(URI uri) 
	{
		if (Desktop.isDesktopSupported())
		{
			try
			{
				Desktop.getDesktop().browse(uri);
			} 
			catch (IOException e) { }
		} 
		else 
		{ 
		}
	}
}
