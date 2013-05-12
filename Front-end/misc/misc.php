<?php
	/*
	File name: /misc/misc.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Functions that don't have a place elsewhere
	Last Modified: 10:44 PM 12/01/2012
	*/

	function convert_datetime($datetime, $dateonly = false) {
		$values = explode(" ", $datetime);
		$dates = explode("-", $values[0]);
		$times = explode(":", $values[1]);
		$newdate = mktime($times[0], $times[1], $times[2], $dates[1], $dates[2], $dates[0]);
		$newdate2 = $_SERVER['REQUEST_TIME']-$newdate;
		$newdate2+=DB_TIME_OFFSET;
		if ($newdate2>172799 || $dateonly)
			return date("F j, Y",$newdate);
		else if ($newdate2>86399)
			return "Yesterday";
		else if ($newdate2>7199)
			return intval($newdate2/3600)." hours ago";
		else if ($newdate2>3599)
			return "1 hour ago";
		else if ($newdate2>119)
			return intval($newdate2/60)." minutes ago";
		else if ($newdate2>59)
			return "1 minute ago";
		else if ($newdate2>=0)
			return "Just a moment ago";
		else
			return "In the future";
	}
?>