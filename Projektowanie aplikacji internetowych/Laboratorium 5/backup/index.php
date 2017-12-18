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
            <h2 class="signature">Bartłomiej Osak, Tomasz Pasternak</h2>
            <h2 class="signature">Grupa: 6 Grupa dziekańska: 3ID13B</h2>
        </header>
        
        <article>
            <div id="leftmenu">
                <ul>
                    <li>
                        <a id="first" href="index.php">STRONA GŁÓWNA</a>
                    </li>
                    <li>
                        <a href="signinuser.php">FORUM</a>
                    </li>
                    <li>
                        <a href="signin.php">PANEL ADMINA</a>
                    </li>
                    <?php
                    $query = mysql_query("SELECT name FROM `page`");
                    if ($query) {
                        if (mysql_num_rows($query) > 0) {
                            while ($row = mysql_fetch_row($query)) {
                                echo '<li>
                                        <a href="index.php?page=' . $row[0] . '">' . $row[0] . '</a>
                                    </li>';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div id="content">
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    $query = mysql_query("SELECT content, type, name FROM `page` WHERE name = '" . $page . "'");
                    if ($query) {
                        if (mysql_num_rows($query) > 0) {
                            $row = mysql_fetch_row($query);
                            if ($row[1] == 'in') {
                                echo '<h2>' . $row[2] . '</h2><br>';
                                echo '<p>' . $row[0] . '</p>';
                            } else if ($row[1] == 'out') {
                                echo '<fieldset><iframe frameborder="0" src="' . $row[0] . '"></iframe></fieldset>';
                            } else {
                                echo '<strong>Nieznany typ strony!</strong>';
                            }
                        } else {
                            echo '<strong>Brak strony w bazie danych!</strong>';
                        }
                    } else {
                        echo '<strong>Błąd pobrania tabeli z bazy danych!</strong>';
                    }
                } else {
                    echo '<h2>Strona główna</h2>';
                    echo '<br><br><p id="menu">Wybierz jedną z opcji menu:<p>
                    <ul id = "menu">
                    <li><strong>STRONA GŁÓWNA</strong> - strona, na której się znajdujesz.</li><br>
                    <li><strong>FORUM</strong> - forum dyskusyjne.</li><br>
                    <li><strong>PANEL ADMINA</strong> - dostęp tylko dla administratorów.</li><br>
                    <li><strong>STRONY ZEWNĘTRZNE</strong> - linki do stron zewnętrznych otwierające się w oknie naszej strony.</li><br>
                    <li><strong>STRONY WEWNĘTRZNE</strong> - linki do stron wewnętrznych otwierające się w oknie naszej strony.</li>
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