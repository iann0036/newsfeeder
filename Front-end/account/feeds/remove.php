<?php
	/*
	File name: /account/feeds/ajax.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Removes the selected sheet then redirects to dashboard
	Last Modified: 12:06 PM 20/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT'])); 
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/UserFeedCollection.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	assert($_GET['feedid']);
	
	$feeds = new UserFeedCollection();
	$feeds->removeFeed($_GET['feedid']);
	
	header('Location: http://'.HOST.'/account/feeds/index.php');
?>