<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title>PAI LAB6 Bartłomiej Osak Tomasz Pasternak</title>
		<link rel="stylesheet" type="text/css" href="../style.css" />
	</head>
	<body>
		<center><table><h4>
			Tabela rezerwacji z danymi szczegółowymi:
		</h4>
			<?php
                $rezerwacje = simplexml_load_file('rezerwacje.xml');
                $uczestnicy = simplexml_load_file('uczestnicy.xml');
                $wycieczki = simplexml_load_file('wycieczki.xml');
                echo '<tr>
                    <td><strong>Imie</strong></td>
                    <td><strong>Nazwisko</strong></td>
                    <td><strong>PESEL</strong></td>
                    <td><strong>Telefon</strong></td>
                    <td><strong>Nazwa wycieczki</strong></td>
                    <td><strong>Panstwo</strong></td>
                    <td><strong>Miasto</strong></td>
                    <td><strong>Należność</strong></td>
                </tr>';
                foreach ($rezerwacje->naleznosci->rezerwacja as $rezerwacja) {
                    echo '<tr>';
                    foreach ($rezerwacja->attributes() as $rez) {
                        foreach($uczestnicy->uczestnik as $uczestnik) {
                            foreach($uczestnik->attributes() as $ucz) {
                                if(trim($rez)==trim($ucz)) {
                                    echo '<td>' . $uczestnik->imie . '</td>';
                                    echo '<td>' . $uczestnik->nazwisko . '</td>';
                                    echo '<td>' . $rez . '</td>';
                                    echo '<td>' . $uczestnik->telefon . '</td>';
                                }
                            }
                        }
                        foreach($wycieczki->panstwo as $panstwo) {
                            foreach($panstwo->attributes() as $p) {
                                foreach($panstwo->miasto as $miasto) {
                                    foreach($miasto->attributes() as $m) {
                                        foreach($miasto->wycieczka as $wycieczka) {
                                            foreach($wycieczka->attributes() as $wyc) {
                                                if(trim($rez) == trim($wyc)) {
                                                    echo '<td>' . $wyc . '</td>';
                                                    echo '<td>' . $p . '</td>';
                                                    echo '<td>' . $m . '</td>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    echo '<td>' . $rezerwacja . '</td></tr>';
                }
            ?>
		</table>
        <br>
        <form action="index.html">
            <input type="submit" value="Powrót" />
        </form></center>
	</body>
</html>