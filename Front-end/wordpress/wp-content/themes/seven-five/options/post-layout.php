<?php
	$option_fields[] = $post_excerpt = THEME_PREFIX . "post_excerpt";
?>

<div class="postbox">
    <h3>Post Layout Options</h3>
    
    <div class="inside">
    	<p>Check the box below if you wish to display the post excerpt rather than the full post content on the home page and multiple post pages.</p>
    
    	<p>
    		<label for="<?php echo $post_excerpt; ?>">
    	        <input id="<?php echo $post_excerpt; ?>" type="checkbox" name="<?php echo $post_excerpt; ?>" value="true"<?php checked(TRUE, (bool) get_option($post_excerpt)); ?> /> <?php _e("Display Post Excerpt"); ?>
    	    </label>
    	</p>
    	
    	<p class="submit">
    		<input type="submit" class="button" value="Save Changes" />
    	</p>
    </div> <!-- inside -->
</div> <!-- postbox -->