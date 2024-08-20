<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Doc_contable_editar_c extends CI_Controller {
	
	var $usuario;
    var $fecha;
    var $host;
	 
	function __Construct(){
	   parent::__construct();
	   $this->usuario = $this->session->userdata('codigo');
       $this->fecha = date("Y-m-d H:i:s");
	   $this->host = $_SERVER['REMOTE_ADDR']; 
	   
	}
		
	//metodo de consulta
  function consultarConceptos(){
    $this->output->set_header('Content-type: application/json');
	$condicion=array('nrocmp'=>'1');
	$nrodoc = $this->input->post('nrodoc');
	if ($nrodoc != '') { $data = explode("-",$nrodoc); //000001-05-001-2019-01
	$condicion = array('agncnt' => $data['3'], 'coddoc'=>$data['1'], 'codsed'=> $data['2'], 'nrocmp'=>$data['0'], 'mescnt' => $data['4'], 'stddcm'=>'Generado'); }
	
        $ale = $this->input->post('ale');
        $res = $this->Bas_m->consultar('codoid as oid, *','cntdcm',$condicion);
        //echo $this->db->last_query();
        $output = array("aaData" => array());
        if ($res != false) {
            foreach ($res as $row) {
                $output['aaData'][] = array('<p class="detdcm" campo="codcta" oid="' . $row['oid'] . '" valor="' . $row['codcta'] . '">' . $row['codcta'] . '</p>',
                    '<p class="detdcm" campo="detdcm" oid="' . $row['oid'] . '" valor="' . $row['detdcm'] . '">' . $row['detdcm'] . '</p>',
                    '<p class="detdcm" campo="debdcm" oid="' . $row['oid'] . '" valor="' . $row['debdcm'] . '">' . $row['debdcm'] . '</p>',
                    '<p class="detdcm" campo="credcm" oid="' . $row['oid'] . '" valor="' . $row['credcm'] . '">' . $row['credcm'] . '</p>',
                    '<p class="detdcm" campo="codtrc" oid="' . $row['oid'] . '" valor="' . $row['codtrc'] . '">' . $row['codtrc'] . '</p>',
                    '<p class="detdcm" campo="abnfac" oid="' . $row['oid'] . '" valor="' . $row['abnfac'] . '">' . $row['abnfac'] . '</p>',
                    '<p class="detdcm" campo="codcts" oid="' . $row['oid'] . '" valor="' . $row['codcts'] . '">' . $row['codcts'] . '</p>',
                    '<p class="detdcm" campo="basret" oid="' . $row['oid'] . '" valor="' . $row['basret'] . '">' . $row['basret'] . '</p>',
                    '<p class="detdcm" campo="codnif" oid="' . $row['oid'] . '" valor="' . $row['codnif'] . '">' . $row['codnif'] . '</p>',
                    "<a href='#' title='Borrar' class='btn-sm btn-danger borrar" . $ale . "' oid='" . $row['oid'] . "'><i class='fa fa-trash'></i></a >");
            }
        }echo json_encode($output);
  }
  
   function totales(){
        $this->output->set_header('Content-type: application/json');
        $condicion=array('nrocmp'=>'1');
	    $nrodoc = $this->input->post('nrodoc');
	   if ($nrodoc != '') { $data = explode("-",$nrodoc); //000001-05-001-2019-01
	    $condicion = array('agncnt' => $data['3'], 'coddoc'=>$data['1'], 'codsed'=> $data['2'], 'nrocmp'=>$data['0'], 'mescnt' => $data['4'], 'stddcm'=>'Generado'); }
        $res = $this->Bas_m->consultarf('sum(debdcm) debito, sum(credcm) credito, sum(debdcm-credcm) saldo', 'cntdcm', $condicion);
        $output["a"] = array('debito' => $res['debito'], 'credito' => $res['credito'], 'saldo' => $res['saldo']);
        //echo $this->db->last_query();
        echo json_encode($output);
    }
	
	    function add_debito() {
		$nrodoc = $this->input->post('nrodoc');
	    if ($nrodoc != '') { $data = explode("-",$nrodoc); //000001-05-001-2019-01
        $data = array(
            'agncnt' => $data['3'],
            'mescnt' => $data['4'], 
            'codcta' => $this->input->post('codcta'),
            'codnif' => $this->input->post('codnif'),
            'detdcm' => $this->input->post('detdcm'),
            'credcm' => 0,
            'debdcm' => $this->input->post('valor'),
            'codtrc' => $this->input->post('codtrc'),
            'codaux' => $this->input->post('codaux'),
            'codcts' => $this->input->post('codcts'),
            'basret' => ($this->input->post('basret') != '') ? $this->input->post('basret') : 0,
            'coditm' => $this->input->post('coditm'),
            'abnfac' => $this->input->post('abnfac'),
            'addusr' => $this->usuario,
            'addfch' => $this->fecha,
            'addwst' => $this->host,
			'coddoc' => $data['1'],
			'codsed' => $data['2'],
			'nrocmp' => $data['0'], 
			'stddcm'=>'Generado'
        );
        $resp = $this->Bas_m->insertar('cntdcm', $data);
		}
        if ($resp != false) {
            echo '{"title" : "Notificación", "type" : "success", "msg" : "Exito al realizar la operación"}';
        } else {
            echo '{"title" : "Notificación", "type" : "error", "msg" : "Ocurrio un error en la operación"}';
        }
    }

    function add_credito() {
	$nrodoc = $this->input->post('nrodoc');
	    if ($nrodoc != '') { $data = explode("-",$nrodoc); //000001-05-001-2019-01
        $data = array(
            'agncnt' => $data['3'],
            'mescnt' => $data['4'], 
            'codcta' => $this->input->post('codcta'),
            'codnif' => $this->input->post('codnif'),
            'detdcm' => $this->input->post('detdcm'),
            'credcm' => $this->input->post('valor'),
            'debdcm' => 0,
            'codtrc' => $this->input->post('codtrc'),
            'codaux' => $this->input->post('codaux'),
            'codcts' => $this->input->post('codcts'),
            'basret' => ($this->input->post('basret') != '') ? $this->input->post('basret') : 0,
            'coditm' => $this->input->post('coditm'),
            'abnfac' => $this->input->post('abnfac'),
            'addusr' => $this->usuario,
            'addfch' => $this->fecha,
            'addwst' => $this->host,
			'coddoc' => $data['1'],
			'codsed' => $data['2'],
			'nrocmp' => $data['0'], 
			'stddcm'=>'Generado'
        );
        $resp = $this->Bas_m->insertar('cntdcm', $data);
		}
        if ($resp != false) {
            echo '{"title" : "Notificación", "type" : "success", "msg" : "Exito al realizar la operación"}';
        } else {
            echo '{"title" : "Notificación", "type" : "error", "msg" : "Ocurrio un error en la operación"}';
        }
    }
	
	
}