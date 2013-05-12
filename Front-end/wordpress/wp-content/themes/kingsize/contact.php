<?php
/**
 Template Name: Contact Page
 **/
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
			  
    		<!-- Main -->
   			<div id="main">
   			 	
      			<h2 class="section_title"><?php the_title(); ?></h2><!-- This is your section title -->
      			
    			<!-- Content has class "content_two_thirds" to leave some place for the sidebar -->
  				<div id="content" class="content_two_thirds">
					
  					<!-- Post -->
     				<div class="post">
						
						<?php the_content(); ?>
							
		     			<form method="post" action="php/contact-send.php" id="contact_form">
					

						<p><label class="form_label" for='form_name'>Name</label>
							<input id='form_name' type='text' name='name' class="textbox" value='' /></p>
							
						<p><label class="form_label" for='form_email'>E-mail</label>
							<input id='form_email' type='text' name='email' class="textbox" value='' /></p>
							
						<p><label class="form_label" for='form_message'>Message</label>
							<textarea id='form_message' rows='5' cols='25' name='message' class="textbox"></textarea></p>
				
						<input id='form_submit' type='submit' name='submit' value='Send message' />

						<!-- To Email -->
						<input id='to_email' type='hidden' name='to_email' value='<?php echo webmaster_email;?>' />

						<!-- hidden input for basic spam protection -->
						<div class='hide'>
							<label for='spamCheck'>Do not fill out this field</label>
							<input id="spamCheck" name='spam_check' type='text' value='' />
						</div>
									
								
						</form>	
						<!-- contact form ends here-->	
				
						<!-- This div will be shown if mail was sent successfully -->		
						<div class="hide success">
						<p><?php echo thanks_message;?></p>
						</div>
						
						<br /><br />
						
    		  		</div>	
      				<!-- Post ends here -->
     			
  			 </div>
  			 <!-- Content ends here -->
			 
  			   <!-- Sidebar -->
			    <div id="sidebar">			        

				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Contact Page Sidebar") ) : ?> 
				
							<h3>Find us</h3>    
							<div class="sidebar_item">   
								<ul class="contact_list">
									<li class="contact_phone">111-111-1111</li>
									<li class="contact_fax">111-111-1111</li>
									<li class="contact_email">somemail@gmail.com</li>
									<li class="contact_address">111 Some Street, NYC</li>
								</ul>
								
								<img src="<?php echo get_template_directory_uri(); ?>/images/map.jpg" alt="map" class="map" width="180px"/>
							</div>
				<?php endif; ?>
			        
			    </div> 
			    <!-- Sidebar ends here--> 	
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>
