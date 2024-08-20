<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basico_m extends CI_Model {	
	function __Construct(){
	   parent::__construct();
	}
	
	function consultar($campos,$tabla,$condicion){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultarorder($campos,$tabla,$condicion,$order){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->order_by($order);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultargroup($campos,$tabla,$condicion,$group){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->group_by($group);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultarb($campos,$tabla,$condicion,$condicionb){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->where($condicionb);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	
	function consultarc($campos,$tabla){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$res = $this->db->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultarf($campos,$tabla,$condicion){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$res = $this->db->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultarfb($campos,$tabla,$condicion,$condicionb){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->where($condicionb);
		$res = $this->db->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultarlike($campos,$tabla,$condicion,$condicionb){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->like('codnif', $condicionb, 'afer');
		$res = $this->db->get();
		//echo $this->db->last_query();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultar_historia($campos,$tabla,$condicion){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$res = $this->db->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	public function insertar($tabla,$data){$this->db->insert($tabla,$data);
	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}

	function actualizarr($tabla,$data,$condicion){
	$this->db->set($data);
	$this->db->where($condicion);
	$this->db->update($tabla);
	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizar($tabla,$data,$condicion){
	$this->db->set($data);
	$this->db->where($condicion);
	$this->db->update($tabla);
	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizarb($tabla,$data,$condicion,$condicionb){
	$this->db->set($data);
	$this->db->where($condicion);
	$this->db->where($condicionb);
	$this->db->update($tabla);
	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	

	function borrar($tabla,$condicion){
		$this->db->where($condicion);
		$this->db->delete($tabla);
		if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}
	}			
	
} 