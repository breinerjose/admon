<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_c extends CI_Controller {

	function __Construct(){
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('base/login_m','login',TRUE);
	   $this->load->model('Basico_m','bas',TRUE);	
	}

	public function index(){
	 header('Content-Type: text/html; charset=UTF-8'); 
		if($this->input->post('user') != '' AND $this->input->post('pass') != ''){
		$this->session->set_userdata('user',trim($this->input->post('user')));
		$this->session->set_userdata('codigo',trim($this->input->post('user')));
		$this->session->set_userdata('pass',md5(trim($this->input->post('pass'))));
		$res = $this->login->logueo($this->session->userdata('user'),$this->session->userdata('pass'),'Activo');
		if($res != false){
		$this->session->set_userdata('nomtrc',$res['nomtrc']);
		$this->session->set_userdata('codsed',$res['codsed']);
		//Armo el meni
		$arbol='';
		$concultarOpciones = $this->login->concultarOpciones($this->session->userdata('user'));
		if($concultarOpciones!=false){
			foreach($concultarOpciones as $row){
				$arbol .= '<li><a><i class="'.trim($row['clase']).'"></i>'.trim($row['nomapl']).'<span class="fa fa-chevron-down"></span></a>';
				$arbol .= '<ul class="nav child_menu">';
				$subOpciones = $this->login->subOpciones($this->session->userdata('user'),$row['codapl']);
				if($subOpciones!=false){
				foreach($subOpciones as $rows){
				if(trim($rows['item']) != 'dialogo'){
				$arbol .= ' <li><a  class="mnu" href="javascript:void(0);" url="'.trim($rows['urlpag']).'">'.trim($rows['nompag']).'</a></li>';	
					}else{	
				$arbol .= ' <li><a  class="mnu2" url="'.trim($rows['urlpag']).'">'.trim($rows['nompag']).'</a></li>';
				}
					}
				}
				$arbol .= '</ul></li>';
				}			
		}
		//
		$data['menu'] = $arbol;
		$data['nomtrc'] = $res['nomtrc'];
		$this->load->view('/base/principal_vista',$data);	
		}else{
	    $data['msg'] = 'Señor usuario Datos Erroneos!!! Verifique por favor' ;
	    $this->load->view('/base/login_vista',$data);	
		}
	  }
	}
	
		public function menu(){
		if(isset($_SESSION['usuario'])){
			$dep = $this->input->post('dep');
			$opciones = $this->login->concultarOpciones($this->session->userdata('user'),$dep);
			$men = '<div id="menu">';
			if($opciones != false){
			 $men .= '<div id="accordion">';
				   foreach($opciones as $row){
					   $men .= '<h3 id="'.$row['codapl'].'">'.$row['nomapl'].'</h3>'; 
					   $subopc = $this->login->subOpciones($this->session->userdata('user'),$row['codapl']);
					   if($subopc != false){
						  $men .= '<div class="'.$row['codapl'].'"><ul>';
						   foreach($subopc as $row1){
									$men .= '<li><a class="ventana" href="javascript:void(null);" title="'.$row1['nompag'].'"
											data-url="'.$row1['urlpag'].'" data-alt="'.$row1['alto'].'" data-ach="'.$row1['ancho'].'">
											'.$row1['nompag'].'</a></li>';
						   }
						   $men .='</ul></div>';
					   }
				   }
			 
			 $men .= '</div></div>';
			}
			echo $men;
				
			}	
		}
	
	function logueo(){
	$this->load->view('base/login_vista');
	}
	
	function vista(){
	$this->load->view('subir_imagenes');
	}
	
	function logout(){
	session_destroy();  	
	$this->load->view('base/login_vista');
    }
	function cargarMenu(){
		$url=$this->input->post('url');
		$data['ale']= rand(0,10000);
		$data['user']=$this->session->userdata('user');
		$this->load->view($url,$data);		
	}	
	
	
}