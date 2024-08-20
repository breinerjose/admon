<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="estado_financiero.xls"');
header('Cache-Control: max-age=0');
?>
<style>
*{ margin:0; padding:0; }
body{ font-family:Arial, Helvetica, sans-serif; }
.doslineastr td{border-top: 1px solid;  border-bottom: 1px solid; font-size:13px;}
.lineafinal td{border-bottom: 1px solid; padding-bottom:10px; font-size:13px;  padding-bottom:10px;}
.libro td{ padding:10px; font-size:13px;}
.cuenta td{padding-top: 15px; font-size:13px; }
.letra .numero{font-size:13px;}
.titulo{font-size:15px; border-top: 1px solid; }
.lineainferior{font-size:13px; border-bottom: 1px solid; }
</style>
</head>
<body>
	   <?php echo $detalle; ?> 
</body>
</html>