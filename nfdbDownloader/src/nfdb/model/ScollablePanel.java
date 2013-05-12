package nfdb.model;

import java.awt.Dimension;
import java.awt.Rectangle;

import javax.swing.JPanel;
import javax.swing.Scrollable;

public class ScollablePanel extends JPanel implements Scrollable
{
	public Dimension getPreferredScrollableViewportSize() 
	{
		return null;
	}

	public int getScrollableBlockIncrement(Rectangle visibleRect, int orientation, int direction) 
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

	public int getScrollableUnitIncrement(Rectangle visibleRect, int orientation, int direction) 
	{
		return 0;
	}
}
