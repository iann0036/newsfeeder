<?php 
/*
General functions of theme
*/

/////////////////////////////////////////////////
//
// ADD ATTACHMENTS
//
/////////////////////////////////////////////////
function add_attachment($file) {
	
	$url = $file['url'];
	$type = $file['type'];
	$file = $file['file'];
	$filename = basename($file);

	// Construct the attachment array
	$attachment = array(
		'post_title' => $filename,
		'post_content' => $descr,
		'post_type' => 'attachment',
		'post_parent' => $post,
		'post_mime_type' => $type,
		'guid' => $url
	);

	// Save the data
	$id = wp_insert_attachment($attachment, $file, $post);
	if (preg_match('!^image/!', $attachment['post_mime_type'])) {
		$imagesize = getimagesize($file);
		$imagedata['width'] = $imagesize['0'];
		$imagedata['height'] = $imagesize['1'];
		list($uwidth, $uheight) = get_udims($imagedata['width'], $imagedata['height']);
		$imagedata['hwstring_small'] = "height='$uheight' width='$uwidth'";
		$imagedata['file'] = $file;
		add_post_meta($id, '_wp_attachment_metadata', $imagedata);
	}
}

/////////////////////////////////////////////////
//
// IMAGE RESIZE
//
/////////////////////////////////////////////////
function wm_image_resize($width, $height, $img_url) {	
	global  $blog_id; 
	$quality = 100;
	$url = get_template_directory_uri();
	
	if ($r_resize == 'yes' || !isset($r_resize)) {

	  //There's a thumbnail image set, so check if we're on WPMU or WP
		if (isset($blog_id) && $blog_id > 0)
		{
			//We're on WPMU		
			$imageParts = explode('/files/', $img_url);			   
			if (isset($imageParts[1]))
			{
				$img_url = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
				$img_url = $url.'/timthumb.php?src='.$img_url.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q='.$quality;
			}
			else{
				$img_url = $url.'/timthumb.php?src='.$img_url.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q='.$quality;
			}
		}
		else
		{
			$img_url = $url.'/timthumb.php?src='.$img_url.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q='.$quality;
		}
	}
	else $img_url = $img_url;
	return urldecode($img_url);
}

