<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auxiliares_libro_diario_c extends CI_Controller {
	
	function __Construct(){ 
	   parent::__construct();
	   $this->load->model('sirco/Auxiliares_libro_diario_m','detalle',TRUE);
	   $this->load->model('sirco/empresa_m','emp',TRUE);
	   $this->load->helper(array('siamenu','dompdf'));
	}
	
	//Inicio reporte_diario
	function reporte_diario($fch1,$fch2,$cta1,$cta2,$tipimp,$sede,$tipcon,$tipo_informe){
		$sede= explode("-",urldecode($sede));
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		if($cta1 == 'n') {$cta1='0';}
		if($cta2 == 'n') {$cta2='9999999999';}
		$cabecera = $this->emp->cabecera_empresa();
		$cuerpo='';
		$cuerpo .='<table width="100%" cellpadding="0" cellspacing="0">
						<thead> 
							<tr>	
								<td colspan="8" class="titulo">'.$cabecera['nomcia'].'</td>
							</tr>';	if($cabecera['nitcia'] == '890481264-1' or  $cabecera['nitcia'] == '823004609-9'){
				$cuerpo .='<tr>	
								<td colspan="8" class="letra">Vigilado MinEducacion</td>
							</tr>';  }
				$cuerpo .='<tr>	
							   <td colspan="8" class="letra">'.$cabecera['dircia'].'</td>
							</tr>	
							<tr>	
							  <td colspan="8" class="letra">Tels: '.$cabecera['telcia'].'</td>
							</tr>	
							<tr>	
							  <td colspan="8" class="lineainferior">Nit: '.$cabecera['nitcia'].'</td>
						    </tr>
							<tr class="libro">
								<td colspan="8" align="right">';
				if($tipcon == 'Local'){		
				$cuerpo .='LIBRO DE REGISTRO DIARIO PCGA DESDE '.$fch1.' HASTA '.$fch2;}else{
				$cuerpo .='LIBRO DE REGISTRO DIARIO NIIF DESDE '.$fch1.' HASTA '.$fch2;}
				$cuerpo .='</td>
							
				 </thead>
				<tbody>';		
		$doc_cont = $this->detalle->doc_registro_diario($fch1,$fch2,$cta1,$cta2,$codsed,$tipcon);
		if($doc_cont!=false){
			$totaldebito=0; $totalcredito=0;
			foreach($doc_cont as $row3){
			$cuerpo .='</tr>
				     	 <tr class="doslineastr">
				 			 <td width="14%">Fte-Nro-Fecha</td>
				 		     <td width="7%">Cuenta</td>
				 		     <td width="5%">Auxiliar</td>
				 		     <td width="5%" align="center">C.Cost</td>
				 			 <td width="10%">Nit o C.C</td>
				 		     <td width="39%">Descripci&oacute;n de Transaci&oacute;n</td>
				 			 <td width="10%" align="right">Mov. Débito</td>
				 			 <td width="10%" align="right">Mov. Crédito</td>
				 		</tr>';
				$nrocmp = $this->detalle->nrocmp_registro_diario($fch1,$fch2,$cta1,$cta2,$row3['coddoc'],$codsed,$tipcon);
				$acumuladodebito=0; $acumuladocredito=0;
				foreach($nrocmp as $row2){
					$res = $this->detalle->detalle_reg_diario($fch1,$fch2,$cta1,$cta2,$row3['coddoc'],$row2['nrocmp'],$codsed,$tipcon);
					$debito = 0; $credito = 0; 
					foreach($res as $row){
						$debito = $debito + intval($row['debdcm']);
						$credito = $credito + intval($row['credcm']);
						
						$acumuladodebito = $acumuladodebito + $row['debdcm'];
						$acumuladocredito = $acumuladocredito + $row['credcm'];
						$detalle = $row['detdcm'].'(CC: '.$row['codcts'].')';
						$totaldebito = $totaldebito + $row['debdcm'];
						$totalcredito = $totalcredito + $row['credcm'];
						$cuerpo .='<tr>
						         	<td class="numero">'.$row3['coddoc'].'-'.$row['nrocmp'].'-'.str_replace("/", ".", $row['fchcmp']).'</td>
						            <td class="numero">'.$row['codcta'].'</td>
						        	<td class="numero">'.$row['codaux'].'</td>
						            <td class="numero" align="center">'.$row['codcts'].'</td>
						        	<td class="numero">'.$row['codtrc'].'</td>
						        	<td class="letra">'.substr(encodeUtf8($detalle),0,46).'</td>
					            	<td class="numero" align="right">'.number_format($row['debdcm'],2).'</td>
						        	<td class="numero" align="right">'.number_format($row['credcm'],2).'</td>
						          </tr>';
					}
					
					    $cuerpo .='<tr class="lineafinal">
				               		<td>&nbsp;</td>
					          		<td>&nbsp;</td>
					         		<td>&nbsp;</td>
					        		<td>&nbsp;</td>
					        		<td>&nbsp;</td>
					        		<td class="letra">TOTAL COMPROBANTE: </td>
					           		<td class="numero" align="right">'.number_format($debito,2).'</td>
					         		<td class="numero" align="right">'.number_format($credito,2).'</td>
					            </tr>
								<tr height="12">
				               		<td></td>
					          		<td></td>
					         		<td></td>
					        		<td></td>
					        		<td></td>
					        		<td></td>
					           		<td></td>
					         		<td></td>
					            </tr>';					
				}
				//AQUI COLOCA ULTIMA LINEA
				$cuerpo .='<tr class="letra">
				           <td>&nbsp;</td>
				           <td>&nbsp;</td>
				           <td>&nbsp;</td>
				           <td>&nbsp;</td>
				           <td>&nbsp;</td>
				           <td>TOTAL FUENTE: '.$row3['coddoc'].'</td>
				           <td align="right" class="numero"><b>'.number_format($acumuladodebito,2).'</b></td> 
				           <td align="right" class="numero"><b>'.number_format($acumuladocredito,2).'</b></td> 
				           </tr>';
			}
				$cuerpo .='
				     	   </tbody>
				 	   	   </table>
						   <br>
				           <div class="detalle">
				           <table width="100%" >
				           <tr>
				           <td colspan="5" width="46%">&nbsp;</td>
				           <td width="34%" align="right" class="letrafinal"><b>TOTAL GENERAL:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
				           <td width="10%" align="right" class="numero"><b>'.number_format($totaldebito).'</b></td>
				           <td width="10%" align="right" class="numero"><b>'.number_format($totalcredito).'</b></td>
				           </tr>
				           </table>
				           </div>';			
				$data['detalle'] = $cuerpo;
				$data['tipimp']=$tipimp;
				if($tipo_informe == 'web'){$this->load->view('/sirco/auxiliares/libro_diario_web_v',$data);}
				elseif($tipo_informe == 'pdf'){
				$html = $this->load->view('/sirco/auxiliares/pdf_estado_f_v',$data, TRUE);
				 crearPdf($html,'libro_registro_diario.pdf');
				}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/auxiliares/libro_diario_excel_v',$data);}
			
		}else{
			echo "No se encontro informaci&oacute;n";	
		}
	}
	
	//Fin reporte_diario	
	function reporte_diario_fuente($fecha1,$fecha2,$codcta1,$codcta2,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipimp,$sede,$tipcon,$tipo_informe){
		$sede= explode("-",urldecode($sede));
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		$cabecera = $this->emp->cabecera_empresa();
		$cuerpo='';	
				$cuerpo .='<table cellpadding="0" cellspacing="0" class="tabla">';
				$cuerpo .='	<thead> 
							<tr>	
								<td colspan="8" class="titulo">'.$cabecera['nomcia'].'</td>
							</tr>';	
							if($cabecera['nitcia'] == '890481264-1' or  $cabecera['nitcia'] == '823004609-9'){
				$cuerpo .='<tr>	
								<td colspan="8" class="letra">Vigilado MinEducacion</td>
							</tr>';
								  }
				$cuerpo .='<tr>	
							   <td colspan="8" class="letra">'.$cabecera['dircia'].'</td>
							</tr>	
							<tr>	
							  <td colspan="8" class="letra">Tels: '.$cabecera['telcia'].'</td>
							</tr>	
							<tr>	
							  <td colspan="8" class="lineainferior">Nit: '.$cabecera['nitcia'].'</td>
						    </tr>
							<tr class="libro"><td colspan="8">';
								if($tipcon == 'Local'){		
				$cuerpo .='LIBRO DE REGISTRO DIARIO PCGA DESDE '.$fecha1.' HASTA '.$fecha2;}else{
				$cuerpo .='LIBRO DE REGISTRO DIARIO NIIF DESDE '.$fecha1.' HASTA '.$fecha2;}
							$cuerpo .='</td></tr>
							<tr class="libro">
								<td colspan="8"> RESUMEN POR FUENTES</td>
							</tr>
				    		<tr class="doslineastr">
			            			<td width="10%">FUENTE</td>
				        			<td width="50%">DESCRIPCION DE LA FUENTE</td>
				            		<td width="20%">SUMATORIA DEBITO</td>
				            		<td width="20%">SUMATORIA CREDITO</td>
				        		</tr>
				            </thead>
				          <tbody>';
						  
		$doc_cont = $this->detalle->reporte_diario_fuente($fecha1,$fecha2,$codcta1,$codcta2,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$codsed,$tipcon,$tipo_informe);
		if($doc_cont!=false){
			$totaldebito=0; $totalcredito=0;
			foreach($doc_cont as $row){
			$totaldebito = $totaldebito + $row['debdcm'];
			$totalcredito = $totalcredito + $row['credcm'];	
						$cuerpo .='<tr class="letra">
						            <td class="numero">'.$row['coddoc'].'</td>
						            <td>'.substr(encodeUtf8($row['nomdoc']),0,70).'</td>
						        	<td class="numero">$ '.number_format($row['debdcm'],2).'</td>
						         	<td class="numero">$ '.number_format($row['credcm'],2).'</td>
						          </tr>';
			}
				$cuerpo .='<tr>
				          	 <td colspan="3">&nbsp;</td>
				           </tr>
						   <tr class="lineafinal">
				          	 <td width="10%">&nbsp;</td>
				          	 <td width="50%" align="right"><strong>TOTAL GENERAL:</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
				         	  <td width="20%" class="numero"><strong>$ '.number_format($totaldebito,2).'</strong></td>
				         	  <td width="20%" class="numero"><strong>$ '.number_format($totalcredito,2).'</strong></td>
				           </tr>
						 </tbody>
				      </table>';
				
			$data['detalle'] = $cuerpo;
			$data['tipimp']=$tipimp;
			if($tipo_informe == 'web'){$this->load->view('/sirco/auxiliares/libro_diario_res_web_v',$data);}
				elseif($tipo_informe == 'pdf'){
				$html = $this->load->view('/sirco/auxiliares/libro_diario_res_pdf_v',$data, TRUE);
				 crearPdf($html,$nombInform.'.pdf');
				}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/auxiliares/libro_diario_res_excel_v',$data);}		
			}else{
			echo "No se encontro informaci&oacute;n";	
		}	
	}
	//Fin reporte diario por fuente
		//Fin reporte_diario	
	function reporte_diario_fuente_cta($fecha1,$fecha2,$codcta1,$codcta2,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipimp,$sede,$tipcon,$tipo_informe){
		$sede= explode("-",urldecode($sede));
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		$cabecera = $this->emp->cabecera_empresa();
		
		$doc_cont = $this->detalle->reporte_diario_fuente($fecha1,$fecha2,$codcta1,$codcta2,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$codsed,$tipcon);
		if($doc_cont!=false){
			$totaldebito=0; $totalcredito=0;
			$cuerpo='';	
			$cuerpo .='<table width="100%" cellpadding="0" cellspacing="0" class="tabla">
					  <thead> 
							<tr>	
								<td colspan="8" class="titulo">'.$cabecera['nomcia'].'</td>
							</tr>';	if($cabecera['nitcia'] == '890481264-1' or  $cabecera['nitcia'] == '823004609-9'){
							$cuerpo .='<tr><td colspan="8" class="letra">Vigilado MinEducacion</td></tr>';}
				$cuerpo .='<tr>	
							   <td colspan="8" class="letra">'.$cabecera['dircia'].'</td>
							</tr>	
							<tr>	
							  <td colspan="8" class="letra">Tels: '.$cabecera['telcia'].'</td>
							</tr>	
							<tr>	
							  <td colspan="8" class="lineainferior">Nit: '.$cabecera['nitcia'].'</td>
						    </tr>
							<tr class="libro">
								<td colspan="8">';
								if($tipcon == 'Local'){		
				$cuerpo .='LIBRO DE REGISTRO DIARIO PCGA DESDE '.$fecha1.' HASTA '.$fecha2;}else{
				$cuerpo .='LIBRO DE REGISTRO DIARIO NIIF DESDE '.$fecha1.' HASTA '.$fecha2;}
							$cuerpo .='</td>
							</tr>
							<tr class="libro">
							<td colspan="8">RESUMIDO POR FUENTES Y CUENTAS</td>>
							</tr> 
				    		<tr class="doslineastr">
				 			<td width="10%">FUENTE</td>
				 			<td width="50%">DESCRIPCION DE LA FUENTE</td>
				 			<td width="20%">SUMATORIA DEBITO</td>
				 			<td width="20%">SUMATORIA CREDITO</td>
				 		</tr>
					</thead>
			<tbody>';
			foreach($doc_cont as $row){
			$totaldebito = $totaldebito + $row['debdcm'];
			$totalcredito = $totalcredito + $row['credcm'];	
						
				$cuerpo .='<tr>
				            <td class="numero">'.$row['coddoc'].'</td>
				            <td class="letra">'.substr(encodeUtf8($row['nomdoc']),0,70).'</td>
				 <td></td>
				      <td></td>
				        </tr>';
				$det_doc = $this->detalle->reporte_diario_fuente_cta($fecha1,$fecha2,$codcta1,$codcta2,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$row['coddoc'],$codsed,$tipcon);
			    if($det_doc!=false){
					foreach($det_doc as $det){
				$cuerpo .='<tr>
				            <td class="numero">'.$det['codcta'].'</td>
				            <td class="letra">'.substr(encodeUtf8($det['nomcta']),0,70).'</td>
				            <td class="numero">'.number_format($det['debdcm'],2).'</td>
				        	<td class="numero">'.number_format($det['credcm'],2).'</td>
				          </tr>';	
					  }
					}
		        $cuerpo .='<tr class="lineafinal">
				        	<td></td>
				            <td class="letra"><b>RESUMEN '.substr(encodeUtf8($row['nomdoc']),0,70).'</b></td>
				        	<td class="numero"><b>'.number_format($row['debdcm'],2).'</b></td>
				        	<td class="numero"><b>'.number_format($row['credcm'],2).'</b></td>
				          </tr>';
						
			}
				$cuerpo .='<tr>
				           <td width="10%">&nbsp;</td>
				           <td width="50%" align="right"><b>TOTAL GENERAL:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
				           <td width="20%"><b>'.number_format($totaldebito,2).'</b></td>
				           <td width="20%"><b>'.number_format($totalcredito,2).'</b></td>
				           </tr>
				         </table>';
			$data['detalle'] = $cuerpo;
			$data['tipimp']=$tipimp;
			if($tipo_informe == 'web'){$this->load->view('/sirco/auxiliares/libro_diario_res_web_v',$data);}
				elseif($tipo_informe == 'pdf'){
				$html = $this->load->view('/sirco/auxiliares/libro_diario_res_pdf_v',$data, TRUE);
				 crearPdf($html,$nombInform.'.pdf');
				}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/auxiliares/libro_diario_res_excel_v',$data);}
						
			}else{
			echo "No se encontro informaci&oacute;n";	
		}	
	}
	//Fin reporte diario por fuente cuenta
	function documentos_contable($fecha1,$fecha2,$codcta1,$codcta2,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipimp,$sede,$tipcon,$tipo_informe){
		$sede= explode("-",urldecode($sede));
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		$cabecera = $this->emp->cabecera_empresa();
		$cuerpo='';	
			$cuerpo .='<table border="1" cellpadding="0" cellspacing="0" >
					  <thead> 
							<tr>	
								<td colspan="10"><b>'.$cabecera['nomcia'].'</b></td>
							</tr>';	
							if($cabecera['nitcia'] == '890481264-1' or  $cabecera['nitcia'] == '823004609-9'){
				$cuerpo .='<tr>	
								<td colspan="10"><b>Vigilado MinEducacion</b></td>
							</tr>';
								  }
				$cuerpo .='<tr>	
							   <td colspan="10"><b>'.$cabecera['dircia'].'</b></td>
							</tr>	
							<tr>	
							  <td colspan="10"><b>Tels: '.$cabecera['telcia'].'</b></td>
							</tr>	
							<tr>	
							  <td colspan="10"><b>Nit: '.$cabecera['nitcia'].'</b></td>
						    </tr>
							<tr>	
							  <td colspan="10"></td>
						    </tr>
							<tr>	
							  <td colspan="10"><b>';
								if($tipcon == 'Local'){		
				$cuerpo .='DOCUMENTOS CONTABLES PCGA DESDE '.$fecha1.' HASTA '.$fecha2;}else{
				$cuerpo .='DOCUMENTOS CONTABLES NIIF DESDE '.$fecha1.' HASTA '.$fecha2;}
							$cuerpo .='</b></td>
						    </tr>
							<tr>	
							  <td colspan="10"></td>
						    </tr>
							<tr>
							<td><b>DOCUMENTO</b></td>
							<td><b>FECHA</b></td>
							<td><b>DEBITO</b></td>
							<td><b>CREDITO</b></td>
							<td><b>NRO. EGRESO</b></td>
							<td><b>DETALLE</b></td>
							<td><b>CUENTA</b></td>
							<td><b>NOMBRE CUENTA</b></td>
							<td><b>COD. TERCERO</b></td>
							<td><b>NOMBRE TERCERO</b></td>
							</tr>
						   </thead>
						<tbody>';
		$doc_cont = $this->detalle->documentos_contable($fecha1,$fecha2,$codcta1,$codcta2,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$codsed,$tipcon);
		if($doc_cont!=false){
				foreach($doc_cont as $doc){
						$det_doc_cont = $this->detalle->detalle_documento_contable($doc['nrocmp'],$doc['coddoc'],$doc['codsed'],$doc['agncnt'],$doc['mescnt'],$tipcon);
						foreach($det_doc_cont as $det){
				$cuerpo .='<tr>
							<td>'.$doc['coddoc'].'-'.$doc['nrocmp'].'</td>
							<td>'.$det['fchcmp'].'</td>
							<td>'.round($det['debdcm'],0).'</td>
				        	<td>'.round($det['credcm'],0).'</td>
							<td>'.$det['nroegr'].'</td>
							<td>'.$det['detdcm'].'</td>
				            <td>'.$det['codcta'].'</td>
				            <td>'.utf8_encode($det['nomcta']).'</td>
							<td>'.$det['codtrc'].'</td>
							<td>'.utf8_encode($det['nomtrc']).'</td>
				          </tr>';	
					  	}	
					  }	
		        $cuerpo .='</tbody></table>';
				$data['detalle'] = $cuerpo;
				$data['tipimp']=$tipimp;
				
			if($tipo_informe == 'web'){$this->load->view('/sirco/auxiliares/documentos_contable_web_v',$data);}
				elseif($tipo_informe == 'pdf'){
				$html = $this->load->view('/sirco/auxiliares/documentos_contable_pdf_v',$data, TRUE);
				 crearPdf($html,$nombInform.'.pdf');
				}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/auxiliares/documentos_contable_excel_v',$data);}
					
			}else{
			echo "No se encontro informaci&oacute;n";	
		}		
	}
}