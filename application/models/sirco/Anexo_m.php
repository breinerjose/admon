<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anexo_m extends CI_model {
	function __Construct(){
	   parent::__construct();
	}
	
	function anexo($fecini,$fecfin,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$usuario){
	$sql = "select anexo_ini('$fecini','$fecfin','$codtrca','$codtrcb','$codctaa','$codctab','$codctsa','$codctsb','$codauxa','$codauxb','$usuario')";
		//echo $sql;
		//exit();
		$result = $this->db->query($sql);
		if($result->num_rows > 0){
			return true;
		}
		else{return false;}
	}
	
	function anexco_cuentas($addusr){
		$this->db->select('codnif, nomnif, sum(sldant) sldant, sum(credcm) credcm, sum(debdcm) debdcm, sum(sldcta) sldcta');
		$this->db->from('cntane');
		$this->db->where('addusr',$addusr);
		$this->db->group_by('codnif, nomnif');
		$this->db->order_by('codnif');
        $res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();;
		}else{
			return false;	
		}	
	
	}
	
	function anexo_detalle($addusr,$codnif){
		$this->db->select('codtrc, nomtrc, sldant, debdcm, credcm, sldcta');
		$this->db->from('cntane');
		$this->db->where('codnif',$codnif);
		$this->db->where('addusr',$addusr);
		$this->db->order_by('codtrc');
        $res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();;
		}else{
			return false;	
		}	
	}
	
	


}