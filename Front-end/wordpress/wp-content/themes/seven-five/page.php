<?php get_header(); ?>

<div id="content">
	<div class="content-item">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="content-dets">
			<h3><?php the_time('F j, Y'); ?></h3>
			
			<ul class="dets">
				<li class="subscribe-link"><a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe">Subscribe</a></li>
			</ul>
		</div>
		
		<div class="content-body">
			<h2><?php the_title(); ?></h2>
			
			<div class="entry">
				<?php the_content(''); ?>
			</div>			
		</div>
		
		<?php endwhile; else: ?>
        <?php endif; ?>
	</div> <!-- content-item -->
</div> <!-- content -->

<?php get_footer(); ?>