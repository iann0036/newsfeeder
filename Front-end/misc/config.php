<?php
	/*
	File name: /misc/config.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Set constants and configuration options for Front-End. Should be called only by init.php
	Last Modified: 10:44 AM 20/03/2012
	*/

	define('HOST','newsfeeder.co'); // Base Site URL
	define('DEFAULT_COOKIE_LENGTH','1209600'); // Length of time to keep cookies
	
	define('DB_HOST','CENSORED'); // Database Hostname
	define('DB_DATABASE','CENSORED'); // Database Name
	define('DB_USER','CENSORED'); // Database Username
	define('DB_PASS','CENSORED'); // Database User's Password
	
	define('SRVC_ADDRESS','CENSORED'); // ServiceController External Host
	define('SRVC_PORT',6373); // ServiceController External Port
	
	define('DB_TIME_OFFSET',36005); // Time offset between database and front-end host
?>