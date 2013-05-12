package newsfeeder.lib.model;

public class AuthenticationToken
{
	private String token;
	private String username;
	private int authenticated;
	
	public AuthenticationToken()
	{
	}
	
	public AuthenticationToken(String username, String token, int authenticated)
	{
		this.username = username;
		this.token = token;
		this.authenticated = authenticated;
	}
	
	public String getToken()
	{
		return this.token;
	}
	
	public String getUsername()
	{
		return this.username;
	}
	
	public int getAuthenticated()
	{
		return this.authenticated;
	}
	
	public void setToken(String token)
	{
		this.token = token;
	}
	
	public void setUsername(String username)
	{
		this.username = username;
	}
	
	public void setAuthenticated(int authenticated)
	{
		this.authenticated = authenticated;
	}
}
