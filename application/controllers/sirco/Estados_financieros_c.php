<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estados_financieros_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('sirco/estados_financieros_m','esta',TRUE);
	   $this->load->helper(array('siamenu','dompdf'));	

	}
	
	function cargar_vista($nombre=''){ 
		$this->load->view("sirco/estados_financieros/".$nombre);
	}
	
	function cargarVistaEstadoFinanciero(){
	  $this->load->view("sirco/estados_financieros/seleccionar_estado_fnif_v");

	}
	
	function imprimirReporte($dia1,$mes1,$anio1,$dia2,$mes2,$anio2,$balance,$nombre){		
		$resp=$this->esta->consultarNivel1($balance);
		$opt='';
		if($resp!=false){
			$totalfinal1=0;$totalfinal2=0;$totalfinalvar=0;
			foreach($resp as $row){
				$opt.='<p align="center"><b>'.encodeUtf8($row['nombaa']).'<b></p><hr>';
				$resp1=$this->esta->consultarNivel2($row['codbaa']);
				if($resp1!=false){
					$subtotal1=0;$subtotal2=0;$subtotalvar=0;					
					foreach($resp1 as $row1){
					$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"  class="cabe">
					
					<thead>
						<tr>
						<td></td>
							<td width="10%">'.encodeUtf8($row1['nombab']).'</td>
							<td width="45%"></td>
							<td width="15%">'.$anio1.'</td>
							<td width="15%">'.$anio2.'</td>
							<td width="15%">VARIACIÒN</td>
						</tr></thead></table>';	
					
				$resp2=$this->esta->consultarNivel3($row1['codbab']);
					if($resp2!=false){
						foreach($resp2 as $row2){
						$opt.='<p>'.encodeUtf8($row2['nombac']).'</p>';	
						$resp3=$this->esta->consultarCuentasAsociadas($balance,$row['codbaa'],$row1['codbab'],$row2['codbac']);
						if($resp3!=false){
							$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody>';
							$total=0;$total2=0; $total_variacion=0;
							foreach($resp3 as $row3){						
								$opt.='<tr>';
								$fecfin=$anio1.'-'.$mes1.'-'.$dia1;
								$fechaini=$anio1.'-'.$mes1.'-01';
								$fecfin2=$anio2.'-'.$mes2.'-'.$dia2;
								$fechaini2=$anio2.'-'.$mes2.'-01';
								$resp4=$this->esta->consultarSaldoCuenta($fecfin,$fechaini,$row3['codnif'],$row3['nivcta']);
								$resp5=$this->esta->consultarSaldoCuenta($fecfin2,$fechaini2,$row3['codnif'],$row3['nivcta']);
								$saldo1=($resp4['saldo']!='')?$resp4['saldo']:0;
								$saldo2=($resp5['saldo']!='')?$resp5['saldo']:0;
								$variacion=$saldo1-$saldo2;
									 $opt.='<td width="10%">'.$row3['codnif'].'</td>
									 <td width="45%">'.encodeUtf8($row3['nomnif']).'</td>
									 <td width="15%" class="saldo">'.$saldo1.'</td>
									 <td width="15%" class="saldo">'.$saldo2.'</td>
									 <td width="15%"  class="saldo">'.$variacion.'</td>';	
							    $opt.='</tr>';
								$total=$total+$saldo1;
								$total2=$total2+$saldo2;
								$total_variacion=$total_variacion+$variacion;
							}
							$opt.='<tr><td></td><td><b>TOTAL<b></td><td class="totales">'.$total.'</td><td class="totales">'.$total2.'</td><td class="totales">'.$total_variacion.'</td></tr></tbody></table>';
							$subtotal1=$subtotal1+$total;
							$subtotal2=$subtotal2+$total2;
							$subtotalvar=$subtotalvar+$total_variacion;	
						}
						
						}	
					}
					$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr>
							<td width="10%"></td>
							<td width="45%"><b>TOTAL '.encodeUtf8($row['nombaa'])." ".encodeUtf8($row1['nombab']).'</b></td>
							<td width="15%" class="totales">'.$subtotal1.'</td>
							<td width="15%" class="totales">'.$subtotal2.'</td>
							<td width="15%" class="totales">'.$subtotalvar.'</td>
							</tr></tbody></table>';
					$totalfinal1=$totalfinal1+$subtotal1;;
					$totalfinal2=$totalfinal2+$subtotal2;
					$totalfinalvar=$totalfinalvar+$subtotalvar;
					}
					$opt.='<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr>
							<td width="10%"></td>
							<td width="45%"><b>'.encodeUtf8($row['nombaa']).' TOTALES</b></td>
							<td width="15%" class="totales">'.$totalfinal1.'</td>
							<td width="15%" class="totales">'.$totalfinal2.'</td>
							<td width="15%" class="totales">'.$totalfinalvar.'</td>
							</tr></tbody></table>';
				}	
			}	
		}
		$data['tabla']=$opt;
		
		$this->load->view('sirco/estados_financieros/informe_estado_financiero_v',$data);
	}
	
	function cargarVistaEstado(){
		$data['balance']=$this->cargarComboBalance();
		$this->load->view('sirco/estados_financieros/configurar_estadosfnif_v',$data);	
	}
	
	function cargarComboBalance(){
		$opt='';
		$resp=$this->esta->cargarComboBalance();
		if($resp!=false){
			foreach($resp as $row){
				$opt.='<option value="'.$row['codbal'].'">'.encodeUtf8($row['nombal']).'</option>';	
			}	
		}
		return $opt;
		}
	
	function combo_balance(){
		$tipo = $this->input->post('tipbal');
		$res = $this->esta->combo_balance($tipo);
		if($res!=false){
			echo json_encode($res);	
		}else{
			echo 0;	
		}
	}
	
	function cargarBaa(){
		$this->output->set_header('Content-type:application/json');
		$codbal=$this->input->post('codbal');
		$resp=$this->esta->cargarBaa($codbal);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbaa'=>$row['codbaa'],'nombaa'=>$row['nombaa']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}	
	function cargarBab(){
		$this->output->set_header('Content-type:application/json');
		$codbaa=$this->input->post('codbaa');
		$resp=$this->esta->cargarBab($codbaa);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbab'=>$row['codbab'],'nombab'=>$row['nombab']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}
		function cargarBac(){
		$this->output->set_header('Content-type:application/json');
		$codbab=$this->input->post('codbab');
		$resp=$this->esta->cargarBac($codbab);
		$info=array();
		if($resp!=false){
			foreach($resp as $row){
				$info[]=array('codbac'=>$row['codbac'],'nombac'=>$row['nombac']);
			}
			$out=array('err'=>'1','data'=>$info);
			echo json_encode($out);	
		}else echo '{"err":"0","msg":"hubo un error al cargar los datos"}';	
		
	}
	
	
	 
	 

}