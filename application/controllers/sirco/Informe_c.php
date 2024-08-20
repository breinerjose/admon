<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informe_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/informe_m','info',TRUE);
	   $this->load->model('sirco/Basico_m', 'bas', TRUE);
        date_default_timezone_set("America/Bogota");
	}
	function cargarVistaInforme(){
		$this->load->view('sirco/informeTercero_v');	
	}
	function cargarVista($vista,$campo1,$campo2=false){
		$data['campo1']=$campo1;
		$data['campo2']=$campo2;
		$this->load->view('sirco/'.$vista,$data);	
	}
		 function consultarTerceros(){
         $output = array("aaData" => array());
         $offset = $this->input->post('offset');
         $filtro = $this->input->post('filtro');
         $res = $this->info->consultarTerceros($offset,$filtro);
         foreach($res as $row){
            $output["aaData"][] = array(trim($row->codtrc),
                             utf8_encode(trim($row->nomtrc)),                                     
                                        '<input type="radio" name="cuenta" nombre="'.utf8_encode(trim($row->nomtrc)).'"  class="seleccion" codigo="'.trim($row->codtrc).'">');
         }
         echo json_encode($output);
     }
	 	function selecionarProveedor(){   
        $nombre = decodeUtf8($this->input->post('nombre'));
        $res = $this->info->selecionarProveedor($nombre);
        $proveedores = array();
        foreach($res->result() as $row){
            array_push($proveedores,array("label" => '('.$row->codtrc.') '.encodeUtf8($row->nomtrc), "value" => $row->codtrc));
        }
        echo json_encode($proveedores);
    }
	function selecionarCentroCosto(){   
        $nombre = decodeUtf8($this->input->post('nombre'));
        $res = $this->info->selecionarCentroCosto($nombre);
        $proveedores = array();
        foreach($res->result() as $row){
            array_push($proveedores,array("label" => '('.$row->codcts.') '.encodeUtf8($row->nomcts), "value" => $row->codcts));
        }
        echo json_encode($proveedores);
    }
	 
	 	function obtener_centro_c(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->info->obtener_centro_c();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   		"<a href='javascript:void(0);' class='cod' id='".trim($row['codcts'])."' nombre='".encodeUtf8($row['nomcts'])."'>".$row['codcts']."</a>",
					encodeUtf8($row['nomcts'])
				);
			}	
		}echo json_encode($output);
	}
	
	 function listadoAuxilares(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->info->listadoAuxilares();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   		"<a href='javascript:void(0);' class='cod' id='".trim($row['codaux'])."' nombre='".encodeUtf8($row['nomaux'])."'>".$row['codaux']."</a>",
					encodeUtf8($row['nomaux'])
				);
			}	
		}echo json_encode($output);
	}
	
	function imprimirReporte($fecha1,$fecha2,$codcta1,$codcta2,$agnpsp,$codcts1,$codcts2,$codtrc1,$codtrc2,$codaux1,$codaux2){
		$out='';
		$cta=$this->info->cuentasAsociadas($fecha1,$fecha2,$codcta1,$codcta2,$agnpsp,$codcts1,$codcts2,$codtrc1,$codtrc2,$codcts1,$codcts2,$codaux1,$codaux2);
		$resp=$this->info->detallereporte($fecha1,$fecha2,$codcta1,$codcta2,$agnpsp,$codcts1,$codcts2,$codtrc1,$codtrc2,$codcts1,$codcts2,$codaux1,$codaux2);
		if($cta!=false){
			foreach($cta as $c){
			 $out.= '<hr/>Cuenta:'.$c['codcta'].' '.$c['nomcta'].'</hr>';
			 $out.=  '<table width="100%" border="0" class="cuentas" cellpadding="0" cellspacing="0">
			 		<thead>
						<tr>
							<th width="15%">Fecha - Fte - Nro </th>
							<th width="40%">Detalle</th>
							<th width="15%">Mov. Debito</th>
							<th width="15%">Mov. Credito</th>
							<th width="15%">Saldo Actual</th>
						</tr>
					</thead>
					<tbody>';
						foreach($resp as $row){
						if($row['codcta']==$c['codcta']){
						$out.=  '<tr>
									<td>'.encodeUtf8($row['serial']).'</td>
									<td>'.encodeUtf8($row['detalle']).'</td>
									<td>'.$row['debdcm'].'</td>
									<td>'.$row['serial'].'</td>
							  </tr>';	
						}
						}
					$out.=  '</tbody>
			 </table>';	
			}
			
		}
		$data['html']=$out;
		$this->load->view('/sirco/informeCuentas_v',$data);
	}
	
	function selecionarCuentas(){   
        $nombre = decodeUtf8($this->input->post('nombre'));
        $res = $this->info->selecionarCuentas($nombre);
        $proveedores = array();
        foreach($res->result() as $row){
            array_push($proveedores,array("label" => '('.$row->codcta.') '.encodeUtf8($row->nomcta),
			 "value" => $row->codcta,"codnif"=>$row->codnif,"nomnif"=>encodeUtf8($row->nomnif)));
        }
        echo json_encode($proveedores);
    }
	function cargarDatosCuenta(){
		$this->output->set_header('Content-type: application/json');
		$codcta=$this->input->post('codcta');
		$resp=$this->info->cargarDatosCuenta($codcta);	
		if($resp!=false){
			$out=array('codcta'=>$resp['codcta'],'nomcta'=>utf8_encode($resp['nomcta']),
			'codnif'=>$resp['codnif'],'nomnif'=>utf8_encode($resp['nomnif']),'porcta'=>$resp['porcta'],'err'=>'1');
			echo json_encode($out);
		}else echo '{"err":"0","msg":"no hay una cuenta asociada a su busqueda"}';
	}
		
		function cargarDatosProvedor(){
		$this->output->set_header('Content-type: application/json');
		$condi=array('codtrc'=>$this->input->post('codtrc'));
		$resp=$this->bas->consultarf('trim(codtrc) as codtrc, trim(nomtrc) as nomtrc','cnttrc',$condi);	
		if($resp!=false){
			$out=array('codtrc'=>$resp['codtrc'],'nomtrc'=>utf8_encode($resp['nomtrc']),'err'=>'1');
			echo json_encode($out);
		}else echo '{"err":"0","msg":"no hay una tercero asociado a la busqueda"}';
	}

}