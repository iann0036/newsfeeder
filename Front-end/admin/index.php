<?php
	/*
	File name: /admin/index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Page to allow administrators perform their tasks
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/UserCollection.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');

	$user = new User();
	
	if ($user->isAdmin()!=1)
	    header('Location: http://'.HOST.'/members/login/');
		
	$userdetails = new UserCollection();
	
	$users = array();
	while ($userdetails->more()) {
		$userx = $userdetails->next();
		$element = array(
		    'username' => $userx->getUsername(),
		    'name' => $userx->getName(),
		    'email' => $userx->getEmail(),
		    'admin' => $userx->isAdmin()
		);
		if ($userx->getUsername()==$user->getUsername())
		    $element['isMe'] = true;
		$users[] = $element;
	}
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('users',$users);
	$gui->display('root.admin.index.tpl');
?>