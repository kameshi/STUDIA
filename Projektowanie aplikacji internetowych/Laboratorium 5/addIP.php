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
            <p><strong><h2>ZABLOKUJ STRONĘ DLA PODANEGO IP!</h2></strong></p>
                <?php
                require("trylogin.php");
                $object = new loginAdmin();
                $object->checkSession();
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    echo '<center><form method="post" action="addIP.php">
                        <table>
                            <tr><td>Podaj adres IP:</td><td>
                            <input type="text" maxlength="3" name="ip1"> .
                            <input type="text" maxlength="3" name="ip2">
                            . <input type="text" maxlength="3" name="ip3">
                            . <input type="text" maxlength="3" name="ip4"></td></tr>
                           <td><input type="submit" value="Dodaj"></td></tr>
                        </table>
                        </form></center>';
                } else if (isset($_POST["ip1"]) && isset($_POST["ip2"]) && isset($_POST["ip3"]) && isset($_POST["ip4"])) {
                    if (strlen($_POST["ip1"]) > 0 && strlen($_POST["ip2"]) > 0 && strlen($_POST["ip3"]) > 0 && strlen($_POST["ip4"]) > 0) {
                        if (is_numeric($_POST["ip1"]) && is_numeric($_POST["ip2"]) && is_numeric($_POST["ip3"]) && is_numeric($_POST["ip4"]) && ($_POST["ip1"] < 256)
                            && ($_POST["ip1"] >= 0) && ($_POST["ip2"] < 256) && ($_POST["ip2"] >= 0) && ($_POST["ip3"] < 256) && ($_POST["ip3"] >= 0) && ($_POST["ip4"] < 256) && ($_POST["ip4"] >= 0)) {
                            $ip = $_POST["ip1"] . '.' . $_POST["ip2"] . '.' . $_POST["ip3"] . '.' . $_POST["ip4"];
                            if (mysql_query("INSERT INTO `ip` VALUES ( '" . $ip . "')")) {
                                echo '<strong>Dodano adres do zablokowania!</strong>';
                            } else {
                                echo '<strong>Błąd dodawania!</strong>';
                            }
                        } else {
                            echo '<strong>Błędnie wpisano adres ipv4!</strong>';
                        }
                    } else {
                        echo '<strong> Nie mozna dodac pustego!</strong>';
                    }
                } else {
                    echo '<strong>Pola formularza nie mogą być puste!</strong>';
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