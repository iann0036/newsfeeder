<?php
	/*
	File name: /account/logout.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Removes all session data and redirects to home
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	
	if (User::validUser()) {
		$user = new User();
		error_log("INFO: User ".$user->getUsername()." logged out | Date: ".date('d.m.Y h:i:s')." | IP: ".$_SERVER['REMOTE_ADDR']."\n", 3, ROOT.'/logs/newsfeeder.log');
		$user->logout();
	} else
	    error_log("WARNING: Guest attempted to log out | Date: ".date('d.m.Y h:i:s')." | IP: ".$_SERVER['REMOTE_ADDR']."\n", 3, ROOT.'/logs/newsfeeder.log');
	
	
	
	header('Location: http://'.HOST.'/');
?>