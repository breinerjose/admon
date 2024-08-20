<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function crearPdf1($html, $filename = '', $stream = TRUE, $orientacion = 'portrait', $papel = 'letter', $nriper, $pass) {
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $old_limit = ini_set("memory_limit", "320M");
    $dompdf->set_paper($papel, $orientacion);  //tiene que ser horizontal y lo deja en vertical 
    $dompdf->render();
    if ($stream) {
        //$dompdf->stream($filename);
        $dompdf->get_canvas()->get_cpdf()->setEncryption($nriper, $pass, array('print'));
        $dompdf->stream($filename, array('Attachment' => 1));
    } else {
        return $dompdf->output();
    }
}

function crearPdf($html, $filename = '', $stream = TRUE, $orientacion = 'portrait', $papel = 'letter', $attachment = false) {
    require_once("dompdf-0.6.2/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $old_limit = ini_set("memory_limit", "2048M");
    $dompdf->set_paper($papel, $orientacion);  //tiene que ser horizontal y lo deja en vertical 
    $dompdf->set_option('enable_html5_parser', true);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename, array("Attachment" => $attachment));
    } else {
        return $dompdf->output();
    }
}

?>