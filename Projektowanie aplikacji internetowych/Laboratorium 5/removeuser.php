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
            <p><strong><h2>PANEL USUWANIA UŻYTKOWNIKA</h2></strong></p>
                <?php
                require("trylogin.php");
                $object = new loginAdmin();
                $object->checkSession();
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    $admin = "admin";
                    $query = mysql_query("SELECT login FROM `user` WHERE login!='".$admin."'");
                    $countPage = mysql_result(mysql_query("SELECT COUNT(*) FROM `user`"), 0);
                    if ($query && $countPage > 0) {
                        echo '<center><form method="post" action="removeuser.php">
                        <table><tr><td>Wybierz użytkownika:</td><td><select name = "user">';
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
                    }
                } else if (!empty($_POST["user"])) {
                    $user = htmlspecialchars($_POST["user"]);
                    if (mysql_query("DELETE FROM `user` WHERE (login = '" . $user . "')")) {
                        echo '<strong>Usunięto pomyślnie!</strong>';
                    } else {
                        echo '<strong>Niepowodzenie. Spróbuj ponownie!</strong>';
                    }
                } else {
                    echo '<strong>Brak użytkowników do usuniecia!</strong>';
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