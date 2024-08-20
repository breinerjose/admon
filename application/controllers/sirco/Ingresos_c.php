<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingresos_c extends CI_Controller {

    var $usuario;
    var $fecha;
    var $host;

    function __Construct() {
        parent::__construct();
		$this->load->model('sirco/Consecutivos_m','con',TRUE);  
		$this->load->model('sirco/doc_contable_m','doc',TRUE);
	    $this->load->model('sirco/Ingresos_m','pr',TRUE);//modelo, alias, verdadero cargue modelo  
        $this->usuario = $this->session->userdata('codigo');
		$this->load->library('numletras');
        $this->fecha = date("Y-m-d H:i:s");
        $this->host = $_SERVER['REMOTE_ADDR'];
		date_default_timezone_set("America/Bogota");
    }
	
	function verificar_fecha_contabilizacion(){
		$fecha = explode('-',trim($this->input->post('fecha')));
		$datos = array($fecha[0],$fecha[1]);
		$res = $this->pr->verificar_fecha_contabilizacion($datos);
		if($res!=false){ echo 1;} else{ echo 0;}
	}
	
	 function agregarConceptos(){
	$datos = explode('-',$this->input->post('ctaknp'));
	$codtrc = explode('-',$this->input->post('codtrc'));
    $ctaknp = trim($datos[0]);
    $nombre = $datos[2];
	$vlrcta = $this->input->post('vlrcta');
	$addusr = $this->session->userdata('codigo');
	$fchdcm = $this->input->post('fecha');
	$addfch= date('Y-m-d');
	$codalm = $this->input->post('codalm');
	$grado = $this->input->post('grado');
	$grupo = $this->input->post('grupo');
	$agnakd = $this->input->post('agnakd');
	$res = false;
	if (  $this->session->userdata('codigo') != '' or  $this->session->userdata('codigo') != null){
	$res = $this->pr->agregarConceptos(trim($codtrc[0]),$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm,$codalm,$grado,$grupo,$agnakd);
	}
	if($res==true){
	  echo '1';
	}else{
	  echo '0';
	}
  }
 
  function agregarConceptos2(){
 	$this->output->set_header('Content-type: application/json');
    $datos = explode('-',$this->input->post('ctaknp2'));
	$codtrc = explode('-',$this->input->post('codtrc'));
    $ctaknp = trim($datos[0]);
    $nombre = $datos[2];
	$vlrcta = $this->input->post('vlrcta2');
	$addusr = $this->session->userdata('codigo');
	$fchdcm = $this->input->post('fecha');
	$addfch= date('Y-m-d');
	$codalm = $this->input->post('codalm');
	$grado = $this->input->post('grado');
	$grupo = $this->input->post('grupo');
	$agnakd = $this->input->post('agnakd');
	$res = false;
	if (  $this->session->userdata('codigo') != '' or  $this->session->userdata('codigo') != null){
	$res = $this->pr->agregarConceptos2(trim($codtrc[0]),$ctaknp,$vlrcta,$nombre,$addusr,$addfch,$fchdcm,$codalm,$grado,$grupo,$agnakd); 
	}
	if($res !=false){
	  echo '1';
	}else{
	  echo '0';
	}
  }
  
  function credito(){
  
        $this->output->set_header('Content-type: application/json');
$res = $this->Bas_m->consultar_orden('trim(codknp) codknp,trim(nomknp) nomknp, trim(ctaknp) ctaknp', 'actknp',array('tpoknp' => 'Credito'),'codknp');
        if ($res != false) {
            $data = array();
            foreach ($res as $row) {
                $fila = array('ctaknp' => $row['ctaknp'], 'codknp' => $row['codknp'], 'nomknp' => encodeUtf8($row['nomknp']));
                $data[] = $fila;
            }
            echo json_encode($data);
        } else {
            echo '{"msg":"0"}';
        }
  }
  
function debito(){
$this->output->set_header('Content-type: application/json');
$res = $this->Bas_m->consultar_orden('trim(codknp) codknp,trim(nomknp) nomknp, trim(ctaknp) ctaknp', 'actknp',array('tpoknp' => 'Debito'),'codknp');
        if ($res != false) {
            $data = array();
            foreach ($res as $row) {
                $fila = array('ctaknp' => $row['ctaknp'], 'codknp' => $row['codknp'], 'nomknp' => encodeUtf8($row['nomknp']));
                $data[] = $fila;
            }
            echo json_encode($data);
        } else {
            echo '{"msg":"0"}';
        }
  }


function caja(){
        $this->output->set_header('Content-type: application/json');
$res = $this->Bas_m->consultar('codknp, nomknp, ctaknp', 'caja',array('codknp !='=>NULL));
        if ($res != false) {
            $data = array();
            foreach ($res as $row) {
                $fila = array('ctaknp' => $row['ctaknp'], 'codknp' => $row['codknp'], 'nomknp' => encodeUtf8($row['nomknp']));
                $data[] = $fila;
            }
            echo json_encode($data);
        } else {
            echo '{"msg":"0"}';
        }
  }

}