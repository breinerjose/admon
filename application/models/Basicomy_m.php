<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basicomy_m extends CI_Model {	
	function __Construct(){
	   parent::__construct();
	    $this->my = $this->load->database('my', TRUE);
	}
	
	function consultar($campos,$tabla,$condicion){//
		$this->my->select($campos);
		$this->my->from($tabla);
		$this->my->where($condicion);
		$res = $this->my->get();
		//echo $this->my->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultar_order($campos,$tabla,$condicion,$order){//
		$this->my->select($campos);
		$this->my->from($tabla);
		$this->my->where($condicion);
		$this->my->order_by($order);
		$res = $this->my->get();
		//echo $this->my->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultarb($campos,$tabla,$condicion,$condicionb){//
		$this->my->select($campos);
		$this->my->from($tabla);
		$this->my->where($condicion);
		$this->my->where($condicionb);
		$res = $this->my->get();
		//echo $this->my->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultarf($campos,$tabla,$condicion){//
		$this->my->select($campos);
		$this->my->from($tabla);
		$this->my->where($condicion);
		$res = $this->my->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultarfb($campos,$tabla,$condicion,$condicionb){//
		$this->my->select($campos);
		$this->my->from($tabla);
		$this->my->where($condicion);
		$this->my->where($condicionb);
		$res = $this->my->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultar_historia($campos,$tabla,$condicion){//
		$this->my->select($campos);
		$this->my->from($tabla);
		$this->my->where($condicion);
		$res = $this->my->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	public function insertar($tabla,$data){$this->my->insert($tabla,$data);
	if($this->my->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function insert_ignorar($tabla,$data){
	$insert_query = $this->my->insert_string($tabla,$data);
	$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
    $this->my->query($insert_query);
	if($this->my->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}

	function actualizarr($tabla,$data,$condicion){
	$this->my->set($data);
	$this->my->where($condicion);
	$this->my->update($tabla);
	if($this->my->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizar($tabla,$data,$condicion){
	$this->my->set($data);
	$this->my->where($condicion);
	$this->my->update($tabla);
	//echo $this->my->last_query();
	if($this->my->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizarb($tabla,$data,$condicion,$condicionb){
	$this->my->set($data);
	$this->my->where($condicion);
	$this->my->where($condicionb);
	$this->my->update($tabla);
	if($this->my->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function firma($codhis,$codexa){//
		$this->my->select('cedula, medicos.nombre AS nommedico, medicos.rm, medicos.LC, historias.id_cliente, historias.nombre');
		$this->my->from('examen_lab_hist, medicos, historias');
		$this->my->where('historias.id_consentimiento=examen_lab_hist.id_consentimiento and examen_lab_hist.idmedi=medicos.cedula');
		$this->my->where('examen_lab_hist.id_examen_lab',$codexa);
		$this->my->where('examen_lab_hist.id_consentimiento',$codhis);
		$res = $this->my->get();
		//echo $this->my->last_query(); exit();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function historia($id_consentimiento){
		$this->my->select('id_cliente, nombre, nomempresal, nomempresa, antigu, edad, fecha, id_consentimiento, examen, sexo, ecargo, antigu');
		$this->my->from('historias');	
		$this->my->where('id_consentimiento',$id_consentimiento);
		$res=$this->my->get();
		//echo $this->my->last_query(); exit();
		return ($res->num_rows()>0)?$res->row_array():false;	
			}	

	function borrar($tabla,$condicion){
		$this->my->where($condicion);
		$this->my->delete($tabla);
		if($this->my->affected_rows()){
			return true;
		}else {
			return false;	
		}
	}			
	
} 