<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vista_c extends CI_Controller {
	 
	function __Construct(){
	   parent::__construct();
	   $this->load->library('session');
	   //$this->load->helper('turno');
	   $this->load->model('Turno_m','tur',TRUE);
	   //$this->load->helper(array('dompdf'));	
	}
	
	function vista(){
	$this->load->view('terceros/terceros_new_v');
	}
	
	function ticket(){
		$handle = printer_open("DYMO450");
				exit();
        printer_set_option($handle, PRINTER_MODE, "raw");
        printer_start_doc($handle, " Nombre del doc(esto no se imprime)");
        printer_start_page($handle);
//el codigo de printer_draw_bmp es para imprimir una imagen los numeros que //le siguen son el tamaño y posisiones
        printer_draw_bmp($handle, "direccion de la imagen", 215, 0, 110, 110);  
// el create font es para crear la fuente con fuente 
        $fontt = printer_create_font("Georgia", 38, 14, 100, false, false, false, 0);
//luego seleccionas las fuente que vas a usar
        printer_select_font($handle, $fontt);
//luego dibujas el texto con esa fuente y las cordenadas 
        printer_draw_text($handle, "Pones texto a imprimir", 95, 125);
        printer_delete_font($fontt);
	//$this->load->view('ticket');
	}
	
	function admin($vista=''){
		$this->load->view('admin/'.$vista);
		}
	
}	