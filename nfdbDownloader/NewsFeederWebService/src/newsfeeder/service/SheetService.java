package newsfeeder.service;

import java.util.ArrayList;
import java.util.List;

import javax.servlet.http.HttpServletRequest;
import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;

import newsfeeder.lib.model.*;
import nfdb.*;

@Path("/Sheets")
public class SheetService 
{
	@POST
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	public SheetViewModelCollection getSheets(@Context HttpServletRequest req)
	{
		if(!Authenticate.authenticateHeader(req))
		{
			return null;
		}
		
		SheetController sheetController = new SheetController();
		sheetvector sheets = sheetController.GetSheetsByUsername(Authenticate.getAuthRequest(req).getUsername());

		ContentPlaceholderController cphController = new ContentPlaceholderController();
		FeedController feedc = new FeedController();
		ItemController itemc = new ItemController();
		
		List<SheetViewModel> models = new ArrayList<SheetViewModel>();
		
		int sheetLen = (int)sheets.size();
		for(int i = 0; i < sheetLen; i++)
		{
			boolean column1 = false;
			boolean column2 = false;
			
			List<newsfeeder.lib.model.ContentPlaceholder> contentPlaceholders = new ArrayList<newsfeeder.lib.model.ContentPlaceholder>();
			
			Sheet s = sheets.get(i);
			cphvector cphs = cphController.GetContentPlaceholdersBySheetId(s.getId());
			
			int cphLen = (int)cphs.size();
			for(int x = 0; x < cphLen; x++)
			{
				nfdb.ContentPlaceholder cph = cphs.get(x);
				
				NewsContentPlaceholder newsCPH = new NewsContentPlaceholder(cph.getColumn(), cph.getOrder());
				contentPlaceholders.add(newsCPH);
				
				if(cph.getColumn() == 0)
				{
					column1 = true;
				}
				
				if(cph.getColumn() == 1)
				{
					column2 = true;
				}
				
				feedvector feeds = feedc.GetFeedsByCphId(cph.getId());
				int feedLen = (int)feeds.size();
				
				for(int y = 0; y < feedLen; y++)
				{
					Feed f = feeds.get(y);
					
					itemvector items = itemc.GetItemsByFeedId(f.getId());
					int itemLen = (int)items.size();
					for(int z = 0; z < itemLen; z++)
					{
						nfdb.Item dbItem = items.get(z);
						
						NewsItem item = new NewsItem(dbItem.getId(), dbItem.getContent(), dbItem.getTitle(), "");
						newsCPH.addItem(item);
					}
				}
				
			}
			
			SheetLayout layout = get2ColLayout();
			
			if(column1 && column2)
			{
				layout = get2ColLayout();
			}
			else if(column1)
			{
				layout = get1ColLayout(0);
			}
			else if(column2)
			{
				layout = get1ColLayout(1);
			}
			
			SheetViewModel model = new SheetViewModel(s.getId(), s.getName(), layout, contentPlaceholders);
			models.add(model);
		}
		
		SheetViewModelCollection collection = new SheetViewModelCollection();
		collection.Sheets = (ArrayList<SheetViewModel>) models;
		
		return collection;
	}
		
	
	private SheetLayout get1ColLayout(int columnID)
	{
		List<GroupContentPlaceholder> groupContentPlaceholders = new ArrayList<GroupContentPlaceholder>();
		GroupContentPlaceholder placeholder1 = new GroupContentPlaceholder(columnID, new Point(0,0), new Point(0,0));
		groupContentPlaceholders.add(placeholder1);
		
		SheetLayout layout = new SheetLayout(groupContentPlaceholders);
		layout.addRowMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Percent, 100);
		
		return layout;
	}
	
	private SheetLayout get2ColLayout()
	{
		List<GroupContentPlaceholder> groupContentPlaceholders = new ArrayList<GroupContentPlaceholder>();
		GroupContentPlaceholder placeholder1 = new GroupContentPlaceholder(0, new Point(0,0), new Point(0,0));
		groupContentPlaceholders.add(placeholder1);
		
		GroupContentPlaceholder placeholder2 = new GroupContentPlaceholder(1, new Point(1,0), new Point(0,1));
		groupContentPlaceholders.add(placeholder2);
		
		SheetLayout layout = new SheetLayout(groupContentPlaceholders);
		layout.addRowMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		layout.addColMeasurement(MeasurementType.Pixel, 10);
		
		return layout;
	}
}
