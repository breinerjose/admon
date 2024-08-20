<?php date_default_timezone_set("America/Bogota"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<style>
*{ margin:0; padding:0;}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family: Helvetica, Arial, Sans-Serif;
	letter-spacing: 6px;
}
.Estilo6{font-size: 10px;}
.txt{ font-size: 10px;}
.comenta{ font-size: 10px;}
.Estilo13 {  color: #000000;
    font-size: 11px;
}
.nomcia {  color: #000000;
    font-size: 13px;
}
.Estilo17 {font-size: 12px; COLOR: #000000; }
.Estilo18 {}
.Estilo20 { font-size: 10px; }

#cabecera{font-size: 14px;
    height: 25px;}
	
#tabladetalle,#tablapie, #tablacabecera{margin: 0 auto;}
#tablapie{margin-bottom: 15px;}
#cabecera td {
    border-bottom: 1px solid #000;
}
</style>
<link rel="stylesheet" type="text/css" href="/res/jquery/ui/js/jquery-ui-1.9.2.custom.js"/>
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script>
$(document).ready(function(e) {
  
  $('#imprimir').click(function(e){
	oculto.style.visibility = 'hidden'; 
window.print();   
window.close();
});
   
});
</script>
</head>
<body>
<div id="oculto">
 <button id="imprimir"><img src="/res/icons/sirco/print-icon.png" width="16"> Imprimir</button> 
</div>
<table border="0" align="center" cellpadding="0" cellspacing="4" width="100%">
  
  <tr>
    <td height="5"><hr><table width="100%"  border="0" cellpadding="0" cellspacing="7">
  <tr>
    <td colspan="4"><table width="100%" id="tablacabecera" height="100" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="61%" height="10"><div align="left"><span class="nomcia"><?php echo $cabecera['nomcia']; ?></span></div></td>
        <td width="42%"><div align="right" class="txt"><span class="fecha"><?php echo $cabecera_doc['nomdoc']; ?></span></div></td>
      </tr>
      
      <tr>
        <td height="18"><div align="left"><span class="Estilo6"><?php echo $cabecera['dircia']; ?></span></div></td>
        <td width="39%"><div align="right"><span class="txt">Nro. <?php echo $cabecera_doc['coddoc'] ?> - <?php echo $nrocmp; ?></span></div></td>
      </tr>
      <tr>
        <td height="18"><div align="left"><span class="Estilo6"><span class="Estilo18">TEL.</span> <?php echo $cabecera['telcia']; ?></span></div></td>
        <td width="48%"><div align="right" class="comenta"><?php //echo $cabecera_doc[0]['nomsed']; ?></div></td>
      </tr>
      <tr>
        <td height="18"><div align="left"><span class="Estilo6"><span class="Estilo18">NIT.</span> <?php echo $cabecera['nitcia']; ?></span></div></td>
        <td height="18"><div align="right" class="comenta"><?php echo $cabecera_doc['fchcmp']; ?></div></td>
      </tr>
    </table></td>
    </tr>
</table>
    </td>
  </tr>
  <tr>
    <td height="5"><hr><table width="100%" id="tabladetalle" height="100%" align="center" cellpadding="0" cellspacing="2" class="Estilo20">    
	   <tr id="cabecera">
        <td width="12%" class="xl24"><div>Cuentas</div></td>
        <td width="62%" class="xl24"><div>Detalle&nbsp;-&nbsp;Id&nbsp;-&nbsp;Nombre</div></td>
        <td width="13%" class="xl24"><div>&nbsp;&nbsp;&nbsp;D&eacute;bitos</div></td>
        <td width="13%" class="xl31"><div>&nbsp;&nbsp;&nbsp;Cr&eacute;ditos </div></td>
          <hr>
      </tr>
    
      
		<?php 
			if($detalle!=false){
				foreach($detalle as $row){
					echo '
						<tr>
							<td>'.$row['codcta'].' - '.$row['codnif'].'</td>
							<td>'.substr(encodeUtf8($row['detdcm']),0,50)." - ".substr(encodeUtf8(strtoupper($row['nomcta'])),0,100).'</td>
							<td>&nbsp;&nbsp;&nbsp;$'.number_format($row['debdcm'],2).'&nbsp;&nbsp;</td>
							<td>&nbsp;&nbsp;&nbsp;$'.number_format($row['credcm'],2).'&nbsp;&nbsp;</td>						
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>'.$row['codtrc']." - ".substr(encodeUtf8($row['nomtrc']),0,50).'</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>						
						</tr>
					';	
				}
			}else{
				echo'
					<tr>
						<td colspan="4">No se encontrarón datos</td>
					</tr>
				';	
			}
		?>
      <tr >
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  	  
          <tr >
            <td colspan="5" class="xl24"><hr></td>
          </tr>
        <tr >
            <td class="xl24">&nbsp;</td>
            <td align="right" class="xl24">Pcga</td>
            <td class="Estilo17">&nbsp;&nbsp;&nbsp;<?php echo '$'.$sumdebito; ?></td>
            <td class="Estilo17">&nbsp;&nbsp;&nbsp;<?php echo '$'.$sumcredito; ?></td>
        </tr>
        <tr >
        <td class="xl24">&nbsp;</td>
        <td align="right" class="xl24">Niif</td>
        <td class="Estilo17"> &nbsp;&nbsp;&nbsp;<?php echo '$'.$sumdebiton; ?>  </td>
        <td class="Estilo17">&nbsp;&nbsp;&nbsp;<?php echo '$'.$sumcrediton; ?> </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
     <td height="5">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tablapie">
      <tr>
        <td class="fecha">&nbsp;</td>
        <td class="fecha">&nbsp;</td>
      </tr>
      <tr>
        <td width="445" class="Estilo13">Aprobado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</td>
        <td width="445" class="Estilo13"><div align="left">&nbsp;&nbsp;&nbsp;Recibido&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</div></td>
      </tr>
      <tr>
        <td class="Estilo13">&nbsp;</td>
        <td class="Estilo13">&nbsp;</td>
      </tr>
      <tr>
        <td class="Estilo13">Elaborado por:<?php echo $cabecera_doc['nomtrc']; ?></td>
  <td class="fecha"><div align="center" class="comenta">
                <div align="left">&nbsp;&nbsp;C.C. / NIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</div>
            </div></td>
      </tr>
      <tr>
        <td colspan="2" class="Estilo13"></td>
        </tr>
    </table>
    <hr>
    </td></tr>
</table>
</body>
</html>