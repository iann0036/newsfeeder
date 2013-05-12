package newsfeeder.lib.model;

import java.util.ArrayList;
import java.util.List;

public class NewsContentPlaceholder extends ContentPlaceholder
{
	List<NewsItem> items;
	Boolean displayTitle = true;
	Boolean displayContent = true;
	Boolean displayShort = false;
	
	public NewsContentPlaceholder()
	{
		super();	
	}
	
	public NewsContentPlaceholder(int groupContentPlaceholderID, int placeholderDisplayIndex)
	{
		super(groupContentPlaceholderID, placeholderDisplayIndex);
		
		items = new ArrayList<NewsItem>();
	}
	
	public List<NewsItem> getItems()
	{
		return this.items;
	}
	
	public void addItem(NewsItem item)
	{
		this.items.add(item);
	}
}
