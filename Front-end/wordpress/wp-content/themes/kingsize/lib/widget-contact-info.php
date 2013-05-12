<?php
/**
* @KingSize 2011
* The PHP code for setup Theme widget Contact info.
* Begin creating widget Contact info
* Contact Us
*/
function kingsize_contactinfo_widget($args) {
	$settings = get_option('widget_contactinfo');

    echo $args['before_widget'];
	
	if ($settings['info_title'] == ''){
	$settings['info_title'] = 'Contact Info';
	}
	//. $args['after_title']	//$args['before_title'] .

    echo '<h3>'. $settings['info_title'] .'</h3>';
    echo '<div class="sidebar_item">';
    echo '<ul class="contact_list">';	 
	if ($settings['contactinfo_phone'] != ''){
	echo '<li class="contact_phone">'. $settings['contactinfo_phone'] .'</li>';
	}
	
	if ($settings['contactinfo_fax'] != ''){
	echo '<li class="contact_fax">'. $settings['contactinfo_fax'] .'</li>';
	}
	
	if ($settings['contactinfo_email'] != ''){
	echo '<li class="contact_email">' .$settings['contactinfo_email']. '</li>';
	}
		
	if ($settings['contactinfo_address'] != ''){
	echo '<li class="contact_address">'. $settings['contactinfo_address'] .', '. $settings['contactinfo_city'] .'</li>';
	}
	echo '</ul>';	

	// The map generation
	if ($settings['contactinfo_address'] != '' && $settings['contactinfo_city']!= ''){
		echo '<img src="http://maps.google.com/maps/api/staticmap?center='.$settings['contactinfo_address'] .','. $settings['contactinfo_city'].'&amp;zoom=15&amp;markers='.$settings['contactinfo_address'] .','. $settings['contactinfo_city'].'&amp;size=220x233&amp;sensor=false" alt="map" class="map" width="180"/>';	
	}	

	echo '</div>';
	
    echo $args['after_widget'];
	
}

function kingsize_contactinfo_widget_admin() {
	$settings = get_option('widget_contactinfo');
	
	if (isset($_POST['contactinfo_widget_title'])){
		$settings['info_title'] = strip_tags(stripslashes($_POST['contactinfo_widget_title']));
	    $settings['contactinfo_address'] = strip_tags(stripslashes($_POST['contactinfo_widget_address']));
	    $settings['contactinfo_city'] = strip_tags(stripslashes($_POST['contactinfo_widget_city']));
	    $settings['contactinfo_phone'] = strip_tags(stripslashes($_POST['contactinfo_widget_phone']));
	    $settings['contactinfo_fax'] = strip_tags(stripslashes($_POST['contactinfo_widget_fax']));
	    $settings['contactinfo_email'] = strip_tags(stripslashes($_POST['contactinfo_widget_email']));
	
	    update_option('widget_contactinfo', $settings);
	  }
	
	echo '<p>
		    <label for="contactinfo_widget_title">Title:<br />
			<input size="28" id="contactinfo_widget_title" name="contactinfo_widget_title" type="text" value="'.$settings['info_title'].'" /></label></p>';
	
	echo '<p>
		    <label for="contact_widget_phone">Phone:<br />
			<input size="28" id="contactinfo_widget_phone" name="contactinfo_widget_phone" type="text" value="'.$settings['contactinfo_phone'].'" /></label></p>';
	
	echo '<p>
		    <label for="contact_widget_fax">Fax:<br />
			<input size="28" id="contactinfo_widget_fax" name="contactinfo_widget_fax" type="text" value="'.$settings['contactinfo_fax'].'" /></label></p>';
			
	echo '<p>
		    <label for="contact_widget_email">Email:<br />
			<input size="28" id="contactinfo_widget_email" name="contactinfo_widget_email" type="text" value="'.$settings['contactinfo_email'].'" /></label></p>';
			
	echo '<p>
			<label for="contact_widget_address">Address:<br />
			<input size="28" id="contactinfo_widget_address" name="contactinfo_widget_address" type="text" value="'.$settings['contactinfo_address'].'" /></label></p>';

	echo '<p>
			<label for="contact_widget_city">City:<br />
			<input size="28" id="contactinfo_widget_city" name="contactinfo_widget_city" type="text" value="'.$settings['contactinfo_city'].'" /></label></p>';

	}
wp_register_sidebar_widget( 'contactinfo-widget', 'KingSize Contact Widget', 'kingsize_contactinfo_widget', array('description' => 'contact info to the sidebar.'));
register_widget_control('contactinfo-widget', 'kingsize_contactinfo_widget_admin', 250, 0);
/*
* End Contact info 
*/
?>