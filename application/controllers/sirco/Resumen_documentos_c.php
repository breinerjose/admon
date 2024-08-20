<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resumen_documentos_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/resumen_documentos_m','res_doc',TRUE); 
	   $this->load->model('sirco/imprimir_doc_m','imp',TRUE);
	   $this->load->model('sirco/empresa_m','emp',TRUE);
	   $this->load->model('sirco/sedes_m','sde',TRUE); 
	   date_default_timezone_set("America/Bogota");
	   $this->load->library('numletras');
	}
	
	function cargar_vista($nombre=''){ 
		$this->load->view("sirco/documento_contable/".$nombre);
	}
	
	function periodos(){
		$this->output->set_header('Content-type: application/json');
		$periodos=array();
		for($i=0; $i<=13; $i++){ 
			array_push($periodos, (2010+$i));
		}
		echo json_encode($periodos);
	}
	
	function sedes_por_documento(){
		$this->output->set_header('Content-type: application/json');
		$fte1 = explode('_',$this->input->post('fte1'));	
		$fte2 = explode('_',$this->input->post('fte2'));	
		$sedes = $this->res_doc->sedes_por_documento($fte1[0],$fte2[0],$this->session->userdata('codigo'));
		echo json_encode($sedes);
	}
	
	
		function obtener_documentos(){
		$this->output->set_header('Content-type: application/json');
		$coddoc1=$this->input->post('coddoc1');
		$coddoc2=$this->input->post('coddoc2');
		$fecha1=$this->input->post('fecha1');
		$fecha2=$this->input->post('fecha2');
		$nrocmp1=$this->input->post('nrocmp1');
		$nrocmp2=$this->input->post('nrocmp2');
		$codsed=$this->input->post('codsed');
		$tipo_consult=$this->input->post('tipo_consult');
		$coddoc1 = explode('_',$coddoc1);	
		$coddoc2 = explode('_',$coddoc2);
		
		$condi="";
		if($tipo_consult=='cuadrados'){$condi = "and trim(stdcmp)='Generado' and debcmp=crecmp";}
		else if($tipo_consult=='descuadrados'){$condi = "and trim(stdcmp)='Generado' and debcmp!=crecmp";}
		elseif($tipo_consult=='revertido'){$condi="and trim(stdcmp)='Revertido'";}
		
		$result = $this->res_doc->datos_tabla(trim($coddoc1[0]),trim($coddoc2[0]),$fecha1,$fecha2,$nrocmp1,$nrocmp2,$codsed,$tipo_consult);
		
		$output = array("aaData" => array());
			if($result != FALSE){
				foreach($result as $row ){
		$codigs = $row['nrocmp'].'-'.$row['coddoc'].'-'.$row['codsed'].'-'.$row['agncnt'].'-'.$row['mescnt'].'-'.$row['fchcmp'];
				
		$output['aaData'][] = array($row['coddoc'],$row['fchcmp'],$row['nrocmp'],number_format($row['debcmp'], 0, '', '.'),number_format($row['crecmp'], 0, '', '.'),
		"<a href='javascript:void(0);' title='Imprimir Local' data-print='".$codigs."' class='imprimirLocal'>
		<img src='/res/icons/sirco/print-icon.png'></a>
		<a href='javascript:void(0);' title='Imprimir Niif' data-print='".$codigs."' class='imprimirNif'>
		<img src='/res/icons/sirco/printnif.png'></a>&nbsp&nbsp
		<a href='javascript:void(0);' title='Imprimir Cheque' data-print='".$codigs."' class='imprimirCheque'>
		<img src='/res/icons/sirco/cheque.png'></a>");
				}
				echo json_encode($output);
			}
		
		}	
	
	//validado
	function reporte($coddoc1,$coddoc2,$fecha1,$fecha2,$nrocmp1,$nrocmp2,$codsed,$tipo_consult){
		$cuerpo='';
		if($codsed != '00000'){
					$nombre_sede = $this->Bas_m->consultarf('nomsed','invsed',array('codsed'=>$codsed));
					$sede = $codsed."&nbsp;&nbsp;".$nombre_sede['nomsed'];
					$codsed = "AND trim(codsed)='$codsed'";
					}else{$codsed=''; $sede='';}
		
		$res = $this->res_doc->obtener_documentos($fecha1,$fecha2,trim($coddoc1),trim($coddoc2),$nrocmp1,$nrocmp2,$codsed,$tipo_consult);
		if($res!=false){
			$cabecera = $this->emp->cabecera_empresa();
			
			foreach($res as $row){
				$nombre_doc = $this->res_doc->nombre_doc($row['coddoc']);
				
				$sumdebito=0; $sumcredito=0; $estado='';
				$detalle=$this->res_doc->detalle($row['coddoc'],$fecha1,$fecha2,$nrocmp1,$nrocmp2,$codsed,$tipo_consult);
				$cuerpo .= '<tr>
							<td colspan="6" style="border-bottom:1px solid; padding-bottom:4px;">FUENTE: '.$row['coddoc'].' &nbsp;&nbsp; '.$nombre_doc[0]['nomdoc'].'</td>
							</tr>
							<tr>
							<td width="117" style="font-weight:bold; border-bottom:1px solid;">Fecha(dd/mm/aaaa)</td>
							<td width="132" style="font-weight:bold; border-bottom:1px solid;">Número</td>
							<td width="158" style="font-weight:bold; border-bottom:1px solid;">Mov. Débito</td>
							<td width="158" style="font-weight:bold; border-bottom:1px solid;">Mov. Crédito</td>
							<td width="144" style="font-weight:bold; border-bottom:1px solid;">Nro. Egreso</td>
							<td width="194" style="font-weight:bold; border-bottom:1px solid;">Estado</td>
							</tr>';
					
					if($detalle!=false){
						foreach($detalle as $row2){
							$sumdebito = $sumdebito + $row2['debdcm'];
							$sumcredito = $sumcredito + $row2['credcm'];
							
							$debito = number_format($row2['debdcm'],2);
							$credito = number_format($row2['credcm'],2);
							
							if($tipo_consult == 'todos'){ $estado =  $row2['stdcmp'];}else{
							if($tipo_consult == 'revertidos'){ $estado ='Documento Revertido'; }else{
							if($row2['debdcm']==$row2['credcm']){ $estado ='Documento Cuadrado'; }
							else if($row2['debdcm']!=$row2['credcm']){ $estado ='Documento Descuadrado';}
							}}
							
				$cuerpo .= '<tr>
				<td width="117" style="height:20px;">'.$row2['fchcmp'].'</td>
				<td width="132" style="height:20px;"><a href="#" class="reimprimir" id="'.$row2['nrocmp'].'-'.$row['coddoc'].'-'.$row2['codsed'].'-'.$row2['agncnt'].'-'.$row2['mescnt'].'">'.$row2['nrocmp'].'</a></td>
				<td width="158" style="height:20px;">'.$debito.'</td>
				<td width="158" style="height:20px;">'.$credito.'</td>
				<td width="144" style="height:20px;">'.$row2['nroegr'].'</td>
				<td width="194" style="height:20px;">'.$estado.'</td>
				</tr>';
						}	
					}
					
				$cuerpo .= '<tr>';
				$cuerpo .= '<td colspan="2" align="right" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;">TOTAL FUENTE '.$row['coddoc'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$cuerpo .= '<td width="158" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;">'.number_format($sumdebito,2).'</td>';
				$cuerpo .= '<td width="158" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;">'.number_format($sumcredito,2).'</td>';
				$cuerpo .= '<td colspan="2" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;"></td>';
				$cuerpo .= '</tr>';	
			}
			
			$data['cabecera'] = $cabecera;
			$data['fecha1'] = $fecha1;
			$data['fecha2'] = $fecha2;
			$data['cuerpo'] = $cuerpo;
			$data['sede_v'] = $sede;
			$this->load->view('sirco/documento_contable/resumen_doc_reporte_v',$data);
			
		}else{
			echo "No se encontro resultado.";	
		}
	}
	
	function excel($doc1,$doc2,$fch1,$fch2,$nrocmp1,$nrocmp2,$anio,$codsed,$tipo_cons){
		$nombre = 'ResumenDocumentos'.date('d-m-Y');
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$nombre.xls");
		$fte1 = explode('-',$doc1);	
		$fte2 = explode('-',$doc2);
		
		$fecha1 =  date("d/m/Y",  strtotime($fch1));
		$fecha2 =  date("d/m/Y",  strtotime($fch2));
		
		$cabecera = $this->pr->cabecera_reporte();
		$cuerpo='';
		
		$nombre_sede = $this->sde->nombre_sede($sede);
		
		$cuerpo .= '<table width="905" cellpadding="0" cellspacing="0"style="font-size:12px;">';
		$cuerpo .= ' <tr>';
		$cuerpo .= '	<td colspan="6" style="border-top:1px solid">'.strtoupper($cabecera[0]['nomcia']).'</td>';
		$cuerpo .= '  </tr>';
		$cuerpo .= '  <tr>';
		$cuerpo .= '	<td colspan="6">DIRECCION: '.strtoupper($cabecera[0]['dircia']).'</td>';
		$cuerpo .= '  </tr>';
		$cuerpo .= '  <tr>';
		$cuerpo .= '	<td colspan="6">TELEFONO: '.strtoupper($cabecera[0]['telcia']).'</td>';
		$cuerpo .= '  </tr>';
		$cuerpo .= '  <tr>';
		$cuerpo .= '	<td colspan="6" style="border-bottom:1px solid">NIT: '.strtoupper($cabecera[0]['nitcia']).'</td>';
		$cuerpo .= '	 <tr>';
   		$cuerpo.= '<td colspan="6" style="padding-top:4px; padding-bottom:4px;">DESDE '.$fecha1.' HASTA '.$fecha2.'</td>';
  		$cuerpo .= '</tr>';
        $cuerpo .= '<tr>';
        $cuerpo .= '<td colspan="6" style="border-bottom:1px solid; padding-bottom:4px;">SEDE: '.$sede.' '.$nombre_sede[0]['nomsed'].'</td>';
        $cuerpo .= '</tr>';
		 
		if($tipo_cons=='cuadrados'){
			$condi = ' and debcmp=crecmp';	
		}else if($tipo_cons=='descuadrados'){
			$condi = ' and debcmp!=crecmp';	
		}else if($tipo_cons=='todos'){
			$condi='';
		}
		
		$res = $this->res_doc->obtener_documentos($fte1[0],$fte2[0],$fch1,$fch2,$nrocmp1,$nrocmp2,$anio,$codsed);
		if($res!=false){
						
			foreach($res as $row){
				$nombre_doc = $this->res_doc->nombre_doc($row['coddoc']);
				
				$sumdebito=0; $sumcredito=0; $estado='';
				$detalle=$this->res_doc->detalle($row['coddoc'],$fch1,$fch2,$nrocmp1,$nrocmp2,$anio,$codsed,$condi);
				
				$cuerpo .= '<tr>';
				$cuerpo .= '<td colspan="6" style="border-bottom:1px solid; padding-bottom:4px;">FUENTE: '.$row['coddoc'].' &nbsp;&nbsp; '.$nombre_doc[0]['nomdoc'].'</td>';
				$cuerpo .= '</tr>';
				
				$cuerpo .= '<tr>';
				$cuerpo .= '<td width="117" style="font-weight:bold; border-bottom:1px solid;" align="center">FECHA</td>';
				$cuerpo .= '<td width="132" style="font-weight:bold; border-bottom:1px solid;" align="center">NUMERO</td>';
				$cuerpo .= '<td width="158" style="font-weight:bold; border-bottom:1px solid;" align="center">MOV DEBITO</td>';
				$cuerpo .= '<td width="158" style="font-weight:bold; border-bottom:1px solid;" align="center">MOV CREDITO</td>';
				$cuerpo .= '<td width="144" style="font-weight:bold; border-bottom:1px solid;" align="center">NRO EGRESO</td>';
				$cuerpo .= '<td width="194" style="font-weight:bold; border-bottom:1px solid;" align="center"></td>';
			 	$cuerpo .= '</tr>';
					
					if($detalle!=false){
						foreach($detalle as $row2){
							$sumdebito = $sumdebito + intval($row2['debcmp']);
							$sumcredito = $sumcredito + intval($row2['crecmp']);
							
							$debito = $this->numletras->vmiles(intval($row2['debcmp']));
							$credito = $this->numletras->vmiles(intval($row2['crecmp']));
							
							$fecha3 =  date("d/m/Y",  strtotime($row2['fchcmp']));
							if($condi == 'revertidos'){ $estado ='Documento Revertido'; }else{
							if($row2['debcmp']==$row2['crecmp']){ $estado ='Documento Cuadrado'; }
							else if($row2['debcmp']!=$row2['crecmp']){ $estado ='Documento Descuadrado';}
							}
							$cuerpo .= '<tr>';
							$cuerpo .= '<td width="100" align="center">'.$fecha3.'</td>';
							$cuerpo .= '<td width="100" align="center">'.$row2['nrocmp'].'</td>';
							$cuerpo .= '<td width="170" align="center">'.$debito.'.00</td>';
							$cuerpo .= '<td width="170" align="center">'.$credito.'.00</td>';
							$cuerpo .= '<td width="130" align="center">'.$row2['nroegr'].'</td>';
							$cuerpo .= '<td width="194" align="center">'.$estado.'</td>';
							$cuerpo .= '</tr>';
						}	
					}
					
				$cuerpo .= '<tr>';
				$cuerpo .= '<td colspan="2" align="center" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;">TOTAL FUENTE '.$row['coddoc'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				$cuerpo .= '<td width="158" align="center" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;">'.$this->numletras->vmiles($sumdebito).'.00</td>';
				$cuerpo .= '<td width="158" align="center" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;">'.$this->numletras->vmiles($sumcredito).'.00</td>';
				$cuerpo .= '<td colspan="2" style="padding-top:5px; font-weight:bold; border-bottom:1px solid;"></td>';
				$cuerpo .= '</tr>';	
			}
		}
		
		echo ($cuerpo);		
	}
}