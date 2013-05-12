<?php
/**
 * @KingSize 2011
 **/
get_header(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
			  
    		<!-- Main -->
   			<div id="main">
   			 	
      			<h2 class="section_title">Sorry, Page Not Found!</h2><!-- This is your section title -->
      			
    			<!-- Content has class "content_full_width" -->
  				<div id="content" class="content_full_width">
					
  					<!-- Post -->
     				<div class="post">
					
							<?php if( get_option('wm_custom_404_title') ) { ?>
							<h3 class="post_title"><?php echo get_option('wm_custom_404_title'); ?></h3>
							<?php } else { ?>	
							<h3 class="post_title">The page your looking for isn't available...</h3>
							<?php } ?>
						
							<?php if( get_option('wm_custom_404') ) { ?>
							<p><?php echo get_option('wm_custom_404'); ?></p>
							<?php } else { ?>	
							<p>We are very sorry for the inconvenience but the page you are looking for either no longer exists or has been moved. Try using the below search box or site index to locate what you're looking for.</p>
							<?php } ?>
							
							<h3>Search can help</h3>
							<p>Please try searching using the search form below.</p>
							
							<div id="page_search">
								<?php get_search_form();?>	
							</div> 
						
							
						
							<div class="one_third">
							<h3>Site Map</h3>
								<ul class="archives"><?php wp_list_pages('depth=3&sort_column=menu_order&title_li='); ?></ul>
							</div>	
								
							<div class="one_third">
							<h3>Categories</h3>
								<ul class="archives"><?php wp_list_categories(); ?></ul>
							</div>

							<div class="one_third_last">
							<h3>Archives</h3>
								<ul class="archives"><?php wp_get_archives(); ?></ul>
							</div>
     						
    		  		</div>	
      				<!-- Post ends here -->
     			
  			 </div>
  			 <!-- Content ends here -->
			 
  			   

<?php get_footer(); ?>