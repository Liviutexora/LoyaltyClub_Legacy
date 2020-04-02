<table width="100%" align="left" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td>
            <?php foreach($tickets as $key=>$ticket){ ?>
                <br/><br/>
                <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td align="center" width="100%" valign="bottom" colspan="4" height="78">
                            <img src="<?=site_url("/assets/img/cards/tichet_header.jpg")?>" width="300" height="80">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" width="10.5%" height="85">
                            <img src="<?=site_url("/assets/img/cards/lateral_stanga.jpg")?>" width="10" height="85">
                        </td>
                        <td align="left" valign="middle" width="60%" height="85">
                            <?=$this->lang->line("Company Section Ticket Label Pdf Ticket Company")?> : <?=$this->session->userdata('user')['nume']?><br>
                            <?=$this->lang->line("Company Section Ticket Label Pdf Ticket Serial")?>:  <?=$ticket['ticket']?><br>
                            <?=$this->lang->line("Company Section Ticket Label Pdf Ticket Value")?> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$this->config->item("currency")?><br>
                            <?=$this->lang->line("Company Section Ticket Label Pdf Ticket Discount")?> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; %<br>
                            <?=$this->lang->line("Company Section Ticket Label Pdf Ticket Date of issue")?> : <?=date('d.m.Y')?>
                        </td>
                        <td align="left" valign="bottom" width="19%" height="80">
                            <img src="<?=site_url("/assets/img/cards/tichet_stampila.jpg")?>" width="80" height="80">
                        </td>
                        <td align="left" valign="middle" width="10.5%" height="85">
                            <img src="<?=site_url("/assets/img/cards/lateral_dreapta.jpg")?>" width="10" height="85">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="4" width="100%" valign="top">
                            <img src="<?=site_url("/assets/img/cards/tichet_footer.jpg")?>" width="300" height="15">
                        </td>
                    </tr>
                </table><br/><br/><br/>
                <?php if(($key+1)%2!=0) echo '</td><td>'; ?>
                <?php if(($key+1)%2==0) echo '</td></tr><tr><td>'; ?>
            <?php } ?>
        </td>
	</tr>
</table>