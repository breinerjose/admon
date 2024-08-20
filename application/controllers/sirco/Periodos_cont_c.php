<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodos_cont_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/periodos_cont_m','pc',TRUE);
	   date_default_timezone_set("America/Bogota");
	}

	function llenar_tabla($anio=''){
		$this->output->set_header('Content-type: application/json');
		$res = $this->pc->filtro_por_anio($anio);
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
				$option='';
				if($row["stdprd"]=='Abierto'){ $option='<option value="Abierto">Abierto</option><option value="Cerrado">Cerrado</option><option value="En espera">En espera</option>';}	 else if($row["stdprd"]=='Cerrado'){
					$option='<option value="Cerrado">Cerrado</option><option value="Abierto">Abierto</option><option value="En espera">En espera</option>';
				}else if($row["stdprd"]=='En espera'){
					$option='<option value="En espera">En espera</option><option value="Cerrado">Cerrado</option><option value="Abierto">Abierto</option>';
				}
			   $output['aaData'][] = array(
			   		$row['agncnt'],
					$row['mescnt'],
			   		'<select class="selects" mes="'.$row['mescnt'].'" anio="'.$row['agncnt'].'">'.$option.'</select>'
				);
			}	
		}
		echo json_encode($output);
	}
	
	function actualizar_estado(){
		$datos = array($this->input->post('std'),$this->input->post('anio'),$this->input->post('mes'));
		$res = $this->pc->actualizar_estado($datos);
		if($res!=false){ echo 1;}else{ echo 0;}
	}
	
	function verificar_usuario(){
		echo 0;
		//Función para verificar si un usuario puede cerrar periodo u año contable	
	}
	
	function cerrar_anio_contable(){
		$datos = array($this->input->post('anio'));
		$res = $this->pc->cerrar_anio_contable($datos);
		if($res!=false){ echo 1;}else{ echo 0;}	
	}
	
}