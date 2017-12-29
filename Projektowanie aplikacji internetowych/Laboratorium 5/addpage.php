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
            <p><strong><h2>DODAJ NOWĄ STRONĘ!</h2></strong></p>
                <?php
                require("trylogin.php");
                $object = new loginAdmin();
                $object->checkSession();
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    echo '<center><form method="post" action="addpage.php">
                        <table>
                            <tr><td>Podaj nazwę strony:</td><td><input type="text" maxlength="20" name="name"></td></tr>
                            <tr><td>Tekst strony lub adres strony zewnętrznej: </td><td><textarea rows="10" cols="30" name="content"></textarea></td></tr>
                            <tr><td>Określ typ strony:</td><td><select name = "type">
                                <option value="in">Strona wewnętrzna</option>
                                <option value="out">Strona zewnętrzna</option>
                            <tr><td></td><td><input type="submit" value="Dodaj"></td></tr>
                        </table>
                        </form></center>';
                } else if (!empty($_POST["name"]) && !empty($_POST["type"])) {
                    $name = htmlspecialchars($_POST["name"]);
                    $content = $_POST["content"];
                    $type = htmlspecialchars($_POST["type"]);
                    if (mysql_query("INSERT INTO `page` VALUES ( '" . $name . "','" . $content . "','" . $type . "')")) {
                        echo '<strong>Dodano!</strong>';
                    } else {
                        echo '<strong>Błąd dodawania!</strong>';
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