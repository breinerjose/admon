<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terceros_c extends CI_Controller {
	   function __Construct(){
	   parent::__construct();
	   $this->load->model('Terceros_m','ter',TRUE);
	   $this->load->model('Basico_m','bas',TRUE);
	   $this->load->helper('form');
	   $this->load->helper('url');
	   $this->load->library('upload');	
	   /* if($this->session->userdata('user') == ''){ 
			echo  "<script language=\"JavaScript\">   alert(\"SU SESION A CADUCA INGRESE NUEVAMENTE\") </script>";
			exit(); }*/
	}
	
		
		function terceros(){
		$this->output->set_header('Content-type:application/json');
		$output = array("aaData" => array());
		$resp=$this->bas->consultar('*','cnttrc',array('codtrc !=' =>NULL));
		if($resp!=false){
			foreach($resp as $row){
				$output['aaData'][] = array(
			   $row['codtrc'],$row['nomtrc'],$row['ip'],$row['mac'],$row['celtrc'],$row['valpla'],$row['stdusr'],
			   '<a class="btn btn-info btn-xs d" title="Editar" 
               data-ip="'.$row['ip'].'"
               data-mac="'.$row['mac'].'"
			   data-fecafl="'.$row['fecafl'].'"
			   data-idc="'.$row['codtrc'].'"
			   data-tip="'.$row['tpodoc'].'" 
			   data-fij="'.$row['teltrc'].'" 
			   data-mov="'.$row['celtrc'].'" 
			   data-dir="'.$row['dirtrc'].'" 
			   data-ema="'.$row['emltrc'].'" 
			   data-nom="'.$row['nomtrc'].'" 
			   stdusr="'.$row['stdusr'].'" 
			   valpla="'.$row['valpla'].'" 
			   role="button" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>',
			   );
			}	
		}		
	    echo json_encode($output);
	}

		function consultarterceros(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->ter->consultarterceros();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array($row['id'],$row['nombre']);
			}	          
		}
		echo json_encode($output);
	}

	
	function terceros_u(){
		$condicion=array('codtrc' => $this->security->xss_clean($this->input->post('id_cliente')));
		$condicionb=array('nriper' => $this->security->xss_clean($this->input->post('id_cliente')));
		$data['tpodoc'] = $this->security->xss_clean($this->input->post('nom_tipidentificacion'));
		$data['teltrc'] = $this->security->xss_clean($this->input->post('telefono_fijo'));
		$data['celtrc'] = $this->security->xss_clean($this->input->post('telefono_movil'));
	  	$data['dirtrc'] = $this->security->xss_clean($this->input->post('direccion'));
		$data['emltrc'] = $this->security->xss_clean($this->input->post('email'));
		$data['nomtrc'] = $this->security->xss_clean($this->input->post('nombre'));
		$data['valpla'] = $this->security->xss_clean($this->input->post('valpla'));
		$data['stdusr'] = $this->security->xss_clean($this->input->post('stdusr'));
        $data['ip'] = $this->security->xss_clean($this->input->post('ip'));
        $data['mac'] = $this->security->xss_clean($this->input->post('mac'));
		$data['fecafl'] = $this->security->xss_clean($this->input->post('fecafl'));
		//
		$datab['clave'] = $this->security->xss_clean($this->input->post('clave'));
		if($datab['clave'] != ''){
		$datac['pssusr'] = md5($datab['clave']);
		$datac['nriper'] = $this->security->xss_clean($this->input->post('id_cliente'));
		$ress=$this->bas->consultarf('nriper','actusr',$condicionb);
		if($ress == false){
		$this->bas->insertar('actusr',$datac);
		}else{$this->bas->actualizar('actusr',$datac,$condicionb);
		}
	    }		
		$row=$this->bas->actualizar('cnttrc',$data,$condicion);
		//echo $this->db->last_query();
		echo '{"err":"1"}';
	}
	
	
	public function terceros_i()
	{
		$data['codtrc'] = $this->security->xss_clean($this->input->post('id_cliente'));
		$data['tpodoc'] = $this->security->xss_clean($this->input->post('nom_tipidentificacion'));
		$data['nomuno'] = $this->security->xss_clean($this->input->post('primer_nombre'));
		$data['nomdos'] = $this->security->xss_clean($this->input->post('segundo_nombre'));
		$data['apeuno'] = $this->security->xss_clean($this->input->post('primer_apellido'));
		$data['apedos'] = $this->security->xss_clean($this->input->post('segundo_apellido'));
		$data['teltrc'] = $this->security->xss_clean($this->input->post('telefono_fijo'));
		$data['celtrc'] = $this->security->xss_clean($this->input->post('telefono_movil'));
	  	$data['dirtrc'] = $this->security->xss_clean($this->input->post('direccion'));
		$data['emltrc'] = $this->security->xss_clean($this->input->post('email'));
		$data['nomtrc'] = $this->security->xss_clean($this->input->post('nombre'));
		$data['valpla'] = $this->security->xss_clean($this->input->post('valpla'));
		$data['stdusr'] = $this->security->xss_clean($this->input->post('stdusr'));
        $data['ip'] = $this->security->xss_clean($this->input->post('ip'));
        $data['mac'] = $this->security->xss_clean($this->input->post('mac'));
		$data['fecafl'] = $this->security->xss_clean($this->input->post('fecafl'));
		//echo "Controler";
		$row=$this->bas->insertar('cnttrc',$data);
		if($row!=false){echo '{"err":"1"}';}else{echo '{"err":"0","msg":"hubo un error"}';}
	}
	
	
	public function terceros_empresa_labora()
	{
		$data['id_cliente'] = date("ymdhis");		
		$data['nombre'] = $this->security->xss_clean($this->input->post('empresa'));
		$data['empresa'] = 'si';
		$row=$this->bas->insertar('terceros',$data);
		if($row!=false){echo '{"err":"1","codemplab":"'.$data['id_cliente'].'"}';}else{echo '{"err":"0","msg":"hubo un error"}';}
	}
	
	function tip_ide(){
	$this->output->set_header('Content-type:application/json');
	$res=$this->ter->tip_ide($this->security->xss_clean($this->input->post('tipper')));
	if($res!=false){
	$output["a"]=$res;
	$output["e"] = array("err"=>"1");
	}else{
	$output["e"] = array("err"=>"0");
	}
	 echo json_encode($output);
	}
	
	
	  function totales() {
        $this->output->set_header('Content-type: application/json');
        $condicion = array('stdusr' => 'Activo');
        $res = $this->bas->consultarf('sum(valpla) total', 'cnttrc', $condicion);
        $output["a"] = array('total' => number_format($res['total'],0,",","."));
        echo json_encode($output);
    }
 }