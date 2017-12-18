<?php
include("createDB.php");

class loginAdmin {
    
    public function checkLoginDB($login, $pass)
    {
        $query = mysql_query("SELECT * FROM `admin` WHERE login = '" . $login . "'");
        if (mysql_num_rows($query) > 0) {
            $row = mysql_fetch_row($query);
            if ($row[1] == $pass) {
                $_SESSION['loginadmin'] = $login;
                $_SESSION['passwordadmin'] = $pass;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    
    }
    
    public function checkLoginSession()
    {
        session_start();
        if (isset($_SESSION['loginadmin']) && isset($_SESSION['passwordadmin'])) {
            $login = $_SESSION['loginadmin'];
            $pass = $_SESSION['passwordadmin'];
            if ($this->checkLoginDB($login, $pass)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function login($login, $pass)
    {
        $login = $_POST['loginadmin'];
        $pass = $_POST['passwordadmin'];
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
    
    public function checkSession()
    {
        if (!$this->checkLoginSession()) {
            header("Location: signin.php");
        }
    }
}
?>