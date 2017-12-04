<?php
    include('config.php');
    if($_POST)
    {
        if($_POST["name"])
        {
            $name = htmlspecialchars(trim($_POST['name']));
        }

        if($_POST["capital"])
        {
            $capital = htmlspecialchars(trim($_POST['capital']));
        }

        if($_POST["add"])
        {
            if(!empty($name) && !empty($capital))
            {
                mysql_query("INSERT INTO country SET name = '" .$name. "', capital='" .$capital. "'");
            }
            header("Location: ?");
        }

        if($_POST["modify"])
        {
            $idEditRow = htmlspecialchars(trim($_POST["idEditRow"]));
            if(!empty($name) && !empty($capital))
            {
                mysql_query("UPDATE country SET name = '" .$name. "', capital='" .$capital. "' WHERE id = '" .$idEditRow. "'");
            }
            header("Location: ?");
        }

        if($_POST["delete"])
        {
            $deleteRow = $_POST["delete"];
            foreach($deleteRow as $idDeleteRow)
            {
                mysql_query("DELETE FROM country WHERE id = '" .$idDeleteRow. "'");
                header('Location: ?');
            }
            $result = mysql_result(mysql_query("SELECT COUNT(*) FROM country"));
            if($result == 0)
            {
                mysql_query("ALTER TABLE country AUTO_INCREMENT = 1");
            }
        }
    }
?>

<?php
    $orderASC = "asc";
    $orderDESC = "desc";
    $cookieName = "sortTableColumn";
    if(!$_GET)
    {
        $query = "SELECT * FROM country";
        $cookieValue = "asc";
        setcookie($cookieName,$cookieValue);
    }
    else
    {
        $orderSort = $_GET["order"];
        $sort = $_GET['sort'];
        $cookieValue = $_COOKIE[$cookieName];
        if($orderSort == $cookieValue)
        {
            $query = "SELECT * FROM country ORDER BY " .$sort. " " .$orderDESC;
            $cookieValue = $orderDESC;
            setcookie($cookieName,$cookieValue);
        }
        else
        {
            $query = "SELECT * FROM country ORDER BY " .$sort. " " .$orderASC;
            $cookieValue = $orderASC;
            setcookie($cookieName,$cookieValue);
        }
    }
    $resultQuery = mysql_query($query);

    echo 
    '<form action="?" method="post">
    <input type="hidden" name="delete" value="delete">
    <center>
    <table border="1" style="border-collapse: collapse;font-family: Arial; font-size:14px;">
    <tr>
    <th> <a href="?sort=id&order=asc">ID</a> </th>
    <th> <a href="?sort=name&order=asc">PAŃSTWO</a> </th>
    <th> <a href="?sort=capital&order=asc">STOLICA</a> </th>
    <th> <input type="submit" name="edit" value="EDYTUJ"> </th>
    <th> <input type="submit" name="delete" value="USUŃ"> </th>
    </tr>';

    while($row=mysql_fetch_row($resultQuery))
    {
        echo '<tr>
        <td>' .$row[0]. '</td>
        <td>' .$row[1]. '</td>
        <td>' .$row[2]. '</td>
        <td> <input type="radio" name="idEditRow" value=' .$row[0]. '></td>
        <td> <input type="checkbox" name="delete[]" value=' .$row[0]. '> </td>
        </tr>';
    }
    echo "</table></form><hr>";

    $result = mysql_result(mysql_query("SELECT MAX(id) as id FROM country"),0) + 1;
    echo 
    '<p style="font-family: Arial; font-size: 14px;"><strong>Dodawanie:</strong></p>
    <form action="?" method="post">
    <input style="max-width: 30px;" type="text" name="id" placeholder = "' .$result. '" readonly>
    <input type="text" name="name" placeholder="Państwo">
    <input type="text" name="capital" placeholder="Stolica">
    <input type="submit" name="add" value="Dodaj">
    </form></center>';

    if($_POST["edit"])
    {
        $idEditRow = $_POST["idEditRow"];
        if($idEditRow >= 1)
        {
            echo 
            '<center><hr>
            <p style="font-family: Arial; font-size: 14px;"><strong>Modyfikacja:</strong></p>
            <form action="z2.php" method="post">
            <input style="max-width: 30px;" type="text" name="id" placeholder = "'  .$idEditRow. '" readonly>
            <input type="text" name="name" placeholder="Państwo">
            <input type="text" name="capital" placeholder="Stolica">
            <input type="hidden" name="idEditRow" value="' .$idEditRow. '">
            <input type="submit" name="modify" value="Edytuj"><hr style="margin-top: 16px;"></center>';
        }
    }
?>




