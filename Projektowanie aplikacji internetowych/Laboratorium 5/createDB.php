<?php
  //error_reporting(E_ALL &~ E_DEPRECATED);
  $server = 'localhost';
  $user = 'root';
  $pass = 'admin';
  $connect = mysql_connect($server, $user, $pass);

  mysql_query('CREATE DATABASE 313b', $connect);
  mysql_select_db("313b",$connect);

  $createTablePage = " CREATE TABLE IF NOT EXISTS `page` (
    `name` VARCHAR(20) NOT NULL,
    `content` LONGTEXT,
    `type` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`name`)
  )";

  $createTableAdmin = " CREATE TABLE IF NOT EXISTS `admin` (
    `login` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`login`)
  )";

  $createTableUser = " CREATE TABLE IF NOT EXISTS `user` (
    `login` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`login`)
  )";

  $createTableTopic = " CREATE TABLE IF NOT EXISTS `topic` (
    `name` VARCHAR(20) NOT NULL,
    `content` LONGTEXT NOT NULL,
    PRIMARY KEY (`name`)
  )";

  $createTableComment = " CREATE TABLE IF NOT EXISTS `comment` (
    `id` INT AUTO_INCREMENT,
    `content` LONGTEXT NOT NULL,
    `user` VARCHAR(100) NOT NULL,
    `date` VARCHAR(100) NOT NULL,
    `topic_name` VARCHAR(20),
    PRIMARY KEY (`id`)
  )";

  $createTableIP= " CREATE TABLE IF NOT EXISTS `ip` (
    `address` VARCHAR(15) NOT NULL,
    PRIMARY KEY (`address`)
  )";

  $createTableMessage = " CREATE TABLE IF NOT EXISTS `message` (
    `id` INT AUTO_INCREMENT,
    `content` LONGTEXT NOT NULL,
    `user` VARCHAR(1000) NOT NULL,
    `date` VARCHAR(100) NOT NULL,
    `subject` VARCHAR(1000) NOT NULL,
    `from` VARCHAR(1000) NOT NULL,
    PRIMARY KEY (`id`)
  )";

  $createTableMessageSent = " CREATE TABLE IF NOT EXISTS `sendmessage` (
    `id` INT AUTO_INCREMENT,
    `content` LONGTEXT NOT NULL,
    `user` VARCHAR(1000) NOT NULL,
    `date` VARCHAR(100) NOT NULL,
    `subject` VARCHAR(1000) NOT NULL,
    `from` VARCHAR(1000) NOT NULL,
    PRIMARY KEY (`id`)
  )";

  mysql_query($createTablePage ,$connect);
  mysql_query($createTableAdmin ,$connect);
  mysql_query($createTableUser ,$connect);
  mysql_query($createTableTopic ,$connect);
  mysql_query($createTableComment ,$connect);
  mysql_query($createTableIP ,$connect);
  mysql_query($createTableMessage ,$connect);
  mysql_query($createTableMessageSent ,$connect);

  $login = 'admin';
  $pass = sha1('admin');
  $login1 = 'admin';
  $pass1 = sha1('admin');
  
  mysql_query("INSERT INTO admin VALUES ('".$login."','".$pass."')");
  mysql_query("INSERT INTO user VALUES ('".$login1."','".$pass1."')");
?>