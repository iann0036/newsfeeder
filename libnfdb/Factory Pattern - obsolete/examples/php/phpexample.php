<?php 

	include("/usr/include/libnfdb/php/libnfdb.php");

	$feedController = nfdb\DBFactory::GetFeedController();

	$f = new nfdb\Feed();
	$feedController.UpdateFeed(f);
	echo "test";

?>
