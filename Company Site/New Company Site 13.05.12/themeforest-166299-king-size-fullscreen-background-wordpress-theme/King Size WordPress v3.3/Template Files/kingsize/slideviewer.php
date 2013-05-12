<?php
/**
 Template Name: slideviewer Page
 **/
$tpl_body_id = 'slideviewer';
get_header(); 
update_option('current_page_template','body_portfolio body_slideviewer');

global $wp_query;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
?>	
	<!-- Main wrap -->
		<div id="main_wrap">			
	  		<!-- Main -->
   			 <div id="main">   			 	
			 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      			<h2 class="section_title"><?php the_title();?></h2><!-- This is your section title -->   

					<?php if($content = $post->post_content) { ?>					
					<div id="content_gallery_top" class="content_full_width">
					<?php the_content(); ?>
					</div>					
					<?php } else { the_content(); }  ?>
   				  
				   <?php	
						$checkPasswd = false;
					if (!empty($post->post_password)) { // if there's a password
					if (isset($_COOKIE['wp-postpass_' . COOKIEHASH]) && $_COOKIE['wp-postpass_' . COOKIEHASH] == $post->post_password) {
						$checkPasswd = true;
					 }
					 else
						 $checkPasswd = false;
					}
					else{
						$checkPasswd = true;
					}


					if($checkPasswd == true) :
					?>

      				<!-- slideviewer - place you images here -->
      				 <div id="gallery_slideviewer" class="swv">  
						<ul>
							<?php 
								//getting the page Gallery attachments images
								$args = array('post_type' => 'attachment', 'post_parent' => $post->ID,  'orderby' => menu_order, 'order' => ASC); 
								$attachments = get_children($args); 
								$url_post_img = "";								

								if ($attachments) { 
									foreach ($attachments as $attachment) { 										
										$url_post_img = wm_image_resize('670','450', wp_get_attachment_url($attachment->ID));
										$post_title = $attachment->post_title;
								?>	
									<li><img src="<?php echo $url_post_img;?>" /></li> 
							<?php
								   }
								}
							?>	
							</ul>
						</div>	
						<?php endif; //password protected check ?> 
							<?php endwhile; ?>
						<?php endif;?>
					 <!-- slideviewer ends here -->
					 
						<?php if ( get_option('wm_show_comments') == "1" ) {?>
						<div id="content_gallery_bottom" class="content_full_width">
						<?php comments_template( '/comments.php' ); ?>
						</div>
						<? } else { ?>
						<!-- No Comments -->
						<?php } ?>
					 

<?php get_footer(); ?>