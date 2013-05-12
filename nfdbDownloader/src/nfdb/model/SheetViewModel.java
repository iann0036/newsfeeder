package nfdb.model;
import java.util.List;


public class SheetViewModel 
{
	private int sheetID;
	private SheetLayout layout;
	private List<ContentPlaceholder> contentPlaceholders;
	
	public SheetViewModel()
	{
		
	}
	
	public SheetViewModel(int sheetID, SheetLayout layout, List<ContentPlaceholder> contentPlaceholders)
	{
		this.sheetID = sheetID;
		this.layout = layout;
		this.contentPlaceholders = contentPlaceholders;
	}
	
	public SheetLayout getSheetLayout()
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
}
