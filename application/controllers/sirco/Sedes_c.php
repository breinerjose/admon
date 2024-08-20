<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sedes_c extends CI_Controller {

    function __Construct() {
        parent::__construct();
    }

    function selectsedes() {
        $this->output->set_header('Content-type: application/json');
        $condia = array('cntper.codusu' => $this->session->userdata('codigo'));
        $condib = "cntper.codsed=view_sirco_sedes.codsed AND cntper.modifi='1'";
        $res = $this->Bas_m->consultarb('distinct(view_sirco_sedes.codsed), view_sirco_sedes.nomsed', 'view_sirco_sedes, cntper', $condia, $condib);
        if ($res != false) {
            $data = array();
            $data[] = array('codsed' => '00000', 'nomsed' => 'Todas las Sedes');
            foreach ($res as $row) {
                $data[] = array('codsed' => $row['codsed'], 'nomsed' => encodeUtf8($row['nomsed']));
            }
            echo json_encode($data);
        } else {
            echo '{"msg":"0"}';
        }
    }
    
     function selectsedesdoc() {
        $this->output->set_header('Content-type: application/json');
        $condia = array('cntper.codusu' => $this->session->userdata('codigo'));
        $condib = "cntper.codsed=view_sirco_sedes.codsed AND cntper.modifi='1'";
        $res = $this->Bas_m->consultarb('distinct(view_sirco_sedes.codsed), view_sirco_sedes.nomsed', 'view_sirco_sedes, cntper', $condia, $condib);
        if ($res != false) {
            $data = array();
            foreach ($res as $row) {
                $fila = array('codsed' => $row['codsed'], 'nomsed' => encodeUtf8($row['nomsed']));
                $data[] = $fila;
            }
            echo json_encode($data);
        } else {
            echo '{"msg":"0"}';
        }
    }

}
