package newsfeeder.downloader.view;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Rectangle;
import java.awt.event.ComponentEvent;
import java.awt.event.ComponentListener;
import java.io.IOException;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.Dictionary;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.swing.BorderFactory;
import javax.swing.Box;
import javax.swing.ImageIcon;
import javax.swing.JEditorPane;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.Scrollable;
import javax.swing.event.HyperlinkEvent;
import javax.swing.event.HyperlinkListener;
import javax.swing.text.html.HTMLEditorKit;
import javax.swing.text.html.StyleSheet;

import newsfeeder.downloader.model.*;
import newsfeeder.downloader.util.BackgroundJPanel;
import newsfeeder.lib.model.ContentPlaceholder;
import newsfeeder.lib.model.GroupContentPlaceholder;
import newsfeeder.lib.model.NewsContentPlaceholder;
import newsfeeder.lib.model.NewsItem;
import newsfeeder.lib.model.SheetLayout;
import newsfeeder.lib.model.SheetViewModel;



public class SheetView extends JPanel
{
	SheetViewModel model;
	JPanel layoutPanel;
	Map<Integer, JPanel> groupContentPlaceholderPanels;
	Boolean[][] populatedCells;
	List<JEditorPane> textEditors;
	
	public SheetView(SheetViewModel model)
	{
		this.model = model;
		this.setOpaque(false);
		this.setLayout(new GridBagLayout());
		
		groupContentPlaceholderPanels = new HashMap<Integer, JPanel>();
		this.textEditors = new ArrayList<JEditorPane>();
		
		BindSheetView();
	}
	
	private void BindSheetView()
	{
		BindLayout();
		BindContentPlaceholders();
	}
	
	private void BindLayout()
	{
		SheetLayout layout = this.model.getLayout();
		List<GroupContentPlaceholder> groupContentPlaceholders = layout.getGroupContentPlaceholders();
		
		populatedCells = new Boolean[layout.getColCount()][layout.getRowCount()];
		
		for(int i = 0; i < groupContentPlaceholders.size(); i++)
		{
			GroupContentPlaceholder g = groupContentPlaceholders.get(i);
			
			GridBagConstraints constraints = new GridBagConstraints();
			constraints.gridx = (int)g.getStart().getX();
			constraints.gridy = (int)g.getStart().getY();
			constraints.fill = GridBagConstraints.BOTH;
			constraints.weightx = 1;
			constraints.weighty = 0;
			constraints.gridheight = (int)(g.getEnd().getY() - g.getStart().getY() + 1);
			constraints.gridwidth = (int)(g.getEnd().getX() - g.getStart().getX() + 1);
			
			//Calculate what cells have been populated and mark them as populated
			for(int x = (int)g.getStart().getX(); x <= (int)g.getEnd().getX(); x++)
			{
				for(int y = (int)g.getStart().getY(); y <= (int)g.getEnd().getY(); y++)
				{
					this.populatedCells[x][y] = true;
				}
			}
			
			JPanel gPanel = new JPanel();
			gPanel.setLayout(new GridBagLayout());
			gPanel.setOpaque(false);
			gPanel.setBorder(BorderFactory.createEmptyBorder(15,15,15,15));
			this.add(gPanel, constraints);
			this.groupContentPlaceholderPanels.put(g.getID(), gPanel);
		}
	}
	
	private void BindContentPlaceholders()
	{
		List<ContentPlaceholder> contentPlaceholders = this.model.getContentPlaceholders();
		
		for(int i = 0; i < contentPlaceholders.size(); i++)
		{
			ContentPlaceholder c = contentPlaceholders.get(i);
			if(c.getClass().equals(NewsContentPlaceholder.class))
			{
				BindNewsContentPlaceholder((NewsContentPlaceholder)c);
			}
		}
	}
	
