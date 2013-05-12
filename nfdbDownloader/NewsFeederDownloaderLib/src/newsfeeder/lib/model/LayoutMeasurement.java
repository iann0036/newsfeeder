package newsfeeder.lib.model;

public class LayoutMeasurement
{
	private MeasurementType type;
	private int length;
	
	public LayoutMeasurement()
	{
		
	}
	
	public LayoutMeasurement(MeasurementType type, int length)
	{
		this.type = type;
		this.length = length;
	}
	
	public void setMeasurementType(MeasurementType type)
	{
		this.type = type;
	}
	
	public void setLength(int length)
	{
		this.length = length;
	}
	
	public MeasurementType getMeasurementType()
	{
		return this.type;
	}
	
	public int getLength()
	{
		return this.length;
	}
}
