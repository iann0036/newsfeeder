<?php
/**
 * @KingSize 2011 - This is the page.php
 *
 * @KingSize Template by Denoizzed and Our Web Media
 * Developed by: Our Web Media 2011
 * Developer URL: http://themeforest.net/user/OurWebMedia
 * Original design by: Denoizzed 2010
 * Author URL: http://themeforest.net/user/Denoizzed
 **/
$tpl_body_id = 'blog_overview';
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">
		
	  		<!-- Main -->
   			<div id="main">
   			 	
					<h2 class="section_title"><?php the_title(); ?></h2><!-- This is your section title -->
      				
      				<!-- Content - full width (class="content_full_width") -->
      				<div id="content" class="content_full_width">
					
					<?php if($content = $post->post_content) { ?>

					<?php the_content(); ?>
			
					<?php } else { the_content(); ?>

					<?php
					$children = wp_list_pages('depth=1&title_li=&child_of='.$post->ID.'&echo=0');
					if ($children) { ?>
					<ul>
					<?php echo $children; ?>
					</ul>
					<?php } ?>		

					<?php } ?>
					
					
					<?php comments_template(); ?>

              		</div> 
              		<!-- Content ends here --> 
		
			
<?php endwhile; endif; ?>

<?php get_footer(); ?>
