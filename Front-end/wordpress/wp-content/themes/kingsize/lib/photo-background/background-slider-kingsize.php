<?php
/*
Module Name: Photo background Slider
*/

/* GLOBAL SETTINGS */
global $wpdb;
define('ALBUM_TABLE', $wpdb->prefix . 'kingsize_albums');
define('PHOTO_TABLE', $wpdb->prefix . 'kingsize_photos');
$_GET['edit_id'] = 1;

/* FORM SECURITY */
if ( !function_exists('wp_nonce_field') ) {
        function kingsize_nonce_field($action = -1) { return; }
        $kingsize_nonce = -1;
} else {
		function kingsize_nonce_field($action = -1,$name = 'kingsize-update-check') { return wp_nonce_field($action,$name); }
		define('kingsize_NONCE' , 'kingsize-update-check');
}

// does the initial setup
function kingsize_slider_setup() {
	global $wpdb;
	
	$create_albums = "CREATE TABLE " . ALBUM_TABLE . " (id bigint(20) NOT NULL auto_increment, name text NOT NULL, description text NOT NULL, a_order smallint(5) unsigned NOT NULL, main_photo bigint(20) NOT NULL, PRIMARY KEY  (id) )";

	$create_photos = "CREATE TABLE " . PHOTO_TABLE . " (id bigint(20) NOT NULL auto_increment, album bigint(20) NOT NULL, ext tinytext NOT NULL, name text NOT NULL, description longtext NOT NULL, p_order smallint(5) unsigned NOT NULL default '0', PRIMARY KEY  (id) )";


	if($wpdb->get_var("SHOW TABLES LIKE '" . ALBUM_TABLE . "'") != ALBUM_TABLE) {
		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
		dbDelta($create_albums);
		kingsize_add_album();
	}

	if($wpdb->get_var("SHOW TABLES LIKE '" . PHOTO_TABLE . "'") != PHOTO_TABLE) {
		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
		dbDelta($create_photos);
	}
	
	update_option('kingsize_thumbsize', '130');

}
/* END SETUP */


/* ADMIN MENU */
function kingsize_add_admin() {
	$level = get_option('kingsize-accesslevel');
	if (empty($level)) { $level = 'level_10'; }
	
	add_menu_page('KingSize Background Slider', 'Background Slider', $level, __FILE__, 'kingsize_admin');
	
    add_submenu_page(__FILE__, 'Upload Photos', 'Upload Photos', $level, 'upload_photos', 'kingsize_page_upload');  
}


//add_action('admin_menu', 'kingsize_add_admin');


