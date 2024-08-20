<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auxiliares_libro_diario_m extends CI_Model {
	function __Construct(){
	   parent::__construct();
	}
	
	//FUNCIONES PARA REPORTE REGISTRO DIARIO
	function doc_registro_diario($fecha1,$fecha2,$codctaa,$codctab,$codsed,$tipcon){
		$this->db->select('DISTINCT(coddoc) coddoc');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('fchcmp >=', $fecha1);
		$this->db->where('fchcmp <=', $fecha2);
		if($tipcon == 'Local'){
		if($codctaa != 'n'){ $this->db->where('codcta >=', $codctaa);}
		if($codctab != 'n'){ $this->db->where('codcta <=', $codctab);} 
		}else{
		if($codctaa != 'n'){ $this->db->where('codnif >=', $codctaa); }
		if($codctab != 'n'){ $this->db->where('codnif <=', $codctab);} 
		}		
		if($codsed != '00000'){$this->db->where('codsed', $codsed);}
		$this->db->order_by('coddoc', 'ASC');
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function nrocmp_registro_diario($fecha1,$fecha2,$codctaa,$codctab,$coddoc,$codsed,$tipcon){
		$this->db->select('nrocmp');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('fchcmp >=', $fecha1);
		$this->db->where('fchcmp <=', $fecha2);
		if($tipcon == 'Local'){
		if($codctaa != 'n'){ $this->db->where('codcta >=', $codctaa);}
		if($codctab != 'n'){ $this->db->where('codcta <=', $codctab);} 
		}else{
		if($codctaa != 'n'){ $this->db->where('codnif >=', $codctaa); }
		if($codctab != 'n'){ $this->db->where('codnif <=', $codctab);} 
		}
		$this->db->where('coddoc', $coddoc);
		if($codsed != '00000'){$this->db->where('codsed', $codsed);}
		$this->db->group_by('nrocmp', 'ASC');
		$this->db->order_by('nrocmp', 'ASC');
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function detalle_reg_diario($fecha1,$fecha2,$codctaa,$codctab,$coddoc,$nrocmp,$codsed,$tipcon){
		if($tipcon == 'Local'){
		$this->db->select('codsed,  coddoc, nrocmp, fchcmp, codcta, codaux, codcts, codtrc, detdcm, debdcm, credcm');}else{
		$this->db->select('codsed,  coddoc, nrocmp, fchcmp, codnif codcta, codaux, codcts, codtrc, detdcm, debdcm, credcm');}
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('fchcmp >=', $fecha1);
		$this->db->where('fchcmp <=', $fecha2);
		if($tipcon == 'Local'){
		if($codctaa != 'n'){ $this->db->where('codcta >=', $codctaa);}
		if($codctab != 'n'){ $this->db->where('codcta <=', $codctab);} 
		}else{
		if($codctaa != 'n'){ $this->db->where('codnif >=', $codctaa);}
		if($codctab != 'n'){ $this->db->where('codnif <=', $codctab);} 
		}
		if($codsed != '00000'){$this->db->where('codsed', $codsed);}
		$this->db->where('coddoc', $coddoc);
		$this->db->where('nrocmp', $nrocmp);
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
		function reporte_diario_fuente($fecha1,$fecha2,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$codsed,$tipcon){
		$this->db->select('view_sirco_detalle.coddoc, nomdoc, sum(debdcm) debdcm, sum(credcm) credcm');
		$this->db->from('view_sirco_detalle, cntdoc');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('fchcmp >=', $fecha1);
		$this->db->where('fchcmp <=', $fecha2);
		if($codtrca != 'n'){$this->db->where('codtrc >=', $codtrca);}
		if($codtrcb != 'n'){$this->db->where('codtrc <=', $codtrcb);}
		if($codctsa != 'n'){$this->db->where('codcts >=', $codctsa);}
		if($codctsb != 'n'){$this->db->where('codcts <=', $codctsb);}
		if($codauxa != 'n'){$this->db->where('codaux >=', $codauxa);}
		if($codauxb != 'n'){$this->db->where('codaux <=', $codauxb);}
		if($tipcon == 'Local'){
		if($codctaa != 'n'){$this->db->where('codcta >=', $codctaa);}
		if($codctab != 'n'){$this->db->where('codcta <=', $codctab);}
		$this->db->where('codcta !=', 'X');}else{
		if($codctaa != 'n'){$this->db->where('codnif >=', $codctaa);}
		if($codctab != 'n'){$this->db->where('codnif <=', $codctab);}
		$this->db->where('codnif !=', 'X');}
		if($codsed != '00000'){$this->db->where('codsed', $codsed);}
		$condicion="view_sirco_detalle.coddoc = cntdoc.coddoc";
		$this->db->where($condicion);
		$this->db->order_by('view_sirco_detalle.coddoc, nomdoc');
		$this->db->group_by('view_sirco_detalle.coddoc, nomdoc');
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
		}
		
		function reporte_diario_fuente_cta($fecha1,$fecha2,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$coddoc,$codsed,$tipcon){
		if($tipcon == 'Local'){
		$this->db->select('codcta, nomcta, sum(debdcm) debdcm, sum(credcm) credcm');}else{
		$this->db->select('codnif codcta, nomnif nomcta, sum(debdcm) debdcm, sum(credcm) credcm');}
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('fchcmp >=', $fecha1);
		$this->db->where('fchcmp <=', $fecha2);
		if($codtrca != 'n'){$this->db->where('codtrc >=', $codtrca);}
		if($codtrcb != 'n'){$this->db->where('codtrc <=', $codtrcb);}
		if($codctsa != 'n'){$this->db->where('codcts >=', $codctsa);}
		if($codctsb != 'n'){$this->db->where('codcts <=', $codctsb);}
		if($codauxa != 'n'){$this->db->where('codaux >=', $codauxa);}
		if($codauxb != 'n'){$this->db->where('codaux <=', $codauxb);}
		if($tipcon == 'Local'){
		if($codctaa != 'n'){$this->db->where('codcta >=', $codctaa);}
		if($codctab != 'n'){$this->db->where('codcta <=', $codctab);}
		$this->db->where('codcta !=', 'X');}else{
		if($codctaa != 'n'){$this->db->where('codnif >=', $codctaa);}
		if($codctab != 'n'){$this->db->where('codnif <=', $codctab);}
		$this->db->where('codnif !=', 'X');}
		if($codsed != '00000'){$this->db->where('codsed', $codsed);}
		$this->db->where('coddoc', $coddoc);
		if($tipcon == 'Local'){$this->db->group_by('codcta, nomcta'); $this->db->order_by('codcta');}else{$this->db->group_by('codnif, nomnif'); $this->db->order_by('codnif');}
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();

		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
		}
		
		function documentos_contable($fecha1,$fecha2,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$codsed,$tipcon){
		$this->db->select('coddoc, nrocmp, codsed, agncnt, mescnt, fchcmp');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('fchcmp >=', $fecha1);
		$this->db->where('fchcmp <=', $fecha2);
		if($codtrca != 'n'){$this->db->where('codtrc >=', $codtrca);}
		if($codtrcb != 'n'){$this->db->where('codtrc <=', $codtrcb);}
		if($codctsa != 'n'){$this->db->where('codcts >=', $codctsa);}
		if($codctsb != 'n'){$this->db->where('codcts <=', $codctsb);}
		if($codauxa != 'n'){$this->db->where('codaux >=', $codauxa);}
		if($codauxb != 'n'){$this->db->where('codaux <=', $codauxb);}
		if($tipcon == 'Local'){
		if($codctaa != 'n'){$this->db->where('codcta >=', $codctaa);}
		if($codctab != 'n'){$this->db->where('codcta <=', $codctab);}
		$this->db->where('codcta !=', 'X');}else{
		if($codctaa != 'n'){$this->db->where('codnif >=', $codctaa);}
		if($codctab != 'n'){$this->db->where('codnif <=', $codctab);}
		$this->db->where('codnif !=', 'X');}
		if($codsed != '00000'){$this->db->where('codsed', $codsed);}
		$this->db->group_by('coddoc, nrocmp, codsed, agncnt, mescnt, fchcmp');
		$this->db->order_by('coddoc, nrocmp, fchcmp');
		$res = $this->db->get();
		
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
		
	}
	
	function detalle_documento_contable($nrocmp,$coddoc,$codsed,$agncnt,$mescnt,$tipcon){	
		if($tipcon == 'Local'){$this->db->select('fchcmp, debdcm, credcm, nroegr, detdcm, codcta, nomcta, codtrc, nomtrc');}else{
		$this->db->select('fchcmp, debdcm, credcm, nroegr, detdcm, codnif codcta, nomnif nomcta, codtrc, nomtrc');}
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('nrocmp', $nrocmp);
		$this->db->where('coddoc', $coddoc);
		$this->db->where('codsed', $codsed);
		$this->db->where('agncnt', $agncnt);
		$this->db->where('mescnt', $mescnt);
		$this->db->order_by('nrodcm');
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
		
	}
	
}
?>