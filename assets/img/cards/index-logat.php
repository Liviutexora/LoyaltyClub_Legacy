<?php require_once('zframework.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fidelizat.ro</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F4F4F4;
}
-->
</style>
<link href="<?=currentdir()?>admin/css/data.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="<?=currentdir()?>admin/framework/js/scripts.js"></script>
<link href="css/frames.css" rel="stylesheet" type="text/css" />
<link href="css/linkuri.css" rel="stylesheet" type="text/css" />
<link href="css/txt.css" rel="stylesheet" type="text/css" />
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style></head>

<body onload="MM_preloadImages('design/detalii-2.png','design/detalii2.png')">
<div class="top-fundal">
  <table width="1147" border="0" align="center" cellpadding="0" cellspacing="0" class="logo-bt">
    <tr>
      <td width="351" height="77" align="center" valign="middle">&nbsp;</td>
      <td colspan="2" align="center" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="83" align="center" valign="middle">&nbsp;</td>
      <td width="740" align="center" valign="middle"><table width="678" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="126" height="43" align="left" valign="middle"><a href="prezentare.php" class="link-bt">Prezentare <br />
            <span class="link2">AFACERE</span></a></td>
          <td width="148" align="left" valign="middle"><a href="regulament.php" class="link-bt">Regulament<br />
            <span class="link2">FIDELIZAT</span></a></td>
          <td width="132" align="left" valign="middle"><a href="lista-firme.php" class="link-bt">Lista firme<br />
            <span class="link2">FIDELIZAT</span></a></td>
          <td width="164" align="left" valign="middle"><a href="plan-marketing.php" class="link-bt">Plan marketing<br />
            <span class="link2">FIDELIZAT</span></a></td>
          <td width="108" align="left" valign="middle" class="link-bt-login"><a href="cont-nou.php" class="link-bt-login">Cont nou</a><br /></td>
        </tr>
      </table></td>
      <td width="56" align="center" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="73" align="center" valign="middle">&nbsp;</td>
      <td colspan="2" align="center" valign="middle">&nbsp;</td>
    </tr>
  </table>
