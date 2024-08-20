<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	    set_time_limit(0);
	   ini_set("memory_limit", "999M");
	   ini_set("max_execution_time", "999");
class Estados_financieros_n_c extends CI_Controller {
	
	var $usuario;
	var $fecha;
	var $host;
	
	function __Construct(){
	   parent::__construct();
	   $this->load->helper(array('siamenu','dompdf'));
	   $this->load->model('sirco/estados_financieros_n_m','esta',TRUE);
	   $this->load->model('sirco/empresa_m','emp',TRUE);
	   $this->load->model('sirco/saldos_n_m','sld',TRUE);
	   $this->load->model('sirco/saldos_m','saldos',TRUE);
	   $this->load->model('sirco/Basico_m','bas',TRUE);
	   $this->usuario = $this->session->userdata('codigo');	
	   $this->fecha = date("Y-m-d h:i:s A");  
	   $this->host = $_SERVER['REMOTE_ADDR']; 
	   /*if($this->session->userdata('codigo') != ''){ 
			echo  "<script language=\"JavaScript\">   alert(\"SU SESION A CADUCA INGRESE NUEVAMENTE\") </script>";
  			echo  "<script language=\"JavaScript\"> window.location.href = \"http://sia.tecnar.edu.co/\" </script>";
   			exit(); } */  
	}
	
	function cargarVistaEstadoFinanciero(){
	  $this->load->view("sirco/estados_financieros/seleccionar_estado_fnif_v");

	}
	
	//Inicio 007
	//Balance General Bajo Niif
		function balance_niif($fecha,$tbalance,$nombInform,$tipo_informe){
		$cabecera = $this->emp->cabecera_empresa();
		$tr = '';
		
		$cuentas_detalle = $this->esta->cuentas_detalle_niif($tbalance,$fecha,$this->usuario);	
		for($tamanio='6';$tamanio > 0;){
		$cuentas_superior = $this->esta->cuentas_superior($tamanio,$tbalance,$this->usuario);
		if($cuentas_superior!=false){
			foreach($cuentas_superior as $cta){
			$datos = array("",$cta['codnif'],"General",$tbalance,$this->usuario);
			$agregar = $this->esta->inserta_niif($datos);	
			$suma = $this->esta->suma_niif($cta['codnif'],$tbalance,$this->usuario);
			$this->esta->actualizar_saldo_niff($suma['sldcta'],$cta['codnif'],$tbalance, $this->usuario);	
			}
		}
		if($tamanio == 2){$tamanio = $tamanio-1;}else{$tamanio=$tamanio-2;}
		}	
		
		//Inicio Informe
		$estructuraBalance = $this->esta->estructuraInformeNiif($tbalance,$this->usuario);
		foreach($estructuraBalance as $cta){
		if(substr($cta['codnif'],0,1) == 2 OR substr($cta['codnif'],0,1) == 3){$cta['sldcta'] = $cta['sldcta']*(-1);}	
		$saldocta = "$".number_format($cta['sldcta'],0,',','.');
		if(trim($cta['tpocta']) == 'General'){
		if($cta['codnif'] > 9){	
			$tr .= '<tr>
						<td  ><b>'.$cta['codnif'].'</b></td>
						<td><b>'.encodeUtf8($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.$saldocta.'</b></td>
						<td  align="right"></td>
					</tr>';
			}else{
				$tr .= '<tr>
						<td  ><b>'.$cta['codnif'].'</b></td>
						<td ><b>'.encodeUtf8($cta['nomnif']).'</b></td>
						<td  align="right"></td>
						<td  align="right"><b>'.$saldocta.'</b></td>
					</tr>';
				}		
							
		}else{
			$tr .= '<tr>
					          <td >'.$cta['codnif'].'</td>
							  <td>'.encodeUtf8($cta['nomnif']).'</td>
							  <td  align="right">'.$saldocta.'</td>
							  <td align="right"> </td>
							</tr>';		
			}
		}
		$suma = $this->esta->sumapasivopatrimonio($tbalance,$this->usuario);
		$tr .= '<tr>
		<td  colspan="5" align="center"><b>TOTAL PASIVO Y PATRIMONIO</b></td><td><b>$ '.number_format(($suma['sldcta']*-1),0,',','.').'</b></td></tr>';
		
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = urldecode($nombInform); // Nombre Infome
		$data['titInf1'] = strtoupper('A');	//Descripcion
		$data['inform'] = $tr; // Contenido
		$rep_legal = $this->emp->rep_legal();
		$contador = $this->emp->contadora();
		$rev_fiscal = $this->emp->rep_fiscal();
		$data['rep_legal'] = $rep_legal['nomper'];
		$data['contador'] = $contador['nomper'];
		$data['rev_fiscal'] = $rev_fiscal['nomper'];
		$data['tpcontador'] = $contador['tpccia'];
		$data['tprevfiscal'] = $rev_fiscal['tprcia'];			
			
		if($tipo_informe == 'web'){$this->load->view('/sirco/estados_financieros/web_estado_f_v',$data);}
		elseif($tipo_informe == 'pdf'){
		 $html = $this->load->view('/sirco/estados_financieros/pdf_estado_f_v',$data, TRUE);
		 crearPdf($html,$nombInform.'.pdf');
			}
		
		}
	//Fin 007
	
