<?php
    ob_start();
    include('config.php');
    $z = $_GET['zad'];
    switch ($z) {
        case 1:
            include('z1.php');
            break;
        case 31:
            include('z3_1.php');
            break;
        case 32:
            include('z3_2.php');
            break;
        case 33:
            include('z3_3.php');
            break;
        case 41:
            include('z4_1.php');
            break;
        case 42:
            include('z4_2.php');
            break;
        default:
            echo '<h2><center>PAI - laboratorium 4 B.Osak T.Pasternak 3ID13B<center></h2><hr>';
            echo '<a href="?zad=1"> ZADANIE 1 </a><br><hr>';
            echo '<a href="z2.php"> ZADANIE 2 </a><br><hr>';
            echo '<a href="?zad=31"> ZADANIE 3 - pkt 1 </a><br><hr>';
            echo '<a href="?zad=32"> ZADANIE 3 - pkt 2 </a><br><hr>';
            echo '<a href="?zad=33"> ZADANIE 3 - pkt 3 </a><br><hr>';
            echo '<a href="?zad=41"> ZADANIE 4 - pkt 1 </a><br><hr>';
            echo '<a href="?zad=42"> ZADANIE 4 - pkt 2 </a><br><hr>';
            break;
    }
    ob_end_flush();
?>
