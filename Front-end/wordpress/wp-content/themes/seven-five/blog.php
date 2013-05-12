<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<div id="content">
	<?php $more = 0; ?>
	<?php if (have_posts()) : ?>
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("paged=$paged"); ?>
    <?php while (have_posts()) : the_post(); ?> 
    
	<div class="content-item">
		<div class="content-dets">
			<h3>Posted on <?php the_time('M j, Y'); ?></h3>
			
			<ul class="dets">
				<li class="comments-link"><a href="<?php the_permalink() ?>#comments" title=""><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a></li>
			</ul>
		</div>
		
		<div class="content-body">
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="entry">
				<?php the_content('Continue Reading'); ?>
			</div>
		</div>
	</div> <!-- content-item -->
	
	<?php endwhile; else: ?>
    <?php endif; ?>	
</div> <!-- content -->

<?php if(function_exists('sf_pagenavi')) { sf_pagenavi('', '', '', '', 20, false);} ?>

<?php get_footer(); ?>