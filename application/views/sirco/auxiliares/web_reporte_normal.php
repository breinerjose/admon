<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<script src="/res/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#imprimir').click(function(e){
	oculto.style.visibility = 'hidden'; 
	window.print(); 
	window.close();  
});
});
</script>
<style>
<?php if($tipimp == 'laser'){?>
*{ margin:0; padding:0; }
body{ font-family:Arial, Helvetica, sans-serif; }
.letra, .numero{font-size:10px;}
<?php }else{?>
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
<?php } ?>
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
<div id="oculto">
 <button id="imprimir"><img src="/res/icons/sirco/print-icon.png"> Imprimir</button> 
</div>
	   <div id="detalle" style="font-size: 11px;">
	   <?php echo $detalle; ?> 
 	   </div>    
</body>
</html>