<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auxiliares_c extends CI_Controller {
	var $usuario;
	var $fecha;
	var $host;
	function __Construct(){
	   parent::__construct(); 
	   $this->load->model('sirco/auxiliares_m','aux',TRUE);
	   $this->load->model('sirco/empresa_m','emp',TRUE);
	   $this->load->model('sirco/saldos_n_m','sld',TRUE);
       $this->load->model('sirco/Basico_m','bas',TRUE);
	   $this->load->helper(array('siamenu','dompdf'));
	   $this->usuario = $this->session->userdata('codigo');
	   $this->fecha = date("Y-m-d h:i:s A");  
	   $this->host = $_SERVER['REMOTE_ADDR'];
	   //$this->host = $_SERVER['HTTP_X_FORWARDED_FOR']; 
	}
	
	//busqueda
	function auxiliares(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->bas->consultar('codaux,nomaux','cntaux',array('codaux !='=>NULL));
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   		"<a href='javascript:void(0);' class='cod' id='".$row['codaux']."'>".$row['codaux']."</a>",encodeUtf8($row['nomaux'])
				);
			}	
		}
		echo json_encode($output);
	}
	

	function informe_auxiliares_normal($fecha1,$fecha2,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipimp,$sede,$tipcon,$tipo_informe){
		$sede = explode("-",urldecode($sede)); 
		$fechan = explode("-",urldecode($fecha1)); 
		$fechae = explode("-",urldecode($fecha2)); 
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		$cabecera = $this->emp->cabecera_empresa();			
		$primer_tr='
		<table width="800" cellpadding="0" cellspacing="0" class="tabla">
				               <thead>
								  <tr>	
									<td colspan="5" class="titulo">'.$cabecera['nomcia'].'</td>
								  </tr>
                                                                  <td colspan="5" class="letra">'.$cabecera['msgcia'].'</td>
								  </tr>
                                                                  <tr>	
									<td colspan="5" class="letra">'.$cabecera['dircia'].'</td>
								  </tr>	
								   <tr>	
									<td colspan="5" class="letra">Tels: '.$cabecera['telcia'].'</td>
								  </tr>	
								   <tr>	
									<td colspan="5" class="nit">Nit: '.$cabecera['nitcia'].'</td>
								  </tr>		
								  <tr>	
									<td colspan="5" class="letra"><span class="uno">';
									if($tipcon == 'Local'){		
									$primer_tr .='LIBRO DE REGISTRO DIARIO PCGA DESDE '.$fecha1.' HASTA '.$fecha2;}else{
									$primer_tr .='LIBRO DE REGISTRO DIARIO NIIF DESDE '.$fecha1.' HASTA '.$fecha2;}
					$primer_tr .= '</span></td>
								  </tr>';
					if($codctaa != 'n'){ $primer_tr .= '<tr><td colspan="5" class="letra"><span class="uno">CUENTAS: '.$codctaa.' - '.$codctab.'</span></td></tr>'; }
					if($codsed != '00000'){ $primer_tr .= '<tr><td colspan="5" class="letra"><span class="uno">SEDE: '.$codsed.' '.$nomsed.'</span></td></tr>'; }		
					if($codtrca != 'n'){ $primer_tr .= '<tr><td colspan="5" class="letra"><span class="uno"> TERCERO: DESDE '.$codtrca.' - '.$codtrcb.'</span></td></tr>'; } 
					if($codauxa != 'n'){ $primer_tr .= '<tr><td colspan="5" class="letra"><span class="uno"> AUXILIAR: DESDE '.$codauxa.' - '.$codauxb.'</span></td></tr>'; } 
					if($codctsa != 'n'){ $nomcc1= $this->aux->nom_cc($codctsa);	$nomcc2= $this->aux->nom_cc($codctsb);
					$primer_tr .= '<tr><td colspan="5" class="letra"><span class="uno"> CENTRO DE COSTO: '.$codctsa.' '.$nomcc1['nomcts'].' - '.$codctsb.' '.$nomcc2['nomcts'].'</span></td></tr>'; } 						
					$primer_tr .= '</thead>'; 
							 
		$demas_tr='';
 		//
	
		//cuenta inicia		
		$res = $this->aux->cuentas($fecha1,$fecha2,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$fechan['0'],$fechae['0'],$fechan['1'],$fechae['1'],$tipcon);
		if($res!=false){

			foreach($res as $row){
				$sumdebito = 0; $sumcredito = 0; $saldo_cta=0;
				$fecha =  date("Y-m-d",  strtotime($fecha1));
				$nuevafecha = strtotime ( '-1 days' , strtotime ( $fecha ) ) ;
				$result = $this->sld->saldo_corte($row['codcta'],$fecha1,$codtrca,$codtrcb,$codctsa,$codctsb,$codctsa,$codctsb,$codauxa,$codauxb,$tipcon);
				$acumulado = $result['saldo'];
				
//				$acumulado=0;
				$nom_cuenta = $this->aux->nombre_cuenta($row['codcta'],$tipcon);
				$primer_tr .= '
							<tbody>									  
								 <tr class="cuenta">
									<td width="15%"><strong>CUENTA:</strong></td>
									<td><strong>'.$row['codcta'].' '.strtoupper(encodeUtf8($nom_cuenta['nomcta'])).'</strong></td> 
									<td colspan="3" align="right">SALDO A '.date("Y-m-d",$nuevafecha).' $'.number_format($acumulado,2,',','.').'</td>
								 </tr>
							   <tr class="doslineastr">
					 			    <td width="15%">Fecha-Fte-Nro</td>
									<td width="49%">Detalle</td>
									<td width="12%" align="center">Mov. D&eacute;bito</td>
									<td width="12%" align="center">Mov. Cr&eacute;dito</td>
									<td width="17%" align="center">Saldo Actual</td>
							 </tr>';
				$datos = $this->aux->detalle($fecha1,$fecha2,$row['codcta'],$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$fechan['0'],$fechae['0'],$fechan['1'],$fechae['1'],$tipcon);	
				if($datos!=false){
				foreach($datos as $datos_cuenta){
				if($result['natcta'] == 'D'){ $acumulado=$acumulado+$datos_cuenta['debdcm']-$datos_cuenta['credcm']; }
				else{$acumulado=$acumulado+$datos_cuenta['credcm']-$datos_cuenta['debdcm']; }	
				
				$sumdebito=$sumdebito+$datos_cuenta['debdcm'];
				$sumcredito=$sumcredito+$datos_cuenta['credcm'];
				$fecha =  $datos_cuenta['fchcmp'];
				$chq="";
				if(trim($datos_cuenta['nroegr']) != '' and trim($datos_cuenta['nroegr']) != '0') $chq = ") CHEQUE ".$datos_cuenta['nroegr'];
			    $primer_tr .='<div>';
				$primer_tr .= '<tr valign="top">';
     			$primer_tr .= '	<td class="numero">'.str_replace("/", ".", $fecha).'-'.$datos_cuenta['coddoc'].'-'.$datos_cuenta['nrocmp'].'</td>';
	    		$primer_tr .= '	<td class="letra">'.encodeUtf8($datos_cuenta['detdcm'].' '.$datos_cuenta['actpgs']).' '.encodeUtf8($datos_cuenta['nomtrc']).' (C.C '.$datos_cuenta['codcts'].$chq.'</td>';
		    	$primer_tr .= '	<td align="center" class="numero">'.number_format($datos_cuenta['debdcm'],2,',','.').'</td>';
			    $primer_tr .= '	<td align="center" class="numero">'.number_format($datos_cuenta['credcm'],2,',','.').'</td>';
				$primer_tr .= '	<td align="center" class="numero">'.number_format($acumulado,2,',','.').'</td>';
			    $primer_tr .= '</tr>';
				$primer_tr .= '</div>';
				}
				$primer_tr .= '<tr class="finalsaldo">
					           <td>&nbsp;&nbsp;</td>
					           <td>&nbsp;&nbsp;</td>
						       <td align="center">Mov. D&eacute;bito</td>
					           <td align="center">Mov. Cr&eacute;dito</td>
				   		       <td align="center">Saldo Actual</td>
				               </tr>';
				$primer_tr .= '<tr class="lineafinal">
     						   <td></td>
	    			           <td align="center"><strong>TOTAL:&nbsp;&nbsp;'.$row['codcta'].'</strong></td>
		    	               <td align="center">'.number_format($sumdebito,2,',','.').'</td>
			                   <td align="center">'.number_format($sumcredito,2,',','.').'</td>
					           <td align="center">'.number_format($acumulado,2,',','.').'</td>
			                   </tr>';
				}
	}
  } 
  	//fin cuenta
    $data['detalle'] = $primer_tr;
	$data['tipimp']=$tipimp;
	if($tipo_informe == 'web'){$this->load->view('/sirco/auxiliares/reporte_normal_web_v',$data);}
				elseif($tipo_informe == 'pdf'){
				$html = $this->load->view('/sirco/auxiliares/reporte_normal_pdf_v',$data, TRUE);
				 crearPdf($html,$nombInform.'.pdf');
				}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/auxiliares/reporte_normal_excel_v',$data);}
}	
	
		
	
}