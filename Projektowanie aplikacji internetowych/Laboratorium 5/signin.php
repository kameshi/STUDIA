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
                </ul>
            </div>
            <div id="content">
                <p><strong><h2>ZALOGUJ SIĘ DO PANELU ADMINISTRATORA!</h2></strong></p>
                <?php
                    require("trylogin.php");
                    if (checkLoginSession()) {
                        header("Location: adminpanel.php");
                    }

                    if (isset($_POST['login']) && isset($_POST['password'])) {
                        $login = $_POST['login'];
                        $pass = $_POST['password'];
                        $pass = addslashes($pass);
                        $login = addslashes($login);
                        $login = htmlspecialchars($login);
                        $pass = sha1($pass);
                        if (login($login, $pass)) {
                            header("Location: adminpanel.php");
                        } else {
                            echo '<strong>Błędny login lub hasło! Spróbuj ponownie!</strong>';
                        }
                    }
                    
                    echo '<center><form method="post" action="signin.php">
                    <table>
                        <tr><td>Login</td><td><input type="text" name="login"</td></tr>
                        <tr><td>Hasło</td><td><input type="password" name="password"></td></tr>
                        <tr><td></td><td><input type="submit" value="Zaloguj" ></td></tr>
                    </table>
                    </form></center>';
                ?>
            </div>
        </article>
        <footer>
            <h2 class="signature">Bartłomiej Osak, Tomasz Pasternak</h2>
        </footer>
    </div>
</body>

</html>