<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Estados_balance_n_m extends CI_Model {
	
	
	function __Construct(){
	 	parent:: __construct();		
	}
	
		//
	function insertar($tabla,$data){
		$this->db->insert($tabla,$data);
		//echo $this->db->last_query();
		//exit();
		// return($this->db->affected_rows()>0)?true:false;
		}
		
	function actualizar($tabla,$data,$condicion){
		$this->db->where($condicion);
		$this->db->update($tabla,$data);
		 //return($this->db->affected_rows()>0)?true:false;
		}	
		
			
	function borrar($tabla, $condicion){
		$this->db->where($condicion);
		$this->db->delete($tabla);
		 return($this->db->affected_rows()>0)?true:false;
		}	
		
		function calcular_saldos_niif($fecini,$fecfin,$codcta,$tbalance){
		$sql = "SELECT (SELECT sum(debdcm-credcm)  FROM view_sirco_detalle v WHERE  v.fchcmp < ? AND v.stdcmp='Generado' 
		AND v.codnif=view_sirco_detalle.codnif) saldoant, 
		(SELECT sum(credcm) FROM view_sirco_detalle s WHERE s.fchcmp >= ? and s.fchcmp <= ? AND s.stdcmp='Generado' 
		AND s.codnif=view_sirco_detalle.codnif) credito, 
		sum(debdcm-credcm) saldo, codnif debito FROM view_sirco_detalle 
		WHERE fchcmp <= ? AND stdcmp='Generado' AND substring(codnif,1,1)=? GROUP BY codnif ORDER BY codnif";
		$res = $this->db->query($sql,array($fecini,$fecini,$fecfin,$fecfin,$codcta));
		$res->row_array();	
		foreach($res as $cta){
			$data = array('codnif' => $cta['codnif'], 'sldant' => $a['sldant'],'codbal' => $tbalance, 
		'addusr' => $this->session->userdata('codigo'),'debito' => $a['debito'],		
		'credito' =>$a['credito'],'sldant' => $b);
		$this->esta->insertar('cntisn',$data);	
			}
		}
		
		function cuentas_detalle_niif($fecha,$nivcta){
		$this->db->select('distinct(trim(codnif)) codnif');
		$this->db->from('view_sirco_detalle ');
		$this->db->where('fchcmp <=', $fecha);
		$this->db->where('stdcmp =', 'Generado');
		$this->db->where('codnif !=','32150101'); //Utilidad
		if($nivcta == 4){
		$this->db->where('substring(codnif,1,1) <', $nivcta);}
		else{$this->db->where('substring(codnif,1,1) >', '3');}
		$res = $this->db->get();
		return $res->result_array();
			}
			
			
		function saldos_bal_d($fecha){
		$this->db->select('distinct(trim(codnif)) codnif');
		$this->db->from('view_sirco_detalle ');
		$this->db->where('fchcmp <=', $fecha);
		$this->db->where('stdcmp =', 'Generado');
		$this->db->where('codnif !=','32150101'); //Utilidad
		if($nivcta == 4){
		$this->db->where('substring(codnif,1,1) <', $nivcta);}
		else{$this->db->where('substring(codnif,1,1) >', '3');}
		$res = $this->db->get();
		return $res->result_array();
			}
			
		function saldos_bal_c($fecha){
		$this->db->select('distinct(trim(codnif)) codnif');
		$this->db->from('view_sirco_detalle ');
		$this->db->where('fchcmp <=', $fecha);
		$this->db->where('stdcmp =', 'Generado');
		$this->db->where('codnif !=','32150101'); //Utilidad
		if($nivcta == 4){
		$this->db->where('substring(codnif,1,1) <', $nivcta);}
		else{$this->db->where('substring(codnif,1,1) >', '3');}
		$res = $this->db->get();
		return $res->result_array();
			}		
				
					
		function est_bal_pru($fecini,$fecfin,$codbal,$usuario){
		$this->db->select('cntisn.codnif codnif, cntpnf.nomnif nomnif, debito, credito, sldcta, sldant, tpocta, tipsld');
		$this->db->from('cntisn, cntpnf');
		$condicion = "trim(cntisn.codnif)=trim(cntpnf.codnif)";
		$this->db->where($condicion);
		$this->db->where('nivcta <=','5');
		$this->db->where('fecini',$fecini);
		$this->db->where('fecfin',$fecfin);
		$this->db->where('codbal',$codbal);
		$this->db->where('addusr',$usuario);
		$this->db->order_by('cntisn.codnif');
		$res =$this->db->get(); 
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();	
		}else{ return false; }
		}
	
		function est_bal($fecini,$fecfin,$codbal,$usuario){
		$this->db->select('cntisn.codnif codnif, cntpnf.nomnif nomnif, debito, credito, sldcta, sldant, tpocta');
		$this->db->from('cntisn, cntpnf');
		$condicion = "(sldant != '0.00' or sldcta != '0' or credito != '0' or debito != '0')  and trim(cntisn.codnif)=trim(cntpnf.codnif)";
		$this->db->where($condicion);
		$this->db->where('nivcta <=','5');
		$this->db->where('fecini',$fecini);
		$this->db->where('fecfin',$fecfin);
		$this->db->where('codbal',$codbal);
		$this->db->where('addusr',$usuario);
		$this->db->where('substring(cntisn.codnif,1,1) <', '4');
		$this->db->order_by('cntisn.codnif');
		$res =$this->db->get(); 
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();	
		}else{ return false; }
		}
		
		function sumapasivopatrimonio($fecini,$fecfin,$codbal,$usuario){
		$this->db->select('sum(sldcta::numeric) sldcta, sum(sldant::numeric) sldant');
		$this->db->from('cntisn');
		$this->db->where('fecini',$fecini);
		$this->db->where('fecfin',$fecfin);
		//$this->db->where('codbal',$codbal);
		$this->db->where('addusr',$usuario);
		$condicion = "(codnif = '2' or codnif= '3')";
		$this->db->where($condicion);
		$res =$this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->row_array();
		}else{ return false; }	
		}
		
		function sumapasivopatrimoniocompar($fecini,$fecfin,$codbal,$usuario){
		$this->db->select('sldcta*-1');
		$this->db->from('cntisn');
		$this->db->where('fecini',$fecini);
		$this->db->where('fecfin',$fecfin);
		$this->db->where('codbal',$codbal);
		$this->db->where('addusr',$usuario);
		$condicion = "(codnif = '2' or codnif= '3')";
		$this->db->where($condicion);
		$res =$this->db->get();
		if($res->num_rows()>0){
			$rb = $res->row_array();
			return $rb['sldcta'];
		}else{ return false; }	
		}

}