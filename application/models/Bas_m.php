<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bas_m extends CI_Model {	
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
	
	function consultar_group($campos,$tabla,$condicion,$group){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->group_by($group);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultar_group_orden($campos,$tabla,$condicion,$group,$orden){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->group_by($group);
		$this->db->order_by($orden);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultar_orden($campos,$tabla,$condicion,$orden){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->order_by($orden);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultar_like($campos,$tabla,$like){
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->like($like);
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
	
	function consultarf($campos,$tabla,$condicion){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$res = $this->db->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultarf_orden($campos,$tabla,$condicion,$orden){//
		$this->db->select($campos);
		$this->db->from($tabla);
		$this->db->where($condicion);
		$this->db->order_by($orden);
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
	
	function insert_ignorar($tabla,$data){
		$this->db->select('id_consentimiento');
		$this->db->from($tabla);
		$this->db->where($data);
		$res = $this->db->get();
		if($res->num_rows()>0){return true;}else{
		//$insert_query = $this->db->insert_string($tabla,$data);
		//$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
		//$this->db->query($insert_query);
		$this->db->insert($tabla,$data);
		
		if($this->db->affected_rows()){
				return true;
			}else {
				return false;	
			}	
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
	
	function firma($codhis,$codexa){//
		$this->db->select('cedula, medicos.nombre AS nommedico, medicos.rm, medicos.lc, historias.id_cliente, historias.nombre');
		$this->db->from('examen_lab_hist, medicos, historias');
		$this->db->where('historias.id_consentimiento=examen_lab_hist.id_consentimiento and examen_lab_hist.idmedi=medicos.cedula');
		$this->db->where('examen_lab_hist.id_examen_lab',$codexa);
		$this->db->where('examen_lab_hist.id_consentimiento',$codhis);
		$res = $this->db->get();
		//echo $this->db->last_query(); exit();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function historia($id_consentimiento){
		$this->db->select('id_cliente, nombre, nomempresal, nomempresa, antigu, edad, fecha, id_consentimiento, examen, sexo, ecargo, antigu');
		$this->db->from('historias');	
		$this->db->where('id_consentimiento',$id_consentimiento);
		$res=$this->db->get();
		//echo $this->db->last_query(); exit();
		return ($res->num_rows()>0)?$res->row_array():false;	
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
	
	function obtenerConsecutivo($string){
	 $sql = "select obtener_consecutivo(?,7)";
	 $res = $this->db->query($sql,array($string));
	 //echo $this->db->last_query();
	 return ($res->num_rows() >0) ? $res->row_array() : false;
	}
	
	function Consecutivo($string){
	 $sql = "select obtener_consecutivo(?,6)";
	 $res = $this->db->query($sql,array($string));
	 //echo $this->db->last_query();
	 return ($res->num_rows() >0) ? $res->row_array() : false;
	}
			
	
} 