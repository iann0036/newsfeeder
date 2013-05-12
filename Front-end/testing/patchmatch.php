<?php
	/*
	File name: /testing/patchmatch.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Testing the patch-match algorithm
	Last Modified: 10:44 AM 24/02/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/classes/thirdparty/simplepie/simplepie.inc';
	require_once ROOT.'/classes/thirdparty/simplepie/idn/idna_convert.class.php';
	
	$bestpercentile = 0;
	$bestmatch = null;
	
	function innerHTML($el) {
		$doc = new DOMDocument();
		
		$doc->appendChild($doc->importNode($el, TRUE));
		$html = trim($doc->saveHTML());
		$tag = $el->nodeName;
		preg_replace('@^<'.$tag.'[^>]*>|</'.$tag.'>$@','',$html);
		$ret = strip_tags($html);
		
		return $ret;
	}
	
	function processFeed($url) {
		$feed = new SimplePie();
		$feed->set_feed_url($url);
		$feed->init();
		$feed->handle_content_type();
		$itemcount = count($feed->get_items());
		echo $itemcount."<hr>";
		
		return $feed;
	}
	
	function processItem($item) {
		$itemlink = $item->get_permalink();
		if ($itemlink==null||$itemlink=='')
			$itemlink = $item->get_permalink();
		if ($itemlink==null||$itemlink=='')
			return strip_tags(trim($item->get_description()));

		$doc = new DOMDocument();
		$doc->loadHTML(file_get_contents($itemlink));

		processNode($doc->documentElement,$item->get_description());
		
		if ($bestmatch==null)
			return strip_tags(trim($item->get_description()));
		echo "Match Percentile: ".$bestpercentile."<br>";
		return innerHTML($bestmatch);
	}
	
	function processNode($node,$description) {
		$nodedesc = str_split(innerHTML($node),strlen($description));
		similar_text(strip_tags(trim($description)),$nodedesc[0],$percent);
		if ($percent>$bestpercentile) {
			$bestpercentile = $percent;
			$bestmatch = $node;
		}
		foreach ($node->childNodes as $child)
			processNode($child,$description);
	}
	
	$feeds = array('http://rss.slashdot.org/Slashdot/slashdot');
	foreach ($feeds as $feed) {
		$feed = processFeed('http://rss.slashdot.org/Slashdot/slashdot');
		
		foreach ($feed->get_items() as $item) {
			echo "<br><br><br><b>-Short-</b><br>";
			echo strip_tags($item->get_description());
			echo "<br><b>-Long-</b><br>";
			echo processItem($item);
		}
		echo "<br><hr><br>";
	}
	die("Reached EOF");
?>