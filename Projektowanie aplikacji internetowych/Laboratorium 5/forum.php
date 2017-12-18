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
                        <a href="post.php">POCZTA</a>
                    </li>
                    <li>
                        <a href="logoutuser.php">WYLOGUJ</a>
                    </li>
                    <li>
                        <a href="addtopic.php">+ DODAJ TEMAT</a>
                    </li>
                    <?php
                    $query = mysql_query("SELECT name FROM `topic`");
                    if ($query) {
                        if (mysql_num_rows($query) > 0) {
                            while ($row = mysql_fetch_row($query)) {
                                echo '<li>
                                            <a href="forum.php?page=' . $row[0] . '">' . $row[0] . '</a>
                                        </li>';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div id="content">
                <?php
                if (isset($_POST["add_comment"])) {
                    $content = $_POST["comment"];
                    $page = $_POST['page'];
                    $login = $_POST["login"];
                    $date = $_POST["date"];
                    if (mysql_query("INSERT INTO `comment` SET content = '" . $content . "', topic_name = '" . $page . "', user='" . $login . "', date='" . $date . "'")) {
                        header("Location: forum.php?page=$page");
                    } else {
                        echo '<strong>Błąd dodawania komentarza</strong>';
                    }
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    $login = $_SESSION["login"];
                    $date = date('d M Y H:i:s');
                    $query = mysql_query("SELECT content, name FROM `topic` WHERE name = '" . $page . "'");
                    $queryComment = mysql_query("SELECT content,user,date FROM `comment` WHERE topic_name = '" . $page . "'");
                    if ($query) {
                        if (mysql_num_rows($query) > 0) {
                            $row = mysql_fetch_row($query);
                            echo '<h2>' . $row[1] . '</h2><br>';
                            echo '<p>' . $row[0] . '</p>';
                            if (mysql_num_rows($queryComment) > 0) {
                                while ($row = mysql_fetch_row($queryComment)) {
                                    echo '<table class="comment">
                                    <tr><td class="field">Autor:</td><td> ' . $row[1] . '</td></tr>
                                    <tr><td class="field">Data wpisu:</td><td> ' . $row[2] . '</td></tr>
                                    <tr><td class="field">Komentarz:</td><td> ' . $row[0] . '</td></tr></table>';
                                }
                            }
                            echo '<form method="post" action="forum.php">
                            <table class="comment">
                                <tr><td>Komentarz:</td></tr>
                                <tr><td><textarea rows="10" cols="30" name="comment"></textarea></td></tr>
                                <input type="hidden" value="' . $login . '" name="login">
                                <input type="hidden" value="' . $page . '" name="page">
                                <input type="hidden" value="' . $date . '" name ="date">
                                <tr><td><input type="submit" value="Dodaj komentarz" name="add_comment" ></td></tr>
                            </table>
                            </form>';
                        } else {
                            echo '<strong>Brak strony w bazie danych!</strong>';
                        }
                    } else {
                        echo '<strong>Błąd pobrania tabeli z bazy danych!</strong>';
                    }
                } else {
                    echo'<h2><strong>WITAJ NA NASZYM FORUM</strong></h2>
                    <br><br><p id="menu">Wybierz jedną z opcji menu:<p>
                        <ul id = "menu">
                        <li><strong>POCZTA</strong> - ROZMAWIAJ Z INNYMI UŻYTKOWNIKAMI</li><br>
                        <li><strong>DODAJ TEMAT</strong> - DO DYSKUSJI</li><br>
                        <li><strong>lub dyskutuj w innych tematach!</strong></li><br>
                        </ul>';
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