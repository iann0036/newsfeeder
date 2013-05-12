<?php
	/*
	File name: /account/removesheet.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Outputs a user image
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/User.php';
	
	$user = new User();
	
	assert($_GET['user']);

	$username = $_GET['user'];
	$db = new DatabaseConnection();
	
	$db->where('username',$username);
	$rows = $db->get('users');
	
	if ($rows[0]['picture']!=null) {
		header('Content-Type: image/jpeg');
		echo $rows[0]['picture'];
	} else
		header('Location: '.$user->getProtocol().HOST.'/images/userPic.png');
?>