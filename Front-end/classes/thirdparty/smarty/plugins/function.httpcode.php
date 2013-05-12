<?php
    /*
    File name: /classes/thirdparty/smarty/plugins/function.httpcode.php
    Author: Ian Mckay <im607@uowmail.edu.au>
    Purpose: Gives the HTTP response code to Smarty
    Last Modified: 2:10 PM 29/03/2012
    */

    if (!defined('ROOT'))
	    define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
    require_once ROOT.'/misc/init.php';
    require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';

    function smarty_function_httpcode($params,&$smarty) {
	return $GLOBALS['http_response_code'];
    }
?>
