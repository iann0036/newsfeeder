<?php
/**
 * @KingSize 2011
 **/
?>
				
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Blog Sidebar") ) : ?> 		
				<!-- This sidebar will be shown if no widgets used -->	
				<ul>
					<!-- Sidebar item -->
			       <div class="sidebar_item">     
				  	 <h3>Categories</h3>
				  	 		<ul>
							<?php wp_list_categories('title_li='); ?>
							</ul>
			       </div>
			       <!-- Sidebar item ends here-->
			       
			       
			   		<!-- Sidebar item -->
			       <div class="sidebar_item">  
			        	<h3>Recent posts</h3>
				        <ul>
				        	<?php wp_get_archives( array(
							
							    'type'            => 'postbypost',   // or daily, weekly, monthly, yearly
							    'limit'           => 5,   // maximum number shown
							    'format'          => 'html',   // or select (dropdown), link, or custom (then need to also pass before and after params for custom tags
							    'show_post_count' => false,    // show number of posts per link
							    'echo'            => 1     // display results or return array

							) ); ?>
						</ul>
			        </div>
			   		 <!-- Sidebar item ends here-->
			       
			       
			       <!-- Sidebar item -->
			       <div class="sidebar_item">  
			        	<h3>Archives</h3>
				        <ul>
							<?php wp_get_archives('title_li='); ?>
						</ul>
			        </div>
			   		 <!-- Sidebar item ends here-->
			        
				<?php endif; ?>
				