<?php 
include("../../../../../wp-load.php");

/* GLOBAL SETTINGS */
global $wpdb;
define('PHOTO_TABLE', $wpdb->prefix . 'kingsize_photos');

$action 				= mysql_real_escape_string($_POST['action']); 
$updateRecordsArray 	= $_POST['recordsArray'];

if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {		

		$query_update_order = "UPDATE " . PHOTO_TABLE . " SET p_order='".$listingCounter."' WHERE id=".$recordIDValue;
		$wpdb->query($query_update_order);
		
		$listingCounter = $listingCounter + 1;	
	}
	
	//echo '<pre>';
	//print_r($updateRecordsArray);
	//echo '</pre>';
	echo 'You record has been successfully modified.';
}
?>