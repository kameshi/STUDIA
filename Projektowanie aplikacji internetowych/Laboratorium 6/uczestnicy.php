<html>
    <head>
        <meta charset="UTF-8"/>
        <title>PAI LAB6 Bartłomiej Osak Tomasz Pasternak</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>
        <?php
            $uczestnicy = simplexml_load_file('uczestnicy.xml');
            if($uczestnicy!=FALSE)
            {
                echo '<center><table><tr>
                <td><strong>Imię</strong></td>
                <td><strong>Nazwisko</strong></td>
                <td><strong>Pesel</strong></td>
                <td><strong>Telefon</strong></td></tr>';
                foreach($uczestnicy->uczestnik as $uczestnik)
                {
                    foreach($uczestnik->attributes() as $a=>$b)
                    {
                        echo '<tr>
                        <td>'.$uczestnik->imie.'</td>
                        <td>'.$uczestnik->nazwisko.'</td>
                        <td>'.$b.'</td>
                        <td>'.$uczestnik->telefon.'</td>
                        <td><form action="uczestnicy_rezerwacje.php" method="GET">
                        <input type="hidden" name="pesel" value='.$b.'>
                        <input type="submit" class="inside" value="Wyświetl rezerwacje"></form></td>
                        </tr>';
                    }
                }
                echo '</table>';
            }
            else
            {
                echo 'Błąd pobrania danych!';
            }
            echo '<br><form action="index.html">
                <input type="submit" value="Powrót" />
            </form></center>';

        ?>
    </body>
</html>