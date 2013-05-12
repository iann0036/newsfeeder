<?php
	/*
	File name: /account/feeds/index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Displays current feeds for the sheet and allows the user to navigate to add or remove other feeds
	Last Modified: 12:06 PM 20/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT'])); 
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/FeedCollection.php';
	require_once ROOT.'/classes/CPHCollection.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	assert($_GET['sheetid']);
	
	$db = new DatabaseConnection();

	$sheets = new SheetCollection();
	$sheet = $sheets->getElementById($_GET['sheetid']);
	
	$feeds = new FeedCollection($_GET['sheetid']);
	$feeds_array = array();
	while ($feeds->more()) {
	    $feeds_array[] = $feeds->next();
	}
	
	$cph_data = array();
	$cphs = new CPHCollection($_GET['sheetid']);
	while ($cphs->more()) {
	    $cph = $cphs->next();
	    $cph_data[] = $cph;
	}
	
	/* Sort the CPH's */
	function cphsort($a, $b) {
	    if ($a['column']!=$b['column'])
		return ($a['column'] > $b['column']);
	    return ($a['order'] > $b['order']);
	}
	for ($i=0; $i<count($cph_data); $i++)
	    uksort($cph_data[$i],"cphsort");
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('sheetid',$_GET['sheetid']);
	$gui->assign('feeds',$feeds_array);
	$gui->assign('cphs',$cph_data);
	$gui->display('root.account.feeds.edit.tpl');
?>