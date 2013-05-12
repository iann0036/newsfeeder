<?php
/**
 * @KingSize 2011
 * For the configuration load into the Tinymce@ShortCodes V 1.0
 **/
// Bootstrap file for getting the ABSPATH constant to wp-load.php
require_once('config.php');

// validation for user rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed"));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $themename .' Shortcodes'; ?></title>
	<!-- Calling meta and JS of TinyMce -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/lib/tinymce/tinymce.js"></script>
	<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('put_shortcode_select').focus();" style="display: none">

	<form name="kingsize_style" action="#">
	<div class="tabs">
		<ul>
			<li id="style_tab" class="current"><span><a href="javascript:mcTabs.displayTab('style_tab','shortcode_panel');" onmousedown="return false;"><?php echo 'Styles'; ?></a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper" style="height:142px;">

		<div id="shortcode_panel" class="style_panel">
		<br />
		<fieldset>
			<legend>Insert a shortcode from the drop down menu.</legend>
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="put_shortcode_select">Select Custom Style:</label></td>
            <td> <!-- Putting all of the shortcodes shortcode of lib/shortcodes.php -->
			<select id="put_shortcode_select" name="put_shortcode_select" style="width: 200px">
                <option value="0">No Style</option>
				<option value="one_third">one third div</option>
				<option value="one_third_last">one third div last</option>
				<option value="two_thirds">two thirds div</option>
				<option value="two_thirds_last">two thirds div last</option>
				<option value="button">button</option>
				<option value="info_box">info box</option>
				<option value="warning_box">warning box</option>
				<option value="error_box">error box</option>
				<option value="download_box">download box</option>
				<option value="blockquote">blockquote</option>
				<option value="tooltip_link">tooltip link</option>
            </select>
			</td>
          </tr>
        </table>
		</fieldset>
		</div>

	</div>

	<div class="mceActionPanel">
		<div style="float: left;">
			<input type="button" id="cancel" name="cancel" value="<?php echo "Cancel"; ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right;">
			<input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onclick="insertkingsizeLink();" />
		</div>
	</div>
</form>
</body>
</html>
