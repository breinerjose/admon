<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class busqueda_doc_contable_m extends CI_Model {
	
	function __Construct(){
	 parent:: __construct();
	}
	
	function consultarDatos($codsed,$coddoc,$codcts,$codcta,$codnif,$fecha1,$fecha2,$nrocmp,$nroegr,$codtrc){
		$sql = "select distinct agncnt, mescnt, coddoc, nrocmp, fchcmp, codsed, stdcmp, (select trim(stdprd)
		from cntprd where trim(agncnt)=view_sirco_detalle.agncnt and trim(mescnt)=view_sirco_detalle.mescnt)  as stdprd
			 from view_sirco_detalle
		     where stdcmp='Generado'";
			 if($codsed!="")$sql .= " and codsed='".$codsed."'";
			 if($coddoc!="")$sql .= " and coddoc='".$coddoc."'";
			 if($codcts!="")$sql .= " and codcts='".$codcts."'";
			 if($codcta!="")$sql .= " and codcta='".$codcta."'";
			 if($codnif!="")$sql .= " and codnif='".$codnif."'";
			 if($fecha1!="")$sql .= " and fchcmp>='".$fecha1."'";
			 if($fecha2!="")$sql .= " and fchcmp<='".$fecha2."'";
			 if($nrocmp!="")$sql .= " and nrocmp='".$nrocmp."'";
			 if($nroegr!="")$sql .= " and nroegr='".$nroegr."'";
			 if($codtrc!="")$sql .= " and codtrc='".$codtrc."'";
		     $sql .=" order by agncnt, mescnt, coddoc, nrocmp";
		$res = $this->db->query($sql);
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
}
?>