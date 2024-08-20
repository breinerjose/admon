<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/puc_m','pm',TRUE);
           $this->load->model('sirco/Basico_m','bas',TRUE);
	   date_default_timezone_set("America/Bogota");
	}
	
	//Función para obtener información de una cuenta especifica
	function info_cta(){
		$datos = $this->datos_cuenta_po_id($this->input->post('codcta'));
		echo json_encode($datos);
	}
	
        function consultarItem(){
		$this->output->set_header('Content-type: application/json');
		$resp=$this->bas->consultarf('trim(coditm) as coditm, trim(nomitm) as nomitm','cntitm',array('trim(coditm)!='=>'','trim(coditm)'=>$this->input->post('coditm')));
                if($resp!=false){
			$out=array('err'=>'1','coditm'=>$resp['coditm'],'nomitm'=>encodeUtf8($resp['nomitm']));
			echo json_encode($out);
		}else echo '{"err":"0","msg":"este item no existe"}';
	}
	
}