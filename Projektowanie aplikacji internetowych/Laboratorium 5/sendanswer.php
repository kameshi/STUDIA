<?php 
    error_reporting(E_ALL ^ E_DEPRECATED);
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
            <p><strong><h2>WYŚLIJ ODPOWIEDŹ</h2></strong></p>
                <?php
                require("tryloginuser.php");
                $object = new loginUser();
                $object->checkSession();
                if (isset($_POST["user"]) && isset($_POST["subject"]) && isset($_POST["content"]) && isset($_POST["from"])) {
                    $from = htmlspecialchars($_POST["from"]);
                    $user = htmlspecialchars($_POST["user"]);
                    $subject = htmlspecialchars($_POST["subject"]);
                    $content = $_POST["content"];
                    $date = htmlspecialchars(date('d M Y H:i:s'));
                    if (strlen($content) > 0) {
                        if (mysql_query("INSERT INTO `message` SET `content` = '" . $content . "', `user` = '" . $user . "', `date` = '" . $date . "', `subject` = '" . $subject . "', `from`='" . $from . "'")
                        && mysql_query("INSERT INTO `sendmessage` SET `content` = '" . $content . "', `user` = '" . $user . "', `date` = '" . $date . "', `subject` = '" . $subject . "', `from`='" . $from . "'")) {
                            echo '<strong><h3><center>Wysłano!</center></h3></strong>';
                        } else {
                            echo '<strong>Błąd wysyłania wiadomości!</strong>';
                        }
                    } else {
                        echo '<strong>Nie można wysłać wiadomości bez zawartości!</strong>';
                    }
                }
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (!empty($_POST["user"]) && !empty($_POST["subject"])) {
                        $from = $_SESSION["login"];
                        $subject = $_POST["subject"];
                        $user = $_POST["user"];
                        echo '<center><form method="post" action="sendanswer.php">
                                    <table>
                                    <tr><td>Wybierz odbiorcę:</td><td><input disabled type="text" placeholder="' . $user . '"></td></tr>
                                    <tr><td>Temat wiadomości:</td><td><input disabled type="text" placeholder="Re: ' . $subject . '"></td></tr>
                                    <tr><td>Treść: </td><td><textarea rows="10" cols="30" name="content"></textarea></td></tr>
                                    <input type="hidden" name="from" value="' . $from . '">
                                    <input type="hidden" name="user" value="' . $user . '">
                                    <input type="hidden" name="subject" value="' . $subject . '">
                                    <tr><td></td><td><input type="submit" value="Wyślij" ></td></tr>
                                    </table>
                                    </form></center>';
                    }
                } else {
                    header("Location: forum.php");
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