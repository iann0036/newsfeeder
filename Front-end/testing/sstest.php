<?php
	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/ServiceSocket.php';
	
	$ssocket = new ServiceSocket('192.0.43.10',80);
		
	$ssocket->sendMessage('GET / HTTP/1.0\r\nHost: www.example.com\r\nAccept: */*\r\n');
	
	var_dump($ssocket->getResponse());
?>
