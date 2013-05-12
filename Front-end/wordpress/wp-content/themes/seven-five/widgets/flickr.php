<?php function widget_sf_flickr($args) { extract($args); ?>

<div id="flickr-feed" class="content-item widget">
	<div class="content-dets">
		<h3 class="flickr-title">Latest Pictures</h3>
		
		<ul class="dets">
			<li class="flickr-link"><a href="http://www.flickr.com/photos/<?php echo get_option(THEME_PREFIX . "flickr_name"); ?>/" title="Flickr.com" target="_blank">View More</a></li>
		</ul>
	</div>
	
	<div class="content-body">
		<?php // Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		include_once(TEMPLATEPATH . '/scripts/flickr.php');
		
		$flickr_feed = get_option(THEME_PREFIX . "flickr_feed");
		$rss = fetch_feed('' . $flickr_feed . '');
		$thumb = 'square';
		$full = 'medium';
		
		// Figure out how many total items there are.
		$flickr_num = get_option(THEME_PREFIX . "flickr_num");
		$maxitems = $rss->get_item_quantity($flickr_num); 
		
		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
		?>

		<?php if ($maxitems == 0) echo '<li>No items.</li>';
	    else
	    
	    // Loop through each feed item and display each item as a hyperlink.
	    foreach ( $rss_items as $item ):
			$url = flickr::find_photo($item->get_description());
			$title = flickr::cleanup($item->get_title());
			$full_url = flickr::photo($url, $full);
			$thumb_url = flickr::photo($url, $thumb);
		?>
		 
		<a class="preview" href="<?php echo $item->get_permalink(); ?>" rel="<?php echo $full_url; ?>">
			<img class="flickr-img" src="<?php echo $thumb_url; ?>" alt="<?php echo $item->get_title(); ?>" />
		</a>
		 
		<?php endforeach; ?>
	</div>
</div>  <!-- flickr-feed -->

<?php } register_sidebar_widget('Seven Five - Flickr', 'widget_sf_flickr');?>