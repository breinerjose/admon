<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Login_m extends CI_Model {
	function __Construct(){
	   parent::__construct();
	}
	
	function logueo($nriper,$pssusr,$estusr){
	$this->db->select('nomtrc, codsed');
	$this->db->from('view_user');
	$condicion = array('nriper' => $nriper, 'pssusr' => $pssusr, 'estusr' => $estusr);
	$this->db->where($condicion);	
	$res = $this->db->get();
	    //echo $this->db->last_query();
		//exit();
	 if($res->num_rows() > 0){
	    return $res->row_array();
		//return $res->row();
	 }else{
	   return false;
	 }
	}
	
	function items_principales($codusu){
	   $this->db->select('DISTINCT(codapl), nomapl, clase');
	   $this->db->from('view_opciones');
	   $condicion = array('codusu =' => $codusu);
	   $this->db->where($condicion);	
	   $res = $this->db->get();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	
	function concultarOpciones($codusu){
	  $this->db->select('DISTINCT(codapl), nomapl, clase');
	   $this->db->from('view_opciones');
	   $condicion = array('codusu =' => $codusu);
	   $this->db->where($condicion);
	   $this->db->where('item ','2');	
	   $res = $this->db->get();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
   }
   
  function subOpciones($codusu, $codapl){
   	   $this->db->select('codapl, codpag, nompag, urlpag, ancho, alto, orden, nivper, item');
	   $this->db->from('view_opciones');
  		$condicion = array('codusu =' => $codusu, 'codapl=' => $codapl);
		$this->db->where('item ','2');
	   $this->db->where($condicion);	
	    $res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	  }  

}
?>