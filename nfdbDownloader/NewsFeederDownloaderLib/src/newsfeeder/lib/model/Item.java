package newsfeeder.lib.model;

import org.codehaus.jackson.annotate.JsonTypeInfo;

@JsonTypeInfo(use=JsonTypeInfo.Id.CLASS, include=JsonTypeInfo.As.PROPERTY, property="class")
public class Item 
{
	int itemID;
	
	public Item()
	{
		
	}
	
	public Item(int itemID)
	{
		this.itemID = itemID;
	}
	
	public int getItemID()
	{
		return this.itemID;
	}
}
