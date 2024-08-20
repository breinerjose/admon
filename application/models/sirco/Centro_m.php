<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centro_m extends CI_Model {

	function __Construct(){
	 parent:: __construct();
	}
	
	function centro_costo(){
		$sql = "select codcts, nomcts from cntcts";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
}