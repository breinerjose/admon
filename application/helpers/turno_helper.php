<?php  
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
	
	function examenes_medico($idmedi){
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->select('id_exa');
		$ci->db->from('medexa');
		$ci->db->where('id_medi','73214641');
		$res=$ci->db->get();
		//echo $ci->db->last_query();
		//exit();
		if($res->num_rows()>0){
		$res->roww_array();
		$sw=0;
		$examenes = "(";
		foreach($res as $row){
		print_r($row);
		if($sw == 0){$examenes .="id_examen_lab = ".$row['id_exa']; $sw =$sw+1;}else{$examenes .=" or id_examen_lab = ".$row['id_exa'];}
		}$examenes .= ")";
		return $examenes;
		}else{return false;}
	}