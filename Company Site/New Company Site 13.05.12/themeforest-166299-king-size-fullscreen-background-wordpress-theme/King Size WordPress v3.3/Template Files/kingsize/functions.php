<?php
/**
 * @KingSize 2011
 **/
#---------------------------------------------------------------#
###################### Get custom function ######################
#---------------------------------------------------------------#

include (TEMPLATEPATH . "/lib/custom.lib.php");

// Update Notification
require_once(TEMPLATEPATH. '/lib/theme-update-notification.php');

#--------------------------------------------------------------------------#
###################### Setup Theme page custom fields ######################
#--------------------------------------------------------------------------#

include (TEMPLATEPATH . "/lib/theme-page-custom-fields.php");

#--------------------------------------------------------------------------#
###################### Setup Theme post custom fields ######################
#--------------------------------------------------------------------------#

include (TEMPLATEPATH . "/lib/theme-post-custom-fields.php");

#---------------------------------------------------------------#
######################  Widget for sidebar ######################
#---------------------------------------------------------------#

require_once (TEMPLATEPATH . '/lib/widget-contact-info.php');
require_once (TEMPLATEPATH . '/lib/widget-twitter.php');
require_once (TEMPLATEPATH . '/lib/gallery-widget/gallery_widget.php');

#---------------------------------------------------------------#
###################### WordPress Functions ######################
#---------------------------------------------------------------#

/** Tell WordPress to run kingsize_setup() when the 'after_setup_theme' hook is run. **/
add_action( 'after_setup_theme', 'kingsize_setup' );

if ( ! function_exists( 'kingsize_setup' ) ):

 /**
 * Sets up theme defaults and registers support for various WordPress features.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 **/
 
function kingsize_setup() {
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails', array( 'post' ) );
	set_post_thumbnail_size( 460, 180, true );
	add_image_size( 'thumbnail-post', 200, 150, true ); // Post portfolio thumbnails
	add_image_size( 'thumbnail-portfolio', 680, '', true ); // Portfolio inner page bigimage

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );	
}
endif;

$GLOBALS['content_width'] = 640;

////////////////////////////////////////////////////////////////////////////////////
#------------------------------------------------------------------#
######################  Change Default Excerpt Length ######################
#------------------------------------------------------------------#
function kingsize_excerpt_length($length) {
return 30; }
add_filter('excerpt_length', 'kingsize_excerpt_length');

#------------------------------------------------------------------#
######################  Configure Excerpt String ######################
#------------------------------------------------------------------#
function kingsize_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'kingsize_excerpt_more');
/////////////////////////////////////////////////////////////////////////////////////


#------------------------------------------------------------------#
######################  For Background Slider ######################
#------------------------------------------------------------------#
require_once (TEMPLATEPATH . '/lib/photo-background/background-slider-kingsize.php');
if (  function_exists( 'kingsize_slider_setup' ) ):
	kingsize_slider_setup();
endif;


#------------------------------------------------------------------------------------------#
###################### Get our wp_nav_menu() fallback, wp_page_menu() ######################
#------------------------------------------------------------------------------------------#

function kingsize_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'kingsize_page_menu_args' );

#---------------------------------------------------------------------------#
###################### Widget Ready / Enabled Sidebars ######################
#---------------------------------------------------------------------------#

function kingsize_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Blog Sidebar', 'kingsize' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The main WordPress sidebar.', 'kingsize' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Contact Page Sidebar', 'kingsize' ),
		'id' => 'contact-page-sidebar',
		'description' => __( 'Ideal for additional contact details, displayed as the Sidebar on the Contact Page. Can be used for anything.', 'kingsize' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer - Left', 'kingsize' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area.', 'kingsize' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer - Center', 'kingsize' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area.', 'kingsize' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer - Right', 'kingsize' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area.', 'kingsize' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}

#--------------------------------------------------------------------#
###################### Register Widget Sidebars ######################
#--------------------------------------------------------------------#

add_action( 'widgets_init', 'kingsize_widgets_init' );

#------------------------------------------------------------------#
###################### Comment Style Settings ######################
#------------------------------------------------------------------#

function kingsize_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'kingsize_remove_recent_comments_style' );

#-----------------------------------------------------------------#
###################### Theme Options Setting ######################
#-----------------------------------------------------------------#

require_once ( get_stylesheet_directory() . '/lib/theme-options.php' );

if (is_admin()) { // instruction to only load if it is the admin area
   // register your script location, dependencies and version
   wp_register_script('options',
       get_template_directory_uri() . '/js/options.js',
       '1.0' );
   // enqueue the script
   wp_enqueue_script('options');
}

