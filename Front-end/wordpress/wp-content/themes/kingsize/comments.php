<?php
/**
 * @KingSize 2011
 **/
 /**
*	Setup blog comment style
**/
?>

<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if(post_password_required()) { ?>
		<strong><p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'kingsize' ); ?></p></strong>
	<?php
		return;
	}	
?>

<?php
global $i;
$i = 0;
function kingsize_comment($comment, $args, $depth) 
{
	global $i;
	
	$i++;
	$GLOBALS['comment'] = $comment; 
	?>   		
		<li><!-- Single comment -->
			<div class="comment" id="comment-<?php comment_ID() ?>">
				<a href="<?php comment_author_url();?>" target="_blank" class="comment_author"><?php echo $comment->comment_author; ?></a>
				<p class="comment_metadata"><?php comment_time('d F y'); ?> at <?php comment_time('g:ia'); ?></p>
				 <?php echo get_avatar($comment,$size='50',$default=get_template_directory_uri().'/images/comment_avatar.jpg' ); ?>
				<p class="comment_number"><?php echo $i;?></p>
				<p class="comment_text">
					<?php if ($comment->comment_approved == '0') : ?>
							<em><?php _e('(Your comment is awaiting moderation.)') ?></em>						
					<?php endif; ?>
					<?php $commentText = get_comment_text();
						echo strip_tags($commentText);	
					?>
				</p>			
				<p class="comment-reply-link"><?php comment_reply_link(array_merge( $args, array('depth' => $depth,
				'reply_text' => '
				Reply', 'login_text' => 'Log in to reply to this', 'max_depth' => $args['max_depth']))) ?></p>
			</div>	
	
<?php
}
?>


<!-- Comments section here -->
<div id="comments"> 
	<?php
	if( have_comments() ) : ?> 					
		<h3 class="comments_head"><?php comments_number('No comment', '1 Comment', '% Comments'); ?></h3>
		<ul id="comments_list"><!-- Comments list -->
			<?php //wp_list_comments( array('callback' => 'kingsize_comment', 'avatar_size' => '40') ); ?>
			<?php wp_list_comments('callback=kingsize_comment'); ?>
		</ul>  
	<?php endif; ?>  

	<!-- #pagenav-below -->
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div id="pagination">										
				<div class="older"><?php previous_comments_link(); ?></div>						
				<div class="newer"><?php next_comments_link(); ?></div>
		</div>
	<?php endif; ?>
</div>
<!-- Comments section ends here -->

<!-- Comment reply Form integration -->
<?php include(TEMPLATEPATH . '/lib/comment-form.php'); ?>
<!-- End Comment Form integration -->