package nfdb.controller;

import nfdb.view.*;
import nfdb.controller.*;
import java.awt.event.*;
import javax.swing.JFrame;


public class LoginController
{
	private LoginView view;
	private JFrame frame;
	private Boolean authenticated = false;
	
	public LoginController(JFrame frame)
	{
		this.frame = frame;
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
	    		  controller.LoadDefaultSheet();
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
}
