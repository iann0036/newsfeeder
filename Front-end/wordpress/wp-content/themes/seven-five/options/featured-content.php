<?php
	$option_fields[] = $featured_content = THEME_PREFIX . "featured_content";
	$option_fields[] = $featured_num = THEME_PREFIX . "featured_num";
?>

<div class="postbox">
    <h3>Latest Blog Posts</h3>
    
    <div class="inside">
    	<p>Select a category below for which you wish to display featured posts on the home page.</p>
		
		<div class="table">
			<div class="row">
				<div class="option">
			    	<label for="<?php echo $featured_content; ?>">Choose a Category:</label>
				</div>
				
				<div class="option-select">	
					<?php wp_dropdown_categories( array( 'name' => $featured_content, 'id' => $featured_content,'selected' => get_option($featured_content) ) ); ?>
				</div>
			</div>
			
			<div class="row last">
				<div class="option">
			    	<label class="config_level">
						<label>Number of Posts to Display:</label>
					</label>
				</div>
				
				<div class="option-select">	
					<input class="option-field-table" id="<?php echo $featured_num; ?>" type="text" name="<?php echo $featured_num; ?>" value="<?php echo get_option($featured_num); ?>" />
				</div>
			</div>
		</div>	
		
		<p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->