<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conceptos_c extends CI_Controller {
	 
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/conceptos_m','con',TRUE);
	   $this->load->model('sirco/puc_m','puc',TRUE);
	   $this->load->model('sirco/sedes_m','sedes',TRUE);	   
	   date_default_timezone_set("America/Bogota"); 
	}
	
	function obtener_conceptos(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->con->obtener_conceptos();
		$output = array("aaData" => array());
		if ($res != false){
			 foreach ($res as $row){
			   $output['aaData'][] = array(
			   		$row['codknp'],
					$row['nomknp'],
			   		$row['nomcta'],
					$row['tpoknp'],
					'<a href="javascript:void(0);" class="editar" id="'.$row['codknp'].'"><img src="/res/icons/sirco/edi.png"></a> &nbsp;&nbsp; <a href="javascript:void(0);" class="eliminar" id="'.$row['codknp'].'"><img src="/res/icons/sirco/del.png"></a>'
				);
			}	
		}
		echo json_encode($output);
	}
	
	function agregar_conceptos(){
		$cuenta = explode('-',$this->input->post('ctaknp'));
		$datos = array($this->input->post('nom'),$cuenta[0], $this->input->post('tpoknp'), '0.00');	
		$res = $this->con->agregar_conceptos($datos);
		if($res!=false){
			echo 0;
		}else{
			echo 1;	
		}
	}
	
	function datos_editar($codknp=''){
		$res = $this->con->datos_editar($codknp);
		$data['datos'] = $res;
		$this->load->view('sirco/conceptos/editar_concepto',$data);
	}
	
	function complet_conceptos(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->con->complet_conceptos();		
		echo json_encode($res);
	}
	
	function actualizar_conceptos(){
		$cuenta = explode('-',$this->input->post('ctaknp'));
		$datos = array($this->input->post('nom'),$cuenta[0], $this->input->post('tpoknp'), $this->input->post('cod'));
		$res = $this->con->actualizar_conceptos($datos);
		if($res!=false){
			echo 0;
		}else{
			echo 1;	
		}
	}
	
	function eliminar_conceptos(){
		$res = $this->con->eliminar_conceptos($this->input->post('codknp'));
		if($res!=false){
			echo 0;	
		}else{
			echo 1;	
		}
	}
	
	function reporte($ordenarpor=''){
		$res = $this->con->reporte($ordenarpor);
		$datos_conceptos = $this->sedes->cabecera_reportes();
		$filas='';
		if($res!=false){
			$con=1;
				foreach($res as $row){
					$filas .= '<tr>';
						$filas .=  '<td>'.$con.'</td>';
						$filas .= '<td> '.$row["codknp"].'</td>';
						$filas .=  '<td> '.$row["nomknp"].' </td>';
						$filas .= '<td> '.$row["tpoknp"].'</td>';
						$filas .=  '<td> '.$row["ctaknp"].' </td>';
					$filas .= '</tr>';
					$con++;
				}
			$data['datos'] = $filas;			
			$data['cabecera'] = $datos_conceptos;
			$this->load->view('sirco/conceptos/reporte',$data);
			
		}else{
			echo 'No hay datos registrados';	
		}		
	}
}