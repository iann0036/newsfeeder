<?php
	/*
	File name: /admin/config.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Page to allow administrators to change config options
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/User.php';

	$user = new User();
	
	if (!$user->isAdmin())
		trigger_error("Not logged in");
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->display('root.admin.config.tpl');
?>