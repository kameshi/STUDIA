<?php
    session_start();
    unset($_SESSION['loginadmin']);
    unset($_SESSION['passwordadmin']);
    header("Location: index.php");
?>