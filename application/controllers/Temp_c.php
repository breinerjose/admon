<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp_c extends CI_Controller {
	 
	function __Construct(){
	   parent::__construct();
	   $this->load->model('Basico_m','bas',TRUE);
	}
	
    function index(){
       $resp=$this->bas->consultar('oid, a, q','espexe',array('id_consentimiento'=>NULL)); 
       foreach($resp as $row){
           $q=$row['q'];
           $fecha = date("Y-m-d",strtotime('1899-12-30'."+ $q days"));
           $res=$this->bas->consultarf('id_consentimiento','historias',array('id_cliente'=>$row['a'],'fecha'=>$fecha));
           if($res != false){ 
            $this->bas->actualizar('espexe',array('id_consentimiento'=>$res['id_consentimiento']),array('a'=>$row['a'],'q'=>$row['q']));
           }
        }
		
		// 7 dias hacia abajo y 15 dias hacia arriba		
       $resp=$this->bas->consultar('oid, a, q','espexe',array('id_consentimiento'=>NULL)); 
       foreach($resp as $row){
           $min=$row['q']-16;
		   $max=$row['q']+16;
           $fechamin = date("Y-m-d",strtotime('1899-12-30'."+ $min days"));
		   $fechamax = date("Y-m-d",strtotime('1899-12-30'."+ $max days"));
           $res=$this->bas->consultarf('id_consentimiento','historias',array('id_cliente'=>$row['a'],'fecha >'=>$fechamin,'fecha <'=>$fechamax));
		   //if($row['a'] == '1047464571'){echo $this->db->last_query(); }
           if($res != false){ 
            $this->bas->actualizar('espexe',array('id_consentimiento'=>$res['id_consentimiento']),array('a'=>$row['a'],'q'=>$row['q']));
           }
        }   
		//Fin 
    }		
}