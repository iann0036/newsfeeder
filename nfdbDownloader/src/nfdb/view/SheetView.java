package nfdb.view;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Rectangle;
import java.awt.event.ComponentEvent;
import java.awt.event.ComponentListener;
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

import nfdb.model.ContentPlaceholder;
import nfdb.model.GroupContentPlaceholder;
import nfdb.model.NewsContentPlaceholder;
import nfdb.model.NewsItem;
import nfdb.model.SheetLayout;
import nfdb.model.SheetViewModel;
import nfdb.util.BackgroundJPanel;


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
		SheetLayout layout = this.model.getSheetLayout();
		List<GroupContentPlaceholder> groupContentPlaceholders = layout.getGroupContentPlaceholders();
		
		populatedCells = new Boolean[layout.getRowCount()][layout.getColCount()];
		
		for(int i = 0; i < groupContentPlaceholders.size(); i++)
		{
			GroupContentPlaceholder g = groupContentPlaceholders.get(i);
			
			GridBagConstraints constraints = new GridBagConstraints();
			constraints.gridx = (int)g.getStart().getX();
			constraints.gridy = (int)g.getStart().getY();
			constraints.fill = GridBagConstraints.BOTH;
			constraints.weightx = 1;
			constraints.weighty = 1;
			constraints.gridheight = (int)(g.getEnd().getX() - g.getStart().getX() + 1);
			constraints.gridwidth = (int)(g.getEnd().getY() - g.getStart().getY() + 1);
			
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
			gPanel.setBorder(BorderFactory.createEmptyBorder(15, 15, 15, 15));
			
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
			this.textEditors.add(editorPane);
			editorPane.setOpaque(false);
			editorPane.setEditable(false);
			editorPane.setText(newsItems.get(i).getBody());
			editorPane.setForeground(new Color(0xFAFAFA));
			editorPane.setFont(new Font("Cuprum", Font.PLAIN, 15));
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
			constraints.weighty = 1;
			
			contentPlaceholderPanel.add(view, constraints);
			
			gridYCounter++;
		}
		
		JPanel groupContentPlaceholder = groupContentPlaceholderPanels.get(contentPlaceholder.getGroupContentPlaceholderID());
		
		GridBagConstraints constraints = new GridBagConstraints();
		constraints.gridx = 1;
		constraints.gridy = contentPlaceholder.getPlaceholderDisplayIndex();
		constraints.fill = GridBagConstraints.BOTH;
		constraints.weightx = 1;
		constraints.weighty = 0;
		
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
}
