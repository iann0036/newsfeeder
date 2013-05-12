<?php
	$option_fields[] = $facebook_name = THEME_PREFIX . "facebook_name";
	$option_fields[] = $twitter_name = THEME_PREFIX . "twitter_name";
	$option_fields[] = $twitter_num = THEME_PREFIX . "twitter_num";
	$option_fields[] = $flickr_name = THEME_PREFIX . "flickr_name";
	$option_fields[] = $flickr_feed = THEME_PREFIX . "flickr_feed";
	$option_fields[] = $flickr_num = THEME_PREFIX . "flickr_num";
	$option_fields[] = $delicious_name = THEME_PREFIX . "delicious_name";
	$option_fields[] = $delicious_num = THEME_PREFIX . "delicious_num";
	$option_fields[] = $vimeo_name = THEME_PREFIX . "vimeo_name";
	$option_fields[] = $vimeo_num = THEME_PREFIX . "vimeo_num";
	$option_fields[] = $youtube_name = THEME_PREFIX . "youtube_name";
	$option_fields[] = $youtube_num = THEME_PREFIX . "youtube_num";
	$option_fields[] = $feed_name = THEME_PREFIX . "feed_name";
	$option_fields[] = $feed_url = THEME_PREFIX . "feed_url";
	$option_fields[] = $feed_site = THEME_PREFIX . "feed_site";
	$option_fields[] = $feed_num = THEME_PREFIX . "feed_num";
?>

<div class="postbox">
    <h3>Twitter Configuration</h3>
    
    <div class="inside">
    	<p>Enter your Twitter Username:</p>
       	<p><input class="option-field-medium" id="<?php echo $twitter_name; ?>" type="text" name="<?php echo $twitter_name; ?>" value="<?php echo get_option($twitter_name); ?>" /></p>
    	
		<p>Number of Tweets:</p>
		<p><input class="option-field-small" id="<?php echo $twitter_num; ?>" type="text" name="<?php echo $twitter_num; ?>" value="<?php echo get_option($twitter_num); ?>" /></p>
		
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
    <h3>Flickr Configuration</h3>
    
    <div class="inside">
    	<p>Enter your Flickr Username:</p>
       	<p><input class="option-field-medium" id="<?php echo $flickr_name; ?>" type="text" name="<?php echo $flickr_name; ?>" value="<?php echo get_option($flickr_name); ?>" /></p>
        
        <p>Enter your Flickr PhotoStream or Set RSS feed link:</p>
       	<p><input class="option-field" id="<?php echo $flickr_feed; ?>" type="text" name="<?php echo $flickr_feed; ?>" value="<?php echo get_option($flickr_feed); ?>" /></p>
    	
		<p>Number of Images:</p>
		<p><input class="option-field-small" id="<?php echo $flickr_num; ?>" type="text" name="<?php echo $flickr_num; ?>" value="<?php echo get_option($flickr_num); ?>" /></p>
		
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
    <h3>Delicious Configuration</h3>
    
    <div class="inside">
    	<p>Enter your Delicious Username:</p>
       	<p><input class="option-field-medium" id="<?php echo $delicious_name; ?>" type="text" name="<?php echo $delicious_name; ?>" value="<?php echo get_option($delicious_name); ?>" /></p>
    	
		<p>Number of Links:</p>
		<p><input class="option-field-small" id="<?php echo $delicious_num; ?>" type="text" name="<?php echo $delicious_num; ?>" value="<?php echo get_option($delicious_num); ?>" /></p>
		
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
    <h3>Vimeo Configuration</h3>
    
    <div class="inside">
    	<p>Enter your Vimeo.com Username:</p>
       	<p><input class="option-field-medium" id="<?php echo $vimeo_name; ?>" type="text" name="<?php echo $vimeo_name; ?>" value="<?php echo get_option($vimeo_name); ?>" /></p>
    	
		<p>Number of Videos:</p>
		<p><input class="option-field-small" id="<?php echo $vimeo_num; ?>" type="text" name="<?php echo $vimeo_num; ?>" value="<?php echo get_option($vimeo_num); ?>" /></p>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
    <h3>YouTube Configuration</h3>
    
    <div class="inside">
    	<p>Enter Your YouTube.com Username:</p>
       	<p><input class="option-field-medium" id="<?php echo $youtube_name; ?>" type="text" name="<?php echo $youtube_name; ?>" value="<?php echo get_option($youtube_name); ?>" /></p>
    	
		<p>Number of Videos:</p>
		<p><input class="option-field-small" id="<?php echo $youtube_num; ?>" type="text" name="<?php echo $youtube_num; ?>" value="<?php echo get_option($youtube_num); ?>" /></p>
        
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->

<div class="postbox">
    <h3>Custom Feed Configuration</h3>
    
    <div class="inside">
		<p>Enter a Feed Name:</p>
		<p><input class="option-field-medium" id="<?php echo $feed_name; ?>" type="text" name="<?php echo $feed_name; ?>" value="<?php echo get_option($feed_name); ?>" /></p>

    	<p>Enter the adress for your custom RSS feed below: (e.g. "http://www.samplesite.com/feed")</p>
       	<p><input class="option-field" id="<?php echo $feed_url; ?>" type="text" name="<?php echo $feed_url; ?>" value="<?php echo get_option($feed_url); ?>" /></p>
    	
		<p>Enter the Site URL: (e.g. "http://www.samplesite.com")</p>
		<p><input class="option-field-medium" id="<?php echo $feed_site; ?>" type="text" name="<?php echo $feed_site; ?>" value="<?php echo get_option($feed_site); ?>" /></p>
		
		<p>Number of Items:</p>
		<p><input class="option-field-small" id="<?php echo $feed_num; ?>" type="text" name="<?php echo $feed_num; ?>" value="<?php echo get_option($feed_num); ?>" /></p>
		
        <p class="submit">
			<input type="submit" class="button" value="Save Changes" />
		</p>
    </div> <!-- inside -->
</div> <!-- postbox -->