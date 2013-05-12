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
	
	if (!User::validUser())
		trigger_error("Not logged in");
		
	if (!isset($_GET['sheetid']))
		header('Location: http://'.HOST.'/error.php');
	
	$sheets = new SheetCollection();
	$sheet = $sheets->getElementById($_GET['sheetid']);
	
	$user = new User();
	$sheets->removeNotification($user->getUsername(),$_GET['sheetid']); // Remove notification, if it exists

	$articles = new ArticleCollection($_GET['sheetid']);
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('sheetname',$sheet['name']);
	$gui->assign('sheetid',$sheet['id']);
	$article_data = array();
	while ($articles->more()) {
	    $article = $articles->next();
	    $article['time'] = convert_datetime($article['time']);
	    $article_data[] = $article;
	}
	$gui->assign('articles',$article_data);
	$gui->display('root.account.view.tpl');
?>