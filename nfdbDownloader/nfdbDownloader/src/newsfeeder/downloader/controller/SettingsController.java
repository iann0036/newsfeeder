package newsfeeder.downloader.controller;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;

import javax.swing.JFrame;

import newsfeeder.downloader.view.SettingsView;


public class SettingsController 
{
	SettingsView view;
	private JFrame frame;
	
	public SettingsController(JFrame frame)
	{
		this.frame = frame;
		this.view = new SettingsView();
	}
	
	public void Display()
	{
		this.view = new SettingsView();

		frame.getContentPane().removeAll();
		frame.add(this.view);
		frame.setVisible(true);
		frame.validate();
	}
	
	public class SettingsMouseListener implements MouseListener
	{

		@Override
		public void mouseClicked(MouseEvent arg0) {
			//SettingsController controller = new SettingsController();
			//controller.Display();
			
		}

		@Override
		public void mouseEntered(MouseEvent arg0) {
			// TODO Auto-generated method stub
			
		}

		@Override
		public void mouseExited(MouseEvent arg0) {
			// TODO Auto-generated method stub
			
		}

		@Override
		public void mousePressed(MouseEvent arg0) {
			// TODO Auto-generated method stub
			
		}

		@Override
		public void mouseReleased(MouseEvent arg0) {
			// TODO Auto-generated method stub
			
		}
		
	}
}
