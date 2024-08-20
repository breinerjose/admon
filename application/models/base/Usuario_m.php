<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario_m extends CI_Model {	
	function __Construct(){
	   parent::__construct();
	}
	
	function consultarUsuarios(){
		$sql ="SELECT nriper, nomtrc, emltrc, estusr, codsed FROM view_sirco_user";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	}
	
	
	/*MANEJO DE PERFILES*/
	function consultarPerfiles(){
		$sql ="SELECT codprf, nomprf FROM mnupfi";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	
	}
	
	function agregarPerfil($decripcion){
		$query = "INSERT INTO mnupfi (nomprf) VALUES (?);";
		$res = $this->db->query($query, array($decripcion));
		if($this->db->affected_rows()){
			return true;
		}else {
			return false;	
		}		
	}
	
	function actualizarPerfil($descp,$codigo){
	 $sql = "UPDATE mnupfi SET nomprf=? WHERE codprf=?";
		$res = $this->db->query($sql,array(trim($descp),$codigo));
		if($this->db->affected_rows()){ return true;} else { return false; }
	
	}
	
	function consultarPaginas(){
		$sql ="SELECT codpag, nompag FROM mnupag";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	
	}
	
	function agregarUsuario($id,$pas,$prf,$sed,$carg){
		$sql = "INSERT INTO actusr (nriper, pssusr,codper,codsed,codcar) VALUES (?,?,?,?,?);";
		$res = $this->db->query($sql,array($id,$pas,$prf,$sed,$carg));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function registrarPermisos($codpag,$codusr){
	    $sql = "INSERT INTO mnupso (codpag, codusu) VALUES (?,?);";
		$res = $this->db->query($sql,array($codpag,$codusr));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function consultarPaginasporperfil($cod){
		$sql ="SELECT mnupag.codpag, mnupag.nompag, mnuapl.nomapl  
		       FROM mnuprf, mnupag, mnuapl
		       where mnuprf.codpag=mnupag.codpag and mnuapl.codapl=mnupag.codapl and mnuprf.codprf=?
			   ORDER BY codpag";
		$result = $this->db->query($sql,array($cod));
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	}
	
	function consultarPaginasperfiluser(){
	$sql ="SELECT DISTINCT f.codpag, f.nompag, a.nomapl
		    FROM  mnupag f, mnuapl a
			WHERE a.codapl = f.codapl
			ORDER BY f.codpag";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	
	
	}
	
	function asignarPaginasperfil($codpag, $codprf){
		$sql = "INSERT INTO actprf (codprf, codpag) VALUES (?,?);";
		$res = $this->db->query($sql,array($codprf,$codpag));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function eliminarPaginasperfil($codprf){
		$sql = "DELETE FROM actprf WHERE codprf=?";
		$res = $this->db->query($sql,array($codprf));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function eliminarPermisos($codusr){
		$sql = "DELETE FROM mnupso WHERE codusu=?";
		$res = $this->db->query($sql,array($codusr));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function actualizarUsuario($id,$est,$prf,$sed,$carg){
	    $sql = "UPDATE actusr SET estusr=?, codper=?,codsed=?,codcar=? WHERE  nriper=?";	
		$res = $this->db->query($sql,array($est,$prf,$sed,$carg,$id));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function activarUsuario($codigo){
		$sql = "UPDATE actusr SET  estusr=? WHERE  nriper=?";	
		$res = $this->db->query($sql,array('Activo',$codigo));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function consultarPaginaspermiso($cod){
		$sql ="SELECT codpag, nivper FROM mnupso where codusu=? ORDER BY codpag";
		$result = $this->db->query($sql,array($cod));
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	}

	function validar_pagina($cod, $pag){
		$sql ="SELECT nivper FROM mnupso where codusu=? and codpag=? ORDER BY codpag";
		$result = $this->db->query($sql,array($cod,$pag));
		if($result->num_rows() > 0){
		 return $result->row_array();
		}else{return false;}
	}
	
	function cambiarPassword($nueva,$codigo){
		$sql = "UPDATE actusr SET  pssusr=? WHERE  nriper=?";	
		$res = $this->db->query($sql,array($nueva,$codigo));
		if($this->db->affected_rows()){ return true;} else { return false; }
	}
	
	function consultarSede(){
		$sql ="SELECT codsed, nomsed FROM invsed";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	
	}
	
	function consultarCargo(){
		$sql ="SELECT codcar, nomcar FROM nomcar";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	
	}
	
		function consultarAplicaciones(){
		$sql ="SELECT * FROM aplics";
		$result = $this->db->query($sql);
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	
	   }
	   
	   function consultarPaginasaplics($codigo){
	  $sql ="SELECT * FROM pagina where codapl=?";
		$result = $this->db->query($sql,array($codigo));
		if($result->num_rows() > 0){
		 return $result->result_array();
		}else{return false;}
	}
	
	function consultarTodosusuarios($sede,$cargo,$perfil,$estado,$codapl,$codpag){
		  $sql = " select a.nomapl, r.nompag, c.identificacion,c.nombres,f.nomprf,s.nomsed,g.cargo,c.estado
					from permiso p
					inner join usuario c on c.identificacion=p.codusu
					inner join pagina r on r.codpag=p.codpag
					inner join aplics a on r.codapl=a.codapl
					left join perfil f on f.codprf=c.perfil
					left join cargo g on g.identificacion=c.coddep
					left join sede s on s.codse=c.codsed
				    where c.estado = ?";
	  if($sede != "") $sql .= " AND c.codsed='".$sede."'";
	  if($cargo != "") $sql .= " AND c.coddep='".$cargo."'";
	  if($perfil != "") $sql .= " AND c.perfil='".$perfil."'"; 
	  if($codapl != "") $sql .= " AND r.codapl='".$codapl."'";
	  if($codpag != "") $sql .= " AND r.codpag='".$codpag."'";
	  $res = $this->db->query($sql, array($estado));
	  //echo $this->db->last_query();
	  if($res->num_rows() > 0){
		 return $res->result_array();
		}else{return false;}		
	}
	
	function consultarTotalusuarios($sede,$cargo,$perfil,$estado,$codapl,$codpag){
	  $sql = "select count(*) as total
				from permiso p
				inner join usuario c on c.identificacion=p.codusu
				inner join pagina r on r.codpag=p.codpag
				inner join aplics a on r.codapl=a.codapl
				left join perfil f on f.codprf=c.perfil
				left join cargo g on g.identificacion=c.coddep
				left join sede s on s.codse=c.codsed
				where c.estado = ?";
	  if($sede != "") $sql .= " AND c.codsed='".$sede."'";
	  if($cargo != "") $sql .= " AND c.coddep='".$cargo."'";
	  if($perfil != "") $sql .= " AND c.perfil='".$perfil."'"; 
	  if($codapl != "") $sql .= " AND r.codapl='".$codapl."'";
	  if($codpag != "") $sql .= " AND r.codpag='".$codpag."'"; 
	  $res = $this->db->query($sql, array($estado));
	 // echo $this->db->last_query();
	  if($res->num_rows() > 0){
		 return $res->row_array();
		}else{return false;}		
	}
	
	
}
?>