<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imprimir_doc_c extends CI_Controller {
	var $usuario;
	var $fecha;
	var $host;
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/imprimir_doc_m','imp',TRUE);
	      $this->load->model('sirco/Basico_m','bas',TRUE);
	   date_default_timezone_set("America/Bogota");
	   $this->load->library('numletras');
	   $this->load->helper(array('dompdf','siamenu' ));
	   $this->usuario = $this->session->userdata('codigo');
	   //$this->usuario = $_SESSION['usuario'];  
	   $this->fecha = date("Y-m-d h:i:s A");  
	   $this->host = $_SERVER['REMOTE_ADDR']; 
	 if($this->usuario == ''){ 
			echo  "<script language=\"JavaScript\">   alert(\"SU SESION A CADUCA INGRESE NUEVAMENTE\") </script>";
   			exit(); } 
	}
		
	//IMPRESION DEL COMPROBANTE	LOCAL
	function imprimir_doc($datos=''){
		$exp_dato = explode('-',$datos);
		$nrocmp=trim(urldecode($exp_dato[0]));   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		
		$cabecera = $this->imp->cabecera_empresa();
		$cabecera_doc = $this->imp->cabecera_doc($parametros);
		$detalle = $this->imp->detalle_local($parametros);
		$sum_cre_deb = $this->imp->sumatoria_por_local($parametros);
		$sum_cre_debn = $this->imp->sumatoria_por_nif($parametros);
		$data['cabecera'] = $cabecera;
		$data['cabecera_doc'] = $cabecera_doc;
		$data['detalle'] = $detalle;
		$data['sumdebito'] = number_format($sum_cre_deb[0]['sumdebito'],2);
		$data['sumcredito'] = number_format($sum_cre_deb[0]['sumcredito'],2);
		$data['sumdebiton'] = number_format($sum_cre_debn[0]['sumdebito'],2);
		$data['sumcrediton'] = number_format($sum_cre_debn[0]['sumcredito'],2);
		$data['nrocmp'] = $nrocmp;	
		
		if($detalle!=false){
			
			if(trim($cabecera_doc['nroegr']) == '' or $cabecera_doc['nroegr'] == '0'){$this->load->view('sirco/documento_contable/imprime_doc_v',$data);}
			else{
				$valor = $this->imp->sumatoria_por_local_cheque($parametros);
				$data['nroegr'] = $cabecera_doc['nroegr'];
				$data['nomtrc'] = $valor['nomtrc'];
				$data['fchchq'] = $valor['fchchq'];
				$data['valor_en_numeros'] = number_format($valor['valor'],2);
				$data['valor_en_letras'] =  $this->numletras->convertir($valor['valor']);
				$this->load->view('sirco/documento_contable/imprime_cheque_v',$data);}
		}else{
			echo "El n&uacute;mero del comprobante que digito es errado";	
		}
	}	
	
	//IMPRESION DEL COMPROBANTE	LOCAL
	function imprimir_doc_puntos($datos=''){
		$exp_dato = explode('-',$datos);
		$nrocmp=trim(urldecode($exp_dato[0]));   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		
		$cabecera = $this->imp->cabecera_empresa();
		$cabecera_doc = $this->imp->cabecera_doc($parametros);
		$detalle = $this->imp->detalle_local($parametros);
		$sum_cre_deb = $this->imp->sumatoria_por_local($parametros);
		$sum_cre_debn = $this->imp->sumatoria_por_nif($parametros);
		$data['cabecera'] = $cabecera;
		$data['cabecera_doc'] = $cabecera_doc;
		$data['detalle'] = $detalle;
		$data['sumdebito'] = number_format($sum_cre_deb[0]['sumdebito'],2);
		$data['sumcredito'] = number_format($sum_cre_deb[0]['sumcredito'],2);
		$data['sumdebiton'] = number_format($sum_cre_debn[0]['sumdebito'],2);
		$data['sumcrediton'] = number_format($sum_cre_debn[0]['sumcredito'],2);
		$data['nrocmp'] = $nrocmp;	
		
		if($detalle!=false){
			$this->load->view('sirco/documento_contable/imprime_doc_puntos_v',$data);
		}else{
			echo "El n&uacute;mero del comprobante que digito es errado";	
		}
	}	
	
	//IMPRESION DEL COMPROBANTE	LOCAL
	function imprime_doc_laser($datos){
	
		$exp_dato = explode('-',$datos);
		$nrocmp=trim(urldecode($exp_dato[0]));   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		$cabecera = $this->imp->cabecera_empresa();
		$cabecera_doc = $this->imp->cabecera_doc($parametros);
		$detalle = $this->imp->detalle_local($parametros);
		$sum_cre_deb = $this->imp->sumatoria_por_local($parametros);
		$sum_cre_debn = $this->imp->sumatoria_por_nif($parametros);
		$data['cabecera'] = $cabecera;
		$data['cabecera_doc'] = $cabecera_doc;
		$data['detalle'] = $detalle;
		$data['sumdebito'] = number_format($sum_cre_deb[0]['sumdebito'],2);
		$data['sumcredito'] = number_format($sum_cre_deb[0]['sumcredito'],2);
		$data['sumdebiton'] = number_format($sum_cre_debn[0]['sumdebito'],2);
		$data['sumcrediton'] = number_format($sum_cre_debn[0]['sumcredito'],2);
		$data['nrocmp'] = $nrocmp;	
$observ = $this->bas->consultarf('grado,grupo,codalm,nomalm,agnakd','view_sirco_detalle',array('nrocmp'=>$nrocmp,'coddoc'=>$coddoc,'codsed'=>$sede,'agncnt'=>$anio,'mescnt'=>$mes));
			//echo $this->db->last_query();
			$data['observ'] = $observ;
			if($coddoc == '06'){$this->db->query("SELECT pagos_recibidos('".$observ['agnakd']."','".$observ['grado']."','".$observ['grupo']."')");
			//echo $this->db->last_query();
			}
			$data['rowb'] = $this->bas->consultarf('*','ingpag',array('grado'=>$observ['grado'],'grupo'=>$observ['grupo'],'codalm'=>$observ['codalm']));
		
		if($detalle!=false){
			$this->load->view('sirco/documento_contable/imprime_doc_laser_v',$data);
		}else{
			echo "El n&uacute;mero del comprobante que digito es errado";	
		}
	
	}	
		
	//IMPRESION DEL COMPROBANTE	LOCAL
	function imprimir_doc_local($datos=''){
		$exp_dato = explode('-',$datos);
		$nrocmp=trim(urldecode($exp_dato[0]));   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		
		$cabecera = $this->imp->cabecera_empresa();
		$cabecera_doc = $this->imp->cabecera_doc_local($parametros);
		$detalle = $this->imp->detalle_local($parametros);
		$sum_cre_deb = $this->imp->sumatoria_por_local($parametros);
		$data['cabecera'] = $cabecera;
		$data['cabecera_doc'] = $cabecera_doc;
		$data['detalle'] = $detalle;
		$data['sumdebito'] = number_format($sum_cre_deb[0]['sumdebito'],2);
		$data['sumcredito'] = number_format($sum_cre_deb[0]['sumcredito'],2);
		$data['nrocmp'] = $nrocmp;	
		
		if($detalle!=false){
			
			if(trim($cabecera_doc['nroegr']) == '' or $cabecera_doc['nroegr'] == '0'){$this->load->view('sirco/documento_contable/imprime_doc_v',$data);}
			else{
				$valor = $this->imp->sumatoria_por_local_cheque($parametros);
				$data['nroegr'] = $cabecera_doc['nroegr'];
				$data['nomtrc'] = $valor['nomtrc'];
				$data['fchchq'] = $valor['fchchq'];
				$data['valor_en_numeros'] = number_format($valor['valor'],2);
				$data['valor_en_letras'] =  $this->numletras->convertir($valor['valor']);
				$this->load->view('sirco/documento_contable/imprime_cheque_v',$data);}
		}else{
			echo "El n&uacute;mero del comprobante que digito es errado";	
		}
	}
		//IMPRESION CHEQUE	
	function imprimir_doc_cheque($datos=''){
		$exp_dato = explode('-',$datos);
		$nrocmp=trim(urldecode($exp_dato[0]));   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		$cabecera = $this->imp->cabecera_empresa();
		$cabecera_doc = $this->imp->cabecera_doc($parametros);
		$detalle = $this->imp->detalle_local($parametros);
		$sum_cre_deb = $this->imp->sumatoria_por_local($parametros);
		$sum_cre_debn = $this->imp->sumatoria_por_nif($parametros);
		$data['cabecera'] = $cabecera;
		$data['cabecera_doc'] = $cabecera_doc;
		$data['detalle'] = $detalle;
		$data['sumdebito'] = number_format($sum_cre_deb[0]['sumdebito'],2);
		$data['sumcredito'] = number_format($sum_cre_deb[0]['sumcredito'],2);
		$data['sumdebiton'] = number_format($sum_cre_debn[0]['sumdebito'],2);
		$data['sumcrediton'] = number_format($sum_cre_debn[0]['sumcredito'],2);
		$data['nrocmp'] = $nrocmp;	
		if($detalle!=false and trim($cabecera_doc['nroegr']) != '' and $cabecera_doc['nroegr'] != '0'){
			$valor = $this->imp->sumatoria_por_local_cheque($parametros);
			$data['nroegr'] = $cabecera_doc['nroegr'];
			$data['nomtrc'] = $valor['nomtrc'];
			$data['fchchq'] = $valor['fchchq'];
			$data['valor_en_numeros'] = number_format($valor['valor'],2);
			$data['valor_en_letras'] =  $this->numletras->convertir($valor['valor']);
			$this->load->view('sirco/documento_contable/imprime_cheque_v',$data);		
		}else{
			echo "No se genero Cheque";	
		}		
	}
		
	//IMPRESION DEL COMPROBANTE	LOCAL
	function imprimir_doc_local_pdf(){
		$this->output->set_header('Content-type:application/json');
		$datos=$this->input->post('dato');
		$this->load->helper("file");
		$exp_dato = explode('-',$datos);
		$nrocmp=$exp_dato[0];   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		
		$cabecera = $this->imp->cabecera_empresa();
		$cabecera_doc = $this->imp->cabecera_doc_local($parametros);
		$detalle = $this->imp->detalle_local($parametros);
		$sum_cre_deb = $this->imp->sumatoria_por_local($parametros);
		$data['cabecera'] = $cabecera;
		$data['cabecera_doc'] = $cabecera_doc;
		$data['detalle'] = $detalle;
		$data['sumdebito'] = number_format($sum_cre_deb[0]['sumdebito'],2);
		$data['sumcredito'] = number_format($sum_cre_deb[0]['sumcredito'],2);
		$data['nrocmp'] = $nrocmp;	
		
		if($detalle!=false){
			//$this->load->view('sirco/doc_contable/pdf_doc_v',$data);
				delete_files('./res/sirco/pdf/');	
				$html = $this->load->view('sirco/documento_contable/pdf_doc_v',$data, TRUE);
				//crearPdf($html,'local'.'.pdf');	
				crearPdfSirco($html,$nrocmp.'.pdf');
				echo '{"err":"1"}';	
					
		}else{
			echo "El n&uacute;mero del comprobante que digito es errado";	
		}
	}
	
	//IMPRESION DEL COMPROBANTE	NIIF
	function imprimir_doc_nif($datos=''){
		$exp_dato = explode('-',$datos);
		$nrocmp=$exp_dato[0];   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		
		$cabecera = $this->imp->cabecera_empresa();
		$cabecera_doc = $this->imp->cabecera_doc_nif($parametros);
		$detalle = $this->imp->detalle_nif($parametros);
		$sum_cre_deb = $this->imp->sumatoria_por_nif($parametros);
		$data['cabecera'] = $cabecera;
		$data['cabecera_doc'] = $cabecera_doc;
		$data['detalle'] = $detalle;
		$data['sumdebito'] = number_format($sum_cre_deb[0]['sumdebito'],2);
		$data['sumcredito'] = number_format($sum_cre_deb[0]['sumcredito'],2);
		$data['nrocmp'] = $nrocmp;		
		
		if($detalle!=false){
			$this->load->view('sirco/documento_contable/imprime_doc_v',$data);		
		}else{
			echo "El n&uacute;mero del comprobante que digito es errado";	
		}
	}
	
	function cargarVistaPdf($nrocmp){
		$data['nrocmp']=$nrocmp;
		$this->load->view('/sirco/documento_contable/cargarPdf_v',$data);	
	}
        
        		
		//IMPRESION DEL COMPROBANTE	LOCAL
	function extracto($codalm,$agncnt,$grado,$grupo){
	if($agncnt > 2022){ $m1='Enero'; $m2='Febrero'; $m3='Marzo'; $m4='Abril'; $m5='Mayo'; $m6='Junio'; $m7='Julio'; $m8='Agosto'; $m9='Septiembre'; $m10='Octubre'; }else{
	$m1='Febrero'; $m2='Marzo'; $m3='Abril'; $m4='Mayo'; $m5='Junio'; $m6='Julio'; $m7='Agosto'; $m8='Septiembre'; $m9='Octubre'; $m10='Noviembre'; }
	$this->bas->borrar('ingpag',array('agncnt !='=>'0'));
	$sld=0;
	$msg = "Felicitaciones Usted Esta al Dia Con Sus Pagos";
		$data['cabecera'] = $this->imp->cabecera_empresa();
		$this->db->query("SELECT pagos_recibidos('".$agncnt."','".$grado."','".$grupo."')");
		
	$rowb = $this->bas->consultarf('*','ingpag',array('grado'=>$grado,'grupo'=>$grupo,'codalm'=>$codalm));
	
	$tabla ='
	<center><strong>EXTRACTO A CORTE '.date('Y-m-d H:i:s').'</strong></center>
	<br>
	<table width="800" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="100">&nbsp;&nbsp;Alumno:</td>
    <td width="700">&nbsp;&nbsp;'.$rowb['codalm'].' '.$rowb['nomalm'].'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Periodo:</td>
    <td>&nbsp;&nbsp;'.$rowb['agncnt'].'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Grado:</td>
    <td>&nbsp;&nbsp;'.$rowb['grado'].'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Grupo:</td>
    <td>&nbsp;&nbsp;'.$rowb['grupo'].'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Acudiente:</td>
    <td>&nbsp;&nbsp;'.$rowb['codtrc'].' '.$rowb['nomtrc'].'</td>
  </tr>
</table>
	<br>
	<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20%">&nbsp;&nbsp;Mes</td>
    <td width="15%">&nbsp;&nbsp;Valor a Pagar </td>
    <td width="15%">&nbsp;&nbsp;Dcto</td>
    <td width="15%">&nbsp;&nbsp;Abono</td>
    <td width="15%">&nbsp;&nbsp;Saldo</td>
	<td width="20%">&nbsp;&nbsp;Estado</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Matricula</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc01'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka01'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag01'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld01'],0).'</td>';
	if(date('n-d') >= '1-05' and $rowb['sld01'] > 0 ) { $sld += $rowb['sld01']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
   <tr>
    <td>&nbsp;&nbsp;'.$m1.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc02'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka02'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag02'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld02'],0).'</td>';
	if(date('n-d') >= '2-05'  and $rowb['sld02'] > 0 ) { $sld += $rowb['sld02']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m2.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc03'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka03'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag03'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld03'],0).'</td>';
	if(date('n-d') >= '3-05' and $rowb['sld03'] > 0 ) { $sld += $rowb['sld03']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m3.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc04'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka04'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag04'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld04'],0).'</td>';
	if(date('n-d') >= '4-05'  and $rowb['sld04'] > 0 ) { $sld += $rowb['sld04']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m4.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc05'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka05'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag05'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld05'],0).'</td>';
	if(date('n-d') >= '5-05'  and $rowb['sld05'] > 0 ) { $sld += $rowb['sld05']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m5.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc06'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka06'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag06'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld06'],0).'</td>';
	if(date('n-d') >= '6-05'  and $rowb['sld06'] > 0 ) { $sld += $rowb['sld06']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m6.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc07'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka07'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag07'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld07'],0).'</td>';
	if(date('n-d') >= '7-05'  and $rowb['sld07'] > 0 ) { $sld += $rowb['sld07']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m7.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc08'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka08'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag08'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld08'],0).'</td>';
	if(date('n-d') >= '8-05'  and $rowb['sld08'] > 0 ) { $sld += $rowb['sld08']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m8.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc09'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka09'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag09'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld09'],0).'</td>';
	if(date('n-d') >= '9-05' and $rowb['sld09'] > 0 ) { $sld += $rowb['sld09']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m9.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc10'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka10'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag10'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld10'],0).'</td>';
	if(date('m-d') >= '10-05'  and $rowb['sld10'] > 0 ) { $sld += $rowb['sld10']; $a="En Mora"; } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;'.$m10.'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['cxc11'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['bka11'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['pag11'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['sld11'],0).'</td>';
	if(date('m-d') >= '11-05'  and $rowb['sld11'] > 0 ) { $sld += $rowb['sld11']; $a="En Mora"; echo date('n-d'); } else{$a="";} 
	$tabla.='<td>&nbsp;&nbsp;'.$a.'</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Total</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['totcxc'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['totbka'],0).'</td>
	<td>&nbsp;&nbsp;$'.number_format($rowb['totpag'],0).'</td>
    <td>&nbsp;&nbsp;$'.number_format($rowb['totsld'],0).'</td>
	<td>&nbsp;&nbsp;</td>
  </tr>
</table>
<br>';
if($sld > 0){$msg='Usted Presenta Saldo en Mora Por Valor de '.number_format(round($sld),0);}
$tabla .='<center><strong>'.$msg.'</strong></center>';	  
		$data['tabla']=$tabla;
		if( $tabla != false){ $this->load->view('academico/web_imprimir_v',$data); }
		else{ echo "El n&uacute;mero del comprobante que digito es errado";	}
	}

}