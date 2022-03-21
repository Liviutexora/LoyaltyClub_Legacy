<table width="710" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td height="60" align="center" valign="bottom" colspan="2">
    <br /><br />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="50%" align="left" height="35"><strong><em> &nbsp;Factura nr: </em><?=$invoiceDetails['id_factura']?></strong></td>
        <td width="50%" align="left" valign="middle"><em><strong>Data: <?=date('d-m-Y',time())?></strong></em></td>
    </tr>
    <tr>
        <td height="16">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    </table>
    </td>
</tr>
<tr>
    <td width="355" height="160" align="center" valign="bottom">
    <br /><br />
    <table width="325" border="0" align="center" cellpadding="2" cellspacing="2">
        <tr>
        <td width="110" align="right" valign="middle" bgcolor="#EBEBEB"><strong>Furnizor: </strong></td>
        <td width="215" align="left" valign="middle" bgcolor="#EBEBEB">SC FIDELIZAT SRL</td>
        </tr>
        <tr>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>Nr. reg. ORC: </strong></td>
        <td align="left" valign="middle" bgcolor="#EBEBEB">J35/696/2012</td>
        </tr>
        <tr>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>CIF:</strong></td>
        <td align="left" valign="middle" bgcolor="#EBEBEB">29952565</td>
        </tr>
        <tr>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>Adresa: </strong></td>
        <td align="left" valign="middle" bgcolor="#EBEBEB">BUZIAS, PRIMAVERII NR 29A, JUD TIMIS</td>
        </tr>
        <tr>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>Cod IBAN:</strong></td>
        <td align="left" valign="middle" bgcolor="#EBEBEB"></td>
        </tr>
        <tr>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>Banca:</strong></td>
        <td align="left" valign="middle" bgcolor="#EBEBEB">GARANTI BANK TIMISOARA</td>
        </tr>
        <tr>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>Capital social:</strong></td>
        <td align="left" valign="middle" bgcolor="#EBEBEB">200 lei</td>
        </tr>
    </table></td>
    <td width="355" align="center" valign="bottom">
    <br /><br />
    <table width="325" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
        <td width="110" align="right" valign="middle" bgcolor="#D3D3D3"><strong>Beneficiar:</strong></td>
        <td width="215" align="left" valign="middle" bgcolor="#D3D3D3"><?=$companyDetails['companyName']?></td>
    </tr>
    <tr>
        <td align="right" valign="middle" bgcolor="#D3D3D3"><strong>Nr. reg. ORC: </strong></td>
        <td align="left" valign="middle" bgcolor="#D3D3D3"><?=$companyDetails['nr_orc']?></td>
    </tr>
    <tr>
        <td align="right" valign="middle" bgcolor="#D3D3D3"><strong>CIF:</strong></td>
        <td align="left" valign="middle" bgcolor="#D3D3D3"><?=$companyDetails['cui']?></td>
    </tr>
    <tr>
        <td align="right" valign="middle" bgcolor="#D3D3D3"><strong>Adresa: </strong></td>
        <td align="left" valign="middle" bgcolor="#D3D3D3"><?=$companyDetails['street']." ".$companyDetails['number']?></td>
    </tr>
    <tr>
        <td align="right" valign="middle" bgcolor="#D3D3D3"><strong>Cod IBAN:</strong></td>
        <td align="left" valign="middle" bgcolor="#D3D3D3"><?=$companyDetails['iban']?></td>
    </tr>
    <tr>
        <td align="right" valign="middle" bgcolor="#D3D3D3"><strong>Banca:</strong></td>
        <td align="left" valign="middle" bgcolor="#D3D3D3"><?=$companyDetails['bank']?></td>
    </tr>
    </table></td>
</tr>
</table>
<table width="710" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td height="204" align="center" valign="top"><br />
    <table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="50" height="18" align="center" valign="middle">Nr. CRT</td>
        <td width="305" align="center" valign="middle">Denumire produse / servicii</td>
        <td width="40" align="center" valign="middle">U.M.</td>
        <td width="60" align="center" valign="middle">Cantitate </td>
        <td width="95" align="center" valign="middle">Pret unitar (RON)</td>
        <td width="80" align="center" valign="middle">Valoare (RON)</td>
        <td width="80" align="center" valign="middle">Valoare TVA (RON)</td>
    </tr>
    <tr>
        <td height="172" align="center" valign="top">1</td>
        <td align="center" valign="top">Prestari servicii conform contractului de publicitate nr. <?=$companyDetails['contract']?></td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">1</td>
        <td align="center" valign="top"><?=number_format($invoiceDetails['suma'],2)?></td>
        <td align="center" valign="top"><?=number_format($invoiceDetails['suma'],2)?></td>
        <td align="center" valign="top">0</td>
    </tr>
    <tr>
        <td height="25" align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>Total</strong></td>
        <td align="center" valign="top"><?=number_format($invoiceDetails['suma'],2)?></td>
        <td align="center" valign="top">0</td>
    </tr>
    <tr>
        <td height="31" align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
        <td align="right" valign="middle" bgcolor="#EBEBEB"><strong>Total plata</strong></td>
        <td colspan="2" align="center" valign="top"><?=number_format($invoiceDetails['suma'],2)?></td>
        </tr>
    </table>
    <table width="700" height="150" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="140" height="150" align="center" valign="middle">
            <br /> <br />
            <table width="137" align="center" cellpadding="2" cellspacing="0">
                <tr>
                <td width="137" height="113" align="left" valign="middle">Semnatura si stampila<br />furnizorului</td>
                </tr>
                <tr>
                <td width="137" align="left" valign="middle">Cosuleanu Liviu Adrian</td>
                </tr>
                <tr>
                <td width="137" align="left" valign="middle">TZ 042833</td>
                </tr>				
            </table>
            <br />
        </td>
        <td width="410" align="left" valign="top">
            <br /> <br />
            <table cellpadding="2">
                <tr>
                <td width="410" align="center" valign="middle"><b>Date privind expeditia</b></td>
                </tr>
                <tr>
                <td align="left" valign="middle"></td>
                </tr>
                <tr>
                <td align="left" valign="middle">Numele delegatului ................................</td>
                </tr>
                <tr>
                <td align="left" valign="middle">BI Seria ....... nr.................... eliberat de ....................................</td>
                </tr>
                <tr>
                <td align="left" valign="middle">Mijloc de transport ................................................. nr................</td>
                </tr>
                <tr>
                <td align="left" valign="middle">Expedierea s-a facut in prezenta noastra la <br>data de  ..................... ora ............</td>
                </tr>
                <tr>
                <td align="left" valign="middle">Semnaturile ......................................</td>
                </tr>				
            </table>
        </td>
        <td width="160" align="center" valign="bottom">
            <br /> <br /> 
            <table width="160" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                <td width="160" height="44" align="center" valign="middle"><b>Semnatura de primire</b></td>
                </tr>
            </table>
        </td>
        </tr>
    </table>
    </td>
</tr>
</table>