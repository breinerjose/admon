<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resumen_documentos_m extends CI_Model {
	
	function __Construct(){
		parent:: __construct();
	}
	
	function nombre_doc($coddoc){
		$sql = "select nomdoc from cntdoc where trim(coddoc)=?";
		$res = $this->db->query($sql,array($coddoc));
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}
	}
	
	
	//verificado
	function sedes_por_documento($fte1,$ft2,$user){
		$sql = "select p.codsed, s.nomsed from cntper p inner join view_sirco_sedes s on trim(p.codsed)=trim(s.codsed)
where p.coddoc>=? and p.coddoc<=? and p.codusu=? group by p.codsed, s.nomsed order by codsed";
		$res = $this->db->query($sql,array($fte1,$ft2,$user));
		//echo $this->db->last_query($res);
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}			
	}
	
	function obtener_documentos($fecha1,$fecha2,$coddoc1,$coddoc2,$nrocmp1,$nrocmp2,$codsed,$condi){
		$this->db->select('distinct(coddoc) coddoc');
		$this->db->where('fchcmp >=',$fecha1);
		$this->db->where('fchcmp <=',$fecha2);
		$this->db->where('coddoc >=',$coddoc1);
		$this->db->where('coddoc <=',$coddoc2);
		$this->db->where('nrocmp >=',$nrocmp1);
		$this->db->where('nrocmp <=',$nrocmp2);
		if($codsed > 0){$this->db->where('codsed',$codsed);}
		$this->db->group_by('coddoc, codsed, agncnt, coddoc, nrocmp');
		if($condi=='revertido'){$this->db->where('stdcmp','Revertido');}
		if($condi=='descuadrados'){$this->db->where('stdcmp','Generado'); $this->db->having('sum(credcm-debdcm) != 0');} 
		if($condi=='cuadrados'){$this->db->where('stdcmp','Generado'); $this->db->having('sum(credcm-debdcm) = 0');} 
		$this->db->order_by('coddoc');
		$res = $this->db->get('view_sirco_detalle');
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}
	}
	
	//verificado
	function detalle($coddoc,$fecha1,$fecha2,$nrocmp1,$nrocmp2,$codsed,$condi){
		$this->db->select('fchcmp, agncnt, mescnt, nrocmp, sum(debdcm) debdcm, sum(credcm) credcm, nroegr, codsed, stdcmp');
		$this->db->where('coddoc',$coddoc);
		$this->db->where('fchcmp >=',$fecha1);
		$this->db->where('fchcmp <=',$fecha2);
		$this->db->where('nrocmp >=',$nrocmp1);
		$this->db->where('nrocmp <=',$nrocmp2);
		if($codsed > 0){$this->db->where('codsed',$codsed);}
		$this->db->group_by('fchcmp, agncnt, mescnt, nrocmp, nroegr, codsed, stdcmp');
		if($condi=='revertido'){$this->db->where('stdcmp','Revertido');}
		if($condi=='descuadrados'){$this->db->where('stdcmp','Generado'); $this->db->having('sum(credcm-debdcm) != 0');} 
		if($condi=='cuadrados'){$this->db->where('stdcmp','Generado'); $this->db->having('sum(credcm-debdcm) = 0');} 
		$this->db->order_by('fchcmp, nrocmp');
		$res = $this->db->get('view_sirco_detalle');
		//echo $this->db->last_query($res);
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}
	}
	
        //verificado 	
		function datos_tabla($doc1,$doc2,$fch1,$fch2,$coddoc1,$coddoc2,$codsed,$condi){
		$sql = "select fchcmp , nrocmp, debcmp, crecmp, codsed, coddoc, agncnt, mescnt, stdcmp from cntcmp 
		where trim(coddoc)>='".$doc1."' and trim(coddoc)<='".$doc2."' AND to_date(trim(fchcmp), 'dd/mm/yyyy') >='".$fch1."' AND 
		to_date(trim(fchcmp), 'dd/mm/yyyy') <='".$fch2."' and trim(nrocmp)>='".$coddoc1."' 
		and trim(nrocmp)<='".$coddoc2."' '".$codsed." ''".$condi."ORDER BY coddoc, nrocmp";
				
		$res = $this->db->query($sql);
	    //echo $this->db->last_query($res);
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}
	}

}