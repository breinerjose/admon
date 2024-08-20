<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Matricula_m extends CI_Model {
	
	function __Construct(){
	   parent::__construct();
	}
	
	function agregarmatricula($codtrc,$codalm,$grado,$periodo,$grupo){
		$sql = "INSERT INTO matric (codpad,	codest,grado, agncnt,grupo) VALUES (?,?,?,?,?);";
		$res = $this->db->query($sql,array($codtrc,$codalm,$grado,$periodo,$grupo));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function terceros(){
		$sql = "select codtrc, nomtrc from cnttrc";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}	
	
	function matriculas(){
			$sql1 = "select oid, codtrc, nomtrc, codalm, nomalm, grado, agncnt, grupo, tipmat from view_ter_alm where agncnt='2020' and delusr is null";
			$result1 = $this->db->query($sql1);
			if($result1->num_rows() > 0){
				return $result1->result_array();
				}
				else{return FALSE;}
			}
	
	function elimina_matricula($datos){
		$sql = "DELETE FROM matric WHERE codoid=?";
		$this->db->query($sql,$datos);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;	
		}	
	}
	
	function anio(){
	  $sql= "SELECT distinct(agncnt) agncnt FROM matric ORDER BY agncnt DESC";
	  $res = $this->db->query($sql); 
	  return ($res->num_rows() >0)? $res->result_array():false;
	}
	
	function grado(){
	  $sql= "SELECT grado FROM matgra ORDER BY codgra";
	  $res = $this->db->query($sql); 
	  return ($res->num_rows() >0)? $res->result_array():false;
	}
	
	function grupo(){
	  $sql= "SELECT distinct(grupo) grupo  FROM matric ORDER BY grupo";
	  $res = $this->db->query($sql); 
	  return ($res->num_rows() >0)? $res->result_array():false;
	}
}	