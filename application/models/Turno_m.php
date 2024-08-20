<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Turno_m extends CI_Model {    
	//metodo de construct
	function __construct(){
	parent:: __construct();
	 
	}
	
		function listadobrigadas(){
		$this->db->select('id_consentimiento, id_cliente, nombre, fecha, token, id_empresa, consecutivos, nomempresa');
		$this->db->from('historias');
		$this->db->where('estado','activo');
		$this->db->where('brigada','si');
		$res=$this->db->get();
		//echo $this->db->last_query();
		//exit();
		return ($res->num_rows()>0)?$res->result_array():false;		
	}
	
	function llamarbrigada($id_consentimiento,$idmedi,$examenes){
	
	}
	
}