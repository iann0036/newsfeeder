<?php function widget_sf_lastfm($args) { extract($args); ?>

<div id="lastfm-feed" class="content-item widget">
	<div class="content-dets">
		<h3 class="lastfm-title">Latest Tracks</h3>
		
		<ul class="dets">
			<li class="lastfm-link"><a href="http://www.last.fm/" title="Last.FM" target="_blank">View More</a></li>
		</ul>
	</div>
	
	<div class="content-body">
		<div id="lastfmrecords"></div>
	</div>
</div>  <!-- lastfm-feed -->

<?php } register_sidebar_widget('Seven Five - Last.FM', 'widget_sf_lastfm');?>