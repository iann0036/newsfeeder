<?php function widget_sf_twitter($args) { extract($args); ?>

<div id="twitter-feed" class="content-item">
	<div class="content-dets">
		<h3>Latest Tweets</h3>
		
		<ul class="dets">
			<li class="twitter-link"><a href="http://www.twitter.com/<?php echo get_option(THEME_PREFIX . "twitter_name"); ?>" title="Follow Me" target="_blank">View More</a></li>
		</ul>
	</div>
	
	<div id="twitter" class="content-body">
	    <div id="twitter-last-item"><!-- nothing to see here --></div>
	</div>
	
	<script type="text/javascript">
		$('#twitter').liveTwitter('<?php echo get_option(THEME_PREFIX . "twitter_name"); ?>', {limit: <?php echo get_option(THEME_PREFIX . "twitter_num"); ?>, rate:15000});
	</script>
</div> <!-- twitter-feed -->

<?php } register_sidebar_widget('Seven Five - Twitter', 'widget_sf_twitter');?>