</div>
<div>
	<table width="180" height="50" border="0" align="center" cellpadding="0" cellspacing="3">
	  <tr>
		<td>
		<?php
			echo receiveMsg();	
		?>
	  </td>
	 </tr>
	</table>
  <table width="1145" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="702" height="500" align="center" valign="top"><table width="684" border="0" align="center" cellpadding="0" cellspacing="0" class="cadru-introducere">
        <tr>
          <td width="18" height="325" align="center" valign="top"><br /></td>
          <td width="455" align="center" valign="top"><br />
            <table width="446" border="0" align="center" cellpadding="1" cellspacing="1" class="linie-portocalie">
              <tr>
                <td width="438" height="26" class="txt-titlu">INTRODUCERE</td>
              </tr>
            </table>
            <table width="446" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td width="438" height="256" align="left" valign="top" class="txt-introducere">Afacerea <em>Fidelizat</em> se adreseaza in special oamenilor cu venituri mici si medii, deoarece aceasta afacere a fost gindita astfel incit fiecare cumparator sa poata obtine un venit suplimentar din reducerile pe care compania noastra le-a negociat cu unii comercianti. <br />
                  <br />
                  Precizam inca de la inceput ca sumele de bani care sunt cistigate in aceasta afacere reprezinta venituri legale si prin urmare se supun legilor de impozitare ale statului, iar daca unora li se vor parea foarte mari si irealizabile (parind de fapt o afacere fantoma cum suntem odisnuiti sa vedem mai mereu in jurul nostru), va vom oferi in cele ce urmeaza citeva informatii care sa va lamureasca cu privire la mecanismul ingenios pe care compania noastra la dezvoltat (atentie! nu l-a inventat, el fiind comun multor afaceri, ci la preluat, la adaptat si l-a imbunatatit )  asa in cit fiecare participant la comunitatea <em>Fidelizat </em>sa iasa numai in cistig.<br />
                  Iata de unde vin banii in aceasta afacere:</td>
              </tr>
            </table></td>
          <td width="211" align="center" valign="middle"><br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <table width="196" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="196" align="right" valign="middle"><a href="prezentare.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','design/detalii-2.png',1)"><img src="design/detalii-1.png" alt="fidelizeaza-te" name="Image1" width="122" height="45" border="0" id="Image1" /></a></td>
              </tr>
            </table></td>
        </tr>
      </table>
        <table width="684" border="0" align="center" cellpadding="0" cellspacing="0" class="cadru-firme">
          <tr>
            <td height="68" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="166" align="center" valign="top"><table width="658" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="648" height="120" align="center" valign="middle"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="656" height="77">
                  <param name="movie" value="design/slide.swf" />
                  <param name="quality" value="high" />
                  <param name="wmode" value="opaque" />
                  <param name="swfversion" value="6.0.65.0" />
                  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                  <param name="expressinstall" value="Scripts/expressInstall.swf" />
                  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                  <!--[if !IE]>-->
                  <object type="application/x-shockwave-flash" data="design/slide.swf" width="656" height="77">
                    <!--<![endif]-->
                    <param name="quality" value="high" />
                    <param name="wmode" value="opaque" />
                    <param name="swfversion" value="6.0.65.0" />
                    <param name="expressinstall" value="Scripts/expressInstall.swf" />
                    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                    <div>
                      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
                    </div>
                    <!--[if !IE]>-->
                  </object>
                  <!--<![endif]-->
                </object></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      <td width="443" align="center" valign="top">
	<form action="" method="post">  
	  <table width="424" border="0" align="center" cellpadding="0" cellspacing="0" class="cadru-logout">
        <tr>
          <td width="124" height="275" align="left" valign="middle">&nbsp;</td>
          <td width="300" align="left" valign="top"><br />
            <br />
            <br />
            <table width="244" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td width="76" align="right" valign="middle" class="txt-parola">Esti logat</td>
                <td width="154" align="left" valign="middle" class="txt-parola"><strong>nume utilizator </strong></td>
              </tr>
              <tr>
                <td height="38" colspan="2" align="center" valign="middle"><a href="#" class="detalii">Deconectare</a></td>
              </tr>
              <tr>
                <td height="28" colspan="2" align="center" valign="middle">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table>
	</form>  
        <table width="433" border="0" align="center" cellpadding="0" cellspacing="0" class="intrebari">
          <tr>
            <td width="433" height="171">&nbsp;</td>
          </tr>
          <tr>
            <td height="120" valign="top"><table width="392" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr>
                <td width="392" class="txt-cd-intrebari">Ai o intrebare, sau o nelamurire ? vrei sa afli detalii legate de sistemul fidelizat, sau opinia altor clienti.  Atunci te rugam sa dai click mai departe</td>
              </tr>
              <tr>
                <td align="right" valign="middle"><a href="intrebari-frecvente.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','design/detalii2.png',1)"><img src="design/detalii1.png" name="Image3" width="119" height="40" border="0" id="Image3" /></a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <br />
</div>
<div class="footer">
  <table width="1145" border="00" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="166" height="100" align="center" valign="middle"><span class="autor">Copyright 2013 Fidelizat.ro</span><br />
        <a href="termeni-si-conditii.php"><br />
        <span class="termeni-conditii">Termeni si conditii</span></a></td>
      <td width="772" align="center" valign="middle"><a href="prezentare.php" class="link-footer">Prezentare</a> <a href="regulament.php" class="link-footer">Regulament</a> <a href="lista-firme.php" class="link-footer">Lista firme</a> <a href="plan-marketing.php" class="link-footer">Plan marketing</a> <a href="cont-nou.php" class="link-footer">Cont nou</a></td>
      <td width="207" align="center" valign="middle"><table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="106" align="center" valign="middle" class="autor">Site realizat de</td>
          <td width="94" align="center" valign="middle"><a href="http://www.asdesign.ro" target="_blank"><img src="design/as design multimedia2.jpg" alt="web design timisoara" width="90" height="30" border="0" /></a></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
<div></div>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
</body>
</html>