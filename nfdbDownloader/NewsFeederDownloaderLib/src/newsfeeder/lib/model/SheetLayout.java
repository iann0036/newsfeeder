package newsfeeder.lib.model;

import java.util.ArrayList;
import java.util.List;

import org.codehaus.jackson.annotate.JsonIgnoreProperties;

@JsonIgnoreProperties({ "colCount", "rowCount" })
public class SheetLayout 
{
	private List<LayoutMeasurement> rowSizes;
	private List<LayoutMeasurement> colSizes;
	
	private List<GroupContentPlaceholder> groupContentPlaceholders;
	
	public SheetLayout()
	{
		
	}
	
	public SheetLayout(List<GroupContentPlaceholder> groupContentPlaceholders)
	{
		this.colSizes = new ArrayList<LayoutMeasurement>();
		this.rowSizes = new ArrayList<LayoutMeasurement>();
		
		this.groupContentPlaceholders = groupContentPlaceholders;
	}
	
	public List<LayoutMeasurement> getRowSizes()
	{
		return this.rowSizes;
	}
	
	public List<LayoutMeasurement> getColSizes()
	{
		return this.colSizes;
	}
	
	public void setRowSizes(List<LayoutMeasurement> rowSizes)
	{
		this.rowSizes = rowSizes;
	}
	
	public void setColSizes(List<LayoutMeasurement> colSizes)
	{
		this.colSizes = colSizes;
	}
	
	public int getRowCount()
	{
		return this.rowSizes.size();
	}
	
	public int getColCount()
	{
		return this.colSizes.size();
	}
	
	public List<GroupContentPlaceholder> getGroupContentPlaceholders()
	{
		return this.groupContentPlaceholders;
	}
	
	public void addRowMeasurement(MeasurementType type, int measurement)
	{
		this.rowSizes.add(new LayoutMeasurement(type, measurement));
	}
	
	public void addColMeasurement(MeasurementType type, int measurement)
	{
		this.colSizes.add(new LayoutMeasurement(type, measurement));
	}
}
