package newsfeeder.downloader.util;

import java.awt.Graphics;
import java.awt.Image;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;

import javax.swing.ImageIcon;
import javax.swing.JButton;


public class BackgroundJButton extends JButton
{
	Image backgroundImage;
	Image backgroundImageHover;
	Image backgroundImagePressed;
	Boolean tile;
	Boolean mouseOver = false;
	Boolean mouseDown = false;
	
	public BackgroundJButton(String imageFilename, String imageFilenamePressed, String imageFilenameHover, Boolean tile)
	{
		try
		{
			backgroundImage = (new ImageIcon(getClass().getResource(imageFilename))).getImage();
			backgroundImageHover = (new ImageIcon(getClass().getResource(imageFilenameHover))).getImage();
			backgroundImagePressed = (new ImageIcon(getClass().getResource(imageFilenamePressed))).getImage();
			this.tile = tile;
		}
		catch(Exception e) { }
		
		this.addMouseListener(new BackgroundJButtonMouseListener(this));
	}
	
	public void paint(Graphics g)
	{
		Image useImage = backgroundImage;
		
		if(this.mouseOver)
		{
			useImage = backgroundImageHover;
		}
		
		if(this.mouseDown)
		{
			useImage = backgroundImagePressed;
		}
		
		if(useImage != null)
		{
			if(tile)
			{
				int width = getWidth();  
		        int height = getHeight();  
		        int imageW = useImage.getWidth(this);  
		        int imageH = useImage.getHeight(this);  
		   
		        // Tile the image to fill our area.  
		        for (int x = 2; x < width; x += imageW)
		        {  
		            for (int y = 2; y < height; y += imageH)
		            {  
		                g.drawImage(useImage, x, y, this);  
		            }  
		        }  
			}
			else
			{
				g.drawImage(useImage, (this.getWidth()/2) - (useImage.getWidth(this) / 2), 
											 (this.getHeight()/2) - (useImage.getHeight(this) / 2),
											 useImage.getWidth(this),
											 useImage.getHeight(this),
											 this);
			}
			
			this.setContentAreaFilled(false);
		}
		
		super.paint(g);
	}
	
	protected void setHover(Boolean hover)
	{
		this.mouseOver = hover;
	}
	
	protected void setPressed(Boolean pressed)
	{
		this.mouseDown = pressed;
	}
	
	class BackgroundJButtonMouseListener implements MouseListener
	{
		private BackgroundJButton button;
		
		public BackgroundJButtonMouseListener(BackgroundJButton button)
		{
			this.button = button;
		}
		
		public void mouseClicked(MouseEvent arg0)
		{
		}

		public void mouseEntered(MouseEvent arg0)
		{
			button.setHover(true);
		}

		public void mouseExited(MouseEvent arg0)
		{
			button.setHover(false);
		}

		public void mousePressed(MouseEvent arg0)
		{
			button.setPressed(true);
		}

		public void mouseReleased(MouseEvent arg0)
		{
			button.setPressed(false);
		}
		
	}
}
