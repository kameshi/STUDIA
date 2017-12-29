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
            <p><strong><h2>WYŚLIJ WIADOMOŚĆ</h2></strong></p>
                <?php
                require("tryloginuser.php");
                $object = new loginUser();
                $object->checkSession();
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    $from = $_SESSION["login"];
                    $query = mysql_query("SELECT login FROM `user` WHERE login != '" . $from . "'");
                    echo '<center><form method="post" action="sendmessage.php">
                            <table>
                            <tr><td>Wybierz odbiorcę:</td><td><select name = "user">';
                    while ($row = mysql_fetch_row($query)) {
                        echo '<option value="';
                        echo $row[0];
                        echo '">';
                        echo $row[0];
                        echo '</option>';
                    }
                    echo '<tr><td>Temat wiadomości:</td><td><input type="text" maxlength="1000" name="subject"></td></tr>
                            <tr><td>Treść: </td><td><textarea rows="10" cols="30" name="content"></textarea></td></tr>
                            <tr><td></td><td><input type="submit" value="Wyślij" ></td></tr>
                            <input type="hidden" name="from" value="' . $from . '">
                            </table>
                            </form></center>';
                } else if (!empty($_POST["user"]) && !empty($_POST["subject"]) && !empty($_POST["content"]) && !empty($_POST["from"])) {
                    $from = htmlspecialchars($_POST["from"]);
                    $user = htmlspecialchars($_POST["user"]);
                    $subject = htmlspecialchars($_POST["subject"]);
                    $content = $_POST["content"];
                    $date = htmlspecialchars(date('d M Y H:i:s'));
                    if (mysql_query("INSERT INTO `message` SET `content` = '" . $content . "', `user` = '" . $user . "', `date` = '" . $date . "', `subject` = '" . $subject . "', `from`='" . $from . "'")
                        && mysql_query("INSERT INTO `sendmessage` SET `content` = '" . $content . "', `user` = '" . $user . "', `date` = '" . $date . "', `subject` = '" . $subject . "', `from`='" . $from . "'")) {
                        echo '<strong><h3><center>Wysłano!</center></h3></strong>';
                    } else {
                        echo '<strong>Błąd wysyłania wiadomości!</strong>';
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