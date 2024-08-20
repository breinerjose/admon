<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mnuhoriz_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('configuraciones/login_m','login',TRUE);
	   $this->load->model('configuraciones/mnuhoriz_m','mno',TRUE);
	   date_default_timezone_set("America/Bogota");
	}
	
	function vista($nombre=''){ 
		$this->load->view("configuraciones/".$nombre);
	}
	
	function arbol(){
		$arbol='';
		$item_principales = $this->mno->items_principales($this->session->userdata('user'));
		if($item_principales!=false){
			foreach($item_principales as $row){
				$arbol = $arbol.'<li><a href="javascript:void(0)" class="dep detalle"  data-dep="'.trim($row['codopc']).'"><span 		
				class="file">&nbsp;'.trim($row['nomopc']).'</span></a></li>';
				}			
		echo $arbol;
		}
	}	

}