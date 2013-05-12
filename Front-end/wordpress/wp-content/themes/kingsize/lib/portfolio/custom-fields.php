<?php
/*
* @KingSize 2011
** Save data when post is edited **
*/
function kingsize_portfolio_save_postdata( $post_id ) {
	global $post, $port_meta_boxes;  	
	
	if($port_meta_boxes) {
		
		foreach($port_meta_boxes as $meta_box) {  
			
			// Verify  
			if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
			return $post_id;  
			}  
		
		if ( 'page' == $_POST['post_type'] ) {  
		if ( !current_user_can( 'edit_page', $post_id ))  
		return $post_id;  
		} else {  
		if ( !current_user_can( 'edit_post', $post_id ))  
		return $post_id;  
		}  
		
		$data = $_POST[$meta_box['name'].'_value'];  
		
		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
		add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
		update_post_meta($post_id, $meta_box['name'].'_value', $data);  
		elseif($data == "")  
		delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
		}	
	}	
}
add_action('save_post', 'kingsize_portfolio_save_postdata');
?>