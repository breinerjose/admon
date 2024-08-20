<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terceros_m extends CI_Model {
	
	var $elemAdic="curobj";
	var $pais="actpai"; var $departamentos="actdpt"; 
	var $municipios="actmun"; var $idiomas ="actlan";
	var $personal = "actper"; var $institucion = "actemp";
	var $egresados = "actegd";var $elemIdiomas = "curidi";
	var $programa = "actpgm"; var $estudiante = "actbas";
	var $msguser = 'curmsg';
	function __Construct(){
	   parent::__construct();
	}


//metodo cargar tipo de documentos
	function DatosTercero($codtrc){
	$sql1 = "select teltrc, emltrc, nomuno, nomdos, apeuno, apedos, celtrc, dirtrc, tiptrc, tpodoc, nomtrc from view_tercero WHERE upper(codtrc) = ?";
		$result1 = $this->db->query($sql1,array($codtrc));
		if($result1->num_rows > 0){
			return $result1->row_array();
			}
			else{return FALSE;}
		}
 
   //metodo consultar Paises
	function consultarPaises(){
		$sql = "select trim(codpai) as codpai, trim(nompai) as nompai from ".$this->pais." order by nompai";
		$result = $this->db->query($sql);
		return ($result->num_rows() >0)?$result->result_array():false;
	}
   
   //metodo cosnultar departamento
	function consultarDepartamentos($codpai){
	$sql = "select trim(coddpt) as coddep, trim(nomdpt)as nomdep 
	        from ".$this->departamentos." 
			where trim(codpai)=? order by nomdpt";
	$res = $this->db->query($sql, array($codpai));
    //echo $this->db->last_query();
	 return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	//metodo cosnultar departamento
	function consultarMunicipios($codpai, $coddpt){
	$sql = "select trim(codmun) as codmun, trim(nommun) as nommun 
	        from ".$this->municipios." where codpai=?";
	if($coddpt!='0'){ $sql .= " and coddpt=? order by nommun";}else{ $sql .= " and coddpt!=? order by nommun";}
	$res = $this->db->query($sql, array($codpai,$coddpt));
    //echo $this->db->last_query();
	 return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	
	
	//metodo cargar persona
	function selectTipoper(){
	$sql = "select * from tiptrc";
	$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	
	}
	
	//metodo cargar tipo de documentos
	function selectTipodoc($codigo){
	$sql = "select * from tipdoc where tipper='".$codigo."'";
	$res = $this->db->query($sql);
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{return false;}
	
	}
	
	
	/*Inicio*/
   function insertarcnttrc($codtrc, $dirtrc, $teltrc, $emltrc, $tiptrc, $tpodoc, $nomuno, $nomdos, $apeuno, $apedos, $nomtrc, $celtrc){
	   
	   $sqlverif = "select codtrc from cnttrc where codtrc='".$codtrc."'";
	$resverif = $this->db->query($sqlverif);
		if($resverif->num_rows() > 0){
			$sql = "UPDATE cnttrc
   SET codtrc=?, dirtrc=?, teltrc=?, emltrc=?, tiptrc=?, tpodoc=?, nomuno=?, nomdos=?, apeuno=?, apedos=?, nomtrc=?, celtrc=?
 WHERE codtrc='".$codtrc."'";
 $res = $this->db->query($sql,array($codtrc, $dirtrc, $teltrc, $emltrc, $tiptrc, $tpodoc, $nomuno, $nomdos, $apeuno, $apedos, $nomtrc, $celtrc));
		//echo $this->db->last_query();
		if($this->db->affected_rows()){ return true;} else { return false; }
		}else{
			
			$sql = "INSERT INTO cnttrc(
         			 codtrc, dirtrc, teltrc, emltrc, tiptrc, tpodoc, nomuno, nomdos, apeuno, apedos, nomtrc, celtrc) VALUES 			
					 (?,?,?,?,?,?,?,?,?,?,?,?);";
		$res = $this->db->query($sql,array($codtrc, $dirtrc, $teltrc, $emltrc, $tiptrc, $tpodoc, $nomuno, $nomdos, $apeuno, $apedos, $nomtrc, $celtrc));
		//echo $this->db->last_query();
		//exit();
		if($this->db->affected_rows()){ return true;} else { return false; }}
	   
 
		}
	/*Fin*/	
	
	//CONSULTAS PARA GENERAR REPORTE
	function nombre_tercero($datos){
		$sql = "SELECT nomtrc FROM cnttrc WHERE codtrc = ?";	
		$res = $this->db->query($sql,$datos);
		if($res->num_rows() > 0){
			return $res->row_array();
		}else{return false;}
	}	
	
	function cargarListadoTerceros($busqueda){
		if($busqueda!=''){
		$sql = "select trim(codtrc)as user, trim(nomtrc) as nombre from cnttrc where trim(codtrc) like '%".$busqueda."%' or upper(trim(nomtrc)) like upper('%".$busqueda."%') or upper(trim(nomtrc)) like upper('%".$busqueda."%')";
		$res = $this->db->query($sql);
		//echo $this->db->last_query();
		//exit();
		return($res->num_rows()>0)?$res->result_array():false;	
		}else return false;
	}

function cargarListadoTercerosAlumnos($busqueda,$agnakd){
        if($busqueda!=''){
        $sql = "SELECT grado, grupo, trim(codtrc)as user, trim(nomtrc) as nombre, codalm, (codalm || ' ' || nomalm || ' GRADO ' || grado || ' PERIODO ' || agncnt) AS datos, agncnt FROM view_ter_alm 
        WHERE agncnt=".$agnakd." AND (trim(codtrc) like '%".$busqueda."%' or upper(trim(nomtrc)) like upper('%".$busqueda."%') 
        or trim(codalm) like '%".$busqueda."%' or upper(trim(nomalm)) like upper('%".$busqueda."%'))";
        $res = $this->db->query($sql);
        //echo $this->db->last_query();
        //exit();
        return($res->num_rows()>0)?$res->result_array():false; 
        }else return false;
    }
	
}
?>