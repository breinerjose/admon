<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centro_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/centro_m','ctc',TRUE);
	   date_default_timezone_set("America/Bogota");
	}
	
	function vista_buscar($nombre=''){
		$this->load->view("sirco/centros_costos/".$nombre);
	}
	
	//chossen
	function centro_costo(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->ctc->centro_costo();
		$info=array();
		if($res!=false){
			foreach($res as $row){
				$info[]=array('codcts'=>$row['codcts'],'nomcts'=>encodeUtf8($row['nomcts']));
			}
		echo json_encode($info);
		}else{
			echo 1;	
		}
	}
	
	//datatable informacion de centros de costo
	function centros_costos(){
	   $this->output->set_header('Content-type: application/json');
		$res = $this->ctc->centro_costo();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   "<a href='javascript:void(0);' class='cod' id='".$row['codcts']."'>".$row['codcts']."</a>",encodeUtf8($row['nomcts'])
			   );
			}
		}
		echo json_encode($output);
	}
        
        function consultarCentroCosto(){
		$this->output->set_header('Content-type: application/json');
		$resp=$this->Bas_m->consultarf('trim(codcts) as codcts, trim(nomcts) as nombre','cntcts',array('trim(nomcts)!='=>'','trim(codcts)!='=>'','trim(codcts)'=>$this->input->post('codcts')));
		if($resp!=false){
			$out=array('err'=>'1','codcts'=>$resp['codcts'],'nombre'=>encodeUtf8($resp['nombre']));
			echo json_encode($out);
		}else echo '{"err":"0","msg":"este centro de costo no existe"}';
	}
	
}