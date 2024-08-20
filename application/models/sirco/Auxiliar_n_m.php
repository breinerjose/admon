<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auxiliar_n_m extends CI_model {
	function __Construct(){
	   parent::__construct();
	}
	
	function auxiliares(){
	$sql= "select trim(codaux) as codaux, trim(nomaux) as nomaux
		      from cntaux where trim(codaux)!='' order by codaux";
	  $res = $this->db->query($sql);
	  return ($res->num_rows() >0)? $res->result_array():false;	
	}
	
	//infromacion auxiliares 
	function informacionAuxiliares(){
	    $sql= "select trim(codaux) as codaux, trim(nomaux) as nombre
		      from cntaux where trim(codaux)!='' order by codaux";
	  $res = $this->db->query($sql);
	  return ($res->num_rows() >0)? $res->result_array():false;	
	}
	
	//revisar si se usa
	function obtener_documentos($fecha1,$fecha2,$codnifa,$codnifb,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb){
		$sql = "select DISTINCT(coddoc) coddoc FROM cntcmp c, cntdcm d WHERE trim(d.agncnt)=trim(c.agncnt) AND trim(d.mescnt)=trim(c.mescnt) AND trim(d.nrocmp)=trim(c.nrocmp) AND trim(d.coddoc)=trim(c.coddoc) AND trim(d.codsed)=trim(c.codsed) AND to_date(trim(fchdcm), 'dd/mm/yyyy')>='".$fecha1."' AND 	 
		to_date(trim(fchdcm), 'dd/mm/yyyy')<='".$fecha2."' AND trim(codnif)>='".$codnifa."' AND trim(codnif)<='".$codnifb."'";
		if($codtrcb != 0){$sql .= " AND trim(codtrc) >= '$codtrca' AND trim(codtrc) <= '$codtrcb'";}
		if($codctsb != 0){$sql .= " AND trim(codcts) >= '$codctsa' AND trim(codcts) <= '$codctsb'";}
		if($codauxa != 0){$sql .= " AND trim(codaux) >= '$codauxa' AND trim(codaux) <= '$codauxb'";}
		$sql .= "AND trim(stddcm)='Generado' group by coddoc order by coddoc";
		$res = $this->db->query($sql,array($fecha1,$fecha2,$codnifa,$codnifb,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb));
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}
	}
	
	function nombre_cuenta($cod){
		$sql = "select nomnif AS nomcta from cntpnf where trim(codnif)=?";
		$res = $this->db->query($sql,array(trim($cod)));
		if($res->num_rows()>0){
			return $res->row_array();;
		}else{
			return false;	
		}	
	}
	
	
	function cuentas($fecha1,$fecha2,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb){
	
		$this->db->select('codnif codcta');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp =', 'Generado');
		$this->db->where('fchcmp >=', $fecha1);
		$this->db->where('fchcmp <=', $fecha2);
		$this->db->where('codnif !=', 'X');
		if($codctaa != 0){$this->db->where('codnif >=', $codctaa);}
		if($codctab != 0){$this->db->where('codnif <=', $codctab);}
		if($codtrca != 0){$this->db->where('codtrc >=', $codtrca);}
		if($codtrcb != 0){$this->db->where('codtrc <=', $codtrcb);}
		if($codctsa != 0){$this->db->where('codcts >=', $codctsa);}
		if($codctsb != 0){$this->db->where('codcts <=', $codctsb);}
		if($codauxa != 0){$this->db->where('codaux >=', $codauxa);}
		if($codauxb != 0){$this->db->where('codaux <=', $codauxb);}
		$this->db->group_by('codnif');
		$this->db->order_by('codcta');
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function detalle($fecha1,$fecha2,$codnif,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb){
		$sql = "SELECT fchcmp fch, fchcmp ,codsed ,coddoc , view_sirco_detalle.nrocmp, nomtrc, codcts, debdcm, credcm, 
		detdcm, ' CC:'||codcts||'ACRATE:'||fchpgs||' RC:'||rcbkja as actpgs 
		FROM view_sirco_detalle left join actpgs on agncnt||mescnt||coddoc||view_sirco_detalle.nrocmp=nrotrn
		WHERE trim(stdcmp)='Generado' AND (fchcmp BETWEEN ? AND ?) AND trim(codnif)=?";
			
		if($codtrca != 0){$sql .= " AND codtrc >= '$codtrca' AND codtrc <= '$codtrcb'";}
		if($codctsa != 0){$sql .= " AND codcts >= '$codctsa' AND codcts <= '$codctsb'";}
		if($codauxa != 0){$sql .= " AND codaux >= '$codauxa' AND codaux <= '$codauxb'";}
		$sql .=" ORDER BY fch, coddoc, nrocmp";	
		$res = $this->db->query($sql,array($fecha1,$fecha2,$codnif));
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function obtener_saldos_cuentas_mes($cuenta,$fecha){
		$sql = "SELECT (sum(debdcm)-sum(credcm)) saldo FROM view_sirco_detalle WHERE 
		codnif =? AND trim(stdcmp)='Generado' AND fchcmp < ?";	
		$res = $this->db->query($sql,array($cuenta,$fecha));
		//echo $this->db->last_query();
		//exit();
		
		//
		
		if($res->num_rows()>0){
			$saldoActual = $res->result_array();
			$saldo = $saldoActual[0]['saldo'];
			return intval($saldo);
		}else{
			return false;	
		}
	}
	
	function nom_trc($codtrc){
		$sql = "select nomtrc from cnttrc where trim(codtrc)=?";
		$res = $this->db->query($sql,array(trim($codtrc)));
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->row_array();;
		}else{
			return false;	
		}	
	}
	
	function nom_aux($codaux){
		$sql = "select nomaux from cntaux where trim(codaux)=?";
		$res = $this->db->query($sql,array(trim($codaux)));
		if($res->num_rows()>0){
			return $res->row_array();;
		}else{
			return false;	
		}	
	}
	
	function nom_cc($codcc){
		$sql = "select nomcts from cntcts where trim(codcts)=?";
		$res = $this->db->query($sql,array(trim($codcc)));
		if($res->num_rows()>0){
			return $res->row_array();;
		}else{
			return false;	
		}	
	}
	
}
?>