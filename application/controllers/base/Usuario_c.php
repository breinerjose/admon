<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario_c extends CI_Controller {
	var $usuario ; 
	function __Construct(){
	   parent::__construct();
	   	   $this->load->library('session');
	   $this->load->model('base/configuracion_m','conf',	TRUE);
	   $this->load->model('base/usuario_m','usu',	TRUE);
	   $this->load->model('base/login_m','login',	TRUE);
	   $this->load->model('Basico_m','bas',TRUE);
	   //$this->usuario = $_SESSION['usuario'];	
	   //$_SESSION['usuario']=$this->session->userdata('user'); 
	}
	
	function vista($vista=''){
	$this->load->view('/base/'.$vista);
	}
	
	function consultarUsuarios(){
	$this->output->set_header('Content-type: application/json');
	$ale=$this->input->post('ale');
		$res = $this->usu->consultarUsuarios();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
				 if(trim($row['estusr'])=='Activo'){
					$images = '<a href="#" title="Desactivar Usuario"  class="des'.$ale.'"  data-ide="'.$row['nriper'].'" 
					           data-nom="'.$row['nomtrc'].'" data-eml="'.$row['emltrc'].'" data-est="'.trim($row['estusr']).'"
							   data-sed="'.$row['codsed'].'"><img src="/res/icons/sirco/close.png" width="16" height="16" /></a >&nbsp;&nbsp;&nbsp;
							   <a href="#" title="Editar Perfil"  class="per'.$ale.'"  data-ide="'.$row['nriper'].'" 
							   data-nom="'.$row['nomtrc'].'" data-sed="'.$row['codsed'].'"><img src="/res/icons/sirco/edi.png" width="16" height="16" /></a >';
				 }else{
					$images = '<a href="#" title="Activar Usuario"  class="act'.$ale.'"  data-ide="'.$row['nriper'].'" 
							   data-nom="'.$row['nomtrc'].'"><img src="/res/icons/sirco/seleccion.png" width="16" height="16" /></a >';
				 }
				 
			   $output['aaData'][] = array($row['nriper'],$row['nomtrc'],$row['emltrc'],$row['estusr'],$images);
			}	          
		}
		echo json_encode($output);
	}
	
	function agregarUsuario(){
	$this->output->set_header('Content-type: application/json');
	$id = $this->input->post('identificacion');
	$pas = md5(trim($this->input->post('pass')));
	$prf = $this->input->post('perfil');
	$carg = $this->input->post('cargo');
	$sed = $this->input->post('sede');
	$result = $this->usu->agregarUsuario($id,$pas,$prf,$sed,$carg);
		if($result!=false){
			$result1 = $this->usu->consultarPaginasporperfil($prf);
			if($result1 != false){
				foreach($result1 as $row){
					$this->usu->registrarPermisos($row['codpag'],$id);
				}
			}
			echo '1';
		}else{echo '0';}
		
	}
	
	public function selectPerfil(){	
		$this->output->set_header('Content-type: application/json');
		$resultado = $this->usu->consultarPerfiles();
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				$fila = array( 'codigo'=>trim($row['codprf']),'nombre'=>trim($row['nomprf']));
				$data[] = $fila;
			}
		echo json_encode($data);
		 }else{
			echo '1';
		}
	}
	
	function actualizarUsuario(){
	$this->output->set_header('Content-type: application/json');
	$id = $this->input->post('identificacion1');$nom = strtoupper ($this->input->post('nombres1'));
	$eml = $this->input->post('correo1');$est = $this->input->post('estado');$prf = $this->input->post('perfil1');
	$carg = $this->input->post('cargo1');$sed = $this->input->post('sede1');
	$result = $this->usu->actualizarUsuario($id,$est,$prf,$sed,$carg);
		if($result!=false){
			$this->usu->eliminarPermisos($id);
			$result1 = $this->usu->consultarPaginasporperfil($prf);
			if($result1 != false){
				foreach($result1 as $row){
					$this->usu->registrarPermisos($row['codpag'],$id);
				}
			}
			echo '1';
		}else{echo '0';}
		
	}
	
	function activarUsuario(){
	   $this->output->set_header('Content-type: application/json');
	   $res = $this->usu->activarUsuario($this->input->post('codigo'));
	   if($res != false){
	   		echo '1';
	   }else{
	   		echo '0';
	   }
	}
	
	function vistaPaginasusuario($codigo,$nombre,$perfil){
	  $data['codusr'] = $codigo; 
	  $data['perf'] = $perfil;
	  $data['nombres']=urldecode($nombre);
	  $this->load->view('/base/actualizarPermisos_vista',$data); 
	  
	}
    
	
	function consultarPaginasuser(){
	$this->output->set_header('Content-type: application/json');
		$res = $this->usu->consultarPaginasperfiluser();
		$datos = array("aaData" => array());
			$row = $row1 = '';
	 	if($res != false){
			foreach($res as $row){
				$select = $bnd = '';
				$sw = $this->usu->validar_pagina($this->security->xss_clean($this->input->post('codigo')),$row['codpag']);
				if($sw != false){
							$bnd = 'checked';
			    }
				
			   $datos['aaData'][] = array($row['codpag'],$row['nompag'],$row['nomapl'],
			   '<input '.$bnd.' class="CheckBoxs" name="codCheck" type="checkbox" value='.$row['codpag'].'>');
			}//fin de foreach
		}//fin de if
		echo json_encode($datos);
	}
	
	function act_permiso(){
	$this->output->set_header('Content-type:application/json');	
	$condicion= array('codpag' => $this->security->xss_clean($this->input->post('codpag')), 'codusu' => $this->security->xss_clean($this->input->post('codusr')));
		$row=$this->bas->consultarf('codper','mnupso',$condicion);
		if($row!=false){
		$row=$this->bas->borrar('mnupso',$condicion);   $output["err"]='1';	}
		else{ 
		$this->bas->insertar('mnupso',$condicion);  $output["err"]='0';}
		echo json_encode($output);
	}
	
	function actualizarPermisouser(){
		$codprf = $this->input->post('codigo');
		$paginas = (($this->input->post('codCheck'))) ? $this->input->post('codCheck') : 0;
		$this->usu->eliminarPermisos($codprf);
		if($paginas != 0){
			for($i=0; $i<count($paginas); $i++){
				$this->usu->registrarPermisos($paginas[$i],$codprf);
				echo $this->db->last_query();
			}
			echo 0;
		}
	}
	/*-- MANEJO DE PERFILES---*/
	function consultarPerfiles(){
	$this->output->set_header('Content-type: application/json');
		$res = $this->usu->consultarPerfiles();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array($row['codprf'],$row['nomprf'],
					"<a href='#' title='Editar Datos'  class='edi'  data-ide='".$row['codprf']."' data-nom='".$row['nomprf']."'> 
					<img src='/res/icons/sirco/edi.png' width='16' height='16' /></a >&nbsp;&nbsp;&nbsp;
					<a href='#' title='Editar Perfil'  class='add'  data-ide='".$row['codprf']."' > 
					<img src='/res/icons/sirco/asignar.png'/></a >");
			}	
		}echo json_encode($output);
	}
	
	function agregarPerfil(){
		$this->output->set_header('Content-type: application/json');
		$descrip = ucwords($this->input->post('dscprf'));
		$result = $this->usu->agregarPerfil($descrip);
		if($result != false){
		   echo '1';
		}else{echo '0';}
	}
	
	function actualizarPerfil(){
	$this->output->set_header('Content-type: application/json');
		$descrip = ucwords($this->input->post('dscprf1'));
		$codigo = $this->input->post('codigo');
		$result = $this->usu->actualizarPerfil($descrip,$codigo);
		if($result != false){
		   echo '1';
		}else{echo '0';}
	}
	 function vistaPaginas($codigo){
		$data['cod']=$codigo;
		$this->load->view('/base/paginasGeneral_vista',$data);
	 }
	
	function consultarPaginas($cod){
		$this->output->set_header('Content-type: application/json');
		$res = $this->usu->consultarPaginas();
		$datos = array("aaData" => array());
			$row = $row1='';
	 	if($res != false){
			$codigos = $this->usu->consultarPaginasporperfil($cod);
			foreach($res as $row){
				$bnd = '';
				if($codigos != false){
					foreach($codigos as $row1){
						if($row['codpag']==$row1['codpag']){
							$bnd = 'checked';	
						}
					}
			    }
			   $datos['aaData'][] = array($row['codpag'],$row['nompag'],
			   '<input '.$bnd.' class="CheckBoxs" name="codCheck[]" type="checkbox" value='.$row['codpag'].'>');
			}//fin de foreach
		}//fin de if
        echo json_encode($datos);
	}
	
	function asignarPaginasperfil(){
	   $codprf = $this->input->post('codigo');
		$paginas = (($this->input->post('codCheck'))) ? $this->input->post('codCheck') : 0;
		$this->usu->eliminarPaginasperfil($codprf);
		if($paginas != 0){
			for($i=0; $i<count($paginas); $i++){
				$this->usu->asignarPaginasperfil($paginas[$i],$codprf);
			}
			echo 0;
		}
	}
	
	function cambiarPassword(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->usu->cambiarPassword(md5(trim($this->input->post('nueva'))),$_SESSION['usuario']);
		if($res != false){
			 echo '1';
		}else{
			echo '0';
		}
	}
	
	function verificarPassword(){
	  $this->output->set_header('Content-type: application/json');
	   $res = $this->login->logueo($_SESSION['usuario'], 
	   md5(trim($this->input->post('contr'))));
	  if($res != false){
			 echo '1';
		}else{
			echo '0';
		}
	}
	
	function recuperarClave(){
	     $this->output->set_header('Content-type: application/json');
	     //$this->load->helper('correo');
		 $id = trim($this->input->post('codusr'));
		 $res = $this->conf->consultarusuario($id);
		 if($res != false){
			 if($res['emltrc']!= ''){
			 $d=date('Y');$m=date('1'.'m');$d=date('1'.'d');
			 $hh=date('1'.'H');$mm=date('1'.'s');$ss=date('1'.'i');
			 $clave = (($d*$hh)+($m*$mm)+($d*$ss)*10);
			 $pass = md5(trim($clave));
				if($this->usu->cambiarPassword($pass, $id)){
				  //$cuerpo = "Su clave de acceso ha sido reestablecida por:: " .trim($clave). "\n"; 
  				  //mando el correo... 
  				  //mail($res['emltrc'],"CLAVE CONTABILIDAD MISION BOSTON",$cuerpo);
				require("class.phpmailer.php");

				$mail = new PHPMailer();
					 
				//Luego tenemos que iniciar la validación por SMTP:
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = "aprendeconbreiner.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
				$mail->Username = "claves@aprendeconbreiner.com"; // Correo completo a utilizar
				$mail->Password = "F26ef4a24A*+"; // Contraseña
				$mail->Port = 25; // Puerto a utilizar
				 
				//Con estas pocas líneas iniciamos una conexión con el SMTP. 
				$mail->From = "claves@aprendeconbreiner.com"; // Desde donde enviamos (Para mostrar)
				$mail->FromName = "Clave Acceso Sistema Contable";
					 
				//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: "From: Nombre <correo@dominio.com>");
				$mail->IsHTML(true); // El correo se envía como HTML
					  
				$mail->AddAddress($res['emltrc']); // Esta es la dirección a donde enviamos
				$mail->Subject = "Clave Acceso Sistema Contable"; // Este es el titulo del email.
				$body = "Cordial Saludo. "."<br>";
				$body .= "Su Clava a sido Rstablecida la Nueva Clave es ".trim($clave)."<br>";
				$mail->Body = $body; // Mensaje a enviar
				$exito = $mail->Send(); // Envía el correo.
				$mail->ClearAddresses();
  
			   echo '{"err":"1" , "msg":"Su nueva clave ha sido enviada al correo: '.$res['emltrc'].'"}';
			  }else{
					  echo '{"err":"0" , "msg":"Error al restablecer clave"}';
				 }
			 }else{ echo '{"err":"2" , "msg":"Usted no tiene correo por favor comuniquese con su<br/>
			                                  Coordinador."}';}
		}else
		  echo '{"err":"no" , "msg":"Usuario no existe"}';				
		 
	}
	
	public function consultarSede(){	
		$this->output->set_header('Content-type: application/json');
		$resultado = $this->usu->consultarSede();
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				$fila = array( 'codigo'=>trim($row['codsed']),'nombre'=>trim($row['nomsed']));
				$data[] = $fila;
			}
		echo json_encode($data);
		 }else{
			echo '1';
		}
	}
	
	public function consultarCargo(){	
		$this->output->set_header('Content-type: application/json');
		$resultado = $this->usu->consultarCargo();
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				$fila = array( 'codigo'=>trim($row['codcar']),'nombre'=>trim($row['nomcar']));
				$data[] = $fila;
			}
		echo json_encode($data);
		 }else{
			echo '1';
		}
	}
	
	function selectAplicaciones(){
		$this->output->set_header('Content-type: application/json');
		$resultado = $this->usu->consultarAplicaciones();
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				$fila = array( 'codigo'=>trim($row['codapl']),'nombre'=>trim($row['nomapl']));
				$data[] = $fila;
			}
		echo json_encode($data);
		 }else{
			echo '1';
		}
	 }
	 
	 function selectPaginas(){
		$this->output->set_header('Content-type: application/json');
		$codapl = $this->input->post('codapl');
		$resultado = $this->usu->consultarPaginasaplics($codapl);
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				$fila = array( 'codigo'=>trim($row['codpag']),'nombre'=>trim($row['nompag']));
				$data[] = $fila;
			}
		echo json_encode($data);
		 }else{
			echo '1';
		}
	 }
	 
	  function consultarTodosusuarios($codsed,$codcar,$codper,$codest,$codapl,$codpag){
		 $this->output->set_header('Content-type: application/json');
		 if($codsed=='0'){$sede = '';}else{$sede = $codsed;}
		 if($codcar=='0'){$cargo = '';}else{$cargo = $codcar;}
		 if($codper=='-1'){$perfil = '';}else{$perfil = $codper;}
		  if($codest=='0'){$estado = '';}else{$estado = $codest;}
		  if($codapl=='0'){$aplics = '';}else{$aplics = $codapl;}
		  if($codpag=='0'){$pagina = '';}else{$pagina = $codpag;}
		$res = $this->usu->consultarTodosusuarios($sede,$cargo,$perfil,$estado,$aplics,$pagina);
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array($row['nomapl'],$row['nompag'],$row['identificacion'],$row['nombres'],$row['nomprf'],
			                               $row['nomsed'],$row['cargo'],$row['estado']);
			}	
		}echo json_encode($output);
	 }
	 
	 function generarInformeusuario($codsed,$codcar,$codper,$codest,$codapl,$codpag,$noms,$nomc,$nomp,$nomapl,$nompag){
		 if($codsed=='0'){$sede = '';}else{$sede = $codsed;}
		 if($codcar=='0'){$cargo = '';}else{$cargo = $codcar;}
		 if($codper=='-1'){$perfil = '';}else{$perfil = $codper;}
		 if($codest=='0'){$estado = '';}else{$estado = $codest;}
		  if($codapl=='0'){$aplics = '';}else{$aplics = $codapl;}
		  if($codpag=='0'){$pagina = '';}else{$pagina = $codpag;}
		 $res = $this->usu->consultarTodosusuarios($sede,$cargo,$perfil,$estado,$aplics,$pagina); 
		 $total = $this->usu->consultarTotalusuarios($sede,$cargo,$perfil,$estado,$aplics,$pagina); 
			 $datos = array('sede'=>urldecode($noms),'cargo'=>urldecode($nomc),'perfil'=>urldecode($nomp),
			                'aplics'=>urldecode($nomapl),'pagina'=>urldecode($nompag),
			                'estado'=>$estado,'tabla'=>$res,'totalusu'=>$total['total']);
			 $this->load->view('/usuario/generarInformeusuario',$datos);
		 }
	function activar_usuario(){
		$this->output->set_header('Content-type: application/json');
		$condicion['nriper'] = $this->security->xss_clean($this->input->post('codigo'));
		$data['estusr'] = 'Activo';
		$resp = $this->bas->actualizar('actusr',$data,$condicion);		 
		if($resp!=false){echo '{"err":"1"}';}else{echo '{"err":"0","msg":"hubo un error"}';}
		}
	
	function desactivar_usuario(){
		$this->output->set_header('Content-type: application/json');
		$condicion['nriper'] = $this->security->xss_clean($this->input->post('codigo'));
		$data['estusr'] = 'Inactivo';
		$resp = $this->bas->actualizar('actusr',$data,$condicion);		 
		if($resp!=false){echo '{"err":"1"}';}else{echo '{"err":"0","msg":"hubo un error"}';}
		}
	
}