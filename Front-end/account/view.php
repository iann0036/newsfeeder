<?php
	/*
	File name: /account/view.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Views a sheet with all of it's articles
	Last Modified: 10:44 PM 12/01/2012
	*/
	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/GUIMaker.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/ArticleCollection.php';
	require_once ROOT.'/misc/misc.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/CPHCollection.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
		
	if (!isset($_GET['sheetid']))
	    header('Location: http://'.HOST.'/error.php');
	
	$sheets = new SheetCollection();
	$sheet = $sheets->getElementById($_GET['sheetid']);
	
	$user = new User();
	$sheets->removeNotification($user->getUsername(),$_GET['sheetid']); // Remove notification, if it exists
	
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
	
	$gui->assign('sheetname',$sheet['name']);
	$gui->assign('sheetid',$sheet['id']);
	$gui->assign('cphs',$cph_data);
	
	$gui->display('root.account.view.tpl');
?>