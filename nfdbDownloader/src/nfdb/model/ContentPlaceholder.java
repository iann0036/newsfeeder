package nfdb.model;

public abstract class ContentPlaceholder
{
	private int groupContentPlaceholderID;
	private int placeholderDisplayIndex;
	
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
