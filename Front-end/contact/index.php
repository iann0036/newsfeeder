<?php
	/*
	File name: /contact/index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Page to allow users to send a message or view contact details
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	
	if (isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['message'])) {
	    if (!mail('feedback@'.HOST,'News Feeder Feedback','Message Sent
------------
'.strip_tags($_POST['message']),'From: '.$_POST['name'].' <'.$_POST['email'].'>'))
			header('Location: http://'.HOST.'/error.php?mailerror');
	}

	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->display('root.contact.index.tpl');
?>