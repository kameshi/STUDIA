<form action="?zad=33" method="post" enctype="multipart/form-data">
    <p><strong>WYBIERZ PLIK: </strong></p>
    <input type="file" name="file">
    <br><br><input type="submit" value="Wgraj">
</form>

<?php
    $file = $_FILES['file'];
    if($_FILES)
    {
        if(!file_exists("files/"))
        {
            mkdir("files/",0666,true);
        }
        $file_dir = "files/" . basename($file['name']);
        $type = pathinfo($file['name'], PATHINFO_EXTENSION);
        if($type == "zip" || $type == "rar")
        {
            move_uploaded_file($file['tmp_name'], $file_dir);
        }
        else
        {
            echo "<strong>Wybrane rozszerzenie pliku jest nieprawidlowe!<br><strong>";
        }
        header("Location: ?zad=33");
    }
?>

<a href="index.php">POWRÓT</a>
