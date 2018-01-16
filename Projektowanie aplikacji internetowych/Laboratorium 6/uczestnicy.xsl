<?xml version="1.0" encoding="UTF-8" ?>
	<xsl:stylesheet version="1.0"
		xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">

	<xsl:output method="xml" indent="yes"
		doctype-public="-//W3C//DTD XHTML 1.1//EN"
		doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"/>
    
	<xsl:template match="/">
		<html>
			<head>
				<title>PAI LAB6 Bartłomiej Osak Tomasz Pasternak</title>
				<link rel="stylesheet" type="text/css" href="style.css" />
			</head>
			<body>
				<xsl:apply-templates/>
				<center>
					<form action="index.html">
						<input type="submit" class="inside" value="Powrót" />
					</form>
				</center>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="uczestnicy">
		<center>
			<h4>
			Tabela uczestników:
		</h4>
		<table>
			<tr>
				<td><strong>Imię</strong></td>
				<td><strong>Nazwisko</strong></td>
				<td><strong>PESEL</strong></td>
                <td><strong>Telefon</strong></td>
			</tr>
			<xsl:for-each select="uczestnik">
				<tr>
					<td><xsl:value-of select="imie"/></td>
					<td><xsl:value-of select="nazwisko"/></td>
					<td><xsl:value-of select="@pesel"/></td>
                    <td><xsl:value-of select="telefon"/></td>
				</tr>
			</xsl:for-each>
		</table></center>
	</xsl:template>
</xsl:stylesheet>