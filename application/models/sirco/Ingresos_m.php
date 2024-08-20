<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingresos_m extends CI_Model {
	
	function __Construct(){
	 parent:: __construct();
	}
	
	//metodo cargar persona
	function selectTipoper(){
		$sql = "select * from tiptrc";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}	
	}
	
	//metodo cargar tipo de documentos
	function selectTipodoc($codigo){
		$sql = "select * from tipdoc where tipper='".$codigo."'";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}	
	}
	
	function verificar_conceptos($codtrc){
		$sql = "select trim(fchdcm) fchdcm from cntdcm where stddcm='Pendiente' AND coddoc = '06' and addusr=? limit 1";
		$res = $this->db->query($sql,array($codtrc));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}			
	}
	
	//metodo cargar persona
	function selectConceptos(){
		$sql = "SELECT trim(codknp) codknp,trim(nomknp) nomknp, trim(ctaknp) ctaknp FROM actknp WHERE tpoknp = 'Credito' ORDER BY codknp";
		$res = $this->db->query($sql,array());
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	//metodo cargar persona
	function selectConceptos2(){
		$sql = "SELECT trim(codknp) codknp,trim(nomknp) nomknp, trim(ctaknp) ctaknp FROM actknp WHERE trim(tpoknp) = trim('Debito') ORDER BY codknp";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	//metodo cargar persona
	function selectConceptos3(){
		$sql = "SELECT codcta AS codknp, nomcta AS nomknp, codcta AS ctaknp FROM cntcta WHERE (codcta LIKE '1105%' AND tpocta = 'Detalle') OR (codcta LIKE '1110%' AND tpocta = 'Detalle')";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
function agregarConceptos($codtrc,$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm,$codalm,$grado,$grupo,$agnakd){
	  $sql = "insert into cntdcm (codtrc,codcta,codnif,credcm,debdcm,stddcm,agncnt, mescnt, detdcm, coddoc,addusr,addfch,fchdcm,codalm,grado,grupo,agnakd) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,array($codtrc,$ctaknp,$ctaknp,$vlrcta,0,'Pendiente','2020','12',$nombre, '06',$addusr,$addfch,trim($fchdcm),$codalm,$grado,$grupo,$agnakd));
	  	//echo $this->db->last_query();
		//exit();
		if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}		
    }
	
	function agregarConceptos2($codtrc,$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm,$codalm,$grado,$grupo,$agnakd){
	  $sql = "insert into cntdcm (codtrc,codcta,codnif,credcm,debdcm,stddcm,agncnt, mescnt, detdcm, coddoc,addusr,addfch,fchdcm,codalm,grado,grupo,agnakd) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,array($codtrc,$ctaknp,$ctaknp,0,$vlrcta,'Pendiente','2020','12',$nombre, '06',$addusr,$addfch,trim($fchdcm),$codalm,$grado,$grupo,$agnakd));
	    //echo $this->db->last_query();
		//exit();
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}		
    }
	
	//metodo de consulta
	function consultarConceptos($codtrc){
	$sql = "select codoid as codigo, stddcm, codcta,debdcm, credcm,codtrc, detdcm from cntdcm where stddcm='Pendiente' AND coddoc = '06' AND addusr=?";
	$res = $this->db->query($sql,array($codtrc));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
    }
	
	
	
	
	//meo¿todo eliminar
	function eliminarConcepto($codigo){
	  $sql = "delete from cntdcm where codoid=?";
	  $res = $this->db->query($sql,array($codigo,));
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}		
	}
	
	function consultarTodosusuarios(){
		$sql1 = "select trim(codtrc)as user, trim(nomtrc) as nombre from cnttrc";
		$result1 = $this->db->query($sql1);
		if($result1->num_rows() > 0){
			return $result1->result_array();
			}
			else{return FALSE;}
	}
	
	function sumatoria_creditoydebito($user){
		$sql = "select sum(debdcm) sumdebito, sum(credcm) sumcredito from cntdcm where stddcm='Pendiente' AND coddoc = '06' and addusr=?";
		$result = $this->db->query($sql,array($user));
		if($result->num_rows() > 0){
			return $result->result_array();
		}
		else{return false;}
	}
	
	function agregar_cabecera($datos){
		$sql = "insert into cntcmp (agncnt,mescnt,coddoc,fchcmp,nrocmp,stdcmp,debcmp,crecmp,addusr,addfch,codsed) values(?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizar_detalle($datos){
	   $sql = "update cntdcm set agncnt=?, mescnt=?, nrocmp=?, stddcm=? where stddcm='Pendiente' and addusr=? and coddoc=?";
	  	$this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}	
	
	function verificar_fecha_contabilizacion($datos){
		$sql = "select * from cntprd where agncnt=? and mescnt=? and trim(stdprd)='Abierto'";
		$result = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		//exit();
		if($result->num_rows() > 0){
			return true;
		}
		else{return false;}		
	}
	
	
	function comprobar_numcomprobante($num_comprobante){
		$sql = "select * from cntdcm where nrocmp = ?;";
		$res = $this->db->query($sql,array($num_comprobante));
		if($res->num_rows() > 0){
			return true;
		}else{return false;}	
	}
	
}

