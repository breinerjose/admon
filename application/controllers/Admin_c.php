<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Admin_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   //$this->load->model('tarifa_m','tar',	TRUE);
	}
	
	function vista($vista=''){
	$this->load->view(admin/$vista);
	}

}