<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentas_m extends CI_Model {

	function __Construct(){
	 parent:: __construct();
	}
	
	function cuentas_cta(){
		$sql = "select trim(codcta) codcta, trim(nomcta) nomcta from cntcta Where trim(tpocta) = 'Detalle' ORDER BY codcta";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function cuentas_nif(){
		$sql = "select codnif, nomnif, porcta from cntpnf Where nivcta = '5' ORDER BY codnif";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function obtener_cuentas_Niff(){
		$sql = "select codnif,trim(nomnif) as nomnif,nivcta from cntpnf";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function cuentas_creditos(){
		$sql = "select trim(codcta) codcta, trim(nomcta) nomcta from cntcta Where trim(codcta) like '1105%' and trim(tpocta) = 'Detalle' ORDER BY nomcta";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function cuentas_debitos(){
		$sql = "select trim(codcta) codcta, trim(nomcta) nomcta from cntcta Where trim(codcta) like '1110%' and trim(tpocta) = 'Detalle' ORDER BY nomcta";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
}