#-----------------------------------------------------------------#
###################### Menu Navitation Setup ######################
#-----------------------------------------------------------------#

require_once ( get_stylesheet_directory() . '/lib/menu-walker.php' );

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
register_nav_menus(array(
'header-nav' => __( 'Header Navigation' )
));
}

#-----------------------------------------------------#
###################### Home Body ######################
#-----------------------------------------------------#

function my_plugin_body_class($classes) {
    $classes[] = 'body_portfolio body_colorbox body_gallery_2col_cb';
    return $classes;
}
add_filter('body_class', 'my_plugin_body_class');
 
#--------------------------------------------------------------#
######################  Admin E-MAIL HERE ######################
#--------------------------------------------------------------#

define("webmaster_email", get_option('wm_contact_email'));
define("thanks_message", get_option('wm_contact_email_template'));

#-----------------------------------------------------------#
######################  Enqueue Jquery ######################
#-----------------------------------------------------------#

function my_init_method() {
    if (!is_admin()) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
        wp_enqueue_script( 'jquery' );
        
        
		wp_register_script("cufon", get_bloginfo(template_directory) . "/js/cufon-yui.js");
		wp_enqueue_script('cufon');
			    
		wp_register_script('PT_Sans', get_bloginfo(template_directory) . "/js/PT_Sans.font.js");
		wp_enqueue_script('PT_Sans');
			    
		wp_register_script('PT_Sans_Narrow', get_bloginfo(template_directory) . "/js/PT_Sans_Narrow.font.js");
		wp_enqueue_script('PT_Sans_Narrow');
			    
		wp_register_script('custom', get_bloginfo(template_directory) . "/js/custom.js");
		wp_enqueue_script('custom');

        wp_register_script('tipsy', get_bloginfo(template_directory) . "/js/jquery.tipsy.js");
		wp_enqueue_script('tipsy');   
    }
}    
 
add_action('init', 'my_init_method');

#-----------------------------------------------------------#
######################  Add shortcodes ######################
#-----------------------------------------------------------#

include (TEMPLATEPATH . "/lib/shortcodes.php");

#----------------------------------------------------#
######################  TinyMCE ######################
#----------------------------------------------------#

require_once (TEMPLATEPATH . '/lib/tinymce/tinymce.php');

#--------------------------------------------------------------------#
######################  Password protected page ######################
#--------------------------------------------------------------------#

function wm_the_password_form() {
    global $post;

    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
    $output = '<form action="' . get_option('siteurl') . '/wp-pass.php" method="post">
    <p><strong>' . __("Content is password protected. Please enter password:") . '</strong></p>
    <p><div for="' . $label . '" style="padding-top:10px;">' . __("Password") . '</div><div style="padding-top:10px;"> <input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__("Login") . '" /></div></p>
    </form>';

    return $output;
}
add_filter('the_password_form', 'wm_the_password_form');

#-----------------------------------------------------------------#
######################  Get the Blog Content ######################
#-----------------------------------------------------------------#

function get_content($more_link_text = '(more...)', $stripteaser = 0, $more_file = '')
{
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

// Added v3.0
#-----------------------------------------------------------------#
#############  List categories for the portfolio in frontend #################
#-----------------------------------------------------------------#

class Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="#" data-value="'.strtolower(preg_replace('/\s+/', '-', $cat_name)).'" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all items filed under %s' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      // $link .= $cat_name . '</a>';
      $link .= $cat_name;
      if(!empty($category->description)) {
         $link .= ' <span>'.$category->description.'</span>';
      }
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}





#-----------------------------------------------------------------#
#############  portfolio in admin #################
#-----------------------------------------------------------------#

// create the portfolio Post types for admin
include(TEMPLATEPATH ."/lib/portfolio/theme-posttypes.php");

// Add the Portfolio Custom Meta
include(TEMPLATEPATH ."/lib/portfolio/portfolio-meta.php");

// Add the portfolio Custom Fields
include(TEMPLATEPATH ."/lib/portfolio/custom-fields.php");

include(TEMPLATEPATH ."/lib/portfolio/portfolio-functions.php");




///removing the custom field from the writeup panel
function remove_metaboxes() {
 remove_meta_box( 'postcustom' , 'portfolio' , 'normal' ); //removes custom fields for page
 remove_meta_box( 'postcustom' , 'post' , 'normal' ); //removes custom fields for page
 remove_meta_box( 'postcustom' , 'page' , 'normal' ); //removes custom fields for page
}
add_action( 'admin_menu' , 'remove_metaboxes' );