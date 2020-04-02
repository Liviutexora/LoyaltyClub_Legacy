
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
    <tr>
        <td width="100%" align="center" valign="middle" style="font-size:50px"><?=$this->lang->line('Company Section Ticket Label Pdf Ticket Check List')?></td>
    </tr>
</table>
<br><br>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
    <tr>
        <td width="25%" align="center" valign="middle" bgcolor="#E0E0E0"><?=$this->lang->line('Company Section Ticket Label Pdf Ticket Serial')?></td>
        <td width="20%" align="center" valign="middle" bgcolor="#E0E0E0"><?=$this->lang->line('Company Section Ticket Label Pdf Ticket Discount')?></td>
        <td width="20%" align="center" valign="middle" bgcolor="#E0E0E0"><?=$this->lang->line('Company Section Ticket Label Pdf Ticket Value')?></td>
        <td width="20%" align="center" valign="middle" bgcolor="#E0E0E0"><?=$this->lang->line('Company Section Ticket Label Pdf Ticket Date')?></td>
        <td width="14%" align="center" valign="middle" bgcolor="#E0E0E0"><?=$this->lang->line('Company Section Ticket Label Pdf Ticket Client ID')?></td>
    </tr>
<?php foreach($tickets as $key=>$ticket) { ?>
    <tr>
        <td align="center" valign="middle" bgcolor="#FFF"><?=$ticket['ticket']?></td>
        <td align="center" valign="middle" bgcolor="#FFF"></td>
        <td align="center" valign="middle" bgcolor="#FFF"></td>
        <td align="center" valign="middle" bgcolor="#FFF"></td>
        <td align="center" valign="middle" bgcolor="#FFF"></td>				  
    </tr>
<?php } ?>
</table>