	private void BindNewsContentPlaceholder(NewsContentPlaceholder contentPlaceholder)
	{
		JPanel contentPlaceholderPanel = new JPanel();
		contentPlaceholderPanel.setLayout(new GridBagLayout());
		contentPlaceholderPanel.setOpaque(false);
		
		List<NewsItem> newsItems = contentPlaceholder.getItems();
		int gridYCounter = 1;
		
		for(int i = 0; i < newsItems.size(); i++)
		{
			BackgroundJPanel contentBox = new BackgroundJPanel("/images/widgetBg.png", true);
			contentBox.setLayout(new GridBagLayout());
			
			GridBagConstraints constraints = new GridBagConstraints();
			constraints.gridx = 1;
			constraints.gridy = 1;
			constraints.fill = GridBagConstraints.BOTH;
			constraints.weightx = 1;
			constraints.weighty = 1;
			JEditorPane editorPane = new JEditorPane();
			StyleSheet sheet=new HTMLEditorKit().getStyleSheet();
		    sheet.addRule("p {color: #D5D5D5; margin-top: 0px; padding-top: 0px;}");
		    sheet.addRule("pre {color: #D5D5D5;}");
		    sheet.addRule("li {color: #D5D5D5;}");
		    sheet.addRule("a {color: white; text-decoration: none; font-weight: bold;}");
			this.textEditors.add(editorPane);
			editorPane.setOpaque(false);
			editorPane.setEditable(false);
			editorPane.setContentType("text/html");
			editorPane.setText("<p>" + newsItems.get(i).getBody() + "</p>");
			editorPane.setForeground(new Color(0xFAFAFA));
			editorPane.setFont(new Font("Cuprum", Font.PLAIN, 15));
			editorPane.addHyperlinkListener(new EditorHyperlinkListener());
			contentBox.add(editorPane, constraints);
			
			ContentBoxView view = new ContentBoxView(newsItems.get(i).getTitle(), new ImageIcon(getClass().getResource("/images/listIcon.png")), contentBox);
			
			if(gridYCounter != 1)
			{
				constraints = new GridBagConstraints();
				constraints.gridx = 1;
				constraints.gridy = gridYCounter;
				constraints.fill = GridBagConstraints.BOTH;
				constraints.weightx = 1;
				constraints.weighty = 1;
				
				contentPlaceholderPanel.add(Box.createRigidArea(new Dimension(0,30)), constraints);
				
				gridYCounter++;
			}
			
			constraints = new GridBagConstraints();
			constraints.gridx = 1;
			constraints.gridy = gridYCounter;
			constraints.fill = GridBagConstraints.BOTH;
			constraints.weightx = 1;
			constraints.weighty = 0;
			
			contentPlaceholderPanel.add(view, constraints);
		
			gridYCounter++;
		}
		
		JPanel groupContentPlaceholder = groupContentPlaceholderPanels.get(contentPlaceholder.getGroupContentPlaceholderID());
		
		GridBagConstraints constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = contentPlaceholder.getPlaceholderDisplayIndex();
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 1;
		
		groupContentPlaceholder.add(contentPlaceholderPanel, constraints);
		
	}

	public Dimension getPreferredScrollableViewportSize() 
	{
		return new Dimension(10,10);
	}

	public int getScrollableBlockIncrement(Rectangle arg0, int arg1, int arg2)
	{
		return 0;
	}

	public boolean getScrollableTracksViewportHeight() 
	{
		return false;
	}

	public boolean getScrollableTracksViewportWidth() 
	{
		return true;
	}

	public int getScrollableUnitIncrement(Rectangle arg0, int arg1, int arg2)
	{
		return 0;
	}
	
	class EditorHyperlinkListener implements HyperlinkListener {
	    public void hyperlinkUpdate(HyperlinkEvent evt) {
	        if (evt.getEventType() == HyperlinkEvent.EventType.ACTIVATED) {
	            JEditorPane pane = (JEditorPane)evt.getSource();
	            try {
	                // Show the new page in the editor pane.
	            	NewsFeederView.open(evt.getURL().toURI());
	            } catch (URISyntaxException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
	        }
	    }
	}
}