	//Inicio 008
	function imprimirReporte_compar($inicial,$anterior,$balance,$nombInform,$cero,$cuenta,$tipo_informe){
	$this->sld->anexo_cuentas($anterior,$inicial,'0008',$this->session->userdata('codigo'));
	
		$rep_legal = $this->emp->rep_legal();
		$contador = $this->emp->contadora();
		$rev_fiscal = $this->emp->rep_fiscal();
		
		$resp=$this->esta->consultarNivel1($balance);
		$opt ='<table cellpadding="0" cellspacing="0" border="0" width="100%"  class="cabe">
					<thead>
						<tr>
							<td width="55%"></td>
							<td align="right" width="15%"><b>'.$inicial.'</b></td>
							<td align="right" width="15%"><b>'.$anterior.'</b></td>
							<td align="right" width="15%"><b>VARIACIÓN</b></td>
						</tr></thead></table>';	
						
		if($resp!=false){
			$totalfinal1a=0;$totalfinal2a=0;$totalfinalvara=0;
			foreach($resp as $row){
				$totalfinal1=0;$totalfinal2=0;$totalfinalvar=0;
				if($row['codbaa'] == '0002'){$opt.='<br><br><br><br><br><br><br><br><br>
				 <table width="100%" cellpadding="1" cellspacing="0">
 <tr>
 						<td><b>'.utf8_encode($rep_legal['nomper']).'</b></td>
						 <td><b>'.utf8_encode($contador['nomper']).'</b></td>
						 <td><b>'.utf8_encode($rev_fiscal['nomper']).'</b></td>
						 </tr>
						 <tr>
						 <td>Representante Legal</td>
						 <td>Contador(a)</td>
						 <td>Revisor Fiscal</td>
						 </tr>
						 <tr>
						 <td></td>
						 <td>'.$contador['tpccia'].'</td>
						 <td>'.$rev_fiscal['tprcia'].'</td>
						</tr>
  </table> 
				
				<br><br><br>';
				$opt .='<table cellpadding="0" cellspacing="0" border="0" width="100%"  class="cabe">
				<tr>
						<td></td>
							<td width="55%"></td>
							<td align="right" width="15%"><b>'.$inicial.'</b></td>
							<td align="right" width="15%"><b>'.$anterior.'</b></td>
							<td align="right" width="15%"><b>VARIACIÓN</b></td>
						</tr>
						</table>';
				}
				$opt.='<p align="center"><b>'.encodeUtf8($row['nombaa']).'</b></p><hr>';
				$resp1=$this->esta->consultarNivel2nuevo($row['codbaa']);
				if($resp1!=false){					
					foreach($resp1 as $row1){
					$subtotal1=0;$subtotal2=0;$subtotalvar=0;
					
					$opt.='
					<br><table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="55%"><b>'.encodeUtf8($row1['nombab']).'</b></td>
							<td width="15%"></td>
							<td width="15%"></td>
							<td width="15%"></td>
						</tr></table>';	
					
				$resp2=$this->esta->consultarNivel3($row1['codbab']);
					if($resp2!=false){
						foreach($resp2 as $row2){
						if($row['codbaa'] != '0003'){$opt.='<p><b>'.encodeUtf8($row2['nombac']).'</b></p>';}	
						$resp3=$this->esta->consultarCuentasAsociadas($balance,$row['codbaa'],$row1['codbab'],$row2['codbac']);
						if($resp3!=false){
							$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody>';
							$total=0;$total2=0; $total_variacion=0;
							foreach($resp3 as $row3){						
								$opt.='<tr>';
								$condicion=array('codnif' => $row3['codnif'], 'fecini' => $anterior, 'fecfin' => $inicial, 'addusr' => $this->session->userdata('codigo'), 'codbal' => $balance);
								$sld=$this->bas->consultarf('codnif, sldcta, sldant ','cntisn',$condicion);
								$variacion=$sld['sldcta']-$sld['sldant'];
									 $opt.='
									 <td width="55%">'.encodeUtf8($row3['nomnif']).'</td>
									 <td align="right" width="15%" class="saldo">'.number_format($sld['sldcta'],0,',','.').'</td>
									 <td align="right" width="15%" class="saldo">'.number_format($sld['sldant'],0,',','.').'</td>
									 <td align="right" width="15%"  class="saldo">'.number_format($variacion,0,',','.').'</td>';	
							    $opt.='</tr>';
								$total+=$sld['sldant'];
								$total2+=$sld['sldcta'];
								$total_variacion+=$variacion;
							}
							$opt.='<tr><td><b>TOTAL</b></td><td class="totales">'.number_format($total2,0,',','.').'</td><td class="totales">'.number_format($total,0,',','.').'</td><td class="totales">'.number_format($total_variacion,0,',','.').'</td></tr></tbody></table>';
							$subtotal1 +=$total;
							$subtotal2 +=$total2;
							$subtotalvar +=$total_variacion;	
						}
						
						}	
					}
					if($row['codbaa'] != '0003'){
					$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr>
							
							<td width="55%"><b>TOTAL '.encodeUtf8($row['nombaa'])." ".encodeUtf8($row1['nombab']).'</b></td>
							<td width="15%" class="totales">'.number_format($subtotal2,0,',','.').'</td>
							<td width="15%" class="totales">'.number_format($subtotal1,0,',','.').'</td>
							<td width="15%" class="totales">'.number_format($subtotalvar,0,',','.').'</td>
							</tr></tbody></table>';}
							$totalfinal1 += $subtotal1;
							$totalfinal2 += $subtotal2;
							$totalfinalvar += $subtotalvar;
					}
					if($row['codbaa'] == '0002' or $row['codbaa'] == '0003'){
					$totalfinal1a += $totalfinal1;
					$totalfinal2a += $totalfinal2;
					$totalfinalvara += $totalfinalvar*(-1);
					}
					if($row['codbaa'] != '0003'){
					$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr>
							<td width="55%"><b>'.encodeUtf8($row['nombaa']).' TOTALES </b></td>
							<td width="15%" class="totales">'.number_format($totalfinal2,0,',','.').'</td>
							<td width="15%" class="totales">'.number_format($totalfinal1,0,',','.').'</td>
							<td width="15%" class="totales">'.number_format($totalfinalvar,0,',','.').'</td>
							</tr></tbody></table>';
					}
				}	
			}	
			$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>

							<td width="55%"><b>TOTAL PASIVO Y PATRIMONIO</b></td>
							<td width="15%" class="totales">'.number_format($totalfinal2a,0,',','.').'</td>
							<td width="15%" class="totales">'.number_format($totalfinal1a,0,',','.').'</td>
							<td width="15%" class="totales">'.number_format($totalfinalvara*(-1),0,',','.').'</td>
							</tr></table>';
		}
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = urldecode('ESTADO DE SITUACION FINANCIERA - COMPARATIVO'); // Nombre Infome
		$data['titInf1'] = strtoupper('A '.$inicial);	//Descripcion
		$data['peso'] = strtoupper('CIFRAS  EXPRESADAS  EN  PESOS  COLOMBIANOS');
		$data['rep_legal'] = $rep_legal['nomper'];
		$data['contador'] = $contador['nomper'];
		$data['rev_fiscal'] = $rev_fiscal['nomper'];
		$data['tpcontador'] = $contador['tpccia'];
		$data['tprevfiscal'] = $rev_fiscal['tprcia'];	
		$data['tabla']=$opt;
		
		if($tipo_informe == 'web'){$this->load->view('sirco/estados_financieros/informe_estado_financiero_compar_v_web',$data); }
		elseif($tipo_informe == 'pdf'){
		 $html = $this->load->view('/sirco/estados_financieros/informe_estado_financiero_compar_v_pdf',$data, TRUE);
		 crearPdf($html,$nombInform.'.pdf');
			}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/estados_financieros/informe_estado_financiero_compar_v_excel',$data);}	
		
		
	}
	
	function imprimirReporte($fecfin,$balance,$nombInform){		
		$resp=$this->esta->consultarNivel1($balance);
	
		$opt='';
		if($resp!=false){
			$totalfinal2=0;$totalfinalvar=0;$totpaspav=0;
			foreach($resp as $row){
				$totalfinal1=0;
				$opt.='<p align="center"><b>'.$row['nombaa'].'<b></p><hr>';
				$resp1=$this->esta->consultarNivel2($row['codbaa']);
				//$resp1->num_rows();
				/*print_r($resp1->result_array());
				exit();*/


				if($resp1->num_rows()>0){
					$resp2 = $resp1->result_array();
					$cont = $resp1->num_rows();
					$valor = new SplFixedArray($cont);
					for($j=0; $j<$cont; $j++)
						$valor[$j] = 0;		
					
					
					/*$valor[0] =1;
					echo $valor[0];
					exit();*/
					$subtotalvar=0;	

					foreach($resp2 as $i=>$row1){
						
							$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"  class="cabe">
							
							<thead>
								<tr>
								<td></td>
									<td width="10%">'.$row1['nombab'].'</td>
									<td width="45%"></td>
									<td width="15%"></td>
								</tr></thead></table>';	
							
						$resp2=$this->esta->consultarNivel3($row1['codbab']);
						
				
					if($resp2!=false){
						foreach($resp2 as $row2){
							$opt.='<p>'.encodeUtf8($row2['nombac']).'</p>';	
							$resp3=$this->esta->consultarCuentasAsociadas($balance,$row['codbaa'],$row1['codbab'],$row2['codbac']);
							if($resp3!=false){
								$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody>';
								$total=0;$total2=0; $total_variacion=0;
								foreach($resp3 as $row3){						
									$opt.='<tr>';
									$fecini="2000-01-01"; 
									$saldo1=$this->sld->obtener_saldos_cuentas_corte($row3['codnif'],fecfin);
										 $opt.='<td width="10%">'.$row3['codnif'].'</td>
										 <td width="45%">'.encodeUtf8($row3['nomnif']).'</td>
										 <td width="15%" class="saldo">'.number_format($saldo1,2).'</td>';	
								    $opt.='</tr>';
									$total=$total+$saldo1;
								}
								$opt.='<tr><td></td><td><b>TOTAL LL</b></td><td class="totales">'.number_format($total,2).'</td></tr></tbody></table>';
								//$valor[$i]=$valor[$i]+$total;
							}
							
							}	
						}
					$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr>
							<td width="10%"></td>
							<td width="45%"><b>TOTAL'.encodeUtf8($row['nombaa'])." ".encodeUtf8($row1['nombab']).'</b></td>
							<td width="15%" class="totales">'.number_format($valor[$i],2).'</td></tr></tbody></table>';
					$totalfinal1=$totalfinal1+$valor[$i];
					
					}
					if($row['tipbaa']==1){$totpaspav=$totpaspav+$totalfinal1;}
					$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr>
							<td width="10%"></td>
							<td width="45%"><b>'.encodeUtf8($row['nombaa']).' TOTALES</b></td>
							<td width="15%" class="totales">'.number_format($totalfinal1,2).'</td>
							</tr></tbody></table>';
				}	
				
			}	
		}
		$opt.='<br>
			<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr>
							<td width="10%"></td>
							<td width="45%"><b>TOTAL PASIVO Y PATRIMONIO</b></td>
							<td width="15%" class="totales">'.number_format($totpaspav,2).'</td>
							</tr></tbody></table>';
							
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = urldecode($nombInform); // Nombre Infome
		$data['titInf1'] = strtoupper('A '.$fecfin);	//Descripcion
		$rep_legal = $this->emp->rep_legal();
		$contador = $this->emp->contadora();
		$rev_fiscal = $this->emp->rep_fiscal();
		$data['rep_legal'] = $rep_legal['nomper'];
		$data['contador'] = $contador['nomper'];
		$data['rev_fiscal'] = $rev_fiscal['nomper'];
		$data['tpcontador'] = $contador['tpccia'];
		$data['tprevfiscal'] = $rev_fiscal['tprcia'];		
		$data['inform']=$opt;
		
		$this->load->view('sirco/estados_financieros/web_informe_estado_financiero_v',$data);
	}
	/*
	function cargarVistaEstado(){
		$data['balance']=$this->cargarComboBalance();
		$this->load->view('sirco/estados_financieros/configurar_estadosfnif_v',$data);	
	}
	function cargarComboBalance(){
		$opt='';
		$resp=$this->esta->cargarComboBalance();
		if($resp!=false){
			foreach($resp as $row){
				$opt.='<option value="'.$row['codbal'].'">'.encodeUtf8($row['nombal']).'</option>';	
			}	
		}
		return $opt;
		}
	function cargarBaa(){
		$this->output->set_header('Content-type:application/json');
		$codbal=$this->input->post('codbal');
		$resp=$this->esta->cargarBaa($codbal);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbaa'=>$row['codbaa'],'nombaa'=>$row['nombaa']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}	
	function cargarBab(){
		$this->output->set_header('Content-type:application/json');
		$codbab=$this->input->post('codbab');
		$resp=$this->esta->cargarBab($codbab);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbab'=>$row['codbab'],'nombab'=>$row['nombab']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}
	//Fin 008
	 */
	 function cargarVistaEstado(){
		$data['balance']=$this->cargarComboBalance();
		$this->load->view('sirco/estados_financieros/configurar_estadosfnif_v',$data);	
	}
	
	function cargarComboBalance(){
		$opt='';
		$resp=$this->esta->cargarComboBalance();
		if($resp!=false){
			foreach($resp as $row){
				$opt.='<option value="'.$row['codbal'].'">'.encodeUtf8($row['nombal']).'</option>';	
			}	
		}
		return $opt;
		}
	
	function combo_balance(){
		$tipo = $this->input->post('tipbal');
		$res = $this->esta->combo_balance($tipo);
		if($res!=false){
			echo json_encode($res);	
		}else{
			echo 0;	
		}
	}
	
	function cargarBaa(){
		$this->output->set_header('Content-type:application/json');
		$codbal=$this->input->post('codbal');
		$resp=$this->esta->cargarBaa($codbal);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbaa'=>$row['codbaa'],'nombaa'=>$row['nombaa']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}	
	function cargarBab(){
		$this->output->set_header('Content-type:application/json');
		$codbaa=$this->input->post('codbaa');
		$resp=$this->esta->cargarBab($codbaa);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbab'=>$row['codbab'],'nombab'=>$row['nombab']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}
		function cargarBac(){
		$this->output->set_header('Content-type:application/json');
		$codbab=$this->input->post('codbab');
		$resp=$this->esta->cargarBac($codbab);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbac'=>$row['codbac'],'nombac'=>$row['nombac']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}
	function agregarEstadoFinancierosNiff(){
			$this->output->set_header('Content-type:application/json');
			$datos=array("codbaa"=>$this->input->post('codbaa'),"codbab"=>$this->input->post('codbab'),
			"codbac"=>$this->input->post('codbac'),"codcta"=>$this->input->post('cuenta'),
			"codbal"=>$this->input->post('codbal'));
			$resp=$this->esta->agregarEstadoFinancierosNiff($datos);
			echo($resp!=false)?'{"err":"1"}':'{"err":"0","msg":"hubo un error al insertar los datos"}';		
	}
	
	function ListadoConfiguracionesFinancierasNiff(){
		$this->output->set_header('Content-type:application/json');
		$output=array("aaData"=>array());
		$resp=$this->esta->listadoConfiguracionesFinancierasNiff();
		if($resp!=false){
			foreach($resp as $row){
				$output["aaData"][]=array(encodeUtf8($row['nombal']),encodeUtf8($row['nombaa']),
				encodeUtf8($row['nombab']),encodeUtf8($row['nombac']),encodeUtf8($row['codcta'])
				,encodeUtf8($row['nomnif']),'<a href="#" title="Eliminar configuracion" class="eliminar" codigo="'.$row['codcef'].'"><img src="/res/icons/practica/eliminar.png"></a>');	
			}	
		}
		echo json_encode($output);
	}
	function eliminarConfiguracionEstadoFinancieroNiff(){
		$this->output->set_header('Content-type:application/json');
		$where=array("codcef"=>$this->input->post('codigo'));
		$resp=$this->esta->eliminarConfiguracionEstadoFinancieroNiff($where);
		echo($resp!=false)?'{"err":"1"}':'{"err":"0","msg":"hubo un error al eliminar esta configuracion"}';

	}
}