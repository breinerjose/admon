<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terceros_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	    $this->load->model('sirco/terceros_m','ter',TRUE);
	    $this->load->model('sirco/Basico_m','bas',TRUE);
	    $this->load->helper('siamenu');
	}

	 //metodo cargar tipo persona
	function DatosTercero(){
	$this->output->set_header('Content-type: application/json');
	$codtrc = $this->input->post('codtrc');
	$condi=array('codtrc'=>$codtrc);
	$result = $this->bas->consultarf('*','cnttrc',$condi);
	if($result != false){
	 $fila = array('emltrc'=>$result['emltrc'],'teltrc'=>$result['teltrc'],'nomtrc'=>$result['nomtrc'],'nomuno'=>$result['nomuno'],'nomdos'=>$result['nomdos'],'apeuno'=>$result['apeuno'],'apedos'=>$result['apedos'],'celtrc'=>$result['celtrc'],'dirtrc'=>$result['dirtrc'],'tiptrc'=>$result['tiptrc'],'tpodoc'=>$result['tpodoc']);
	 echo json_encode($fila);		
	}else{echo '1';}
	}//fin de metodo
	
	 //metodo cargar tipo persona
	function selectTipoper(){
	$this->output->set_header('Content-type: application/json');
	$res = $this->ter->selectTipoper();
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
	$res = $this->ter->selectTipodoc($this->input->post('codper'));
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
		$resultado = $this->ter->consultarPaises($this->input->post('codpai'),$this->input->post('nompai'));
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
		$resultado = $this->ter->consultarDepartamentos($this->input->post('codpai'));
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
		$resultado = $this->ter->consultarMunicipios($this->input->post('codpai'),$this->input->post('coddep'));
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
	function insertarcnttrc(){
		$this->output->set_header('Content-type: application/json');
		$codtrc = $this->input->post('codtrc');
		$dirtrc = $this->input->post('dirtrc');
		$teltrc = $this->input->post('teltrc');
		$emltrc = $this->input->post('emltrc');
		$tiptrc = $this->input->post('tiptrc');
		$tpodoc = $this->input->post('tpodoc');
		$nomuno = $this->input->post('nomuno');
		$nomdos = $this->input->post('nomdos');
		$apeuno = $this->input->post('apeuno');
		$apedos = $this->input->post('apedos');
		$nomtrc = $this->input->post('nomtrc');
		if($tpodoc != 6){
		$nomtrc = $nomuno." ".$nomdos." ".$apeuno." ".$apedos;
		}
        $celtrc = $this->input->post('celtrc');

		$result = $this->ter->insertarcnttrc($codtrc, $dirtrc, $teltrc, $emltrc, $tiptrc, $tpodoc, $nomuno, $nomdos, $apeuno, $apedos, $nomtrc, $celtrc);	 
		   if($result != false){
			echo '1';
	    }else{echo '0';}
				   
    }	
	/* Fin */

	function nombre_tercero(){
	    $codtrc = $this->input->post('codtrc');
		$res = $this->ter->nombre_tercero($codtrc);
		if($res!=false){ 
				echo '{"nomtrc" : "'.$res['nomtrc'].'", "err" : 0}';
		}else{
				echo '{"nomtrc" : "", "err" : 1}';
	    }
	}
	
		
		function cargarListadoTerceros(){
                $this->output->set_header('Content-type: application/json');
		$res = $this->bas->consultar('codtrc,nomtrc','cnttrc',array('codtrc !='=>NULL));
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   		"<a href='javascript:void(0);' class='cod' nom='".encodeUtf8(trim($row['nomtrc']))."' id='".trim($row['codtrc'])."'>".$row['codtrc']."</a>",
					encodeUtf8($row['nomtrc'])
				);
			}	
		}
		echo json_encode($output);
	       }
	
	
	function cargarListadoTercerosAlumnos(){
        $this->output->set_header('Content-type:appliaction/json');
        $output=array("aaData"=>array());
        $busqueda=strtoupper(trim($this->input->post('busqueda')));
        $agnakd=strtoupper(trim($this->input->post('agnakd')));
        $resp=$this->ter->cargarListadoTercerosAlumnos($busqueda,$agnakd);
        if($resp!=false){
            foreach($resp as $row){
            $output["aaData"][]=array($row['user'],$row['nombre'],$row['codalm'],$row['datos'],
            '<a href="#"  codigo="'.$row['user'].'" nombre="'.$row['nombre'].'" agncnt="'.$row['agncnt'].'"  codalm="'.$row['codalm'].'" grado="'.$row['grado'].'" grupo="'.$row['grupo'].'"
            datos="'.$row['datos'].'" class="seleccion"><img src="/res/icons/sirco/seleccion.png" alt="icono"/></a>');
         
            }
        }
        echo json_encode($output);
     
    }
	
	function tercerosajax(){
		$busqueda=trim($this->input->post('keyword'));
		$result=$this->ter->tercerosajax($busqueda);
		echo '<ul id="country-list">';
		foreach($result as $country) {
		?>
		<li onClick="selectCountry('<?php echo $country["nomtrc"]; ?>');"><?php echo $country["nomtrc"]; ?></li>
		<?php } ?>
		</ul>
		<?php } 
}
?>