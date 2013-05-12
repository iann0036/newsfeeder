<?php
	/*
	File name: /admin/servicecall.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Sends calls 
	Last Modified: 2:44 PM 24/04/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/classes/ServiceSocket.php';
	require_once ROOT.'/classes/User.php';

	$user = new User();
	
	if (!$user->isAdmin())
		trigger_error("Not logged in");
	
	$ssocket = new ServiceSocket(SRVC_ADDRESS,SRVC_PORT);
	
	$ssocket->sendMessage("admin");
	if ($ssocket->getResponse()=="pass") {
	    $ssocket->sendMessage("nfrd");
	    if ($ssocket->getResponse()=="success") {
		$command = $_GET['command'];
		if ($command=="status")
		    $ssocket->sendMessage("status crawler");
		else if ($command=="start")
		    $ssocket->sendMessage("crawler start");
		else if ($command=="stop")
		    $ssocket->sendMessage("crawler stop");
		else if ($command=="restart") {
		    $ssocket->sendMessage("crawler stop");
		    $ssocket->getResponse();
		    $ssocket->sendMessage("crawler start");
		}
		echo $ssocket->getResponse();
	    } else
		echo "fail auth";
	    $ssocket->sendMessage("quit");
	} else
	    echo "fail connect";
?>
