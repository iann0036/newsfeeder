<?php
    /*
    File name: /classes/thirdparty/smarty/plugins/block.form.php
    Author: Ian Mckay <im607@uowmail.edu.au>
    Purpose: Generates HTML for a form
    Last Modified: 1:34 PM 27/03/2012
    */

    function smarty_block_form($params, $content, Smarty_Internal_Template $template, &$repeat) {
	if (!$repeat)
	    return '<form action="'.$params['action'].'" method="'.$params['method'].'" enctype="'.$params['enctype'].'" class="mainForm" onSubmit="'.$params['onsubmit'].'"><fieldset>'.$content.'</fieldset></form>';
    }
?>
