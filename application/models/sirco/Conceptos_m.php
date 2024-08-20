<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conceptos_m extends CI_Model {
	
	var $actknp = 'actknp', $cntcta ='cntcta';
	
	function __Construct(){
	 parent:: __construct();
	}
	
	function obtener_conceptos(){
		$sql = "SELECT k.codknp, k.nomknp, c.nomcta, k.tpoknp FROM ".$this->actknp." k, ".$this->cntcta." c WHERE trim(k.ctaknp)=trim(c.codcta) ORDER BY codknp";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function complet_conceptos(){
		$sql = "select trim(codcta) codcta,trim(nomcta) nomcta from cntcta where estado='Generado' and nivcta='5' order by codcta;";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function datos_editar($codknp){
		$sql = "SELECT a.codknp, a.nomknp, a.ctaknp, c.nomcta, a.tpoknp FROM ".$this->actknp." a, ".$this->cntcta." c WHERE trim(a.ctaknp)=trim(c.codcta) and trim(a.codknp)=?";	
		$resultado = $this->db->query($sql,array($codknp));
		if($resultado->num_rows()>0){
			return $resultado->result_array();	
		}else{
			return false;	
		}
	}
	
	function agregar_conceptos($datos){
		$sql = "INSERT INTO actknp (codknp, nomknp, ctaknp, tpoknp, vlrknp) VALUES               (obtener_consecutivo('CONCEPTO',3),?,?,?,?);";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	function actualizar_conceptos($datos){
		$sql = "UPDATE ".$this->actknp." SET nomknp=?, ctaknp=?, tpoknp=? WHERE codknp=?";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}		
	}
	
	function eliminar_conceptos($codknp){
		$sql = "DELETE FROM actknp WHERE codknp=?;";
		$this->db->query($sql,array($codknp));
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	function reporte($ordenarpor){
		$sql = "select trim(codknp) codknp,trim(nomknp) nomknp,trim(tpoknp) tpoknp,trim(ctaknp) ctaknp from actknp order by codknp ASC";
		$res = $this->db->query($sql);
		if($res->result_array()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}	
}