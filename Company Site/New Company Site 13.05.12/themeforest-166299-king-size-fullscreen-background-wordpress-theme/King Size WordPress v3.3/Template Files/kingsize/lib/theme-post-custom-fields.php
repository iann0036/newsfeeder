<?php
/**
 * @KingSize 2011
 *
**
 * The PHP code for setup Theme post custom fields.
 */

/*
	Begin creating custom post fields 
*/
$post_postmetas = 
	array (
		/*
			Begin Post custom fields
		*/
		array("section" => "Custom Background", "id" => "kingsize_post_background",  "title" => "Custom Background" , "desc" => "Upload a custom background that overrides the default.",'extras' => 'getimage','type' => 'text'),

		array("section" => "Featured Images", "name" => "Featured Images Lightbox Options", "id" => "kingsize_featured_img_lightbox", "type" => "select", "title" => "Featured images show in lightbox", "items" => array("enable"=>"Enable Lightbox", "disable"=>"Disable Lightbox"),'desc'=>'When creating your Blog Post using the Blog Template, Enable/Disable lightbox to show image.'),
		/*
			End Post custom fields
		*/
		
	);
?>
<?php
//Apply a custom Background to this specific Post
function post_create_meta_box() {
 
	global $post_postmetas;
	if ( function_exists('add_meta_box') && isset($post_postmetas) && count($post_postmetas) > 0 ) {  
		add_meta_box( 'post_metabox', 'Kingsize Post Options', 'post_new_meta_box', 'post', 'normal', 'high' );  
	}

} 
function post_new_meta_box() {
	global $post, $post_postmetas;
	
	echo '<p style="padding:10px 0 0 0;">'.__('Want to apply a unique background to this specific post? You can upload or insert the URL of the image you want here.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';
	
	$meta_section = '';

	foreach ( $post_postmetas as $postmeta ) {

		$meta_id = $postmeta['id'];
		$meta_title = $postmeta['title'];
		
		$meta_type = '';
		if(isset($postmeta['type']))
		{
			$meta_type = $postmeta['type'];
		}
		
		if(empty($meta_section) OR $meta_section != $postmeta['section'])
		{
			$meta_section = $postmeta['section'];
			
			echo "";
		}
		$meta_section = $postmeta['section'];

		if ($meta_type == 'checkbox') {
			$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';
			echo "<input type='checkbox' name='$meta_id' id='$meta_id' value='1' $checked />";
		}
		else if ($meta_type == 'select') {
				echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';

			echo "<select name='$meta_id' id='$meta_id' style='width:75%; margin-right: 20px; float:left;'>";
			echo '<option value="">'.$meta_title.'</option>';

			if(!empty($postmeta['items']))
			{
				foreach ($postmeta['items'] as $key_item=>$item)
				{
					$kingsize_page_columns = get_post_meta($post->ID, $meta_id);
				
					if(isset($kingsize_page_columns[0]) && $key_item == $kingsize_page_columns[0])
					{
						$css_string = 'selected';
					}
					else
					{
						$css_string = '';
					}
					echo '<option value="'.$key_item.'" '.$css_string.'>'.$item.'</option>';
				
				}
			}
			
			echo "</select></p>";
		}
		else {
				//text	

			 $extras = $postmeta['extras'];

			// class here			
			$class = ' class="code"';
			if($extras == "getimage" OR $extras == "getvideo") 			 
				$class = ' class="uploadbutton"'; 
			

			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $meta_id, '" id="', $meta_id, '" value="', wp_specialchars( get_post_meta($post->ID, $meta_id, true), 1 ),'" size="30" style="width:75%; margin-right: 20px; float:left;" '.$class.'/>';
			?>

			<!-- media upload -->
			<input type="file" name="upload_<?php echo $meta_id;?>" id="upload_<?php echo $meta_id;?>" style="border:1px solid #eeeeee;width:75%; margin-right: 20px; float:left;" size="45"/>
			<input type="hidden" name="<?php echo $meta_id; ?>_noncename" id="<?php echo $meta_id; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<!-- end media upload -->

			</tr>
	<?php
		}
	}

	echo '</table>';
}

function post_save_postdata( $post_id ) {

	global $post_postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	foreach ( $post_postmetas as $postmeta ) {
	
		if ($_POST[$postmeta['id']]) {
			post_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if ($_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}

	 // file upload //		
		if ($_FILES["upload_kingsize_post_background"]["type"]){

			$special_chars = array (' ','`','"','\'','\\','/'," ","#","$","%","^","&","*","!","~","`","\"","'","'","=","?","/","[","]","(",")","|","<",">",";","\\",",");
			$filename = str_replace($special_chars,'',$_FILES['upload_kingsize_post_background']['name']);
			//$filename = time() . $filename;
			
			$directory = dirname(__FILE__) . "/images/upload/";
			$directory = str_replace("lib/","",$directory);		
			@move_uploaded_file($_FILES["upload_kingsize_post_background"]["tmp_name"],
			$directory . $filename);
			@chmod($directory . $filename, 0644);
			$uploaded_image_path = get_option('siteurl'). "/wp-content/themes/". get_option('template')."/images/upload/". $filename;

			//updating the meta value of background 
			post_update_custom_meta($post_id, $uploaded_image_path, "kingsize_post_background");

	}	
	/// ennd file upload //

}

function post_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init
add_action('admin_menu', 'post_create_meta_box'); 
add_action('save_post', 'post_save_postdata'); 

/*
	End creating custom fields
*/

?>
