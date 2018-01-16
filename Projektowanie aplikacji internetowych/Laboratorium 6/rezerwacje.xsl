<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
	xmlns="http://www.w3.org/1999/xhtml">
	<xsl:output method="xml" indent="yes" doctype-public="-//W3C//DTD XHTML 1.1//EN" doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"/>
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
	<xsl:template match="naleznosci">
		<center>
			<h4>
			Tabela rezerwacji z danymi szczegółowymi:
		</h4>
		<table>
			<tr>
				<td><strong>Imie</strong></td>
				<td><strong>Nazwisko</strong></td>
				<td><strong>PESEL</strong></td>
				<td><strong>Telefon</strong></td>
				<td><strong>Nazwa wycieczki</strong></td>
				<td><strong>Panstwo</strong></td>
				<td><strong>Miasto</strong></td>
				<td><strong>Naleznosc</strong></td>
			</tr>
			<xsl:for-each select="rezerwacja">
				<tr>
					<xsl:variable name="naz">
						<xsl:value-of select="@pesel"/>
					</xsl:variable>
					<xsl:variable name="nazwycieczki">
						<xsl:value-of select="@nazwa_wycieczki"/>
					</xsl:variable>
					<xsl:for-each select="document('uczestnicy.xml')/uczestnicy/uczestnik[@pesel=$naz]">
						<td>
							<xsl:value-of select="imie"/>
						</td>
					</xsl:for-each>
					<xsl:for-each select="document('uczestnicy.xml')/uczestnicy/uczestnik[@pesel=$naz]">
						<td>
							<xsl:value-of select="nazwisko"/>
						</td>
					</xsl:for-each>
					<td>
						<xsl:value-of select="@pesel"/>
					</td>
					<xsl:for-each select="document('uczestnicy.xml')/uczestnicy/uczestnik[@pesel=$naz]">
						<td>
							<xsl:value-of select="telefon"/>
						</td>
					</xsl:for-each>
					<td>
						<xsl:value-of select="@nazwa_wycieczki"/>
					</td>
					<xsl:for-each select="document('wycieczki.xml')/wycieczki/panstwo/miasto/wycieczka[@nazwa_wycieczki=$nazwycieczki]">
						<td>
							<xsl:value-of select="../../@nazwa_panstwa"/>
						</td>
					</xsl:for-each>
					<xsl:for-each select="document('wycieczki.xml')/wycieczki/panstwo/miasto/wycieczka[@nazwa_wycieczki=$nazwycieczki]">
						<td>
							<xsl:value-of select="../@nazwa_miasta"/>
						</td>
					</xsl:for-each>
					<td>
						<xsl:value-of select="."/>
					</td>
				</tr>
			</xsl:for-each>
		</table></center>
	</xsl:template>
</xsl:stylesheet>