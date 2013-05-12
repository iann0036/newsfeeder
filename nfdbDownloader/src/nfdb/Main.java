package nfdb;

import nfdb.controller.*;
import java.awt.Color;
import java.awt.Component;
import java.awt.Dimension;
import java.awt.event.ComponentEvent;
import java.awt.event.ComponentListener;
import java.awt.event.WindowStateListener;

import javax.swing.ImageIcon;
import javax.swing.JEditorPane;
import javax.swing.JFrame;
import javax.swing.UIManager;

public class Main 
{
	public static void main(String[] args)
	{
		JFrame frame = createGui();
		
		LoginController controller = new LoginController(frame);
		if(!controller.isAuthenticated())
		{
			controller.Display();
		}
		else
		{
			MainController mainController = new MainController(frame);
			mainController.LoadDefaultSheet();
			mainController.Display();
		}
	}
	
	private static JFrame createGui()
	{
		JFrame frame = new JFrame();
		UIManager.getLookAndFeelDefaults().put( "TextField.caretForeground", Color.white );
		UIManager.getLookAndFeelDefaults().put( "PasswordField.caretForeground", Color.white );
	
		frame.setIconImage(new ImageIcon(frame.getClass().getResource("/images/newsfeeder.gif")).getImage());
		frame.setSize(new Dimension(520, 480));
		frame.setMinimumSize(new Dimension(520, 480));
		frame.setLocationRelativeTo(null);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		
		
		return frame;
	}
	

}
