<?php
$server = 'localhost';
$user = 'root';
$pass = 'admin';
$connect = mysql_connect($server, $user, $pass);
mysql_query("DROP DATABASE IF EXISTS 313b",$connect);
if(!$connect)
{
 die('Error: ' . mysql_error());
}
if (mysql_query('CREATE DATABASE 313b', $connect))
{
 echo 'Stworzono baze: 313b';
}
else
{
 echo 'Error: ' . mysql_error();
}

mysql_select_db("313b",$connect);

$createTable = " CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `capital` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
)";
mysql_query($createTable,$connect);

mysql_close($createTable);
?>