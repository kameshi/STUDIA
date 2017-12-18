<?php
include("blockIP.php");
$address = $_SERVER['REMOTE_ADDR'];
$ip = new BlockIP;
$ip->block($address);
date_default_timezone_set('Europe/Warsaw');
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
            <?php
            session_start();
            $login = $_SESSION['login'];
            echo '<h3 id="log"><span>ZALOGOWANO JAKO: ' . $login . '</span></h3>';
            ?>
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
                        <a href="post.php">POCZTA</a>
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
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    $user = $_SESSION["login"];
                    $query = mysql_query("SELECT `from`,`subject`,`date`,`content`,`id` FROM `message` WHERE user = '" . $user . "'");
                    if ($query) {
                        if (mysql_num_rows($query) > 0) {
                            echo '<table><tr><td class="field">
                            <form action="removemessage.php" method="post">
                                <input type="hidden" value=' . $user . ' name="user">
                                <input type="submit" value="Usuń wiadomości">
                            </form></td></tr></table>';
                            while ($row = mysql_fetch_row($query)) {
                                echo '<table class="comment">
                                <tr><td class="field"><strong>Nadawca:</strong></td><td> ' . $row[0] . '</td></tr>
                                <tr><td class="field"><strong>Temat:</strong></td><td> ' . $row[1] . '</td></tr>
                                <tr><td class="field"><strong>Data wysłania:</strong></td><td> ' . $row[2] . '</td></tr>
                                <tr><td class="field"><strong>Treść:</strong></td><td> ' . $row[3] . '</td></tr>
                                <tr><td class="field"><form action="sendanswer.php" method="post">
                                    <input type="hidden" value=' . $row[0] . ' name="user">
                                    <input type="hidden" value=' . $row[1] . ' name="subject">
                                    <input type="submit" value="Odpowiedz"></form></tr></td></tr>
                                </table>';
                            }
                        } else {
                            echo '<strong>Brak wiadomości w skrzynce odbiorczej!</strong>';
                        }
                    } else {
                        echo '<strong>Błąd pobrania tabeli z bazy danych!</strong>';
                    }
                }
                ?>
            </div>
        </article>
        <footer>
            <h2 class="signature">Bartłomiej Osak, Tomasz Pasternak</h2>
        </footer>
    </div>
</body>

</html>