<?php get_header(); ?>

<div id="content">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page') ) : ?>
	<?php endif; ?>
</div> <!-- content -->

<?php get_footer(); ?>