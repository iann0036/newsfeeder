<?php

// Theme Constants
define("THEME_PREFIX", "sevenfive_");

// Theme Location
define('THEME', get_bloginfo('template_url'), true);

// Add RSS Feed Links
add_theme_support( 'automatic-feed-links' );

// Custom Menus
register_nav_menu('main_menu', __('Main Menu'));

// unregister all default WP Widgets
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Akismet');
}
 
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

// Feed Refresh Rate
add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 1800;') );

// Load Required Theme Scripts
include("scripts/lastfm-records/last.fm.records.php");

// Include Custom Theme Widgets
include("widgets/posts.php");
include("widgets/flickr.php");
include("widgets/twitter.php");
include("widgets/delicious.php");
include("widgets/youtube.php");
include("widgets/vimeo.php");
include("widgets/feed.php");
include("widgets/lastfm.php");

// The Admin Page
add_action('admin_menu', "sf_sevenfive_admin_init");

// Register Admin
function sf_sevenfive_admin_init()
{
	$page = add_theme_page( "Seven Five Options", "Theme Options", 8, 'sf_sevenfive_admin_menu', 'sf_sevenfive_admin');

	// Custom Image Uploaders
	sf_add_img_upload_filter(THEME_PREFIX.'background_img', 'sf_handle_bg_upload');
	sf_add_img_upload_filter(THEME_PREFIX.'logo_img', 'sf_handle_logo_upload');
	sf_add_img_upload_filter(THEME_PREFIX.'favicon', 'sf_handle_favicon_upload');
}

// Image Upload Helper Function
function sf_add_img_upload_filter($option_name, $handler) {
  add_filter('pre_update_option_'.$option_name, $handler, 10, 2);
}

// Image Upload Handler Functions
function sf_handle_bg_upload($new_value, $old_value) {
  return sf_handle_img_upload(
    $new_value, 
    $old_value, 
    THEME_PREFIX.'background_img_upload', 
    THEME_PREFIX.'delete_bg_img');
}

function sf_handle_logo_upload($new_value, $old_value) {
  return sf_handle_img_upload(
    $new_value, 
    $old_value, 
    THEME_PREFIX.'logo_img_upload', 
    THEME_PREFIX.'delete_logo_img');
}

function sf_handle_favicon_upload($new_value, $old_value) {
  return sf_handle_img_upload(
    $new_value, 
    $old_value, 
    THEME_PREFIX.'favicon_upload', 
    THEME_PREFIX.'delete_favicon');
}

// Generic Image Upload Handler
function sf_handle_img_upload($new_value, $old_value, $file_index, $delete_field) {
  if ( isset($_POST[$delete_field]) && $_POST[$delete_field]=='true' )
    return '';

  if ( empty($_FILES) || !isset($_FILES[$file_index]) || 0==$_FILES[$file_index]['size'] )
    return $old_value;

  $overrides = array('test_form' => false);
  $file = wp_handle_upload($_FILES[$file_index], $overrides);

  if ( isset($file['error']) )
    wp_die( $file['error'] );

  $url = $file['url'];
  $type = $file['type'];
  $file = $file['file'];
  $filename = basename($file);

  // Construct The Object Array
  $object = array(
		  'post_title' => $filename,
		  'post_content' => $url,
		  'post_mime_type' => $type,
		  'guid' => $url
		  );

  // Save The Data
  $id = wp_insert_attachment($object, $file);

  // Add The Meta
  wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );

  do_action('wp_create_file_in_uploads', $file, $id); // For replication
  return esc_url($url);
}

function sf_sevenfive_admin() {

	$option_fields = array();

	if ( $_GET['updated'] ) echo '<div id="message" class="updated fade"><p>Seven Five Theme Options Saved.</p></div>';
	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/functions.css" type="text/css" media="all" />';
	
	// Accordion Script
	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/scripts/accordion/style.css" type="text/css" media="all" />';
	echo '<script src="'.get_bloginfo('template_url').'/scripts/accordion/jquery.ui.js" type="text/javascript"></script>';
	echo '<script src="'.get_bloginfo('template_url').'/scripts/accordion/jquery.accordion.js" type="text/javascript"></script>';
	
	// Color Picker Script
	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/scripts/colorpicker/style.css" type="text/css" media="all" />';
	echo '<script src="'.get_bloginfo('template_url').'/scripts/colorpicker/jquery.colorpicker.js" type="text/javascript"></script>';
	echo '<script src="'.get_bloginfo('template_url').'/scripts/colorpicker/jquery.eye.js" type="text/javascript"></script>';
	
	// Styling File Form Elements
	echo '<script src="'.get_bloginfo('template_url').'/scripts/si.files.js" type="text/javascript"></script>';
?>

<div class="wrap">
    <div id="icon-options-general" class="icon32"><br/></div>

    <h2>Seven Five Theme Options</h2>
    <div class="metabox-holder">
    	<form method="post" action="options.php" enctype="multipart/form-data">
		<?php wp_nonce_field('update-options'); ?>
    
        <div id="theme-options">
	        <div id="accordion" class="postbox-container">
	            <?php 
	            	include("options/theme-support.php");
	            	include("options/custom-logo.php");
	            	include("options/custom-menus.php");
	            	include("options/custom-favicon.php");
	            	include("options/custom-styles.php");
	            	include("options/featured-content.php");
	            	include("options/social-options.php");
	            	include("options/footer-text.php");
	            	include("options/analytics-code.php");
	            	include("options/no-ie.php");
	        	?>
	        </div> <!-- postbox-container -->
        </div> <!-- theme-options -->
        
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="<?php echo implode(",", $option_fields); ?>" />
        </form>
        
        <script type="text/javascript" language="javascript">SI.Files.stylizeAll();</script>
    </div> <!-- metabox-holder -->
</div> <!-- wrap -->

<?php
}

// Custom Styles Function
add_action( 'parse_request', 'sf_custom_css' );
function sf_custom_css($wp) {
    if (
        !empty( $_GET['sf-custom-content'] )
        && $_GET['sf-custom-content'] == 'css'
    ) {
        header( 'Content-Type: text/css' );
        require dirname( __FILE__ ) . '/style-custom.php';
        exit;
    }
}

// Custom Pagination Function
function sf_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {   $prelabel = '';
		} if(empty($nxtlabel)) {
		$nxtlabel = '';
	} $half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
		preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);  } else {
		preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);  }
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class='content-item pagination'><div class='content-dets'><h3>Pages:</h3></div><div class='content-body'>";   if ($paged >= ($pages_to_show-1)) {
			echo '';  }
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i <= $paged + $half_pages_to_show; $i++) {   if ($i >= 1 && $i <= $max_page) {   if($i == $paged) {
						echo "$i";
						} else {
					echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';   }
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
			echo '';   }
			echo "</div></div> $after";
		}
	}
}

// Sidebar Widgets
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Home Page',
	'before_widget' => '<div id="%1$s" class="widget content-item %2$s">',
	'after_widget' => '</div></div>',
	'before_title' => '<div class="content-dets"><h3>',
	'after_title' => '</h3></div><div class="content-body">',
));
?>