<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doc_contable_m extends CI_Model {
	
	function __Construct(){
	 parent:: __construct();
	}
	
	function datos_tabla($codusu){
		$sql = "select oid as codigo, codcta, detdcm, debdcm, credcm from cntdcm where stddcm='Pen-doc' and addusr=?";
		$res = $this->db->query($sql,array($codusu));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
    }
	
	function documentos(){
		$sql = "select trim(coddoc) coddoc,trim(nomdoc) nomdoc from cntdoc order by coddoc";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}	
	}
	
	function auxiliar(){
		$sql = "select trim(codaux) codaux,trim(nomaux) nomaux from cntaux order by codaux";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}	
	}
	
	function cuentas_detalle(){
		$sql = "select trim(codcta) codcta,trim(nomcta) nomcta from cntcta WHERE trim(tpocta) = 'Detalle' order by codcta";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}	
	}
	
	function agregar_doc($datos){
		$sql = "insert into cntdcm (agncnt,mescnt,coddoc,codcta,codtrc,detdcm,debdcm,credcm,addusr,addfch,agnakd,prdakd,codsed,stddcm,fchdcm,nrocmp) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function sumatoria_creditoydebito($user){
		$sql = "select sum(debdcm) sumdebito, sum(credcm) sumcredito from cntdcm where stddcm='Pen-doc' and addusr=?";
		$result = $this->db->query($sql,array($user));
		if($result->num_rows > 0){
			return $result->result_array();
		}
		else{return false;}
	}
	
	function consultarDatos($a,$b,$c,$d,$e,$f,$g){
		$sql = "select distinct(dcm.nrocmp), dcm.agncnt,dcm.mescnt,dcm.coddoc,cmp.fchcmp, trim(trc.nomtrc) nomtrc,dcm.codsed from cntdcm dcm inner join cnttrc trc on trim(dcm.codtrc)=trim(trc.codtrc), cntcmp cmp
where dcm.stddcm='Generado' and cmp.agncnt=dcm.agncnt and cmp.nrocmp=dcm.nrocmp and cmp.mescnt=dcm.mescnt and cmp.coddoc=dcm.coddoc and cmp.codsed=dcm.codsed";
		if($a!="")$sql .= " and dcm.coddoc='".$a."'";
		if($b!="")$sql .= " and dcm.codsed='".$b."'";
		if($c!="")$sql .= " and dcm.codcts='".$c."'";
		if($d!="")$sql .= " and cmp.fchcmp>='".$d."'";
		if($e!="")$sql .= " and cmp.fchcmp<='".$e."'";
		if($f!="")$sql .= " and dcm.codcta='".$f."'";
		//if($g!="")$sql .= " and dcm.campo='".$g."'";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function consultarDatos_lim($a,$b,$d,$e,$u){
		$sql = "SELECT nrocmp, nomdoc, nomsed, fchcmp, nomtrc, coddoc, codsed, crecmp, debcmp, agncnt, mescnt FROM view_documentos WHERE stdcmp='Generado'";
		if($a!="")$sql .= " and view_documentos.coddoc='".$a."'";
		if($b!="")$sql .= " and view_documentos.codsed='".$b."'";
		if($d!="")$sql .= " and view_documentos.fchcmp>='".$d."'";
		if($e!="")$sql .= " and view_documentos.fchcmp<='".$e."'";
		if($u!="")$sql .= " and view_documentos.addusr='".$u."'";
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function tabla_busqueda($datosbusqueda){
		$sql = "select oid as codigo, codcta, detdcm, debdcm, credcm from cntdcm where trim(stddcm)='Generado' and nrocmp=? and coddoc=? and codsed=? and agncnt=? and mescnt=? ";
		$res = $this->db->query($sql,$datosbusqueda);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	/*function sumatoria_por_nrocmp($nrocmp){
		$sql = "select sum(debdcm) sumdebito, sum(credcm) sumcredito from cntdcm where stddcm='Generado' and nrocmp=?";
		$res = $this->db->query($sql,array($nrocmp));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}*/
	
	function revertir($tabla,$campo,$datos){
		$sql = "update ".$tabla." set ".$campo."='Revertido' where nrocmp=? and coddoc=? and codsed=? and agncnt=? and mescnt=? ";
	  	$res = $this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function obtener_cod_documento($codusu){
		$sql = "select distinct(coddoc) from cntdcm where stddcm='Pen-doc' and addusr=? order by coddoc limit 1";	
		$res = $this->db->query($sql,array($codusu));
		if($res->num_rows() > 0){
			$resultado = $res->result_array();
			return $resultado[0]['coddoc'];
		}else{return false;}
	}
	
	function obtener_datos($codusu){
		$sql = "select distinct(addfch),agncnt,mescnt,fchdcm from cntdcm where stddcm='Pen-doc' and addusr=? order by addfch limit 1";	
		$res = $this->db->query($sql,array($codusu));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function obtener_coddoc_reporte($datos){
		$sql = "select d.coddoc, doc.nomdoc from cntdcm d inner join cntdoc doc on d.coddoc=doc.coddoc 
where d.stddcm='Generado' and trim(d.agncnt)=? and trim(d.mescnt)=? and trim(d.coddoc)=? and trim(d.nrocmp)=? 
and trim(d.codsed)=? order by coddoc limit 1";	
		$res = $this->db->query($sql,$datos);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function actualizar_detalle($datos){
	   	$sql = "update cntdcm set agncnt=?, mescnt=?, nrocmp=?, stddcm=?, addfch=? where stddcm='Pen-doc' and addusr=?";
	  	$this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}	
	
	function obtener_ultimo_nrodcm($usuario){
		$sql = "select nrodcm from cntdcm where trim(stddcm)='Pen-doc' and trim(addusr)=? order by nrodcm desc limit 1";	
		$res = $this->db->query($sql,array($usuario));
		if($res->num_rows() > 0){
			$resultado = $res->result_array();
			return $resultado[0]['nrodcm'];
		}else{return false;}
	}
	
	function verificar_si_tiene_doc($codusu){
		$sql = "select coddoc,agncnt,mescnt,addfch,fchdcm,codsed from cntdcm where stddcm='Pen-doc' and addusr=? limit 1";
		$res = $this->db->query($sql,array($codusu));
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function obtener_nroregeso($codusu){
		$sql  = "select nrocmp from cntdcm where stddcm='Pen-doc' and addusr=? limit 1";	
		$res = $this->db->query($sql,array($codusu));
		if($res->num_rows() > 0){
			$resultado =  $res->result_array();
			return $resultado[0]['nrocmp'];
		}else{return false;}
	}
	
	function agregar_cabecera($datos){
		$sql = "insert into cntcmp (agncnt,mescnt,coddoc,fchcmp,nrocmp,stdcmp,debcmp,crecmp,addusr,addfch,codsed,nroegr) values(?,?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function detalle_cheque($datos){
		$sql = "SELECT codcta, detdcm, debdcm, credcm,codtrc FROM cntdcm 
WHERE  nrocmp = ? and codsed=? and agncnt=? and mescnt=? and coddoc = ? and stddcm='Generado'";	
		$res = $this->db->query($sql,$datos);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function nombre_tercero($nrocmp,$codsed,$agncnt,$mescnt,$coddoc){
		$sql = "select nomtrc, c.fchcmp,nroegr from cnttrc, cntcmp c where trim(codtrc)=(select trim(codtrc) from cntdcm where nrocmp='".$nrocmp."' and codsed='".$codsed."' and agncnt='".$agncnt."' and mescnt='".$mescnt."' and coddoc='".$coddoc."' and stddcm='Generado' limit 1) and c.nrocmp='".$nrocmp."' and c.codsed='".$codsed."' and c.agncnt='".$agncnt."' and c.mescnt='".$mescnt."' and c.coddoc='".$coddoc."' and c.stdcmp='Generado'";	
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	//Obtener ultimo numero de egreso
	function obtenerNumEgreso(){
		$sql = "select nroegr from cntcmp order by nroegr desc limit 1";	
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			$nroegrso = $res->result_array();
			return $nroegrso[0]['nroegr'];
		}else{return false;}
	}
	
	//editar	
	function actualizar_cntdcm($datos){
		$sql="DELETE FROM cntdcm WHERE nrocmp = ? AND coddoc = ? AND codsed = ? AND agncnt = ? AND mescnt = ?";	
		$res = $this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function actualizar_cntcmp($datos){
		$sql="update cntcmp set debcmp=?,crecmp=? where agncnt=? and mescnt=?  and coddoc=? and nrocmp=? and codsed=?";	
		$res = $this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	function datos_a_editar($datosbusqueda){
		$sql = "select trim(d.codcta)||'-'||trim(cta.nomcta) codcta, d.detdcm, d.debdcm, d.credcm, trim(d.codtrc)||'-'||trim(trc.nomtrc) codtrc,trim(d.codaux) codaux, 				
		trim(d.codcts) codcts, agnakd, prdakd from cntdcm d, cntcta cta, cnttrc trc where stddcm='Generado' and trim(cta.codcta)=trim(d.codcta) and trim(trc.codtrc)=trim(d.codtrc) 	
		AND nrocmp = ? AND coddoc = ? AND codsed = ? AND agncnt = ? AND mescnt = ?";
		$res = $this->db->query($sql,$datosbusqueda);
		
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function datos_fijos ($datosbusqueda){
		$sql="select fchcmp, nroegr from view_documentos WHERE stdcmp='Generado'AND nrocmp = ? AND coddoc = ? AND codsed = ? AND agncnt = ? AND mescnt = ? limit 1 ";	
		$res = $this->db->query($sql,$datosbusqueda);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function suma_debcred_editar ($datosbusqueda){
		$sql="select sum(debdcm) sumdebdcm, sum(credcm) sumcredcm from cntdcm where stddcm='Generado' AND nrocmp = ? AND coddoc = ? AND codsed = ? AND    
		agncnt = ? AND mescnt = ?";	
		$res = $this->db->query($sql,$datosbusqueda);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	//inserciones
	function agregar_doc2($datos){
		$sql = "insert into cntdcm (agncnt,mescnt,coddoc,nrocmp,stddcm,codcta,codtrc,codcts,detdcm,debdcm,credcm,addusr,addfch,nrodcm,fchdcm,codaux,fchchq,codsed,agnakd, prdakd) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	  $res = $this->db->query($sql,$datos);
	  	if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}	
	}
	
	//OBTENER CUENTAS DE UN DOCUMENTO
	function obtener_cuentas($agncnt,$mescnt,$coddoc,$nrocmp,$codsed){
		$sql = "select codcta,credcm from cntdcm where trim(agncnt)=? and trim(mescnt)=? and trim(coddoc)=? and trim(nrocmp)=? and trim(codsed)=?";
		$res = $this->db->query($sql,array($agncnt,$mescnt,$coddoc,$nrocmp,$codsed));
		if($res->num_rows()>0){
			return $res->result_array();
		}else { return false; }
	}
	
	function verificar_si_impuesto($codcta){
		$sql = "select impuesto from cntcta where trim(codcta)=?";
		$res = $this->db->query($sql,array($codcta));
		if($res->num_rows()>0){
			$dato = $res->result_array();	
			return $dato[0]['impuesto'];
		}else { return false; }
	}
	
	
	//IMPRESION DEL COMPROBANTE	
	//CONSULTAS PARA GENERAR REPORTE
	function cabecera_reporte(){
		$sql = "SELECT codcia, nomcia, telcia, dircia, nitcia FROM actcia";	
		$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}	
	
		function detalle_reportes($datos){
		$sql = "SELECT codcta, cntdcm.codtrc, detdcm, debdcm, credcm, nomtrc FROM cntdcm, cnttrc 
WHERE  nrocmp = ? and codsed=? and agncnt=? and mescnt=? and coddoc = ? and trim(cntdcm.codtrc) = trim(cnttrc.codtrc) and (stddcm='Generado' OR stddcm='Editado')";	
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	
	function elaborado_por($datos){
		$sql = "SELECT cntcmp.fchcmp, debcmp, crecmp, cntcmp.addusr, nomtrc, nomsed, cntcmp.addfch, nomdoc, cntcmp.coddoc FROM cntcmp, view_user, invsed, cntdoc
                 WHERE nrocmp = ? AND cntcmp.codsed = ? AND agncnt = ? AND mescnt = ? AND cntcmp.codsed = invsed.codsed AND cntcmp.coddoc = ?  AND trim(cntcmp.addusr) = trim(view_user.nriper) AND cntcmp.coddoc=cntdoc.coddoc";
		$res = $this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}	
	
	
}
