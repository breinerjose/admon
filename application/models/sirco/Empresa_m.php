<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_m extends CI_Model {
	
	function __Construct(){
	 parent:: __construct();
	}
	
	//CONSULTAS PARA GENERAR REPORTE
	function cabecera_empresa(){
		$sql = "SELECT codcia, nomcia, telcia, dircia, nitcia, ciucia, msgcia FROM actcia";	
		$res = $this->db->query($sql);
		//echo $this->db->last_query();
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}
	
	function rep_legal(){
		$sql = "select nomper|| ' ' ||apeper as nomper from actper, actcia where trim(nriper) = trim(actcia.rpscia)";	
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}	
	
	function contadora(){
		$sql = "select nomper|| ' ' || apeper as nomper, tpccia from actper, actcia where trim(nriper) = trim(actcia.cntcia)";	
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}
	
	function rep_fiscal(){
		$sql = "select trim(nomper)|| ' ' ||trim(apeper) as nomper, tprcia from actper, actcia where trim(nriper) = trim(actcia.rvfcia)";	
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}
	
	
	}	