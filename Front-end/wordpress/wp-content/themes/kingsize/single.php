<?php
/**
 * @KingSize 2011
 **/
$tpl_body_id = 'blog_overview';
get_header(); ?>

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
				            <?php if ( get_option('wm_enable_post_dates') == "1" ) {?>
							<div class="metadata">
				                <p class="post_date"><?php the_time('F jS, Y') ?></p>
				            </div>	
							<?php } else { ?>
							<div class="metadata-no-date">
				            </div>	
							<?php } ?>
							<?php the_content(); ?>

						<?php
							if(get_the_tag_list()) :							
						 ?>
							<div class="metadata_tags">
								<p class="post_tags"><?php the_tags('Tags: ',', '); ?></p>
							</div>	
						<?php endif; ?>

							<?php comments_template( '/comments.php' ); ?>
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