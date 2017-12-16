<?php
    include("connect.php");
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
                        <a href="#">DODAJ NOWĄ STRONĘ</a>
                    </li>
                    <li>
                        <a href="#">MODYFIKUJ STRONĘ</a>
                    </li>
                    <li>
                        <a href="#">USUŃ STRONĘ</a>
                    </li>
                    <li>
                        <a href="logout.php">WYLOGUJ</a>
                    </li>
                </ul>
            </div>
            <div id="content">
                <h2><strong>WITAJ W PANELU ADMINISTRATORA</strong></h2>
            </div>
        </article>
        <footer>
            <h2 class="signature">Bartłomiej Osak, Tomasz Pasternak</h2>
        </footer>
    </div>
</body>

</html>