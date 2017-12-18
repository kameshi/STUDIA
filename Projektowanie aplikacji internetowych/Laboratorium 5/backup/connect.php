<?php 
    function connect() { 
        $server = 'localhost';
        $user = 'root';
        $pass = 'admin';
        $connect = mysql_connect($server, $user, $pass);
        $connectDB = mysql_select_db("313b",$connect);
        return $connectDB;
    }
?>