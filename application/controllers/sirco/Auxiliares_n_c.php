<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auxiliares_n_c extends CI_Controller {
	var $usuario;
	var $fecha;
	var $host;
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/auxiliar_n_m','aux',TRUE);
	   $this->load->model('sirco/empresa_m','emp',TRUE);
	   $this->load->model('sirco/saldos_n_m','sld',TRUE);
	   $this->load->helper(array('siamenu','dompdf'));
	   $this->usuario = $this->session->userdata('codigo');	
	   $this->fecha = date("Y-m-d h:i:s A");  
	   $this->host = $_SERVER['REMOTE_ADDR'];
	   if($this->usuario == ''){ 
			echo  "<script language=\"JavaScript\">   alert(\"SU SESION A CADUCA INGRESE NUEVAMENTE\") </script>";
  			echo  "<script language=\"JavaScript\"> window.location.href = \"http://sia.tecnar.edu.co/\" </script>";
   			exit(); } 
	}
	
	function cargar_vista($nombre=''){
		$this->load->view("sirco/auxiliares/".$nombre);
	}
	
	function vista_buscar($nombre=''){
		$this->load->view("sirco/auxiliares/".$nombre);
	}
	
	//busqueda
	function auxiliares(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->aux->auxiliares();
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
	
	function informe_auxiliares_normal($fecha1,$fecha2,$codnifa,$codnifb,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipimp,$sede){
				$sede = explode("-",urldecode($sede)); 
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		$cabecera = $this->emp->cabecera_empresa();			
		$primer_tr='
		<table width="800" cellpadding="0" cellspacing="0" class="tabla">
				               <thead>
								  <tr>	
									<td colspan="5" class="titulo">'.$cabecera['nomcia'].'</td>
								  </tr>';	
								  if($cabecera['nitcia'] == '890481264-1' or $cabecera['nitcia']='823004609-9'){
				   $primer_tr .= '<tr>	
									<td colspan="5" class="letra">Vigilado MinEducacion</td>
								  </tr>';
								  }
				    $primer_tr .= '<tr>	
									<td colspan="5" class="letra">'.$cabecera['dircia'].'</td>
								  </tr>	
								   <tr>	
									<td colspan="5" class="letra">Tels: '.$cabecera['telcia'].'</td>
								  </tr>	
								   <tr>	
									<td colspan="5" class="nit">Nit: '.$cabecera['nitcia'].'</td>
								  </tr>		
								  <tr>	
									<td colspan="5" class="letra"><span class="uno">INFORME AUXILIARES NIIF DESDE '.$fecha1.' HASTA '.$fecha2;
									if($codsed != '00000'){ $primer_tr .= ' SEDE: '.$codsed.' '.$nomsed; }
									if($codtrca != '0'){ $primer_tr .= ' TERCERO: DESDE '.$codtrca.' - '.$codtrcb; }
					$primer_tr .= '</span></td>
								  </tr>						
							 </thead>'; 
							 
		$demas_tr='';
 		//
		if($codctsa!='0' && $codctsb!='0'){ 
					$nomcc1= $this->aux->nom_cc($codctsa);
					$nomcc2= $this->aux->nom_cc($codctsb);
					$primer_tr .= '<div class="cuenta">CENTRO DE COSTO: '.$codctsa.' '.$nomcc1['nomcts'].' - '.$codctsb.' '.$nomcc2['nomcts'].'</div>'; 
				}
				
		//cuenta inicia		
		$res = $this->aux->cuentas($fecha1,$fecha2,$codnifa,$codnifb,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb);
		if($res!=false){

			foreach($res as $row){
				$sumdebito = 0; $sumcredito = 0; $saldo_cta=0;
				$fecha =  date("Y-m-d",  strtotime($fecha1));
				$nuevafecha = strtotime ( '-1 days' , strtotime ( $fecha ) ) ;
				$acumulado = $this->sld->saldo_corte($row['codcta'],$fecha1,$codnifa,$codnifb,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb);
				$nom_cuenta = $this->aux->nombre_cuenta($row['codcta']);
				$primer_tr .= '
							<tbody>									  
								 <tr class="cuenta">
									<td width="15%"><strong>CUENTA:</strong></td>
									<td><strong>'.$row['codcta'].' '.strtoupper(encodeUtf8($nom_cuenta['nomcta'])).'</strong></td> 
									<td colspan="3" align="right">SALDO A '.date("Y-m-d",$nuevafecha).' $'.number_format($acumulado,2).'</td>
								 </tr>
							   <tr class="doslineastr">
					 			    <td width="15%">Fecha-Fte-Nro</td>
									<td width="49%">Detalle</td>
									<td width="12%" align="center">Mov. Débito</td>
									<td width="12%" align="center">Mov. Crédito</td>
									<td width="17%" align="center">Saldo Actual</td>
							 </tr>';
				$datos = $this->aux->detalle($fecha1,$fecha2,$row['codcta'],$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb);	
				if($datos!=false){
				foreach($datos as $datos_cuenta){
				$acumulado=$acumulado+$datos_cuenta['debdcm']-$datos_cuenta['credcm'];	
				$sumdebito=$sumdebito+$datos_cuenta['debdcm'];
				$sumcredito=$sumcredito+$datos_cuenta['credcm'];
				$fecha =  $datos_cuenta['fchcmp'];
			
			    $primer_tr .='<div>';
				$primer_tr .= '<tr valign="top">';
     			$primer_tr .= '	<td class="numero">'.str_replace("/", ".", $fecha).'-'.$datos_cuenta['coddoc'].'-'.$datos_cuenta['nrocmp'].'</td>';
	    		$primer_tr .= '	<td class="letra">'.encodeUtf8($datos_cuenta['detdcm'].' '.$datos_cuenta['actpgs']).' '.encodeUtf8($datos_cuenta['nomtrc']).' (C.C '.$datos_cuenta['codcts'].')</td>';
		    	$primer_tr .= '	<td align="center" class="numero">'.number_format($datos_cuenta['debdcm'],2).'</td>';
			    $primer_tr .= '	<td align="center" class="numero">'.number_format($datos_cuenta['credcm'],2).'</td>';
				$primer_tr .= '	<td align="center" class="numero">'.number_format($acumulado,2).'</td>';
			    $primer_tr .= '</tr>';
				$primer_tr .= '</div>';
				}
				$primer_tr .= '<tr class="finalsaldo">
					           <td>&nbsp;&nbsp;</td>
					           <td>&nbsp;&nbsp;</td>
						       <td align="center">Mov. Débito</td>
					           <td align="center">Mov. Crédito</td>
				   		       <td align="center">Saldo Actual</td>
				               </tr>';
				$primer_tr .= '<tr class="lineafinal">
     						   <td></td>
	    			           <td align="center"><strong>TOTAL:&nbsp;&nbsp;'.$row['codcta'].'</strong></td>
		    	               <td align="center">'.number_format($sumdebito,2).'</td>
			                   <td align="center">'.number_format($sumcredito,2).'</td>
					           <td align="center">'.number_format($acumulado,2).'</td>
			                   </tr>';
				}
	}
  } 
  	//fin cuenta
    $data['detalle'] = $primer_tr;
	$data['tipimp']=$tipimp;
    $this->load->view('sirco/auxiliares/web_reporte_normal',$data);
}	
	
	/*function informe_auxiliares_normal($fecha1,$fecha2,$codnifa,$codnifb,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb){
		$primer_tr=''; $demas_tr='';
		
		//Terceros
			if($codtrca!='0' && $codtrcb!='0'){ 
					$nomcc1= $this->aux->nom_trc($codtrca);
					$nomcc2= $this->aux->nom_trc($codtrcb);
					$primer_tr .= '<div class="cuenta">TERCROS: '.$codtrca.' '.$nomcc1['nomtrc'].' HASTA '.$codtrcb.' '.$nomcc2['nomtrc'].'</div>'; 
				}
		// Centro de Costo
		if($codctsa!='0' && $codctsb!='0'){ 
					$nomcc1= $this->aux->nom_cc($codctsa);
					$nomcc2= $this->aux->nom_cc($codctsb);
					$primer_tr .= '<div class="cuenta">CENTRO DE COSTO: '.$codctsa.' '.$nomcc1['nomcts'].' HASTA '.$codctsb.' '.$nomcc2['nomcts'].'</div>'; 
				}
		//Auxiliares
		if($codauxa!='0' && $codauxb!='0'){ 
					$nomcc1= $this->aux->nom_aux($codauxa);
					$nomcc2= $this->aux->nom_aux($codauxb);
					$primer_tr .= '<div class="cuenta">CENTRO DE COSTO: '.$codauxa.' '.$nomcc1['nomaux'].' HASTA '.$codauxb.' '.$nomcc2['nomaux'].'</div>'; 
				}
				
		//cuenta inicia		
		$res = $this->aux->cuentas($fecha1,$fecha2,$codnifa,$codnifb,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb);
		if($res!=false){

			foreach($res as $row){
				$acumulado=0; $sumdebito = 0; $sumcredito = 0; $saldo_cta=0;
				
				$fecha =  date("Y-m-j",  strtotime($fecha1));
				$nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
				$nuevafecha = date ( 'Y-m' , $nuevafecha );	
				$periodo = explode('-',$nuevafecha);
				$saldo = $this->aux->obtener_saldos_cuentas_mes($row['codcta'],$periodo[0],$periodo[1]);
				if($saldo!=false){ $acumulado = $saldo;}else{$acumulado=0;}		
				$nom_cuenta = $this->aux->nombre_cuenta($row['codcta']);	
				$primer_tr .= '<table width="100%" cellpadding="0" cellspacing="0" class="tabla">';    
				$primer_tr .= '	  <tr class="trprin">';
				$primer_tr .= '		<td width="20%"><strong>CUENTA: '.$row['codcta'].'</strong></td>';
				$primer_tr .= '		<td width="50%"><strong>'.strtoupper(encodeUtf8($nom_cuenta['nomcta'])).'</strong></td>'; 
				$primer_tr .= '		<td width="30%" colspan="3" align="right"><strong>SALDO A '.$nuevafecha.' '.number_format($acumulado,2).'</strong></td>';
				$primer_tr .= '	  </tr>';  	
				$primer_tr .= '	  <tr class="trprin">';
				$primer_tr .= '		<td width="20%">Fecha - Sede - Fte - Nro</td>';
				$primer_tr .= '		<td width="50%">Detalle</td>';
				$primer_tr .= '		<td width="10%" align="center">Mov. Débito</td>';
				$primer_tr .= '		<td width="10%" align="center">Mov. Crédito</td>';
				$primer_tr .= '		<td width="10%" align="center">Saldo Actual</td>';
				$primer_tr .= '	  </tr>';
				
				$datos = $this->aux->detalle($fecha1,$fecha2,$row['codcta'],$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb);	
				if($datos!=false){
				foreach($datos as $datos_cuenta){
				$acumulado=$acumulado+$datos_cuenta['debdcm']-$datos_cuenta['credcm'];	
				$sumdebito=$sumdebito+$datos_cuenta['debdcm'];
				$sumcredito=$sumcredito+$datos_cuenta['credcm'];
				$fecha =  $datos_cuenta['fchcmp'];
			
				$primer_tr .= '<tr>';
     			$primer_tr .= '	<td>'.$fecha.'-'.$datos_cuenta['codsed'].'-'.$datos_cuenta['coddoc'].'-'.$datos_cuenta['nrocmp'].'</td>';
	    		$primer_tr .= '	<td>'.encodeUtf8($datos_cuenta['detdcm']).' '.encodeUtf8($datos_cuenta['nomtrc']).' (C.C '.$datos_cuenta['codcts'].')</td>';
		    	$primer_tr .= '	<td align="center">'.number_format($datos_cuenta['debdcm'],2).'</td>';
			    $primer_tr .= '	<td align="center">'.number_format($datos_cuenta['credcm'],2).'</td>';
				$primer_tr .= '	<td align="center">'.number_format($acumulado,2).'</td>';
			    $primer_tr .= '</tr>';
				}
				$primer_tr .= '<tr><td colspan="5" >&nbsp;&nbsp;</td></tr>';
				$primer_tr .= '	  <tr class="trprin">';
				$primer_tr .= '		<td width="20%">&nbsp;&nbsp;</td>';
				$primer_tr .= '		<td width="30%">&nbsp;&nbsp;</td>';
				$primer_tr .= '		<td width="15%" align="center"><strong>Mov. Débito</strong></td>';
				$primer_tr .= '		<td width="15%" align="center"><strong>Mov. Crédito</strong></td>';
				$primer_tr .= '		<td width="20%" align="center"><strong>Saldo Actual</strong></td>';
				$primer_tr .= '	  </tr>';
				$primer_tr .= '<tr>';
     			$primer_tr .= '	<td></td>';
	    		$primer_tr .= '	<td align="center"><strong>TOTAL:&nbsp;&nbsp;'.$row['codcta'].'</strong></td>';
		    	$primer_tr .= '	<td align="center"><strong>'.number_format($sumdebito,2).'</strong></td>';
			    $primer_tr .= '	<td align="center"><strong>'.number_format($sumcredito,2).'</strong></td>';
				$primer_tr .= '	<td align="center"><strong>'.number_format($acumulado,2).'</strong></td>';
			    $primer_tr .= '</tr>';
				$primer_tr .= '<tr><td colspan="5" ><hr></td></tr>';
				}
	}
  } //fin cuenta
 	$cabecera = $this->emp->cabecera_empresa();			
	$data['cabecera'] = $cabecera;
	$data['tipo'] = 'NIIF';
	$data['fecha1'] = $fecha1;
	$data['fecha2'] = $fecha2;
	$data['codnifa'] = $codnifa;
	$data['codnifb'] = $codnifb;
    $data['detalle'] = $primer_tr;
    $this->load->view('sirco/auxiliares/web_reporte_normal',$data);
}	
	
	*/	
	
}