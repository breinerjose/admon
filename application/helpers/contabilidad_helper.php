<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
		

		function util($agncnt,$fecha){
			$ci =& get_instance();
			$ci->load->database();
			$ci->db->select('sum(credcm-debdcm) as saldo');	
			$ci->db->from('view_sirco_detalle ');
			$condicion = "(codnif like '4%' or codnif like '5%' or codnif like '6%' or codnif like '7%')";
			$ci->db->where($condicion);
			$ci->db->where('fchcmp <=',$fecha);
			$ci->db->where('agncnt',$agncnt);
			$ci->db->where('stdcmp','Generado');
			$res = $ci->db->get();
			//echo $ci->db->last_query();
			//exit();
				$r = $res->row_array();
				$a = $r['saldo'];
				return $a;
			}
		
		function saldo_anuald($cuenta,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$e = explode("-",$fecha);
		$fecini = $e['0']."-01-01";
		$ci->db->select('sum(debdcm-credcm) as saldo');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <= ' => $fecha, 'fchcmp >= ' => $fecini);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
			$r = $res->row_array();
			$a = $r['saldo'];
			return $a;
		}
		
		function saldo_anualc($cuenta,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$e = explode("-",$fecha);
		$fecini = $e['0']."-01-01";
		$ci->db->select('sum(credcm-debdcm) as saldo');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <= ' => $fecha, 'fchcmp >= ' => $fecini);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;
		}
		
		function saldo_mensuald($cuenta,$fecini,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('sum(debdcm-credcm) as saldo, sum(credcm) credito, sum(debdcm) debito');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <= ' => $fecha, 'fchcmp >= ' => $fecini);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
		return $res->row_array();
		}
		
		function saldo_mensualc($cuenta,$fecini,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('sum(credcm-debdcm) as saldo, sum(credcm) credito, sum(debdcm) debito');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <= ' => $fecha, 'fchcmp >= ' => $fecini);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
		return $res->row_array();
		}
		
		function saldo_corted($cuenta,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('sum(debdcm-credcm) as saldo');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <' => $fecha);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;
		}
		
		function saldo_cortec($cuenta,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('sum(credcm-debdcm) as saldo');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <' => $fecha);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
		//if($cuenta == '23140101'){
//			echo $this->db->last_query();
//			exit();
//			}
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;
		}
		
		function saldo_corte_anuald($cuenta,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$e = explode("-",$fecha);
		$fecini = $e['0']."-01-01";
		$ci->db->select('sum(debdcm-credcm) as saldo');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <= ' => $fecha, 'fchcmp > ' => $fecini);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;
		}
		
		function saldo_corte_anualc($cuenta,$fecha){
		$ci =& get_instance();
		$ci->load->database();
		$e = explode("-",$fecha);
		$fecini = $e['0']."-01-01";
		$ci->db->select('sum(credcm-debdcm) as saldo');	
		$ci->db->from('view_sirco_detalle ');
		$condicion = array('fchcmp <= ' => $fecha, 'fchcmp > ' => $fecini);
		$ci->db->where($condicion);
		$ci->db->where('stdcmp','Generado');
		$ci->db->like('trim(codnif)', $cuenta, 'after'); 
		$res = $ci->db->get();
		if($res->num_rows()>0){
			$r = $res->row_array();
			$a = $r['saldo'];
			}else{$a=0;}
			return $a;
		}