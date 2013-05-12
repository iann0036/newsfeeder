<?php
	require_once('../classes/thirdparty/simplepie/simplepie.inc');
	require_once('../classes/thirdparty/simplepie/idn/idna_convert.class.php');
	
	// Report simple running errors except warning (which is thrown by file_get_contents)
	error_reporting(E_ERROR | E_PARSE);
	
	function performSearch($term) {
		$json = file_get_contents('http://api.bing.net/json.aspx?AppId=4CA6F8F1CC4E1E5C108C32C88BDCB8974E1A5E68&Version=2.2&Market=en-US&Query='.$term.'&Sources=web+spell&Web.Count=20&JsonType=raw');
		$decode = json_decode($json, true);
		$results = $decode['SearchResponse']['Web']['Results'];
		return $results;
	}
	
	$results = performSearch($_GET['term']);
	
	for ($i=0; $i<20; $i++) {
		echo "<small><b>Title: </b>".$results[$i]['Title'];
		echo "<br><b>Description: </b>".$results[$i]['Description'];
		echo "<br><b>URL: </b>".$results[$i]['Url'];
		echo "<br><b>Trimmed URL: </b>".$results[$i]['DisplayUrl'];
		echo "<br><b>Date Crawled: </b>".$results[$i]['DateTime']."</small>";
		
		$resultcontent = file_get_contents($results[$i]['Url']);
		if ($resultcontent==false)
			echo "<br><b><i>Warning: Website could not be processed</i></b>";
		else {
			// Initialize DOMDocument
			$doc = new DOMDocument();
			$doc->loadHTML($resultcontent);
			
			// Empty array to hold all links to return 
			$links = array(); 
			$possiblelinks = array();

			//Loop through each <a> tag in the dom and add it to the link array 
			foreach($doc->getElementsByTagName('a') as $link) { 
				$links[] = array('url' => $link->getAttribute('href'), 'text' => $link->nodeValue); 
			}
			
			foreach($doc->getElementsByTagName('link') as $link) { 
				if (stristr($link->getAttribute('type'),"rss")!==false)
				    $possiblelinks[] = $link->getAttribute('href');
			}
			
			foreach($links as $link) {
				if (stristr($link['url'],"rss")!==false) { $possiblelinks[] = $link['url']; }
				if (stristr($link['text'],"rss")!==false) { $possiblelinks[] = $link['url']; }
				if (stristr($link['url'],"feeds")!==false) { $possiblelinks[] = $link['url']; }
				if (stristr($link['text'],"feeds")!==false) { $possiblelinks[] = $link['url']; }
				if (stristr($link['url'],".xml")!==false) { $possiblelinks[] = $link['url']; }
				if (stristr($link['url'],".rss")!==false) { $possiblelinks[] = $link['url']; }
			}
			
			$max = 10;
			
			$possiblelinks = array_unique($possiblelinks);
			
			foreach ($possiblelinks as $xmlurl) {
				if ($max==0) {
				    echo "<br><i>[more possible feeds snipped]</i>";
				    break;
				}
				
				$feed = new SimplePie();
				$feed->set_feed_url($xmlurl);
				$feed->init();
				$feed->handle_content_type();
				$itemcount = count($feed->get_items());

				if (!($feed->error())&&$itemcount>0) {
					echo "<br><b>Valid Feed: </b>".$xmlurl." <i>Count: </i>".$itemcount;
					echo "<br><i>Title: </i>".$feed->get_title()." <i>Description: </i>".$feed->get_description();
					echo "<br>";
				}
				/* */
				$max--;
			}
		}
		echo "<hr>";
	}
?>