<?php function widget_sf_vimeo($args) { extract($args); ?>

<div id="vimeo-feed" class="content-item">
	<div class="content-dets">
		<h3>Latest Videos</h3>
		
		<ul class="dets">
			<li class="vimeo-link"><a href="http://www.vimeo.com/<?php echo get_option(THEME_PREFIX . "vimeo_name"); ?>" title="Vimeo.com" target="_blank">View More</a></li>
		</ul>
	</div>
	
	<div class="content-body vimeo-container">
		<?php // Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		
		// Get a SimplePie feed object from the specified feed source.
		$vimeo_name = get_option(THEME_PREFIX . "vimeo_name");
		$rss = fetch_feed('feed://vimeo.com/' . $vimeo_name . '/videos/rss');
		
		// Figure out how many total items there are.
		$vimeo_num = get_option(THEME_PREFIX . "vimeo_num");
		$maxitems = $rss->get_item_quantity($vimeo_num); 
		
		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
		?>
		
	    <?php if ($maxitems == 0) echo '<li>No items.</li>';
	    else
	    // Loop through each feed item and display each item as a hyperlink.
	    foreach ( $rss_items as $item ) : ?>

        <div class="vimeo">
	        <div class="vimeo-vid">
	        	<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_title(); ?>" target="_blank"><?php echo $item->get_description(); ?></a>
			</div>
		</div>
	    <?php endforeach; ?>
	</div>
</div> <!-- vimeo-feed -->

<?php } register_sidebar_widget('Seven Five - Vimeo', 'widget_sf_vimeo');?>