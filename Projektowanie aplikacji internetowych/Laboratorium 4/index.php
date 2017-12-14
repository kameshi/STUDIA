<?php
    include('config.php');
    $z = $_GET['zad'];
    switch ($z) {
        case 1:
            include('createDB.php');
            break;
        case 2:
            include('z2.php');
            break;
        default:
            echo '<h2><center>PAI - laboratorium 4 B.Osak T.Pasternak 3ID13B<center></h2><hr>';
            echo '<h3><center>Należy włączyć obsługę ciasteczek w przeglądarce.<center></h3><hr>';
            echo '<a href="?zad=1"> TWORZENIE BAZY ORAZ TABELI </a><br><hr>';
            echo '<a href="z2.php"> ZADANIE 2 </a><br><hr>';
            break;
    }
?>
