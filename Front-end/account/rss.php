<?php
	/*
	File name: /account/rss.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Creates an RSS file from the items in the specified sheetid
	Last Modified: 12:09 PM 24/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/ArticleCollection.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/FeedCollection.php';
	require_once ROOT.'/classes/thirdparty/simplepie/simplepie.inc';
	require_once ROOT.'/classes/thirdparty/simplepie/idn/idna_convert.class.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	$sheets = new SheetCollection();
	$sheet = $sheets->getElementById($_GET['sheetid']);
	
	$feedarray = array();
	
	$feeds = new FeedCollection($_GET['sheetid']);
	while ($feeds->more()) {
	    $feed = $feeds->next();
	    $feedarray[] = $feed['id'];
	}
	$articles = new ArticleCollection($feedarray);
	
	header('Content-disposition: attachment; filename='.$sheet['name'].'.rss');
	header('Content-type: text/xml');
    
	echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
<channel>
	<title>'.$sheet['name'].'</title>
	<link>http://newsfeeder.co/account/view.php?sheetid='.$_GET['sheetid'].'</link>
	<description>A compilation of your favorite news items by News Feeder</description>
	<language>en-AU</language>';
	
	while ($articles->more()) {
	    $article = $articles->next();
	    echo '
    <item>
	<title>'.$article['title'].'</title>
	<description>'.$article['content'].'</description>
        <dc:creator>'.$article['feedname'].'</dc:creator>
        <link>http://'.HOST.'/account/articleviewer.php?articleid='.$article['id'].'&sheetid='.$_GET['sheetid'].'</link>
        <pubDate>'.$article['time'].'</pubDate>
    </item>';
	}
	echo '</channel>
</rss>';
?>