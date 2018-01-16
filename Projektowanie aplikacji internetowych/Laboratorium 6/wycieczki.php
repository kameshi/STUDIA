<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title>PAI LAB6 Bartłomiej Osak Tomasz Pasternak</title>
		<link rel="stylesheet" type="text/css" href="../style.css" />
	</head>
	<body>
		<center><table>
			<?php
                $wycieczki = simplexml_load_file('wycieczki.xml');

                foreach ($wycieczki->panstwo as $panstwo) {
                    echo "<tr>";
                    foreach ($panstwo->attributes() as $n => $a) {
                        echo '<td colspan="2"><strong>Państwo: ' . $a . '</strong></td>';
                        echo "</tr>";
                        echo '<tr>
                                <td><strong>Miasto</strong></td>
                                <td><strong>Nazwa</strong></td>
                            </tr>';
                        foreach ($panstwo->miasto as $miasto) {
                            foreach ($miasto->attributes() as $n => $s) {
                                foreach ($miasto->wycieczka as $wycieczka) {
                                    foreach ($wycieczka->attributes() as $n => $v) {
                                        echo "<tr>";
                                        echo "<td>" . $s . "</td>";
                                        echo "<td>" . $v . "</td>";
                                        echo '<td><form action="wycieczki_rezerwacje.php" method="GET">
                                        <input type="hidden" name="nazwa_wycieczki" value="'.$v.'">
                                        <input type="submit" class="inside" value="Wyświetl rezerwacje"></form></td>';
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                    }
                }
            ?>
		</table>
        <br><form action="index.html">
            <input type="submit" value="Powrót" />
        </form></center>
	</body>
</html>