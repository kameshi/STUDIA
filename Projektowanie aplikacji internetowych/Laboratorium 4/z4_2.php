<?php
    date_default_timezone_set('Europe/Warsaw');
    if($_COOKIE["z4_2"])
    {
        echo "<strong>OSTATNIA WIZYTA:  </strong>" . date("H:i:s", $_COOKIE['z4_2']) . "<br>";
        setcookie("z4_2", time());
    }
    else
    {
        setcookie("z4_2", time() , time() + (60*60*24*365));
        header('Location: ?zad4_2');
    }
?>
