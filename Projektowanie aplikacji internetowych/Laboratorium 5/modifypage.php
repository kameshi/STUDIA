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
            <p><strong><h2>ZMODYFIKUJ STRONĘ!</h2></strong></p>
                <?php
                require("trylogin.php");
                $object = new loginAdmin();
                $object->checkSession();
                if (isset($_POST["page"])) {
                    $pagetomodify = htmlspecialchars($_POST["page"]);
                    echo '<center><form method="post" action="modifypage.php">
                    <table>
                        <tr><td>Podaj nową nazwę strony:</td><td><input type="text" maxlength="20" name="newname"></td></tr>
                        <tr><td>Dodaj nowy tekst strony lub nowy adres strony zewnętrznej: </td><td><textarea rows="10" cols="30" name="newcontent"></textarea></td></tr>
                        <tr><td>Określ typ strony:</td><td><select name = "newtype">
                            <option value="in">Strona wewnętrzna</option>
                            <option value="out">Strona zewnętrzna</option>
                        <tr><td></td><td>
                        <input type="hidden" name = "oldpage" value = "' . $pagetomodify . '">
                        <input type="submit" name = "pagemod" value="Potwierdź"></td></tr>
                    </table>
                    </form></center>';
                }
                
                if($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    if (isset($_POST["pagemod"]) && isset($_POST["oldpage"]) && !empty($_POST["newname"]) && !empty($_POST["newtype"]) && !empty($_POST["newcontent"])) {
                        $page = htmlspecialchars($_POST["oldpage"]);
                        $name = htmlspecialchars($_POST["newname"]);
                        $content = $_POST["newcontent"];
                        $type = htmlspecialchars($_POST["newtype"]);
                        if (mysql_query("UPDATE `page` SET name = '" . $name . "', content = '" . $content . "', type = '" . $type . "' WHERE name = '" . $page . "'")) {
                            echo '<strong>Zmodyfikowano!</strong><br>
                            Nowa nazwa: <strong>"' . $name . '"';
                        } else {
                            echo '<strong>Niepowodzenie. Spróbuj ponownie!</strong>';
                        }
                    } else {
                        echo '<strong>Pola formularza nie mogą być puste!</strong>';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    $query = mysql_query("SELECT name FROM `page`");
                    $countPage = mysql_result(mysql_query("SELECT COUNT(*) FROM `page`"), 0);
                    if ($query && $countPage > 0) {
                        echo '<center><form method="post" action="modifypage.php">
                         <table><tr><td>Wybierz stronę:</td><td><select name = "page">';
                        while ($row = mysql_fetch_row($query)) {
                            echo '<option value="';
                            echo $row[0];
                            echo '">';
                            echo $row[0];
                            echo '</option>';
                        }
                        echo '<tr><td></td><td><input type="submit" value="Wybierz"></td></tr>
                         </table>
                         </form></center>';
                    } else {
                        echo '<strong>Brak stron do modyfikacji!</strong>';
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