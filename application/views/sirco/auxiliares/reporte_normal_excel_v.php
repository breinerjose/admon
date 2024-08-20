<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Auxiliares.xls"');
header('Cache-Control: max-age=0');
?>
<style type="text/css">
*{ margin:0; padding:0;}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family: Helvetica, Arial, Sans-Serif;
}
.letra, .cuenta, .doslineastr, .lineafinal, .titulo, .nit {letter-spacing: 6px;}
.numero {letter-spacing: 3px;}
.letra{font-size:12px;}
.finalsaldo td{padding-top: 7px; font-size:11px; }
#contenido{margin-left: 10px;  margin-top: 10px;  width: 100%;}
#cabecera{border-top: 1px solid;  border-bottom: 1px solid;  padding-top: 5px;}
#cabecera{font-size: 15px;}
#cabecera p{font-size: 13px; line-height: 20px;}
#cabecerados{ border-bottom: 1px solid;  padding-top: 5px;}
#cabecerados p .uno{font-size: 12px;}
.doslineastr td{border-top: 1px solid;  border-bottom: 1px solid; }
.lineafinal td{border-bottom: 1px solid; }
.cuenta td{padding-top: 15px; font-size:12px; }
.titulo{font-size:15px; border-top: 1px solid; }
.nit{font-size:12px; border-bottom: 1px solid; }
</style>
</head>
<body> 
	   <div id="detalle" style="font-size: 11px;">
	   <?php echo $detalle; ?> 
 	   </div>    
</body>
</html>