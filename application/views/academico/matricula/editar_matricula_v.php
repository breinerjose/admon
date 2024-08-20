<?php date_default_timezone_set("America/Bogota"); ?>
<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
<meta charset="utf-8" />
<style>
*{margin:0; padding:0;}
body{font-family: 'Capriola',sans-serif; font-size:13px; font-weight:bold; }
#codcli{   border: 1px solid #CCCCCC;
	margin-left: 40px; 
    font-size: 12px;
    margin-top: 5px;
    padding: 2px;
    width: 100px;}
#nomcli{border: 1px solid #CCCCCC;
	margin-left: 60px; 
    margin-top: 10px;
    padding: 2px;
    width: 340px;}
#codexa{   border: 1px solid #CCCCCC;
	margin-left: 14px; 
    font-size: 12px;
    margin-top: 5px;
    padding: 2px;
    width: 100px;}
#nomexa{   border: 1px solid #CCCCCC;
	margin-left: 63px; 
    font-size: 12px;
    margin-top: 5px;
    padding: 2px;
    width: 340px;}		
#precio{   border: 1px solid #CCCCCC;
	margin-left: 73px; 
    font-size: 12px;
    margin-top: 5px;
    padding: 2px;
    width: 100px;}	
#actualizar:hover{cursor:pointer;}
</style>
<link rel="stylesheet" href="/res/css/bootstrap.min.css">
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#codtrc').val('<?php echo $codtrc; ?>');
		$('#nomtrc').val('<?php echo $nomtrc; ?>');
		$('#codalm').val('<?php echo $codalm; ?>');
		$('#nomalm').val('<?php echo $nomalm; ?>');
		$('#grupo').val('<?php echo $grupo; ?>');
		$('#datoid').val('<?php echo $datoid; ?>');
        $('#agncnt').val('<?php echo $agncnt; ?>');
		
		$('#actualizar').on('click',function(){
			datoid = $('#datoid').val();
			codtrc = $('#codtrc').val();
			codalm = $('#codalm').val();
			grado = $('#grado').val();
			grupo = $('#grupo').val();
			agncnt = $('#agncnt').val();
			tipmat = $('#tipmat').val();
			
			
			if(datoid!=''){
					$.ajax({
						url:'/academico/Matricula_c/edita_matricula',
						type:"POST",
						data:{'datoid':datoid, 'codalm':codalm, 'codtrc':codtrc, 'agncnt':agncnt, 'grado':grado, 'grupo':grupo, 'tipmat':tipmat },
						success: function(resp){
							if(resp==1){
								alert('matricula Editada');
								window.parent.cerrar_editar();
							}else{
								alert('Ocurrio un error o no realiza Cambios, intente más tarde');	
							}
						}	
					});
			}else{
				alert('El campo vencimiento, descripcion y valor no pueden ir vacios');	
			}
		});
		
		
    });
</script>
</head>
<body>
<div class="container">
 <div class="row">
  <div class="col-sm-3">Id Acudiente:</div>
  <div class="col-sm-9"><input type="text" id="codtrc" readonly> <input type="hidden" id="datoid" readonly></div>
</div> 

<div class="row">
  <div class="col-sm-3">Acudiente:</div>
  <div class="col-sm-9"><input type="text" id="nomtrc" size="40" readonly></div>
</div> 

<div class="row">
  <div class="col-sm-3">Id Alumno:</div>
  <div class="col-sm-9"><input type="text" id="codalm" readonly></div>
</div> 

<div class="row">
  <div class="col-sm-3">Alumno:</div>
  <div class="col-sm-9"><input type="text" id="nomalm" size="40" readonly></div>
</div> 

<div class="row">
  <div class="col-sm-3">Año:</div>
  <div class="col-sm-9"><input type="text" id="agncnt" readonly=""></div>
</div>

<div class="row">
  <div class="col-sm-3">Grado:</div>
  <div class="col-sm-9"><select id="grado" name="grado"  data-placeholder="Grado"
                class="chosen-select">
				<option <?php if($gradon=='PREJARDIN') {?> selected="selected" <?php } ?>>PREJARDIN</option>
				<option <?php if($gradon=='JARDIN') {?> selected="selected" <?php } ?>>JARDIN</option>
				<option <?php if($gradon=='TRANSICION') {?> selected="selected" <?php } ?>>TRANSICION</option>
				<option <?php if($gradon=='PRIMERO') {?> selected="selected" <?php } ?>>PRIMERO</option>
				<option <?php if($gradon=='SEGUNDO') {?> selected="selected" <?php } ?>>SEGUNDO</option>
				<option <?php if($gradon=='TERCERO') {?> selected="selected" <?php } ?>>TERCERO</option>
				<option <?php if($gradon=='CUARTO') {?> selected="selected" <?php } ?>>CUARTO</option>
				<option <?php if($gradon=='QUINTO') {?> selected="selected" <?php } ?>>QUINTO</option>
  		 		</select></div>
</div> 

<div class="row">
  <div class="col-sm-3">Grupo:</div>
  <div class="col-sm-9"><input type="text" id="grupo"></div>
</div> 
<div class="row">
  <div class="col-sm-3">Tipo Matricula:</div>
  <div class="col-sm-9"><select id="tipmat" name="tipma"  data-placeholder="tipmat"
                class="chosen-select">
				<option <?php if($tipmatn=='Ordinaria') {?> selected="selected" <?php } ?>>Ordinaria</option>
				<option <?php if($tipmatn=='Extraordinaria') {?> selected="selected" <?php } ?>>Extraordinaria</option>
  		 		</select></div>
</div> 
		<br>
        <p align="center"><button id="actualizar"><img width="20" height="20" src="/res/icons/biblioteca/delet.png"> Guardar</button></p>
    </div>
</div>
</body>
</html>