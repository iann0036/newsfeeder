<?php
/**
 * @KingSize 2011
 **/
$tpl_body_id = 'prettyphoto';
$tpl_body_id = 'blog_overview';
get_header(); 
update_option('current_page_template','body_portfolio body_portfolio body_gallery_2col_pp');
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
			  
    		<!-- Main -->
   			<div id="main">
   			 	
      			<h2 class="section_title"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h2><!-- This is your section title -->
     			
    			<!-- Content has class "content_two_thirds" to leave some place for the sidebar -->
  				<?php if ( get_option('wm_sidebar_enabled') == "1" ) {?>
      			<div id="content" class="content_two_thirds">
				<?php } else { ?>
				<div id="content" class="content_full_width">
				<?php } ?>
					
				<!-- Post -->
				<div class="post single_post">
					  <h3 class="post_title"><a href=""><?php the_title(); ?></a></h3>
							
						<!-- Post details -->
						<?php if ( get_option('wm_enable_portfolio_dates') == "1" ) {?>
						<div class="metadata">
							<p class="post_date"><?php the_time('F jS, Y') ?></p>
						</div>	
						<?php } else { ?>
						<div class="metadata-no-date">
						</div>	
						<?php } ?>						
						<?php the_content(); ?>
						
						<?php if ( get_option('wm_portfolio_image_enabled') == "1" ) {?>
						 <?php 
							$video_url = get_post_meta(get_the_ID(), 'kingsize_video_url', true);
							$embeded_code = get_post_meta(get_the_ID(), 'kingsize_embed_code', true);
						?>
						 <?php if($video_url !='' || $embeded_code != '') : ?>
							<p><?php kingsize_video(get_the_ID()); ?></p>
						  <?php else : 
								  $image_portfolio = get_post_meta(get_the_ID(), 'upload_image', true);
								  $url_post_img = wm_image_resize('480','300', $image_portfolio);
								 echo '<img src="'.$url_post_img.'" alt="'.get_the_title().'" />';
						  ?>		
							
						  <?php endif; ?>
						<?php } ?>
						
						
						<?php if ( get_option('wm_show_comments') == "1" ) {?>
							<div id="content_gallery_bottom" class="content_full_width">
								<?php comments_template( '/comments.php' ); ?>
							</div>
						<? } else { ?>
						<!-- No Comments -->
						<?php } ?>
				</div>	
				<!-- Post ends here -->
     			
  			 </div>
  			 <!-- Content ends here -->
			 
  			   <!-- Sidebar begins here -->
			   <?php if ( get_option('wm_sidebar_enabled') == "1" ) {?>
			    <div id="sidebar">			        
					<?php get_sidebar(); ?>
			    </div> 
				<?php } ?>
			    <!-- Sidebar ends here--> 	
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>