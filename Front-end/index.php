<?php
	/*
	File name: /index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides an overview of the service and provides statistics
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/Stats.php';
	
	$stats = new Stats();
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
		
	$gui->assign('stats',array(
	    'curr_users' => $stats->getUserCount(),
	    'curr_sheets' => $stats->getSheetCount(),
	    'curr_feeds' => $stats->getFeedCount(),
	    'curr_items' => $stats->getItemCount(),
	    'curr_comments' => $stats->getCommentCount(),
	    'prev_users' => $stats->getPrevUserCount(),
	    'prev_sheets' => $stats->getPrevSheetCount(),
	    'prev_feeds' => $stats->getPrevFeedCount(),
	    'prev_items' => $stats->getPrevItemCount(),
	    'prev_comments' => $stats->getPrevCommentCount()
	));
	$gui->display('root.index.tpl');
?>