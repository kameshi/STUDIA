<?php 
    include("blockIP.php");
    $address = $_SERVER['REMOTE_ADDR'];
    $ip = new BlockIP;
    $ip->block($address);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Bartłomiej Osak - Tomasz Pasternak - 3ID13B</title>
</head>

<body>
    <div id="container">
        <header>
            <h3>PAI LABORATORIUM 5</h3>
        </header>
        
        <article>
            <div id="leftmenu">
            <ul>
                <li>
                    <a id="first" href="index.php">STRONA GŁÓWNA</a>
                </li>
                <li>
                    <a href="forum.php">FORUM</a>
                </li>
                <li>
                    <a href="inbox.php">SKRZYNKA ODBIORCZA</a>
                </li>
                <li>
                    <a href="sendbox.php">WYSŁANE</a>
                </li>
                <li>
                    <a href="sendmessage.php">WYŚLIJ WIADOMOŚĆ</a>
                </li>
                <li>
                    <a href="logoutuser.php">WYLOGUJ</a>
                </li>
            </ul>
            </div>
            <div id="content">
            <?php
            session_start();
            $user = $_SESSION["login"];
            $count = mysql_result(mysql_query("SELECT COUNT(*) FROM `message` WHERE user='" . $user . "'"), 0);
            $countSent = mysql_result(mysql_query("SELECT COUNT(*) FROM `sendmessage` WHERE `from`='" . $user . "'"), 0);

            echo '<p><strong><h2>WITAJ W PANELU OBSŁUGI WIADOMOŚCI PRYWATNYCH</h2></strong></p>
            <br><hr><center><strong><h3>Masz wiadomości odebranych: ' . $count . '</h3></strong></center><hr>
            <br><hr><center><strong><h3>Masz wiadomości wysłanych: ' . $countSent . '</h3></strong></center><hr>';
            ?>
            </div>
        </article>
        <footer>
            <h2 class="signature">Bartłomiej Osak, Tomasz Pasternak</h2>
        </footer>
    </div>
</body>

</html>