<?php

class Registro_m extends CI_Model {
	
	var $elemVarios="actelm"; var $elemAdic="curobj";
	var $pais="actpai"; var $departamentos="actdpt"; 
	var $municipios="actmun"; var $idiomas ="actlan";
	var $personal = "actper"; var $institucion = "actemp";
	var $egresados = "actegd";var $elemIdiomas = "curidi";
	var $programa = "actpgm"; var $estudiante = "actbas";
	var $msguser = 'curmsg';
	public function __construct(){
	   parent:: __construct();
	}
 
    
	//metodo de logueo de usuario
	function datosUsuario($nriper,$pass){
		$sql = "select trim(p.nriper) as codusr, trim(p.nomper)as nombre, trim(p.apeper)as apellidos,trim(p.emlper)as email 
				from ".$this->personal." p
				where trim(p.nriper) in (select trim(e.nriper) from actbas e union select trim(d.nriper) from actprf d union select trim(u.nriper) from actusr u) 
				and trim(p.nriper)=? and p.pssper=?";
	   $res = $this->db->query($sql, array($nriper,$pass));
	  // echo $this->db->last_query();
	   return ($res->num_rows() >0) ? $res->row_array() : false;
	}  
   
   //metodo elementos varios
   function elementosGenerales($codelm, $tipelm){
	$sql = "select trim(nroelm) as codelm, trim(nomelm) as nomelm, round(vlrelm,0)as valor 
	       from ".$this->elemVarios." 
		   where trim(codelm)=? and trim(tipelm)=? and trim(nomelm)!='' order by nroelm";
	$res = $this->db->query($sql, array($codelm, $tipelm));
	return ($res->num_rows() >0) ? $res->result_array() : false;
   }
   
