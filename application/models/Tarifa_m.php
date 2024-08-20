<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tarifa_m extends CI_Model {
	
	function __Construct(){
	   parent::__construct();
	}
	
	function agregartarifa($codcli,$codexa,$precio){
		$sql = "INSERT INTO tarifa (id_cliente,	id_examen_lab,precio) VALUES (?,?,?);";
		$res = $this->db->query($sql,array($codcli,$codexa,$precio));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function clientes(){
		$this->db->select('trim(id_cliente) codcli, trim(nombre) nomcli');
		$this->db->where('empresa','si');
		$this->db->order_by('nomcli'); 
		$res=$this->db->get('terceros');
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function examenes(){
		$sql = "select id_examen_lab codexa, trim(examen_lab) nomexa from examen_lab";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function tarifas(){
			$sql1 = "select tarifa.id_cliente codcli, nombre nomcli, tarifa.id_examen_lab codexa, examen_lab nomexa, tarifa.precio 
			from tarifa, terceros, examen_lab
			WHERE tarifa.id_cliente::character varying=terceros.id_cliente 
			AND tarifa.id_examen_lab=examen_lab.id_examen_lab::character varying and tarifa.id_cliente !='0'";
			$result1 = $this->db->query($sql1);
			if($result1->num_rows() > 0){
				return $result1->result_array();
				}
				else{return FALSE;}
			}
			
			function actualizar_tarifa($datos){
		$sql = "UPDATE tarifa SET precio=? WHERE id_cliente=? and id_examen_lab=?;";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	function porcentaje($codcli){
		$this->db->select('precio,id_examen_lab');
		$this->db->where('id_cliente',$codcli); 
		$res=$this->db->get('tarifa');
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}
		}
	
}	