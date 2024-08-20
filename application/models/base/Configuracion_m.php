<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');
class Configuracion_m extends CI_Model {
	
	function __Construct(){
	   parent::__construct();
	}
	
	function actualizarCorreo($email,$codigo){
	 $sql = "UPDATE cnttrc SET emltrc=? WHERE codtrc=?";
		$res = $this->db->query($sql,array(trim($email),$codigo));
		if($this->db->affected_rows()){ return true;} else { return false; }
	
	}
	
	function consultarusuario($id){
		$sql1 = "select nomtrc, emltrc from view_sirco_user WHERE trim(nriper) = ?";
		$result1 = $this->db->query($sql1,array($id));
		//echo $this->db->last_query();
		//exit();

		if($result1->num_rows() > 0){
			return $result1->row_array();
			}
			else{return FALSE;}
		}
			
	function consultartercero($identificacion){
		$sql1 = "select codtrc, nomtrc, emltrc from view_tercero WHERE codtrc = ?";
		$result1 = $this->db->query($sql1,array($identificacion));
		if($result1->num_rows() > 0){
			return $result1->row_array();
			}
			else{return FALSE;}
		}
}
?>