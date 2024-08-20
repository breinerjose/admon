<?php 
class Estados_balance_n_c extends CI_Controller { 
	var $usuario;
	var $fecha;
	var $host; 
	function __Construct(){
	   parent::__construct();
	   $this->load->helper(array('siamenu','dompdf'));
	   $this->load->model('sirco/Estados_balance_n_m','esta',TRUE);
	   $this->load->model('sirco/saldos_n_m','sld',TRUE);
	   $this->load->model('sirco/saldos_m','saldos',TRUE);
	   $this->load->model('sirco/cuentas_m','cta',TRUE);
	   $this->load->model('sirco/empresa_m','emp',TRUE);
	   $this->load->model('sirco/basico_m','bas',TRUE);
	   $this->usuario = $this->session->userdata('codigo');	
	   $this->fecha = date("Y-m-d h:i:s A");  
	   $this->host = gethostname(); 
	   if($this->session->userdata('codigo') == ''){ 
			echo  "<script language=\"JavaScript\">   alert(\"SU SESION A CADUCA INGRESE NUEVAMENTE\") </script>";
  			echo  "<script language=\"JavaScript\"> window.location.href = \"http://sia.tecnar.edu.co/\" </script>";
   			exit(); }   
	}
	
	function cargarVistaEstadoFinanciero(){
	  $this->load->view("sirco/estados_financieros/seleccionar_estado_fnif_v");

	}
	
