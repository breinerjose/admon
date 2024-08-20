<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auxiliar_c extends CI_Controller {

    function __Construct() {
        parent::__construct();
        $this->load->model('sirco/auxiliar_m', 'aux', TRUE);
    }

    function auxiliares() {
        $this->output->set_header('Content-type: application/json');
        $res = $this->aux->auxiliares();
        if ($res != false) {
            $data = array();
            foreach ($res as $row) {
                $fila = array('codaux' => $row['codaux'], 'nomaux' => encodeUtf8($row['nomaux']));
                $data[] = $fila;
            }
            echo json_encode($data);
        } else {
            echo '{"msg":"0"}';
        }
    }
        
    function consultarAuxiliar() {
        $this->output->set_header('Content-type: application/json');
        $resp = $this->Bas_m->consultarf('trim(codaux) as codaux, trim(nomaux) as nombre','cntaux',array('trim(codaux)!='=>'','trim(codaux)'=>$this->input->post('codaux')));
        if ($resp != false) {
            $out = array('err' => '1', 'codaux' => $resp['codaux'], 'nomaux' => encodeUtf8($resp['nombre']));
            echo json_encode($out);
        } else
            echo '{"err":"0","msg":"este auxiliar no existe"}';
    }

}
