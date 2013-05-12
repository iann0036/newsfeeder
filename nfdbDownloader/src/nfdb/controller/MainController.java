package nfdb.controller;

import java.awt.Component;
import java.awt.Dimension;
import java.awt.event.ComponentEvent;
import java.awt.event.ComponentListener;

import nfdb.model.SheetViewModel;
import nfdb.view.*;

import javax.swing.JEditorPane;
import javax.swing.JFrame;

public class MainController
{
	MainView view;
	private JFrame frame;
	
	public MainController(JFrame frame)
	{
		this.frame = frame;
		this.view = new MainView();
	}
	
	public void LoadDefaultSheet()
	{
		NewsFeederService service = new NewsFeederService();
		SheetViewModel sheetView = service.GetDefaultSheetView();
		
		this.view.LoadSheetView(sheetView);
	}
	
	public void LoadSheet()
	{
		
	}
	
	public void Display()
	{
		frame.getContentPane().removeAll();
		frame.add(this.view);
		frame.setVisible(true);
		frame.validate();
	}
}