    //metodo elementos varios
   function elementosAdicionales($codigos){
	$sql = "select *
	       from actelm
		   where trim(nomobj) in($codigos) and tipo='CURRICULO' order by nomobj, nomopc";
	$res = $this->db->query($sql);
	return ($res->num_rows() >0) ? $res->result_array() : false;
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
	
	//metodo consultar Idiomas
	function consultarIdiomas($nriper){
	$sql = "select trim(l.codlan) as codlan, trim(l.nomlan) as nomlan 
			from ".$this->idiomas." l
			where trim(l.codlan) not in(select trim(i.codlan) from ".$this->elemIdiomas." i where i.nriper=?) 
			order by nomlan";
	$res = $this->db->query($sql, array($nriper));
	return ($res->num_rows() >0) ? $res->result_array() : false;
	} 
	
	
	//metodo de consultardatos de usuarios
	function datosEgresados($nriper){
	   $sql = "select a.nriper, a.ideper, a.apeper, a.nomper, a.sexper, a.civper, a.nacper, a.te1per, a.celper, 
	          a.emlper, a.dirper, a.milper,a.epsper, a.cajper, a.fonpen, a.fonces, a.painac, p.nompai, a.dptnac, 
			  d.nomdpt, a.ciunac, c.nommun, a.painri, p1.nompai as nombpai, a.dptnri, d1.nomdpt as nombdpt, a.ciunri, 
			  c1.nommun as nombmun, a.nrohij, a.emlinf
			   from ".$this->personal."  a
				inner join ".$this->pais."  p on trim(a.painac)=trim(p.codpai)
				inner join ".$this->departamentos."  d on trim(a.dptnac)=trim(d.coddpt)
				inner join ".$this->municipios."  c on trim(a.ciunac)=trim(c.codmun)
				inner join ".$this->pais."  p1 on trim(a.painri)=trim(p1.codpai)
				inner join ".$this->departamentos."  d1 on trim(a.dptnri)=trim(d1.coddpt)
				inner join ".$this->municipios."  c1 on trim(a.ciunri)=trim(c1.codmun)
			    where nriper=?";
	   $result = $this->db->query($sql, array($nriper));
	   return ($result->num_rows() >0)?$result->row_array():false;
    }
	
	//entidades educatiivas 
	function consultarInstituciones(){
	 $sql = "select trim(codemp) as codigo, trim(nomemp) as nombre  
	         from ".$this->institucion."  
			 where trim(claemp)='Educativa' and trim(codemp)!='' order by nomemp";
	 $res = $this->db->query($sql);
	 return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	//metodo de consultar claves de usuario
	function recuperarClave($nriper,$fecha){
	 $sql = "select trim(p.emlper)as emluser, trim(p.nacper) as fchnac 
				from ".$this->personal." p
				where trim(p.nriper) in (select trim(e.nriper) from actbas e union select trim(d.nriper) from actprf d) 
				and trim(p.nriper)=? and p.nacper=?";
	   $res = $this->db->query($sql, array($nriper,$fecha));
	   //echo $this->db->last_query();
	   return ($res->num_rows() >0) ? $res->row_array() : false;
	}
	
	//metodo de consultar programas egresados
	function consultarProgramasegr($nriper){
	 $sql = "select trim(e.codbas) as codbas, e.agnakd, e.prdakd, trim(b.codpgm) as codpgm, trim(p.nompgm)as nompgm
			 from ".$this->egresados." e 
			 inner join ".$this->estudiante." b on trim(e.codbas)=trim(b.codbas)
			 inner join  ".$this->programa." p on trim(b.codpgm)=trim(p.codpgm)
			 where b.nriper=? order by nompgm";
	 $res = $this->db->query($sql,array($nriper));
	 return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	//metodo de consultar programas estudiantes
	function consultarProgramasest($nriper){
	 $sql = "select trim(b.codbas) as codbas, b.agnakd, b.prdakd, trim(b.codpgm) as codpgm, trim(p.nompgm) as nompgm
			 from ".$this->estudiante." b 
			 inner join  ".$this->programa." p on trim(b.codpgm)=trim(p.codpgm)
			 where trim(b.nriper)=? order by nompgm";
	 $res = $this->db->query($sql,array($nriper));
	 return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	//metodo de numero de mensajes
	function nroMensajes($perfils, $programs){
	   $sql = "select count(*) as totmsg
	           from curmsg 
	           where trim(tipper) in($perfils) and trim(codpgm) in ($programs) and  current_date between fchini and fchfin";
	   $res = $this->db->query($sql);
	   //echo $this->db->last_query();
	   return ($res->num_rows() >0) ? $res->row_array() : false;
	}
	
	//metodo de consultar Mensajes
	  function consultarMensajes($perfils, $programs){
		$sql = "select m.desmsg,m.codpgm, p.nompgm, m.tipper 
				from curmsg m 
				left join actpgm p on trim(p.codpgm)=trim(m.codpgm)
				where trim(m.tipper) in($perfils) and trim(m.codpgm) in ($programs) and  current_date between m.fchini and m.fchfin";
		 $res = $this->db->query($sql);
		 return ($res->num_rows() >0) ? $res->result_array() : false;
	  }
     
	
	//metodo de consultar programas egresados
	function consultarPerfilesuser($nriper){
	 $sql = "select 'EG' as codpfl, 'Egresado' as nompfl from actegd where trim(codbas) in (select trim(codbas) from actbas where trim(nriper) = ?) 
	        union
            select 'ES' as codpfl, 'Estudiante' as nompfl from actbas where trim(nriper) = ? 
			union
			select 'DO' as codpfl, 'Docente' as nompfl from actprf where trim(nriper) = ?
			union 
            select 'AD' as codpfl, 'Empleado' as nompfl from actusr where trim(nriper)=? and opcusr!='0'";
	 $res = $this->db->query($sql,array($nriper,$nriper,$nriper,$nriper));
	 return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	//metodo consultar anios
	function consultarAnioscrt($nriper){
	 $sql = "select distinct trim(agnakd)||'|'||trim(prdakd) as codigo, 
		         trim(agnakd)||'/'||trim(prdakd)as nombre from actcrt 
				 where trim(addusr)=? 
				 order by codigo desc";
	 $res = $this->db->query($sql,array($nriper));
	 return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	//metoodo de cosultar opciones de usr
	function consultarOpcionadm($nriper){
	 $sql = "select trim(opcusr)as codopcs from actusr where trim(nriper)=?";
	 $res = $this->db->query($sql,array($nriper));
	 return ($res->num_rows() >0) ? $res->row_array() : false;
	}
	
	//metodo de consultar opciones de usuario
	function consultarOpcionesusr($codigos){
	  $sql = "select trim(urlopc)||'-'||trim(codopc) as codigo, trim(nomopc) as nombre 
	          from actopc 
			  where trim(codopc) in($codigos)
			  order by codopc";
	 $res = $this->db->query($sql);
	 return ($res->num_rows() >0) ? $res->result_array() : false;	
	}
	
	//metodo de consultar programas
	function datosProgramas($codbas){
	  $sql = "select trim(e.codbas) as codbas,e.codpgm,trim(p.nompgm)as nompgm
			  from actbas e
			  inner join ".$this->programa." p on trim(p.codpgm)=trim(e.codpgm)
			  where trim(e.codbas)=?";
	  $res = $this->db->query($sql,array($codbas));
	  return ($res->num_rows() >0) ? $res->row_array() : false;
	}
	
	//metodo de registra informacion mensajes
	function insectarDatosmsg($datos){
		return $this->db->insert($this->msguser, $datos);
	}
	
	
	//metodo de consultar mensajes
	function consultarMensajesusr($tipo){
	  $sql = "select m.codmsg, m.desmsg,m.astmsg,m.fchini,m.fchfin,m.tipper,m.tipmsg,m.codpgm,p.nompgm
			  from ".$this->msguser." m
			  left join ".$this->programa." p on trim(p.codpgm)=trim(m.codpgm)
			  where ";
	  if($tipo!='0'){$sql.=" m.tipper=?";}else{$sql.=" m.tipper!=?";}
	  $res = $this->db->query($sql,array($tipo));
	  return ($res->num_rows() >0) ? $res->result_array() : false;
	}
	
	
	//metodo de actualizar fechas de mensajes
	function actualizarFechasmsg($datos,$datos1){
	   $this->db->where($datos1);
	   $this->db->update($this->msguser, $datos);
	    return ($this->db->affected_rows()>0) ? true : false;
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
   function insertarPersona($nriper,$tpodoc,$nomuno,$nomdos,$apeuno,$apedos,$sexper,$tsnper,$fchper,$painac,$depnac,$ciunac,$elmper,$celper,$te1per,$discap,$dirper,$apeper,$nomper){
   		$sql = "INSERT INTO actper (nriper,ideper,nomuno,nomdos,apeuno,apedos,sexper,tsnper,nacper,painac,dptnac,ciunac,emlper,celper,te1per,discap,dirper,apeper,nomper) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
		$res = $this->db->query($sql,array($nriper,$tpodoc,$nomuno,$nomdos,$apeuno,$apedos,$sexper,$tsnper,$fchper,$painac,$depnac,$ciunac,$elmper,$celper,$te1per,$discap,$dirper,$apeper,$nomper));
		if($this->db->affected_rows()){ return true;} else { return false; }
		}
	/*Fin*/
	
	/*Inicio*/
   function insertarpromov($nriper, $codgra){
   		$sql = "INSERT INTO col_promov (codest,codgra) VALUES (?,?);";
		$res = $this->db->query($sql,array($nriper, $codgra));
		//if($this->db->affected_rows()){ return true;} else { return false; }
		}
	/*Fin*/	
	/*Inicio*/
   function insertarcnttrc($nriper, $nomtrc, $dirper, $te1per, $elmper, $nomuno, $nomdos, $apeuno, $apedos){
   		$sql = "INSERT INTO cnttrc(
            codtrc, nomtrc, dirtrc, teltrc, emltrc, nomuno, nomdos, apeuno, apedos) VALUES (?,?,?,?,?,?,?,?,?);";
		$res = $this->db->query($sql,array($nriper, $nomtrc, $dirper, $te1per, $elmper, $nomuno, $nomdos, $apeuno, $apedos));
		//if($this->db->affected_rows()){ return true;} else { return false; }
		}
	/*Fin*/	
	/*Inicio*/
   function insertarProfesor($nriper){
   		$sql = "INSERT INTO col_pfesor (codpro) VALUES (?);";
		$res = $this->db->query($sql,array($nriper));
		//if($this->db->affected_rows()){ return true;} else { return false; }
		}
	/*Fin*/	
	
}

?>