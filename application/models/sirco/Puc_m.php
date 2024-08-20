<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puc_m extends CI_Model {
	
	var $cntcta = 'cntcta', $cntcts='cntcts';
	
	function __Construct(){
	 parent:: __construct();
	}
	
	function items_principales(){
		$sql = "select codcta,nomcta from ".$this->cntcta." where nivcta=1 AND trim(codtpn) = 'PUC' order by codcta;";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	
	function sub_items($nivel,$dependencia){
		$sql = "SELECT trim(codcta) codcta, nomcta FROM ".$this->cntcta." WHERE nivcta=? AND trim(depcta)=? ORDER BY codcta;";
		$res = $this->db->query($sql,array($nivel,$dependencia));
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	
	function info_cta($codcta){
		$sql = "SELECT trim(codcta) codcta, trim(tpocta) tpocta, c.nivcta, trim(nomcta) nomcta,trim(c.depcta) depcta
,tercta, auxcta,bascta bascta,c.porcta,cencta,
			   trim(codcts) codcts, precta, trim(ctapre) ctapre, ajucta, invcta, trim(infcta) infcta, trim(moncta
) moncta,trim(ciecta) ciecta, hiscta, trim(c.codnif) codnif, trim(nomnif) nomnif 
			   FROM cntcta c left join cntpnf p on cast (p.codnif as text)=trim(c.codnif) WHERE trim(codcta)=?";
		$res = $this->db->query($sql,array($codcta));
		//echo $this->db->last_query();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	
	function datos_cuenta($codcta){
		$sql = "SELECT codcta, nomcta, tpocta, depcta, tercta FROM ".$this->cntcta." WHERE trim(codcta)='1'";
		$res = $this->db->query($sql,array($codcta));
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	
	function todas_cuentas(){
		$sql = "select codcta from ".$this->cntcta." order by codcta;";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}	
	}
	
	//Función para llenar tabla de buscar cuentas
	function obtener_cuentas_con_equiv(){
		$sql = "select codcta,nomcta,tpocta,c.nivcta,c.depcta,c.codnif,nomnif from cntcta c left join  cntpnf p on 
		        cast (p.codnif as text)=c.codnif order by codcta;";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	//Función para llenar tabla de buscar cuentas
	function obtener_cuentas(){
		$sql = "select codcta,nomcta,tpocta,nivcta from cntcta order by codcta;";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	//Función para llenar tabla de centros de costos
	function obtener_centro_c(){
		$sql = "select codcts,nomcts from ".$this->cntcts."";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	//Función para llenar tabla de cuentas por nivel 5
	function obtener_cuentas_nvl(){
	$sql = "select trim(codcta) as codcta, nomcta,tpocta,nivcta from ".$this->cntcta." where trim(codcta) != '' and  
	trim(tpocta)='Detalle' order by codcta;";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	//Función para llenar tabla de cuentas por nivel 5
	function obtener_cuentas_nif(){
	$sql = "select codnif as codcta, nomnif as  nomcta, nivcta as tpocta,  nivcta FROM cntpnf where nivcta='5'";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	//Función para agregar cuenta
	function agregar_cta($datos){
		$sql = "INSERT INTO cntcta (codcta, tpocta, nomcta,nivcta, depcta, tercta, auxcta, bascta, porcta,         cencta, codcts, precta, ctapre, ajucta, hiscta, invcta, infcta, moncta, codtpn, ciecta, codnif)
        VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?);";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	//Función para editar cuenta
	function actualizar_cta($datos){
		$sql = "UPDATE cntcta SET codcta= ?, tpocta=?, nomcta=?,depcta=?, tercta=?, auxcta=?, bascta=?, porcta=? , cencta=?, codcts=?, precta=?, ctapre=?, ajucta=? , hiscta=?, invcta=?, infcta=?, moncta=?,codtpn=?, ciecta=?, codnif=? WHERE trim(codcta)=?;";
		$this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	//Función para editar cuenta
	function editar_nif_cta($datos){
		$sql = "UPDATE cntcta SET codnif= ? WHERE trim(codcta)=?;";
		$this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	
	//Función para verificar si el codigo de cuenta a registrar ya existe
	function verificar_codigocta($codcta){
		$sql = 'select count(codcta) as cuenta from cntcta where trim(codcta)=?';
		$res = $this->db->query($sql,array($codcta));
		//echo $this->db->last_query();
		if($res->result_array()>0){
			return $res->result_array();
		}else{
			return false; // no existe	
		}
	}
	
	function eliminar_cuenta($codcta){
		$sql = "DELETE FROM ".$this->cntcta." WHERE trim(codcta) = '$codcta'";
		$this->db->query($sql);
		//echo $this->db->last_query();
		if($this->db->affected_rows()){
			return true;//actualizacion existosa
		}else{
			return false; // no actualizo	
		}		
	}
	
	function reporte(){
		$sql = "select codcta ,nomcta,tpocta,c.nivcta,c.depcta,c.codnif,nomnif  from cntcta  c left join cntpnf p on c.codnif=p.codnif::text ORDER BY c.codcta::text;";
		$res = $this->db->query($sql);
		if($res->result_array()>0){
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
	function consultarCuentaNift($codcta){
		$sql="select * from cntpnf where codnif=?";
		$res=$this->db->query($sql,$codcta);
		return($res->num_rows()>0)?$res->row_array():false;	
	}
	function agregar_cta_niif($datos){
		$this->db->insert('cntpnf',$datos);	
		return($this->db->affected_rows()>0)?true:false;
	}
		function items_principales_nif(){
		$sql = "select codnif as codcta,trim(nomnif) as nomcta from cntpnf where nivcta=1  order by codnif;";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	
		function sub_items_nif($nivel,$dependencia){
		$sql = "SELECT codnif as codcta, trim(nomnif) as nomcta FROM cntpnf WHERE nivcta=? AND trim(depcta)=? ORDER BY codcta;";
		$res = $this->db->query($sql,array($nivel,$dependencia));
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	function info_cta_nif($codcta){
		$sql="select codnif,trim(nomnif) as nomnif,trim(depcta) as depcta, nivcta, porcta from cntpnf where codnif=?";
		$res=$this->db->query($sql,$codcta);
		//echo $this->db->last_query();
		return($res->num_rows()>0)?$res->row_array():false;	
	}
	function eliminarCuentaNiif($where){
		$this->db->delete('cntpnf',$where);
		return($this->db->affected_rows()>0)?true:false;	
	}
	function editar_cta_niif($datos,$where){
		$this->db->update('cntpnf',$datos,$where);
		return($this->db->affected_rows()>0)?true:false;
	}
		function reporte_nif(){
		$sql = "select codnif,trim(nomnif) as nomnif ,nivcta,trim(depcta) as depcta from cntpnf order by codnif::text";
		$res = $this->db->query($sql);
		return($res->num_rows()>0)?$res->result_array():false;	
		
	}
}