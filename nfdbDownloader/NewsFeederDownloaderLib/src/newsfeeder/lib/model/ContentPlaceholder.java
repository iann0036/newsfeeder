package newsfeeder.lib.model;

import org.codehaus.jackson.annotate.JsonTypeInfo;

@JsonTypeInfo(use=JsonTypeInfo.Id.CLASS, include=JsonTypeInfo.As.PROPERTY, property="class")
public abstract class ContentPlaceholder
{
	private int groupContentPlaceholderID;
	private int placeholderDisplayIndex;
	
	public ContentPlaceholder()
	{
		
	}
	
	public ContentPlaceholder(int groupContentPlaceholderID, int placeholderDisplayIndex)
	{
		this.groupContentPlaceholderID = groupContentPlaceholderID;
	}
	
	public int getGroupContentPlaceholderID()
	{
		return this.groupContentPlaceholderID;
	}
	
	public int getPlaceholderDisplayIndex()
	{
		return this.placeholderDisplayIndex;
	}
}
