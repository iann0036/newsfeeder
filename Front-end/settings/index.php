<?php
	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';

	if (!User::validUser())
		trigger_error("Not logged in");
	
	$user = new User();
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('protocol',$user->getProtocol());
	if ($user->isAltDesign())
	    $gui->assign('layout','dark');
	$gui->display('root.settings.index.tpl');
?>