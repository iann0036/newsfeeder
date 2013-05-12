<?php
	/*
	File name: /abuse/index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: A public abuse reporting page
	Last Modified: 10:44 PM 26/02/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';

	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->display('root.abuse.index.tpl');
?>