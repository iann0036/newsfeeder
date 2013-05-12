<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

<div id="comments" class="content-item">
	<div class="content-dets">
		<h3><?php comments_number('0 Comments','1 Comment','% Comments'); ?></h3>
		
		<ul class="dets">
			<li><a href="<?php the_permalink() ?>#respond" title="Reply">Leave a Reply</a></li>
		</ul>
	</div>
	
	<div class="content-body">
		<ul class="commentlist">
			<?php wp_list_comments('avatar_size=42'); ?>
		</ul>	
		<div id="comments-last-item"><!-- nothing to see here --></div>					
	</div>
</div>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond" class="content-item">
	<div class="content-dets">
		<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply' ); ?></h3>
		
		<ul class="dets">
			<?php if ( is_user_logged_in() ) : ?>
			<li>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></li>
			<?php endif; ?>
			<li><?php cancel_comment_reply_link(); ?></li>
		</ul>
	</div>
	
	<div class="content-body">
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
		<?php if ( is_user_logged_in() ) : ?>
		<?php else : ?>
		<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>
		
		<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>
		
		<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
		<label for="url"><small>Website</small></label></p>
		<?php endif; ?>
		
		<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
		
		<p><input name="submit" type="submit" value="" id="submit" tabindex="5" />
		<?php comment_id_fields(); ?>
		</p>
		<?php do_action('comment_form', $post->ID); ?>
		
		</form>
	</div>
</div>

<?php endif; ?>