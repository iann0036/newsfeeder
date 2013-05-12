<?php
	/*
	File name: /misc/init.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Set custom error handling, may also be used for user hit tracking in the future. Should be called in every other script.
	Last Modified: 10:44 AM 20/03/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/config.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/UserController.php';

	/* Error Handling */
	// Active assert and make it quiet
	assert_options(ASSERT_ACTIVE, 1);
	assert_options(ASSERT_WARNING, 0); // TODO: Are these correct?
	assert_options(ASSERT_QUIET_EVAL, 1);
	
	function assertHandler($file, $line, $code) {
		// TODO:
		echo "Assert Fail";
		die(var_dump(debug_backtrace()));
	}
	
	function errorHandler($errno, $errstr, $errfile, $errline) {
		if ($errno==E_ERROR) {
		    echo "<b>!Error!</b><br>Error No: ".$errno."<br>Error String: ".$errstr."<br>Error File: ".$errfile."<br>Error Line: ".$errline;
		    die(var_dump(debug_backtrace()));
		}
	}
	
	$errorHandler = set_error_handler('errorHandler'); // Sends most errors through the custom error handlers
	assert_options(ASSERT_CALLBACK, 'assertHandler'); //
	
	function checkSSLStatus() {
	    if (!isset($_SESSION)) // start session only if not already started
		    session_start();
	    if (User::validUser()) {
		$user = new User();
		if ($user->getProtocol()=='https://' && $_SERVER['HTTPS']!="on")
		    header("Location: https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	    } else {
		$accounts = new UserController();
		$accounts->checkCookie();
	    }
	}
	checkSSLStatus();
?>