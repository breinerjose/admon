<script type="text/javascript">
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
$("#grado,#grupo,#tipmat").chosen({no_results_text: "Resultado no encontrado!",allow_single_deselect: true});
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
        $('#codtrcb').val($(this).attr('data-codtrc'));
		$('#nomtrc').val($(this).attr('data-nomtrc'));
		$('#codalmb').val($(this).attr('data-codalm'));
		$('#nomalm').val($(this).attr('data-nomalm'));
		$('#datoid').val($(this).attr('data-datoid'));
        $('#agncnt').val($(this).attr('data-agncnt'));      
		$('#div-inicial').css('display', 'none');
        $('#div-eliminar').css('display', 'block');
		$('#btn_eli').css('display', 'inline-block');
        $('#btn_edi').css('display', 'none');
		$("#gradob,#grupob,#tipmatb").chosen({no_results_text: "Resultado no encontrado!"});
		$('#gradob').val($(this).attr('data-grado')).trigger('chosen:updated');
		$('#grupob').val($(this).attr('data-grupo')).trigger('chosen:updated');
	});
//Fin Eliminar	
//Inicio Editar
$('#tabla').on('click','.editar',function(){
	    $('#codtrcb').val($(this).attr('data-codtrc'));
		$('#nomtrc').val($(this).attr('data-nomtrc'));
		$('#codalmb').val($(this).attr('data-codalm'));
		$('#nomalm').val($(this).attr('data-nomalm'));
		$('#datoid').val($(this).attr('data-datoid'));
        $('#agncnt').val($(this).attr('data-agncnt'));      
		$('#div-inicial').css('display', 'none');
        $('#div-eliminar').css('display', 'block');
		$('#btn_eli').css('display', 'none');
        $('#btn_edi').css('display', 'inline-block');
		$("#gradob,#grupob,#tipmatb").chosen({no_results_text: "Resultado no encontrado!"});
		$('#gradob').val($(this).attr('data-grado')).trigger('chosen:updated');
		$('#grupob').val($(this).attr('data-grupo')).trigger('chosen:updated');
	});
//Fin Editar
  $('#btn_eli').click(function () {
			datoid = $('#datoid').val();
			codtrc = $('#codtrcb').val();
			codalm = $('#codalmb').val();
			grado = $('#gradob').val();
			grupo = $('#grupob').val();
			agncnt = $('#agncnt').val();		
			
			if(datoid!=''){
					$.ajax({
						url:'/academico/Matricula_c/elimina_matricula',
						type:"POST",
						data:{'datoid':datoid, 'codalm':codalm, 'codtrc':codtrc, 'agncnt':agncnt, 'grado':grado, 'grupo':grupo},
						success: function(resp){
							if(resp==1){
								toastr.success('matricula Eliminada');
								 $('#div-inicial').css('display', 'block');
								 $('#div-eliminar').css('display', 'none');
								 dtl();
							}else{
								toastr.error('Ocurrio un error o no realiza Cambios, intente más tarde');	
							}
						}	
					});
			}else{
				toastr.error('El campo vencimiento, descripcion y valor no pueden ir vacios');	
			}
		});
		
		$('#btn_edi').on('click',function(){
			datoid = $('#datoid').val();
			codtrc = $('#codtrcb').val();
			codalm = $('#codalmb').val();
			grado = $('#gradob').val();
			grupo = $('#grupob').val();
			agncnt = $('#agncnt').val();
			tipmat = $('#tipmatb').val();
				
			if(datoid!=''){
					$.ajax({
						url:'/academico/Matricula_c/edita_matricula',
						type:"POST",
						data:{'datoid':datoid, 'codalm':codalm, 'codtrc':codtrc, 'agncnt':agncnt, 'grado':grado, 'grupo':grupo, 'tipmat':tipmat },
						success: function(resp){
							if(resp==1){
								toastr.success('matricula Editada');
								 $('#div-inicial').css('display', 'block');
           						 $('#div-eliminar').css('display', 'none');
								dtl();
							}else{
								toastr.error('Ocurrio un error o no realiza Cambios, intente más tarde');	
							}
						}	
					});
			}else{
				alert('El campo vencimiento, descripcion y valor no pueden ir vacios');	
			}
		});
		

        $('#btn_cance').click(function () {
            $('#div-inicial').css('display', 'block');
            $('#div-eliminar').css('display', 'none');
			dtl();
        });
				
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

<div class="container" id="div-inicial" style="display: block;">
<div class="row">
<div class="col-md-12">
<form class="form-horizontal" id="agregar" name="agregar" method="post">
<br>
<div class="form-group">
<label class="control-label col-md-1 col-sm-1 col-xs-12">Acudiente</label>
<div class="item col-md-5 col-sm-5 col-xs-12">
<select id="codtrc" name="codtrc"  data-placeholder="Seleccione Acudiente" style="width:400px;" class="chosen-select">
				<option value=""></option>
	 		</select>
