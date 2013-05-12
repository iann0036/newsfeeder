<?php
/**
 * @KingSize 2011
 * Comment Form single.php
 **/
?>
<?php if ('open' == $post->comment_status) : ?> 		

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p><br/>
	<?php else : ?>
<!-- Leave a comment box -->										
	<div id="respond">
		<h3 class="comments_head">Leave a reply</h3>	
		<p class="comment_info">Fields marked with * are required</p>	

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment_form"> 	
		<?php if ( is_user_logged_in() ) : ?>
			Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a><br/><br/>
		<?php else : ?>
			<p><label class="name_label" for="form_name">Name*</label>
			<input type="text" name="author" id='form_name' class="textbox" /></p>
				
			<p><label class="email_label" for="form_email"> E-mail*</label> 
			<input type="text" name="email" id='form_email' class="textbox"/></p>
					
			<p><label class="website_label" for="form_website"> Website</label>
			<input type="text" name="url" id='form_website' class="textbox"/></p>
		<?php endif; ?>
		
			<p> <label class="message_label" for="form_message">Message*</label> <textarea name="comment" id='form_message' rows="6" cols="25" class="textbox"></textarea> </p>
					
			<p><input type="submit" name="submit" id="form_submit" value="Submit!" />&nbsp;<?php cancel_comment_reply_link("Cancel Reply"); ?> </p>
			<?php comment_id_fields(); ?> 
			<?php do_action('comment_form', $post->ID); ?>
		</form>	
	</div>
<!-- Leave a comment box ends here -->	

	<?php endif; // If registration required and not logged in ?>
<?php endif; ?> 