<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodos_cont_m extends CI_Model {
	
	var $cntprd = 'cntprd';
	
	function __Construct(){
		parent:: __construct();
	}
	
	function periodos(){
		$sql = "select * from ".$this->cntprd."";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
			return $result->result_array();
		}
		else{return false;}	
	}
	
	function filtro_por_anio($anio){
		$sql = "select agncnt,mescnt,stdprd from ".$this->cntprd." where agncnt=? order by mescnt";
		$result = $this->db->query($sql,array($anio));
		if($result->num_rows() > 0){
			return $result->result_array();
		}
		else{return false;}	
	}
	
	function actualizar_estado($datos){
		$sql = "UPDATE ".$this->cntprd." SET stdprd=? WHERE agncnt=? AND mescnt=?;";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){return true;}else{return false;}	
	}
	
	function cerrar_anio_contable($datos){
		$sql = "UPDATE ".$this->cntprd." SET stdprd='Cerrado' WHERE agncnt=?;";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){return true;}else{return false;}	
	}
	
	function verificar_fecha_contabilizacion($datos){
		$sql = "select * from cntprd where agncnt=? and mescnt=? and trim(stdprd)='Abierto'";
		$result = $this->db->query($sql,$datos);
		if($result->num_rows() > 0){
			return true;
		}
		else{return false;}		
	}
}