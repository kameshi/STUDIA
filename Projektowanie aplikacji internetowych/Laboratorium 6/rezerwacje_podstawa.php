<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title>PAI LAB6 Bartłomiej Osak Tomasz Pasternak</title>
		<link rel="stylesheet" type="text/css" href="../style.css" />
	</head>
	<body>
		<center><table><h4>
			Tabela rezerwacji:
		</h4>	
			<?php
                $rezerwacje = simplexml_load_file('rezerwacje.xml');
                echo '<tr>
                <td><strong>PESEL</strong></td>
                <td><strong>Nazwa wycieczki</strong></td>
                <td><strong>Należność</strong></td>
                </tr>';
                foreach ($rezerwacje->naleznosci->rezerwacja as $rezerwacja) {
                    echo '<tr>';
                    foreach ($rezerwacja->attributes() as $n => $a) {
                        echo '<td>' . $a . '</td>';
                    }
                    echo '<td>' . $rezerwacja . '</td>';
                }
            ?>
		</table>
        <br>
        <form action="index.html">
            <input type="submit" value="Powrót" />
        </form></center>
	</body>
</html>