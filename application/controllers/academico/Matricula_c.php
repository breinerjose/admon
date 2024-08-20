<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(-1);// -1 ** 0
class Matricula_c extends CI_Controller {
	
	function __Construct(){
	   parent::__construct();
	   $this->load->model('academico/Matricula_m','tar',TRUE);
	   $this->load->model('sirco/Basico_m','bas',TRUE);
	   $this->load->model('sirco/Consecutivos_m','con',TRUE);  
	   set_time_limit(0); 
	   ini_set("memory_limit","4000M");
	}
	
	function vista($vista=''){
	$this->load->view("academico/matricula/".$vista);
	}
	
	//chossen
	function terceros(){
		$this->output->set_header('Content-type: application/json');
		$res = $this->tar->terceros();
		$info=array();
		if($res!=false){			
			foreach($res as $row){
				$info[]=array('codtrc'=>$row['codtrc'],'nomtrc'=>$row['nomtrc']);
			}
		echo json_encode($info);
		}
		else echo 1;	
	}
	
	
	function agregarmatricula(){
	$this->output->set_header('Content-type: application/json');
	$codtrc = $this->input->post('codtrc');
	$codalm = $this->input->post('codalm');
	$grado = $this->input->post('grado');
	$grupo = $this->input->post('grupo');
	$periodo = $this->input->post('periodo');
	$tipmat = $this->input->post('tipmat');
	$result = $this->tar->agregarmatricula($codtrc,$codalm,$grado,$periodo,$grupo);	
	
//	$resx=$this->bas->consultar('*','matric',array('agncnt'=>'2019'));
//	
//	foreach($resx as $rowx){
//	extract($rowx);
//	$codtrc = $codpad;
//	$codalm = $codest;
//	$periodo = $agncnt;
	
	$condi=array('agnakd'=>$periodo,'tipmat'=>$tipmat);
	$resp=$this->bas->consultarf('*','matfin',$condi);	
	$total=$resp['valmat']+$resp['valext'];
	//Matricula
	$nrocmp = $this->con->consecutivo('33','01',$periodo,'001',$this->session->userdata('codigo'));
	$data=array(
	'agncnt'=>$periodo,
	'mescnt'=>'01',
	'coddoc'=>'33',
	'fchcmp'=>date('Y-m-d'),
	'nrocmp'=>$nrocmp,
	'stdcmp'=>'Generado',
	'debcmp'=>$total,
	'crecmp'=>$total,
	'addusr'=>$this->session->userdata('codigo'),
	'codsed'=>'001',
	'addfch'=>date('Y-m-d h:i:s'),
	'obscmp'=>'Matricula por Cobrar '.$periodo);
	$this->bas->insertar('cntcmp',$data);
	unset($data);
	
	$data=array(
	'nrocmp'=>$nrocmp,
	'codtrc'=>$codtrc,
	'codcta'=>$resp['cxcmat'],
	'credcm'=>'0',
	'debdcm'=>$total,
	'stddcm'=>'Generado',
	'agncnt'=>$periodo,
	'agnakd'=>$periodo,
	'mescnt'=>'01',
	'detdcm'=>'MATRICULA '.$periodo,
	'coddoc'=>'33',
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'fchdcm'=>date('Y-m-d'),
	'codalm'=>$codalm,
	'grado'=>$grado,
	'grupo'=>$grupo,
	'codsed'=>'001',
	);
	$this->bas->insertar('cntdcm',$data);
	unset($data);
	
	$data=array(
	'nrocmp'=>$nrocmp,
	'codtrc'=>$codtrc,
	'codcta'=>$resp['ctamat'],
	'credcm'=>$resp['valmat'],
	'debdcm'=>'0',
	'stddcm'=>'Generado',
	'agncnt'=>$periodo,
	'agnakd'=>$periodo,
	'mescnt'=>'01',
	'detdcm'=>'MATRICULA '.$periodo,
	'coddoc'=>'33',
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'fchdcm'=>date('Y-m-d'),
	'codalm'=>$codalm,
	'grado'=>$grado,
	'grupo'=>$grupo,
	'codsed'=>'001',
	);
	$this->bas->insertar('cntdcm',$data);
	unset($data);
	
	$data=array(
	'nrocmp'=>$nrocmp,
	'codtrc'=>$codtrc,
	'codcta'=>$resp['ctaext'],
	'credcm'=>$resp['valext'],
	'debdcm'=>'0',
	'stddcm'=>'Generado',
	'agncnt'=>$periodo,
	'agnakd'=>$periodo,
	'mescnt'=>'01',
	'detdcm'=>'MATRICULA '.$periodo,
	'coddoc'=>'33',
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'fchdcm'=>date('Y-m-d'),
	'codalm'=>$codalm,
	'grado'=>$grado,
	'grupo'=>$grupo,
	'codsed'=>'001',
	);
	$this->bas->insertar('cntdcm',$data);
	unset($data);
	
	//Mensualidad
	for($i=2;$i<12;$i++){
	if($i<10){$i ='0'.$i;}
	if($i == '02'){$d='28';}else{$d='30';}
	$nrocmp = $this->con->consecutivo('34',$i,$periodo,'001',$this->session->userdata('codigo'));
	$data=array(
	'agncnt'=>$periodo,
	'mescnt'=>$i,
	'coddoc'=>'34',
	'fchcmp'=>$periodo.'-'.$i.'-'.$d,
	'nrocmp'=>$nrocmp,
	'stdcmp'=>'Generado',
	'debcmp'=>$resp['valmen'],
	'crecmp'=>$resp['valmen'],
	'addusr'=>$this->session->userdata('codigo'),
	'codsed'=>'001',
	'addfch'=>date('Y-m-d h:i:s'),
	'obscmp'=>'Mensualidad por Cobrar Periodo '.$i.' '.$periodo);
	$this->bas->insertar('cntcmp',$data);
	unset($data);
	
	$data=array(
	'nrocmp'=>$nrocmp,
	'codtrc'=>$codtrc,
	'codcta'=>$resp['cxcmen'],
	'credcm'=>'0',
	'debdcm'=>$resp['valmen'],
	'stddcm'=>'Generado',
	'agncnt'=>$periodo,
	'agnakd'=>$periodo,
	'mescnt'=>$i,
	'detdcm'=>'MENSUALIDAD '.$i.' '.$periodo,
	'coddoc'=>'34',
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'fchdcm'=>$periodo.'-'.$i.'-'.$d,
	'codalm'=>$codalm,
	'grado'=>$grado,
	'grupo'=>$grupo,
	'codsed'=>'001',
	);
	$this->bas->insertar('cntdcm',$data);
	unset($data);
	
	$data=array(
	'nrocmp'=>$nrocmp,
	'codtrc'=>$codtrc,
	'codcta'=>$resp['ctamen'],
	'credcm'=>$resp['valmen'],
	'debdcm'=>'0',
	'stddcm'=>'Generado',
	'agncnt'=>$periodo,
	'agnakd'=>$periodo,
	'mescnt'=>$i,
	'detdcm'=>'MENSUALIDAD '.$i.' '.$periodo,
	'coddoc'=>'34',
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'fchdcm'=>$periodo.'-'.$i.'-'.$d,
	'codalm'=>$codalm,
	'grado'=>$grado,
	'grupo'=>$grupo,
	'codsed'=>'001',
	);
	$this->bas->insertar('cntdcm',$data);
	unset($data);
	}
	
	if($result!=false){ echo '1'; }else{ echo '0'; } 
	//}
	}
	
