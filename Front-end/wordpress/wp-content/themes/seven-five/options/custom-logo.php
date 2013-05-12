<?php
	$option_fields[] = $logo_txt = THEME_PREFIX . "logo_txt";
?>

<div class="postbox">
    <h3>Logo Customization Options</h3>
    
    <div class="inside">
    	<p>Enter Some Text to use as Your Logo:</p>
    	<p><input class="option-field" id="<?php echo $logo_txt; ?>" type="text" name="<?php echo $logo_txt; ?>" value="<?php echo get_option($logo_txt); ?>" /></p>
    	        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->