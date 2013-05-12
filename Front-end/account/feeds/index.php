<?php
	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/UserFeedCollection.php';

	if (!User::validUser())
		trigger_error("Not logged in");
	
	$feeds = new UserFeedCollection();
	$feeddata = array();
	
	while ($feeds->more()) {
		$feed = $feeds->next();
		$feeddata[] = array($feed['name'],'<a href="'.$feed['url'].'">'.$feed['url'].'</a>','<a href="#" onclick=confirmDelete("/account/feeds/remove.php?feedid='.$feed['id'].'")><img src="/images/cross.png"></a> <a href="#" onclick="confirmDelete(\'/account/feeds/remove.php?feedid='.$feed['id'].'\')">Remove</a>');
	}
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('data',$feeddata);
	$gui->display('root.account.feeds.index.tpl');
?>