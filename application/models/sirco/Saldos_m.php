<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class saldos_m extends CI_model {  
	function __Construct(){ 
		parent:: __construct(); 
	}
	
	
	//RECALCULAR SALDOS LOCAL
	function recalcular_equivalencias($anio,$mesi,$mesf){
		$this->db->select('distinct(codnif) codnif');
		$this->db->from('cntdcm');
		$condicion="(mescnt='10' or mescnt='11' or mescnt='12')";
		$this->db->where('codcta','X');
		$this->db->where('codnif !=', 'X');
		$this->db->where('agncnt','2017');
		$this->db->where($condicion);

		$data = $this->db->get();
		$res = $data->result_array();
		foreach($res as $row){
			
		$this->db->select('trim(codcta) codcta');
		$this->db->from('cntcta');
		$this->db->where('codnif',$row['codnif']);
		$datab = $this->db->get();
		if($datab->num_rows()==1){
		$resb = $datab->row_array();
		$datos = array('codcta' => $resb['codcta']);
		$condicion="(mescnt='10' or mescnt='11' or mescnt='12')";
		$this->db->where('codcta','X');
		$this->db->where('codnif !=', 'X');
		$this->db->where('agncnt','2017');
		$this->db->where('codcta','X');
		$this->db->update('cntdcm',$datos);
		//if( $row['codnif'] == '11100501'){
		//echo $this->db->last_query();
		//exit();
		}
		}
		
		return true;
	}
	
	function traslado_saldos($ctaact,$ctanva,$agncnt,$mescnt){
		$datos = array('codnif' => $ctanva);
		$condicion = array('codnif' => $ctaact, 'agncnt' => $agncnt, 'mescnt' => $mescnt);
		$this->db->where($condicion);
		$this->db->update('cntdcm',$datos);
	   if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}
	
	function obtener_saldos_acum($tipo,$cuenta,$codtrc,$anio,$codsed,$codcts,$codaux,$salant){
	 if($salant=='No'){
	 $a = array(
		0 => array(
		'debdcm' => 0,
		'credcm' => 0,
		));
	  return $a;
	 }else{
	
	
		$this->db->select('sum(debdcm) debdcm, sum(credcm) credcm');
		$this->db->from('view_sirco_detalle');
		if($tipo == 'Local'){$this->db->where('codcta =', $cuenta);}else{$this->db->where('codnif =', $cuenta);}
		$this->db->where('agncnt <', $anio);
		$this->db->where('stdcmp =', 'Generado');
		if($codsed != '000'){$this->db->where('codsed =', $codsed);}
		if($codtrc != ''){$this->db->where('codtrc =', $codtrc);}
		if($codcts != ''){$this->db->where('codcts =', $codcts);}
		if($codaux != ''){$this->db->where('codaux =', $codaux);}
		$res = $this->db->get();
		$a = $res->result_array();
        if($a['0']['debdcm'] == ''){
		$a = array(
		0 => array(
		'debdcm' => 0,
		'credcm' => 0,
		));
		}
		return $a;
	  }
	}
	
	//SALOS POR CUENTAS LOCALES
	function obtener_saldos($tipo,$cuenta,$codtrc,$anio,$codsed,$mes,$codcts,$codaux){
		$this->db->select('sum(debdcm) debdcm, sum(credcm) credcm');
		$this->db->from('view_sirco_detalle ');
		if($tipo == 'Local'){$this->db->where('codcta =', $cuenta);}else{$this->db->where('codnif =', $cuenta);}
		$this->db->where('agncnt =', $anio);
		$this->db->where('mescnt =', $mes);
		$this->db->where('stdcmp =', 'Generado');
		if($codsed != '000'){$this->db->where('codsed =', $codsed);}
		if($codtrc != ''){$this->db->where('codtrc =', $codtrc);}
		if($codcts != ''){$this->db->where('codcts =', $codcts);}
		if($codaux != ''){$this->db->where('codaux =', $codaux);}
		$res = $this->db->get();
		$a = $res->result_array();
        if($a['0']['debdcm'] == ''){ 
		$a = array(
		0 => array(
		'debdcm' => 0,
		'credcm' => 0,
		));
		}
		return $a;
	}
	
	
	function saldo_al_dia(){
		$sql = "select obtener_saldo_cta('01/07/2016','11050501','Detalle','')";
		$res = $this->db->query($sql);	
		if($res->num_rows()>0){
				$suma=$res->row_array();	
				$suma['obtener_saldo_cta'];
				$sql2="select sum(credcm)-sum(debdcm) as saldo from view_sirco_detalle 
				WHERE codcta='11050501' and mescnt='07' and  to_date(trim(fchcmp), 'dd/mm/yyyy') <= '01/07/2016' AND stdcmp='Generado'";
				$res2 = $this->db->query($sql2);
				
				if($res2->num_rows()>0){
				$suma2=$res2->row_array();
				return $suma['obtener_saldo_cta']+$suma2['saldo'];
					
				}else{
				return false;
			}
			}else{
				return false;
			}		
		}
		
			
	function estado_periodo($agncnt,$mescnt){
		$sql = "select * from cntprd where agncnt='$agncnt' and mescnt='$mescnt' and trim(stdprd)='Abierto'";
		//echo $sql;
		//exit();
		$result = $this->db->query($sql);
		if($result->num_rows > 0){
			return true;
		}
		else{return false;}		
	}
	
	function diferencias_niif($anio,$fecini,$fecfin){
		$this->db->select('nrocmp, coddoc, fchcmp, debdcm, credcm, detdcm, codcta, codnif');
		$this->db->from('view_sirco_detalle ');
		$condicion = array('agncnt =' => $anio, 'mescnt >=' => $fecini, 'mescnt <=' => $fecfin);
		$this->db->where($condicion);
		$condicionb="codcta = 'X' and codnif != 'X' AND coddoc != '99' AND stdcmp='Generado' AND (codnif like'1%' OR codnif like'2%' OR codnif like'3%')";
		$this->db->where($condicionb);
		$res = $this->db->get();
		
		//$res = $this->db->get()->result_array();
		//$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
	function diferencias_local($anio,$fecini,$fecfin){
		$this->db->select('nrocmp, coddoc, fchcmp, debdcm, credcm, detdcm, codcta, codnif');
		$this->db->from('view_sirco_detalle ');
		$condicion = array('agncnt =' => $anio, 'mescnt >=' => $fecini, 'mescnt <=' => $fecfin);
		$this->db->where($condicion);
		$condicionb="codcta != 'X' and codnif = 'X' AND coddoc != '99' AND stdcmp='Generado' AND (codcta like'1%' OR codcta like'2%' OR codcta like'3%')";
		$this->db->where($condicionb);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}

function sin_equivalencias($anio,$mesf,$mesi){
		$this->db->select('codcta');
		$this->db->from('view_sirco_detalle');
		$this->db->where('codnif','X');
		$this->db->where('codcta !=','X');
		$this->db->where('coddoc !=','99');
		$this->db->where('agncnt >','2016');
		$this->db->where('tipsft','Escritorio');
		$this->db->where('stdcmp','Generado');
		$this->db->group_by(array("codcta"));
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	}
	
//SALOS POR CUENTAS LOCALES
	function sld_ant_cta($codcta,$fecha,$tipo){
		$this->db->select('sum(debdcm) debdcm, sum(credcm) credcm');
		$this->db->from('view_sirco_detalle ');
		if($tipo == 'Local'){$this->db->where('codcta =', $cuenta);}else{$this->db->where('codnif =', $cuenta);}
		$this->db->where('agncnt =', $anio);
		$this->db->where('mescnt =', $mes);
		$this->db->where('stdcmp =', 'Generado');
		$this->db->where('natcta =', 'D');
		$res = $this->db->get();
		if($res->num_rows() > 0){
			return $res->row_array();
			}else{
		$this->db->select('sum(debdcm) debdcm, sum(credcm) credcm');
		$this->db->from('view_sirco_detalle ');
		if($tipo == 'Local'){$this->db->where('codcta =', $cuenta);}else{$this->db->where('codnif =', $cuenta);}
		$this->db->where('agncnt =', $anio);
		$this->db->where('mescnt =', $mes);
		$this->db->where('stdcmp =', 'Generado');
		$this->db->where('natcta =', 'C');
		$res = $this->db->get();	
		if($res->num_rows() > 0){
			return $res->row_array();
			}else{return false;}
				}
	}	
	

	

		function calcular_saldos_niif($fecini,$fecfin,$codbal,$usuario){
		$e = explode("-",$fecini);
		$ee = explode("-",$fecfin);
		//BORRO INFORME ANTERIOR
		$this->db->where('fecini',$fecini);
		$this->db->where('fecfin',$fecfin);
		$this->db->where('codbal',$codbal);
		$this->db->where('addusr',$usuario);
		$this->db->delete('cntisn');
		
		//CUENTAS BALANCE
		$this->db->select('codnif, sum(debdcm-credcm) sldant');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('codnif !=', 'X');
		$this->db->where('fchcmp <=', $fecini);
		$this->db->where('substring(codnif,1,1) <', '4');
		$this->db->group_by('codnif');
		$res = $this->db->get();
		
		//echo $this->db->last_query();
		//exit();
		
		foreach($res->result_array() as $cta){
		$data = array('codnif' => $cta['codnif'], 'sldant' => $cta['sldant'], 'fecini' => $fecini,'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario);
		$this->db->insert('cntisn',$data);}
		$condicion= array('sldant' => '0.00','codbal'=>$codbal,'fecini'=>$fecini,'fecfin'=>$fecfin, 'addusr' => $usuario);
		$this->db->where($condicion);
		$this->db->delete('cntisn');
		//
		
		if($fecini != $fecfin){
		$this->db->select('codnif, sum(credcm) credito, sum(debdcm) debito, sum(debdcm-credcm) sldcta');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('codnif !=', 'X');
		$this->db->where('substring(codnif,1,1) <', '4');
		$this->db->where('fchcmp >', $fecini);
		$this->db->where('fchcmp <=', $fecfin);
		$this->db->group_by('codnif');
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		foreach($res->result_array() as $cta){
		$this->db->select('codnif');
		$this->db->from('cntisn');
		$this->db->where('codnif', $cta['codnif']);
		$this->db->where('fecini', $fecini);
		$this->db->where('fecfin', $fecfin);	
		$this->db->where('codbal', $codbal);	
		$this->db->where('addusr', $usuario);	
		$resb = $this->db->get();
			if($resb->num_rows()>0){
			$condicion = array('codnif' => $cta['codnif'],'fecini' => $fecini, 'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario);
			$data = array( 'credito' => $cta['credito'], 'debito' => $cta['debito'], 'sldcta' => $cta['sldcta']);
			$this->db->where($condicion);
			$this->db->update('cntisn',$data);
			}else{	
			$data = array('codnif' => $cta['codnif'], 'credito' => $cta['credito'], 'debito' => $cta['debito'], 'sldcta' => $cta['sldcta'], 
			'fecini' => $fecini, 'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario);
			$this->db->insert('cntisn',$data);
			}
		}
		}
		//CUENTAS DE ORDEN
		$this->db->select('codnif, sum(debdcm-credcm) sldant');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('codnif !=', 'X');
		$this->db->where('agncnt',$e['0']);
		$this->db->where('fchcmp <=', $fecini);
		$this->db->where('substring(codnif,1,1) >', '3');
		$this->db->group_by('codnif');
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		foreach($res->result_array() as $cta){
		$data = array('codnif' => $cta['codnif'], 'sldant' => $cta['sldant'], 'fecini' => $fecini,'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario, 'tipsld' => '1');
		$this->db->insert('cntisn',$data);}
		$condicion= array('sldant' => '0.00','codbal'=>$codbal,'fecini'=>$fecini,'fecfin'=>$fecfin, 'addusr' => $usuario);
		$this->db->where($condicion);
		$this->db->delete('cntisn');
		//	
		$agncnt = explode("-",$fecfin);
		$this->db->select('codnif, sum(credcm) credito, sum(debdcm) debito, sum(debdcm-credcm) sldcta');
		$this->db->from('view_sirco_detalle');
		$this->db->where('stdcmp', 'Generado');
		$this->db->where('codnif !=', 'X');
		$this->db->where('agncnt',$agncnt['0']);
		$this->db->where('substring(codnif,1,1) >', '3');
		$this->db->where('fchcmp >', $fecini);
		$this->db->where('fchcmp <=', $fecfin);
		$this->db->group_by('codnif');
		$res = $this->db->get();
		foreach($res->result_array() as $cta){
		$this->db->select('codnif');
		$this->db->from('cntisn');
		$this->db->where('codnif', $cta['codnif']);
		$this->db->where('fecini', $fecini);
		$this->db->where('fecfin', $fecfin);	
		$this->db->where('codbal', $codbal);
		$this->db->where('addusr',$usuario);		
		$resb = $this->db->get();
			if($resb->num_rows()>0){
			$condicion = array('codnif' => $cta['codnif'],'fecini' => $fecini, 'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario);
			$data = array( 'credito' => $cta['credito'], 'debito' => $cta['debito'], 'sldcta' => $cta['sldcta']);
			$this->db->where($condicion);
			$this->db->update('cntisn',$data);
			}else{	
			$data = array('codnif' => $cta['codnif'], 'credito' => $cta['credito'], 'debito' => $cta['debito'], 'sldcta' => $cta['sldcta'], 
			'fecini' => $fecini, 'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario, 'tipsld' => '1');
			$this->db->insert('cntisn',$data);
			}
		}
		// campos nulos
		$data = array('sldcta' => '0');
		$condicion="sldcta is null";
		$this->db->where($condicion);
		$this->db->update('cntisn',$data);
		$data = array('sldant' => '0');
		$condicion="sldant is null";
		$this->db->where($condicion);
		$this->db->update('cntisn',$data);
		//UTILIDAD DEL EJERCICIO ANTERIOR
			$e = explode("-",$fecini);
			$this->db->select('sum(credcm-debdcm) as sldant');	
			$this->db->from('view_sirco_detalle ');
			$this->db->where('stdcmp','Generado');
			$condicion = "(codnif like '4%' or codnif like '5%' or codnif like '6%' or codnif like '7%')";
			$this->db->where($condicion);
			$this->db->where('agncnt <',$e['0']);
			$res = $this->db->get();		
			$r = $res->row_array();
			$a = $r['sldant']*-1;
			
			$this->db->select('sldant');
			$this->db->from('cntisn');
			$this->db->where('codnif', '32250101');
			$this->db->where('fecini',$fecini);
			$this->db->where('fecfin',$fecfin);
			$this->db->where('codbal',$codbal);
			$this->db->where('addusr',$usuario);
			//echo $this->db-last_query();
			//exit();
					
			$resb = $this->db->get();
			if($resb->num_rows()>0){
			$rb = $resb->row_array();
			$a = $a-($rb['sldant']*-1);
			
			$this->db->select('COALESCE(sum(sldcta)) sldcta');	
			$this->db->from('cntutl');
			$this->db->where('agncnt <',$e['0']);
			$resb = $this->db->get();		
			$rb = $resb->row_array();
			$a +=$rb['sldcta'];
			//echo $this->db->last_query();
			//exit();
			
			$condicion = array('codnif' => '32250101','fecini' => $fecini, 'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario);
			$data = array('sldant' => $a);
			$this->db->where($condicion);
			$this->db->update('cntisn',$data);
			//echo $this->db->last_query();
			//exit();
			}else{
			// 'credito' => '0.00', 'debito' => '0.00',
			$this->db->select('COALESCE(sum(sldcta)) sldcta');	
			$this->db->from('cntutl');
			$this->db->where('agncnt <',$e['0']);
			$resb = $this->db->get();		
			$rb = $resb->row_array();
			$a +=$rb['sldcta'];
			//echo $this->db->last_query();
			//exit();
			
			
			$data = array('codnif' => '32250101', 'sldant' => $a, 'fecini' => $fecini, 'fecfin' => $fecfin, 
			'codbal' => $codbal, 'addusr' => $usuario);
			$this->db->insert('cntisn',$data);	
			}
			
			//SI LOS AÑOS SON DIFERENTES
			if($e[0] != $ee[0]){
			$this->db->select('sum(credcm-debdcm) as sldant');	
			$this->db->from('view_sirco_detalle ');
			$this->db->where('stdcmp','Generado');
			$condicion = "(codnif like '4%' or codnif like '5%' or codnif like '6%' or codnif like '7%')";
			$this->db->where($condicion);
			$this->db->where('agncnt <',$ee['0']);
			$this->db->where('agncnt >=',$e['0']);
			$res = $this->db->get();	
			//echo $this->db->last_query();
			//exit();	
			$r = $res->row_array();
			$a = $r['sldant']*-1;
			
			$this->db->select('sldcta');
			$this->db->from('cntisn');
			$this->db->where('codnif', '32250101');
			$this->db->where('fecini',$fecini);
			$this->db->where('fecfin',$fecfin);
			$this->db->where('codbal',$codbal);
			$this->db->where('addusr',$usuario);
					
			$resb = $this->db->get();
			if($resb->num_rows()>0){
			$rb = $resb->row_array();
			$a = $a-($rb['sldcta']*-1);
			
			$condicion = array('codnif' => '32250101','fecini' => $fecini, 'fecfin' => $fecfin, 'codbal' => $codbal, 'addusr' => $usuario);
			$data = array('sldcta' => $a);
			$this->db->where($condicion);
			$this->db->update('cntisn',$data);
			//echo $this->db->last_query();
			//exit();
			}else{
			// 'credito' => '0.00', 'debito' => '0.00',
			$data = array('codnif' => '32250101', 'sldcta' => $a, 'fecini' => $fecini, 'fecfin' => $fecfin, 
			'codbal' => $codbal, 'addusr' => $usuario);
			$this->db->insert('cntisn',$data);	
			}
			}
			// FIN SI SON AÑOS DIFERENTES
			
		//FIN UTILIDAD DEL EJERCICIO ANTERIOR
		
		$condicion= array('debito' => '0','credito' => '0', 'sldcta' => '0', 'sldant' => '0','codbal'=>$codbal,'fecini'=>$fecini,'fecfin'=>$fecfin, 
		'addusr' => $usuario);
		$this->db->where($condicion);
		$this->db->delete('cntisn');
		
		$datos = array('tipsld' => '1');
		$condicion = "substring(codnif,1,1)::numeric > 3";
		$this->db->where($condicion);
		$this->db->update('cntisn',$datos);	
			
			}
}