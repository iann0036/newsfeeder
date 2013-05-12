package newsfeeder.lib.model;
import java.util.ArrayList;
import java.util.List;

import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement
public class SheetViewModelCollection 
{
	public ArrayList<SheetViewModel> Sheets;
	
	public SheetViewModelCollection()
	{
		
	}
}
