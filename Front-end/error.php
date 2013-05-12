<?php
	/*
	File name: /error.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Gives users an error message if one occurs
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	
	error_log("ERROR: User redirected to error page | Date: ".date('d.m.Y h:i:s')." | IP: ".$_SERVER['REMOTE_ADDR']."\n", 3, ROOT.'/logs/newsfeeder.log');

	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->display('root.error.tpl');
?>