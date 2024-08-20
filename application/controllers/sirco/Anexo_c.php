<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anexo_c extends CI_Controller { 
	function __Construct(){
	   parent::__construct();
	    set_time_limit(0); 
	   ini_set("memory_limit", "999M");
	   ini_set("max_execution_time", "999"); 
	   $this->load->library('PHPExcel');
	   $this->load->model('sirco/anexo_m','ane',TRUE);
	   $this->load->model('sirco/empresa_m','emp',TRUE);
	   $this->load->model('sirco/Basico_m','bas',TRUE);
	   $this->load->helper(array('siamenu','dompdf','contabilidad'));
	}
	
	function cargar_vista($nombre=''){
		$this->load->view("sirco/anexo/".$nombre);
	}
	
	function anexo($fecini,$fecfin,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipimp,$sede,$tipcon,$tipo_informe){
		$sede = explode("-",urldecode($sede)); 
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		$sw=0;
		if($codtrca == $codtrcb and $codtrca != 'n' ){$sw=1;}
			$tr = '<tr>
						<td width="8%"><b>Cuenta</b></td>
						<td width="36%"><b>Nombre</b></td>
						<td width="14%" align="right"><b>Saldo A '.$fecini.'</b></td>
						<td width="14%" align="right"><b>Debito</b></td>
						<td width="14%" align="right"><b>Credito</b></td>
						<td width="14%" align="right"><b>Saldo A '.$fecfin.'</b></td></tr>';	
								
		if($this->session->userdata('codigo') == ''){exit();}
		$resa = $this->ane->anexo($fecini,$fecfin,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$this->session->userdata('codigo'));	
				
		$res = $this->ane->anexco_cuentas($this->session->userdata('codigo'));	
		if($res != false){			
		foreach($res as $row){
		if($sw == '0'){
		$tr .= '<tr>
						<td width="8%"><b>'.$row['codnif'].'</b></td>
						<td width="36%"><b>'.utf8_encode($row['nomnif']).'</b></td>
						<td width="14%" align="right"><b>'.number_format($row['sldant'],2,",",".").'</b></td>
						<td width="14%" align="right"><b>'.number_format($row['debdcm'],2,",",".").'</b></td>
						<td width="14%" align="right"><b>'.number_format($row['credcm'],2,",",".").'</b></td>
						<td width="14%" align="right"><b>'.number_format($row['sldcta']+$row['sldant'],2,",",".").'</b></td></tr>';	
		}else{
		$tr .= '<tr>
						<td width="8%"><b>'.$row['codnif'].'</b></td>
						<td width="36%"><b>'.utf8_encode($row['nomnif']).'</b></td>
						<td width="14%" align="right"></td>
						<td width="14%" align="right"></td>
						<td width="14%" align="right"></td>
						<td width="14%" align="right"></td></tr>';	
		}
		$resb = $this->ane->anexo_detalle($this->session->userdata('codigo'),$row['codnif']);
		foreach($resb as $rowb){
		//print_r($rowb);
		//exit();
		$tr .= '<tr>
						<td width="8%">'.$rowb['codtrc'].'</td>
						<td width="36%">'.utf8_encode($rowb['nomtrc']).'</td>
						<td width="14%" align="right">'.number_format($rowb['sldant'],2,",",".").'</td>
						<td width="14%" align="right">'.number_format($rowb['debdcm'],2,",",".").'</td>
						<td width="14%" align="right">'.number_format($rowb['credcm'],2,",",".").'</td>
						<td width="14%" align="right">'.number_format($rowb['sldcta']+$rowb['sldant'],2,",",".").'</td></tr>';
		}
		}}else{$tr .= '<tr>
						<td colspan="8" ><b>No Hay Informacion Para Mostrar</b></td>
						</tr>';}
		//}
		$rep_legal = $this->emp->rep_legal();
		$contador = $this->emp->contadora();
		$rev_fiscal = $this->emp->rep_fiscal();
		$data['rep_legal'] = $rep_legal['nomper'];
		$data['contador'] = $contador['nomper'];
		$data['rev_fiscal'] = $rev_fiscal['nomper'];
		$data['tpcontador'] = $contador['tpccia'];
		$data['tprevfiscal'] = $rev_fiscal['tprcia'];	
		$cabecera = $this->emp->cabecera_empresa();
		$data['nomtit'] = $cabecera['nomcia']; // Nombre Empresa
		$data['titInf'] = 'ANEXO DE BALANCE'; // Nombre Infome		
		$data['titInf1'] = strtoupper('A '.$fecfin);	//Descripcion	
		$data['peso'] = 'CIFRAS  EXPRESADAS  EN  PESOS  COLOMBIANOS';	
		$data['inform'] = $tr; // Contenido
		if($tipo_informe == 'web'){$this->load->view('/sirco/anexo/web_anexo_v',$data);}
		elseif($tipo_informe == 'pdf'){
		 $html = $this->load->view('/sirco/anexo/pdf_anexo_v',$data, TRUE);
		 crearPdf($html,'ANEXO DE BALANCE'.$fecini.' '.$fecfin.'.pdf');
			}elseif($tipo_informe == 'excel'){$this->load->view('/sirco/anexo/excel_anexo_v',$data);}
		
		}
		
	function exogena($fecini,$fecfin,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$tipimp,$sede,$tipcon,$tipo_informe,$saldo,$acumulado){		
			// Creamos un objeto PHPExcel
	$objPHPExcel = new PHPExcel();
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load('res/sirco/certificados/exogena.xlsx');
	// Indicamos que se pare en la hoja uno del libro
	$objPHPExcel->setActiveSheetIndex(0);
			
			function calcularDV($nit) {
    if (! is_numeric($nit)) {
        return false;
    }
 
    $arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19, 
    8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
    $x = 0;
    $y = 0;
    $z = strlen($nit);
    $dv = '';
    
    for ($i=0; $i<$z; $i++) {
        $y = substr($nit, $i, 1);
        $x += ($y*$arr[$z-$i]);
    }
    
    $y = $x%11;
    
    if ($y > 1) {
        $dv = 11-$y;
        return $dv;
    } else {
        $dv = $y;
        return $dv;
    }
    
}

		$sede = explode("-",urldecode($sede)); 
		$codsed = trim($sede[0]);
		$nomsed = trim($sede[1]);
		$sw=0;
		if($codtrca == $codtrcb and $codtrca != 'n' ){$sw=1;}
								
		if($this->session->userdata('codigo') == ''){exit();}
		$resa = $this->ane->anexo($fecini,$fecfin,$codctaa,$codctab,$codtrca,$codtrcb,$codctsa,$codctsb,$codauxa,$codauxb,$this->session->userdata('codigo'));	
		//echo $this->db->last_query();
                //exit();
		$condicion=array('addusr'=>$this->session->userdata('codigo'));	
		
		$res = $this->bas->consultar('*','view_sirco_exogena',$condicion);	
		if($res != false){	
		$i=5;		
		foreach($res as $row){
		//$row['sldant']
		if($saldo == 'debito'){$a = $row['debdcm']; }
		elseif($saldo == 'credito'){$a = $row['credcm'];}
		else{
		if($acumulado == 1){$a=$row['sldant']+$row['sldcta'];}else{$a=$row['sldcta'];}
		}
		if($a != 0){
		$x=trim($row['tpodoc']);
		if(strpos(trim($x), 'Ciudadan') or strpos(trim($x), 'Contrase')){$doc='13';}
		elseif(trim($x)=='Tarjeta de Identidad'){$doc='12';}
		elseif(trim($x)=='NIT'){$doc='31';}
		else{$doc=trim($x);}
		//$nom=$row['nomtrc'];
		if($doc=='31'){$nom=$row['nomtrc'];}else{$nom='';}
		$objPHPExcel->getActiveSheet()->getStyle('L'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $row['codnif']);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $doc);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $row['codtrc']);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, calcularDV($row['codtrc']));
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, encodeUtf8($row['ape1']));
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, encodeUtf8($row['ape2']));
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, encodeUtf8($row['nom1']));
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, encodeUtf8($row['nom2']));
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, encodeUtf8($nom));
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, encodeUtf8($row['dirtrc']));
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $row['ciutrc']);
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i,round($a,2));
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, encodeUtf8($row['nomnif']));
		$i++;
		}
		}
		}else{$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No Hay Informacion Para Mostrar');  
		}
		
	//$fec=date('Y-m-d H:i:s');	
	$fec='a';
	$nombre = $fec."exogena.xlsx";
	//Guardamos los cambios
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save("res/sirco/certificados/".$nombre);
	$data['codtrc']="/res/sirco/certificados/".$nombre;
	$this->load->view("sirco/retenciones/view_file",$data);
		
		}
	
		
	
}