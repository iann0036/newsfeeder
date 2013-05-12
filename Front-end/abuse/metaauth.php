<?php
	/*
	File name: /abuse/metaauth.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Authentication of external webmaster via META tag authentication
	Last Modified: 11:26 PM 26/02/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/GUIMaker.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	
	$authkey = uniqid();

	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('metacontent',$authkey);
	$gui->display('root.abuse.verify.tpl');
?>