<?php
/**
 Template Name: Blog Template
 **/
 $tpl_body_id = 'blog_overview';
get_header(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
					
    		<!-- Main -->
   			 <div id="main">
   			 	
     			<h2 class="section_title"><?php the_title(); ?></h2><!-- This is your section title -->
     				
					<?php if ( get_option('wm_sidebar_enabled') == "1" ) {?>
      				<div id="content" class="content_two_thirds">
					<?php } else { ?>
					<div id="content" class="content_full_width">
					<?php } ?>
    					
						<?php
						$paged = intval(get_query_var('paged'));
						if(empty($paged))
							$paged = intval(get_query_var('page'));

						$temp = $wp_query;
						$wp_query= null;
						$wp_query = new WP_Query();					
						$wp_query->query('posts_per_page=5'.'&paged='.$paged);
						while ($wp_query->have_posts()) : $wp_query->the_post();
						?>
      					<!-- Post -->
         				 <div class="post">
    						  <h3 class="post_title">
							  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
         							
						  		<!-- Post details -->
					           <div class="metadata">
							   <?php if ( get_option('wm_enable_blog_dates') == "1" ) {?>
					                 <p class="post_date"><?php the_time('F jS, Y'); ?></p><?php //edit_post_link('edit post', ', ', ''); ?>
					                 <a class="post_comments" href="<?php the_permalink(); ?>#comments"><?php comments_number('No comment', '1 Comment', '% Comments'); ?></a>
							   <?php } else { ?>
					                 <a class="post_comments" href="<?php the_permalink(); ?>#comments"><?php comments_number('No comment', '1 Comment', '% Comments'); ?></a>
							   <?php } ?>
					            </div>
					            
								<!-- Post thubmnail -->	
									<?php
									//show the image in lightbox									
										$show_image_lightbox = get_post_meta($post->ID, 'kingsize_featured_img_lightbox', true );
									?>

									<?php if ( get_option('wm_sidebar_enabled') == "1" ) {
										if($show_image_lightbox=='enable')
											$url_post_img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
										else
											$url_post_img = get_permalink( $post->ID );
										?>
										<a href="<?php echo $url_post_img; ?>" class="image" title="<?php echo $post_title;?>" <?php if($show_image_lightbox=='enable'){ echo 'rel="gallery"'; }?>><?php the_post_thumbnail(); ?></a>
									<?php } else { ?>
									<?php  //showing full width
										if(has_post_thumbnail()):
											$org_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
											$attachment_id =  get_post_thumbnail_id($post->ID);
											$url_post_img = wm_image_resize('680','180', wp_get_attachment_url($attachment_id));
											
											if($show_image_lightbox=='enable')
												echo '<a href="'.$org_img_url.'" class="image" title="'.$post_title.'" rel="gallery"><img src="'.$url_post_img.'" alt="" class="blog_thumbnail"/></a>';
											else 
												echo '<a href="'.get_permalink( $post->ID ).'" class="image" title="'.$post_title.'"><img src="'.$url_post_img.'" alt="" class="blog_thumbnail"/></a>';
											
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

						<div id="pagination-container">

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
						
						</div>
						
						<?php $wp_query = null; $wp_query = $temp;?>
					
    			 </div>
     			<!-- Content ends here -->
      
     			
  			   <!-- Sidebar begins here -->
			   <?php if ( get_option('wm_sidebar_enabled') == "1" ) {?>
			    <div id="sidebar">			        
					<?php get_sidebar(); ?>
			    </div> 
				<?php } ?>
			    <!-- Sidebar ends here--> 

<?php get_footer(); ?>
