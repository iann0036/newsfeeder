<?php function widget_sf_youtube($args) { extract($args); ?>

<div id="youtube-feed" class="content-item">
	<div class="content-dets">
		<h3>Latest Videos</h3>
		
		<ul class="dets">
			<li class="youtube-link"><a href="http://www.youtube.com/<?php echo get_option(THEME_PREFIX . "youtube_name"); ?>" title="YouTube.com" target="_blank">View More</a></li>
		</ul>
	</div>
	
	<div class="content-body youtube-container">
		<?php // Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		
		// Get a SimplePie feed object from the specified feed source.
		$youtube_name = get_option(THEME_PREFIX . "youtube_name");
		$rss = fetch_feed('feed://gdata.youtube.com/feeds/base/users/' . $youtube_name . '/uploads?alt=rss&v=2&orderby=published&client=ytapi-youtube-profile');
		
		// Figure out how many total items there are.
		$youtube_num = get_option(THEME_PREFIX . "youtube_num");
		$maxitems = $rss->get_item_quantity($youtube_num); 
		
		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
		?>
		
	    <?php if ($maxitems == 0) echo '<li>No items.</li>';
	    else
	    // Loop through each feed item and display each item as a hyperlink.
	    foreach ( $rss_items as $item ) : ?>

        <div class="youtube">
	        <div class="youtube-vid">
	        	<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_title(); ?>" target="_blank"><?php echo $item->get_description(); ?></a>
			</div>
		</div>
	    <?php endforeach; ?>
	</div>
</div> <!-- youtube-feed -->

<?php } register_sidebar_widget('Seven Five - YouTube', 'widget_sf_youtube');?>