<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informe_m extends CI_Model {
	
	function __Construct(){
	 parent:: __construct();
	 }
	 	function consultarTerceros($offset,$filtro){
        $filtro = trim($filtro);
        $sql = "select codtrc,nomtrc,teltrc,tiptrc,emltrc,
                        (select count(*) from reqsum where codtrc = trc.codtrc) as cansum 
                                        from cnttrc trc where prvtrc = '1'
               ".(($filtro != "") ? "and   trim(nomtrc) like '%".decodeUtf8($filtro)."%' or
                                            trim(nomtrc) like '%".strtoupper(decodeUtf8($filtro))."%' or
                                            trim(codtrc) like '%".decodeUtf8($filtro)."%'
                                                    order by codtrc limit 50 offset ? " : ' order by codtrc limit 25 offset ? ').""; 
        return $this->db->query($sql,array($offset));
    }
	function selecionarProveedor($nombre){
        $sql = "select * from cnttrc where nomtrc like '%".$nombre."%' or codtrc like '".$nombre."%' order by nomtrc asc limit 50";
        return $this->db->query($sql);
    }
	
    function selecionarCentroCosto($nombre){
        $sql = "select * from cntcts where nomcts like '%".$nombre."%' or codcts like '".$nombre."%' order by nomcts asc limit 50";
        return $this->db->query($sql);
    }
		function obtener_centro_c(){
		$sql = "select trim(codcts) as codcts,trim(nomcts) as nomcts from cntcts";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function  listadoAuxilares(){
		$sql="select codaux,trim(nomaux) as nomaux from cntaux";
		$res=$this->db->query($sql);
		return($res->num_rows()>0)?$res->result_array():false;	
	}
	function cuentasAsociadas($fecha1,$fecha2,$codcta1,$codcta2,$agnpsp,$codcts1,$codcts2,$codtrc1,$codtrc2,$codaux1,$codaux2){
		$sql="select  trim(d.codcta) as codcta,trim(nomcta) as nomcta from cntdcm d inner join cntcta c on c.codcta=d.codcta where agncnt=?  ";
		$datos=array($agnpsp);
		if(strcmp($codtrc1,0)!=0){
			$sql.=" and  trim(codtrc)=?";
			array_push($datos,$codtrc1);
		}
		if(strcmp($fecha1,0)!=0&&strcmp($fecha2,0)==0){
			$sql.=" and  convertir_a_fecha(fchdcm)>=?";
			     array_push($datos,$fecha1);	
		}else if(strcmp($fecha1,0)==0&&strcmp($fecha2,0)!=0){
			$sql.=" and  convertir_a_fecha(fchdcm)<=?";
			$datos=array($datos,$fecha2);
		}else{
			$sql.=" and convertir_a_fecha(fchdcm)  between ? and ?";
			array_push($datos,$fecha1,$fecha2);
		}
		$sql.=" group by d.codcta,trim(nomcta) order by d.codcta ,trim(nomcta) ";
		$res=$this->db->query($sql,$datos);
		return($res->num_rows()>0)?$res->result_array():false;
	}
	function detallereporte($fecha1,$fecha2,$codcta1,$codcta2,$agnpsp,$codcts1,$codcts2,$codtrc1,$codtrc2,$codaux1,$codaux2){
				$sql="select  convertir_a_fecha(fchdcm)||'-'||coddoc||'-'||nrocmp as serial,trim(detdcm)||' '||trim(nomtrc)
				 as detalle,debdcm,credcm,trim(codcta) as codcta from cntdcm c inner join cnttrc t on trim(t.codtrc)=trim(c.codtrc) where 
				  agncnt=? ";
		$datos=array($agnpsp);
		if(strcmp($codtrc1,0)!=0){
			$sql.=" and  trim(c.codtrc)=?";
			array_push($datos,$codtrc1);
		}
		if(strcmp($fecha1,0)!=0&&strcmp($fecha2,0)==0){
			$sql.=" and  convertir_a_fecha(fchdcm)>=?";
			     array_push($datos,$fecha1);	
		}else if(strcmp($fecha1,0)==0&&strcmp($fecha2,0)!=0){
			$sql.=" and  convertir_a_fecha(fchdcm)<=?";
			$datos=array($datos,$fecha2);
		}else{
			$sql.=" and convertir_a_fecha(fchdcm)  between ? and ?";
			array_push($datos,$fecha1,$fecha2);
		}
		$sql.=" order by  codcta asc,nrocmp";
		$res=$this->db->query($sql,$datos);
		return($res->num_rows()>0)?$res->result_array():false;
	}
	function selecionarCuentas($nombre){
		$sql="select trim(codcta) as codcta, trim(nomcta) as nomcta, nivcta, porcta,trim(codnif) as codnif,
			  trim(nomnif) as nomnif from cntcta where trim(tpocta)='Detalle' and (trim(codcta) like '%".$nombre."%'
			  or trim(nomcta) like '%".$nombre."%' or trim(codnif) like '".$nombre."%') or trim(nomnif) like '".$nombre."%' order by codcta limit 50";
		return($this->db->query($sql));				
	}
	function cargarDatosCuenta($codcta){
		$sql="select trim(codcta) as codcta, trim(nomcta) as nomcta, c.nivcta, p.porcta,trim(c.codnif) as codnif,
			  trim(nomnif) as nomnif from cntcta c left join cntpnf p on p.codnif=c.codnif where 
			  trim(tpocta)='Detalle' and trim(codcta)=?";
		$res=$this->db->query($sql,$codcta);
		return($res->num_rows()>0)?$res->row_array():false;
	}
	function cargarDatosProvedor($codtrc){
		$sql="select trim(codtrc) as codtrc, trim(nomtrc) as nomtrc 
	        from cnttrc  where trim(codtrc)=? ";
		$res=$this->db->query($sql,$codtrc);
		return($res->num_rows()>0)?$res->row_array():false;
	}
}