<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class saldos_n_m extends CI_model {  
	function __Construct(){ 
	parent:: __construct();  
	}
		
	function obtener_saldos_cuentas_corte($cuenta,$fecha){
		$agncnt=substr($fecha,0,4);
		$nivcta=substr($cuenta,0,1);
		$ctaesp=substr($cuenta,0,4);
		
		$this->db->select('natcta');
		$this->db->from('cntpnf');
		$this->db->where('codnif',$cuenta);
		$nat = $this->db->get();
		if($nat->num_rows()>0){
		$rnat = $nat->row_array();
		
		
		if($ctaesp != '3215'){
		$natcta = $rnat['natcta'];
		if($natcta == 'D'){	$this->db->select('sum(debdcm)-sum(credcm) as saldo'); }
		else{ $this->db->select('sum(credcm)-sum(debdcm) as saldo'); }
		$this->db->from('view_sirco_detalle');
		if($nivcta > 3){$this->db->where('agncnt',$agncnt);}
		$condicion = "fchcmp <= '$fecha'";
		$this->db->where($condicion);
		$this->db->where('stdcmp','Generado');
		$this->db->like('trim(codnif)', $cuenta, 'after');
		}else{
		//UTILIDAD
			$e = explode("-",$fecha);
			$this->db->select('sum(credcm-debdcm) as saldo');	
			$this->db->from('view_sirco_detalle');
			$condicion = "(codnif like '4%' or codnif like '5%' or codnif like '6%' or codnif like '7%')";
			$this->db->where($condicion);
			$this->db->where('fchcmp <=',$fecha);
			$this->db->where('agncnt',$e['0']);
			$this->db->where('stdcmp','Generado');
		}
		//EXCEDENTES PERIODOS ANTERIORES
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
		if($ctaesp == '3225'){
		$e = explode("-",$fecha);
			$this->db->select('sum(credcm-debdcm) as sldant');	
			$this->db->from('view_sirco_detalle ');
			$this->db->where('stdcmp','Generado');
			$condicion = "(codnif like '4%' or codnif like '5%' or codnif like '6%' or codnif like '7%')";
			$this->db->where($condicion);
			$this->db->where('agncnt <',$e['0']);
			$res = $this->db->get();		
			$r = $res->row_array();
			$a += $r['sldant'];
			
			$this->db->select('COALESCE(sum(sldcta)) sldcta');	
			$this->db->from('cntutl');
			$this->db->where('agncnt <',$e['0']);
			$resb = $this->db->get();		
			$rb = $resb->row_array();
			$a -=$rb['sldcta'];
		}	
			}else{$a=0;}
			
			return $a;
		}
	
		function anexo_cuentas($fecini, $fecfin, $tbalance, $usuario){
		return $this->db->query("select (anexo_cuentas(date '".$fecini."', date '".$fecfin."','".$tbalance."','".$usuario."'))");
		}
		
		function anexo_patrimonio($fecini, $fecfin, $tbalance, $usuario){
		return $this->db->query("select (anexo_patrimonio(date '".$fecini."', date '".$fecfin."','".$tbalance."','".$usuario."'))");
		}
		
	   function saldos_cuentas_corte_ini($cuenta,$fecini,$fecfin,$usuario,$codbal){
			$this->db->select('sldant');
			$this->db->from('cntisn');
			$this->db->where('codnif',$cuenta);
			$this->db->where('fecini',$fecini);
			$this->db->where('fecfin',$fecfin);
			$this->db->where('addusr',$usuario);
			$this->db->where('codbal',$codbal);
			$res = $this->db->get();
			if($res->num_rows()>0){
			$res = $res->row_array();
			return $res['sldant'];
			}else{return 0;}
		}
		
		function saldos_cuentas_corte_fin($cuenta,$fecini,$fecfin,$usuario,$codbal){
			$this->db->select('sldcta');
			$this->db->from('cntisn');
			$this->db->where('codnif',$cuenta);
			$this->db->where('fecini',$fecini);
			$this->db->where('fecfin',$fecfin);
			$this->db->where('addusr',$usuario);
			$this->db->where('codbal',$codbal);
			$res = $this->db->get();
			if($res->num_rows()>0){
			$res = $res->row_array();
			return $res['sldcta'];
			}else{return 0;}
		}
		
	function excedentes_anios_anteriores($cuenta,$fecha,$usuario,$codbal){
		$e = explode("-",$fecha);
			$this->db->select('sum(debdcm-credcm) as saldo');	
			$this->db->from('view_sirco_detalle ');
			$this->db->where('stdcmp','Generado');
			$condicion = "(codnif like '4%' or codnif like '5%' or codnif like '6%' or codnif like '7%')";
			$this->db->where($condicion);
			$this->db->where('agncnt <',$e['0']);
			$res = $this->db->get();	
			//echo $this->db->last_query();
			//exit();	
			return $res->row_array();
	}
	
	function utilidad($fecha){
			$e = explode("-",$fecha);
			$this->db->select('sum(credcm-debdcm) as saldo');	
			$this->db->from('view_sirco_detalle ');
			$condicion = "(codnif like '4%' or codnif like '5%' or codnif like '6%' or codnif like '7%')";
			$this->db->where($condicion);
			$this->db->where('fchcmp <=',$fecha);
			$this->db->where('agncnt',$e['0']);
			$this->db->where('stdcmp','Generado');
			$res = $this->db->get();
			if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;	
	}
	
	function obtener_saldos_rango($fecini,$fecfin,$cuenta){
		$this->db->select('sum(debdcm-credcm) saldo, sum(debdcm) debito, sum(credcm) credito');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp','Generado');
		$this->db->where('trim(codnif)', $cuenta); 
		$this->db->where('fchcmp >=', $fecini); 
		$this->db->where('fchcmp <=', $fecfin); 
		$res = $this->db->get();
		if($res->num_rows()>0){
			return $res->row_array();
		}else{
			return false;	
		}
	}
	
	function obtener_saldos_agncnt($agncnt,$cuenta,$codtrc){
		$this->db->select('sum(credcm-debdcm) saldo, sum(basret) basret');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp','Generado');
		$this->db->where('trim(codnif)', $cuenta); 
		$this->db->where('agncnt', $agncnt); 
		$this->db->where('codtrc', $codtrc); 
		$res = $this->db->get();
		if($cuenta == '24240201'){
		//echo $this->db->last_query();
		}
		if($res->num_rows()>0){
			return $res->row_array();
		}else{
			return false;	
		}
	}
	
	function obtener_sld_agncnt($agncnt,$cuenta,$codtrc){
		$this->db->select('sum(debdcm) debdcm, sum(credcm) credcm');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp','Generado');
		$this->db->where('trim(codnif)', $cuenta); 
		$this->db->where('agncnt', $agncnt); 
		$this->db->where('codtrc', $codtrc); 
		$res = $this->db->get();
		//if($cuenta == '24240201'){
		//echo $this->db->last_query();
		//}
		if($res->num_rows()>0){
			return $res->row_array();
		}else{
			return false;	
		}
	}
	
	function saldo_corte_anual($cuenta,$fecini){
		$e = explode("-",$fecini);
		$this->db->select('sum(debdcm-credcm) as saldo');	
		$this->db->from('view_sirco_detalle ');
		$condicion = array('agncnt' => $e['0'], 'fchcmp < ' => $fecini);
		$this->db->where($condicion);
		$this->db->where('stdcmp','Generado');
		$this->db->where('trim(codnif)', $cuenta); 
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;
		}
		
	function saldo_corte_anual_n($cuenta,$fecini,$natcta){
		$e = explode("-",$fecini);
		if($natcta == 'D'){ $this->db->select('sum(debdcm)-sum(credcm) as saldo'); }
		else{ $this->db->select('sum(credcm)-sum(debdcm) as saldo'); }
		$this->db->from('view_sirco_detalle ');
		$condicion = array('agncnt' => $e['0'], 'fchcmp <= ' => $fecini);
		$this->db->where($condicion);
		$this->db->where('stdcmp','Generado');
		$this->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;
		}
			
	function saldo_corte($cuenta,$fecha,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipcon){
	    //Inicio de Contabilidad
		$this->db->select('agnnif');
		$this->db->from('actcia');
		$agn = $this->db->get();
		$ragn = $agn->row_array();
		extract($ragn);
		//Fin inicio contabilidad	
		//Inicio Nivel Cuenta
		$nivcta=substr($cuenta,0,1);
		$agncnt=explode('-',$fecha);
		//Fin Nivel Cuente
		
		
		$this->db->select('trim(natcta) natcta');
		$this->db->from('cntpnf');
		$this->db->where('codnif',$cuenta);
		$nat = $this->db->get();
		$rnat = $nat->row_array();
		$natcta = $rnat['natcta'];
		if($natcta == 'D'){ $this->db->select('sum(debdcm-credcm) as saldo'); }
		else{ $this->db->select('sum(credcm-debdcm) as saldo'); }
		if($nivcta > 3){$this->db->where('agncnt',$agncnt[0]);}
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp','Generado');
		$this->db->where('agncnt >',$agnnif);
		$this->db->where('fchcmp <',$fecha);
		if($tipcon == 'Local')$this->db->where('codcta',$cuenta);
		else{$this->db->where('codnif',$cuenta);}
		if($codtrca != 'n'){$this->db->where('codtrc >=', $codtrca); $this->db->where('codtrc <=', $codtrcb);}
		if($codctsa != 'n'){$this->db->where('codcts >=', $codctsa); $this->db->where('codcts <=', $codctsb);}
		if($codauxa != 'n'){$this->db->where('codaux >=', $codauxa); $this->db->where('codaux <=', $codauxb);}
		$res = $this->db->get();
		//SALDO LOCAL
		//
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			$r = $res->row_array();
			if($tipcon == 'Local'){
		$this->db->select('sld012');
		$this->db->from('view_sirco_cntsld_res');
		$this->db->where('codcta',$cuenta);
		$this->db->where('agncnt','2014');
		$sldloc = $this->db->get();
		$sld012 = $sldloc->row_array();
		$r['saldo'] +=$sld012['sld012'];
		}
			$a['saldo'] = $r['saldo'];
			$a['natcta'] = $natcta;
			}else{$a=0;}
			return $a;
		}	
		
}