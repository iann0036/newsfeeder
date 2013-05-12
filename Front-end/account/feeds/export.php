<?php
	/*
	File name: /account/export.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Export a sheet to OPML format
	Last Modified: 12:06 PM 20/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/FeedCollection.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	$sheets = new SheetCollection();
	$sheet = $sheets->getElementById($_GET['sheetid']);

	$feeds = new FeedCollection($_GET['sheetid']);
	
	$output = '<?xml version="1.0" encoding="UTF-8"?>
<opml version="1.0">
    <head>
        <title>'.$sheet['name'].' - Exported from News Feeder</title>
    </head>
    <body>';
	
	while ($feeds->more()) {
	    $feed = $feeds->next();
	    if ($feed['enabled'])
		$output.='        <outline text="'.$feed['name'].'" title="'.$feed['name'].'"
            type="rss" xmlUrl="'.$feed['url'].'" htmlUrl="'.$feed['url'].'"/>
';
	}
	
	$output.='    </body>
</opml>';
	
	header('Content-disposition: attachment; filename='.$sheet['name'].'.opml');
	header('Content-type: text/xml');
	
	echo $output;
?>
