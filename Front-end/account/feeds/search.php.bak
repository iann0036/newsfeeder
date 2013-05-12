
<?php
	/*
	File name: /account/feeds/search.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Shows current results from the AJAX search
	Last Modified: 7:45 PM 10/09/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	assert($_POST['searchterm']);
	exec("/usr/bin/php /var/www/account/feeds/inner.php ".escapeshellarg(escapeshellcmd($_POST['searchterm']))." > /dev/null &"); // We need to first escape the search term to avoid shell exploitation
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('searchterm',$_POST['searchterm']);
	$gui->display('root.account.feeds.search.tpl');
?>
