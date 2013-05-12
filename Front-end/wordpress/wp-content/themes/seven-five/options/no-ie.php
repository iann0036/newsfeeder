<?php
	$option_fields[] = $no_ie = THEME_PREFIX . "no_ie";
?>

<div class="postbox">
    <h3>Save the Web</h3>
    
    <div class="inside">
    	<p>Help save the internet by letting IE6 users know that there are other options available.</p>
    
    	<p>
    		<label for="<?php echo $no_ie; ?>">
    	        <input id="<?php echo $no_ie; ?>" type="checkbox" name="<?php echo $no_ie; ?>" value="true"<?php checked(TRUE, (bool) get_option($no_ie)); ?> /> <?php _e("Save the Web"); ?>
    	    </label>
    	</p>
    	
    	<p class="submit">
    		<input type="submit" class="button" value="Save Changes" />
    	</p>
    </div> <!-- inside -->
</div> <!-- postbox -->