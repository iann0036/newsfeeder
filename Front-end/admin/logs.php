<?php
	/*
	File name: /admin/logs.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Represents log files
	Last Modified: 2:46 PM 17/09/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/User.php';

	$user = new User();
	
	if (!$user->isAdmin())
		trigger_error("Not logged in");
?>
<html>
    <head>
	<style>
	body { margin: 0; padding: 0; font-size: 12px; color: #424242; font-family: Arial, Helvetica, sans-serif; line-height: 20px; min-height: 100%; position: relative; }
	</style>
    </head>
    <body>
	<b>
<?php
	$file = fopen(ROOT."/logs/newsfeeder.log", "r") or exit("Unable to open log file!");
	while(!feof($file)) {
	    $error = fgets($file);
	    $type = substr($error,0,strpos($error,":"));
	    if ($type=="ERROR")
		echo "<font color='#FF0011'>";
	    else if ($type=="WARNING")
		echo "<font color='#FF6611'>";
	     else if ($type=="INFO")
		echo "<font color='#3300CC'>";
	    else
		echo "<font color='#EEEEEE'>";
	    echo $error."</font><br />";
	}
	fclose($file);
?>
	</b>
    </body>
</html>