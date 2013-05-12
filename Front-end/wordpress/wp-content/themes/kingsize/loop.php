		<!-- Main wrap -->
		<div id="main_wrap">  
					
    		<!-- Main -->
   			 <div id="main">
   			 	
     			<h2 class="section_title"><?php if(is_search()) { ?>
					<?php echo $wp_query->found_posts; ?> <?php echo "search results for "; ?> "<?php echo esc_html($s); ?>"
						<?php } elseif(is_category()) { ?>
							<?php single_cat_title(); ?>
						<?php } elseif(is_tag()) { ?>
							<?php single_tag_title(); ?>
						<?php } elseif(is_author()) { ?>
							<?php wp_title(''); ?>'s Posts
						<?php } elseif(is_archive()) { ?>
							Archive: <?php wp_title(); ?>			
					<?php } ?></h2><!-- This is your section title -->
     				
					<?php if ( get_option('wm_sidebar_enabled') == "1" ) {?>
      				<div id="content" class="content_two_thirds">
					<?php } else { ?>
					<div id="content" class="content_full_width">
					<?php } ?>
    					
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      					<!-- Post -->
         				 <div class="post">
    						  <h3 class="post_title">
							  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
         							
						  		<!-- Post details -->
					           <div class="metadata">
					                 <p class="post_date"><?php the_time('F jS, Y'); ?></p><?php //edit_post_link('edit post', ', ', ''); ?>
					                 <a class="post_comments" href="<?php the_permalink(); ?>#comments"><?php comments_number('No comment', '1 Comment', '% Comments'); ?></a>
					            </div>
					            <!-- Post thubmnail -->	
									<?php
									//show the image in lightbox									
										$show_image_lightbox = get_post_meta($page->ID, 'kingsize_featured_img_lightbox', true );
									?>
									<?php if ( get_option('wm_sidebar_enabled') == "1" ) {
										if($show_image_lightbox=='enable')
											$url_post_img = wp_get_attachment_url( get_post_thumbnail_id( $page->ID ) );
										else
											$url_post_img = get_permalink( $page->ID );
										?>
										<a href="<?php echo $url_post_img; ?>" class="image" title="<?php echo $post_title;?>" <?php if($show_image_lightbox=='enable'){ echo 'rel="gallery"'; }?>><?php the_post_thumbnail(); ?></a>
									<?php } else { ?>
									<?php  //showing full width
										if(has_post_thumbnail()):
											$org_img_url = wp_get_attachment_url( get_post_thumbnail_id( $page->ID ) );
											$attachment_id =  get_post_thumbnail_id($page->ID);
											$url_post_img = wm_image_resize('680','180', wp_get_attachment_url($attachment_id));

											if($show_image_lightbox=='enable')
												echo '<a href="'.$org_img_url.'" class="image" title="'.$post_title.'" rel="gallery"><img src="'.$url_post_img.'" alt="" class="blog_thumbnail"/></a>';
											else 
												echo '<a href="'.get_permalink( $page->ID ).'" class="image" title="'.$post_title.'"><img src="'.$url_post_img.'" alt="" class="blog_thumbnail"/></a>';
										endif;
									?>
									<?php } ?>
								<!-- END Post thubmnail -->

								<!-- POST Content -->
								<?php if ( get_option('wm_enable_excerpts') == "1" ) {?>
								<?php echo get_the_content_with_formatting(get_option('wm_read_more_text')); ?>
								<?php } else { ?>
								<?php echo get_content(); ?>
								<?php } ?>
								<!-- POST Content END -->
						</div>
						<!-- Post ends here -->    
						<?php endwhile; ?>							
						<?php else : ?>		
						 <div class="post">
						  <div id="page_search">
						  	<p>Nothing found. Please try using the below search box or site index to locate what you're looking for.</p>
							<?php get_search_form();?>	
							</div> 
						  </div>
						<?php endif; ?>	
					
    			 </div>
     			<!-- Content ends here -->
      
     			
  			   <!-- Sidebar begins here -->
			   <?php if ( get_option('wm_sidebar_enabled') == "1" ) {?>
			    <div id="sidebar">			        
					<?php get_sidebar(); ?>
			    </div> 
				<?php } ?>
			    <!-- Sidebar ends here--> 
    	 
			
			<!-- Pagination -->
			<?php if (  $wp_query->max_num_pages > 1 ) : $paged = intval(get_query_var('paged')); ?>
				<?php if ( get_option('wm_sidebar_enabled') == "1" ) {?>
				<div id="pagination">										
					<div class="older"><?php next_posts_link( __( 'Older entries', 0 ) ); ?></div>
	
					<?php if($paged > 1) :?>
						<div class="newer"><?php previous_posts_link( __( 'Newer entries', 0 ) ); ?></div>
					<?php endif; ?>
				</div><!-- #nav-below -->
				<?php } else { ?>
				
					<div id="pagination-full">										
					<div class="older"><?php next_posts_link( __( 'Older entries', 0 ) ); ?></div>
	
					<?php if($paged > 1) :?>
						<div class="newer"><?php previous_posts_link( __( 'Newer entries', 0 ) ); ?></div>
					<?php endif; ?>
				</div><!-- #nav-below -->
				<?php } ?>
			<?php endif; ?>
			<!-- End Pagination -->
			
<?php get_footer(); ?>
