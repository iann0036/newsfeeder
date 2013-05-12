<?php
	/*
	File name: /account/feeds/update.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Update the current feed subscriptions
	Last Modified: 11:37 PM 26/07/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	$db = new DatabaseConnection();

	$sheetid = $_POST['sheetid'];
	
	/* Remove old layout */
	$db->where('sheetid',$sheetid);
	$db->delete('cph');
	
	$cphs = array();
	
	/* Compile widget data */
	for ($i=0; $i<count($_POST['wdata']); $i++) {
	    $cphs[$i] = array(
		'sheetid' => $_POST['sheetid'],
		'wid' => $_POST['wdata'][$i]['id']
	    );
	}
	
	/* Compile left column ordering */
	for ($j=0; $j<count($_POST['leftsorting']); $j++) {
	    $search = str_replace('wid_','',$_POST['leftsorting'][$j]);
	    for ($i=0; $i<count($cphs); $i++) {
		if ($cphs[$i]['wid']==$search) {
		    $cphs[$i]['column'] = 0;
		    $cphs[$i]['order'] = $j;
		    break;
		}
	    }
	}
	
	/* Compile right column ordering */
	for ($j=0; $j<count($_POST['rightsorting']); $j++) {
	    $search = str_replace('wid_','',$_POST['rightsorting'][$j]);
	    for ($i=0; $i<count($cphs); $i++) {
		if ($cphs[$i]['wid']==$search) {
		    $cphs[$i]['column'] = 1;
		    $cphs[$i]['order'] = $j;
		    break;
		}
	    }
	}
	
	/* Insert into the database */
	for ($i=0; $i<count($cphs); $i++) {
	    if (!$_POST['wdata'][$i]['disabled']) {
		$cphid = $db->insert('cph',$cphs[$i]);
		foreach ($_POST['wdata'][$i]['feeds'] as $feedid) {
		    $data = array(
			'cphid' => $cphid,
			'feedid' => $feedid
		    );
		    $db->insert('cph_feeds',$data);
		}
		if (isset($_POST['wdata'][$i]['code'])) {
		    $data = array(
			'cphid' => $cphid,
			'location' => $_POST['wdata'][$i]['code']
		    );
		    $db->insert('cph_weather',$data);
		}
	    }
	}
?>