	//Inicio 007
	//Balance General Bajo Niif
		function balance_niif($fecha,$tbalance,$nombInform,$tipo_informe){
		
		$cabecera = $this->emp->cabecera_empresa();
		$tr = '';
			$tr .= '<tr>
						<td width="10%"><b>Cuenta</b></td>
						<td width="47%"><b>Nombre</b></td>
						<td width="13%" align="right"><b>Saldo Actual</b></td>
					</tr><br>';
		$nombInform = urldecode($nombInform);
		$inform = explode("-",$nombInform);
		$nombInform = trim($inform['1']); 	
		$totala=0; $totalb=0; $totalc=0; $totald=0;
		$res = $this->saldos->calcular_saldos_niif_bal_prueba($fecha,$fecha,trim($inform['0']),$this->session->userdata('codigo'));
		//Inicio Informe
		$estructuraBalance = $this->esta->est_bal($fecha,$fecha,trim($inform['0']),$this->session->userdata('codigo'));
		foreach($estructuraBalance as $cta){
		if(trim($cta['tpocta']) == 'General'){
		if($cta['codnif'] > 9){	
			$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.$cta['sldcta'].'</b></td>
					</tr>';
			}else{
				$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.$cta['sldcta'].'</b></td>
					</tr>';
				}		
							
		}else{
			$tr .= '<tr>
					          <td >'.$cta['codnif'].'</td>
							  <td>'.($cta['nomnif']).'</td>
							  <td  align="right">'.$cta['sldcta'].'</td>
							</tr>';		
			}
		}	
		$suma = $this->esta->sumapasivopatrimonio($fecha,$fecha,trim($inform['0']),$this->session->userdata('codigo'));
		$tr .= '<tr>
		<td  colspan="2" align="center"><b>TOTAL PASIVO Y PATRIMONIO -</b></td><td align="right"><b>'.number_format(($suma),0,',','.').'</b></td></tr>';

							
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = $nombInform; // Nombre Infome
		$data['titInf1'] = strtoupper('A '.$fecha);	//Descripcion
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
			}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/estados_financieros/excel_estado_f_v',$data);}		
		}
		//
		//Balance General Bajo Niif Comparativo
		function balance_niif_compar($fecini,$fecfin,$tbalance,$nombInform,$tipo_informe,$vertical){
		$cabecera = $this->emp->cabecera_empresa();
		$tr = '';
						if($vertical == 1){$tr .= '<tr>
						<td width="9%"><b>Cuenta</b></td>
						<td width="37%"><b>Nombre</b></td>
						<td width="17%" align="right"><b>'.$fecini.'</b></td>
						<td width="17%" align="right"><b>'.$fecfin.'</b></td>
						<td width="17%" align="right"><b>Variacion</b></td>
						<td width="3%" align="right"><b>%</b></td>';}else{
						$tr .= '<tr>
						<td width="9%"><b>Cuenta</b></td>
						<td width="40%"><b>Nombre</b></td>
						<td width="17%" align="right"><b>'.$fecini.'</b></td>
						<td width="17%" align="right"><b>'.$fecfin.'</b></td>
						<td width="17%" align="right"><b>Variacion</b></td>';
						}
				$tr .='</tr><br>';
		$nombInform = urldecode($nombInform);
		$inform = explode("-",$nombInform);
		$nombInform = trim($inform['1']); 	
		$totala=0; $totalb=0; $totalc=0; $totald=0;
		//$res = $this->saldos->calcular_saldos_niif_bal_prueba($fecini,$fecfin,trim($inform['0']),$this->session->userdata('codigo'));
		$this->sld->anexo_cuentas($fecini,$fecfin,'0007',$this->session->userdata('codigo'));
		
		//Inicio Informe
		$estructuraBalance = $this->esta->est_bal($fecini,$fecfin,trim($inform['0']),$this->session->userdata('codigo'));
		foreach($estructuraBalance as $cta){
		if(substr($cta['codnif'],0,1) == 2 OR substr($cta['codnif'],0,1) == 3){$cta['sldcta'] = $cta['sldcta']*(-1); $cta['sldant'] = $cta['sldant']*(-1);}	
		//if(trim($cta['tpocta']) == 'Detalle'){$totala +=$cta['sldant'];	$totald +=($cta['sldcta']+$cta['sldant']);}
		if($cta['sldcta']+$cta['sldant'] > 0){ 
		$porcentaje = round(($cta['sldant']/($cta['sldcta']+$cta['sldant']))*100-100,0);
		if($porcentaje != 0){
		$porcentaje = $porcentaje*-1;
		}
		}else{$porcentaje=0;}	
		if(trim($cta['tpocta']) == 'General'){
		if($cta['codnif'] > 9){	
			$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.number_format($cta['sldant'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['sldcta'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['sldcta']-$cta['sldant'],0,',','.').'</b></td>';
						if($vertical == 1){$tr .= '<td  align="right"><b>'.$porcentaje.'</b></td>';}
					$tr .='</tr>';
			}else{
				$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.number_format($cta['sldant'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['sldcta'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['sldcta']-$cta['sldant'],0,',','.').'</b></td>';
						if($vertical == 1){$tr .= '<td  align="right"><b>'.$porcentaje.'</b></td>';}
				$tr	.='</tr>';
				}		
							
		}else{
			$tr .= '<tr>
					          <td >'.$cta['codnif'].'</td>
							  <td>'.($cta['nomnif']).'</td>
							  <td align="right">'.number_format($cta['sldant'],0,',','.').'</td>
							  <td  align="right">'.number_format($cta['sldcta'],0,',','.').'</td>
							  <td  align="right">'.number_format($cta['sldcta']-$cta['sldant'],0,',','.').'</td>';
							  if($vertical == 1){$tr .= '<td  align="right">'.$porcentaje.'</td>';}
							$tr .='</tr>';		
			}
		}
		$suma = $this->esta->sumapasivopatrimonio($fecini,$fecfin,trim($inform['0']),$this->session->userdata('codigo'));
		//echo $this->db->last_query();
		//exit();
		$porcentaje = round(($suma['sldcta']/$suma['sldant'])*100-100,0);
		$tr .= '<tr>
		<td  colspan="2" align="center"><b>TOTAL PASIVO Y PATRIMONIO</b></td>
		<td align="right"><b>'.number_format(($suma['sldant']*-1),0,',','.').'</b></td>
		<td align="right"><b>'.number_format(($suma['sldcta']*-1),0,',','.').'</b></td>
		<td align="right"><b>'.number_format($suma['sldant']-$suma['sldcta'],0,',','.').'</b></td>';
		if($vertical == 1){$tr .= '<td align="right"><b>'.$porcentaje.'</b></td>';}
		$tr .='</tr>';
							
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = $nombInform." COMPARATIVO"; // Nombre Infome
		$data['titInf1'] = 'A '.$fecfin;	//Descripcion
		$data['peso'] = 'CIFRAS  EXPRESADAS  EN  PESOS  COLOMBIANOS';
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
		 crearPdf($html,$nombInform.' '.$fecini.' '.$fecfin.'.pdf');
			}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/estados_financieros/excel_estado_f_v',$data);}
		
		}
		//
	//Fin 007
	
	
		//Inicio 0010
	//Balance General Bajo Niif Comparativo
		function balance_prueba_niif_compar($fecini,$fecfin,$tbalance,$nombInform,$tipo_informe){
		$anioa = explode("-",$fecini);
		$aniob = explode("-",$fecfin);
		$nombInform = urldecode($nombInform);
		$inform = explode("-",$nombInform);
		$nombInform = trim($inform['1']);
			$tr = '<tr>
						<td width="8%"><b>Cuenta</b></td>
						<td width="36%"><b>Nombre</b></td>
						<td width="14%" align="right"><b>Saldo A '.$fecini.'</b></td>
						<td width="14%" align="right"><b>Debito</b></td>
						<td width="14%" align="right"><b>Credito</b></td>
						<td width="14%" align="right"><b>Saldo A '.$fecfin.'</b></td></tr>';
		$totala=0; $totalb=0; $totalc=0; $totald=0;
		$this->sld->anexo_cuentas($fecini,$fecfin,trim($inform['0']),$this->session->userdata('codigo'));
		
		//Inicio Informe
		$estructuraBalance = $this->esta->est_bal_pru($fecini,$fecfin,trim($inform['0']),$this->session->userdata('codigo'));
		foreach($estructuraBalance as $cta){
		if (substr($cta['codnif'],0,1) > 3 and $anioa['0'] == $aniob['0']){ $cta['sldcta'] += $cta['sldant']; }
		if(trim($cta['tpocta']) == 'General'){
		
		if($cta['codnif'] > 9){	
			$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.number_format($cta['sldant'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['debito'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['credito'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['sldcta'],0,',','.').'</b></td>
					</tr>';
			}else{

			$totala +=$cta['sldant'];
			$totalb +=$cta['debito'];
			$totalc +=$cta['credito'];
			$totald +=$cta['sldcta'];
		
				$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.number_format($cta['sldant'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['debito'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['credito'],0,',','.').'</b></td>
						<td  align="right"><b>'.number_format($cta['sldcta'],0,',','.').'</b></td>
					</tr>';
				}		
							
		}else{
			$tr .= '<tr>
					          <td >'.$cta['codnif'].'</td>
							  <td>'.($cta['nomnif']).'</td>
							  <td align="right">'.number_format($cta['sldant'],0,',','.').'</td>
							  <td  align="right">'.number_format($cta['debito'],0,',','.').'</td>
							  <td  align="right">'.number_format($cta['credito'],0,',','.').'</td>
							  <td  align="right">'.number_format($cta['sldcta'],0,',','.').'</td>
							</tr>';		
			}
		}

		$tr .= '
		<tr>
		<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
					          <td colspan="2">TOTALESS =></td>
							  <td align="right">'.number_format($totala,0,',','.').'</td>
							  <td align="right">'.number_format($totalb,0,',','.').'</td>
							  <td align="right">'.number_format($totalc,0,',','.').'</td>
							  <td align="right">'.number_format($totalb-$totalc,0,',','.').'</td>
							</tr>';	
							
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = $nombInform; // Nombre Infome
		$data['titInf1'] = 'A '.$fecfin;	//Descripcion
		$data['peso'] = 'CIFRAS  EXPRESADAS  EN  PESOS  COLOMBIANOS';
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
		 crearPdf($html,'BALANCE_DE_PRUEBA'.$fecini.' '.$fecfin.'.pdf');
			}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/estados_financieros/excel_estado_f_v',$data);}
		
		}
	//Fin 0010
	
		//Inicio 0010
	//Balance General Bajo Niif Comparativo
		function balance_prueba_niif($fecha,$tbalance,$nombInform,$tipo_informe){
		$cabecera = $this->emp->cabecera_empresa();
		$tr = '';
			$tr .= '<tr>
						<td width="10%"><b>Cuenta</b></td>
						<td width="47%"><b>Nombre</b></td>
						<td width="13%" align="right"><b>Saldo Actual</b></td>
					</tr><br>';
		$nombInform = urldecode($nombInform);
		$inform = explode("-",$nombInform);
		$nombInform = trim($inform['1']); 	
		$totala=0; $totalb=0; $totalc=0; $totald=0;
		//$res = $this->saldos->calcular_saldos_niif_bal_prueba($fecha,$fecha,trim($inform['0']),$this->session->userdata('codigo'));
		//Inicio Informe
		$estructuraBalance = $this->esta->est_bal_pru($fecha,$fecha,trim($inform['0']),$this->session->userdata('codigo'));
		foreach($estructuraBalance as $cta){
		//if(substr($cta['codnif'],0,1) == 2 OR substr($cta['codnif'],0,1) == 3){$cta['sldcta'] = $cta['sldcta']*(-1);}	
		if(trim($cta['tpocta']) == 'Detalle'){
			$totald +=($cta['sldcta']+$cta['sldant']);
		}
			
		$saldocta = "$".number_format($cta['sldcta']+$cta['sldant'],0,',','.');
		if(trim($cta['tpocta']) == 'General'){
		if($cta['codnif'] > 9){	
			$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.$saldocta.'</b></td>
					</tr>';
			}else{
				$tr .= '<tr>
						<td><b>'.$cta['codnif'].'</b></td>
						<td><b>'.($cta['nomnif']).'</b></td>
						<td  align="right"><b>'.$saldocta.'</b></td>
					</tr>';
				}		
							
		}else{
			$tr .= '<tr>
					          <td >'.$cta['codnif'].'</td>
							  <td>'.($cta['nomnif']).'</td>
							  <td  align="right">'.$saldocta.'</td>
							</tr>';		
			}
		}
		//if($codinf == '0010'){
//		$suma = $this->esta->sumapasivopatrimonio($tbalance,$this->usuario);
//		$tr .= '<tr>
//		<td  colspan="5" align="center"><b>TOTAL PASIVO Y PATRIMONIO</b></td><td><b>$ '.number_format(($suma['sldcta']*-1),2,',','.').'</b></td></tr>';
//		}	
		$tr .= '
		<tr>
		<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
					          <td colspan="2">TOTALES =></td>
							  <td align="right">'.number_format($totald,0,',','.').'</td>
							</tr>';	
							
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = $nombInform; // Nombre Infome
		$data['titInf1'] = 'A '.$fecha;	//Descripcion
		$data['peso'] = 'CIFRAS  EXPRESADAS  EN  PESOS  COLOMBIANOS';
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
			}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/estados_financieros/excel_estado_f_v',$data);}
		
		}
	//Fin 0010

}