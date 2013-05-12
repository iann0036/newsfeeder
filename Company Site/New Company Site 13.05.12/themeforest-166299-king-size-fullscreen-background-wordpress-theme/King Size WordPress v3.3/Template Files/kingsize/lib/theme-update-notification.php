<?php
// Original code courtesy of Unisphere Design - http://themeforest.net/user/unisphere            
function update_notifier_menu() {  
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); // Get theme data from style.css (current version is what we want)
	
	if(version_compare($theme_data['Version'], $xml->latest) == -1) {
		add_dashboard_page( $theme_data['Name'] . ' Theme Update', $theme_data['Name'] . '<span class="update-plugins count-1"><span class="update-count">Update</span></span>', 'administrator', strtolower($theme_data['Name']) . '-updates', update_notifier);
	}
}   

add_action('admin_menu', 'update_notifier_menu');

function update_notifier() { 
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); // Get theme data from style.css (current version is what we want) ?>
	
	<style>
		.update-nag {display: none;}
		#instructions {max-width: 800px;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo $theme_data['Name']; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>
        
        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_bloginfo( 'template_url' ) . '/screenshot.png'; ?>" />
        
        <div id="instructions" style="max-width: 800px;">
            
            <h3>Update Instructions</h3>
            
            <p>To get the updated version of the theme go to your <a href="http://themeforest.net" target="_blank">ThemeForest</a> downloads page and redownload the theme. If you have made no changes to your theme files you can do <strong>one</strong> of the following:</p>
		
			<p>1. Upload the <code>kingsize</code> folder to the <code>/wp-content/themes/</code> directory in place of the old one via an FTP program <strong>OR</strong></p>
			
			<p>2. Rename the kingsize.zip file e.g. <code>kingsize-new.zip</code>. Now go to your WordPress Admin Panel, select Appearance > Themes > Install Themes > Upload and upload the zip file.</p>
			
			<p>If you have made code changes to your theme files view the documentation changelog help.html for a list of files changed.</p>

			<p><?php echo $xml->info; ?></p>
			
        </div>
        
        <div class="clear"></div>

	</div>
    
<?php } 

// This function retrieves a remote xml file on my server to see if there's a new update 
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function get_latest_theme_version($interval) {
	// remote xml file location
	$notifier_file_url = 'http://www.kingsizetheme.com/notification/notifier.xml';
	
	$db_cache_field = 'kingsize-notifier-cache';
	$db_cache_field_last_updated = 'kingsize-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
		}
		
		if ($cache) {			
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );			
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	if ( function_exists('simplexml_load_string') ) {	
		return simplexml_load_string($notifier_data); 	
	}
	
}

?>