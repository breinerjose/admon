<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentas_c extends CI_Controller {
	
	var $usuario;
	var $fecha;
	var $host;
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/cuentas_m','cta',TRUE);
	   $this->load->model('Basico_m', 'bas', TRUE);
	   $this->usuario = $this->session->userdata('codigo');	
	   $this->fecha = date("Y-m-d h:i:s A");  
	   $this->host = $_SERVER['REMOTE_ADDR'];
	   $this->load->helper(array('siamenu')); 
	}
	
	function vista_buscar($nombre=''){ 
		$this->load->view("sirco/cuentas/".$nombre);
	}
	
	function vista($nombre=''){ 
		$this->load->view("sirco/cuentas/".$nombre);
	}
	
	//chossen
	function cuentas_cta(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->cta->cuentas_cta();
		$info=array();
		if($res!=false){			
			foreach($res as $row){
				$info[]=array('codcta'=>$row['codcta'],'nomcta'=>encodeUtf8($row['nomcta']));
			}
		echo json_encode($info);
		}
		else echo 1;	
		
	}
	
	//chossen
	function cuentas_nif(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->cta->cuentas_nif();
		$info=array();
		if($res!=false){
			foreach($res as $row){
				$info[]=array('codnif'=>$row['codnif'],'nomnif'=>encodeUtf8($row['nomnif']));
			}
		echo json_encode($info);
		}else{
			echo 1;	
		}
	}
	
	function obtener_cuentas_Niff(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->cta->obtener_cuentas_Niff();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			  "<a href='javascript:void(0);' class='cod' nivel='".trim($row['nivcta'])."' codnif='".trim($row['codnif'])."' nomnif='".encodeUtf8($row['nomnif'])."' >".$row['codnif']."
			  </a>",
					encodeUtf8($row['nomnif']),
					$row['nivcta']
				);
			}	
		}echo json_encode($output);
	}
	
	//datatable
	function cuentas_cta_detalle(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->cta->cuentas_cta();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   		"<a href='javascript:void(0);' class='cod' nom='".encodeUtf8(trim($row['nomcta']))."' id='".trim($row['codcta'])."'>".$row['codcta']."</a>",
					encodeUtf8($row['nomcta'])
				);
			}	
		}
		echo json_encode($output);
	}
	
	//datatable
	function cuentas_nif_detalle(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->cta->cuentas_nif();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   		"<a href='javascript:void(0);' class='cod' nom='".encodeUtf8(trim($row['nomnif']))."' id='".trim($row['codnif'])."' por='".trim($row['porcta'])."'>".$row['codnif']."</a>",
					encodeUtf8($row['nomnif'])
				);
			}	
		}
		echo json_encode($output);
	}
		function informacionCuentasnif(){
	    $this->output->set_header('Content-type: application/json');
		$res = $this->cta->informacionCuentas();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array($row['codcta'],encodeUtf8($row['nombre']),$row['codnif'],encodeUtf8($row['nomnif']),
			   "<a href='javascript:void(null);' title='agregar'  class='add' data-id ='".$row['codcta']."' data-porcta='".$row['porcta']."' data-nom ='".encodeUtf8($row['nombre'])."' data-codnif='".$row['codnif']."' data-nomnif='".encodeUtf8($row['nomnif'])."'> 
			   <img src='/res/icons/sirco/add2.png' /></a >");
			}
		}
		echo json_encode($output);
	}
	
	//chossen
	function cuentas_creditos(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->cta->cuentas_creditos();
		$info=array();
		if($res!=false){			
			foreach($res as $row){
				$info[]=array('codcta'=>$row['codcta'],'nomcta'=>encodeUtf8($row['nomcta']));
			}
		echo json_encode($info);
		}
		else echo 1;	
		
	}
	
	
	//chossen
	function cuentas_debitos(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->cta->cuentas_debitos();
		$info=array();
		if($res!=false){			
			foreach($res as $row){
				$info[]=array('codcta'=>$row['codcta'],'nomcta'=>encodeUtf8($row['nomcta']));
			}
		echo json_encode($info);
		}
		else echo 1;	
		
	}
	
}