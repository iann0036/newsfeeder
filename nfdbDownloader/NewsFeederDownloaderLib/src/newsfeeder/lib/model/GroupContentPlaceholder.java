package newsfeeder.lib.model;

import org.codehaus.jackson.annotate.JsonTypeInfo;


public class GroupContentPlaceholder 
{
	private int id;
	private Point start;
	private Point end;
	
	public GroupContentPlaceholder()
	{
		
	}
	
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
