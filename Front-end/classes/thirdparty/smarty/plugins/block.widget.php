<?php
    /*
    File name: /classes/thirdparty/smarty/plugins/block.widget.php
    Author: Ian Mckay <im607@uowmail.edu.au>
    Purpose: Generates HTML for a widget block
    Last Modified: 10:34 PM 26/03/2012
    */

    function smarty_block_widget($params, $content, Smarty_Internal_Template $template, &$repeat) {
	if (!$repeat) {
	    $return = '        <div class="widget">';
	    if (!$params['nohead']) {
		$return.='<div class="head"><h5 class="'.$params['class'].'">'.$params['title'].'</h5>';
		if ($params['num'])
		    $return.='<div class="num"><a href="#" class="'.$params['numclass'].'">'.$params['num'].'</a></div>';
		$return.='</div>
            ';
	    }
	    if (!$params['nobody'])
		$return.='<div class="body">'.$content.'
            </div>';
	    else
		$return.=$content;
	    $return.='
        </div>';
	    
	    return $return;
	}
    }
?>
