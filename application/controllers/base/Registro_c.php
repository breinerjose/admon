<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registro_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('base/registro_m','reg',	TRUE);
	}
	
	function vista($vista=''){
	$this->load->view('base/'.$vista);
	}
	
	 //metodo cargar tipo persona
	function selectTipoper(){
	$this->output->set_header('Content-type: application/json');
	$res = $this->reg->selectTipoper();
		 if($res!=false){
           $data = array();
                foreach ($res as $row){
                       $fila = array( 'tipo'=>$row['codigo'],'nombre'=>trim(utf8_encode($row['dsctip'])));
                       $data[] = $fila;
               }
               echo json_encode($data);
        }else{
               echo '{"msg":"0"}';
       }
	}//fin de metodo
	
	function selectTipodoc(){
	$this->output->set_header('Content-type: application/json');
	$res = $this->reg->selectTipodoc($this->input->post('codper'));
		 if($res!=false){
           $data = array();
                foreach ($res as $row){
                       $fila = array( 'tipo'=>$row['codtip'],'nombre'=>trim(utf8_encode($row['dsctip'])));
                       $data[] = $fila;
               }
               echo json_encode($data);
        }else{
               echo '{"msg":"0"}';
       }
	
	}
	
	 
	 //metodo de obtener los paises
	function consultarPaises(){
		$this->output->set_header('Content-type: application/json');
		$resultado = $this->reg->consultarPaises($this->input->post('codpai'),$this->input->post('nompai'));
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				 	$fila = array('codpai'=>$row['codpai'],'nompai'=>$row['nompai']);
				 	$data[] = $fila;
		   }
		   echo json_encode($data);
		 }else{echo '{"msg":"1"}';}
	}
	
	 //metodo de obtener los Departamntos de uun pais
	function consultarDepartamentos(){
		$this->output->set_header('Content-type: application/json');
		$resultado = $this->reg->consultarDepartamentos($this->input->post('codpai'));
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				 	$fila = array('codigo'=>$row['coddep'],'nombre'=>$row['nomdep']);
				 	$data[] = $fila;
		   }
		   echo json_encode($data);
		 }else{echo '{"msg":"1"}';}
	}
	
	 //metodo de obtener los municipios de un departamento
	function consultarMunicipios(){
		$this->output->set_header('Content-type: application/json');
		$resultado = $this->reg->consultarMunicipios($this->input->post('codpai'),$this->input->post('coddep'));
	    if($resultado!=false){
		    $data = array();
			 foreach ($resultado as $row){
				 	$fila = array('codigo'=>$row['codmun'],'nombre'=>$row['nommun']);
				 	$data[] = $fila;
		   }
		   echo json_encode($data);
		 }else{echo '{"msg":"1"}';}
	}
	
	/* Inicio */
	function insertarPersona(){
		$this->output->set_header('Content-type: application/json');
		$nriper = $this->input->post('nriper');
		$tpodoc = $this->input->post('tpodoc');
		$nomuno = $this->input->post('nomuno');
		$nomdos = $this->input->post('nomdos');
		$apeuno = $this->input->post('apeuno');
		$apedos = $this->input->post('apedos');
		$sexper = $this->input->post('sexper');
		$tsnper = $this->input->post('tsnper');
		$fchper = $this->input->post('fchper');
		$painac = $this->input->post('painac');
		$depnac = $this->input->post('depnac');
		$ciunac = $this->input->post('ciunac');
		$elmper = $this->input->post('elmper');
		$celper = $this->input->post('celper');
		$te1per = $this->input->post('te1per');
		$discap = $this->input->post('discap');
		$dirper = $this->input->post('dirper');
		$codgra = $this->input->post('codgra');
		$apeper = $apeuno." ".$apedos;
		$nomper = $nomuno." ".$apedos;
		
		$result = $this->reg->insertarpromov($nriper,$codgra);

		$result = $this->reg->insertarPersona($nriper,$tpodoc,$nomuno,$nomdos,$apeuno,$apedos,$sexper,$tsnper,$fchper,$painac,$depnac,$ciunac,$elmper,$celper,$te1per,$discap,$dirper,$apeper,$nomper);	
		   if($result != false){
			echo '1';
	    }else{echo '0';}
				   
    }	
	/* Fin */
	/* Inicio */
	function insertarProfesor(){
		$this->output->set_header('Content-type: application/json');
		$nriper = $this->input->post('nriper');
		$tpodoc = $this->input->post('tpodoc');
		$nomuno = $this->input->post('nomuno');
		$nomdos = $this->input->post('nomdos');
		$apeuno = $this->input->post('apeuno');
		$apedos = $this->input->post('apedos');
		$sexper = $this->input->post('sexper');
		$tsnper = $this->input->post('tsnper');
		$fchper = $this->input->post('fchper');
		$painac = $this->input->post('painac');
		$depnac = $this->input->post('depnac');
		$ciunac = $this->input->post('ciunac');
		$elmper = $this->input->post('elmper');
		$celper = $this->input->post('celper');
		$te1per = $this->input->post('te1per');
		$discap = $this->input->post('discap');
		$dirper = $this->input->post('dirper');
		$apeper = $apeuno." ".$apedos;
		$nomper = $nomuno." ".$apedos;
		$nomtrc = $nomper." ".$apeper;
		
		$result = $this->reg->insertarcnttrc($nriper, $nomtrc, $dirper, $te1per, $elmper, $nomuno, $nomdos, $apeuno, $apedos);
		
		$result = $this->reg->insertarProfesor($nriper);

		$result = $this->reg->insertarPersona($nriper,$tpodoc,$nomuno,$nomdos,$apeuno,$apedos,$sexper,$tsnper,$fchper,$painac,$depnac,$ciunac,$elmper,$celper,$te1per,$discap,$dirper,$apeper,$nomper);	
		   if($result != false){
			echo '1';
	    }else{echo '0';}
				   
    }	
	/* Fin */
	
		
	
}
?>