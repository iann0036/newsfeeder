<?php
/*
Template Name: Portfolio Page
*/
?>
<?php
define('TERM_TAXONOMY', $wpdb->prefix . 'term_taxonomy');
define('POSTS', $wpdb->prefix . 'posts');
define('TERM_RELATIONSHIPS', $wpdb->prefix . 'term_relationships');

$tpl_body_id = 'prettyphoto';
get_header(); 
update_option('current_page_template','body_portfolio body_prettyphoto body_gallery_2col_pp');

global $wp_query,$no_of_page_columns;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

$no_of_page_columns = get_post_meta( $wp_query->post->ID, 'kingsize_page_columns', true );
if(empty($no_of_page_columns))
	$no_of_page_columns = "2columns";


#### Getting the portfolio selected category from meta data ####
$kingsize_page_porfolio_category = get_post_meta( $wp_query->post->ID, 'kingsize_page_porfolio_category', true );

/// SQL FOR THE PORTFOLIO CATEGORY DATA ///
$sql_term_taxonomy_id = "";
if($kingsize_page_porfolio_category > 0 )
	$sql_term_taxonomy_id = '  AND '.TERM_TAXONOMY.'.term_taxonomy_id = "'.$kingsize_page_porfolio_category.'"';

$get_portfolio = 'SELECT * 
FROM '.POSTS.'
LEFT JOIN '.TERM_RELATIONSHIPS.' ON ( '.POSTS.'.ID = '.TERM_RELATIONSHIPS.'.object_id )
LEFT JOIN '.TERM_TAXONOMY.' ON ( '.TERM_RELATIONSHIPS.'.term_taxonomy_id = '.TERM_TAXONOMY.'.term_taxonomy_id )
WHERE '.POSTS.'.post_type = "portfolio"
AND '.POSTS.'.post_status = "publish"
AND '.TERM_TAXONOMY.'.taxonomy = "portfolio-category"
'. $sql_term_taxonomy_id .' GROUP BY '.POSTS.'.ID
ORDER BY '.POSTS.'.post_date DESC';

/// PAGING GO HERE //
if(get_option('wm_portfolio_num_items'))
	$_portfolio_num_items = get_option('wm_portfolio_num_items');
else
	$_portfolio_num_items = 10;

$totalposts = $wpdb->get_results($get_portfolio, OBJECT); 
$ppp = intval($_portfolio_num_items); //10 posts per page you might use $ppp = intval(get_query_var('posts_per_page')); //$ppp Page per post
$wp_query->found_posts = count($totalposts);
$wp_query->max_num_pages = ceil($wp_query->found_posts / $ppp);
$on_page = intval(get_query_var('paged'));
if($on_page == 0){ $on_page = 1; }
$offset = ($on_page-1) * $ppp;

//paging offset
$paging_sql = "  LIMIT $ppp OFFSET $offset";
$get_portfolio .= $paging_sql; 
?>		

	<!-- Main wrap -->
		<div id="main_wrap">			
	  		<!-- Main -->
   			 <div id="main">   			 	
	
					 <?php if (have_posts()) : while (have_posts()) : the_post(); ?><!-- This is your section title -->
					 <h2 class="section_title"><?php the_title();?></h2>

					<?php if($content = $post->post_content) { ?>
						<div id="content_gallery_top" class="content_full_width">
						<?php the_content(); ?>
						</div>				
					<?php } else { 
						the_content(); 
					 } ?>
			 
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
					
      					<!-- Gallery with PrettyPhoto plugin -->
      					<div id="gallery_prettyphoto" class="portfolio">
						     <ul class="gallery_<?php echo $no_of_page_columns;?>">
							 <?php 
								$count = 1;
								$pageposts = $wpdb->get_results($get_portfolio, 'ARRAY_A');
								if (empty($pageposts)) :
									echo "<li>No portfolio yet.</li>";								
								else :
								foreach($pageposts as $post) :
									 setup_postdata($post); 

									$the_post = get_post( $post["ID"], ARRAY_A );
									
									//if CUSTOM LINK has been set from write up panel for the permalink
									if(get_post_meta( $post["ID"], 'portfolios_read_more_link', true ) != '') :
										$permalink = get_post_meta( $post["ID"], 'portfolios_read_more_link', true );
									else :
										$permalink = get_permalink( $post["ID"] );
									endif;
								?>
								<li>            
                                    <h3 class="post_title"><a href="<?php echo $permalink; ?>"><?php echo $the_post["post_title"]; ?></a></h3>  
									<!-- Portfolio post-thumb gallery -->
										<?php kingsize_thumb_box($post["ID"]); ?>
									<!-- END Portfolio post-thumb gallery -->
									 <!--BEGIN excerpt content -->
	                                    <p><?php echo substr($post["post_excerpt"],0,210); ?></p>
									 <!--END excerpt content -->

									<?php
									//checking read more text has been set from the write up panel
									if(get_post_meta( $post["ID"], 'portfolios_read_more_disable', true ) != 1) :

										if(get_post_meta( $post["ID"], 'portfolios_read_more_text', true ) != '') :
											echo '<a href="'.$permalink.'" class="more-link">'.get_post_meta( $post["ID"], 'portfolios_read_more_text', true ).'</a>';
										else :
											echo '<a href="'.$permalink.'" class="more-link">Read More</a>';
										endif;
									
									endif;
									?>
                                </li>	
								<?php
								$count++;
								?>
								<?php endforeach; 
								endif;								
								?>
							</ul>													
						</div>	
						<?php endif; //password protected check ?> 
						<?php endwhile; ?>
						<?php endif;?>
						<!-- Gallery ends here -->	
						
						<?php if ( get_option('wm_show_comments') == "1" ) {?>
							<div id="content_gallery_bottom" class="content_full_width">
								<?php comments_template( '/comments.php' ); ?>
							</div>
						<? } else { ?>
						<!-- No Comments -->
						<?php } ?>


					<!-- Pagination -->
					<?php if (  $wp_query->max_num_pages > 1 ) : $paged = intval(get_query_var('paged')); ?>							
							<div id="pagination-full">										
							<div class="older"><?php next_posts_link( __( 'Older entries', 0 ) ); ?></div>
			
							<?php if($paged > 1) :?>
								<div class="newer"><?php previous_posts_link( __( 'Newer entries', 0 ) ); ?></div>
							<?php endif; ?>
						</div><!-- #nav-below -->						
					<?php endif; ?>
					<!-- End Pagination -->

<?php get_footer(); ?>