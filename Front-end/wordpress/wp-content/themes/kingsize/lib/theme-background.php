<?php
/**
 * @KingSize 2011
 * Full-width Background Image Form theme-background.php
 **/
?>
<?php
if((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_post_background', true )!=''){	//post background
	$theme_custom_bg = get_post_meta( $wp_query->post->ID, 'kingsize_post_background', true );
	echo '<div id="tf_bg" class="nojs"><img src="'.$theme_custom_bg.'" /></div> ';
}
elseif((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_page_background', true )!=''){	//page background
	$theme_custom_bg = get_post_meta( $wp_query->post->ID, 'kingsize_page_background', true );
	echo '<div id="tf_bg" class="nojs noSelect"><img src="'.$theme_custom_bg.'" /></div> ';
}
elseif((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_background', true )!=''){	//portfolio background
	$theme_custom_bg = get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_background', true );
	echo '<div id="tf_bg" class="nojs noSelect"><img src="'.$theme_custom_bg.'" /></div> ';
}
elseif(is_home()) { //If Home page then show the background/slider 			

	if ( get_option('wm_slider_enabled') == "1" ) : //slider is enabled
		$slider_images = array();
		$slider_images = kingsize_get_thumbs();
	
		if(count($slider_images)>0) :	//if slider image array set	
			echo '
				  <div id="tf_bg" class="slider nojs noSelect">';
						$url_image = '';
						foreach($slider_images as $slider_image):
							$photo = $slider_image['id'];
							$ext = $slider_image['ext'];
							$url_image = get_bloginfo('wpurl') . '/wp-content/uploads/background/' . $photo . '.' . $ext;
							echo '<img src="'.$url_image.'" alt="Image 1" />';
						endforeach;
			 echo '</div>';
		else: //slider image array not set then global background image will come
			$theme_custom_bg = $get_options['wm_background_image'];
			echo '<div id="tf_bg" class="nojs noSelect"><img src="'.$theme_custom_bg.'" /></div> ';
		endif;
	else: //slider is not enabled i.e background
		$theme_custom_bg = $get_options['wm_background_image'];
		echo '<div id="tf_bg" class=" nojs noSelect"><img src="'.$theme_custom_bg.'" /></div> ';
	endif;
	
}
else { //default
	$theme_custom_bg = $get_options['wm_background_image'];
	echo '<div id="tf_bg" class="nojs noSelect"><img src="'.$theme_custom_bg.'" /></div> ';
}
?>	