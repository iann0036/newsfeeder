<?php
/**
* @KingSize 2011
* The PHP code for setup Theme widget twitter.
* Begin creating widget twitter
* Twitter
*/
/**
*	 Feed user twitter
**/

class wm_Twitter extends WP_Widget {
	function wm_Twitter() {
		$widget_ops = array('classname' => 'wm_Twitter', 'description' => 'Display your recent Twitter feed' );
		$this->WP_Widget('wm_Twitter', 'KingSize Twitter Widget', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$twitter_username = empty($instance['twitter_username']) ? ' ' : apply_filters('widget_title', $instance['twitter_username']);
		$title = $instance['title'];
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 5;
		}
		
		if(empty($title))
		{
			$title = 'Recent Tweets';
		}
		
		if(!empty($items) && !empty($twitter_username))
		{
			// user timeline
			include_once (TEMPLATEPATH . "/lib/twitter.lib.php");
			$obj_twitter = new Twitter($twitter_username); 
			$tweets = $obj_twitter->get($items);

			if(!empty($tweets))
			{
				echo '<h3 class="widget-title">'.$title.'</h3>';
				echo '<ul id="twitter_list">';
				
				foreach($tweets as $tweet)
				{
					echo '<li>';
					
					if(isset($tweet[0]))
					{
						echo '<a class="tweet_link" href="'.$tweet[2][0].'">'.$tweet[0].'</a>';
					}
					
					echo '</li>';
				}
				
				echo '</ul>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_username'] = strip_tags($new_instance['twitter_username']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'twitter_username' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$twitter_username = strip_tags($instance['twitter_username']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('twitter_username'); ?>">Username (without @): <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo attribute_escape($twitter_username); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>">Set # of tweets to display: <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo attribute_escape($items); ?>" /></label></p>
<?php
	}
}

register_widget('wm_Twitter');

/**
*	End  Feed user twitter
**/
?>