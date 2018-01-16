<html>
    <head>
        <meta charset="UTF-8"/>
        <title>PAI LAB6 Bartłomiej Osak Tomasz Pasternak</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    <body><center>
        <?php
        if (isset($_GET['nazwa_wycieczki'])) {
            $nazwa = $_GET['nazwa_wycieczki'];
            $rezerwacje = simplexml_load_file('rezerwacje.xml');
            echo '<h4>Rezerwacje dla wycieczki: ' . $nazwa . '<h4>';
            foreach ($rezerwacje->naleznosci->rezerwacja as $rezerwacja) {
                foreach ($rezerwacja->attributes() as $a => $b) {
                    if (trim($b) == trim($nazwa)) {
                        echo '<table class="php">';
                        foreach ($rezerwacja->attributes() as $e => $f) {
                            if (!(trim($f) == trim($nazwa))) {
                                echo '<tr>
                                <td><strong>PESEL rezerwującego</strong></td>
                                <td><strong>Cena</strong></td>
                                </tr>';
                                echo '<tr>
                                <td>' . $f . '</td>';
                                echo '<td>' . $rezerwacja . '</td>';
                                echo '</tr>';
                            }
                        }
                    }
                    echo '</table>';
                }
            }
        }
        echo '<br><form action="wycieczki.php">
            <input type="submit" value="Powrót" />
        </form>';
        ?>
    </center></body>
</html>