<?php
	/*
	File name: /abuse/verify.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Verify the domain ownership for external webmaster
	Last Modified: 11:26 PM 26/02/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/GUIMaker.php';
	
	$domain = $_POST['domain'];
	$key = $_POST['key'];
	
	$source = file_get_contents($domain);
	
	$success = false;
	if (strpos($source,$key)!==false)
	    $success = true;
	
	$gui = new GUIMaker();
	
	$gui->header();
	$gui->user_details();
	$gui->navigation();
?>
	<div id="content" class="xfluid">
		
		<div class="portlet x12">
			
			<div class="portlet-header">
				<h4>Report Abuse</h4>
			</div>
			
			<div class="portlet-content">
				<?php
				    if ($success) {
				?>
				Success
				<?php
				    } else {
				?>
				Failure
				<?php
				    }
				?>
			</div>
		</div>
		
	</div>
<?php
	$gui->footer();
?>