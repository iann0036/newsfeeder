<?php
/**
 * @KingSize 2011
 **/
?>
					<!-- Footer -->
					<div id="footer">
						
						<!-- Footer information: copyright, social, etc -->
						<div id="footer_info">
							
							<?php if ( get_option('wm_show_footer') == "1" ) {?>
							<!-- Footer columns -->
							<div id="footer_columns">
						
								<div>
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer - Left") ) : ?> 
									<h3>Learn More</h3>
									<ul>
									<li><a href="/blog/">Blog</a></li>
									<li><a href="/contact/">Contact Us</a></li>
									<li><a href="/colorbox/2-columns/">Portfolio</a></li>
									</ul>
									<?php endif; ?>
								</div>

								<div>
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer - Center") ) : ?>
									<h3>Get In Touch</h3>
									<ul>
									<li><a href="#">Contact Us Today</a></li>
									<li><a href="http://www.themeforest.net/user/Denoizzed?ref=Denoizzed" target="blank">Denoizzed</a></li>
									<li><a href="http://www.themeforest.net/user/OurWebMedia?ref=OurWebMedia" target="blank">Our Web Media</a></li>
									</ul>
									<?php endif; ?>
								</div>
								
								<div class="last">
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer - Right") ) : ?>
									<h3>Need to Know</h3>
									<p class="copyright">&copy; 2010 - 2011, King Size.
									<br />Include your tagline if you want to.
									<br />This footer is Widget Ready x 3.</p>
									<?php endif; ?>
								</div>
								
							</div>
							<!-- Footer columns end here -->
							<?php } ?>
							
							<!-- Copyright / Social Footer Begins Here -->
							<div id="footer_copyright">
								<p class="copyright"><?php echo stripslashes(get_option('wm_footer_copyright'));?></p>
									<ul class="social">
									
									<!-- SOCIAL ICONS -->
									<?php include (TEMPLATEPATH . "/lib/social-networks.php"); ?>
									<!-- SOCIAL ICONS -->
									
									</ul>
							</div>
							<!-- Copyright / Social Footer Ends Here -->
							
							
							
						</div>
						
					</div>        
					<!-- Footer ends here --> 

		</div>
		<!-- main ends here -->
		
	</div>
	<!-- main wrap ends here -->

</div>
<!-- wrapper ends here -->

<?php

	wp_footer();
?>

<!-- GOOGLE ANALYTICS -->
<?php include (TEMPLATEPATH . "/lib/google-analytics-input.php"); ?>
<!-- GOOGLE ANALYTICS -->

<script type="text/javascript">
	Cufon.now();     
</script>

<!-- Portfolio control CSS and JS-->
<?php
global $tpl_body_id;

if ($tpl_body_id=="colorbox") { 
?>
	<script type="text/javascript">
	//load colorbox
	jQuery('#gallery_colorbox ul li a').colorbox();	
	</script>		
<?php
}
elseif ($tpl_body_id=="fancybox") { 
?>
	<script type="text/javascript">
	//load fancybox and options
		jQuery("#gallery_fancybox ul li a").fancybox({
		'overlayOpacity'	: '0.8',
		'overlayColor' 		: 'black',
		'transitionIn' : 'elastic',
		'transitionOut' : 'fade'
	});	
</script>
<?php
}
elseif ($tpl_body_id=="prettyphoto") { 
?>
	<script type="text/javascript">
	//load prettyPhoto
	jQuery("a[rel^='prettyPhoto']").prettyPhoto(
	{theme: 'dark_square'});
	</script>
<?php
}
elseif ($tpl_body_id=="galleria") { 
?>
	<script type="text/javascript">
		   // Load the classic theme
		Galleria.loadTheme('<?php echo get_template_directory_uri(); ?>/js/galleria/galleria.classic.js');
		// Initialize Galleria
		jQuery('#gallery_galleria').galleria(
		{ transition: 'fade'});
	</script>
<?php
}
?> 
<!-- END Portfolio control CSS and JS-->


		<!-- background Slider -->
<?php  /*if(is_home()) :*/?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/background_slider.js"></script>		
<?php /* endif; */?>
<!-- End background Slider -->

</body>
</html>
