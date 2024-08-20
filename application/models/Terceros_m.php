<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terceros_m extends CI_Model {	
	function __Construct(){
	   parent::__construct();
	}
	
	function consultarterceros(){//
		$this->db->select('id_cliente as id, nombre');
		$this->db->from('terceros');
		$res = $this->db->get();
	    //echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
	
	function pacientes(){//
		$this->db->select('id_cliente, nombre');
		$this->db->from('historias');
		$this->db->where('fecha >', '2017-01-01');
		$this->db->group_by('id_cliente, nombre'); 
		$res = $this->db->get();
	    //echo $this->db->last_query();
		//exit();
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false; //No existen item pricipales	
		}
	}
		
	public function insert_tercero($tabla,$data){$this->db->insert($tabla,$data);}
	
	function validar($id_cliente,$fechanac){
		$this->db->select('id_cliente,nom_tipidentificacion,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,telefono_fijo,telefono_movil,
	  direccion,email,sexo,pais,naturalde,ecivil,escolaridad,jornada,trim(eps) eps,trim(arp) arp,ciudad,fechanac,nombre');
		$this->db->from('terceros');
		$this->db->where('id_cliente', $id_cliente);
		$this->db->where('fechanac', $fechanac);	
		$res=$this->db->get();
		return ($res->num_rows()>0)?$res->row_array():false;		
	}
	
	function medicos(){
		$sql = "select cedula codmed, trim(nombre) nommed from medicos";
		$res = $this->db->query($sql);
		if($res->num_rows()>0){
			return $res->result_array();
		}else{
			return false;	
		}	
	}
	
	function tercerosu($tabla,$data,$condicion){
	$this->db->set($data);
	$this->db->where($condicion['condicion'],$condicion['valor']);
	$this->db->update($tabla);
	}
	
	function Empresas(){
		$this->db->select('id_cliente, nom_tipidentificacion, telefono_fijo, telefono_movil, direccion, email, nombre, empresa');
		$this->db->from('terceros');
		$this->db->where('empresa','si');
		$res=$this->db->get();
		return ($res->num_rows()>0)?$res->result_array():false;		
	}
	
	function arp(){
		$this->db->select('arp');
		$this->db->from('arp');
		$res=$this->db->get();
		return ($res->num_rows()>0)?$res->result_array():false;		
	}
	
	function eps(){
		$this->db->select('eps');
		$this->db->from('eps');	
		$res=$this->db->get();
		return ($res->num_rows()>0)?$res->result_array():false;		
	}
	
	function tip_ide($tip){
		$this->db->select('codtip,dsctip');
		$this->db->from('tipdoc');
		//$this->db->where('tipper',$tip);
		$res=$this->db->get();
		return ($res->num_rows()>0)?$res->result_array():false;		
	}
	
} 