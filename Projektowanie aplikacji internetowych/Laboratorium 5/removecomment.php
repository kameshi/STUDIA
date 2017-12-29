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
                        <a href="signup.php">DODAJ ADMINA</a>
                    </li>
                    <li>
                        <a href="removeadmin.php">USUŃ ADMINA</a>
                    </li>
                    <li>
                        <a href="removeuser.php">USUŃ UŻYTKOWNIKA</a>
                    </li>
                    <li>
                        <a href="addpage.php">DODAJ NOWĄ STRONĘ</a>
                    </li>
                    <li>
                        <a href="modifypage.php">MODYFIKUJ STRONĘ</a>
                    </li>
                    <li>
                        <a href="removepage.php">USUŃ STRONĘ</a>
                    </li>
                    <li>
                        <a href="removetopic.php">USUŃ WĄTEK</a>
                    </li>
                    <li>
                        <a href="removecomment.php">USUŃ KOMENTARZE</a>
                    </li>
                    <li>
                        <a href="addIP.php">ZABLOKUJ DOSTĘP</a>
                    </li>
                    <li>
                        <a href="removeIP.php">ODBLOKUJ DOSTĘP</a>
                    </li>
                    <li>
                        <a href="logout.php">WYLOGUJ</a>
                    </li>
                </ul>
            </div>
            <div id="content">
            <p><strong><h2>PANEL USUWANIA KOMENTARZY Z WĄTKU</h2></strong></p>
                <?php
                require("trylogin.php");
                $object = new loginAdmin();
                $object->checkSession();
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    $query = mysql_query("SELECT name FROM `topic`");
                    $countPage = mysql_result(mysql_query("SELECT COUNT(*) FROM `topic`"), 0);
                    $countComment = mysql_result(mysql_query("SELECT COUNT(*) FROM `comment`"),0);
                    if ($query && $countPage > 0 && $countComment > 0) {
                        echo '<center><form method="post" action="removecomment.php">
                        <table><tr><td>Wybierz wątek:</td><td><select name = "comment">';
                        while ($row = mysql_fetch_row($query)) {
                            echo '<option value="';
                            echo $row[0];
                            echo '">';
                            echo $row[0];
                            echo '</option>';
                        }
                        echo '<tr><td></td><td><input type="submit" value="Usun"></td></tr>
                        </table>
                        </form></center>';
                    } else {
                        echo '<strong>Brak komentarzy w wątkach do usuniecia!</strong>';
                    }
                } else {
                    $comment = htmlspecialchars($_POST["comment"]);
                    if (mysql_query("DELETE FROM `comment` WHERE (topic_name = '" . $comment . "')")) {
                        echo '<strong>Usunięto pomyślnie!</strong>';
                    } else {
                        echo '<strong>Niepowodzenie. Spróbuj ponownie!</strong>';
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