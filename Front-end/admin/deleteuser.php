<?php
	/*
	File name: /admin/deleteuser.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Removes the selected user then redirects to admin page
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT'])); 
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/DatabaseConnection.php';

	$user = new User();
	
	if (!$user->isAdmin())
		trigger_error("Not logged in");
		
	assert($_GET['username']);
	
	$db = new DatabaseConnection();
	
	$db->where('username',$_GET['username']);
	$db->delete('users');
	
	header('Location: http://'.HOST.'/admin/');
?>