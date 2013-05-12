<?php
	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/User.php';
	
	$user = new User();
	
	if (!$user->validUser())
		trigger_error("Not logged in");
	
	$db = new DatabaseConnection();
	
	if (isset($_POST['ssl']))
	    $protocol = 1;
	else
	    $protocol = 0;
	
	if (isset($_POST['layout']))
	    $layout = 1;
	else
	    $layout = 0;
	
	$data = array(
	    'https' => $protocol,
	    'layout' => $layout
	);
	
	$db->where('username',$user->getUsername());
	$db->update('users', $data);
	
	header('Location: http://'.HOST.'/settings/');
?>
