<?php
	/*
	File name: /misc/censor.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Provides functionality to censor inappropriate words
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	
	function censor($body) {
		$db = new DatabaseConnection();
		
		$rows = $db->get('censor');
		foreach ($rows as $row)
			$body = replacebadword($body,$row['word']);
		
		return $body;
	}
	
	function replacebadword($body, $word) {
		$position = stripos($body, $word);
		
		while ($position!==false) {
			if (!ctype_alpha($body[$position-1]) && !ctype_alpha($body[$position+strlen($word)]))
				$body = substr($body,0,$position).'<img src="/images/censored.gif">'.substr($body,$position+strlen($word));
			$position = stripos($body, $word, $position+1);
		}
		
		return $body;
	}
?>