</div>
<label class="control-label col-md-1 col-sm-1 col-xs-12">Grado</label>
<div class="item col-md-2 col-sm-2 col-xs-12">
<select id="grado" name="grado"  data-placeholder="Grado" class="chosen-select">
				<option selected="selected"></option>
				<option>PREJARDIN</option>
				<option>JARDIN</option>
				<option>TRANSICION</option>
				<option>PRIMERO</option>
				<option>SEGUNDO</option>
				<option>TERCERO</option>
				<option>CUARTO</option>
				<option>QUINTO</option>
  		 		</select>
				
</div>
<label class="control-label col-md-1 col-sm-1 col-xs-12">Grupo</label>
<div class="item col-md-2 col-sm-2 col-xs-12">
<select id="grupo" name="grupo"  data-placeholder="Grado"
                class="chosen-select">
				<option selected="selected"></option>
				<option>A</option>
				<option>B</option>
  		 		</select>
				
</div>
</div>
<div class="form-group">
<label class="control-label col-md-1 col-sm-1 col-xs-12">Alumno</label>
<div class="item col-md-5 col-sm-5 col-xs-12">
<select id="codalm" name="codalm"  data-placeholder="Seleccione Alumno" style="width:400px;" 
                class="chosen-select"><option value=""></option>
  		 		</select>
</div>
<label class="control-label col-md-1 col-sm-1 col-xs-12">AÃ±o</label>
<div class="item col-md-2 col-sm-2 col-xs-12">
<input name="periodo" type="text" class="form-control" id="periodo" value="<?php
		$this->db->select('max(agnakd) as agnakd');
		$this->db->from('matfin');
		$resp = $this->db->get();
		$resp = $resp->row_array();
		echo $resp['agnakd'];

 ?>" maxlength="4">
</div>
<label class="control-label col-md-1 col-sm-1 col-xs-12">Matricula</label>
<div class="item col-md-2 col-sm-2 col-xs-12">
<select id="tipmat" name="tipmat"  data-placeholder="tipmat"
                class="chosen-select">
				<option>Ordinaria</option>
				<option>Extraordinaria</option>
  		 		</select>
</div>
</div>	 	
						  
	<hr>
   <center><a href="#" class="agregar">Registrar</a></center>
    </p>
</form>
</div>
</div>

<table id="tabla" cellpadding="0" cellspacing="0" class="display" width="100%">
<thead>
<tr>
<th width="9%">Id</th>
<th width="23%">Acudiente</th>
<th width="9%">Id</th>
<th width="23%">Alumno</th>
<th width="10%">Grado</th>
<th width="4%">Gru</th>
<th width="5%">AÃ±o</th>
<th width="3%">Borrar</th>
<th width="5%">Editar</th>
<th width="5%">Extr</th>
</tr>
</thead> 
<tbody>
</tbody>
</table>
</div>

<div class="container" id="div-eliminar" style="display: none;">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">Id Acudiente:</div>
                    <div class="col-sm-9"><input type="text" id="codtrcb" readonly> <input type="hidden" id="datoid" readonly></div>
                </div> 

                <div class="row">
                    <div class="col-sm-3">Acudiente:</div>
                    <div class="col-sm-9"><input type="text" id="nomtrc" size="40" readonly></div>
                </div> 

                <div class="row">
                    <div class="col-sm-3">Id Alumno:</div>
                    <div class="col-sm-9"><input type="text" id="codalmb" readonly></div>
                </div> 

                <div class="row">
                    <div class="col-sm-3">Alumno:</div>
                    <div class="col-sm-9"><input type="text" id="nomalm" size="40" readonly></div>
                </div> 

                <div class="row">
                    <div class="col-sm-3">AÃ±o:</div>
                    <div class="col-sm-9"><input type="text" id="agncnt" readonly="" ></div>
                </div>

                <div class="row">
                    <div class="col-sm-3">Grado:</div>
                    <div class="col-sm-9"><select id="gradob" name="gradob" class="chosen-select" data-placeholder="Seleccione Grado" style="width:300px;">
    									   		<option>PREJARDIN</option>
												<option>JARDIN</option>
												<option>TRANSICION</option>
												<option>PRIMERO</option>
												<option>SEGUNDO</option>
												<option>TERCERO</option>
												<option>CUARTO</option>
												<option>QUINTO</option>
            							</select>
					</div>
                	</div> 

                <div class="row">
                    <div class="col-sm-3">Grupo:</div>
                    <div class="col-sm-9"> 
					<select id="grupob" name="grupob" data-placeholder="Seleccione Grupo" style="width:300px;" class="chosen-select">
	   					<option>A</option>
						<option>B</option>
	   				</select>
				</div>
                </div> 
				
                <br>
                <div class="row">
            	<div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                    <button type="button" class="btn btn-danger" id="btn_eli" style="display: none;"> <i class="fa fa-trash"></i> Eliminar</button>
                    <button type="button" class="btn btn-warning" id="btn_edi" style="display: none;"><i class="fa fa-pencil"></i> Editar Datos</button> 
                    <button type="button" class="btn btn-primary" id="btn_cance"><i class="fa fa-times"></i>Cancelar</button>
                </div>
                </div>
        	    </div>
            </div>                                      
        </div>
    </div>
</div>    