<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reporte Anexo de Balance</title>
<style>
*{margin:0; padding:0; }
body{ font-size:14px; font-family:Arial, Helvetica, sans-serif; }
#tabla1{ margin-top:5px; margin-left:5px; }
.fieldset{ padding:5px;}
.fieldset2{margin-bottom: 10px; margin-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px;}
.fieldset3{}
.fecha{ float:right; padding-right:10px; }
#tabla2 thead tr td{ font-size: 13px; font-weight: bold;  padding-bottom: 10px;}
#tabla2 tbody tr td{ font-size: 12px; padding-bottom: 4px; padding-top: 4px; font-weight:bold; }
#tabla3{  font-size: 12px;
    font-weight: bold;
    margin: 0 auto;
    text-align: center;}
#tabla3 tbody tr td{ padding-bottom: 4px; padding-top: 4px; }
.total{border-top: 2px solid #b0b0b0; font-weight: bold;}
.linea{ border-top: 1px dashed #848484;}
</style>
</head>
<body>


<table width="900" id="tabla1" cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <td colspan="6">
			<fieldset class="fieldset">
                <table width="100%"  cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="font-size:16px; font-weight:bold;" align="center"><?php echo strtoupper($cabecera[0]['nomcia']); ?></td>
                  </tr>
                  <tr>
                    <td align="center"><b>BALANCE GENERAL</b></td>
                  </tr>
                  <tr>
                    <td align="center"><b><?php echo strtoupper($nomMes." DE ".$anio); ?></b></td>
                  </tr>
                  <tr>
                    <td align="center"><b><?php echo strtoupper($nombre_sede_reporte); ?></b></td>
                  </tr>
            	</table>
			</fieldset>
        </td>
      </tr>
  	</thead>
    <tbody>
   	  <tr>
        <td colspan="6">
        <fieldset class="fieldset2">
            <table width="100%" id="tabla2"  cellpadding="0" cellspacing="0">
                <tbody>
				  <?php 
                    if(count($datos) == count($datos2)){
						echo "<tr>
								<td width='100'>&nbsp;</td>
								<td width='350'>&nbsp;</td>
								<td width='150' align='center'>&nbsp;</td>
								<td width='150' align='center'>".$nomMes." ".$anio."</td>
								<td width='150' align='center'>".$nomMes2." ".$anio2."</td>
								<td width='150' align='center'>Variaci&oacute;n</td>
								<td width='150' align='center'>%</td>
						  </tr>";	
						
						for($i=0; $i<count($datos)-1; $i++){
							$porcentaje = 0;
							
							if(strlen($datos[$i][0])==1){
								$tr1 = $datos[$i][4];
								$tr2 = 	$datos2[$i][4];
							}else{
								$tr1 = $datos[$i][2];
								$tr2 = 	$datos2[$i][2];
							}
							
							$variacion = ($tr1-$tr2);
							if($tr2!=0){
								$porcentaje = ($variacion/$tr2)*100;
							}else if(intval($tr1)==0 && intval($tr2)==0){
								$porcentaje = 0;	
							}else {
								$porcentaje = intval('100');	
							}
							
							echo "<tr>
										<td width='100'>".$datos[$i][0]."</td>
										<td width='350'>".$datos[$i][1]."</td>
										<td width='150' align='center'>&nbsp;</td>
										<td width='150' align='center'>".$this->numletras->vmiles($tr1)."</td>
										<td width='150' align='center'>".$this->numletras->vmiles($tr2)."</td>
										<td width='150' align='center'>".$this->numletras->vmiles($variacion)."</td>
										<td width='150' align='center'>".round($porcentaje, 4)."</td>
								  </tr>";	
						}
						
						$porcentaje2=0;
							
						$variacion2 = $total1-$total2;
						if($total2!=0){
							$porcentaje2 = ($variacion2/$total2)*100;
						}else if($total1==0 && $total2==0){
							$porcentaje2 = 0;	
						}else if($total1==0 && $total2==0){
							$porcentaje2 = intval('100');	
						}
						
						echo "
							  <tr>
									<td colspan='7' align='center'>&nbsp;</td>
							  </tr>
							  <tr>
									<td colspan='3' align='center' class='linea'>TOTAL PASIVO Y PATRIMONIO</td>
									<td width='150' align='center' class='linea'>".$this->numletras->vmiles($total1)."</td>
									<td width='150' align='center' class='linea'>".$this->numletras->vmiles($total2)."</td>
									<td width='150' align='center' class='linea'>".$this->numletras->vmiles($variacion2)."</td>
									<td width='150' align='center' class='linea'>".round($porcentaje2, 1)."</td>
							  </tr>";							
					}else{
						echo "
							<tr>
								<td colspan='7'>Ocurrio un error, intente mas tarde, o pongase en contacto con el administrador.</td>
							</tr>
						";	
					}
                  ?>
              </tbody>
            </table>
        </fieldset>
        </td>
      </tr>
      <tr>
        <td colspan="7">
        <fieldset class="fieldset3">
            <table width="100%" id="tabla3" cellpadding="0" cellspacing="0">
                <tbody>
					<tr>
                    	<td width="33%">&nbsp;&nbsp;&nbsp;&nbsp;Representate Legal&nbsp;&nbsp;&nbsp;&nbsp;</td> 
                    	<td width="33%">&nbsp;&nbsp;&nbsp;&nbsp;Contador(a)&nbsp;&nbsp;&nbsp;&nbsp;</td> 
                    	<td width="33%">&nbsp;&nbsp;&nbsp;&nbsp;Revisor Fiscal&nbsp;&nbsp;&nbsp;&nbsp;</td>                    
                    </tr> 
					<tr>
                    	<td width="33%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> 
                    	<td width="33%">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($cabecera[0]['tpccia']);?>&nbsp;&nbsp;&nbsp;&nbsp;</td> 
                    	<td width="33%">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($cabecera[0]['tprcia']);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>                     
                    </tr>  
              	</tbody>
            </table>
        </fieldset>
        </td>
      </tr>
    </tbody>
  
</table>


</body>
</html>