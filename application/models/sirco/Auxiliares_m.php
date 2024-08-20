<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auxiliares_m extends CI_model {
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
	
function nom_cc($codcc){
		$sql = "select nomcts from cntcts where trim(codcts)=?";
		$res = $this->db->query($sql,array(trim($codcc)));
		if($res->num_rows()>0){
			return $res->row_array();;
		}else{
			return false;	
		}	
	}
	
	function cuentas($fecini,$fecfin,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$agncnta,$agncntb,$mescnta,$mescntb,$tipcon){
		if($tipcon == 'Local'){$this->db->select('codcta');}else{$this->db->select('codnif codcta');}
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp =', 'Generado');
		$this->db->where('fchcmp >=', $fecini); 
		$this->db->where('fchcmp <=', $fecfin);
		if($agncnta == $agncntb){$this->db->where('agncnt', $agncnta);} 
		if($mescnta == $mescntb){$this->db->where('mescnt', $mescnta);}
		if($tipcon == 'Local'){
		if($codctaa != 'n'){ $this->db->where('codcta >=', $codctaa);}
		if($codctab != 'n'){ $this->db->where('codcta <=', $codctab);} 
		}else{
		if($codctaa != 'n'){ $this->db->where('codnif >=', $codctaa); }
		if($codctab != 'n'){ $this->db->where('codnif <=', $codctab);} 
		}
		if($codtrca != 'n'){$this->db->where('codtrc >=', $codtrca);}
		if($codtrcb != 'n'){$this->db->where('codtrc <=', $codtrcb);}
		if($codctsa != 'n'){$this->db->where('codcts >=', $codctsa);}
		if($codctsb != 'n'){$this->db->where('codcts <=', $codctsb);}
		if($codauxa != 'n'){$this->db->where('codaux >=', $codauxa);}
		if($codauxb != 'n'){$this->db->where('codaux <=', $codauxb);}
		if($tipcon == 'Local'){$this->db->group_by('codcta'); $this->db->order_by('codcta');}else{$this->db->group_by('codnif'); $this->db->order_by('codnif');}
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function obtener_saldos_cuentas_mes($cuenta,$periodo,$campo){
		$sql = "select sld0$campo saldo from view_sirco_cntsld_res  where trim(codcta)=? and agncnt=?";	
		$res = $this->db->query($sql,array($cuenta,$periodo));
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			$saldoActual = $res->result_array();
			$saldo = $saldoActual[0]['saldo'];
			return intval($saldo);
		}else{
			return false;	
		}
	}
	
	
	function saldos_cuentas_tercero_mes($cuenta,$periodo,$campo,$codtrc){
		$sql = "select sld0$campo saldo from view_sirco_cntcpa_res  where trim(codcta)=? and agncnt=? and codtrc=?";	
		$res = $this->db->query($sql,array($cuenta,$periodo,$codtrc));
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			$saldoActual = $res->result_array();
			$saldo = $saldoActual[0]['saldo'];
			return intval($saldo);
		}else{
			return false;	
		}
	}
	
	function nombre_cuenta($cuenta,$tipcon){
		if($tipcon == 'Local'){
		$this->db->select('nomcta');
		$this->db->from('cntcta');
		$this->db->where('codnif',$cuenta);}else{
		$this->db->select('nomnif nomcta');
		$this->db->from('cntpnf');
		$this->db->where('codnif',$cuenta);
		}
        $res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->row_array();;
		}else{
			return false;	
		}	
	}
	
	function detalle($fecha1,$fecha2,$codcta,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$anioa,$aniob,$mesa,$mesb,$tipcon){
		if($tipcon == 'Local'){
		
		$sql = "SELECT nroegr, fchcmp fch, fchcmp ,codsed ,coddoc , view_sirco_detalle.nrocmp, nomtrc, codcts, debdcm, credcm, detdcm, ' CC:'||codcts||' ACRATE:'||fchpgs||' RC:'||rcbkja as actpgs 
			    FROM view_sirco_detalle left join actpgs on agncnt||mescnt||coddoc||view_sirco_detalle.nrocmp=nrotrn
			    WHERE trim(stdcmp)='Generado' AND (fchcmp BETWEEN ? AND ?) AND trim(codcta)=?";
			
		if($codtrca != 'n'){$sql .= " AND codtrc >= '$codtrca' AND codtrc <= '$codtrcb'";}
		if($codctsa != 'n'){$sql .= " AND codcts >= '$codctsa' AND codcts <= '$codctsb'";}
		if($codauxa != 'n'){$sql .= " AND codaux >= '$codauxa' AND codaux<= '$codauxb'";}
		$sql .=" ORDER BY fch, coddoc, nrocmp";	}else{
		
		$sql = "SELECT nroegr, fchcmp fch, fchcmp ,codsed ,coddoc , view_sirco_detalle.nrocmp, nomtrc, codcts, debdcm, credcm, detdcm, ' CC:'||codcts||' ACRATE:'||fchpgs||' RC:'||rcbkja as actpgs 
			    FROM view_sirco_detalle left join actpgs on agncnt||mescnt||coddoc||view_sirco_detalle.nrocmp=nrotrn
			    WHERE trim(stdcmp)='Generado' AND (fchcmp BETWEEN ? AND ?) AND trim(codnif)=?";
			
		if($codtrca != 'n'){$sql .= " AND codtrc >= '$codtrca' AND codtrc <= '$codtrcb'";}
		if($codctsa != 'n'){$sql .= " AND codcts >= '$codctsa' AND codcts <= '$codctsb'";}
		if($codauxa != 'n'){$sql .= " AND codaux >= '$codauxa' AND codaux<= '$codauxb'";}
		if($anioa == $aniob){$sql .= " AND agncnt = '$anioa'";}
		if($mesa == $mesb and $anioa == $aniob){$sql .= " AND mescnt='$mesa'";}
		$sql .=" ORDER BY fch, coddoc, nrocmp";
		
		}
			$res = $this->db->query($sql,array($fecha1,$fecha2,$codcta));
			//echo $this->db->last_query();
		   //exit();
		
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
}