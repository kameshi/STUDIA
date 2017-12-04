<?php
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	$user = mysql_query("SELECT * FROM users WHERE login = '" . $login . "' and password = '" . $password . "'") or die(mysql_query());
	if (mysql_num_rows($user) == 0) 
	{
?> 
	<p><strong>REJESTRACJA</strong></p><br>
	<form action="?zad=1&task=register" method="post">
		<p>LOGIN:</p><input type="text" name="login">
		<br>
		<p>HASŁO:</p><input type="password" name="password">
		<br><br>
		<input type="submit" value=">>  ZAREJESTRUJ  <<">
		<hr>
	</form>
	<br>
	<p><strong>LOGOWANIE</strong></p><br>
	<form action="?zad=1&task=login" method="post">
		<p>LOGIN:</p><input type="text" name="login">
		<br>
		<p>HASŁO:</p><input type="password" name="password">
		<br><br>
		<input type="submit" value=">>  ZALOGUJ  <<">
		<hr>
	</form>
	<?php
	} 
	else 
	{
		$data_user = mysql_fetch_array($user);
		echo '<p>ZALOGOWANO - DANE: <strong>' . $data_user['login'] . '</strong><br>';
		echo '<a href="?zad=1&task=logout">WYLOGUJ</a><br>';
	}
	$task = $_GET['task'];
	if ($task == 'register') 
	{
		$login_tmp = htmlspecialchars(trim($_POST['login']));
		$password_tmp = htmlspecialchars(trim(md5($_POST['password'])));
		if ($_POST) 
		{
			if ($login_tmp && $password_tmp) 
			{
				$user_tmp = mysql_query("SELECT * FROM users WHERE login = '" . $login_tmp . "'") or die(mysql_query());
				if (mysql_num_rows($user_tmp) == 0) 
				{
					mysql_query("INSERT INTO users(login,password) VALUES ('" . $login_tmp . "','" . $password_tmp . "')") or die(mysql_error());
					header('Location: ?zad=1');
				} 
				else 
				{
					echo '<br><strong>LOGIN ZAJETY!</strong>';
				}
			}
		} 
		else 
		{
			echo '<strong>NIE WYPEŁNIONO WYMAGANYCH PÓL</strong>';
		}
	}
	if ($task == 'login') 
	{
		$login_tmp = $_POST['login'];
		$password_tmp = $_POST['password'];
		if ($_POST) 
		{
			if ($login_tmp && $password_tmp) 
			{
				$login_tmp = htmlspecialchars(trim($login_tmp));
				$password_tmp = htmlspecialchars(trim(md5($password_tmp)));
				$user_tmp = mysql_query("SELECT * FROM users WHERE login = '" . $login_tmp . "' AND password = '" . $password_tmp . "'") or die(mysql_query());
				if (mysql_num_rows($user_tmp) != 0) 
				{
					$user_tmpp = mysql_fetch_array($user_tmp);
					$_SESSION['login'] = $user_tmpp['login'];
					$_SESSION['password'] = $user_tmpp['password'];
					header('Location: ?zad=1');
				} 
				else 
				{
					echo '<br><strong>UŻYTKOWNIK NIE ISTNIEJE</strong>';
				}
			}
		} 
		else 
		{
			echo '<strong>NIE WYPEŁNIONO WYMAGANYCH PÓL</strong>';
		}
	}
	if ($task == 'logout') 
	{
		session_unset();
		session_destroy();
		header('Location: ?zad=1');
	}
?>

<br><a href="index.php">POWRÓT</a>



