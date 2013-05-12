<?php
#------------------------------------------------------------------------#
###################### King Size *WP* Theme Options ######################
#------------------------------------------------------------------------#

// Load general common functions
require_once (TEMPLATEPATH . '/lib/general.php');

$themename = "King Size WP Template";
$shortname = "wm";
$path = get_template_directory_uri();
$options = array (

#-----------------------------------------------------------------------#
###################### King Size *WP* Logo Options ######################
#-----------------------------------------------------------------------#

		array(  "name" => "Logo Upload",
	          "id" => $shortname."_logo",
	          "std" => "",
	          "type" => "heading"),
	
		array(
			'name' => 'Logo image',
			'id' => $shortname . '_logo_upload',
			'type' => 'upload',
			'img_w' => '220',
			'img_h' => '200',
			'std' => $path . '/images/logo_back.png',
			"helpicon"=> "help.png",
			'parent_heading'=> $shortname."_logo",
			'desc' => 'Upload a logo, or specify the image address <i>[ie., http://www.yoursite.com/yourimage.jpg]</i>'
		) ,	
		
#---------------------------------------------------------------------------------#
###################### King Size *WP* Background Preferences ######################
#---------------------------------------------------------------------------------#		

		array(  "name" => "Global Background Preferences",
	          "id" => $shortname."_background",
	          "std" => "",
	          "type" => "heading"),
	
		array(
			'name' => 'Background image',
			'id' => $shortname . '_background_image',
			'type' => 'upload',
			'img_w' => '250',
			'img_h' => '150',
			'std' => $path . '/images/background/default.jpg',
			"helpicon"=> "help.png",
			'parent_heading'=> $shortname."_background",
			'desc' => 'Upload a global background, or specify the image address <i>[ie., http://www.yoursite.com/yourimage.jpg]</i><p><b>Important Reminder</b>: Set the following folder permissions to <b>777</b>:<br /> /wp-content/themes/kingsize/<b>cache</b><br /> /wp-content/themes/kingsize/images/<b>upload</b><br /> /wp-content/<b>uploads</b></p><p>Forgetting this important step will result in images not properly displaying throughout your website.</p>'
			) ,	
			  
		array(  "name" => "Enable Background Overlay",
			  "desc" => "Check this box if you want to enable the Background Grid feature.",
			  "id" => $shortname."_grid_hide_enabled",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_background",
			  "std" => "1"),
			  
#----------------------------------------------------------------------------------------#
###################### King Size *WP* Background Slider Preferences ######################
#----------------------------------------------------------------------------------------#		

		array(  "name" => "Homepage Background Slider Preferences",
	          "id" => $shortname."_slider",
	          "std" => "",
	          "type" => "heading"),
			  
		array(  "name" => "Enable Background Slider",
			  "desc" => "Check this box if you want to enable the Homepage Background Slider.",
			  "id" => $shortname."_slider_enabled",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_slider",
			  "std" => "1"),
			  
		array(  "name" => "Slider Intrevals (seconds)",
	          "id" => $shortname."_slider_seconds",
	          "std" => "5000",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_slider",
	          "type" => "text"),
			  
		array( "name" => "Slider Transition Type",
			  "id" => $shortname."_slider_transition",
			  "type" => "select",
		      "options" => array("fade"=>"fade", "horizontal"=>"horizontal", "vertical"=>"vertical"),
			  "std" => "Fade",
			  "helpicon"=> "help.png",
			  "desc" => "Help DESC for Slider Direction.",
			  "parent_heading"=> $shortname."_slider"),
			  
		array( "name" => "Slider Direction",
			  "id" => $shortname."_slider_direction",
			  "type" => "select",
		      "options" => array("tb"=>"Normal", "bt"=>"Reverse"),
			  "std" => "tb",
			  "helpicon"=> "help.png",
			  "desc" => "Help DESC for Slider Direction.",
			  "parent_heading"=> $shortname."_slider"),
			  
#----------------------------------------------------------------------------------------#
###################### King Size *WP* Navigation / Menu Preferences ######################
#----------------------------------------------------------------------------------------#		

		array(  "name" => "Navigation Menu Preferences",
	          "id" => $shortname."_navigation_menu",
	          "std" => "",
	          "type" => "heading"),
	
		array(  "name" => "Enable Menu Hide / Show",
			  "desc" => "Check this box if you want to enable the Hide/Show menu feature.",
			  "id" => $shortname."_menu_hide_enabled",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_navigation_menu",
			  "std" => "1"),
			  
		array(  "name" => "Enable the Menu Tooltip",
			  "desc" => "Check this box if you want to enable the Hide/Show menu tooltip.",
			  "id" => $shortname."_menu_tooltip_enabled",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_navigation_menu",
			  "std" => "1"),
			  
		array(  "name" => "Menu Hide Tooltip Text",
	          "id" => $shortname."_menu_tooltip",
	          "std" => "Hide the navigation",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_navigation_menu",
	          "type" => "text"),
			  
		array(  "name" => "Menu Show Tooltip Text",
	          "id" => $shortname."_menu_show_tooltip",
	          "std" => "Show the navigation",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_navigation_menu",
	          "type" => "text"),
			  
#---------------------------------------------------------------------------#
###################### King Size *WP* Blog Preferences ######################
#---------------------------------------------------------------------------#		

		array(  "name" => "Post / Page (Blog) Preferences",
	          "id" => $shortname."_blog_prefs",
	          "std" => "",
	          "type" => "heading"),
			  
		array(  "name" => "Enable Blog Excerpts",
			  "desc" => "Check this box if you want to enable excerpts opposed to full blog posts.",
			  "id" => $shortname."_enable_excerpts",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_blog_prefs",
			  "std" => "1"),
			  
		array(  "name" => "Enable Blog Archive Dates",
			  "desc" => "Check this box if you want to enable dates shown on the Blog pages.",
			  "id" => $shortname."_enable_blog_dates",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_blog_prefs",
			  "std" => "1"),
			  
		array(  "name" => "Enable Single Post Dates",
			  "desc" => "Check this box if you want to enable dates shown on individual Posts.",
			  "id" => $shortname."_enable_post_dates",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_blog_prefs",
			  "std" => "1"),
		
		array(  "name" => "Enable Blog/Post Sidebar",
			  "desc" => "Check this box if you want to enable the sidebar in KingSize Archives and Posts.",
			  "id" => $shortname."_sidebar_enabled",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_blog_prefs",
			  "std" => "1"),
			  
		array(  "name" => "Enable Widget Ready Footer",
			  "desc" => "Check this box if you want to enable the Widget Ready Footer.",
			  "id" => $shortname."_show_footer",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_blog_prefs",
			  "std" => "1"),
			  
		array(  "name" => "Enable Gallery Page Comments",
			  "desc" => "Check this box if you want to enable the Comments on Galleries.",
			  "id" => $shortname."_show_comments",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_blog_prefs",
			  "std" => "1"),
			  
		array(  "name" => "Custom Read More Text",
	          "id" => $shortname."_read_more_text",
	          "std" => "Read more...",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_blog_prefs",
	          "type" => "text"),
			  
			  
#--------------------------------------------------------------------------------#
###################### King Size *WP* Portfolio Preferences ######################
#--------------------------------------------------------------------------------#		

		array(  "name" => "Portfolio Preferences",
	          "id" => $shortname."_portfolio_prefs",
	          "std" => "",
	          "type" => "heading"),
			  
		array(  "name" => "Number of Items to Display",
			  "desc" => "Insert the Number of Items to Display inside your Portfolios.",
			  "id" => $shortname."_portfolio_num_items",
			  "type" => "text",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_portfolio_prefs",
			  "std" => "10"),
			  
		array(  "name" => "Enable Portfolio Item Image",
			  "desc" => "Check this box if you want to enable the Portfolio item to show in the single Portfolio page.",
			  "id" => $shortname."_portfolio_image_enabled",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_portfolio_prefs",
			  "std" => "1"),
			  
		array(  "name" => "Enable Dates in Portfolio Items",
			  "desc" => "Check this box if you want to enable dates shown on individual Portfolio Items.",
			  "id" => $shortname."_enable_portfolio_dates",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_portfolio_prefs",
			  "std" => "1"),


#----------------------------------------------------------------------------#
###################### King Size *WP* Style Preferences ######################
#----------------------------------------------------------------------------#		

		array(  "name" => "Style Preferences",
	          "id" => $shortname."_style_prefs",
	          "std" => "",
	          "type" => "heading"),
			  
		array(  "name" => "Sub-menu Colour",
	          "id" => $shortname."_submenu_color",
	          "std" => "#000000",
			  "helpicon"=> "help.png",
	          "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),	
			  
		array(  "name" => "Sub-menu Border Colour",
	          "id" => $shortname."_submenu_border_color",
	          "std" => "#2F2F2F",
			  "helpicon"=> "help.png",
	          "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),	

		array(  "name" => "Global Link Colour",
	          "id" => $shortname."_link_color",
	          "std" => "#D2D2D2",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),		
			  
		array(  "name" => "Hover Link Colour",
	          "id" => $shortname."_link_color_hover",
	          "std" => "#FFFFFF",
			  "helpicon"=> "help.png",
	          "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),	
			  
		array(  "name" => "Post Title Colour",
	          "id" => $shortname."_post_title_color",
	          "std" => "#FFFFFF",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),

		array(  "name" => "Body Text Colour",
	          "id" => $shortname."_color_text",
	          "std" => "#CCCCCC",
			  "helpicon"=> "help.png",
  			  "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),
			  
		array(  "name" => "Heading Text Colour",
	          "id" => $shortname."_heading_text_color",
	          "std" => "#FFFFFF",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),
			  
		array(  "name" => "Menu Text Colour",
	          "id" => $shortname."_menu_text_color",
	          "std" => "#A3A3A3",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),
			  
		array(  "name" => "Active Menu",
	          "id" => $shortname."_menu_active_color",
	          "std" => "#FFFFFF",
			  "helpicon"=> "help.png",
		      "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),
			  
		array(  "name" => "Menu Description Colour",
	          "id" => $shortname."_menu_description_text_color",
	          "std" => "#555555",
			  "helpicon"=> "help.png",
		      "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),
			  
		array(  "name" => "Active Menu Description",
	          "id" => $shortname."_menu_active_description_color",
	          "std" => "#A3A3A3",
			  "helpicon"=> "help.png",
		      "parent_heading"=> $shortname."_style_prefs",
	          "type" => "text"),

#--------------------------------------------------------------------------#
###################### King Size *WP* Contact Options ######################
#--------------------------------------------------------------------------#	
  			  
		array(  "name" => "Contact Page Settings",
	          "id" => $shortname."_misc",
	          "std" => "",
	          "type" => "heading"),
			  
		array(  "name" => "Your Email Address",
	          "id" => $shortname."_contact_email",
	          "std" => "",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_misc",
	          "type" => "text"),

		array(  "name" => "Contact Success Message",
	          "id" => $shortname."_contact_email_template",
	          "std" => "Thank you for contacting us! Your message has been successfully delivered and we will be getting in touch real soon!",
			  "helpicon"=> "help.png",
  			  "parent_heading"=> $shortname."_misc",
	          "type" => "textarea"),
			  
		array(  "name" => "Success Message Colour",
	          "id" => $shortname."_success_color",
	          "std" => "#05CA00",
			  "helpicon"=> "help.png",
		      "parent_heading"=> $shortname."_misc",
	          "type" => "text"),

#----------------------------------------------------------------------------#
###################### King Size *WP* Copyright Options ######################
#----------------------------------------------------------------------------#	
		  
		array(  "name" => "Small Footer Copyright",
	          "id" => $shortname."_misc_Copyright",
	          "std" => "",
	          "type" => "heading"),

		array(  "name" => "Insert Footer Text",
	          "id" => $shortname."_footer_copyright",
	          "std" => "&copy; 2010 - 2011 King Size Theme",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_misc_Copyright",
	          "type" => "textarea"),
	
#---------------------------------------------------------------------------------#
###################### King Size *WP* Social Network Options ######################
#---------------------------------------------------------------------------------#
	
		array(  "name" => "Social Networks",
	          "id" => $shortname."_misc_social",
	          "std" => "",
	          "type" => "heading"),
			  
		array(  "name" => "Twitter URL",
	          "id" => $shortname."_social_twitter",
			  "icon" => "twitter_16.png",
	          "std" => "",
			  "parent_heading"=> $shortname."_misc_social",
	          "type" => "text"),		
			  
		array(  "name" => "Facebook URL",
	          "id" => $shortname."_social_facebook",
			  "icon" => "facebook_16.png",
			  "parent_heading"=> $shortname."_misc_social",
	          "std" => "",
	          "type" => "text"),	
			  
	    array(  "name" => "LinkedIn URL",
	          "id" => $shortname."_social_linkedin",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "linkedin_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Delicious URL",
	          "id" => $shortname."_social_delicious",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "delicious_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Deviant Art URL",
	          "id" => $shortname."_social_deviant",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "deviantart_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Digg URL",
	          "id" => $shortname."_social_digg",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "digg_alt_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Dribbble URL",
	          "id" => $shortname."_social_dribble",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "dribbble_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Flickr URL",
	          "id" => $shortname."_social_flickr",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "flickr_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Forrst URL",
	          "id" => $shortname."_social_forrst",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "forrst_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Google URL",
	          "id" => $shortname."_social_google",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "google_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Google Talk URL",
	          "id" => $shortname."_social_googletalk",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "googletalk_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "MySpace URL",
	          "id" => $shortname."_social_myspace",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "myspace_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "PayPal URL",
	          "id" => $shortname."_social_paypal",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "paypal_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Picasa URL",
	          "id" => $shortname."_social_picasa",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "picasa_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Reddit URL",
	          "id" => $shortname."_social_reddit",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "reddit_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "RSS URL",
	          "id" => $shortname."_social_rss",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "rss_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Skype URL",
	          "id" => $shortname."_social_skype",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "skype_16.png",
	          "std" => "",
	          "type" => "text"),
			  
	    array(  "name" => "Stumble Upon URL",
	          "id" => $shortname."_social_stumble",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "stumbleupon_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Tumblr URL",
	          "id" => $shortname."_social_tumblr",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "tumblr_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "Vimeo URL",
	          "id" => $shortname."_social_vimeo",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "vimeo_16.png",
	          "std" => "",
	          "type" => "text"),
			  
		array(  "name" => "WordPress URL",
	          "id" => $shortname."_social_wordpress",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "wordpress_16.png",
	          "std" => "",
	          "type" => "text"),
			  
	    array(  "name" => "Yahoo URL",
	          "id" => $shortname."_social_yahoo",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "yahoo_16.png",
	          "std" => "",
	          "type" => "text"),
			  
	    array(  "name" => "Youtube URL",
	          "id" => $shortname."_social_youtube",
			  "parent_heading"=> $shortname."_misc_social",
			  "icon" => "youtube_16.png",
	          "std" => "",
	          "type" => "text"),

#--------------------------------------------------------------------------------#
###################### King Size *WP* Miscellaneous Options ######################
#--------------------------------------------------------------------------------#			  
																												
		array(  "name" => "Miscellaneous Setting",
	          "id" => $shortname."_misc_setting",
	          "std" => "",
	          "type" => "heading"),

		array(  "name" => "&lsaquo;head&rsaquo; Include Code",
	          "id" => $shortname."_head_include",
	          "std" => "",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_misc_setting",
	          "type" => "textarea"),
			  
		array(  "name" => "404 Error Page Header",
	          "id" => $shortname."_custom_404_title",
	          "std" => "",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_misc_setting",
	          "type" => "text"),	
			  
		array(  "name" => "404 Error Page Message",
	          "id" => $shortname."_custom_404",
	          "std" => "",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_misc_setting",
	          "type" => "textarea"),	
			  
		array(  "name" => "Insert Google Analytics ID",
	          "id" => $shortname."_google_analytics_id",
	          "std" => "",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_misc_setting",
	          "type" => "text"),	
			  
		array(  "name" => "Enable / Disable Right-Clicks",
			  "desc" => "Check this box if you want to enable the No-Right-Click option.",
			  "id" => $shortname."_no_rightclick_enabled",
			  "type" => "checkbox",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_misc_setting",
			  "std" => "1"),
			  
#--------------------------------------------------------------------------------#
###################### King Size *WP* Portfolio Preferences ######################
#--------------------------------------------------------------------------------#		

		array(  "name" => "Custom CSS Overrides",
	          "id" => $shortname."_css_prefs",
	          "std" => "",
	          "type" => "heading"),
			  
		array(  "name" => "Enter Your CSS Overrides",
			  "desc" => "Insert your CSS overrides.",
			  "id" => $shortname."_custom_css",
			  "type" => "textarea",
			  "helpicon"=> "help.png",
			  "parent_heading"=> $shortname."_css_prefs",
			  "std" => ""),
			  
);

#-------------------------------------------------------------#
########## King Size *WP* admin Form here #####################
#-------------------------------------------------------------#

function wm_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) { 								
				$options_array = array();
				foreach ($options as $value) {
					if (isset($_REQUEST[$value['id']])) {
						if (!preg_match("/^[\s]{1,1000}$/D", $_REQUEST[$value['id']])) {
						   $options_array[$value['id']] = stripslashes($_REQUEST[$value['id']]);
						}
				   }

				// Upload start //
					$upload_tracking = array();
					if ($value['type'] == 'upload') {
								$id = $value['id'];
								$override['test_form'] = false;
								$override['action'] = 'save';
								if (!empty($_FILES['attachment_' . $id]['name'])) {
									$file = wp_handle_upload($_FILES['attachment_' . $id], $override);
									$file['upload_name'] = $value['name'];
									$upload_tracking[] = $file;

									// Check if not error
									if (!isset($file['error'])) {
										// Update option										
										$options_array[$id] = $file['url'];
										// Add attachment
										add_attachment($file);
									}
								}
								elseif (empty($_FILES['attachement_' . $id]['name']) && $_REQUEST[$id] != '') {
									 $options_array[$value['id']] = $_REQUEST[$value['id']];
								}					
						}	
				      update_option($shortname.'_tracking', $upload_tracking);						
				 }

				//updating the all value in theme setting option Array
				 update_option($shortname.'_theme_settings', $options_array);

				// checkbox and other data save//
                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { 
						if( $value['type'] == 'checkbox' ) {							
							if( $_REQUEST[ $value['id'] ] == '1' ) {
								update_option( $value['id'], 1 );
							} else { 
								update_option( $value['id'], 0 ); 
							}	

						} elseif( $value['type'] != 'checkbox' ) {
							update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 							
						} 
						else { 
							update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
						}
					}
					else{ //If checkbox is not selected
						if( $value['type'] == 'checkbox' ) {
							update_option( $value['id'], 0 ); 
						}	
					}
				}
				//end checkbox and other data save//
                header("Location: themes.php?page=theme-options.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option( $value['id'] ); 
			}
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        }
    }
	// Theme Setting here
    add_menu_page($themename." Settings", "KingSize WP",'edit_themes', basename(__FILE__), $shortname.'_admin');
	// General Settings
	add_submenu_page(basename(__FILE__), $themename, 'General Settings',  'edit_themes', basename(__FILE__),$shortname.'_admin');	

	//background Slider
	//add_submenu_page(basename(__FILE__), 'Background Slider', 'Background Slider', 'edit_themes', 'kingsize_admin', 'kingsize_admin');  
	add_submenu_page(basename(__FILE__), 'Background Slider', 'Background Slider', 'edit_themes', 'upload_photos', 'kingsize_page_upload');  

}


function wm_admin() {
    global $themename, $shortname, $options;
	$get_options = get_option($shortname.'_theme_settings');

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' options Reset</strong></p></div>';
    
?>
<form method="post" id="post" enctype="multipart/form-data">
<div class="wrap"><!-- Top setting container div wrap-->
<h2><?php echo $themename; ?> Settings</h2>

  <div id="options_wrap">	<!-- Theme options_wrap DIV -->

<?php foreach ($options as $value) {		
	
	if($heading_name != $value['parent_heading']){
		echo "</div><!-- option_items_wrap ends here - before closing section min div -->
			</div><!-- it's section ends here -->";
	}

	if ($value['type'] == "text") { ?>  
		
		<div class="option_row">			      	
	        <div class="option-label <?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</div>
	       	<div class="option-value <?php echo $value['id']; ?>">			
					<?php 
					if($value['icon']!=''){ ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $value['icon'];?>" alt=""/>&nbsp;
					<?php } ?><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes (get_option( $value['id'] )); } else { echo $value['std']; } ?>" size="40" />
					<?php 
					if($value['helpicon']!=''){ ?>
					 &nbsp;<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value['helpicon'];?>" alt=""/></a>
					<?php } ?>
			</div><!-- End option-value-XXX div -->			
		</div>

	<?php } elseif ($value['type'] == "textarea") { ?>

			<div class="option_row option_textarea">
		        <div class="option-label <?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</div>
		        <div class="option-value <?php echo $value['id']; ?>">
	
						<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="5" cols="70"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes (get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea>
						<?php 
						if($value['helpicon']!=''){ ?>
							 &nbsp;<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value['helpicon'];?>" alt=""/></a>
						<?php } ?>
				</div><!-- End option-value-XXX div -->			
			</div>
	
	<?php } elseif ($value['type'] == "checkbox") { ?>

			<div class="option_row">
		        <div class="option-label <?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</div>
		        <div class="option-value <?php echo $value['id']; ?>">
	
					<?php
						if ( get_option( $value['id'] ) != "" ) { 
							$status= get_option( $value['id'] );
						} else { 
							$status= $value['std']; 
						}
					?>				
					<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $value['std']; ?>" <?php if( $status == 1 ) { echo 'checked'; } ?>/>
					<?php 
						if($value['helpicon']!=''){ ?>
						 &nbsp;<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value['helpicon'];?>" alt=""/></a>
					<?php } ?>
			    </div><!-- End option-value-XXX div -->			
			</div>

	<?php } elseif ($value['type'] == "select") { ?>

		<div class="option_row">
	        <div class="option-label <?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</div>
	        <div class="option-value <?php echo $value['id']; ?>">

	            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:200px">
	                <?php foreach ($value['options'] as $key_opt=>$option) { ?>
	                <option value="<?php echo $key_opt;?>" <?php if ( get_option( $value['id'] ) == $key_opt) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                <?php } ?>
	            </select>
				<?php 
					if($value['helpicon']!=''){ ?>
					 &nbsp;<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value['helpicon'];?>" alt=""/></a>
				<?php } ?>
			</div><!-- End option-value div -->			
		</div>	

	<?php } elseif ($value['type'] == "heading") { 
			$heading_name =  $value['id']; //assinging the value for the creating the group div of options				
			?>
			<div id="<?php echo $value['id']; ?>" class="option_section">
	            <h2 style="font-size:1.8em;"><?php echo $value['name']; ?>
				
					<div id="submit-top-<?php echo $value['id']; ?>" class="submit" style="margin:-28px 0 -10px; float: right;">
					<input name="save-<?php echo $value['id']; ?>" type="submit" value="Save Changes" class="button-primary" />    
					<input type="hidden" id="path" name="action" value="<?php echo get_template_directory_uri(); ?>" />
					</div>
				
				</h2>	  
				  <div class="option_items_wrap"><!--wrapper for everything that follows h2 tag -->

	<?php } elseif ($value['type'] == "upload") { $id = $value['id']; ?>

	           <div class="logo_upload" id="logo_upload-<?php echo $value['id'];?>">

					<div class="image_upload_option">
						<?php echo $value['name']; ?>:<input type="file" name="attachment_<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>	
	
						<br/><br/>
					</div>
					
					<div class="logo_image_path">	
						Uploaded image path:<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ($get_options[$id] != '') echo stripslashes($get_options[$id]); else echo $value['std'] ?>" size="55"/>
						
					</div>
					
				<?php if ($get_options[$id]) : ?>
				<div class="image">
					<a href="<?php echo $get_options[$id]; ?>" target="_NEW">
						<img src="<?php echo wm_image_resize($value['img_w'], $value['img_h'], $get_options[$id]); ?>" alt="" />
					</a>
				</div>
				<?php endif; ?>
				<!-- upload-help-box -->
				<div class="upload-help-box"><p><?php echo $value['desc']; ?></p></div>
				<!-- End upload-help-box -->

			</div>	<!-- logo_upload -->						
	<?php 
	  } // End Of upload

	} // End of foreach
	?>
</div><!-- End div wrapper-setting -->

</div><!-- End div wrap -->
<input type="hidden" name="action" value="save" />
</form>
<div id="reset-all-top" class="submit" style="float: right;">
	<form method="post" onSubmit="if(confirm('Are you sure you want to reset all the theme settings?')) return true; else return false;">
		<input name="reset" type="submit" value="Theme option Reset" class="button-primary"/>
		<input type="hidden" name="action" value="reset" />
	</form>
</div>
<?php
}

function wm_wp_head() {
	$wm_head_include= get_option( $shortname.'_head_include' ); 
	echo $wm_head_include;
	global $options;
	foreach ( $options as $value ) {
	    if ( get_option( $value['id'] ) === FALSE ) { 
			$$value['id'] = $value['std']; 
		} else { 
			$$value['id'] = get_option( $value['id'] ); 
		} 
	} 
?>
	
	<style type="text/css">
	  #footer_columns div li a, #footer_copyright a, .post a.read_more, #pagination a, #comment_form a, #sidebar ul li a, .post .metadata a, .comment a.comment_author, #content a, #sidebar a { color: <?php echo $wm_link_color; ?> !important; }
		#footer_columns div li a:hover, #footer_copyright a:hover, a:hover, .post a.read_more:hover, #pagination a:hover, #comment_form a:hover, #sidebar ul li a:hover, .post .metadata a:hover, #content a:hover, #sidebar a:hover { color: <?php echo $wm_link_color_hover; ?> !important; }
		body, #content .post p, #content p { color: <?php echo $wm_color_text; ?> !important; }
		h1, h2, h3, h4, h5, h6 { color: <?php echo $wm_heading_text_color; ?> !important; }
		#navbar li a { color: <?php echo $wm_menu_text_color; ?> !important; }
		#navbar li a span { color: <?php echo $wm_menu_description_text_color; ?>; }
		.post h3 a, h3 .post_title, #main .post_title a { color: <?php echo $wm_post_title_color; ?> !important; }
		#navbar li.current-menu-item a, #navbar li.current-menu-ancestor>a, #navbar li.current-menu-parent>a { color: <?php echo $wm_menu_active_color; ?> !important; }
		#navbar li.current-menu-item a span, #navbar li.current-menu-item-ancestor a span, #navbar li.current-post-parent a span  { color: <?php echo $wm_menu_active_description_color; ?> !important; }
		#content .post .success p { color: <?php echo $wm_success_color; ?> !important; }
		#navbar li ul { background: <?php echo $wm_submenu_color; ?> !important; }
		#navbar li ul { border: 1px solid <?php echo $wm_submenu_border_color; ?> !important; }
	</style>
	
<?php }

function wm_admin_head() 
{
	$path= get_template_directory_uri();
	echo '<script type="text/javascript" src="' . $path . '/js/colorpicker.js"></script>';
	echo '<link rel="stylesheet" href="' . $path . '/css/admin.css" type="text/css" media="screen, projection" />';
?>

<script type="text/javascript">
	jQuery(function($) {
  	$("#wm_link_color").attachColorPicker();
	$("#wm_link_color_hover").attachColorPicker();
	$("#wm_heading_text_color").attachColorPicker();
	$("#wm_menu_text_color").attachColorPicker();
	$("#wm_menu_description_text_color").attachColorPicker();
	$("#wm_menu_active_color").attachColorPicker();
	$("#wm_menu_active_description_color").attachColorPicker();
	$("#wm_color_text").attachColorPicker();
	$("#wm_post_title_color").attachColorPicker();
	$("#wm_success_color").attachColorPicker();
	$("#wm_submenu_color").attachColorPicker();
	$("#wm_submenu_border_color").attachColorPicker();
   });
</script>

	<style type="text/css"> 
		#ColorPickerDiv {
			display: block;
			display: none;
			position: relative;
			border: 1px solid #777;
			background: #fff;
		}
		#ColorPickerDiv TD.color {
			cursor: pointer;
			font-size: xx-small;
			font-family: 'Arial' , 'Microsoft Sans Serif';
		}
		#ColorPickerDiv TD.color label {
			cursor: pointer;
		}
		.ColorPickerDivSample {
			margin: 0 0 0 4px;
			border: solid 1px #000;
			padding: 0 10px;	
			position: relative;
			cursor: pointer;
		}
	</style> 

<?php 
}

add_action('admin_head', $shortname.'_admin_head');
add_action('wp_head', $shortname.'_wp_head');
add_action('admin_menu', $shortname.'_add_admin');	
?>