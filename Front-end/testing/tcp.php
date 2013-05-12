<?php
$fp = stream_socket_client("tcp://www.nbs.im:6373", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "admin");
    //while (!feof($fp)) {
        echo fgets($fp, 5);
    //}
    fclose($fp);
}
?>
