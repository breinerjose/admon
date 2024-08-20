<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Areas_c extends CI_Controller {
	function __Construct(){
	   parent::__construct();
	   $this->load->model('Basico_m','bas',TRUE);
	}
	
	function departamentos_c(){
		$res = $this->bas->consultar('*','actdpt',array('coddpt !='=>NULL));
			 if($res!=false){
			   $output = array("a" => array());
					foreach ($res as $row){
						$output["a"][] = array('coddpt' => $row['coddpt'],'nomdpt' => $row['nomdpt']);	
				   }
				   $output["err"]='1';	
			}else{   $output["err"]='0';  }	
			echo json_encode($output);
	}
	
	function municipios_c(){
		$res = $this->bas->consultar('*','actmun',array('coddpt'=>$this->security->xss_clean($this->input->post('coddpt'))));
			 if($res!=false){
			   $output = array("a" => array());
					foreach ($res as $row){
						$output["a"][] = array('codmun' => $row['codmun'],'nommun' => $row['nommun']);	
				   }
				   $output["err"]='1';	
			}else{   $output["err"]='0';  }	
			echo json_encode($output);
	}
}