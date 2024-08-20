<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>RESUMEN_DE_DOCUMENTOS</title>
<script type="text/javascript" src="/res/vendors/jquery/dist/jquery.js"></script>
<script>
$(document).ready(function() {
    $('#tabla_reporte').on('click','.reimprimir',function(e){
		e.preventDefault();
		id = $(this).attr('id');
		window.open('/sirco/imprimir_doc_c/imprime_doc_laser/'+id, "_blank", 'toolbar=yes, scrollbars=yes, resizable=yes,top=100, left=100,  width=965, height=480');
		
	});
});
</script>
</head>

<body>

<table width="905" cellpadding="0" cellspacing="0"style="font-size:12px;" id="tabla_reporte">
  <tr>
    <td colspan="6" style="border-top:1px solid"><?php echo $cabecera['nomcia']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><?php echo $cabecera['dircia']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><?php echo $cabecera['telcia']; ?></td>
  </tr>
  <tr>
    <td colspan="6" style="border-bottom:1px solid"><?php echo $cabecera['nitcia']; ?></td>
  </tr>
  <tr>
    <td colspan="6" style="padding-top:4px; padding-bottom:4px;">DESDE <?php echo $fecha1; ?> HASTA <?php echo $fecha2; ?></td>
  </tr>
  <tr>
    <td colspan="6" style="border-bottom:1px solid; padding-bottom:4px;">SEDE: <?php echo $sede_v; ?> </td>
  </tr>
  
  <?php echo $cuerpo; ?>
</table>

</body>
</html>