<?php
    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    if($login && $password)
    {
        echo '<p>ZALOGOWANO - DANE: <strong>' . $login . '</strong><br>';
		echo '<a href="?zad=32&task=logout">WYLOGUJ</a><br>';
    }
    else
    {
?>
    <p><strong>REJESTRACJA</strong></p><br>
        <form action="?zad=32&task=register" method="post">
            <p>LOGIN:</p><input type="text" name="login">
            <br>
            <p>HASŁO:</p><input type="password" name="password">
            <br><br>
            <input type="submit" value=">>ZAREJESTRUJ<<">
        </form>
        <br><hr>
        <p><strong>LOGOWANIE</strong></p><br>
        <form action="?zad=32&task=login" method="post">
            <p>LOGIN:</p><input type="text" name="login">
            <br>
            <p>HASŁO:</p><input type="password" name="password">
            <br><br>
            <input type="submit" value=">>ZALOGUJ<<">
        </form><hr>
<?php
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));
        $task = $_GET['task'];
        if($_POST)
        {
            if($login && $password)
            {
                if($task == "register")
                {
                    $users = fopen("users.txt","a+");
                    fputs($users, $login . "\n");
                    fputs($users, md5($password) . "\n");
                    fclose($users);
                }
                if($task == "login")
                {
                    if(file_exists("users.txt"))
                    {
                        $users = fopen("users.txt","r+");
                    }
                    else
                    {
                        $users = fopen("users.txt","w+");
                    }
                    while(($line = fgets($users)) !== false)
                    {
                        $password_tmp = fgets($users);
                        if(trim($line) == $login && md5($password) == trim($password_tmp))
                        {
                            $_SESSION['login'] = $login;
                            $_SESSION['password'] = $password_tmp;
                            break;                 
                        }
                    }
                    fclose($users);
                }
                header('Location: ?zad=32');
            }
            else
            {
                echo "<strong>Uzupełnij wszystkie pola!</strong>";
            }
        }
    }

    if($_GET['task'] == "logout")
    {
        session_unset();
        session_destroy();
        header('Location: ?zad=32');
    }
?>

<a href="index.php">POWRÓT</a>