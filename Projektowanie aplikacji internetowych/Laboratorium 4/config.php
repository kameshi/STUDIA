<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = '313b';
    $conn = mysql_connect($host, $user, $pass);
    if (!$conn)
        die('Error: ' . mysql_error());

    $db = mysql_select_db($db, $conn);

    if (!$db)
        die('Error: ' . mysql_error());

    session_start();
?>