package newsfeeder.downloader.controller;

import newsfeeder.downloader.view.*;

import java.awt.event.*;
import java.io.BufferedWriter;
import java.io.IOException;
import java.nio.charset.Charset;
import java.nio.file.FileSystems;
import java.nio.file.Files;
import java.nio.file.Path;

import javax.swing.JFrame;


public class LoginController
{
	private LoginView view;
	private JFrame frame;
	private Boolean authenticated = false;
	private static String authenticationFile = "auth.cache";
	
	public LoginController(JFrame frame)
	{
		this.frame = frame;
		
	}
	
	private void CheckLoggedIn()
	{
		
	}
	
	private class LoginButtonAction implements ActionListener 
	{
	      public void actionPerformed(ActionEvent e) 
	      {
	    	  NewsFeederService service = new NewsFeederService();
	    	  
	    	  if(service.Authenticate(view.GetUsername(), view.GetPassword()))
	    	  {
	    		  authenticated = true;
	    		  
	    		  MainController controller = new MainController(frame);
	    		  controller.LoadMainView();
	    		  controller.Display();
	    	  }
	    	  else
	    	  {
	    		  authenticated = false;
	    		  view.AuthenticationFailed();
	    	  }
	      }
    }
	
	public void Display()
	{
		this.view = new LoginView();
		this.view.AddLoginActionListener(new LoginButtonAction());
		
		frame.getContentPane().removeAll();
		frame.add(this.view);
		frame.setVisible(true);
		frame.validate();
	}
	
	public Boolean isAuthenticated()
	{
		return this.authenticated;
	}
	
	private void WriteLoginDetails(String s)
	{
		Path filePath = FileSystems.getDefault().getPath(authenticationFile);
		
		Charset charset = Charset.forName("UTF-8");
		try (BufferedWriter writer = Files.newBufferedWriter(filePath, charset)) 
		{
		    writer.write(s, 0, s.length());
		} 
		catch (IOException x) 
		{
		    System.err.format("IOException: %s%n", x);
		}
	}
}
