<?php
function kingsize_video($postid) {
	
	$video_url = get_post_meta($postid, 'kingsize_video_url', true);
	$height = get_post_meta($postid, 'kingsize_video_height', true);
	$embeded_code = get_post_meta($postid, 'kingsize_embed_code', true);
	
	if($height == '')
		$height = 300;

	if(trim($embeded_code) == '') 
	{
		
		if(preg_match('/youtube/', $video_url)) 
		{
			
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches))
			{
				/*$output = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="460" height="'.$height.'" src="http://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allowFullScreen></iframe>';*/

				$output = '<object width="460" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$matches[1].'"></param>
				<param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$matches[1].'" type="application/x-shockwave-flash" wmode="transparent" width="460" height="'.$height.'"></embed></object>';

				
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>YouTube</strong> URL. Please check it again.', 'framework');
			}
			
		}
		elseif(preg_match('/vimeo/', $video_url)) 
		{
			
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				$output = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="460" height="'.$height.'" frameborder="0"></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}
			
		}
		else 
		{
			$output = __('Sorry that is an invalid YouTube or Vimeo URL.', 'framework');
		}
		
		echo $output;
		
	}
	else
	{
		echo stripslashes(htmlspecialchars_decode($embeded_code));
	}
	
}

function kingsize_thumb_box($postid) {
	global $no_of_page_columns;

	$lightbox = "true";
	
	$image_portfolio = get_post_meta($postid, 'upload_image', true);

	$video_thumb_image = get_post_meta($postid, 'upload_image_thumb', true);
	$video = get_post_meta($postid, 'kingsize_video_url', true);
	$height = get_post_meta($postid, 'kingsize_video_height', true);
	$embed = trim(get_post_meta($postid, 'kingsize_embed_code', true));
	
	if($height=='')
		$lightbox_height = 350;
	else
		$lightbox_height = $height + 20;

	if($image_portfolio != '')
		$overview_image = $image_portfolio;
	elseif($video_thumb_image!='')
		$overview_image = $video_thumb_image;
	
	//// Getting the number of columns	
	if(empty($no_of_page_columns))
		$no_of_page_columns = "2columns";

	if($no_of_page_columns=="2columns")
		$url_post_img = wm_image_resize('330','220', $overview_image);
	elseif($no_of_page_columns=="3columns")
		$url_post_img = wm_image_resize('220','140', $overview_image);
	elseif($no_of_page_columns=="4columns")
		$url_post_img = wm_image_resize('160','110', $overview_image);
	elseif($no_of_page_columns=="grid")
		$url_post_img = wm_image_resize('112','112', $overview_image);
	////// End number of columns /////

	//getting the thumbnail
	if($overview_image == '')
	{
		$thumb = get_the_post_thumbnail($postid, 'thumbnail-post');
	}
	else
	{
		$thumb = '<img src="'.$url_post_img.'" alt="'.get_the_title().'" />';
	}
	
	//SETTING of the Lightbox on Portfolio items of write up panel
	if(get_post_meta( $postid, 'portfolios_lightbox_disable', true ) == 'disable') :
		$lightbox = 'false';
	else :
		$lightbox = 'true';		
	endif;


	if($lightbox == 'true') :	
		if($embed != '')
		{
			$output = '<a rel="prettyPhoto[gallery]" title="'.get_the_title($postid).'" href="'.get_template_directory_uri().'/lib/portfolio/kingsize-portfolio-video.php?id='.$postid.'&iframe=true&width=auto&height=auto" class="video">'.$thumb.'</a>';
		}
		elseif($video != '' && $embed == '') 
		{
			$output = '<a rel="prettyPhoto[gallery]" title="'.get_the_title($postid).'" href="'.$video.'" class="video">'.$thumb.'</a>';
		}
		else
		{
			$output = '<a rel="prettyPhoto[gallery]" title="'.get_the_title($postid).'" href="'.$image_portfolio.'" class="image">'.$thumb.'</a>';
		}	
	else :	
		$permalink = get_permalink( $postid );
		$output = '<a title="'.get_the_title($postid).'" href="'.$permalink.'" class="image">'.$thumb.'</a>';
	endif;
	
	echo $output;
}

?>