<?php
	/*
	File name: /account/feeds/inner.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Uses the Bing API to search the internet for feeds based on a term. Sends results to memcache as they are found. Called via command line.
	Last Modified: 10:44 PM 12/01/2012
	*/

	/* This code needs refactoring */

	if (!defined('ROOT'))
		define('ROOT','/var/www'); 
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/simplepie/simplepie.inc';
	require_once ROOT.'/classes/thirdparty/simplepie/idn/idna_convert.class.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	// Report simple running errors except warning (which is thrown by file_get_contents)
	error_reporting(E_ERROR | E_PARSE);
	
	$memcache = new Memcache;
	$memcache->connect("127.0.0.1", 11211) or die ("Could not connect");
	echo "Version: ".$memcache->getVersion();
	$json = file_get_contents('https://k8n6VjvM8v9Lgr5qaP7mlksAZdtK2rIk4vt7LS0ic6I=:k8n6VjvM8v9Lgr5qaP7mlksAZdtK2rIk4vt7LS0ic6I=@api.datamarket.azure.com/Data.ashx/Bing/Search/v1/Web?Query=%27'.urlencode($argv[1]).'australia%27&$top=50&$format=Json');
	$decode = json_decode($json, true);
	$results = $decode['d']['results'];
	
	echo "\ninner.php: Search performed for ".$argv[1];

	$confirmedlink = array();
	$confirmedlinks = array();
	
	for ($i=0; $i<20; $i++) {
		echo "\ninner.php: Starting Loop ".$i;
		$resultcontent = file_get_contents($results[$i]['Url']);
		if ($resultcontent) {
			echo "\nInitializing DOM";
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
				    //echo "<br><i>[more possible feeds snipped]</i>";
				    break;
				}
				
				$feed = new SimplePie();
				$feed->set_feed_url($xmlurl);
				$feed->init();
				$feed->handle_content_type();
				$itemcount = count($feed->get_items());

				if (!($feed->error())&&$itemcount>0) {
					echo "\ninner.php: Confirmed feed, adding to key ".md5($argv[0])."  with URL ".urlencode($xmlurl);
					$confirmedlink['url'] = urlencode($xmlurl);
					$confirmedlink['title'] = $feed->get_title();
					$confirmedlink['description'] = substr($feed->get_description(),0,500);
					$confirmedlinks[] = $confirmedlink;
					$memcache->set(md5($argv[1]),$confirmedlinks,false,6000);
				}
				/* */
				$max--;
			}
		}
	}

	$memcache->set(md5($argv[1]),$confirmedlinks,false,300);
	echo "\ninner.php: Exiting now\n---\n";
?>
