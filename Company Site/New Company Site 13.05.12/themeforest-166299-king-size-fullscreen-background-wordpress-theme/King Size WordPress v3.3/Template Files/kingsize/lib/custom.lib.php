<?php
/**
*	Custom function to get current URL
**/
function curPageURL() {
 	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 	$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
 	 $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} else {
 	 $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	return $pageURL;
}
    
function king_debug($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function gen_pagination($total,$currentPage,$baseLink,$nextPrev=true,$limit=10) 
{ 
    if(!$total OR !$currentPage OR !$baseLink) 
    { 
        return false; 
    } 

    //Total Number of pages 
    $totalPages = ceil($total/$limit); 
     
    //Text to use after number of pages 
    //$txtPagesAfter = ($totalPages==1)? " page": " pages"; 
     
    //Start off the list. 
    //$txtPageList = '<br />'.$totalPages.$txtPagesAfter.' : <br />'; 
     
    //Show only 3 pages before current page(so that we don't have too many pages) 
    $min = ($page - 3 < $totalPages && $currentPage-3 > 0) ? $currentPage-3 : 1; 
     
    //Show only 3 pages after current page(so that we don't have too many pages) 
    $max = ($page + 3 > $totalPages) ? $totalPages : $currentPage+3; 
     
    //Variable for the actual page links 
    $pageLinks = ""; 
    
    $baseLinkArr = parse_url($baseLink);
    $start = '';
    
    if(isset($baseLinkArr['query']) && !empty($baseLinkArr['query']))
    {
    	$start = '&';
    }
    else
    {
    	$start = '?';
    }
     
    //Loop to generate the page links 
    for($i=$min;$i<=$max;$i++) 
    { 
        if($currentPage==$i) 
        { 
            //Current Page 
            $pageLinks .= '<a href="#" class="active">'.$i.'</a>';  
        } 
        elseif($max <= $totalPages OR $i <= $totalPages) 
        { 
            $pageLinks .= '<a href="'.$baseLink.$start.'page='.$i.'" class="slide">'.$i.'</a>'; 
        } 
    } 
     
    if($nextPrev) 
    { 
        //Next and previous links 
        $next = ($currentPage + 1 > $totalPages) ? false : '<a href="'.$baseLink.$start.'page='.($currentPage + 1).'" class="slide">Next</a>'; 
         
        $prev = ($currentPage - 1 <= 0 ) ? false : '<a href="'.$baseLink.$start.'page='.($currentPage - 1).'" class="slide">Previous</a>'; 
    } 
     
    if($totalPages > 1)
    {
    	return '<br class="clear"/><div class="pagination">'.$txtPageList.$prev.$pageLinks.$next.'</div>'; 
    }
    else
    {
    	return '';
    }
     
} 


function king_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="crumbs">';
 
    global $post;
    $home = get_template_directory_uri();
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() && !is_attachment() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}
    

function king_ago($timestamp){
   $difference = time() - $timestamp;
   $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");
   for($j = 0; $difference >= $lengths[$j]; $j++)
   $difference /= $lengths[$j];
   $difference = round($difference);
   if($difference != 1) $periods[$j].= "s";
   $text = "$difference $periods[$j] ago";
   return $text;
}


// Substring without losing word meaning and
// tiny words (length 3 by default) are included on the result.
// "..." is added if result do not reach original string length

function king_substr($str, $length, $minword = 3)
{
    $sub = '';
    $len = 0;
    
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
            break;
        }
    }
    
    return $sub . (($len < strlen($str)) ? '...' : '');
}


/**
*	Setup recent posts widget
**/
function king_posts($sort = 'recent', $items = 3, $echo = TRUE, $bg_color = 'black') 
{
	$return_html = '';
	
	if($sort == 'recent')
	{
		$posts = get_posts('numberposts='.$items.'&order=DESC&orderby=date&post_type=post&post_status=publish');
		$title = 'Recent Posts';
	}
	else
	{
		global $wpdb;
		
		$query = "SELECT ID, post_title, post_content FROM {$wpdb->prefix}posts WHERE post_type = 'post' AND post_status= 'publish' ORDER BY comment_count DESC LIMIT 0,".$items;
		$posts = $wpdb->get_results($query);
		$title = 'Popular Posts'; 
	}
	
	if(!empty($posts))
	{

		$return_html.= '<h2 class="widgettitle">'.$title.'</h2>';
		$return_html.= '<ul class="posts blog '.$bg_color.'_wrapper">';

			foreach($posts as $post)
			{
				$image_thumb = get_post_meta($post->ID, 'blog_thumb_image_url', true);
				$return_html.= '<li>';
				
				if(!empty($image_thumb))
				{
					$return_html.= '<a href="'.get_permalink($post->ID).'"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/timthumb.php?src='.$image_thumb.'&h=75&w=75&zc=1" alt="" /></a>';
				}
				$return_html.= '<h6><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h6>';
				$return_html.= king_substr(strip_tags(strip_shortcodes($post->post_content)), 80).'</li>';

			}	

		$return_html.= '</ul>';

	}
	
	if($echo)
	{
		echo $return_html;
	}
	else
	{
		return $return_html;
	}
}

function _substr($str, $length, $minword = 3)
{
    $sub = '';
    $len = 0;
    
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
            break;
        }
    }
    
    return $sub . (($len < strlen($str)) ? '...' : '');
}

function get_the_content_with_formatting ($more_link_text = 'Read more', $stripteaser = 0, $more_file = '') {
	$content = get_the_content('', $stripteaser, $more_file);
	$content = strip_shortcodes($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = '<p>'._substr(strip_tags($content), 600).'</p>';
	$content.= '<a class="read_more" href="'.get_permalink().'" title="'.get_the_title().'">'.$more_link_text.'</a><!-- Read more link -->';	
	return $content;
}

function image_from_description($data) {
    preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
    return $matches[1][0];
}

?>