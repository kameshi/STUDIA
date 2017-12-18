<?php 
    error_reporting(E_ALL ^ E_DEPRECATED);
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
                        <a id="first" href="forum.php">FORUM</a>
                    </li>
                    <li>
                        <a href="logoutuser.php">WYLOGUJ</a>
                    </li>
                </ul>
            </div>
            <div id="content">
            <p><strong><h2>DODAJ NOWY ARTYKUŁ DO DYSKUSJI!</h2></strong></p>
                <?php
                require("tryloginuser.php");
                $object = new loginUser();
                $object->checkSession();
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    echo '<center><form method="post" action="addtopic.php">
                        <table>
                            <tr><td>Podaj temat:</td><td><input type="text" maxlength="20" name="name"></td></tr>
                            <tr><td>Artykuł: </td><td><textarea rows="10" cols="30" name="content"></textarea></td></tr>
                            <tr><td></td><td><input type="submit" value="Dodaj" ></td></tr>
                        </table>
                        </form></center>';
                } else if(!empty($_POST["name"]) && !empty($_POST["content"])) {
                    $name = htmlspecialchars($_POST["name"]);
                    $content = $_POST["content"];
                    if (mysql_query("INSERT INTO `topic` VALUES ( '" . $name . "','" . $content . "')")) {
                        header("Location: forum.php");
                    } else {
                        echo '<strong>Błąd dodawania nowego tematu!</strong>';
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