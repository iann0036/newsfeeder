<?php
// Press75.com
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<!--
**********************************************************************************************

Designed and Built by Jason Schuller - theSevenFive.com, Press75.com

CSS, XHTML and Design Files are all Copyright 2007-2010 Circa75 Media, LLC

Be inspired, but please don't steal...

**********************************************************************************************
-->

<head profile="http://gmpg.org/xfn/11">
	<!-- page titles -->
	<title>
	<?php if ( is_home() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?><?php } ?>
	<?php if ( is_search() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Search Results<?php } ?>
	<?php if ( is_author() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Author Archives<?php } ?>
	<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
	<?php if ( is_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php wp_title(''); ?><?php } ?>
	<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php single_cat_title(); ?><?php } ?>
	<?php if ( is_month() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php the_time('F'); ?><?php } ?>
	<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Tag Archive&nbsp;|&nbsp;<?php  single_tag_title("", true); } } ?>
	</title>

	<!-- meta tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<meta name="description" content="<?php the_excerpt_rss(); ?>" />
	<?php endwhile; endif; elseif(is_home()) : ?>
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<?php endif; ?>
	
	<!-- import required theme styles -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css3.css" type="text/css" media="screen" />
	
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style-ie7.css" type="text/css" media="screen" />
	<![endif]-->
	
	<!--[if IE 8]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style-ie8.css" type="text/css" media="screen" />
	<![endif]-->
	
	<!-- custom theme styles if there are any -->
	<link rel='stylesheet' type='text/css' href="<?php bloginfo('url'); ?>/?sf-custom-content=css" />
	
	<!-- load jquery and other required scripts -->
	<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.fade.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.livetwitter.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.imagepreview.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.smoothscroll.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.smoothAnchors(1000, "swing", false);
		});
	</script>
	
	<!-- cufon for typography goodness -->
	<script src="<?php bloginfo('template_url'); ?>/scripts/cufon.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/scripts/Graublau_Web_400-Graublau_Web_700.font.js" type="text/javascript"></script>
	<script type="text/javascript">
		Cufon.replace('h1, h2, h3, cite, #logo, .says, #menu, #submit, .pagination');
	</script>
	
	<!-- pingback url -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!-- custom favicon -->
	<?php $favicon_link = get_option(THEME_PREFIX.'favicon'); if ( !$favicon_link ) $favicon_link = get_bloginfo('template_url') . '/images/favicon.ico'; ?>
	<link rel="shortcut icon" href="<?php echo $favicon_link; ?>" type="image/x-icon" />
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<![if !IE]>
<script type="text/javascript">
    document.body.style.visibility= 'hidden';
    window.onload= function() { document.body.style.visibility= 'visible'; };
</script>
<![endif]>

<div id="header">
	<div id="logo">
		<?php if ( get_option(THEME_PREFIX . "logo_txt") ) : ?>
			<h1><a href="<?php echo get_option('home'); ?>/" title="Home" ><?php echo get_option(THEME_PREFIX . "logo_txt"); ?></a></h1>
		<?php else : ?>
			<h1><a href="<?php echo get_option('home'); ?>/" title="Home" >theSevenFive</a></h1>
		<?php endif; ?>
	</div>
	
	<div id="menu">
		<?php if (get_option(THEME_PREFIX . "menu_management")) : ?>
		<?php wp_nav_menu(array('theme_location' => 'main_menu', 'menu_id' => 'nav')); ?>
		<?php else : ?>
		<ul>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe via RSS">Subscribe</a></li>
			<?php wp_list_pages('title_li='); ?>
			<?php wp_list_categories('title_li='); ?>
			<li><a href="<?php echo get_option('home'); ?>/" title="Home" >Home</a></li>
		</ul>
		<?php endif; ?> 
	</div>
</div> <!-- header -->