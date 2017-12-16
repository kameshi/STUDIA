<?php
  error_reporting(E_ALL ^ E_DEPRECATED);
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $connect = mysql_connect($server, $user, $pass);

  mysql_query('CREATE DATABASE 313b', $connect);
  mysql_select_db("313b",$connect);

  $createTablePage = " CREATE TABLE IF NOT EXISTS `page` (
    `name` VARCHAR(20) NOT NULL,
    `content` LONGTEXT NOT NULL,
    `type` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`name`)
  )";

  $createTableAdmin = " CREATE TABLE IF NOT EXISTS `admin` (
    `login` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`login`)
  )";
  
  mysql_query($createTablePage ,$connect);
  mysql_query($createTableAdmin ,$connect);
  $login = 'admin';
  $pass = sha1('admin');
  mysql_query("INSERT INTO admin VALUES ('".$login."','".$pass."')");
?>