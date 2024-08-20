<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cargos_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('Basico_m','bas',	TRUE);
	}
	
	function vista($vista=''){
	$this->load->view($vista);
	}
	
	//chossen
	function Cargos(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->bas->consultar('carcod, cardes','funcar','delusr IS NULL and usuapr IS NOT NULL');
		//echo $this->db->last_query();
		$info=array();
		if($res!=false){ foreach($res as $row){ $info[]=array('carcod'=>$row['carcod'],'cardes'=>$row['cardes']); }
		echo json_encode($info); } else echo 1;	
	}
	
	//chossen
	function listado(){
		$this->output->set_header('Content-type:application/json');
		$output = array("aaData" => array());
		$resp = $this->bas->consultar('carcod, cardes','funcar','delusr IS NULL and usuapr IS NOT NULL');
		if($resp!=false){
			foreach($resp as $row){
				$output['aaData'][] = array(
			   $row['carcod'],$row['cardes'],
			   '<a class="btn btn-info btn-xs d" title="Editar" 
			   data-idc="'.$row['carcod'].'"
			   role="button" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>',
			   );
			}	
		}		
	    echo json_encode($output);		
	}
	
	function cargo_i(){
		$data['cardes'] = $this->security->xss_clean($this->input->post('cardes'));
		$data['usuapr'] = $this->session->userdata('user');
		//$data['addfch'] = date("Y-m-d H:i:s");
		$data['addusr'] = $this->session->userdata('user');
		$row=$this->bas->insertar('funcar',$data);
		if($row!=false){echo '{"err":"1"}';}else{echo '{"err":"0","msg":"hubo un error"}';}
	}
	
	function profesiogramai(){
		$this->output->set_header('Content-type:application/json');
		$output = array("aaData" => array());
 		$ale=$this->input->post('ale');
		$codexa=$this->security->xss_clean($this->input->post('codexa'));
	    $subgru=trim($this->security->xss_clean($this->input->post('subgru')));
		$codcar=$this->security->xss_clean($this->input->post('codcar'));
		$id_empresa=$this->security->xss_clean($this->input->post('id_empresa'));
		
		if ($codexa != 0){
		$data = array('codknp' => $codexa, 'codtip' => $subgru, 'codcrg' => $codcar, 'nricli' => $id_empresa);
		$this->db->insert('ocucliknp', $data);}	
		$condicion = array('codtip' => $subgru, 'codcrg' => $codcar, 'nricli' => $id_empresa);
		$resp=$this->bas->consultar('*','view_profesiograma',$condicion);
		if($resp!=false){
			foreach($resp as $row){
				$output['aaData'][] = array(
				
			   $row['nombre'],$row['subgru'],$row['cardes'],$row['examen_lab'],
			   '<a class="btn btn-default btn-xs borrar'.$ale.'" title="BORRAR" data-codpro="'.$row['codpro'].'"
			   role="button" href="javascript:void(0);"><i class="fa fa-trash"></i> </a> '
			   	  
			   );
			}	
		}		
	    echo json_encode($output);
		}
		
		function profesiogramad(){
		$this->output->set_header('Content-type: application/json');
		$codpro=$this->input->post('codpro');
		$this->db->delete('ocucliknp', array('codpro' => $codpro)); 
		echo '1';
	}
		
	
}