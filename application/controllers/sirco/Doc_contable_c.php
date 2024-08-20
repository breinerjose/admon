<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Doc_contable_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/doc_contable_m','doc',TRUE);
	   $this->load->model('sirco/puc_m','puc',TRUE);
	   $this->load->model('sirco/ingresos_m','pr',TRUE);
	   date_default_timezone_set("America/Bogota");
	   $this->load->library('numletras');
	}
	
	function cargar_vista($nombre=''){ 
		$this->load->view("sirco/doc_contable/".$nombre); 
	}
	
	function llenar_tabla(){//revisado
		$this->output->set_header('Content-type: application/json');
		$identificacion = $_SESSION['usuario'];
		$res = $this->doc->datos_tabla($identificacion);
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array($row['codcta'],$row['detdcm'],$row['debdcm'],$row['credcm'],
					"<a href='#' title='Eliminar Datos'  class='elim'  data-ide='".$row['codigo']."'> 
					<img src='".base_url()."recursos/imagenes/eliminar.png' width='48' height='24' /></a >&nbsp;&nbsp;&nbsp;");
			}	
		}echo json_encode($output);
	}
	
	function documentos(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->doc->documentos();
		if($res!=false){
			echo json_encode($res);	
		}else{
			echo 0;	
		}
	}
	
	function complete_centro_costo(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->puc->obtener_centro_c();
		echo json_encode($res);	
	}
	
	function auxiliar(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->doc->auxiliar();
		if($res!=false){
			echo json_encode($res);	
		}else{
			echo 0;	
		}
	}
	
	
		function cuentas_detalle(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->doc->cuentas_detalle();
		if($res!=false){
			echo json_encode($res);	
		}else{
			echo 0;	
		}
	}
	
	function agregar_doc(){
		$detalle='';
		$agnakd = $this->input->post('agnakd');
		$prdakd = $this->input->post('prdakd');
		$cuenta = explode('-',$this->input->post('cuenta'));
		$tercero = explode('-',$this->input->post('tercero'));
		$fecha = explode('-',$this->input->post('fecha'));
		
		$tipo_cuenta = $this->input->post('tip_cuenta');
		
		$nro_egreso='';
		
		if($this->input->post('numero_de_egreso')==''){ 
			$nro_egreso = '0'; 
		}else{ 
			$nro_egreso = $this->input->post('numero_de_egreso');
		}
		
		$chequeado = $this->input->post('check');
		
		if($chequeado=='chequeado'){
			$detalle = $agnakd."/".$prdakd." ".$this->input->post('concepto');
		}else { $detalle = $this->input->post('concepto'); }
		
		if($tipo_cuenta=='Debito'){
			$datos = array(
				$fecha[0],$fecha[1],$this->input->post('tipo_doc'),$cuenta[0],$tercero[0],$detalle,$this->input->post('valor'),0,$_SESSION['usuario'],date('Y-m-d'),$this->input->post('agnakd'),$this->input->post('prdakd'),$this->input->post('sede'),'Pen-doc',$this->input->post('fecha'),$nro_egreso);
		}else if($tipo_cuenta=='Credito'){
			$datos = array(
				$fecha[0],$fecha[1],$this->input->post('tipo_doc'),$cuenta[0],$tercero[0],$detalle,0,$this->input->post('valor'),$_SESSION['usuario'],date('Y-m-d'),$this->input->post('agnakd'),$this->input->post('prdakd'),$this->input->post('sede'),'Pen-doc',$this->input->post('fecha'),$nro_egreso);
		}
		
		$res = $this->doc->agregar_doc($datos);
		if($res!=false){
			echo 0;	
		}else{
			echo 1;	
		}
	}
	
	function sumatoria_creditoydebito(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->doc->sumatoria_creditoydebito($_SESSION['usuario']);
		echo json_encode($res);
	}
	
	function consultarDatos($a,$b,$c,$d,$e,$f,$g){
		$this->output->set_header('Content-type: application/json');
		$output = array("aaData" => array());
		if($a==0 && $b==0 && $c==0 && $d==0 && $e==0 && $f==0 && $g==0){
			echo json_encode($output);
		}else{
			$a = ($a=='0')?'':$a; $b = ($b=='0')?'':$b;
			$c = ($c=='0')?'':$c; $d = ($d=='0')?'':$d;
			$e = ($e=='0')?'':$e; $f = ($f=='0')?'':$f;
			$g = ($g=='0')?'':$g;
			$res = $this->doc->consultarDatos($a,$b,$c,$d,$e,$f,$g);
			
			if ($res != false){
				 foreach ($res as $row){
				   $output['aaData'][] = array('<a href="#" id="'.$row['nrocmp'].'_'.$row['coddoc'].'_'.$row['codsed'].'_'.$row['agncnt'].'_'.$row['mescnt'].'" class="nrocmp">'.$row['nrocmp'].'</a>',$row['agncnt'],$row['mescnt'],$row['coddoc'],$row['nomtrc'],$row['fchcmp'],"<a href='#' title='Editar'  class='editar' data-ide='".$row['nrocmp']."'><img src='".base_url()."recursos/imagenes/edit.png' width='16' height='16' /></a >&nbsp;&nbsp;<a href='#' title='Eliminar Datos'  class='elim'  data-ide='".$row['nrocmp']."'><img src='".base_url()."recursos/imagenes/eliminar.png' width='16' height='16' /></a >&nbsp;&nbsp;&nbsp;");
				}	
			}
			echo json_encode($output);
		}			
	}
	
	
	function consultarDatos_lim($a,$b,$d,$e){
		$this->output->set_header('Content-type: application/json');
		$output = array("aaData" => array());
		if($a==0 && $b==0 && $d==0 && $e==0){
			echo json_encode($output);
		}else{
			$a = ($a=='0')?'':$a;
			$b = ($b=='0')?'':$b;
			$d = ($d=='0')?'':$d;
			$e = ($e=='0')?'':$e;
			$res = $this->doc->consultarDatos_lim($a,$b,$d,$e,$_SESSION['usuario']);
			
			
			if ($res != false){
				 foreach ($res as $row){
				   $output['aaData'][] = array('<a href="#" id="'.$row['nrocmp'].'-'.$row['coddoc'].'-'.$row['codsed'].'-'.$row['agncnt'].'-'.$row['mescnt'].'" class="nrocmp">'.		                   $row['nrocmp'].'</a>',
				   $row['fchcmp'],$row['crecmp'],$row['debcmp'],$row['nomsed'],$row['nomtrc'],$row['nomsed']);
				}	
			}
			echo json_encode($output);
		}			
	}
	
	
	function tabla_busqueda($datosbusqueda){
		$this->output->set_header('Content-type: application/json');
		$output = array("aaData" => array());
		if($datosbusqueda!=0){
			$exp_dato = explode('-',$datosbusqueda);
			$nrocmp=$exp_dato[0];   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
			
			$datos = array($nrocmp,$coddoc,$sede,$anio,$mes);
			$res = $this->doc->tabla_busqueda($datos);
			if ($res != false){
				 foreach ($res as $row){
					 $output['aaData'][] = array(trim($row['codcta']),trim($row['detdcm']),trim($row['debdcm']),trim($row['credcm']));
				}	
			}
		}
		echo json_encode($output);	
	}
	
	function sumatoria_por_nrocmp(){
		$this->output->set_header('Content-type: application/json');
		$datosbusqueda = $this->input->post('data_busqueda');
		if($datosbusqueda!=0){
			$exp_dato = explode('_',$datosbusqueda);
			$nrocmp=$exp_dato[0];  $sede=$exp_dato[4];  $anio=$exp_dato[1];  $mes=$exp_dato[2]; $coddoc=$exp_dato[3];
			$datos = array($nrocmp,$sede,$anio,$mes,$coddoc);
			$res = $this->pr->sumatoria_por_nrocmp2($datos);
			$sumadebito = $this->numletras->vmiles(intval($res[0]['sumdebito']));
			$sumcredito = $this->numletras->Vmiles(intval($res[0]['sumcredito']));
			$datos = array(array('sumdebito'=>$sumadebito,'sumcredito'=>$sumcredito));
			echo json_encode($datos);
		}else{ echo 0;}
	}
	
	function revertir_doc($datos=''){
		$exp_dato = explode('-',$datos);
		$nrocmp=$exp_dato[0];   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		$datos = array($nrocmp,$coddoc,$sede,$anio,$mes);
		$fechas = array($anio,$mes);
		if($this->pr->verificar_fecha_contabilizacion($fechas)!=false){
			if($this->doc->revertir('cntcmp','stdcmp',$datos)!=false){
				echo "Docmento Revertido Correctamente";
			}else{
				echo 1;	
			}
		}else{
			echo 1;	
		}
	}
	
	function agregar_doc_contable(){
		$consecutivo='';
		$sumdebito = $this->input->post('sumdebito');
		$sumcredito = $this->input->post('sumcredito');
		$mes = $this->input->post('mes');
		$anio = $this->input->post('anio');
		$addfch = $this->input->post('addfch');
		$addusr=$_SESSION['usuario'];
		$fchdcm = $this->input->post('fchdcm');
		$codsed=$this->input->post('sede');
		$coddoc = $this->doc->obtener_cod_documento($addusr);	
		
		$nro_egreso="";			
		
		$obtener_consecutivo = $this->pr->consecutivo_ingreso($coddoc,$mes,$anio,$codsed);
		
		$respuesta_nroegreso = $this->doc->obtener_nroregeso($addusr);
		if($respuesta_nroegreso!=false){
			if($respuesta_nroegreso!=0){ $nro_egreso = $respuesta_nroegreso; }	
		}
		
		if($obtener_consecutivo!=''){ 
			$consecutivo = $obtener_consecutivo; 
			$datos_detalle = array($anio,$mes, $consecutivo, 'Generado', $addfch, $addusr);
			$datos_cabecera = array($anio,$mes,$coddoc,$fchdcm,$consecutivo,'Generado',$sumdebito,$sumcredito,$addusr,$addfch,$codsed,$nro_egreso);
			
			$actualizar_detalles = $this->doc->actualizar_detalle($datos_detalle);
			
			if($actualizar_detalles!=false){
				$this->doc->agregar_cabecera($datos_cabecera);	
				echo $consecutivo."-".$codsed."-".$anio."-".$mes."-".$coddoc;
			}else{
				echo '0';
			}	
		}
	}
	
	function agregar_doc_contable2(){
		$consecutivo='';
		$sumdebito = $this->input->post('sumdebito');
		$sumcredito = $this->input->post('sumcredito');
		$addusr=$_SESSION['usuario'];
		$codsed=$this->input->post('sede');
		
		$obtener_datos = $this->doc->obtener_datos($addusr);
		$mes = $obtener_datos[0]['mescnt'];
		$anio = $obtener_datos[0]['agncnt'];
		$fchdcm = $obtener_datos[0]['fchdcm'];		
		$addfch =$obtener_datos[0]['addfch'];
		
		$coddoc = $this->doc->obtener_cod_documento($addusr);	
		
		$nro_egreso="";			
		
		$obtener_consecutivo = $this->pr->consecutivo_ingreso($coddoc,$mes,$anio,$codsed);
		
		$respuesta_nroegreso = $this->doc->obtener_nroregeso($addusr);
		if($respuesta_nroegreso!=false){
			if($respuesta_nroegreso!=0){ $nro_egreso = $respuesta_nroegreso; }	
		}
		
		if($obtener_consecutivo!=''){ 
			$consecutivo = $obtener_consecutivo; 
			$datos_detalle = array($anio,$mes, $consecutivo, 'Generado', $addfch, $addusr);
			$datos_cabecera = array($anio,$mes,$coddoc,$fchdcm,$consecutivo,'Generado',$sumdebito,$sumcredito,$addusr,$addfch,$codsed,$nro_egreso);
			
			$actualizar_detalles = $this->doc->actualizar_detalle($datos_detalle);
			
			if($actualizar_detalles!=false){
				$this->doc->agregar_cabecera($datos_cabecera);	
				echo $consecutivo."-".$codsed."-".$anio."-".$mes."-".$coddoc;
			}else{
				echo '0';
			}	
		}
	}
	
	function reporte($datos=''){
		$exp_dato = explode('-',$datos);
		$nrocmp=$exp_dato[0];  $sede=$exp_dato[1];  $anio=$exp_dato[2];  $mes=$exp_dato[3]; $coddoc=$exp_dato[4];
		
		$res = $this->doc->obtener_coddoc_reporte(array($anio,$mes,$coddoc,$nrocmp,$sede)); 
		if($res!=false){
			if($res[0]['coddoc']=='02'){
				$parametros = array($nrocmp,$sede,$anio,$mes,$coddoc);
			
				$cabecera = $this->pr->cabecera_reporte();
				$detalle = $this->doc->detalle_cheque($parametros);
				$nom_trc = $this->doc->nombre_tercero($nrocmp,$sede,$anio,$mes,$coddoc);
				$elaborado = $this->pr->elaborado_por($parametros);
				$sum_cre_deb = $this->pr->sumatoria_por_nrocmp2($parametros);
				
				$valor=0;
				
				$obtener_cuentas_y_credito = $this->doc->obtener_cuentas($anio,$mes,$coddoc,$nrocmp,$sede);
				if($obtener_cuentas_y_credito!=false){
					
					foreach($obtener_cuentas_y_credito as $row){
						$verificar_impuesto = $this->doc->verificar_si_impuesto($row['codcta']);
						
						if($verificar_impuesto==0){
							if($verificar_impuesto!=1){
								$valor = $valor + $row['credcm']; 	
							}
						}
					}
				}
				
				$data['cabecera'] = $cabecera;
				$data['detalle'] = $detalle;
				$data['elaborado'] = $elaborado;
				$data['nom_trc'] = $nom_trc;
				$data['sum_debito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumdebito']));
				$data['sum_credito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumcredito']));
				$data['nrocmp'] = $nrocmp;		
				$data['titulo'] =  $res[0]['nomdoc'];			
				$data['coddoc'] =  $coddoc;
				$data['valor_en_numeros'] = $this->numletras->vmiles(intval($valor));
				$data['valor_en_letras'] =  $this->numletras->convertir($valor);
				
				if($detalle!=false){
					$this->load->view('sirco/doc_contable/cheque',$data);		
				}else{
					echo "El n&uacute;mero del comprobante que digito es errado";	
				}
			}else{
				$parametros = array($nrocmp,$sede,$anio,$mes,$coddoc);
				$cabecera = $this->pr->cabecera_reporte();
				$detalle = $this->pr->detalle_reportes($parametros);
				$elaborado = $this->pr->elaborado_por($parametros);
				$sum_cre_deb = $this->pr->sumatoria_por_nrocmp2($parametros);
				$data['cabecera'] = $cabecera;
				$data['detalle'] = $detalle;
				$data['elaborado'] = $elaborado;
				$data['sum_debito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumdebito']));
				$data['sum_credito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumcredito']));
				$data['nrocmp'] = $nrocmp;		
				$data['titulo'] =  $res[0]['nomdoc'];			
				$data['coddoc'] =  $coddoc;
				
				if($detalle!=false){
					$this->load->view('sirco/doc_contable/reportes',$data);		
				}else{
					echo "El n&uacute;mero del comprobante que digito es errado";	
				}
			}
		}
	}
	
	//funcion para boton imprimir
	function reporte2($datos=''){
		$exp_dato = explode('_',$datos);
		$nrocmp=$exp_dato[0];  $sede=$exp_dato[4];  $anio=$exp_dato[1];  $mes=$exp_dato[2]; $coddoc=$exp_dato[3];
		
		$res = $this->doc->obtener_coddoc_reporte(array($anio,$mes,$coddoc,$nrocmp,$sede)); 
		if($res!=false){
			if($res[0]['coddoc']==='02'){
				$parametros = array($nrocmp,$sede,$anio,$mes,$coddoc);
			
				$cabecera = $this->pr->cabecera_reporte();
				$detalle = $this->doc->detalle_cheque($parametros);
				$nom_trc = $this->doc->nombre_tercero($nrocmp,$sede,$anio,$mes,$coddoc);
				$elaborado = $this->pr->elaborado_por($parametros);
				$sum_cre_deb = $this->pr->sumatoria_por_nrocmp2($parametros);
				
				$valor=0;
				
				$obtener_cuentas_y_credito = $this->doc->obtener_cuentas($anio,$mes,$coddoc,$nrocmp,$sede);
				if($obtener_cuentas_y_credito!=false){
					
					foreach($obtener_cuentas_y_credito as $row){
						$verificar_impuesto = $this->doc->verificar_si_impuesto($row['codcta']);
						
						if($verificar_impuesto==0){
							if($verificar_impuesto!=1){
								$valor = $valor + $row['credcm']; 	
							}
						}
					}
				}
				
				$data['cabecera'] = $cabecera;
				$data['detalle'] = $detalle;
				$data['elaborado'] = $elaborado;
				$data['nom_trc'] = $nom_trc;
				$data['sum_debito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumdebito']));
				$data['sum_credito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumcredito']));
				$data['nrocmp'] = $nrocmp;		
				$data['titulo'] =  $res[0]['nomdoc'];			
				$data['coddoc'] =  $coddoc;
				$data['valor_en_numeros'] = $this->numletras->vmiles(intval($valor));
				$data['valor_en_letras'] =  $this->numletras->convertir($valor);
				
				if($detalle!=false){
					$this->load->view('sirco/doc_contable/cheque',$data);		
				}else{
					echo "El n&uacute;mero del comprobante que digito es errado";	
				}
			}else{
				$parametros = array($nrocmp,$sede,$anio,$mes,$coddoc);
			
				$cabecera = $this->pr->cabecera_reporte();
				$detalle = $this->pr->detalle_reportes($parametros);
				$elaborado = $this->pr->elaborado_por($parametros);
				$sum_cre_deb = $this->pr->sumatoria_por_nrocmp2($parametros);
				$data['cabecera'] = $cabecera;
				$data['detalle'] = $detalle;
				$data['elaborado'] = $elaborado;
				$data['sum_debito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumdebito']));
				$data['sum_credito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumcredito']));
				$data['nrocmp'] = $nrocmp;		
				$data['titulo'] =  $res[0]['nomdoc'];			
				$data['coddoc'] =  $coddoc;
				
				if($detalle!=false){
					$this->load->view('sirco/doc_contable/reportes',$data);		
				}else{
					echo "El n&uacute;mero del comprobante que digito es errado";	
				}
			}			
		}
	}
	
	function verificar_si_tiene_doc(){
		$this->output->set_header('Content-type: application/json');
		$identificacion = $_SESSION['usuario'];
		$res = $this->doc->verificar_si_tiene_doc($identificacion);
		if($res!=false){
			echo json_encode($res);
		}else{ echo 1;}
	}
	
	//Obtener ultimo numero de egreso
	function obtenerNumEgreso(){
		$nregreso = $this->doc->obtenerNumEgreso();
		echo ($nregreso+1);
	}
	
	function vista_editar_doc($datos){ 
		$exp_dato = explode('-',$datos);
		$nrocmp=$exp_dato[0];   $coddoc=$exp_dato[1]; $sede=$exp_dato[2];  $anio=$exp_dato[3];  $mes=$exp_dato[4];
		
		$parametros = array($nrocmp,$coddoc,$sede,$anio,$mes);
		$res = $this->doc->datos_a_editar($parametros);
		$datos_fijos = $this->doc->datos_fijos($parametros);
		$sumatoria_debcred = $this->doc->suma_debcred_editar($parametros);
		$data['datos_docu'] = $res;
		$data['datos_fijos'] = $datos_fijos;
		$data['nrocmp'] = $nrocmp;
		$data['sede'] = $sede;
		$data['anio'] = $anio;
		$data['mes'] = $mes;
		$data['coddoc'] = $coddoc;
		$data['sumatoria_debcred'] = $sumatoria_debcred;
		
		$this->load->view("sirco/doc_contable/editar_doc2",$data); 
	}
	
	function guardar_edicion_doc(){
		$nrocmp=$this->input->post('nrocmp');
		$sede=$this->input->post('sede');
		$anio=$this->input->post('anio');
		$mes=$this->input->post('mes'); 
		$coddoc=$this->input->post('coddoc');
		$nroegr=$this->input->post('nroegr'); 
		$fchcmp=$this->input->post('fchcmp');
		$sumdebito=$this->input->post('sumdebito'); 
		$sumcredito=$this->input->post('sumcredito');
		$addusr = $_SESSION['usuario'];
		$addfch = date('Y-m-d');
		
		//actualizaciones
		$this->doc->actualizar_cntdcm(array($nrocmp,$coddoc,$sede,$anio,$mes));
		$this->doc->actualizar_cntcmp(array($sumdebito,$sumcredito,$anio,$mes,$coddoc,$nrocmp,$sede));
		
		//inserciones				
		$auxiliar2 = $this->input->post('auxiliar');
		$c_costo2 = $this->input->post('c_costo');		
		$concepto = $this->input->post('concepto');
		$credito = $this->input->post('credito');		
		$cuenta2 = $this->input->post('cuenta');
		$debito = $this->input->post('debito');	
		
		$agnakd = $this->input->post('agnakd');	
		$prdakd = $this->input->post('prdakd');	
		$trc2 = $this->input->post('trc');		
		
		$chequeado = $this->input->post('check');
		
		for($i=0; $i < count($auxiliar2); $i++){
			$codauxiliar = explode('-',$auxiliar2[$i]);
			$c_costo = explode('-',$c_costo2[$i]);
			$cuenta = explode('-',$cuenta2[$i]);			
			$tercero = explode('-',$trc2[$i]);
			
			if(isset($chequeado[$i])){
				$datos = array(
					$anio,$mes,$coddoc,$nrocmp,'Generado',$cuenta[0],$tercero[0],$c_costo[0],$agnakd[$i]."/".$prdakd[$i]." ".$concepto[$i],$debito[$i],$credito[$i],$addusr,$addfch,($i+1),$fchcmp,$codauxiliar[0],$fchcmp,$sede,$agnakd[$i],$prdakd[$i]);	
			}else{
				$datos = array(
					$anio,$mes,$coddoc,$nrocmp,'Generado',$cuenta[0],$tercero[0],$c_costo[0],$concepto[$i],$debito[$i],$credito[$i],$addusr,$addfch,($i+1),$fchcmp,$codauxiliar[0],$fchcmp,$sede,$agnakd[$i],$prdakd[$i]);
			}
			
			$res = $this->doc->agregar_doc2($datos);
		}
		
		if($res!=false){ 
			echo 1;
		 } else{ echo 0;}
	}
	
	/*FUNCION PARA REPORTE DE RESUMEN DE DOCUMENTO
	function reporte_resumen_documento($datos=''){
		$exp_dato = explode('_',$datos);
		$nrocmp=$exp_dato[0];  $sede=$exp_dato[4];  $anio=$exp_dato[1];  $mes=$exp_dato[2]; $coddoc=$exp_dato[3];
		
		$parametros = array($nrocmp,$sede,$anio,$mes,$coddoc);
		
		$res = $this->doc->obtener_coddoc_reporte(array($anio,$mes,$coddoc,$nrocmp,$sede));	
		
		$cabecera = $this->doc->cabecera_reporte();
		$detalle = $this->doc->detalle_reportes($parametros);
		$elaborado = $this->doc->elaborado_por($parametros);
		$sum_cre_deb = $this->doc->sumatoria_por_nrocmp2($parametros);
		$data['cabecera'] = $cabecera;
		$data['detalle'] = $detalle;
		$data['elaborado'] = $elaborado;
		$data['sum_debito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumdebito']));
		$data['sum_credito'] = $this->numletras->vmiles(intval($sum_cre_deb[0]['sumcredito']));
		$data['nrocmp'] = $nrocmp;		
		$data['titulo'] =  $res[0]['nomdoc'];			
		$data['coddoc'] =  $coddoc;
		
		if($detalle!=false){
			$this->load->view('sirco/doc_contable/reportes',$data);		
		}else{
			echo "El n&uacute;mero del comprobante que digito es errado";	
		}
	}*/
	
	}
?>	