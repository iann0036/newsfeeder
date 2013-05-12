<?php
	/*
	File name: /account/index.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Also known as the dashboard, this page allows you to view all of your sheets, as well as make new ones TODO: Remove echo blocks
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/GUIMaker.php';
	require_once ROOT.'/classes/UserController.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/misc/misc.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	
	/* Attempt to log in, if not already logged in */
	if (!User::validUser()) {
		if (!isset($_POST['login_username'])||!isset($_POST['login_password']))
			header('Location: http://'.HOST.'/members/login/');
		$username = $_POST['login_username'];
		$password = $_POST['login_password'];
		if (isset($_POST['remember']))
			$remember = true;
		else
			$remember = false;
		
		$accounts = new UserController();
		
		if ($accounts->login($username,$password,$remember)!=0) {
			header('Location: http://'.HOST.'/members/login/index.php?error=true');
		}
		error_log("INFO: User ".$username." logged in | Date: ".date('d.m.Y h:i:s')." | IP: ".$_SERVER['REMOTE_ADDR']."\n", 3, ROOT.'/logs/newsfeeder.log');
	}
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	/* Add the new sheet, if requested */
	if (isset($_POST['sheetname'])) {
		$sheets = new SheetCollection();
		$sheetname = $_POST['sheetname'];
		$sheets->add($sheetname);
		$gui->assign('message',array(
		    'type' => 'success',
		    'text' => 'Your sheet was successfully added'
		));
	}
	
	$sheetdata = array();
	
	$sheets = new SheetCollection();
	$parity = 0;
	while ($sheets->more()) {
		$sheet = $sheets->next();
		
		$sheetdata[] = array('<a href="/account/view.php?sheetid='.$sheet['id'].'">'.$sheet['name'].'</a>',convert_datetime($sheet['updated']),'<a href="/account/feeds/index.php?sheetid='.$sheet['id'].'"><img src="/images/pencil.png"></a> <a href="/account/feeds/edit.php?sheetid='.$sheet['id'].'">Edit</a>','<a href="#" onclick="confirmDelete(\'/account/removesheet.php?sheetid='.$sheet['id'].'\')"><img src="/images/cross.png"></a> <a href="#" onclick="confirmDelete(\'/account/removesheet.php?sheetid='.$sheet['id'].'\')">Remove</a>');
	}
	
	$gui->assign('data',$sheetdata);
	$gui->display('root.account.index.tpl');
?>