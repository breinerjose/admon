<?php

error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facturas_c extends CI_Controller {

    function __Construct() {
        parent::__construct();
        $this->load->model('Basico_m', 'bas', TRUE);
    }

    function Listado_Cartera() {
        $this->output->set_header('Content-type:application/json');
        $ale = $this->security->xss_clean($this->input->post('ale'));
        $condi['saldo >'] = 0;
        if ($this->security->xss_clean($this->input->post('codtrc')) != 0) {
            $condi['codtrc'] = $this->security->xss_clean($this->input->post('codtrc'));
        }
        $resp = $this->bas->consultar('*', 'view_cartera', $condi);
        //echo $this->db->last_query();
        if ($resp != false) {
            foreach ($resp as $row) {

                $output['aaData'][] = array(
                    $row['codtrc'], $row['nomtrc'], $row['nrocmp'], $row['venqts'], $row['dias'], $row['total'], $row['abonos'], $row['saldo']);
            }
        }
        echo json_encode($output);
    }

    
    function facturas_doc(){
       $this->output->set_header('Content-type:application/json');
        $condi['saldo >'] = 0;
        if ($this->security->xss_clean($this->input->post('codtrc')) != 0) {
            $condi['codtrc'] = $this->security->xss_clean($this->input->post('codtrc'));
        }
        $resp = $this->bas->consultar('*', 'view_cartera', $condi);
        //echo $this->db->last_query();
        if ($resp != false) {
            foreach ($resp as $row) {

                $data[] = array(
                   'nrocmp'=>$row['nrocmp'], 'venqts'=>$row['venqts'], 'dias'=>$row['dias'], 'total'=>$row['total'], 'abonos'=>$row['abonos'], 'saldo'=>$row['saldo']);
            }
        }
       echo json_encode($data);
        
    }
}
