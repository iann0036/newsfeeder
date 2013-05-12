package newsfeeder.downloader.controller;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.IOException;
import java.nio.charset.Charset;
import java.nio.file.FileSystems;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.Date;

import newsfeeder.downloader.model.DownloaderCache;
import newsfeeder.lib.model.SheetViewModelCollection;

import org.codehaus.jackson.map.ObjectMapper;
import org.codehaus.jackson.type.TypeReference;

public class CacheController
{
	private static String cacheFilename = "downloader.cache";
	
	public DownloaderCache GetSheetsCache()
	{
		Path filePath = FileSystems.getDefault().getPath(cacheFilename);
		File f = new File(cacheFilename);
		
		if(!f.exists())
		{
			return Synchronize();
		}
		
		Charset charset = Charset.forName("UTF-8");
		StringBuffer sb = new StringBuffer();
		
		try 
		{
		    BufferedReader in = Files.newBufferedReader(filePath, charset);
	
		    String s;
		    while((s = in.readLine()) != null) 
		    {
		      sb.append(s);
		      sb.append("\n");
		    }
		    in.close();
		}
		catch (IOException e1) 
		{
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}

		ObjectMapper mapper = new ObjectMapper();
		DownloaderCache cache = null;
		
		try 
		{
			cache = mapper.readValue(sb.toString(), new TypeReference<DownloaderCache>() {});
		} 
		catch (IOException e) 
		{
			System.err.println(e.getStackTrace());
		}
		String user =  NewsFeederService.getWorkingRequest().getUsername();
		// If the cache already exists but a different user is using it, delete the cache and re-create
		if(cache != null && cache.Username.compareTo(user) != 0)
		{
			f.delete();
			
			return Synchronize();
		}
		
		return cache;
	}
	
	public DownloaderCache Synchronize()
	{
		NewsFeederService service = new NewsFeederService();
		
		String sheetsSerialized = service.GetUserSheetsSerialised();
		SheetViewModelCollection sheets = null;
		ObjectMapper mapper = new ObjectMapper();
		
		try 
		{
			sheets = mapper.readValue(sheetsSerialized, new TypeReference<SheetViewModelCollection>() {});
		} 
		catch (IOException e) 
		{
			System.err.println(e.getStackTrace());
		}
		
		DownloaderCache cache = new DownloaderCache();
		cache.LastUpdated = new Date();
		cache.SheetCache = sheets;
		cache.Username = NewsFeederService.getWorkingRequest().getUsername();
		cache.DefaultSheetID = service.GetDefaultSheetViewID();
		
		mapper = new ObjectMapper();
		
		try
		{
			WriteCacheFile(mapper.writeValueAsString(cache));
		} 
		catch (Exception e) 
		{
			e.printStackTrace();
		}
		
		return cache;
	}
	
	private void WriteCacheFile(String s)
	{
		Path filePath = FileSystems.getDefault().getPath(cacheFilename);
		
		Charset charset = Charset.forName("UTF-8");
		try (BufferedWriter writer = Files.newBufferedWriter(filePath, charset)) 
		{
		    writer.write(s, 0, s.length());
		} 
		catch (IOException x) 
		{
		    System.err.format("IOException: %s%n", x);
		}
	}
}
