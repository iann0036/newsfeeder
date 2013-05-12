<?php 

	include("/usr/include/libnfdb/php/libnfdb.php");

	$feedController = new nfdb\FeedController();

	$f = new nfdb\Feed();

	$feedController->UpdateFeed($f);
	echo "test";

?>
