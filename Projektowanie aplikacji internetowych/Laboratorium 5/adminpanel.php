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
            <?php
            session_start();
            $login = $_SESSION['loginadmin'];
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
                <h2><strong>WITAJ W PANELU ADMINISTRATORA</strong></h2>
                <br><br><p id="menu">Wybierz jedną z opcji menu:<p>
                    <ul id = "menu">
                    <li><strong>DODAJ ADMINA</strong></li><br>
                    <li><strong>USUŃ ADMINA</strong></li><br>
                    <li><strong>USUŃ UŻYTKOWNIKA</strong></li><br>
                    <li><strong>DODAJ NOWĄ STRONĘ</strong></li><br>
                    <li><strong>MODYFIKUJ STRONĘ</strong></li><br>
                    <li><strong>USUŃ STRONĘ</strong></li><br>
                    <li><strong>USUŃ WĄTEK</strong></li><br>
                    <li><strong>USUŃ KOMENTARZE</strong></li><br>
                    <li><strong>ZABLOKUJ DOSTĘP</strong></li><br>
                    <li><strong>ODBLOKUJ DOSTĘP</strong></li><br>
                    </ul>
            </div>
        </article>
        <footer>
            <h2 class="signature">Bartłomiej Osak, Tomasz Pasternak</h2>
        </footer>
    </div>
</body>

</html>