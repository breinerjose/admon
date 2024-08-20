<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estados_financieros_m extends CI_Model {
	
	
	function __Construct(){
	 	parent:: __construct();		
	}
	
	function combo_balance($tipo){
		$sql = "SELECT trim(codbal) codbal, trim(nombal) nombal FROM cntbal WHERE tipbal=? ORDER BY codbal";
		$res = $this->db->query($sql,array($tipo));
		//echo $this->db->last_query();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
}
//breiner lopez ver 1 estados_m