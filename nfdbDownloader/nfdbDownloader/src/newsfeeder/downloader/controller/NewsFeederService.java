package newsfeeder.downloader.controller;

import newsfeeder.downloader.model.*;
import newsfeeder.lib.model.*;

import com.sun.jersey.api.client.Client;
import com.sun.jersey.api.client.ClientResponse;
import com.sun.jersey.api.client.GenericType;
import com.sun.jersey.api.client.WebResource;
import com.sun.jersey.api.client.config.ClientConfig;
import com.sun.jersey.api.client.config.DefaultClientConfig;
import com.sun.jersey.api.json.JSONConfiguration;

import java.awt.Point;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.IOException;
import java.nio.charset.Charset;
import java.nio.file.FileSystems;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.ws.rs.core.MediaType;

import org.codehaus.jackson.JsonGenerationException;
import org.codehaus.jackson.JsonParseException;
import org.codehaus.jackson.map.JsonMappingException;
import org.codehaus.jackson.map.ObjectMapper;
import org.codehaus.jackson.type.TypeReference;

public class NewsFeederService
{
	private static String baseAddress = "http://newsfeeder.co:8080";
	private static AuthenticationRequest workingRequest = null;
	
	public static AuthenticationRequest getWorkingRequest()
	{
		return workingRequest;
	}
	
	public Boolean Authenticate(String username, String password)
	{
		NewsFeederService.workingRequest = new AuthenticationRequest(username, password);
		
		ClientResponse response = getWebClient(baseAddress + "/NewsFeederWebService/Auth").type(MediaType.APPLICATION_JSON).accept("application/json").post(ClientResponse.class);
		boolean authenticated = response.getEntity(boolean.class);
		
		if(!authenticated)
		{
			NewsFeederService.workingRequest = null;
		}
		
		return authenticated;
	}
	
	public String GetUserSheetsSerialised()
	{
		return getWebClient(baseAddress + "/NewsFeederWebService/Sheets").type(MediaType.APPLICATION_JSON).accept("application/json").post(String.class);
	}
	
	private com.sun.jersey.api.client.WebResource.Builder getWebClient(String url)
	{
		ClientConfig clientConfig = new DefaultClientConfig();
		clientConfig.getFeatures().put(JSONConfiguration.FEATURE_POJO_MAPPING, Boolean.TRUE);
		Client client = Client.create(clientConfig);
		
		ObjectMapper mapper = new ObjectMapper();
		String authorizationString = "";
		
		try 
		{
			authorizationString = javax.xml.bind.DatatypeConverter.printBase64Binary(mapper.writeValueAsString(NewsFeederService.workingRequest).getBytes());
		} 
		catch (IOException e) 
		{
		}

		WebResource webResource = client.resource(url);
		return webResource.header("Authorization", authorizationString);
	}
	
	public int GetDefaultSheetViewID()
	{
		return 0;
	}
	

}
