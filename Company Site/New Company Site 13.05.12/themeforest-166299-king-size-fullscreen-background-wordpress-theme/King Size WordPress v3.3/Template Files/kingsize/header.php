<?php
/**
 * @KingSize 2011
 **/
 ###### Theme Setting #########
global $get_options;
$get_options = get_option('wm_theme_settings');
###############################
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head> <!-- Header starts here -->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title('&laquo; ', true, 'right'); ?><?php bloginfo('name'); ?></title> <!-- Website Title of WordPress Blog -->	
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> <!-- Style Sheet -->
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> <!-- Pingback Call -->

		<!--[if lte IE 8]>						
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/stylesIE.css" type="text/css" media="screen" />
		<![endif]-->		
		<!--[if lte IE 7]>				
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/stylesIE7.css" type="text/css" media="screen" />
		<![endif]-->
		
		
		<script type="text/javascript">		
			// Template Directory going here
			var template_directory = '<?php echo get_template_directory_uri(); ?>';

		</script>
		
		<script type="text/javascript">		
			// Homepage Background Slider Options
			var sliderTime = <?php echo get_option('wm_slider_seconds');?>; // time between slides change in ms
			var slideDirection = '<?php echo get_option('wm_slider_transition'); ?>'; // fade, horizontal, vertical
			var dir = '<?php echo get_option('wm_slider_direction'); ?>'; // direction; 'tb' = normal, 'bt' = reversed
		</script>

		<!-- Do Not Remove the Below -->
		<?php if(is_singular()) wp_enqueue_script('comment-reply'); ?>
		<?php if ($tpl_body_id!="slideviewer") {  wp_enqueue_script("jquery"); } ?>
		<?php wp_head(); ?>
		<!-- Do Not Remove the Above -->
		
		<!-- theme setting head include wp admin -->
		<?php
		$head_include = "";
		$head_include = $get_options['wm_head_include'];
		echo $head_include;
		?>
		<!-- End theme setting head include -->
		
		<!-- Portfolio control CSS and JS-->		
		<?php include (TEMPLATEPATH . '/lib/portofolio_template_style_js.php'); ?>		
		<!-- END Portfolio control CSS and JS-->
		
		<?php if ( get_option('wm_no_rightclick_enabled') == "1" ) {?>
		<!-- Disable Right-click -->
		<script type="text/javascript" language="javascript">
			jQuery(function($) {
				$(this).bind("contextmenu", function(e) {
					e.preventDefault();
				});
			}); 
		</script>
		<!-- END of Disable Right-click -->
		<?php } ?>
		
		<?php if( get_option('wm_custom_css') ) { ?><style><?php echo get_option('wm_custom_css');?></style><?php } ?>

		
</head> 
<!-- Header ends here -->
<?php
  //getting the current page template set from the page custom options	
  $current_page_template = get_option('current_page_template');  

 //Overlay handling	
    $body_overlay = "body_home";
  if ( get_option('wm_grid_hide_enabled') == "1" ) { 	
	$body_overlay = "body_about";
  }
?>
<?php if(is_home()) {?>
<!--[if lte IE 7]>				
<style>
.body_home #menu_wrap
{margin: 0;}
</style>
<![endif]-->
<body <?php body_class('body_home'); ?>>
<?php } else {?>
<body <?php body_class($body_overlay." ".$current_page_template); ?>>
<?php } ?>

	<!-- START of the Full-width Background Image -->				
	<?php include (TEMPLATEPATH . '/lib/theme-background.php'); ?>		
	<!-- END of the Full-width Background Image -->

    <!-- Wrapper starts here -->
	<div id="wrapper">
		
	     <!-- Navigation starts here -->	 
		<div id="menu_wrap">
			
			<!-- Menu starts here -->
			<div id="menu">
		    	
				<!-- Logo -->
		      	<div id="logo">   
				  <?php
				  //get custom logo
				  $theme_custom_logo = $get_options['wm_logo_upload'];

					if(!empty($theme_custom_logo))
					{
						$url = get_template_directory_uri();
					?>
				  	  <style type="text/css" media="all" scoped="scoped">
						#logo h1 a {
							background: url("<?php echo $theme_custom_logo ?>") no-repeat scroll center top transparent;
						}
					   </style>							
					<?php
					}
				  ?>
			        <h1><a href="<?php echo home_url(); ?>" class="logo_image index" ></a></h1>      
		      	</div>
		      	<!-- Logo ends here -->
		      
		      	
		      	<!-- Navbar -->
				<?php 
					wp_nav_menu( array(
					 'sort_column' =>'menu_order',
					 'container' => 'ul',
					 'theme_location' => 'header-nav',
					 'fallback_cb' => 'null',
					 'menu_id' => 'navbar',
					 'link_before' => '',
					 'link_after' => '',
					 'depth' => 0,
					 'walker' => new description_walker())
					 );
				?>
			    <!-- Navbar ends here -->			    	       
		    </div>
		    <!-- Menu ends here -->
		    
		    <!-- Hide menu arrow -->
			<?php if ( get_option('wm_menu_hide_enabled') == "1" ) {?>
		    <div id="hide_menu">   
		    	<a href="#" class="menu_visible">Hide menu</a> 
					
					<?php if ( get_option('wm_menu_tooltip_enabled') == "1" ) {?>
		        	<div class="menu_tooltip">
						
                        <div class="tooltip_hide"><?php if( get_option('wm_menu_tooltip') ) { ?><p><?php echo get_option('wm_menu_tooltip');?></p><?php } else { ?><p>Hide the navigation</p><?php } ?></div>
						<div class="tooltip_show"><?php if( get_option('wm_menu_show_tooltip') ) { ?><p><?php echo get_option('wm_menu_show_tooltip');?></p><?php } else { ?><p>Show the navigation</p><?php } ?></div>
						
			        </div>  
					<?php } else { ?>
					<!-- No Tool Tip -->
					<?php } ?>					
		    </div>
				<?php } else { ?>	
				<div id="hide_menu">    
				</div>
				<?php } ?>
				<!-- Hide menu arrow ends here -->
		       
		</div>
		<!-- Navigation ends here -->
	
	<?php if(is_home()) {?>
	</div>
	<?php } ?>
	