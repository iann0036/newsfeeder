<?php 
	/*
	File name: /members/login/index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Allows members to log in to the service
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/User.php';
	
	User::logout();
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	if ($_GET['error'])
	    $gui->assign('message',array(
		'type' => 'failure',
		'text' => 'Invalid login credentials'
	    ));
	$gui->display('root.members.login.index.tpl');
?>