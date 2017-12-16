<?php
include("createDB.php");
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
                        <a href="signup.php">REJESTRACJA</a>
                    </li>
                    <li>
                        <a href="signin.php">ZALOGUJ</a>
                    </li>
                </ul>
            </div>
            <div id="content">
                <p><strong><h2>UTWÓRZ NOWE KONTO!</h2></strong></p>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    echo '<center><form method="post" action="signup.php">
                        <table>
                            <tr><td>Login</td><td><input type="text" name="login"</td></tr>
                            <tr><td>Hasło</td><td><input type="password" name="password"></td></tr>
                            <tr><td></td><td><input type="submit" value="Zarejestruj" ></td></tr>
                        </table>
                        </form></center>';
                } else {
                    require("connect.php");
                    $conn = connect();
                    $login = addslashes(htmlspecialchars($_POST['login']));
                    $pass = sha1(addslashes(htmlspecialchars($_POST['password'])));
                    if (mysql_query("INSERT INTO `admin` VALUES ('" . $login . "','" . $pass . "')")) {
                        echo '<strong>Zarejestrowano!</strong>';
                    } else {
                        echo '<strong>Niepowodzenie!</strong>';
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