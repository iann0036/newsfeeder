<?php
/**
 * @KingSize 2011
 **/
// one third div
add_shortcode('one_third', 'one_third');
function one_third( $atts, $content = null ) { 
    return '<div class="one_third">'.do_shortcode($content).'</div>';  
}  


// one third div last
add_shortcode('one_third_last', 'one_third_last');
function one_third_last( $atts, $content = null ) {  
   return '<div class="one_third right">'.do_shortcode($content).'</div>';  
}  


//two thirds div
add_shortcode('two_thirds', 'two_thirds');
function two_thirds( $atts, $content = null ) { 
    return '<div class="two_thirds">'.do_shortcode($content).'</div>';  
}  

//two thirds div last
add_shortcode('two_thirds_last', 'two_thirds_last');
function two_thirds_last( $atts, $content = null ) {  
    return '<div class="two_thirds right">'.do_shortcode($content).'</div>
     <div class="clearboth"></div>';  
}  

//img_floated_left image
add_shortcode('img_floated_left', 'img_floated_left');
function img_floated_left( $atts, $content = null ) {
	extract(shortcode_atts(array(  
	 "src" => 'http://www.kingsizetheme.com/wp-content/themes/kingsize/images/gallery/thumbs/3column.jpg',
	 "alt" => ''	
	), $atts));  
    return '<img class="img_floated_left"  src="'.$src.'"  alt="'.$alt.'"/>';  
}  

//img_floated_right image
add_shortcode('img_floated_right', 'img_floated_right');
function img_floated_right( $atts, $content = null ) {
	extract(shortcode_atts(array(  
	 "src" => 'http://www.kingsizetheme.com/wp-content/themes/kingsize/images/gallery/thumbs/3column.jpg',
	 "alt" => ''	
	), $atts));  
    return '<img class="img_floated_right"  src="'.$src.'"  alt="'.$alt.'"/>';  
} 

//button
add_shortcode('button', 'button');
function button($atts, $content = null) {  
     extract(shortcode_atts(array(  
         "to" => '#',
         "color" => 'black'  
     ), $atts));  
     return '<a class="button '.$color.'" href="'.$to.'">'.$content.'</a>';  
 }  


// info box
add_shortcode('info_box', 'info_box');
function info_box($atts, $content = null) {  
     return '<div class="message_box info_box">
<p class="message_box_sign info_box_sign">Info</p>
'.do_shortcode($content).'
</div>';
}  


// warning box
add_shortcode('warning_box', 'warning_box');
function warning_box($atts, $content = null) {  
     return '<div class="message_box warning_box">
<p class="message_box_sign warning_box_sign">Warning</p>
'.do_shortcode($content).'
</div>';
}  

// error box
add_shortcode('error_box', 'error_box');
function error_box($atts, $content = null) {  
     return '<div class="message_box error_box">
<p class="message_box_sign error_box_sign">Error</p>
'.do_shortcode($content).'
</div>';
} 


// download box
add_shortcode('download_box', 'download_box');
function download_box($atts, $content = null) {  
     return '<div class="message_box download_box">
<p class="message_box_sign download_box_sign">Download</p>
'.do_shortcode($content).'
</div>';
} 


// blockquote
add_shortcode('blockquote', 'blockquote');
function blockquote( $atts, $content = null ) {  
    return '<blockquote>'.do_shortcode($content).'</blockquote>';  
} 

//tooltip_link
add_shortcode('tooltip_link', 'tooltip_link');
function tooltip_link($atts, $content = null) {  
     extract(shortcode_atts(array(  
         "title" => '',
         "to" => '#'  
     ), $atts));  
     return '<a class="tooltip_link" title="'.$title.'"  href="'.$to.'">'.$content.'</a>';  
	
 }  
