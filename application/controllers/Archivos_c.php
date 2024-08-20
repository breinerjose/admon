<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//we need to call PHP's session object to access it through CI
class Archivos_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	 // $this->load->helper('archivos');
	 //  $this->load->model('archivos_m','arc',TRUE);//modelo, alias, verdadero cargue modelo 
	   $this->load->model('basico_m','bas',TRUE);//modelo, alias, verdadero cargue modelo 
	}
	
	function index(){
	exit();
	}	
	
function eliminar(){
		$condicion['token'] = $this->security->xss_clean($this->input->post('token'));
		$data=array('stdarc'=>'inactivo');
		$row=$this->bas->actualizar('archivos',$data,$condicion);
		if($row!=false){echo '{"err":"1"}';}else{echo '{"err":"0","msg":"hubo un error"}';}
	}	
		  
}