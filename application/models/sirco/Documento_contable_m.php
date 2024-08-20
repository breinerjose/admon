<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documento_contable_m extends CI_Model {

	
	function __Construct(){
	   parent::__construct();
	   set_time_limit(0);
	   ini_set("memory_limit", "99999M");
	   ini_set("max_execution_time", "99999");
	}
	
	//function consultar infomacio
	
	
	//function consultar infomacio
	function selectsedes($codigo){
	  $sql= "SELECT distinct(view_sirco_sedes.codsed), view_sirco_sedes.nomsed FROM view_sirco_sedes, cntper
	  		WHERE cntper.codsed=view_sirco_sedes.codsed AND cntper.modifi='1' AND cntper.codusu=?";
	  $res = $this->db->query($sql,$codigo);
	  //echo $this->db->last_query();
	  return ($res->num_rows() >0)? $res->result_array():false;
	}
	
	//function documentos contables 
	function informDocumentosctb($nrodoc, $codsed, $estdo, $fch1, $fch2){
	   $sql= "select codsed,agncnt, mescnt, c.coddoc, d.nomdoc, fchcmp, nrocmp, nroegr, stdcmp, c.addfch, c.debcmp, c.crecmp , (select trim(stdprd) as stdprd from cntprd where trim(agncnt)=c.agncnt and trim(mescnt)=c.mescnt and trim(stdprd)='Abierto')
			 from cntcmp c
			 inner join cntdoc d on trim(d.coddoc)=trim(c.coddoc)
		     where c.coddoc=? AND c.codsed=? AND trim(stdcmp)=? AND to_date(trim(fchcmp), 'dd/mm/yyyy') BETWEEN ? AND ?";
	  $res = $this->db->query($sql,array($nrodoc, $codsed, $estdo, $fch1,$fch2));
	   //echo $this->db->last_query();
	  // exit();
	  return ($res->num_rows() >0)? $res->result_array():false;
	}
	
	//informaciion de un documento
	function datosUndocumento($codoc){
	  $sql= "select nrodoc as nrodoca, case when nrodoc=0 then 0 else nrodoc+1 end as nrodoc from cntdoc where trim(coddoc)=?";
	  $res = $this->db->query($sql,array($codoc));
	  //echo $this->db->last_query();
	  //exit();
	  return ($res->num_rows() >0)? $res->row_array():false;
	} 
	
	//metodo de insectar informacion
	function agregarInformaciongnr($datos, $tbl){
	   $this->db->insert($tbl, $datos);
	   //echo $this->db->last_query();
	   //exit();
	   return($this->db->affected_rows()>0)?true:false;
	   
	}
	
	//metodo de eliminar informacion
	function eliminarInformaciongnr($datos, $tbl){
	    $this->db->delete($tbl, $datos);
	   return($this->db->affected_rows()>0)?true:false;
	}
	
	//actualizar informacion
	function actualizarParametros($datos,$datos1,$tbl){
	    $this->db->where($datos);
		$this->db->update($tbl, $datos1);
//	  echo $this->db->last_query();
//	   exit();
		return ($this->db->affected_rows()>0) ? true : false;	
	}
	
	//periodos contables
	function verificarCodigo($coddoc){
	  $sql= "select nrodoc from cntdoc where trim(coddoc)=?" ;
	  $res = $this->db->query($sql, array($coddoc));
	  return ($res->num_rows() >0)? $res->row_array():false;
	}
	
	//veriificar periodos contables
	function verificarFechacnt($anio, $mes){
	  $sql= "select * from cntprd where trim(agncnt)=? and trim(mescnt)=? and trim(stdprd)='Abierto'" ;
	  $res = $this->db->query($sql, array($anio, $mes));
	  return ($res->num_rows() >0)? $res->row_array():false;
	}
	
	//informacion de cuentas por cobrar
	function informacionCunetasporcobrar($agncnt){
		$sql= "select agncnt, mescnt, nrocxc, p.codcta, c.nomcta, fchcxc, trim(p.codtrc) as codtrc, 
		       trim(t.nomtrc) as nomtrc, vlrcxc, abncxc, p.coddoc,d.nomdoc, nrocmp, detcxc, nrocrd 
				from cntcxc p
				inner join cntcta c on trim(p.codcta)=trim(c.codcta)
				inner join cntdoc d on trim(p.coddoc)=trim(d.coddoc)
				inner join cnttrc t on trim(p.codtrc)=trim(t.codtrc)
				where trim(tpodud)='CXC' and agncnt=?";
	  $res = $this->db->query($sql, array($agncnt));
	 //echo $this->db->last_query();
	  return ($res->num_rows() >0)? $res->result_array():false;	
	}
	
	//function obtener consecutivo
	function obtenerConsecutivo($string){
	 $sql = "select obtener_consecutivo(?,6)";
	 $res = $this->db->query($sql,array($string));
	 //echo $this->db->last_query();
	 return ($res->num_rows() >0) ? $res->row_array() : false;
	}
	
	//function datos de un documento
	function datosUndocumentoctb($nrocmp,$coddoc,$codsed,$agncnt,$mescnt,$stdcmp){
	 	$sql= "select fchcmp, trim(c.coddoc) as coddoc, trim(d.nomdoc) as nomdoc, round(debcmp,2) debcmp, round(crecmp,2) crecmp, nroegr, case trim(nroegr) 
when trim('') then '0' else '1' end as nrodoc1 , debnif, crenif, trim(nomsed) as nommun 
from cntcmp c inner join cntdoc d on trim(d.coddoc)=trim(c.coddoc) inner join view_sirco_sedes m on m.codsed=c.codsed 
where nrocmp=? and c.coddoc=? and c.codsed=? and agncnt=? and mescnt=? and stdcmp=?";
	  $res = $this->db->query($sql, array($nrocmp,$coddoc,$codsed,$agncnt,$mescnt,$stdcmp));
	  //echo $this->db->last_query();
	  //exit();
	  return ($res->num_rows() >0)? $res->row_array():false;	
	}
	
	//function datos de un documento
	function detallesUndocumentoctb($nrocmp,$coddoc,$codsed,$agncnt,$mescnt,$stddcm){
		$sql= "select d.codcta, cta.porcta, d.codtrc, trim(p.nomtrc) as nomtrc, d.codcts, trim(c.nomcts) as nomcts, 
			  detdcm,debdcm,credcm,d.codaux, a.nomaux, basret, stddcm,d.codnif
			  from cntdcm d
			  left join cntcts c on trim(c.codcts)=trim(d.codcts)
			  left join cntaux a on trim(a.codaux)=trim(d.codaux)
			  left join cnttrc p on trim(p.codtrc)=trim(d.codtrc) 
			  left join cntcta cta on trim(cta.codcta)=trim(d.codcta)
			  where nrocmp=? and d.coddoc=? and codsed=? and agncnt=? and mescnt=? and stddcm=? order by nrodcm";
	  $res = $this->db->query($sql, array($nrocmp,$coddoc,$codsed,$agncnt,$mescnt,$stddcm));
	 //echo $this->db->last_query();
	 //exit();
	  return ($res->num_rows() >0)? $res->result_array():false;	
	}
	function actualizarDoc($datos,$where){
		$this->db->update('cntdoc',$datos,$where);
		//echo $this->db->last_query();
//	    exit();
		return($this->db->affected_rows()>0)?true:false;		
	}
	function actualizarInformaciongnr($dato,$where){
		$this->db->update('cntdcm',$dato,$where);	
		return($this->db->affected_rows()>0)?true:false;
	}
	function consultarTercero($valor){
		$sql="select trim(codtrc) as codtrc, trim(nomtrc) as nomtrc 
	        from cnttrc  where trim(codtrc)=? ";
		$res=$this->db->query($sql,$valor);
		return($res->num_rows()>0)?$res->row_array():false;
	} 
	
	
        
	 function cargarDatosCuenta($codcta){
		$sql="select trim(codcta) as codcta, trim(nomcta) as nomcta, c.nivcta, c.porcta,trim(c.codnif) as codnif,
			  trim(nomnif) as nomnif from cntcta c left join cntpnf p on p.codnif=c.codnif where 
			  trim(tpocta)='Detalle' and trim(codcta)=?";
		$res=$this->db->query($sql,$codcta);
		return($res->num_rows()>0)?$res->row_array():false;
	}
	function consultarItem($coditm){
		$sql="select 
		      from  where  order by coditm";
		$res=$this->db->query($sql,$coditm);
		return($res->num_rows()>0)?$res->row_array():false;	
	}
	function cambiarFechaDocuemntoContable($tabla,$datocmp,$where){
		$this->db->update($tabla,$datocmp,$where);
		return($this->db->affected_rows()>0)?true:false;
	}
}