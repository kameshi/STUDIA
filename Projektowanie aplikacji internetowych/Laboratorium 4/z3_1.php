<?php
    date_default_timezone_set('Europe/Warsaw');
    if (file_exists("book.txt")) 
    {
        $book = fopen("book.txt", "r+");
    } 
    else 
    {
        $book = fopen("book.txt", "w+");
    }
    $i = 0;
    while ( ($line = fgets($book)) !== false) 
    {
        if ($i == 0) 
        {
            echo "<strong>Autor wpisu: </strong>" . $line . " ";
        }
        else if ($i == 1) 
        {
            echo "<br><strong>Data wpisu: </strong>" . $line . " ";
            echo "<br><strong>Treść wpisu:</strong><br>";
        }
        else if (strlen($line) != 1) 
        {
            echo $line . "<br>";
        }
        $i++;
        if (strlen($line) == 1) 
        {
            $i = 0;
            echo "<br><hr>";
        }
    }

    echo "<center><strong>FORMULARZ</center></strong><br><hr>";
    echo "<form action='?zad=31' method = 'post'>";
    echo "<strong>Autor wpisu:</strong> <input type=text name=author><br><br>";
    echo "<strong>Treść wpisu : </strong> <textarea cols=100 rows=20 name=message></textarea><br><br>";
    echo "<input type=submit value = Publikuj><br>";
    echo "</form><hr>";

    $author = htmlspecialchars(trim($_POST['author']));
    $message = htmlspecialchars(trim($_POST['message']));
    $date = date('d M Y H:i:s');

    if ($_POST) {
        if ($author && $message) 
        {
            fputs($book, $author . "\n");
            fputs($book, $date . "\n");
            fputs($book, $message . "\n");
            fputs($book, "\n");
            header('Location: ?zad=31');
        } 
        else 
        {
            echo "<strong>Uzupelnij wszystkie pola!</strong><br>";
        }
    }
    fclose($book);
?>

<br><a href="index.php">POWRÓT</a>
    