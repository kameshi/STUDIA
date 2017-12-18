<?php
    include("blockIP.php");
    $address = $_SERVER['REMOTE_ADDR'];
    $ip = new BlockIP;
    $ip->block($address);
    date_default_timezone_set('Europe/Warsaw');
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user = $_SESSION["login"];
        $query = mysql_query("DELETE FROM `sendmessage` WHERE `from` = '" . $user . "'");
        header("Location: sendbox.php");
    }
?>
