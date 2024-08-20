<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cntdoc_c extends CI_Controller {

    var $usuario;
    var $fecha;
    var $host;

    function __Construct() {
        parent::__construct();
        $this->usuario = $this->session->userdata('codigo');
        $this->fecha = date("Y-m-d h:i:s A");
        $this->host = $_SERVER['REMOTE_ADDR'];
    }

    //metodo select
    function selectdocumentos() {
        $this->output->set_header('Content-type: application/json');
        $res = $this->Bas_m->consultar_orden('trim(coddoc) as coddoc, trim(nomdoc) as nomdoc, nrodoc','cntdoc',array('trim(coddoc)!='=>''),'coddoc');
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

}
