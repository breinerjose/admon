<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documento_contable_c extends CI_Controller {

    var $usuario;
    var $fecha;
    var $host;

    function __Construct() {
        parent::__construct();
		$this->load->model('sirco/Consecutivos_m','con',TRUE);   
        $this->usuario = $this->session->userdata('codigo');
        $this->fecha = date("Y-m-d H:i:s");
        $this->host = $_SERVER['REMOTE_ADDR'];
    }

    //metodo select
    function selectdocumentos() {
        $this->output->set_header('Content-type: application/json');
        $res = $this->dct->informacionMaestrosdco();
        if ($res != false) {
            $data = array();
            foreach ($res as $row) {
                $fila = array('coddoc' => $row['coddoc'], 'nomdoc' => encodeUtf8($row['nomdoc']));
                $data[] = $fila;
            }
            echo json_encode($data);
        } else {
            echo '{"msg":"0"}';
        }
    }

    //metodo de consulta
    function consultarConceptos() {
        $this->output->set_header('Content-type: application/json');
        $ale = $this->input->post('ale');
        $res = $this->Bas_m->consultar('*', 'cntdcm', array('addusr' => $this->usuario, 'stddcm' => 'Pendiente'));
        //echo $this->db->last_query();
        $output = array("aaData" => array());
        if ($res != false) {
            foreach ($res as $row) {
                $output['aaData'][] = array('<p class="detdcm" campo="codnif" oid="' . $row['codoid'] . '" valor="' . $row['codnif'] . '">' . $row['codnif'] . '</p>',
                    '<p class="detdcm" campo="detdcm" oid="' . $row['codoid'] . '" valor="' . $row['detdcm'] . '">' . $row['detdcm'] . '</p>',
                    '<p class="detdcm" campo="debdcm" oid="' . $row['codoid'] . '" valor="' . $row['debdcm'] . '">' . $row['debdcm'] . '</p>',
                    '<p class="detdcm" campo="credcm" oid="' . $row['codoid'] . '" valor="' . $row['credcm'] . '">' . $row['credcm'] . '</p>',
                    '<p class="detdcm" campo="codtrc" oid="' . $row['codoid'] . '" valor="' . $row['codtrc'] . '">' . $row['codtrc'] . '</p>',
                    '<p class="detdcm" campo="codaux" oid="' . $row['codoid'] . '" valor="' . $row['abnfac'] . '">' . $row['abnfac'] . '</p>',
                    '<p class="detdcm" campo="codcts" oid="' . $row['codoid'] . '" valor="' . $row['codcts'] . '">' . $row['codcts'] . '</p>',
                    '<p class="detdcm" campo="basret" oid="' . $row['codoid'] . '" valor="' . $row['basret'] . '">' . $row['basret'] . '</p>',
                    "<a href='#' title='Borrar' class='btn-sm btn-danger borrar" . $ale . "' oid='" . $row['codoid'] . "'><i class='fa fa-trash'></i></a >");
            }
        }echo json_encode($output);
    }

    function add_debito() {
        $data = array(
            'agncnt' => '2030',
            'mescnt' => '12',
            'stddcm' => 'Pendiente',
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
            'addwst' => $this->host
        );
        $resp = $this->Bas_m->insertar('cntdcm', $data);
        if ($resp != false) {
            echo '{"title" : "Notificación", "type" : "success", "msg" : "Exito al realizar la operación"}';
        } else {
            echo '{"title" : "Notificación", "type" : "error", "msg" : "Ocurrio un error en la operación"}';
        }
    }

    function add_credito() {
        $data = array(
            'agncnt' => '2030',
            'mescnt' => '12',
            'stddcm' => 'Pendiente',
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
            'addwst' => $this->host
        );
        $resp = $this->Bas_m->insertar('cntdcm', $data);
        if ($resp != false) {
            echo '{"title" : "Notificación", "type" : "success", "msg" : "Exito al realizar la operación"}';
        } else {
            echo '{"title" : "Notificación", "type" : "error", "msg" : "Ocurrio un error en la operación"}';
        }
    }

    function actualizarCampo() {
        $this->db->trans_start();
        $condicion = array('codoid' => $this->input->post('oid'));
        $row = $this->Bas_m->consultarf('*', 'cntdcm', $condicion);

        $data = array(
            'abnfac' => $row['abnfac'], 'agncnt' => $row['agncnt'], 'mescnt' => $row['mescnt'], 'coddoc' => $row['coddoc'], 'nrocmp' => $row['nrocmp'], 'stddcm' => 'Editado', 'codcta' => $row['codcta'], 'tiptrc' => $row['tiptrc'], 'codtrc' => $row['codtrc'],
            'codcts' => $row['codcts'], 'detdcm' => $row['detdcm'], 'debdcm' => $row['debdcm'], 'credcm' => $row['credcm'], 'addusr' => $row['addusr'], 'addwst' => $row['addwst'], 'addfch' => $row['addfch'],
            'delusr' => $this->usuario, 'delwst' => $row['delwst'], 'delfch' => date('Y-m-d'), 'nrodcm' => $row['nrodcm'], 'fchdcm' => $row['fchdcm'], 'coditm' => $row['coditm'], 'agnakd' => $row['agnakd'],
            'prdakd' => $row['prdakd'], 'nrocrd' => $row['nrocrd'], 'nrocxc' => $row['nrocxc'], 'tpodud' => $row['tpodud'], 'nriper' => $row['nriper'], 'codbas' => $row['codbas'], 'codaux' => $row['codaux'], 'fchchq' => $row['fchchq'],
            'basret' => $row['basret'], 'codnif' => $row['codnif'], 'codsed' => $row['codsed'], 'addtime' => $row['addtime'], 'addfec' => $row['addfec'], 'deltime' => date('H:i:s'), 'delfec' => date('Y-m-d'),
            'codoid' => $this->input->post('oid'));

        $this->Bas_m->insertar('cntdcm', $data);

        $data = array('addfch' => date('Y-m-d'), 'addtime' => date('H:i:s'), 'addfec' => date('Y-m-d'), 'addusr' => $this->usuario, $this->input->post('campo') => $this->input->post('valor'));
        $resp = $this->Bas_m->actualizar('cntdcm', $data, $condicion);
        if ($resp != false) {
            echo 1;
        } else {
            echo 0;
        }
        $this->db->trans_complete();
    }

    function eliminar() {
        $condicion = array('codoid' => $this->security->xss_clean($this->input->post('oid')));
        $data = array('stddcm' => 'Eliminado', 'delfec' => date('Y-m-d'), 'deltime' => date('H:i:s'), 'delusr' => $this->usuario);
        $resp = $this->Bas_m->actualizar('cntdcm', $data, $condicion);
        if ($resp != false) {
            echo '{"title" : "Notificación", "type" : "success", "msg" : "Exito al realizar la operación"}';
        } else {
            echo '{"title" : "Notificación", "type" : "error", "msg" : "Ocurrio un error en la operación"}';
        }
    }
    
     function totales() {
        $this->output->set_header('Content-type: application/json');
        $condicion = array('addusr' => $this->usuario, 'stddcm' => 'Pendiente');
        $res = $this->Bas_m->consultarf('sum(debdcm) debito, sum(credcm) credito, sum(debdcm-credcm) saldo', 'cntdcm', $condicion);
        $output["a"] = array('debito' => $res['debito'], 'credito' => $res['credito'], 'saldo' => $res['saldo']);
        //echo $this->db->last_query();
        echo json_encode($output);
    }

	function generardoc(){
		$this->db->trans_start(); 
	    $this->output->set_header('Content-type: application/json');
	    $condicion = array('addusr' => $this->usuario, 'stddcm' => 'Pendiente');
        $sld = $this->Bas_m->consultarf('sum(debdcm) debito, sum(credcm) credito, sum(debdcm-credcm) saldo', 'cntdcm', $condicion);
        if($sld['saldo'] != 0){ echo '{"title" : "Notificación", "type" : "error", "msg" : "Documento Descuadrado"}'; exit(); }
		
		$fchcmp = explode('-',trim($this->input->post('fchcmp')));
		$res = $this->Bas_m->consultarf('agncnt','cntprd',array('agncnt' => $fchcmp[0], 'mescnt' => $fchcmp[1],'trim(stdprd)'=>'Abierto'));
		if($res == false){ echo '{"title" : "Notificación", "type" : "error", "msg" : "Periodo Contable Cerrado"}'; exit(); }
		  
		$consectv = $this->con->consecutivo(trim($this->input->post('coddoc')),$fchcmp[1],$fchcmp[0],$this->input->post('codsed'));
		if( $consectv == ''){ echo '{"title" : "Notificación", "type" : "error", "msg" : "Consecutivo No Generado"}'; exit(); }
		
		$datos['nrocmp'] = $consectv;
		$datos['codsed'] = $this->input->post('codsed');  
		$datos['debcmp'] = $sld['debito'];
		$datos['crecmp'] = $sld['credito'];
		$datos['agncnt'] = $fchcmp[0];
		$datos['mescnt'] = $fchcmp[1];
        $datos['coddoc'] = trim($this->input->post('coddoc'));
        $datos['fchcmp'] = $this->input->post('fchcmp'); 
		$datos['obscmp'] = $this->input->post('obscmp');
		$datos['addusr'] = $this->usuario;
		$datos['addfch'] = $this->fecha;
		$datos['addwst'] = $this->host;
		$datos['stdcmp'] = 'Generado';
		
		$res = $this->Bas_m->insertar('cntcmp',$datos);
						
		if($res != false){
			$condi = array('stddcm'=>'Pendiente','addusr'=>$this->usuario);
			$data = array('nrocmp'=>$consectv,'agncnt'=>$fchcmp[0],'mescnt'=>$fchcmp[1], 'stddcm'=>'Generado','codsed'=>$datos['codsed'],'coddoc'=>$datos['coddoc']);
			$resx = $this->Bas_m->actualizar('cntdcm',$data,$condi);
			unset($datos);
			$datos = $consectv.'-'.trim($this->input->post('coddoc')).'-'.$this->input->post('codsed').'-'.$fchcmp[0].'-'.$fchcmp[1];
			if($res != false){  echo '{"title" : "Notificación", "type" : "success", "msg" : "Exito Al Generar Documento", "datos" : "'.$datos.'" }'; }
			else{ echo '{"title" : "Notificación", "type" : "error", "msg" : "Problema al Generar Detalle"}'; }
			}else{
				 echo '{"title" : "Notificación", "type" : "error", "msg" : "Problema al Generar Cabecera"}';
			}	
	 $this->db->trans_complete();		
		}
                
                //revertir datos
	function revertirInformacion(){
           $this->db->trans_start(); 
	   $this->output->set_header('Content-type: application/json');
           $codigos = explode('-',$this->input->post('codigo'));
	   $datos = array('stdcmp'=>'Revertido','delusr'=>$this->usuario,'delwst'=>$this->host,'delfch'=>$this->fecha);
           $datos2 = array('stddcm'=>'Revertido','delusr'=>$this->usuario,'delwst'=>$this->host,'delfch'=>$this->fecha);  
	   $condicion = array('trim(stdcmp)'=>'Generado','nrocmp'=>$codigos[0],'coddoc'=>$codigos[1],'codsed'=>$codigos[2],'agncnt'=>$codigos[3],'mescnt'=>$codigos[4]);
	   $condicion2 = array('trim(stddcm)'=>'Generado','nrocmp'=>$codigos[0],'coddoc'=>$codigos[1],'codsed'=>$codigos[2],'agncnt'=>$codigos[3],'mescnt'=>$codigos[4]);
	   $resp = $this->Bas_m->actualizar('cntcmp',$datos,$condicion);
	   $res = $this->Bas_m->actualizar('cntdcm',$datos2,$condicion2);
           if($res != false){  echo '{"title" : "Notificación", "type" : "success", "msg" : "Exito Al Revertir Documento", "tpo":"1" }'; }
			else{ echo '{"title" : "Notificación", "type" : "error", "msg" : "Problema Al Revertir Documento", "tpo":"0"}'; }
	  $this->db->trans_complete();	
	}
		
}
