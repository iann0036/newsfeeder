package newsfeeder.lib.model;
import java.util.List;

public class SheetViewModel 
{
	private int sheetID;
	private SheetLayout layout;
	private List<ContentPlaceholder> contentPlaceholders;
	private String title;
	
	public SheetViewModel()
	{
		
	}
	
	public SheetViewModel(int sheetID, String title, SheetLayout layout, List<ContentPlaceholder> contentPlaceholders)
	{
		this.sheetID = sheetID;
		this.title = title;
		this.layout = layout;
		this.contentPlaceholders = contentPlaceholders;
	}
	
	public void setLayout(SheetLayout layout)
	{
		this.layout = layout;
	}
	
	public SheetLayout getLayout()
	{
		return this.layout;
	}
	
	public List<ContentPlaceholder> getContentPlaceholders()
	{
		return this.contentPlaceholders;
	}
	
	public int getSheetID()
	{
		return this.sheetID;
	}
	
	public void setValue(String title)
	{
		this.title = title;
	}
	
	public String getTitle()
	{
		return this.title;
	}
	
	public String toString()
	{
		return title;
	}
}
