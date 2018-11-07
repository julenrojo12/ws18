<?xml version="1.0" encoding ="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<HTML><BODY>


<TABLE border="1">
<THEAD><TR><TH>Eposta</TH><TH>Gaia</TH><TH>Enuntziatua</TH><TH>Erantzuna</TH><TH>Faltsuak</TH></TR></THEAD>
<xsl:for-each select="/assessmentItems/assessmentItem" >
<TR>
<TD><FONT SIZE="2" COLOR="red" FACE="Verdana">
<xsl:value-of select="@author"/> <BR/>
</FONT>
</TD>
<TD>
<FONT SIZE="2" COLOR="blue" FACE="Verdana">
<xsl:value-of select="@subject"/> <BR/>
</FONT>
</TD>
<TD>
<FONT SIZE="2" COLOR="blue" FACE="Verdana">
<xsl:value-of select="itemBody/p"/> <BR/>
</FONT>
</TD>
<TD>
<FONT SIZE="2" COLOR="blue" FACE="Verdana">
<xsl:value-of select="correctResponse/value"/> <BR/>
</FONT>	
</TD>
<TD>
<FONT SIZE="2" COLOR="blue" FACE="Verdana">
<xsl:for-each select="incorrectResponses/value">
<xsl:value-of select="."/> <BR/>
</xsl:for-each>
</FONT>
</TD>
</TR>
</xsl:for-each>
</TABLE>
</BODY></HTML>
</xsl:template>
</xsl:stylesheet>