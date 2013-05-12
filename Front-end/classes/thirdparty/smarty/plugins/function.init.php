<?php
    /*
    File name: /classes/thirdparty/smarty/plugins/function.init.php
    Author: Ian Mckay <im607@uowmail.edu.au>
    Purpose: Initializes the generic UI elements
    Last Modified: 7:10 PM 26/03/2012
    */

    if (!defined('ROOT'))
	    define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
    require_once ROOT.'/misc/init.php';
    require_once ROOT.'/classes/User.php';
    require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';

    function smarty_function_init($params,&$smarty) {
	if (!isset($_SESSION)) // start session only if not already started
	    session_start();
	
	$user = new User();
	if ($user->validUser()) {
	    $smarty->assign('username',$user->getUsername());
	    $smarty->assign('realname',$user->getName());
	    $smarty->assign('isAdmin',$user->isAdmin());
	    $smarty->assign('notifications',$user->getNotifications());
		$smarty->assign('dark',$user->isAltDesign());
	}
    }
?>
