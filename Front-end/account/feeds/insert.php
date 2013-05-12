<?php
	/*
	File name: /account/feeds/insert.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Inserts link between sheet and feed into the database, then redirects back to the Sheet View
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
		
	assert($_GET['sheetid']);
	assert($_GET['feedid']);
	assert($_GET['crawl']);
	
	$db = new DatabaseConnection();

	$sheetid = $_GET['sheetid'];
	$feedid = $_GET['feedid'];
	$amount = $_GET['crawl'];
	if (isset($_GET['adult']))
		$adultfilter = 1;
	else
		$adultfilter = 0;
	
	$data = array(
		'sheetid' => $sheetid,
		'feedid' => $feedid,
		'amount' => $amount,
		'adultfilter' => $adultfilter
	);
	$db->insert('sheetfeeds', $data);
	
	header('Location: http://'.HOST.'/account/view.php?sheetid='.$sheetid);
?>