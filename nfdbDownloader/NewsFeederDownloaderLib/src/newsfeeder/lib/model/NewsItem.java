package newsfeeder.lib.model;


public class NewsItem extends Item
{
	private String body;
	private String title;
	private String shortDescription;
	
	public NewsItem()
	{
		super();
	}
	
	public NewsItem(int itemID)
	{
		super(itemID);
	}
	
	public NewsItem(int itemID, String body, String title, String shortDescription)
	{
		super(itemID);
		this.body = body;
		this.title = title;
		this.shortDescription = shortDescription;
	}
	
	public void setBody(String body)
	{
		this.body = body;
	}
	
	public void setShortDescription(String shortDescription)
	{
		this.shortDescription = shortDescription;
	}
	
	public void setTitle(String title)
	{
		this.title = title;
	}
	
	public String getBody()
	{
		return this.body;
	}
	
	public String getShortDescription()
	{
		return this.shortDescription;
	}
	
	public String getTitle()
	{
		return this.title;
	}
}
