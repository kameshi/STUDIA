<?php 
    function connect() { 
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $connect = mysql_connect($server, $user, $pass);
        $connectDB = mysql_select_db("313b",$connect);
        if (!$connect || !$connectDB ) {
                header('Location: error.php');
        }
        return $connectDB;
    }
?>