<?php  
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
	
	function tercero($id_cliente){
		$ci=& get_instance();
		$ci->load->database();
		$sql="SELECT id_cliente FROM terceros WHERE id_cliente=?";
		$res = $ci->db->query($sql,array($id_cliente));
		if($res->num_rows()>0){return true;}else{return false;}
	}
	
	function actualizar_tercero($data){	
		$ci=& get_instance();
		$ci->load->database();
		$sql="UPDATE terceros SET nom_tipidentificacion=?, telefono_fijo=?, telefono_movil=?, direccion=?, email=?, primer_nombre=?, segundo_nombre=?, primer_apellido=?, segundo_apellido=?, nombre=?, empresa='si' WHERE id_cliente=?";
		return $ci->db->query($sql,$data);
	
	}
	
	function actualizar_historia($data){
		$ci=& get_instance();
		$ci->load->database();
		$sql="UPDATE `historias` SET `id_cliente` = ?, `nom_tipidentificacion` = ?, `primer_nombre` = ?, `segundo_nombre` = ?, `primer_apellido` = ?, `segundo_apellido` = ?, `nombre` = ?, `telefono_fijo` = ?, `telefono_movil` = ?, `direccion` = ?, `email` = ?, `sexo` = ?, `naturalde` =?, `ecivil` = ?, `escolaridad` = ?, `jornada` = ?, `eps` = ?, `arp` = ?, `ciudad` = ?, `fechanac` = ?, `edad` = ?, `prioridad` = ?, `traalt` = ?, `espcon` = ?, `manali` = ?, `brigada` = ?, `examen` = ?, `id_empresa` = ?, `nomempresa` = ?, `id_empresal` = ?, `nomempresal` = ? WHERE `id_consentimiento` = ?";
		return $ci->db->query($sql,$data);
		}	
