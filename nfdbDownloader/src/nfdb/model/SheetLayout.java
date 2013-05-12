package nfdb.model;

import java.util.ArrayList;
import java.util.List;

public class SheetLayout 
{
	private List<LayoutMeasurement> rowSizes;
	private List<LayoutMeasurement> colSizes;
	
	private List<GroupContentPlaceholder> groupContentPlaceholders;
	
	public SheetLayout(List<GroupContentPlaceholder> groupContentPlaceholders)
	{
		this.colSizes = new ArrayList<LayoutMeasurement>();
		this.rowSizes = new ArrayList<LayoutMeasurement>();
		
		this.groupContentPlaceholders = groupContentPlaceholders;
	}
	
	public LayoutMeasurement[] getRowSizes()
	{
		return (LayoutMeasurement[])this.rowSizes.toArray();
	}
	
	public LayoutMeasurement[] getColSizes()
	{
		return (LayoutMeasurement[])this.colSizes.toArray();
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
