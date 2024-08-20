<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Campos_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('Basico_m','bas',	TRUE);
	}
	
	
	//chossen
	function Campos(){
		$this->output->set_header('Content-type: application/json');
		$condi=array('tipelm'=>$this->security->xss_clean($this->input->post('tipelm')),
		'nroelm'=>$this->security->xss_clean($this->input->post('nroelm')),
		'nomelm'=>$this->security->xss_clean($this->input->post('nomelm')));
		$res = $this->bas->consultar('trim(dspelm) dspelm','actelm',$condi);
		//echo $this->db->last_query();
		$info=array();
		if($res!=false){ foreach($res as $row){ $info[]=array('dspelm'=>$row['dspelm']); }
		echo json_encode($info); } else echo 1;	
	}
	
		function Campos_i(){
		$this->output->set_header('Content-type:application/json');
		$output = array("a" => array());
		$data['codelm'] = '0';
		$data['tipelm'] = $this->security->xss_clean($this->input->post('tipelm'));
		$data['nroelm'] = $this->security->xss_clean($this->input->post('nroelm'));
		$data['nomelm'] = $this->security->xss_clean($this->input->post('nomelm'));
		$data['dspelm'] = $this->security->xss_clean($this->input->post('dspelm'));
		$data['addusr'] = $this->session->userdata('user');
		$resp=$this->bas->insertar('actelm',$data);
		$output["err"]='1';
		echo json_encode($output);
	}
	
	
		
	
}