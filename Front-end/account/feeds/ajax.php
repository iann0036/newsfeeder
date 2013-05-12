<?php
	/*
	File name: /account/feeds/ajax.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Initiates asynchronous search and updates page with current results
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT'])); 
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	$memcache = new Memcache;
	$memcache->connect("127.0.0.1", 11211) or trigger_error("Memcache Connection Failure");
	
	$feeds = $memcache->get(md5($_GET['searchterm'])); // The MD5 of the search term will be used as the key for the storage of results
	
	foreach ($feeds as $feed) {
	    echo '<div class="aresult"><div class="resultbutton"><a href="/account/feeds/new.php?url='.urlencode($feed['url']).'&title='.urlencode($feed['title']).'" title="" class="btnIconLeft"><img src="/images/icons/dark/add.png" alt="" class="icon" /><span>Add</span></a></div><div class="resultinfo"><h4>'.$feed['title'].'</h4><i>'.$feed['description'].'</i></div><br style="clear:both" /></div><hr />';
	}
	if (is_array($feeds)) {
		echo "<br /><b>Returned ".count($feeds)." results</b>";
	} else
		echo "<br /><b>Could not find what you were looking for. Please refine your search.</b>";
?>
