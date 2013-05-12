<?php
	$option_fields[] = $favicon = THEME_PREFIX . "favicon";
?>

<div class="postbox">
    <h3>Favicon Customization Options</h3>
    
    <div class="inside">
		<p>Use the options below to upload and configure a custom favicon. It is recommended that you use an image that is proportionally square (e.g. "50px x 50px").</p>
		
		<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
		
		<label class="upload">
			<p><input class="file" id="favicon_upload" type="file" name="<?php echo THEME_PREFIX; ?>favicon_upload" /></p>
		</label>
		
		<?php if (get_option($favicon)) { ?>
			<p>
				<label for="sideblog_delete_favicon">
					<input class="checkbox" id="sideblog_delete_favicon" type="checkbox" name="<?php echo THEME_PREFIX; ?>delete_favicon" value="true" /> Delete Favicon...
				</label>
			</p>
			<img class="image-preview" src="<?php echo get_option($favicon); ?>" alt="Favicon Preview" />
		<?php } ?>
		
		<input type="hidden" name="<?php echo $favicon; ?>" value="<?php echo get_option($favicon); ?>" />
		    	        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->
