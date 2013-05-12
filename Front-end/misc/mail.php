<?php
    require_once "Mail.php";
 
    $from = "Newsfeeder Feedback <feedback@newsfeeder.co>";
    $to = "Ian Mckay <iann0036@gmail.com>";
    $subject = "Hi!";
    $body = "Hi,\n\nHow are you?";
 
    $host = "mail.example.com";
    $username = "smtp_username";
    $password = "smtp_password";
 
    $headers = array ('From' => $from,
	'To' => $to,
	'Subject' => $subject);
    $smtp = Mail::factory('smtp',
    array ('host' => $host,
	'auth' => true,
	'username' => $username,
	'password' => $password));
 
    $mail = $smtp->send($to, $headers, $body);
 
    if (PEAR::isError($mail)) {
	echo("<p>" . $mail->getMessage() . "</p>");
    } else {
	echo("<p>Message successfully sent!</p>");
    }
?>