	function matriculas(){
		$this->output->set_header('Content-type: application/json');
		$this->db->select('max(agnakd) as agnakd');
		$this->db->from('matfin');
		$res = $this->db->get();
		$res = $res->row_array();
$result = $this->bas->consultar('oid, codtrc, nomtrc, codalm, nomalm, grado, agncnt, grupo, tipmat','view_ter_alm',array('agncnt'=>$res['agnakd'],'delusr'=>NULL));
		$output = array("aaData" => array());
			if($result != FALSE){
				foreach($result as $row ){
				$output['aaData'][] = array($row['codtrc'],$row['nomtrc'],$row['codalm'],$row['nomalm'],$row['grado'],$row['grupo'],$row['agncnt'],
				"<a href='#' title='Eliminar Matricula'  class='eliminar'  
				data-datoid='".$row['oid']."'
				data-codtrc='".$row['codtrc']."' 
				data-nomtrc='".$row['nomtrc']."' 
				data-codalm='".$row['codalm']."'
				data-nomalm='".$row['nomalm']."'
				data-agncnt='".$row['agncnt']."'
				data-grado='".$row['grado']."' 
				data-grupo='".$row['grupo']."'>
				 <img src='/res/icons/biblioteca/delet.png' width='20' height='20' /></a >","
				 <a href='#' title='Actualizar Matricula'  class='editar'  
				data-datoid='".$row['oid']."'
				data-codtrc='".$row['codtrc']."' 
				data-nomtrc='".$row['nomtrc']."' 
				data-codalm='".$row['codalm']."'
				data-nomalm='".$row['nomalm']."'
				data-agncnt='".$row['agncnt']."'
				data-grado='".$row['grado']."' 
				data-grupo='".$row['grupo']."'
				data-tipmat='".$row['tipmat']."'>
				 <img src='/res/icons/biblioteca/edit.png' width='20' height='20' /></a >","
				 <a href='#' title='Actualizar Matricula'  class='extracto'  
				data-datoid='".$row['oid']."'
				data-codtrc='".$row['codtrc']."' 
				data-nomtrc='".$row['nomtrc']."' 
				data-codalm='".$row['codalm']."'
				data-nomalm='".$row['nomalm']."'
				data-agncnt='".$row['agncnt']."'
				data-grado='".$row['grado']."' 
				data-grupo='".$row['grupo']."'
				data-tipmat='".$row['tipmat']."'>
				 <img src='/res/icons/sirco/print-icon.png' width='20' height='20' /></a >");
				}
				echo json_encode($output);
			}
	   }
	   
	function eliminar_matricula($datoid,$codtrc,$nomtrc,$codalm,$nomalm,$grado,$grupo,$agncnt){
	   			$data['datoid'] = $datoid;
				$data['codtrc'] = $codtrc;
				$data['nomtrc'] = urldecode($nomtrc);
				$data['codalm'] = $codalm;
				$data['nomalm'] = urldecode($nomalm);
				$data['grado'] = $grado;
				$data['grupo'] = $grupo;
				$data['agncnt'] = $agncnt;
				$this->load->view('academico/matricula/eliminar_matricula_v.php',$data);
	   } 
	   
	   function editar_matricula($datoid,$codtrc,$nomtrc,$codalm,$nomalm,$grado,$grupo,$agncnt,$tipmat){
	   			$data['datoid'] = $datoid;
				$data['codtrc'] = $codtrc;
				$data['nomtrc'] = urldecode($nomtrc);
				$data['codalm'] = $codalm;
				$data['nomalm'] = urldecode($nomalm);
				$data['gradon'] = $grado;
				$data['grupo'] = $grupo;
				$data['agncnt'] = $agncnt;
				$data['tipmatn'] = $tipmat;
				$this->load->view('academico/matricula/editar_matricula_v.php',$data);
	   } 
	   
	function elimina_matricula(){
	$this->output->set_header('Content-type: application/json');
	$datoid = $this->input->post('datoid');
	$codalm = $this->input->post('codalm');
	$codtrc = $this->input->post('codtrc');
	$agncnt = $this->input->post('agncnt');
	$grado = $this->input->post('grado');
	$grupo = $this->input->post('grupo');
	
	$this->db->select('nrocmp, agncnt, coddoc, mescnt, codsed');
	$this->db->where('codalm', $codalm);
	$this->db->where('codtrc', $codtrc);
	$this->db->where('agncnt', $agncnt);
	$this->db->where('grado', $grado);
	$this->db->where('grupo', $grupo);
	$query = $this->db->get('cntdcm');
	foreach ($query->result_array() as $row)
	{
    extract($row);
	$this->db->set('stdcmp', 'Revertido');
	$this->db->where('nrocmp', $nrocmp);
	$this->db->where('agncnt', $agncnt);
	$this->db->where('coddoc', $coddoc);
	$this->db->where('mescnt', $mescnt);
	$this->db->where('codsed', $codsed);
	$this->db->update('cntcmp');
	
	$this->db->set('stddcm', 'Revertido');
	$this->db->where('nrocmp', $nrocmp);
	$this->db->where('agncnt', $agncnt);
	$this->db->where('coddoc', $coddoc);
	$this->db->where('mescnt', $mescnt);
	$this->db->where('codsed', $codsed);
	$this->db->update('cntdcm');

	}
	
	$this->db->where('codoid', $datoid);
	$this->db->delete('matric');	
	echo '1'; 
	}
	
	function anio(){
	 $this->output->set_header('Content-type: application/json');
		$res = $this->tar->anio();
			 if($res!=false){
			   $data = array();
					foreach ($res as $row){
						   $fila = array('anio'=>$row['agncnt']);
						   $data[] = $fila;
				   }
				   echo json_encode($data);
			}else{
				   echo '{"msg":"0"}';
		   }	
	}
	
	
	function edita_matricula(){
	$this->db->trans_start();
	$this->output->set_header('Content-type: application/json');
	$datoid = $this->input->post('datoid');
	$codalm = $this->input->post('codalm');
	$codtrc = $this->input->post('codtrc');
	$agncnt = $this->input->post('agncnt');
	$grado = $this->input->post('grado');
	$grupo = strtoupper($this->input->post('grupo'));
	$tipmat = $this->input->post('tipmat');
	
	$condi=array('agnakd'=>$agncnt,'tipmat'=>$tipmat);
	$resp=$this->bas->consultarf('*','matfin',$condi);	
	$total=$resp['valmat']+$resp['valext'];
	
	$conact=array('agnakd'=>$agncnt,'codtrc'=>$codtrc,'codalm'=>$codalm,'coddoc'=>'33','codcta'=>$resp['cxcmat'],'mescnt'=>'01');		
	$data=array(
	'debdcm'=>$total,
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'grado'=>$grado,
	'grupo'=>$grupo
	);
	$this->bas->actualizar('cntdcm',$data,$conact);
	unset($data);
	unset($conact);
	
	$conact=array('agnakd'=>$agncnt,'codtrc'=>$codtrc,'codalm'=>$codalm,'coddoc'=>'33','codcta'=>$resp['ctamat'],'mescnt'=>'01');		
	$data=array(
	'credcm'=>$resp['valmat'],
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'grado'=>$grado,
	'grupo'=>$grupo
	);
	$this->bas->actualizar('cntdcm',$data,$conact);
	unset($data);
	unset($conact);
	
	$conact=array('agnakd'=>$agncnt,'codtrc'=>$codtrc,'codalm'=>$codalm,'coddoc'=>'33','codcta'=>$resp['ctaext'],'mescnt'=>'01');	
	$data=array(
	'credcm'=>$resp['valext'],
	'addusr'=>$this->session->userdata('codigo'),
	'addfch'=>date('Y-m-d h:i:s'),
	'grado'=>$grado,
	'grupo'=>$grupo
	);
	$this->bas->actualizar('cntdcm',$data,$conact);
	unset($data);
	unset($conact);
	
	$conact=array('agncnt'=>$agncnt,'codpad'=>$codtrc,'codest'=>$codalm);	
	$data=array('grado'=>$grado,'grupo'=>$grupo,'tipmat'=>$tipmat);
	$this->bas->actualizar('matric',$data,$conact);
	unset($data);
	unset($conact);
	
	$conact=array('agncnt'=>$agncnt,'codtrc'=>$codtrc,'codalm'=>$codalm);	
	$data=array('grado'=>$grado,'grupo'=>$grupo);
	$this->bas->actualizar('cntdcm',$data,$conact);
	unset($data);
	unset($conact);
	
	echo '1'; 
	$this->db->trans_complete();
	}
	
	
	function grado(){
	 $this->output->set_header('Content-type: application/json');
		$res = $this->tar->grado();
			 if($res!=false){
			   $data = array();
					foreach ($res as $row){
						   $fila = array('grado'=>$row['grado']);
						   $data[] = $fila;
				   }
				   echo json_encode($data);
			}else{
				   echo '{"msg":"0"}';
		   }	
	}
	
	function grupo(){
	 $this->output->set_header('Content-type: application/json');
		$res = $this->tar->grupo();
			 if($res!=false){
			   $data = array();
					foreach ($res as $row){
						   $fila = array('grupo'=>$row['grupo']);
						   $data[] = $fila;
				   }
				   echo json_encode($data);
			}else{
				   echo '{"msg":"0"}';
		   }	
	}
	
	function ingresos($agncnt,$grado,$grupo,$tipo){
	$condi['agncnt']=$agncnt;
	$this->bas->borrar('ingpag',array('codalm !='=>'0'));
	if($grado != 'n'){$condi['grado']=$grado;}
	if($grupo != 'n'){$condi['grupo']=$grupo;}
	$resp=$this->bas->consultar('agncnt, grado, grupo','view_grados',$condi);
	foreach($resp as $row){
	$this->db->query("SELECT pagos_recibidos('".$row['agncnt']."','".$row['grado']."','".$row['grupo']."')");
	}
		
	//Genero el informe
	$tabla='
	<table width="100%" border="1" cellpadding="0" cellspacing="0">
  	<tr>
    <td>No.</td>
    <td>Id Acudiente</td>
    <td>Acudiente</td>
    <td>Id Alumno</td>
    <td>Alumno</td>
    <td>Periodo</td>
    <td>Grado</td>
    <td>Grupo</td>
    <td>Matricula</td>
    <td>Febrero</td>
    <td>Marzo</td>
    <td>Abril</td>
    <td>Mayo</td>
    <td>Junio</td>
    <td>Julio</td>
    <td>Agosto</td>
    <td>Septi</td>
    <td>Octubre</td>
    <td>Novie</td>
    <td>T. Mens</td>
    <td>Total</td>
  </tr>
	';
	$resp=$this->bas->consultarorder('codoid, grado, grupo','ingpag',array('codtrc'=>'TOTALES'),'codoid');
	foreach($resp as $row){
	$condi=array('grado'=>$row['grado'],'grupo'=>$row['grupo']);
	if($tipo == 'B'){
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="ing_consolidado.xls"');
	header('Cache-Control: max-age=0');
	$condi['codtrc']='TOTALES';}
	$respb=$this->bas->consultar('*','ingpag',$condi);
        $i = 0;
	foreach ($respb as $rowb){
	$i++;
	$tabla .='<tr>
				<td>'.$i.'</td>
				<td>'.$rowb['codtrc'].'</td>
				<td>'.$rowb['nomtrc'].'</td>
				<td>'.$rowb['codalm'].'</td>
				<td>'.$rowb['nomalm'].'</td>
				<td>'.$rowb['agncnt'].'</td>
				<td>'.$rowb['grado'].'</td>
				<td>'.$rowb['grupo'].'</td>
				<td>'.round($rowb['pag01'],2).'</td>
				<td>'.round($rowb['pag02'],2).'</td>
				<td>'.round($rowb['pag03'],2).'</td>
				<td>'.round($rowb['pag04'],2).'</td>
				<td>'.round($rowb['pag05'],2).'</td>
				<td>'.round($rowb['pag06'],2).'</td>
				<td>'.round($rowb['pag07'],2).'</td>
				<td>'.round($rowb['pag08'],2).'</td>
				<td>'.round($rowb['pag09'],2).'</td>
				<td>'.round($rowb['pag10'],2).'</td>
				<td>'.round($rowb['pag11'],2).'</td>
				<td>'.round(($rowb['totpag']-$rowb['pag01']),2).'</td>
				<td>'.round($rowb['totpag'],2).'</td>
			  </tr>';	
	}
	}
	$tabla .='</table>';
	
	echo $tabla;
	}
	
		function calcularcxc($agncnt,$grado,$grupo){
	$condi['agncnt']=$agncnt;
	$this->bas->borrar('ingpag',array('codalm !='=>'0'));
	if($grado != 'n'){$condi['grado']=$grado;}
	if($grupo != 'n'){$condi['grupo']=$grupo;}
	$resp=$this->bas->consultargroup('agncnt, grado, grupo','matric',$condi,'agncnt, grado, grupo');
	foreach($resp as $row){
	$this->db->query("SELECT pagos_recibidos('".$row['agncnt']."','".$row['grado']."','".$row['grupo']."')");
	}
		
	//Genero el informe
	$tabla='
	<table width="100%" border="1" cellpadding="0" cellspacing="0">
  	<tr>
    <td>No.</td>
    <td>Id Acudiente</td>
    <td>Acudiente</td>
    <td>Id Alumno</td>
    <td>Alumno</td>
    <td>Periodo</td>
    <td>Grado</td>
    <td>Grupo</td>
    <td>Matricula</td>
    <td>Febrero</td>
    <td>Marzo</td>
    <td>Abril</td>
    <td>Mayo</td>
    <td>Junio</td>
    <td>Julio</td>
    <td>Agosto</td>
    <td>Septi</td>
    <td>Octubre</td>
    <td>Novie</td>
    <td>T. Mens</td>
    <td>Total</td>
  </tr>
	';
	$resp=$this->bas->consultargroup('grado, grupo','ingpag',array('grado !='=>NULL),'grado, grupo');
	foreach($resp as $row){
	$respb=$this->bas->consultar('*','ingpag',array('grado'=>$row['grado'],'grupo'=>$row['grupo']));
        $i = 0;
	foreach ($respb as $rowb){
	$i++;
	$tabla .='<tr>
				<td>'.$i.'</td>
				<td>'.$rowb['codtrc'].'</td>
				<td>'.$rowb['nomtrc'].'</td>
				<td>'.$rowb['codalm'].'</td>
				<td>'.$rowb['nomalm'].'</td>
				<td>'.$rowb['agncnt'].'</td>
				<td>'.$rowb['grado'].'</td>
				<td>'.$rowb['grupo'].'</td>
				<td>'.round($rowb['sld01'],2).'</td>
				<td>'.round($rowb['sld02'],2).'</td>
				<td>'.round($rowb['sld03'],2).'</td>
				<td>'.round($rowb['sld04'],2).'</td>
				<td>'.round($rowb['sld05'],2).'</td>
				<td>'.round($rowb['sld06'],2).'</td>
				<td>'.round($rowb['sld07'],2).'</td>
				<td>'.round($rowb['sld08'],2).'</td>
				<td>'.round($rowb['sld09'],2).'</td>
				<td>'.round($rowb['sld10'],2).'</td>
				<td>'.round($rowb['sld11'],2).'</td>
				<td>'.round(($rowb['totsld']-$rowb['sld01']),2).'</td>
				<td>'.round($rowb['totsld'],2).'</td>
			  </tr>';	
	}
	}
	$tabla .='</table>';
	
	echo $tabla;
	}
	
	function calcularcxcb($agncnt,$grado,$grupo){
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="cxc_consolidado.xls"');
	header('Cache-Control: max-age=0');
	$condi['agncnt']=$agncnt;
	$this->bas->borrar('ingpag',array('codalm !='=>'0'));
	if($grado != 'n'){$condi['grado']=$grado;}
	if($grupo != 'n'){$condi['grupo']=$grupo;}
	$resp=$this->bas->consultargroup('agncnt, grado, grupo','matric',$condi,'agncnt, grado, grupo');
	foreach($resp as $row){
	$this->db->query("SELECT pagos_recibidos('".$row['agncnt']."','".$row['grado']."','".$row['grupo']."')");
	}
		
	//Genero el informe
	$tabla='
	<table width="100%" border="1" cellpadding="0" cellspacing="0">
  	<tr>
    <td>Periodo</td>
    <td>Grado</td>
    <td>Grupo</td>
    <td>Matricula</td>
    <td>Febrero</td>
    <td>Marzo</td>
    <td>Abril</td>
    <td>Mayo</td>
    <td>Junio</td>
    <td>Julio</td>
    <td>Agosto</td>
    <td>Septi</td>
    <td>Octubre</td>
    <td>Novie</td>
    <td>T. Mens</td>
    <td>Total</td>
  </tr>
	';
	$resp=$this->bas->consultargroup('grado, grupo','ingpag',array('grado !='=>NULL),'grado, grupo');
	$a=$b=$c=$d=$e=$f=$g=$h=$i=$j=$k=$l=0;
	foreach($resp as $row){
	$respb=$this->bas->consultar('*','ingpag',array('grado'=>$row['grado'],'grupo'=>$row['grupo'],'codtrc'=>'TOTALES'));
	foreach ($respb as $rowb){
	$a +=$rowb['sld01'];
	$b +=$rowb['sld02'];
	$c +=$rowb['sld03'];
	$d +=$rowb['sld04'];
	$e +=$rowb['sld05'];
	$f +=$rowb['sld06'];
	$g +=$rowb['sld07'];
	$h +=$rowb['sld08'];
	$i +=$rowb['sld09'];
	$j +=$rowb['sld10'];
	$k +=$rowb['sld11'];
	$l +=$rowb['totsld'];
	
	$i++;
	$tabla .='<tr>
				<td>'.$rowb['agncnt'].'</td>
				<td>'.$rowb['grado'].'</td>
				<td>'.$rowb['grupo'].'</td>
				<td>'.round($rowb['sld01'],2).'</td>
				<td>'.round($rowb['sld02'],2).'</td>
				<td>'.round($rowb['sld03'],2).'</td>
				<td>'.round($rowb['sld04'],2).'</td>
				<td>'.round($rowb['sld05'],2).'</td>
				<td>'.round($rowb['sld06'],2).'</td>
				<td>'.round($rowb['sld07'],2).'</td>
				<td>'.round($rowb['sld08'],2).'</td>
				<td>'.round($rowb['sld09'],2).'</td>
				<td>'.round($rowb['sld10'],2).'</td>
				<td>'.round($rowb['sld11'],2).'</td>
				<td>'.round(($rowb['totsld']-$rowb['sld01']),2).'</td>
				<td>'.round($rowb['totsld'],2).'</td>
			  </tr>';	
	}
	}
	
		$tabla .='<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>'.round($a,2).'</td>
				<td>'.round($b,2).'</td>
				<td>'.round($c,2).'</td>
				<td>'.round($d,2).'</td>
				<td>'.round($e,2).'</td>
				<td>'.round($f,2).'</td>
				<td>'.round($g,2).'</td>
				<td>'.round($h,2).'</td>
				<td>'.round($i,2).'</td>
				<td>'.round($j,2).'</td>
				<td>'.round($k,2).'</td>
				<td>'.round(($l-$a),2).'</td>
				<td>'.round($l,2).'</td>
			  </tr>';
			  
	$tabla .='</table>';
	
	echo $tabla;
	}
	
	
	function listado($agncnt,$grado,$grupo){
	$condi['agncnt']=$agncnt;
	$this->bas->borrar('ingpag',array('codalm !='=>'0'));
	if($grado != 'n'){$condi['grado']=$grado;}
	if($grupo != 'n'){$condi['grupo']=$grupo;}
	$respb=$this->bas->consultarorder('codtrc, nomtrc, codalm, nomalm, grado, agncnt, grupo','view_ter_alm',$condi,'agncnt, grado, grupo');
	//Genero el informe
	$tabla='
	<table width="100%" border="1" cellpadding="0" cellspacing="0">
  	<tr>
    <td>No.</td>
    <td>Id Acudiente</td>
    <td>Acudiente</td>
    <td>Id Alumno</td>
    <td>Alumno</td>
    <td>Periodo</td>
    <td>Grado</td>
    <td>Grupo</td>
  </tr>
	';
        $i = 0;
	foreach ($respb as $rowb){
	$i++;
	$tabla .='<tr>
				<td>'.$i.'</td>
				<td>'.$rowb['codtrc'].'</td>
				<td>'.$rowb['nomtrc'].'</td>
				<td>'.$rowb['codalm'].'</td>
				<td>'.$rowb['nomalm'].'</td>
				<td>'.$rowb['agncnt'].'</td>
				<td>'.$rowb['grado'].'</td>
				<td>'.$rowb['grupo'].'</td>
			  </tr>';	
	}

	$tabla .='</table>';
	
	echo $tabla;
	}

	
}