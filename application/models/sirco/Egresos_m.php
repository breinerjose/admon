<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Egresos_m extends CI_Model {
	
	function __Construct(){
	 parent:: __construct();
	}
	
	function consultarConceptos($codtrc){
		$sql = "select codoid as codigo, stddcm, codcta, debdcm, credcm,codtrc, detdcm from cntdcm where stddcm='Pendiente' AND coddoc = '02' AND addusr=?";
		$res = $this->db->query($sql,array($codtrc));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
    }
	
	function verificar_conceptos($codtrc){
		$sql = "select fchdcm from cntdcm where stddcm='Pendiente' AND coddoc = '02' AND addusr=? limit 1";
		$res = $this->db->query($sql,array($codtrc));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}			
	}
	
	function agregarConceptos($codtrc,$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm){
	  	$sql = "insert into cntdcm (codtrc,codcta,codnif,credcm,debdcm,stddcm,agncnt, mescnt, detdcm, coddoc,addusr,addfch,fchdcm) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,array(trim($codtrc),trim($ctaknp),trim($ctaknp),0,$vlrcta,'Pendiente','2020','12',$nombre, '02',$addusr,$addfch,trim($fchdcm)));
	  //echo $this->db->last_query();
	  //exit();
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}		
    }
	
	function agregarConceptos2($codtrc,$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm){
		$sql = "insert into cntdcm (codtrc,codcta,codnif,credcm,debdcm,stddcm,agncnt, mescnt, detdcm, coddoc,addusr,addfch,fchdcm) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,array(trim($codtrc),trim($ctaknp),trim($ctaknp),$vlrcta,0,'Pendiente','2020','12',$nombre, '02',$addusr,$addfch,trim($fchdcm)));
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}		
    }
	
	function sumatoria_creditoydebito($user){
		$sql = "select sum(debdcm) sumdebito, sum(credcm) sumcredito from cntdcm where stddcm='Pendiente' and addusr=? and coddoc ='02'";
		$result = $this->db->query($sql,array($user));
		if($result->num_rows() > 0){
			return $result->result_array();
		}
		else{return false;}
	}

	

}