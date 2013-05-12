package nfdb.model;

import java.awt.Point;

public class GroupContentPlaceholder 
{
	private int id;
	private Point start;
	private Point end;
	
	public GroupContentPlaceholder(int id, Point start, Point end)
	{
		this.id = id;
		this.start = start;
		this.end = end;
	}
	
	public Point getStart()
	{
		return this.start;
	}
	
	public Point getEnd()
	{
		return this.end;
	}
	
	public int getID()
	{
		return this.id;
	}
}