/* ADMIN PAGES */
function kingsize_page_upload() {
		global $wpdb;

		// warn if the uploads directory is no writable
		if (!is_writable(ABSPATH . 'wp-content/uploads')) { echo '<div id="error" class="error"><p><strong>Warning:</strong> The uploads directory does not exist or is not writable by the server. Please make sure that <tt>wp-content/uploads/</tt> is writeable by the server</p></div>'; }
	

		// upload images
		if (isset($_POST['kingsize-upload'])) {
			check_admin_referer( '$kingsize_nonce', kingsize_NONCE );
			kingsize_upload_photos();
		}		
		
		// deletes the image
		if (isset($_GET['photo_del'])) {

			$ext = $wpdb->get_var("SELECT ext FROM " . PHOTO_TABLE . " WHERE id={$_GET['photo_del']}");
			@unlink(ABSPATH . 'wp-content/uploads/background/' . $_GET['photo_del'] . '.' . $ext);
			@unlink(ABSPATH . 'wp-content/uploads/background/thumbs/' . $_GET['photo_del'] . '.' . $ext);
			
			$wpdb->query("DELETE FROM " . PHOTO_TABLE . " WHERE id={$_GET['photo_del']} LIMIT 1");
			
			echo '<div id="message" class="updated fade"><p><strong>Photo Deleted.</strong></p></div>';
		}	

		echo '<div class="wrap">';
		echo '<h2>Manage Background Slider Photos</h2>';
		echo "<h3>Upload Photos</h3><br />";
		
		// chek if albums exist before allowing upload
		
		if(kingsize_has_albums()) {

			echo '
			<form enctype="multipart/form-data" action="' . get_option('siteurl') . '/wp-admin/admin.php?page=upload_photos" method="post">
			';
			
			kingsize_nonce_field('$kingsize_nonce', kingsize_NONCE);
			
			echo '
			<input id="my_file_element" type="file" name="file_1" />
		
			<div id="files_list">
				<h3>Selected Files: <small>You can upload up to 10 photos at once</small></h3>
			</div>';

			echo '<input name="kingsize-album" type="hidden" id="kingsize-album" value="1"/>';
		
			echo '<input type="submit" name="kingsize-upload" value="Upload Photos" />
			</form>
		<br />
		<script type="text/javascript">
			<!-- Create an instance of the multiSelector class, pass it the output target and the max number of files -->
			var multi_selector = new MultiSelector( document.getElementById( \'files_list\' ), 10 );
			<!-- Pass in the file element -->
			multi_selector.addElement( document.getElementById( \'my_file_element\' ) );
		</script>';
		
		} else {
			echo '<p>No albums exist. You must <a href="admin.php?page=wp-photo-album/background-slider-kingsize.php">create one</a> beofre you can upload your photos.</p>';
		}
	
		echo '</div>';
		
		//////Sorting Result Container//////////
		echo '<div id="contentRight">
				  <p>For sorting the order of the image. Please drag and sort.</p>				  
			  </div>';
		////////////////////////////

		echo kingsize_album_photos($_GET['edit_id']);
}


// get photo edit list for albums
function kingsize_album_photos($id) {
	global $wpdb;
	$photos = $wpdb->get_results("SELECT * FROM " . PHOTO_TABLE . " WHERE album=$id ORDER BY p_order ASC", 'ARRAY_A');
	if (empty($photos)) {
		return "<p>No photos yet in this album.</p>";
	} else {

		echo '<div id="contentLeft">';
		echo '<ul>';
				foreach ($photos as $photo) {
					echo '<li id="recordsArray_'.$photo['id'].'">';

						echo '<img src="' . get_bloginfo('wpurl') . '/wp-content/uploads/background/thumbs/' . $photo['id'] . '.' . $photo['ext'] . '" alt="' . $photo['name'] . '" height="90px"/>';
					
						echo '<input type="hidden" name="photos[' . $photo['id'] . '][name]" value="' . $photo['name'] . '" />';				
						echo '<input type="hidden" name="photos[' . $photo['id'] . '][id]" value="1" />';
						echo '<input type="hidden" name="photos[' . $photo['id'] . '][id]" value="' . $photo['id'] . '" />';
						
						echo '<p><a href="' . get_option('siteurl') . '/wp-admin/admin.php?page=upload_photos&amp;photo_del=' . $photo['id'] . '" class="deletelink" onclick="return confirm(\'Are you sure you want to delete this photo?\')">Delete</a></p>';
						
					echo '</li>';
				}
		echo '</ul>';
		echo '</div>';
	}
}

// check if albums exist
function kingsize_has_albums() {
	global $wpdb;	
	$albums = $wpdb->get_results("SELECT * FROM " . ALBUM_TABLE, 'ARRAY_A');
	if (empty($albums)) {
		return FALSE;
	} else {
		return TRUE;
	}
}


// get select form element listing albums 
function kingsize_album_select($exc = '', $sel = '') {
	global $wpdb;
	$albums = $wpdb->get_results("SELECT * FROM " . ALBUM_TABLE, 'ARRAY_A');
	
	foreach ($albums as $album) {
		if ($sel == $album['id']) { $selected = ' selected="selected" '; } else { $selected = ''; }
		if ($album['id'] != $exc) {
			$result .= '<option value="' . $album['id'] . '"' . $selected . '>' . $album['name'] . '</option>';
		}
	}
	return $result;
}

// add an album 
function kingsize_add_album() {
	global $wpdb;

	$name = "background";
	$desc = "background image slider";
	
	if (!empty($name)) {
		$wpdb->query("INSERT INTO " . ALBUM_TABLE . " (id, name, description, a_order) VALUES (0, '$name', '$desc', '$order')");
	} 
}

// edit an album 
function kingsize_edit_album() {
	global $wpdb;	

	$main = $_POST['kingsize-main'];
		
	// update the photo information
	foreach ($_POST['photos'] as $photo) {
		$query = "UPDATE " . PHOTO_TABLE . " SET name='{$photo['name']}', album={$photo['album']}, description='{$photo['description']}' WHERE id={$photo['id']} LIMIT 1";
		$wpdb->query($query);
	}	

}

// Upload photos 
function kingsize_upload_photos() {
	global $wpdb;
	
	$kingsize_dir = ABSPATH . 'wp-content/uploads/background';
	
	// check if background dir exists
	if (!is_dir($kingsize_dir)) {
		mkdir($kingsize_dir);
	}
	
	
	// check if thumbs dir exists 
	if (!is_dir($kingsize_dir . '/thumbs')) {
		mkdir($kingsize_dir . '/thumbs');
	}
	
	foreach ($_FILES as $file) {
		//if (getimagesize($file['tmp_name'])) {
			//print_r($file);
		if ($file['error']==0) {
			$ext = substr(strrchr($file['name'], "."), 1);
		
			$query = "INSERT INTO " . PHOTO_TABLE . " (id, album, ext, name, description) VALUES (0, {$_POST['kingsize-album']}, '$ext', '{$file['name']}', '')";
			$wpdb->query($query);
			//echo $query;
			$image_id = $wpdb->get_var("SELECT LAST_INSERT_ID()");
			
			$query_update_order = "UPDATE " . PHOTO_TABLE . " SET p_order='{$image_id}' WHERE id={$image_id} LIMIT 1";
			$wpdb->query($query_update_order);

			$newimage = $kingsize_dir . '/' . $image_id . '.' . $ext;
			copy($file['tmp_name'], $newimage);

			if (is_file ($newimage)) {
				$uploaded_a_file = TRUE;
				if (is_numeric(get_option('kingsize_thumbsize'))) {
					$thumbsize = get_option('kingsize_thumbsize');
				} else {
					$thumbsize = 130;
				}
				
				kingsize_create_thumbnail($newimage, $thumbsize, '' );
			} 
		}
	}
	
	if ($uploaded_a_file) { echo '<div id="message" class="updated fade"><p><strong>Photos Uploaded.</strong></p></div>'; }

}


/* Add Javascript to page head */
global $pagenow;
if($pagenow == "admin.php" && $_GET["page"]=="upload_photos"):  //checking the if page is background slider admin
	add_action('admin_head', 'kingsize_admin_head');
endif;

function kingsize_admin_head() {
 	echo '<script type="text/javascript" src="' . get_template_directory_uri() .'/lib/photo-background/multifile_compressed.js"></script>
 	<link rel="stylesheet" href="' .  get_template_directory_uri() .'/lib/photo-background/admin_styles.css" type="text/css" media="screen" />
	';
	
	////////////////// FOR SORTING ////////////////////
		echo '<script type="text/javascript" src="' . get_template_directory_uri() .'/lib/photo-background/jquery-ui-1.7.1.custom.min.js"></script>
		<link rel="stylesheet" href="' .  get_template_directory_uri() .'/lib/photo-background/sorting.css" type="text/css" media="screen" />
		';


	echo '<script type="text/javascript">'.
		'jQuery(document).ready(function($){ 							   
			$(function() {				
				$("#contentLeft ul").sortable({ opacity: 0.6, cursor: \'move\', update: function() {
					var order = $(this).sortable("serialize") + \'&action=updateRecordsListings\'; 
					$.post("'.get_template_directory_uri().'/lib/photo-background/updateDB.php", order, function(theResponse){
						$("#contentRight").html(theResponse);
					}); 															 
				}								  
				});
			});

		});	
		</script>';
	////////////////// END FOR SORTING ////////////////////
}




/* create thubmnail - slightly modified  and renamed wordpress core function */
function kingsize_create_thumbnail( $file, $max_side, $effect = '' ) {

		// 1 = GIF, 2 = JPEG, 3 = PNG

	if ( file_exists( $file ) ) {
		$type = getimagesize( $file );
		// if the associated function doesn't exist - then it's not
		// handle. duh. i hope.

		if (!function_exists( 'imagegif' ) && $type[2] == 1 ) {
			$error = __( 'Filetype not supported. Thumbnail not created.' );
		}
		elseif (!function_exists( 'imagejpeg' ) && $type[2] == 2 ) {
			$error = __( 'Filetype not supported. Thumbnail not created.' );
		}
		elseif (!function_exists( 'imagepng' ) && $type[2] == 3 ) {
			$error = __( 'Filetype not supported. Thumbnail not created.' );
		} else {

			// create the initial copy from the original file
			if ( $type[2] == 1 ) {
				$image = imagecreatefromgif( $file );
			}
			elseif ( $type[2] == 2 ) {
				$image = imagecreatefromjpeg( $file );
			}
			elseif ( $type[2] == 3 ) {
				$image = imagecreatefrompng( $file );
			}

			if ( function_exists( 'imageantialias' ))
				imageantialias( $image, TRUE );

			$image_attr = getimagesize( $file );

			// figure out the longest side

			if ( $image_attr[0] > $image_attr[1] ) {
				$image_width = $image_attr[0];
				$image_height = $image_attr[1];
				$image_new_width = $max_side;

				$image_ratio = $image_width / $image_new_width;
				$image_new_height = $image_height / $image_ratio;
				//width is > height
			} else {
				$image_width = $image_attr[0];
				$image_height = $image_attr[1];
				$image_new_height = $max_side;

				$image_ratio = $image_height / $image_new_height;
				$image_new_width = $image_width / $image_ratio;
				//height > width
			}

			$thumbnail = imagecreatetruecolor( $image_new_width, $image_new_height);
			@ imagecopyresampled( $thumbnail, $image, 0, 0, 0, 0, $image_new_width, $image_new_height, $image_attr[0], $image_attr[1] );

			// If no filters change the filename, we'll do a default transformation.
			if ( basename( $file ) == $thumb = apply_filters( 'thumbnail_filename', basename( $file ) ) )
				$thumb = 'thumbs/' . basename( $file );
				//$thumb = preg_replace( '!(\.[^.]+)?$!', '.thumbnail' . '$1', basename( $file ), 1 );

			$thumbpath = str_replace( basename( $file ), $thumb, $file );

			// move the thumbnail to its final destination
			if ( $type[2] == 1 ) {
				if (!imagegif( $thumbnail, $thumbpath ) ) {
					$error = __( "Thumbnail path invalid" );
				}
			}
			elseif ( $type[2] == 2 ) {
				if (!imagejpeg( $thumbnail, $thumbpath ) ) {
					$error = __( "Thumbnail path invalid" );
				}
			}
			elseif ( $type[2] == 3 ) {
				if (!imagepng( $thumbnail, $thumbpath ) ) {
					$error = __( "Thumbnail path invalid" );
				}
			}

		}
	} else {
		$error = __( 'File not found' );
	}

	if (!empty ( $error ) ) {
		return $error;
	} else {
		return apply_filters( 'wp_create_thumbnail', $thumbpath );
	}
}


/* LISTING FUNCTIONS */
// get the seperator (& or ?, depending on permalink structure)
function kingsize_sep() {
	if (get_option('permalink_structure') == '') {
		$sep = '&amp;';
	} else {
		$sep = '?';
	}
	return $sep;
}

// loop thumbs
function kingsize_get_thumbs() {
	global $wpdb;
	$album = 1;
	if (is_numeric($album)) {
		$slider_images = $wpdb->get_results("SELECT * FROM " . PHOTO_TABLE . " WHERE album=$album ORDER BY p_order ASC", 'ARRAY_A'); 
	}
	return $slider_images;
}
