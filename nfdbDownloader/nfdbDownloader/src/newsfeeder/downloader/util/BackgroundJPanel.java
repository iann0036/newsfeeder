package newsfeeder.downloader.util;

import java.awt.*;
import javax.swing.*;

public class BackgroundJPanel extends JPanel
{
	Image backgroundImage;
	Boolean tile;
	int topBorderOffset = 0;
	
	public BackgroundJPanel(String filename, Boolean tile)
	{
		try
		{
			backgroundImage = (new ImageIcon(getClass().getResource(filename))).getImage();
			this.tile = tile;
		}
		catch(Exception e) { }
	}
	
	public void paintComponent(Graphics g)
	{
		super.paintComponent(g);
		
		if(backgroundImage != null)
		{
			if(tile)
			{
				int width = getWidth();  
		        int height = getHeight();  
		        int imageW = backgroundImage.getWidth(this);  
		        int imageH = backgroundImage.getHeight(this);  
		   
		        // Tile the image to fill our area.  
		        for (int x = 0; x < width; x += imageW)
		        {  
		            for (int y = 0; y < height; y += imageH)
		            {  
		                g.drawImage(backgroundImage, x, y, this);  
		            }  
		        }  
			}
			else
			{
				g.drawImage(backgroundImage, (this.getWidth()/2) - (backgroundImage.getWidth(this) / 2), 
											 (this.getHeight()/2) - (backgroundImage.getHeight(this) / 2),
											 backgroundImage.getWidth(this),
											 backgroundImage.getHeight(this),
											 this);
			}
		}
	}
	
	public void setTopBorderOffset(int offset)
	{
		this.topBorderOffset = offset;
	}
}
