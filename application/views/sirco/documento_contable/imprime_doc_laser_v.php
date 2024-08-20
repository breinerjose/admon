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
<script type="text/javascript" src="/res/js/jquery.js"></script>
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
        <td width="61%" height="10"><div align="left"><span class="nomcia"><span class="Estilo20">NIT. <?php echo $cabecera['nitcia']; ?></span><?php echo " ".$cabecera['nomcia']; ?></span></div></td>
        <td width="48%"><div align="right" class="txt"><span class="fecha"><?php echo $cabecera_doc['nomdoc']; ?></span></div></td>
      </tr>
      
      <tr>
        <td height="18"><div align="left"><span class="Estilo6"><?php echo $cabecera['dircia']; ?></span></div></td>
        <td width="48%"><div align="right"><span class="txt">Nro. <?php echo $cabecera_doc['coddoc'] ?> - <?php echo $nrocmp; ?></span></div></td>
      </tr>
      <tr>
        <td height="18"><div align="left"><span class="Estilo6"><span class="Estilo18">TEL.</span> <?php echo $cabecera['telcia']; ?></span></div></td>
        <td width="48%"><div align="right" class="comenta"><?php echo $cabecera_doc['fchcmp']; //echo $cabecera_doc[0]['nomsed']; ?></div></td>
      </tr>
      <tr>
        <td height="18" colspan="2"><div align="right" class="comenta">
          <div align="left"><?php echo 'Alumno: '.$observ['codalm'].' '.$observ['nomalm'].' '.$observ['grado'].' '.$observ['grupo']; ?>
          </div></div></td>
        </tr>
		<?php if($cabecera_doc['coddoc'] == '06'){ 
			if($rowb['agncnt'] > 2022){ 
			$m1='Enero'; $m2='Febrero'; $m3='Marzo'; $m4='Abril'; $m5='Mayo'; $m6='Junio'; $m7='Julio'; $m8='Agosto'; $m9='Septiembre'; $m10='Octubre'; }else{
	        $m1='Febrero'; $m2='Marzo'; $m3='Abril'; $m4='Mayo'; $m5='Junio'; $m6='Julio'; $m7='Agosto'; $m8='Septiembre'; $m9='Octubre'; $m10='Noviembre'; }
		?>
		 <tr>
        <td height="18" colspan="2">
         <table width="100%" border="1" cellpadding="0" cellspacing="0">
  	<tr>
  	  <td colspan="16" align="center" class="comenta">SALDO A CORTE <?php echo date('Y-m-d h:i:s'); ?></td>
  	  </tr>
  	<tr class="comenta">
    <td>Periodo</td>
    <td>Grado</td>
    <td>Grupo</td>
    <td>Matricula</td>
    <td><?php echo $m1; ?></td>
    <td><?php echo $m2; ?></td>
    <td><?php echo $m3; ?></td>
    <td><?php echo $m4; ?></td>
    <td><?php echo $m5; ?></td>
    <td><?php echo $m6; ?></td>
    <td><?php echo $m7; ?></td>
    <td><?php echo $m8; ?></td>
    <td><?php echo $m9; ?></td>
    <td><?php echo $m10; ?></td>
    <td>T. Mens</td>
    <td>Total</td>
  </tr>
  <?php 
  $tabla ='<tr class="comenta">
				<td>'.$rowb['agncnt'].'</td>
				<td>'.$rowb['grado'].'</td>
				<td>'.$rowb['grupo'].'</td>
				<td>'.round($rowb['sld01'],2).'</td>
				<td>'.round($rowb['sld02'],2).'</td>
				<td>'.round($rowb['sld03'],2).'</td>
				<td>'.round($rowb['sld04'],2).'</td>
				<td>'.round($rowb['sld05'],2).'</td>
				<td>'.round($rowb['sld06'],2).'</td>
				<td>'.round($rowb['sld07'],2).'</td>
				<td>'.round($rowb['sld08'],2).'</td>
				<td>'.round($rowb['sld09'],2).'</td>
				<td>'.round($rowb['sld10'],2).'</td>
				<td>'.round($rowb['sld11'],2).'</td>
				<td>'.round(($rowb['totsld']-$rowb['sld01']),2).'</td>
				<td>'.round($rowb['totsld'],2).'</td>
			  </tr>';
		echo $tabla;	  
  ?>
  <tr>
  	  <td colspan="16" align="center" class="comenta">PAGOS A CORTE <?php echo date('Y-m-d h:i:s'); ?></td>
  	  </tr>
	  <?php 
  $tabla ='<tr class="comenta">
				<td>'.$rowb['agncnt'].'</td>
				<td>'.$rowb['grado'].'</td>
				<td>'.$rowb['grupo'].'</td>
				<td>'.round($rowb['pag01'],2).'</td>
				<td>'.round($rowb['pag02'],2).'</td>
				<td>'.round($rowb['pag03'],2).'</td>
				<td>'.round($rowb['pag04'],2).'</td>
				<td>'.round($rowb['pag05'],2).'</td>
				<td>'.round($rowb['pag06'],2).'</td>
				<td>'.round($rowb['pag07'],2).'</td>
				<td>'.round($rowb['pag08'],2).'</td>
				<td>'.round($rowb['pag09'],2).'</td>
				<td>'.round($rowb['pag10'],2).'</td>
				<td>'.round($rowb['pag11'],2).'</td>
				<td>'.round(($rowb['totpag']-$rowb['pag01']),2).'</td>
				<td>'.round($rowb['totpag'],2).'</td>
			  </tr>';
		echo $tabla;	  
  ?> 
	  
  </table>
		  </td>
        </tr>
		<?php } ?>
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
							<td>'.substr(encodeUtf8(strtoupper($row['nomcta'])),0,100).$row['codtrc']." - ".substr(encodeUtf8($row['nomtrc']),0,50).'</td>
							<td>&nbsp;&nbsp;&nbsp;$'.number_format($row['debdcm'],2).'&nbsp;&nbsp;</td>
							<td>&nbsp;&nbsp;&nbsp;$'.number_format($row['credcm'],2).'&nbsp;&nbsp;</td>						
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