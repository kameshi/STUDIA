<?php
    date_default_timezone_set('Europe/Warsaw');
    if($_COOKIE["z4_1"])
    {
        echo "<strong>COOKIE zniknie o godz:  </strong>" . date("H:i:s", $_COOKIE['z4_1']) . "<br>";
    }
    else
    {
        setcookie("z4_1", time() + (60*2), time() + (60*2));
    }
?>
