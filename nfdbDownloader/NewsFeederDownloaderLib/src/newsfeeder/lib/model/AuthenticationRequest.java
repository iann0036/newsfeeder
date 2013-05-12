package newsfeeder.lib.model;

public class AuthenticationRequest
{
	private String password;
	private String username;
	
	public AuthenticationRequest()
	{
		
	}
	
	public AuthenticationRequest(String username, String password)
	{
		this.username = username;
		this.password = password;
	}
	
	public void setPassword(String password)
	{
		this.password = password;
	}
	
	public String getPassword()
	{
		return this.password;
	}
	
	public void setUsername(String username)
	{
		this.username = username;
	}
	
	public String getUsername()
	{
		return this.username;
	}
}
