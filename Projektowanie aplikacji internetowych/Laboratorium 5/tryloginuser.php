<?php
    include("createDB.php");
    class loginUser{

        function checkLoginDB($login, $pass)
        {
            $query = mysql_query("SELECT * FROM `user` WHERE login = '" . $login . "'");
            if (mysql_num_rows($query) > 0) {
                $row = mysql_fetch_row($query);
                if ($row[1] == $pass) {
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $pass;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        
        }
        
        function checkLoginSession()
        {
            session_start();
            if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
                $login = $_SESSION['login'];
                $pass = $_SESSION['password'];
                if ($this->checkLoginDB($login, $pass)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        function login($login, $pass)
        {
            $login = $_POST['login'];
            $pass = $_POST['password'];
            $pass = addslashes($pass);
            $login = addslashes($login);
            $login = htmlspecialchars($login);
            $pass = sha1($pass);
            if ($this->checkLoginDB($login, $pass)) {
                return true;
            } else {
                return false;
            }
        }
        
        function checkSession()
        {
            if (!$this->checkLoginSession()) {
                header("Location: signinuser.php");
            }
        }
    }
?>