<?php 
    error_reporting(E_ALL ^ E_DEPRECATED);
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
            <p><strong><h2>USUŃ ZABLOKOWANY ADRES IP, ABY ODBLOKOWAĆ DOSTĘP DO PORTALU</h2></strong></p>
                <?php
                require("trylogin.php");
                $object = new loginAdmin();
                $object->checkSession();
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    $query = mysql_query("SELECT address FROM `ip`");
                    $countPage = mysql_result(mysql_query("SELECT COUNT(*) FROM `ip`"), 0);
                    if ($query && $countPage > 0) {
                        echo '<center><form method="post" action="removeIP.php">
                        <table><tr><td>Wybierz adres ipv4:</td><td><select name = "ip">';
                        while ($row = mysql_fetch_row($query)) {
                            echo '<option value="';
                            echo $row[0];
                            echo '">';
                            echo $row[0];
                            echo '</option>';
                        }
                        echo '<tr><td></td><td><input type="submit" value="Usuń"></td></tr>
                        </table>
                        </form></center>';
                    } else {
                        echo '<strong>Brak adresów IPv4 do usuniecia!</strong>';
                    }
                } else {
                    $ip = htmlspecialchars($_POST["ip"]);
                    if (mysql_query("DELETE FROM `ip` WHERE (address = '" . $ip . "')")) {
                        echo '<strong>Usunięto pomyślnie! Odblokowano dostęp!</strong>';
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