<?php 

function tryLogin($login, $haslo)
{

	include("connect.php");
	$connection = connect();

	if (!$connection) {
		header('Location: error.php');
	}

	$queryPage = "SELECT * FROM `admin` WHERE login = '" . $login . "'";
	$resPage = mysqli_query($connection, $queryPage);

	if (mysqli_num_rows($resPage) > 0) {
		$row = mysqli_fetch_row($resPage);
		if ($row[1] == $haslo) 
		{
			$_SESSION['login'] = $login;
			$_SESSION['haslo'] = $haslo;
			return true;
		} 
		else 
		{
			return false;
		}
	} 
	else 
	{
		return false;
	}
}

function tryLoginFromSession()
{

	session_start();
	if ( (isset($_SESSION['login'])) && (isset($_SESSION['haslo']))) {
		$login = $_SESSION['login'];
		$haslo = $_SESSION['haslo'];
		if (tryLogin($login, $haslo)) {
			return true;
		} else {
			return false;
		}

	} else {
		return false;
	}
}

function login($login, $haslo)
{
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	$haslo = addslashes($haslo);
	$login = addslashes($login);
	$login = htmlspecialchars($login);
	$haslo = sha1($haslo);

	if (tryLogin($login, $haslo)) {
		return true;
	} else {
		return false;
	}

}

function checkSession()
{
	if (!tryLoginFromSession()) {
		header("Location: logowanie.php");
	}
}

?>
