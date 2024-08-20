<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imprimir_doc_m extends CI_Model {
	
	function __Construct(){
	 parent:: __construct();
	}
	
	//CONSULTAS PARA GENERAR REPORTE
	function cabecera_empresa(){
		$sql = "SELECT codcia, nomcia, telcia, dircia, nitcia FROM actcia";	
		$res = $this->db->query($sql);
		//echo $this->db->last_query();
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}	
	
		function detalle_local($datos){
		$sql = "SELECT codcta, codnif, codtrc, detdcm, debdcm, credcm, nomtrc, nomcta, abnfac FROM view_sirco_detalle  
		WHERE  nrocmp = ? and coddoc = ? and codsed=? and agncnt=? and mescnt=? and stdcmp='Generado' ORDER BY nrodcm";	
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function detalle_nif($datos){
		$sql = "SELECT cntdcm.codnif AS codcta, nomnif as nomcta, cntdcm.codtrc, detdcm, debdcm, credcm, nomtrc FROM cntdcm, cnttrc, cntpnf 
WHERE  nrocmp = ? and coddoc = ? and codsed=? and agncnt=? and mescnt=? and trim(cntdcm.codtrc) = trim(cnttrc.codtrc) and stddcm='Generado' and cntdcm.codnif != 'X' and cntdcm.codnif=cntpnf.codnif";	
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	
	function cabecera_doc($datos){
		$sql = "SELECT fchcmp, debcmp, crecmp, nomtrc, cntdoc.coddoc AS coddoc, cntdoc.nomdoc AS nomdoc, nroegr, fchchq, nomtrc, invsed.nomsed, cntcmp.codsed 
		FROM cntcmp, cnttrc, cntdoc, invsed 
		WHERE trim(cntcmp.addusr) = cnttrc.codtrc AND cntcmp.coddoc = cntdoc.coddoc AND cntcmp.codsed = invsed.codsed
        AND nrocmp = ? AND cntcmp.coddoc = ? AND cntcmp.codsed = ? AND agncnt = ? AND mescnt = ?";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}	
	
	function cabecera_doc_local($datos){
		$sql = "SELECT fchcmp, debcmp, crecmp, nomtrc, cntdoc.coddoc AS coddoc, cntdoc.nomdoc AS nomdoc, nroegr FROM cntcmp, cnttrc, cntdoc 
		WHERE trim(cntcmp.addusr) = cnttrc.codtrc AND cntcmp.coddoc = cntdoc.coddoc
        AND nrocmp = ? AND cntcmp.coddoc = ? AND cntcmp.codsed = ? AND agncnt = ? AND mescnt = ?";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}	
	
	function cabecera_doc_nif($datos){
		$sql = "SELECT fchcmp, debnif AS debcmp, crenif AS crecmp, nomper, apeper, cntdoc.coddoc AS coddoc, cntdoc.nomdoc AS nomdoc 
		FROM cntcmp, view_user, cntdoc
        WHERE nrocmp = ? AND cntcmp.coddoc = ? AND cntcmp.codsed = ? AND agncnt = ? AND mescnt = ? AND 
		trim(cntcmp.addusr) = view_user.nriper AND cntcmp.coddoc = cntdoc.coddoc";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}	
	
	function elaborado_por($datos){
		$sql = "SELECT nomper.apeper as nomtrc 
		FROM view_user
        WHERE nrocmp = ? AND cntcmp.coddoc = ? AND cntcmp.codsed = ? AND agncnt = ? AND mescnt = ? AND trim(cntcmp.addusr) = trim(view_user.nriper) AND cntcmp.coddoc=cntdoc.coddoc";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}	
	
		function sumatoria_por_local($datos){
		$sql = "select sum(debdcm) sumdebito, sum(credcm) sumcredito from cntdcm where stddcm='Generado' AND nrocmp = ? AND coddoc = ? 
		AND codsed = ? AND agncnt = ? AND mescnt = ? AND codcta != 'X'";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function sumatoria_por_local_cheque($datos){
		$sql = "select sum(credcm) valor, nomtrc, fchchq from cntdcm, cnttrc where trim(cntdcm.addusr) = trim(cnttrc.codtrc) 
		AND stddcm='Generado' AND nrocmp = ? AND coddoc = ? AND codsed = ? AND agncnt = ? AND mescnt = ? AND codcta != 'X' 
		AND substring(codcta,1,2)='11' GROUP BY nomtrc, fchchq";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}
	
	function sumatoria_por_nif($datos){
		$sql = "select sum(debdcm) sumdebito, sum(credcm) sumcredito from cntdcm where stddcm='Generado' AND nrocmp = ? AND coddoc = ? 
		AND codsed = ? AND agncnt = ? AND mescnt = ? AND codnif != 'X'";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
}

?>