<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Busqueda_doc_contable_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/busqueda_doc_contable_m','doc',TRUE);
	   date_default_timezone_set("America/Bogota");
	}
	
	function consultarDatos($codsed,$coddoc,$codcts,$codcta,$codnif,$fecha1,$fecha2,$nrocmp,$nroegr,$codtrc,$ale){
		$this->output->set_header('Content-type: application/json');
		$output = array("aaData" => array());
		if($coddoc==0 && $codcts==0 && $codcta==0 && $codnif==0 && $fecha1==0 && $fecha2==0 && $nrocmp==0){
			echo json_encode($output);
		}else{
			$codsed = ($codsed=='0')?'':$codsed; $coddoc = ($coddoc=='0')?'':$coddoc;
			$codcts = ($codcts=='0')?'':$codcts; $codcta = ($codcta=='0')?'':$codcta;
			$codnif = ($codnif=='0')?'':$codnif; $fecha1 = ($fecha1=='0')?'':$fecha1;
			$fecha2 = ($fecha2=='0')?'':$fecha2; $nrocmp = ($nrocmp=='0')?'':$nrocmp;
			$nroegr = ($nroegr=='0')?'':$nroegr;$codtrc = ($codtrc=='0')?'':$codtrc;
			
			
			$res = $this->doc->consultarDatos($codsed,$coddoc,$codcts,$codcta,$codnif,$fecha1,$fecha2,0,$nroegr,$codtrc);
			//echo $this->db->last_query();
			
			if ($res != false){
				 foreach ($res as $row){
			    $codigs = $row['nrocmp'].'-'.$row['coddoc'].'-'.$row['codsed'].'-'.$row['agncnt'].'-'.$row['mescnt'];
			    $fch = explode("/",$row['fchcmp']);
				$imp=$row['nrocmp'].'-'.$row['coddoc'].'-'.$row['codsed'].'-'.$row['agncnt'].'-'.$row['mescnt'].'-'.$row['agncnt'].'-'.$row['mescnt'].'-'.$fch[0];
				$btns='';$check='';
			if($row['stdcmp']=='Generado' and $row['stdprd']=='Abierto'){					   
				$btnedit = "<a href='javascript:void(0);' title='Editar'  class='edit".$ale." editt btnst' data-hab='".$row['stdprd']."' data-id ='".$codigs."'> 
					 <img src='/res/icons/sirco/editar.png' height='16' /> Editar</a >";
				$btnrvet ="<a href='javascript:void(0);' title='Revertir'  class='rvtir".$ale." rvtirr btnst' data-id ='".$codigs."'> 
					 <img src='/res/icons/sirco/revert.png' height='16' /> Revertir</a >";
				$btns = $btnedit.' '.$btnrvet;
				$check='<center><input type="checkbox" class="revertir_all"  name="revertir[]" value="'.$codigs.'"></center>';
			}
			$btns=$btns." <a href='javascript:void(0);' title='Impresora Puntos' data-print='".$imp."' class='imgimprimirPuntos imprimirPuntos".$ale."'>
						  <img src='/res/icons/sirco/print-icon.png'></a> 
						  <a href='javascript:void(0);' title='Impresora Laser' data-print='".$imp."' class='imgimprimirLaser imprimirLaser".$ale."'>
						  <img src='/res/icons/sirco/printnif.png'></a>
						  <a href='javascript:void(0);' title='Imprimir Cheque' data-print='".$imp."' class='imgimprimirCheque imprimirCheque".$ale."'>
						  <img src='/res/icons/sirco/cheque.png'></a>";
						  
				//Fin de Botones
			$output['aaData'][] = array($check,$row['agncnt'],$row['mescnt'],$row['coddoc'],$row['nrocmp'],$row['fchcmp'],$row['codsed'],$btns);
				
				
				}	
			}
			echo json_encode($output);
		}			
	}
	
}