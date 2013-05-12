package nfdb.controller;

import java.awt.Point;
import java.beans.XMLEncoder;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.util.ArrayList;
import java.util.List;

import nfdb.model.ContentPlaceholder;
import nfdb.model.GroupContentPlaceholder;
import nfdb.model.LayoutMeasurement;
import nfdb.model.MeasurementType;
import nfdb.model.NewsContentPlaceholder;
import nfdb.model.NewsItem;
import nfdb.model.SheetLayout;
import nfdb.model.SheetViewModel;

public class NewsFeederService
{
	public Boolean Authenticate(String username, String password)
	{
		return true;
	}
	
	public SheetViewModel GetDefaultSheetView()
	{		
		
		SheetViewModel model = new SheetViewModel(10, get2Col2RowLayout(), getPrototypeContentPlaceholders());
		
		return model;
	}
	
	private SheetLayout get2Col2RowLayout()
	{
		List<GroupContentPlaceholder> groupContentPlaceholders = new ArrayList<GroupContentPlaceholder>();
		GroupContentPlaceholder placeholder1 = new GroupContentPlaceholder(1, new Point(0,0), new Point(0,0));
		groupContentPlaceholders.add(placeholder1);
		
		GroupContentPlaceholder placeholder2 = new GroupContentPlaceholder(2, new Point(0,1), new Point(0,1));
		groupContentPlaceholders.add(placeholder2);
		
		GroupContentPlaceholder placeholder3 = new GroupContentPlaceholder(3, new Point(1,0), new Point(1,1));
		groupContentPlaceholders.add(placeholder3);
		
		SheetLayout layout = new SheetLayout(groupContentPlaceholders);
		layout.addRowMeasurement(MeasurementType.Pixel, 10);
		layout.addRowMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		
		return layout;
	}
	
	private SheetLayout get2ColLayout()
	{
		List<GroupContentPlaceholder> groupContentPlaceholders = new ArrayList<GroupContentPlaceholder>();
		GroupContentPlaceholder placeholder1 = new GroupContentPlaceholder(1, new Point(0,0), new Point(0,0));
		groupContentPlaceholders.add(placeholder1);
		
		GroupContentPlaceholder placeholder2 = new GroupContentPlaceholder(2, new Point(0,1), new Point(0,1));
		groupContentPlaceholders.add(placeholder2);
		
		SheetLayout layout = new SheetLayout(groupContentPlaceholders);
		layout.addRowMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		
		return layout;
	}
	
	private SheetLayout get3ColLayout()
	{
		List<GroupContentPlaceholder> groupContentPlaceholders = new ArrayList<GroupContentPlaceholder>();
		GroupContentPlaceholder placeholder1 = new GroupContentPlaceholder(1, new Point(0,0), new Point(0,0));
		groupContentPlaceholders.add(placeholder1);
		
		GroupContentPlaceholder placeholder2 = new GroupContentPlaceholder(2, new Point(0,1), new Point(0,1));
		groupContentPlaceholders.add(placeholder2);
		
		GroupContentPlaceholder placeholder3 = new GroupContentPlaceholder(3, new Point(0,2), new Point(0,2));
		groupContentPlaceholders.add(placeholder3);
		
		SheetLayout layout = new SheetLayout(groupContentPlaceholders);
		layout.addRowMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		
		return layout;
	}
	
	private List<ContentPlaceholder> getPrototypeContentPlaceholders()
	{
		//Create dummy placeholders and add items to them for demo
		List<ContentPlaceholder> contentPlaceholders = new ArrayList<ContentPlaceholder>();
		
		NewsItem item1 = new NewsItem(1, "Anyone who's anyone in the Fallout community knows Pawel \"Ausir\" Dembowski. Founder of The Vault wiki which contains over 15,000 pages of Fallout lore, Pawel is a human encyclopedia of gaming's favorite post apocalyptic franchise", "Fallout Wiki Founder Banned From Wikia for Promoting Curse [Fallout]", "This is the short description");
		NewsItem item2 = new NewsItem(2, "The term 'cute' and 'tool' aren't often associated, but I can't think of a better way to describe this tiny screwdriver designed to look like a miniature tank hanging from your keyring", "Adorable Tool Tank Totally Out-Cutes Your Swiss Army Knife [Tools]", "This is the short description");
		NewsItem item3 = new NewsItem(3, "The Fraunhofer Institute for High Frequency Physics and Radar Techniques has taken this hot picture of the Russian Mars 13-ton probe Phobos-Grunt as it falls to planet Earth. It may hit tomorrow, but we still don't know where.", "Image of 13-Ton Russian Spacecraft As It Falls to Earth—Impact As Early As Tomorrow [Space]", "This is the short description");
		NewsItem item4 = new NewsItem(4, "Unless you work at the Pentagon, the key locks on your desk drawers are probably easy to compromise. So with their new Covert, the folks at Quirky figured that a drawer lock can't be picked if it can't be found", "Quirky's Invisible Drawer Locks Only Open With a Magnetic Key [Genius]", "This is the short description");
		NewsItem item5 = new NewsItem(5, "Thanks Prada for once again completely befuddling me when it comes to high fashion. Because while I certainly love the designs of classic American automobiles, I would never have thought to apply their iconic spoilers and taillights", "Prada's 2012 Spring Shoe Collection Inspired By Classic American Cars [Automotive]", "This is the short description");
		
		NewsContentPlaceholder contentPlaceholderA = new NewsContentPlaceholder(1, 1);
		contentPlaceholderA.addItem(item1);
		contentPlaceholderA.addItem(item2);
		contentPlaceholderA.addItem(item3);
		contentPlaceholderA.addItem(item4);
		contentPlaceholderA.addItem(item5);
		
		contentPlaceholders.add(contentPlaceholderA);
		
		NewsContentPlaceholder contentPlaceholderB = new NewsContentPlaceholder(2, 1);
		contentPlaceholderB.addItem(item1);
		contentPlaceholderB.addItem(item2);
		contentPlaceholderB.addItem(item3);
		contentPlaceholderB.addItem(item4);
		contentPlaceholderB.addItem(item5);
		
		contentPlaceholders.add(contentPlaceholderB);
		
		return contentPlaceholders;
	}
}
