<?php
	/*
	File name: /account/import.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Imports an OPML file into a sheet, then redirects to the dashboard TODO: Integrate with other feed inserts
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/thirdparty/simplepie/simplepie.inc';
	require_once ROOT.'/classes/thirdparty/simplepie/idn/idna_convert.class.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	$db = new DatabaseConnection();
	$user = new User();
		
	assert($_POST['sheetname']);
	assert($_FILES['opml']);

	$sheetname = $_POST['sheetname'];
	$opml = $_FILES['opml'];
	
	$sheets = new SheetCollection();
	$sheetid = $sheets->add($sheetname);
	
	$xml = simplexml_load_file($opml['tmp_name']);
	for ($i=0; $i<=count($xml->body->outline); $i++) {
		$array = array($xml->body->outline[$i]);
		foreach ($array as $key) {
			var_dump($key);
			$data = array(
			    'url' => $key['xmlUrl'][0],
			    'name' => $key['title'][0],
			    'frequency' => 10
			);
			$feedid = $db->insert('feeds', $data);
			$data = array(
			    'sheetid' => $sheetid,
			    'feedid' => $feedid
			);
			$db->insert('sheetfeeds', $data);
		}
	}
	die();
	header('Location: http://'.HOST.'/account/');
?>
