<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basicocon_m extends CI_Model {	
	function __Construct(){
	   parent::__construct();
	    $this->co = $this->load->database('co', TRUE);
	}
	
	function consultar($campos,$tabla,$condicion){//
		$this->co->select($campos);
		$this->co->from($tabla);
		$this->co->where($condicion);
		$res = $this->co->get();
		//echo $this->co->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultar_order($campos,$tabla,$condicion,$order){//
		$this->co->select($campos);
		$this->co->from($tabla);
		$this->co->where($condicion);
		$this->co->order_by($order);
		$res = $this->co->get();
		//echo $this->co->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultarb($campos,$tabla,$condicion,$condicionb){//
		$this->co->select($campos);
		$this->co->from($tabla);
		$this->co->where($condicion);
		$this->co->where($condicionb);
		$res = $this->co->get();
		//echo $this->co->last_query(); exit();
		if($res->num_rows()>0){return $res->result_array();}else{return false;}
	}
	
	function consultarf($campos,$tabla,$condicion){//
		$this->co->select($campos);
		$this->co->from($tabla);
		$this->co->where($condicion);
		$res = $this->co->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultarfb($campos,$tabla,$condicion,$condicionb){//
		$this->co->select($campos);
		$this->co->from($tabla);
		$this->co->where($condicion);
		$this->co->where($condicionb);
		$res = $this->co->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function consultar_historia($campos,$tabla,$condicion){//
		$this->co->select($campos);
		$this->co->from($tabla);
		$this->co->where($condicion);
		$res = $this->co->get();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	public function insertar($tabla,$data){$this->co->insert($tabla,$data);
	if($this->co->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function insert_ignorar($tabla,$data){
	$insert_query = $this->co->insert_string($tabla,$data);
	$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
    $this->co->query($insert_query);
	if($this->co->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}

	function actualizarr($tabla,$data,$condicion){
	$this->co->set($data);
	$this->co->where($condicion);
	$this->co->update($tabla);
	if($this->co->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizar($tabla,$data,$condicion){
	$this->co->set($data);
	$this->co->where($condicion);
	$this->co->update($tabla);
	//echo $this->co->last_query();
	if($this->co->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizar_trim($tabla,$condicion){
	$con=array('nrocmp' => 'trim(nrocmp)', 'artcod' => 'trim(artcod)', 'artser' => 'trim(artser)');
	$this->co->set($con);
	$this->co->where($condicion);
	$this->co->update($tabla);
	//echo $this->co->last_query();
	if($this->co->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizarb($tabla,$data,$condicion,$condicionb){
	$this->co->set($data);
	$this->co->where($condicion);
	$this->co->where($condicionb);
	$this->co->update($tabla);
	if($this->co->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function firma($codhis,$codexa){//
		$this->co->select('cedula, medicos.nombre AS nommedico, medicos.rm, medicos.LC, historias.id_cliente, historias.nombre');
		$this->co->from('examen_lab_hist, medicos, historias');
		$this->co->where('historias.id_consentimiento=examen_lab_hist.id_consentimiento and examen_lab_hist.idmedi=medicos.cedula');
		$this->co->where('examen_lab_hist.id_examen_lab',$codexa);
		$this->co->where('examen_lab_hist.id_consentimiento',$codhis);
		$res = $this->co->get();
		//echo $this->co->last_query(); exit();
		if($res->num_rows()>0){return $res->row_array();}else{return false;}
	}
	
	function historia($id_consentimiento){
		$this->co->select('id_cliente, nombre, nomempresal, nomempresa, antigu, edad, fecha, id_consentimiento, examen, sexo, ecargo, antigu');
		$this->co->from('historias');	
		$this->co->where('id_consentimiento',$id_consentimiento);
		$res=$this->co->get();
		//echo $this->co->last_query(); exit();
		return ($res->num_rows()>0)?$res->row_array():false;	
			}	

	function borrar($tabla,$condicion){
		$this->co->where($condicion);
		$this->co->delete($tabla);
		if($this->co->affected_rows()){
			return true;
		}else {
			return false;	
		}
	}			
	
} 