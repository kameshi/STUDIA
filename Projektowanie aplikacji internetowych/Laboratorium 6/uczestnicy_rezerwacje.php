<html>
    <head>
        <meta charset="UTF-8"/>
        <title>PAI LAB6 Bartłomiej Osak Tomasz Pasternak</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body><center>
        <?php
        if (isset($_GET['pesel'])) {
            $pesel = $_GET['pesel'];
            $uczestnicy = simplexml_load_file('uczestnicy.xml');
            $rezerwacje = simplexml_load_file('rezerwacje.xml');
            foreach ($uczestnicy->uczestnik as $uczestnik) {
                foreach ($uczestnik->attributes() as $a => $b) {
                    if (trim($b) == trim($pesel)) {
                        $uczestnik_tmp = $uczestnik;
                    }
                }
            }
            echo '<h4>Rezerwacje dla uczestnika: ' . $uczestnik_tmp->imie . ' ' . $uczestnik_tmp->nazwisko . '<br>PESEL: '. $pesel . '<h4>';
            foreach ($rezerwacje->naleznosci->rezerwacja as $rezerwacja) {
                foreach ($rezerwacja->attributes() as $a => $b) {
                    if (trim($b) == trim($pesel)) {
                        foreach ($rezerwacja->attributes() as $e => $f) {
                            echo '<table class="php">';
                            if (!(trim($f) == trim($pesel))) {
                                echo '<tr>
                                <td><strong>Nazwa wycieczki</strong></td>
                                <td><strong>Cena</strong></td>
                                </tr>';
                                echo '<tr><td>' . $f . '</td>';
                                echo '<td>' . $rezerwacja . '</td>';
                                echo '</tr>';
                            }
                        }
                        echo '</table>';
                    }
                }
            }
        }
        echo '<br><form action="uczestnicy.php">
            <input type="submit" value="Powrót" />
        </form>';
        ?>
    </center></body>
</html>