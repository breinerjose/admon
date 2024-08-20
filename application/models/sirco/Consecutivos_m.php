<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consecutivos_m extends CI_Model {
	
	var $cntdoc='cntdoc', $actids='actids', $invsed='invsed';
	
	function __Construct(){
	   parent::__construct();
	}
		
	function consecutivo($coddoc,$mes,$anio,$codsed){
		      $sql = "SELECT trim(nomelm) AS nomelm FROM actelm WHERE codelm='CON' AND tipelm='TPO' AND nroelm='001'";
				$result = $this->db->query($sql);
				$dato = $result->row_array();
				$nomelm = $dato['nomelm'];
				$cn='';
				
				if($nomelm == 'Indefinido'){ $cn = "CNTDOC000000".$coddoc.$codsed; }
				elseif($nomelm == 'Anual'){ $cn = "CNTDOC".$anio."00".$coddoc.$codsed; }
				else{$cn = "CNTDOC".$anio.$mes.$coddoc.$codsed;}
				
				$res = $this->db->query("SELECT obtener_consecutivo('".$cn."',6) AS nrocmp");
				$cons = $res->row_array();
				return $cons['nrocmp'];
		
	}
	
	
}