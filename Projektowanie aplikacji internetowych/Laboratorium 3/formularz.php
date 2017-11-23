<head>
   <meta charset="utf-8">
   <title>Bartłomiej Osak - Tomasz Pasternak - 3ID13B</title>
</head>

<?php
    if ($_POST) {
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $wiek = $_POST['wiek'];
        $kontakt = $_POST['kontakt'];
        $plec = $_POST['plec'];
        $uczelnia = $_POST['uczelnia'];
        $opis = htmlspecialchars(trim($_POST['opis']));
        if ($imie && $nazwisko && $wiek && $kontakt && $plec && $uczelnia && $opis) {
            echo '<b>Imie: </b>' . $imie . '<br>';
            echo '<b>Nazwisko: </b>' . $nazwisko . '<br>';
            echo '<b>Wiek: </b>' . $wiek . '<br>';
            echo '<b>Kontakt: </b>' . $kontakt . '<br>';
            if ($plec == 'k') {
                echo '<b>Płeć:</b> kobieta<br>';
            } else {
                echo '<b>Płeć:</b> mężczyzna<br>';
            }
            if ($uczelnia == 'ujk') {
                echo '<b>Uczelnia: UJK Kielce </b><br>';
            } else if ($uczelnia == 'psk') {
                echo '<b>Uczelnia: </b>PŚk Kielce<br>';
            } else {
                echo '<b>Uczelnia: </b>WSEPiNM Kielce<br>';
            }
            echo '<b>Coś o sobie: </b>' . $opis . '<br>';
        } else {
            echo '<b>Wypełnij wszystkie pola formularza!</b>';
        }
    }
    if ($_GET)
    {
        $imie = $_GET['imie'];
        $nazwisko = $_GET['nazwisko'];
        $wiek = $_GET['wiek'];
        $kontakt = $_GET['kontakt'];
        $plec = $_GET['plec'];
        $uczelnia = $_GET['uczelnia'];
        $opis = htmlspecialchars(trim($_GET['opis']));
        if ($imie && $nazwisko && $wiek && $kontakt && $plec && $uczelnia && $opis) {
            echo '<b>Imie: </b>' . $imie . '<br>';
            echo '<b>Nazwisko: </b>' . $nazwisko . '<br>';
            echo '<b>Wiek: </b>' . $wiek . '<br>';
            echo '<b>Kontakt: </b>' . $kontakt . '<br>';
            if ($plec == 'k') {
                echo '<b>Płeć:</b> kobieta <br>';
            } else {
                echo '<b>Płeć:</b> mężczyzna <br>';
            }
            if ($uczelnia == 'ujk') {
                echo '<b>Uczelnia:</b> UJK Kielce <br>';
            } else if ($uczelnia == 'psk') {
                echo '<b>Uczelnia:</b> PŚk Kielce <br>';
            } else {
                echo '<b>Uczelnia:</b> WSEPiNM Kielce <br>';
            }
            echo '<b>Coś o sobie:</b> ' . $opis . '<br>';
        } else {
            echo '<b>Wypełnij wszystkie pola formularza!</b>';
        }
    }
?>
<br>
<a href="index.html">POWRÓT</a>