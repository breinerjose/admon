<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar Usuario</title>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<link rel="stylesheet" href="/res/css/bootstrap.min.css">
<link rel="stylesheet" href="/res/chosen/chosen.css" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_page.css"/>
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_table.css"/>
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/res/js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/res/js/validation/dist/jquery.validate.min.js"></script>
<script type="application/javascript" src="/res/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
jQuery.validator.messages.required = "";jQuery.validator.messages.digits = "";

function dtl(){
		oTable = $('#tabla').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"sScrollY" : '320px',
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/academico/Matricula_c/matriculas/",
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}	
	
	function cerrar_editar(){
		$('#editar').dialog('close');
		dtl();	
	}

$(document).ready(function(){
dtl();
<!--Inicio-->
$("#codtrc").chosen({no_results_text: "Resultado no encontrado!",allow_single_deselect: true});
		$.post('/academico/Matricula_c/terceros',function(resp){
		$.each(resp,function(i,v){
			$('#codtrc').append('<option value="'+v.codtrc+'">'+v.codtrc+' - '+v.nomtrc+'</option>');
		});	$('#codtrc').trigger("chosen:updated");
	},'json');
<!--Fin-->

<!--Inicio-->
$("#codalm").chosen({no_results_text: "Resultado no encontrado!",allow_single_deselect: true});
		$.post('/academico/Matricula_c/terceros',function(resp){
		$.each(resp,function(i,v){
			$('#codalm').append('<option value="'+v.codtrc+'">'+v.codtrc+' - '+v.nomtrc+'</option>');
		});	$('#codalm').trigger("chosen:updated");
	},'json');
<!--Fin-->

<!--Inicio Guardar-->
$( ".agregar" ).button({
		icons:{primary:"ui-icon-disk"}
		}).on('click',function(){
		 if($("#agregar").validate().form()){
			 $.ajax({
				      url:"/academico/Matricula_c/agregarmatricula",
					  data: $('form#agregar').serialize(),
					  type:"POST",
					  dataType:"json",
					  success: function(resp){
						 if(resp=='1'){
							alert('Registro Exitoso');
							//setTimeout(function(){ $('#agregar').get(0).reset();}, 900);
							dtl();	
						}else{
							alert('Error al Insectar Datos');
						}
					  }	
			 });
		 }else{
			alert('Campos Pendientes por llenar');	
		 }
		});
<!--Fin Guardar-->	
//Inicio Eliminar
$('#tabla').on('click','.eliminar',function(){
		 datoid = $(this).attr('data-datoid');
		 codtrc = $(this).attr('data-codtrc');
		 nomtrc = $(this).attr('data-nomtrc');
		 codalm = $(this).attr('data-codalm');
		 nomalm = $(this).attr('data-nomalm');
		 grado = $(this).attr('data-grado');
		 grupo = $(this).attr('data-grupo');
		 agncnt = $(this).attr('data-agncnt');
		$('<iframe id="editar" frameborder="0" />').attr('src','/academico/Matricula_c/eliminar_matricula/'+datoid+'/'+codtrc+'/'+nomtrc+'/'+codalm+'/'+nomalm+'/'+grado
		+'/'+grupo+'/'+agncnt).dialog({
					resizable:false, 
					modal: true,
					width:850, 
					height:300, 
					position:['middle',100],
					title: 'Eliminar Matricula',
					close : function(v, ui){							
						$(this).remove();
					}
		}).width(850-10).height(300-20);	
	});
//Fin Eliminar	
//Inicio Editar
$('#tabla').on('click','.editar',function(){
		 datoid = $(this).attr('data-datoid');
		 codtrc = $(this).attr('data-codtrc');
		 nomtrc = $(this).attr('data-nomtrc');
		 codalm = $(this).attr('data-codalm');
		 nomalm = $(this).attr('data-nomalm');
		 grado = $(this).attr('data-grado');
		 grupo = $(this).attr('data-grupo');
		 agncnt = $(this).attr('data-agncnt');
		 tipmat = $(this).attr('data-tipmat');
		$('<iframe id="editar" frameborder="0" />').attr('src','/academico/Matricula_c/editar_matricula/'+datoid+'/'+codtrc+'/'+nomtrc+'/'+codalm+'/'+nomalm+'/'+grado
		+'/'+grupo+'/'+agncnt+'/'+tipmat).dialog({
					resizable:false, 
					modal: true,
					width:850, 
					height:300, 
					position:['middle',100],
					title: 'Eliminar Matricula',
					close : function(v, ui){							
						$(this).remove();
					}
		}).width(850-10).height(300-20);	
	});
//Fin Editar
//Inicio Extracto
$('#tabla').on('click','.extracto',function(){
		 codalm = $(this).attr('data-codalm');
		 grado = $(this).attr('data-grado');
		 grupo = $(this).attr('data-grupo');
		 agncnt = $(this).attr('data-agncnt');
		 window.open('/sirco/Imprimir_doc_c/extracto/'+codalm+'/'+agncnt+'/'+grado+'/'+grupo);
	
	});
//Fin Extracto
});

</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<form class="form-horizontal" id="agregar" name="agregar" method="post">
<br>
<div class="form-group">
<label class="control-label col-md-1 col-sm-1 col-xs-12">Acudiente Actual </label>
<div class="item col-md-5 col-sm-5 col-xs-12">
<select id="codtrc" name="codtrc"  data-placeholder="Seleccione Acudiente" style="width:400px;" 
                class="chosen-select"><option value=""></option>
	 		</select>
</div>


<div class="form-group">
<label class="control-label col-md-1 col-sm-1 col-xs-12">Alumno</label>
<div class="item col-md-5 col-sm-5 col-xs-12">
<select id="codalm" name="codalm"  data-placeholder="Seleccione Alumno" style="width:400px;" 
                class="chosen-select"><option value=""></option>
	 		</select>
</div>
<label class="control-label col-md-1 col-sm-1 col-xs-12">Año</label>
<div class="item col-md-2 col-sm-2 col-xs-12">
<input name="periodo" type="text" class="form-control" id="periodo" value="2019" maxlength="4">
</div>
<label class="control-label col-md-1 col-sm-1 col-xs-12"></label>
<div class="item col-md-2 col-sm-2 col-xs-12"></div>
</div>	 	
						  
	<hr>
   <center>
     <a href="#" class="agregar">Cambiar</a>
   </center>
    </p>
</form>
</div>
</div>
</div>
</body>
</html>