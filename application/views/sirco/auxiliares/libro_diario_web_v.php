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
<?php }else{?>
*{ margin:0; padding:0;}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family: Arial;
}
.letra, .cuenta, .doslineastr, .titulo, .lineainferior, .libro {letter-spacing: 4px;}
.numero {letter-spacing: 3px;}



<?php } ?>
.doslineastr td{border-top: 2px solid;  border-bottom: 1px solid; font-size:12px;}
.lineafinal td{border-bottom: 2px solid;}
.libro td{ padding:10px; font-size:13px;}
.cuenta td{padding-top: 15px; font-size:10px; }
.letra{font-size:8px;}
.letrafinal{font-size:12px;}
.numero{font-size:9px;}
.titulo{font-size:12px; border-top: 2px solid; }
.lineainferior{font-size:11px; border-bottom: 2px solid; }
</style>
</head>
<body>
<div id="oculto">
 <button id="imprimir"><img src="/res/icons/sirco/print-icon.png"> Imprimir</button> 
</div>
	   <?php echo $detalle; ?> 
</body>
</html>