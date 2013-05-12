<?php
	/*
	File name: /account/addcomment.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Inserts a comment into the database, then redirects to the Article Viewer
	Last Modified: 10:44 PM 12/01/2012
	*/

	/* This script is no longer implemented */

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	$user = new User();
		
	assert($_POST['articleid']);
	assert($_POST['comment']);
	
	$db = new DatabaseConnection();

	$articleid = $_POST['articleid'];
	$comment = $_POST['comment'];
	$avatar = 'http://'.HOST.'/misc/image.php?user='.$user->getUsername();
	
	$data = array(
	    'itemid' => $articleid,
	    'author' => $user->getName(),
	    'via' => 'News Feeder',
	    'comment' => $comment,
	    'avatar' => $avatar
	);
	$db->insert('comments', $data);
	
	header('Location: http://'.HOST.'/account/articleviewer.php?articleid='.$articleid);
?>
