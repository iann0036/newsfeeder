<?php function widget_sf_feed($args) { extract($args); ?>

<div id="rss-feed" class="content-item">
	<div class="content-dets">
		<h3><?php echo get_option(THEME_PREFIX . "feed_name"); ?></h3>
		
		<ul class="dets">
			<li class="rss-feed-link"><a href="<?php echo get_option(THEME_PREFIX . "feed_site"); ?>" title="<?php echo get_option(THEME_PREFIX . "feed_name"); ?>" target="_blank">View More</a></li>
		</ul>
	</div>
	
	<div class="content-body feed-container">
		<?php // Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		
		// Get a SimplePie feed object from the specified feed source.
		$feed_url = get_option(THEME_PREFIX . "feed_url");
		$rss = fetch_feed('' . $feed_url . '');
		
		// Figure out how many total items there are.
		$feed_num = get_option(THEME_PREFIX . "feed_num");
		$maxitems = $rss->get_item_quantity($feed_num); 
		
		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
		?>
		
		<ul id="feed">
		    <?php if ($maxitems == 0) echo '<li>No items.</li>';
		    else
		    // Loop through each feed item and display each item as a hyperlink.
		    foreach ( $rss_items as $item ) : ?>
		    <li>
		        <h2><a href="<?php echo $item->get_permalink(); ?>" title="<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>" target="_blank"><?php echo $item->get_title(); ?></a></h2>
		        <p><?php echo $item->get_description(); ?></p>
		    </li>
		    <?php endforeach; ?>
		</ul>
		
		<div id="feed-last-item"><!-- nothing to see here --></div>
	</div>
</div> <!-- feed-feed -->

<?php } register_sidebar_widget('Seven Five - Feed', 'widget_sf_feed');?>