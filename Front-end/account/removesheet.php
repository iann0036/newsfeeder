<?php
	/*
	File name: /account/removesheet.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Calls the remove sheet method then redirects to the dashboard
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	assert($_GET['sheetid']);
	
	$sheets = new SheetCollection();
	$sheets->remove($_GET['sheetid']);
	
	header('Location: http://'.HOST.'/account/');
?>