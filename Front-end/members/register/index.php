<?php
	/*
	File name: /members/register/index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Allows new members to register for the service
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/UserController.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$photo = $_FILES['photo'];
		if ($name!=""&&$username!=""&&$password!=""&&$email!="") {
			$accounts = new UserController();
			$accounts->register($name,$username,$password,$email,$photo);
			header('Location: http://'.HOST.'/account/');
		} else
			header('Location: http://'.HOST.'/error.php?error=regfields');
	}

	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->display('root.members.register.index.tpl');
?>