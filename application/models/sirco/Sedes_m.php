<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sedes_m extends CI_Model {
	
	var $invsed = 'invsed', $actcia='actcia';
	
	function __Construct(){
	   parent::__construct();
	}
	
	function obtener_sedes(){
		$sql = "select trim(codsed) codsed,trim(nomsed) nomsed,dirsed from ".$this->invsed."";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function agregar_sedes($datos){
		$sql = "INSERT INTO ".$this->invsed." (codsed, nomsed, dirsed) VALUES (obtener_consecutivo('SEDE',3), ?, ?);";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	function datos_sedes($codsed){
		$sql = "select trim(codsed) codsed, trim(nomsed) nomsed,dirsed from ".$this->invsed." where trim(codsed)=?";
		$res = $this->db->query($sql,array($codsed));
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function actualizar_sedes($datos){
		$sql = "UPDATE ".$this->invsed." SET nomsed=?, dirsed=? WHERE codsed=?";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	function eliminar_sedes($codsed){
		$sql = "DELETE FROM ".$this->invsed." WHERE codsed=?;";
		$this->db->query($sql,array($codsed));
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	function cabecera_reportes(){
		$sql = "select trim(nomcia) nomcia,trim(dircia) dircia,trim(telcia) telcia from ".$this->actcia."";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function reporte(){
		$sql = "select trim(codsed) codsed, trim(nomsed) nomsed from ".$this->invsed."; ";
		$res = $this->db->query($sql);
		if($res->result_array()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	//function consultar infomacio
	function selectsedes($codigo){
	  $sql= "SELECT distinct(view_sirco_sedes.codsed), view_sirco_sedes.nomsed FROM view_sirco_sedes, cntper
	  		WHERE cntper.codsed=view_sirco_sedes.codsed AND cntper.modifi='1' AND cntper.codusu=?";
	  $res = $this->db->query($sql,$codigo);
	 //echo $this->db->last_query();
	  return ($res->num_rows() >0)? $res->result_array():false;
	}
}