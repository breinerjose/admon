<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="excel_doc_contable.xls"');
header('Cache-Control: max-age=0');
echo $detalle; ?>  