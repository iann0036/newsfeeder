<?php
    /*
    File name: /classes/thirdparty/smarty/plugins/block.right_widgets.php
    Author: Ian Mckay <im607@uowmail.edu.au>
    Purpose: Generates HTML for the right widget column
    Last Modified: 10:16 AM 27/03/2012
    */

    function smarty_block_right_widgets($params, $content, Smarty_Internal_Template $template, &$repeat) {
	if (!$repeat)
	    return '<div class="right">'.$content.'<div class="fix"></div></div></div>';
    }
?>
