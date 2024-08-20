<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Egresos_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/egresos_m','egr',TRUE);
	   date_default_timezone_set("America/Bogota");
	}
	
	function verificar_conceptos(){
		$res = $this->egr->verificar_conceptos($this->session->userdata('codigo'));
		if($res!=false){
			echo $res[0]['fchdcm'];	
		}else{
			echo 0;
		}	
	}
	
	function agregarConceptos(){
		$datos = explode('-',$this->input->post('ctaknp'));
		$codtrc = explode('-',$this->input->post('codtrc'));
		$ctaknp = $datos[0];
		$nombre = $datos[2];
		$vlrcta = $this->input->post('vlrcta');
		$fchdcm = $this->input->post('fecha');
		$addusr = $this->session->userdata('codigo');
		$addfch= date('Y-m-d');
		$res = $this->egr->agregarConceptos(trim($codtrc[0]),$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm);
		if($res == true){
		  echo '1';
		}else{
		  echo '0';
		}	
	}
	
	function agregarConceptos2(){
		$this->output->set_header('Content-type: application/json');
		$datos = explode('-',$this->input->post('ctaknp2'));
		$codtrc = explode('-',$this->input->post('codtrc'));
		$ctaknp = $datos[0];
		$nombre = $datos[2];
		$vlrcta = $this->input->post('vlrcta2');
		$fchdcm = $this->input->post('fecha');
		$addusr = $this->session->userdata('codigo');
		$addfch= date('Y-m-d');
		$res = $this->egr->agregarConceptos2(trim($codtrc[0]),$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm);
		if($res !=false){
		  echo '1';
		}else{
		  echo '0';
		}
	}
	 
	function sumatoria_creditoydebito(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->egr->sumatoria_creditoydebito($this->session->userdata('codigo'));	
		echo json_encode($res);
	}

}
?>