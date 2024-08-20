<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estados_financieros_n_m extends CI_Model {
	
	
	function __Construct(){
	 	parent:: __construct();		
	}
	
	//Inicio 0007
	function cuentas_detalle_niif($tbalance,$fecha,$usuario){
		$del="DELETE FROM cntisn WHERE codbal=? and addusr=?";
		$this->db->query($del,array($tbalance,$usuario));
		//echo $this->db->last_query();
		
		$sql = "SELECT codnif, (sum(debdcm)-sum(credcm)) saldo FROM view_sirco_detalle WHERE 
		stdcmp='Generado' AND fchcmp <= ? 
		AND (codnif like '1%' OR codnif like '2%' OR codnif like '3%') GROUP BY codnif ORDER BY codnif";	
		$data = $this->db->query($sql,array($fecha));
		//echo $this->db->last_query();
		//exit();
		$ctabal = $data->result_array();
		
		foreach($ctabal as $cta){	
		$datos = array($cta['codnif'],$cta['saldo'],$tbalance,$usuario);
		$sql = "INSERT INTO cntisn(codnif, sldcta, codbal,addusr)  VALUES (?, ?, ?, ?);";
		$this->db->query($sql,$datos);
		}
		
		}
	
		function cuentas_superior($tamanio,$tReport,$usuario){
		
		$sql = "select distinct(substring(codnif,1,".$tamanio.")) as codnif from cntisn where codbal=? and addusr=?";
		$res = $this->db->query($sql,array($tReport,$usuario));
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();	
		}else{ return false; }
		}
		
		function inserta_niif($datos){
		$sql = "INSERT INTO cntisn(codcta,codnif,tpocta,codbal,addusr)  VALUES (?, ?, ?, ?, ?);";
		$this->db->query($sql,$datos);
		//echo $this->db->last_query();
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}		
		}
		
		function suma_niif($codnif,$tReport,$usuario){
		$sql = "Select  SUM(sldcta::numeric) sldcta From cntisn Where codnif like '".$codnif."%' and trim(tpocta) = 'Detalle' and codbal=? and addusr=?";
		$res = $this->db->query($sql,array($tReport,$usuario));	
		if($res->num_rows()>0){
				return $res->row_array();	
			}else{
				return false;
			}		
		}
	
		function actualizar_saldo_niff($sldcta, $codnif, $tReport, $usuario){
			$sql = "update cntisn set sldcta=? where trim(codnif)=? and trim(codbal)=? and addusr=?";
			$this->db->query($sql,array($sldcta, $codnif, $tReport, $usuario));
			//echo $this->db->last_query();
			if($this->db->affected_rows()>0){
				return true;
			}else{
				return false;
			}		
		}
		
		function estructuraInformeNiif($tbalance,$usuario){
		$sql = "SELECT cntisn.codnif codnif, cntpnf.nomnif nomnif, sldcta, tpocta FROM cntisn, cntpnf WHERE trim(cntisn.codnif) = trim(cntpnf.codnif) AND codbal=? and addusr=?
		ORDER BY codnif";
		$res = $this->db->query($sql,array($tbalance,$usuario));
		//echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();	
		}else{ return false; }
		}
	
		function sumapasivopatrimonio($tbalance,$usuario){
		$sql = "Select  SUM(sldcta::numeric) sldcta From cntisn Where (codnif = '2' or codnif= '3') and codbal=? and addusr=?";
		$res = $this->db->query($sql,array($tbalance,$usuario));	
		if($res->num_rows() > 0){
				return $res->row_array();
			}else{return false;}	
		}
	//Fin 0007
	
	//Inicio008	
	function consultarNivel1($balance){
		$sql="select codbaa,trim(nombaa) as nombaa, tipbaa from cntbaa where depbal=? order by codbaa";
		$res=$this->db->query($sql,$balance);	
		return($res->num_rows()>0)?$res->result_array():false;
	}
	function consultarNivel2($codbaa){
		$sql="select codbab,trim(nombab) as nombab from cntbab where depbaa=? order by codbab";
		return $this->db->query($sql,$codbaa);	
		//return($res->num_rows()>0)?$res:false;
	}
		function consultarNivel2nuevo($codbaa){
		$sql="select codbab,trim(nombab) as nombab from cntbab where depbaa=? order by codbab";
		$res=$this->db->query($sql,$codbaa);	
		return($res->num_rows()>0)?$res->result_array():false;
	}
	function consultarNivel3($codbab){
		$sql="select codbac,trim(nombac) as nombac from cntbac where depbab=? order by codbac";
		$res=$this->db->query($sql,$codbab);	
		return($res->num_rows()>0)?$res->result_array():false;
	}
	function consultarCuentasAsociadas($balance,$codbaa,$codbab,$codbac){
		$sql="select nivcta,codnif,trim(nomnif) as nomnif from cntcef c inner join cntpnf p on trim(p.codnif)=trim(c.codcta) where
			  codbal=? and codbaa=? and codbab=? and codbac=? order by codnif ";
		$res=$this->db->query($sql,array($balance,$codbaa,$codbab,$codbac));	
		return($res->num_rows()>0)?$res->result_array():false;
	}
	
	function consultarSaldoCuenta($fecfin,$fechaini,$codnif,$nivcta){
		$sql="SELECT (sum(debdcm)-sum(credcm)) +(obtener_saldo_nif(?,?,?) ) as saldo FROM view_sirco_detalle 
			WHERE trim(stdcmp)='Generado' 
			 AND to_date(trim(fchcmp), 'dd/mm/yyyy') BETWEEN ? AND ? AND trim(codnif) like '".$codnif."%'";
      
      	if( $codnif == '32150101' and substr($fecfin, 5, 5) == '01-01')
        {
			$sql = "select obtener_saldo_nif(?, ?, ?) as saldo";	
            $res = $this->db->query($sql, array($fecfin,$codnif,$nivcta));
        }else $res=$this->db->query($sql,array($fecfin,$codnif,$nivcta,$fechaini,$fecfin));
         //echo $this->db->last_query();
		//exit();	
		return($res->num_rows()>0)?$res->row_array():false;	
	}
	function cargarComboBalance(){
		$sql="SELECT trim(codbal) codbal, trim(nombal) nombal FROM cntbal where trim(tipbal)='Niif' ORDER BY codbal";
		$res=$this->db->query($sql);
		return($res->num_rows()>0)?$res->result_array():false;	
	}
	function cargarBaa($codbal){
		$sql="select codbaa,trim(nombaa) as nombaa from cntbaa where depbal=?";
		$res=$this->db->query($sql,$codbal);
		return($res->num_rows()>0)?$res->result_array():false;	
	}
	function cargarBab($codbaa){
		$sql="select codbab,trim(nombab) as nombab from cntbab where depbaa=?";
		$res=$this->db->query($sql,$codbaa);
		return($res->num_rows()>0)?$res->result_array():false;	
	}
	function cargarBac($codbab){
		$sql="select codbac,trim(nombac) as nombac from cntbac where depbab=?";
		$res=$this->db->query($sql,$codbab);
		return($res->num_rows()>0)?$res->result_array():false;	
	}
	function agregarEstadoFinancierosNiff($datos){
		$this->db->insert('cntcef',$datos);
		return($this->db->affected_rows()>0)?true:false;	
	}
	function listadoConfiguracionesFinancierasNiff(){
		$sql="select codcef,c.codbal,trim(nombal) as nombal,c.codbaa,trim(nombaa) as nombaa,c.codbab,
			  trim(nombab) as nombab,c.codbac,trim(nombac) as nombac,c.codcta,trim(nomnif) as nomnif
			   from cntcef c  inner join cntbal bal on bal.codbal=c.codbal inner join cntbaa a 
			   on a.codbaa=a.codbaa and a.depbal=c.codbal inner join cntbab b on b.codbab=c.codbab 
			   and depbaa=a.codbaa inner join cntbac ac on ac.codbac=c.codbac and depbab=b.codbab
			   inner join cntpnf pnf on pnf.codnif=c.codcta";
		$res=$this->db->query($sql);
		return($res->num_rows()>0)?$res->result_array():false;
		
	}
	function eliminarConfiguracionEstadoFinancieroNiff($where){
		$this->db->delete('cntcef',$where);	
		return($this->db->affected_rows()>0)?true:false;
	}
	//Fin 0008
} ?>