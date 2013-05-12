<?php
/**
* @KingSize 2011
* The PHP code for setup Theme Portfolio Page support header file.
* Begin creating Portfolio Page support header file
* Portfolio Page support header file
*/
global $tpl_body_id;
if ($tpl_body_id=="colorbox") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/colorbox.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox-min.js"> </script>		
<?php
}
elseif ($tpl_body_id=="fancybox") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox-1.3.1.css" type="text/css" media="screen"/>
	 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.1.pack.js"></script> 
<?php
}
elseif ($tpl_body_id=="prettyphoto") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
<?php
}
elseif ($tpl_body_id=="blog_overview" ) { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 

	<script type="text/javascript">  
	 jQuery(document).ready(function($) {
	   $("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		animationSpeed: 'normal', /* fast/slow/normal */
		padding: 40, /* padding for each side of the picture */
			opacity: 0.7, /* Value betwee 0 and 1 */
		showTitle: true, /* true/false */			
		theme: 'dark_square'	
		});
	})
	</script>
<?php
}
elseif ($tpl_body_id=="galleria") { 
?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/galleria/galleria.js"></script> 
<?php
}
elseif ($tpl_body_id=="slideviewer") { 
?>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.slideviewer.1.2.js"></script> 
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>	
 <script type="text/javascript">		
	jQuery(window).bind("load", function($){ 
		$("#gallery_slideviewer").css('display', 'none');
		$("#gallery_slideviewer").fadeIn('fast');
		$("#gallery_slideviewer").slideView();
	});
	</script>
<?php
}	
?>