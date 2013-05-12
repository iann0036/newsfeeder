package newsfeeder.service;

import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.util.Arrays;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;
import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;

import org.codehaus.jackson.map.ObjectMapper;
import org.codehaus.jackson.type.TypeReference;

import com.sun.xml.internal.fastinfoset.algorithm.HexadecimalEncodingAlgorithm;

import sun.util.logging.resources.logging;

import newsfeeder.lib.model.*;
import nfdb.*;

@Path("/Auth")
public class Authenticate 
{
	  @POST
	  @Consumes(MediaType.APPLICATION_JSON)
	  @Produces(MediaType.APPLICATION_JSON)
	  public boolean authenticate(@Context HttpServletRequest req) 
	  {
		  return authenticateHeader(req);
	  }
	  
	  public static AuthenticationRequest getAuthRequest(HttpServletRequest req)
	  {
		  	String auth = new String(javax.xml.bind.DatatypeConverter.parseBase64Binary(req.getHeader("Authorization")));
			  
			ObjectMapper mapper = new ObjectMapper();
			AuthenticationRequest request = null;
			
			try 
			{
				request = mapper.readValue(auth, new TypeReference<AuthenticationRequest>() {});
			}
			catch(Exception e)
			{
			}
			
			return request;
	  }
	  
	  public static boolean authenticateHeader(HttpServletRequest req)
	  {
		  	AuthenticationRequest request = getAuthRequest(req);
			
			try
			{
				System.loadLibrary("nfdb_java");
			} 
			catch (UnsatisfiedLinkError ex) 
			{
			}
			
			UserController c = new UserController();
			User u = c.GetUserByUsername(request.getUsername());
			
			if(u != null && u.getUsername().compareTo(request.getUsername()) == 0 && u.getPassword().toLowerCase().compareTo(MD5(request.getPassword()).toLowerCase()) == 0)
			{
				return true;
			}
			else
			{
				return false;
			}
	  }
	  
	  
		public static String MD5(String md5) 
		{
			try 
			{
				java.security.MessageDigest md = java.security.MessageDigest.getInstance("MD5");
				byte[] array = md.digest(md5.getBytes());
				StringBuffer sb = new StringBuffer();
				for (int i = 0; i < array.length; ++i) 
				{
					sb.append(Integer.toHexString((array[i] & 0xFF) | 0x100).substring(1,3));
				}
				return sb.toString();
			} 
			catch (java.security.NoSuchAlgorithmException e) 
			{
			}
			return null;
		}
	  
}
