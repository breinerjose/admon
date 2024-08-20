<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Mnuhoriz_m extends CI_Model {
	
	function __Construct(){
	   parent::__construct();
	}	
	
	function items_principales($codusu){
	   $this->db->select('codapl, nomapl, clase');
	   $this->db->from('view_apl');
	   $condicion = array('codusu =' => $codusu);
	   $this->db->where($condicion);	
	   $res = $this->db->get();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
}	
?>