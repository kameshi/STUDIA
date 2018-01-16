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
	<xsl:template match="wycieczki">
		<center>
			<h4>
			Tabela dostępnych wycieczek:
		</h4>
			<table>
				<tr>
					<td>
						<strong>Nazwa wycieczki</strong>
					</td>
					<td>
						<strong>Państwo</strong>
					</td>
					<td>
						<strong>Miasto</strong>
					</td>
				</tr>
				<xsl:for-each select="panstwo">
					<xsl:for-each select="miasto">
						<xsl:for-each select="wycieczka">
							<tr>
								<td>
									<xsl:value-of select="@nazwa_wycieczki"/>
								</td>
								<td>
									<xsl:value-of select="../../@nazwa_panstwa"/>
								</td>
								<td>
									<xsl:value-of select="../@nazwa_miasta"/>
								</td>
							</tr>
						</xsl:for-each>
					</xsl:for-each>
				</xsl:for-each>
			</table>
		</center>
	</xsl:template>
</xsl:stylesheet>