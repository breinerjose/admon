 <div class="container">
        <div class="row">
            <div class="col-md-12">

            <div class="panel panel-primary">
                <div class="panel-heading">REGISTRO DE INGRESO</div>
                <div class="panel-body">
    <form id="cabecera" name="cabecera">
	<div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Sede:</label>
					<input type="hidden" id="coddoc" name="coddoc" value="06">
                    <select id="codsed" name="codsed"  data-placeholder="Seleccione Sede" class="chosen-select valid_sele form-control chosen">
                    </select>
                </div>
            </div> 
			
			 <div class="col-md-4">
                <div class="form-group">
                    <label>Fecha:</label>
                    <input type="text" id="fchcmp" name="fchcmp" class="form-control inputb input-sm validate[required]" readonly >
                </div>
            </div>
	</div><!--Final Row	-->
	</form>
	 <div class="divider-dashed"></div>
    <form method="POST" role="form"  id="form_agregar" name="form_agregar" >
	<div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>Tercero:</label>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" id="codtrc" name="codtrc" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#busqueda_ter_alm" ><i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <div class="col-md-5">
                <div class="form-group">
                    <input type="text" id="nomtrc" name="nomtrc" required="required" class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
			<div class="col-md-1">
                <div class="form-group">
                    <input name="doblectd" type="checkbox" id="doblectd" value="1" checked="checked" class="form-control"/>                </div>
            </div>
			<div class="col-md-3">
                <div class="form-group">
                    <label>Contabilizar Doble:</label>
                </div>
            </div>
        </div><!-- /.row -->
		<div class="row">
		<div class="col-md-1">
                <div class="form-group">
                    <label>Alumno:</label>
                </div>
            </div>
		 <div class="col-md-2">
                <div class="form-group">
                    <input type="text" id="codalm" name="codalm" required="required" class="form-control">
                </div><!-- /input-group -->
            </div>
			 <div class="col-md-2">
                <div class="form-group">
                    <input type="text" id="grado" name="grado" required="required" class="form-control">
                </div><!-- /input-group -->
            </div>
			 <div class="col-md-2">
                <div class="form-group">
                    <input type="text" id="grupo" name="grupo" required="required" class="form-control">
                </div><!-- /input-group -->
            </div>
			 <div class="col-md-1">
                <div class="form-group">
                    <input type="text" id="agnakd" name="agnakd" required="required" class="form-control">
                </div><!-- /input-group -->
            </div>
			 <div class="col-md-4">
                <div class="form-group">
                    <input type="text" id="obscmp" name="obscmp" required="required" class="form-control" placeholder="Observaciones">
                </div><!-- /input-group -->
            </div>
		</div><!-- /.row -->
		<div class="row">
		<div class="col-md-1">
                <div class="form-group">
                    <label>Concepto:</label>
                </div>
            </div>
            <div class="col-md-7">
            <div class="form-group">
            <select  data-placeholder="Seleccione" class="chosen-select valid_sele form-control chosen" id="ctaknp" name="ctaknp" >
			</select>
            </div>
            </div>
			
			<div class="col-md-2">
            <div class="form-group">
             <input type="text" id="vlrcta" name="vlrcta" required="required" class="form-control">
            </div>
            </div>
			
			<div class="col-md-2">
            <div class="form-group">
            <button type="button" class="btn btn-success inline" id="agregar1<?php echo $ale; ?>" > Agregar </button>
            </div>
            </div>
			
			</div> <!-- row cierre -->
			
			<div class="row">
		<div class="col-md-1">
                <div class="form-group">
                    <label>Ingresa $:</label>
                </div>
            </div>
            <div class="col-md-7">
            <div class="form-group">
            <select  data-placeholder="Seleccione" class="chosen-select valid_sele form-control chosen" id="ctaknp2" name="ctaknp2" >
			</select>
            </div>
            </div>
			
			<div class="col-md-2">
            <div class="form-group">
             <input type="text" id="vlrcta2" name="vlrcta2" required="required" class="form-control">
            </div>
            </div>
			
			<div class="col-md-2">
            <div class="form-group">
            <button type="button" class="btn btn-success inline" id="agregar2<?php echo $ale; ?>" > Agregar </button>
            </div>
            </div>			
			</div> <!-- row cierre -->
			
			<div class="divider-dashed"></div>
        <div class="row">

            <div class="col-md-1">
                <div class="form-group"></div>
            </div>

            <div class="col-md-1">
                <div class="form-group"><label class="titulo">Debito =></label></div>
            </div>

            <div class="col-md-2">
                <div class="form-group">

                    <div class="form-group">
                        <input name="debito" id="debito" class="form-control input-sm"  type="text" readonly="readonly" >
                    </div>
                </div>
            </div>

            <div class="col-md-1">
                <div class="form-group"><label class="titulo">Credito =></label></div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-group">
                        <input name="credito" id="credito" class="form-control input-sm"  type="text" readonly="readonly" >
                    </div>
                </div>
            </div>

            <div class="col-md-1">
                <div class="form-group"><label class="titulo">Diferencia:</label></div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                        <input name="saldo" id="saldo" class="form-control input-sm"  type="text" readonly="readonly" >
                </div>
            </div>

            <div class="col-md-1" align="center">
                <div class="form-group">
                     <div class="form-group" align="center">
                        <button type="button" class="btn  btn-warning" style="display: none;" id="save<?php echo $ale; ?>" ><i class="fa fa-save"></i>Guardar</button>
                    </div>
                </div>
            </div>
        </div><!-- cierre row -->
	</form>
	
	<div class="x_content" >
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table ogrid table-striped table-bordered dt-responsive nowrap display" id="tabconceptos" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">Cuenta</th>
                        <th width="25%">Concepto</th>
                        <th width="10%">Débito</th>
                        <th width="10%">Crédito</th>
                        <th width="10%">Tercero</th>
                        <th width="10%">Factura</th>
                        <th width="5%">C. Costo</th>
                        <th width="5%">Base</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>  
</div>

	</div>
	</div>
	</div>
	</div>
	</div>
	<script type="text/javascript">
    $(document).ready(function () {
	
	 $("#alm_buscar").focus();

        $('.imgbuscar').click(function () {
            cod_vista = $(this).attr('vista');
            $(cod_vista).modal();
        });
		
		$('#fchcmp').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
		
		
	  var oTable = $('#tabconceptos').dataTable({
            "bPaginate": false,
            "ordering": true,
            "bLengthChange": true,
            "responsive": true,
            "bInfo": true,
            "bFilter": false,
            "ajax": {
                "url": "/sirco/Documento_contable_c/consultarConceptos/",
                "type": "POST",
                "data": {"ale": "<?php echo $ale; ?>"}
            }
        });

        totales();	
		caja();	
		credito();	
		
	$(".chosen").chosen({no_results_text: "Resultado no encontrado!"});
	 documentos();
	 sedes();
	 
	   //enter
        $('#codtrc').keyup(function (event) {
            if (event.which == 13) {
                cargarDatosProvedor($(this).val());
                $( "#vlrcta" ).focus();
            }
        });

        //pierde el focus
        $('#codtrc').on('change', function () {
            cargarDatosProvedor($(this).val());
            $( "#vlrcta" ).focus();
        });
		
		
		$('#vlrcta').keyup(function(event){
			if(event.which == 13 && $('#vlrcta').val() != ''){
		
		codtrc = $('#codtrc').val();
		ctaknp = $('#ctaknp').val();
		vlrcta  = $('#vlrcta').val();
		fecha = $('#fchcmp').val();
		codsed = $('#codsed').val();
		codalm=$('#codalm').val();
		grupo=$('#grupo').val();
		grado=$('#grado').val();
		agnakd=$('#agnakd').val();
		if($('#doblectd').is(':checked')){ ctaknp2 = $('#ctaknp2').val(); vlrcta2=vlrcta;}
			else{ var doblectd = '0'; }
				
		 if(codtrc!='' && ctaknp!='' && vlrcta!=''){
				$.ajax({
							  url:"/sirco/Ingresos_c/agregarConceptos/",
							  data:{'codtrc':codtrc,'ctaknp':ctaknp,'vlrcta':vlrcta,'fecha':fecha,'codsed':codsed,'codalm':codalm,'grado':grado,'grupo':grupo,'agnakd':agnakd},
							  type:"POST",
							  success: function(resp){
								 if(resp==1){
								    if(doblectd != 0){
									///////
									$.ajax({
									  url:"/sirco/Ingresos_c/agregarConceptos2/",
									  data: {'codtrc':codtrc,'ctaknp2':ctaknp2,'vlrcta2':vlrcta2,'fecha':fecha,'codsed':codsed,'codalm':codalm,'grado':grado,'grupo':grupo,'agnakd':agnakd},
									  type:"POST",
									  dataType:"json",
									  success: function(resp){
										 if(resp==1){
											$('#ctaknp').trigger("chosen:updated");
											$('#ctaknp').val(ctaknp);
											$('#ctaknp2').trigger("chosen:updated");
											$('#ctaknp2').val(ctaknp2);
											$('#vlrcta2').val('');
											$('#vlrcta').val('');
											oTable.DataTable().ajax.reload();
											totales();
										}else{
											alert('Error al Insertar Datos revise la Informacion Registrada');
										}
									  }	
									});  
									
									////////
									} 
									else{
									$('#ctaknp').val('');
									$('#ctaknp').trigger("chosen:updated");
									$('#vlrcta').val('');
									oTable.DataTable().ajax.reload();
									totales();}
								}else{
									alert('Error al Insertar Datos.');
								}
							  }	
							});
		 }else{
		  	alert('Campo pendiente por llenar');  
		 }
   
   				$("#codtrc" ).focus();
				$('#codtrc').val('');
				$('#nomtrc').val('');
				
		}   
	});	
   
		$('#agregar1<?php echo $ale; ?>').click(function () {
		codtrc = $('#codtrc').val();
		ctaknp = $('#ctaknp').val();
		vlrcta  = $('#vlrcta').val();
		fecha = $('#fchcmp').val();
		codsed = $('#codsed').val();
		codalm=$('#codalm').val();
		grupo=$('#grupo').val();
		grado=$('#grado').val();
		agnakd=$('#agnakd').val();
		if($('#doblectd').is(':checked')){ ctaknp2 = $('#ctaknp2').val(); vlrcta2=vlrcta;}
			else{ var doblectd = '0'; }
				
		 if(codtrc!='' && ctaknp!='' && vlrcta!=''){
				$.ajax({
							  url:"/sirco/Ingresos_c/agregarConceptos/",
							  data:{'codtrc':codtrc,'ctaknp':ctaknp,'vlrcta':vlrcta,'fecha':fecha,'codsed':codsed,'codalm':codalm,'grado':grado,'grupo':grupo,'agnakd':agnakd},
							  type:"POST",
							  success: function(resp){
								 if(resp==1){
								    if(doblectd != 0){
									///////
									$.ajax({
									  url:"/sirco/Ingresos_c/agregarConceptos2/",
									  data: {'codtrc':codtrc,'ctaknp2':ctaknp2,'vlrcta2':vlrcta2,'fecha':fecha,'codsed':codsed,'codalm':codalm,'grado':grado,'grupo':grupo,'agnakd':agnakd},
									  type:"POST",
									  dataType:"json",
									  success: function(resp){
										 if(resp==1){
											$('#ctaknp').trigger("chosen:updated");
											$('#ctaknp').val(ctaknp);
											$('#ctaknp2').trigger("chosen:updated");
											$('#ctaknp2').val(ctaknp2);
											$('#vlrcta2').val('');
											$('#vlrcta').val('');
											oTable.DataTable().ajax.reload();
											totales();
										}else{
											alert('Error al Insertar Datos revise la Informacion Registrada');
										}
									  }	
									});  
									
									////////
									} 
									else{
									$('#ctaknp').val('');
									$('#ctaknp').trigger("chosen:updated");
									$('#vlrcta').val('');
									oTable.DataTable().ajax.reload();
									totales();}
								}else{
									alert('Error al Insertar Datos.');
								}
							  }	
							});
		 }else{
		  	alert('Campo pendiente por llenar');  
		 }
   });
	
	
		$('#agregar2<?php echo $ale; ?>').click(function () {
  		codtrc = $('#codtrc').val();
		ctaknp2 = $('#ctaknp2').val();
		vlrcta2  = $('#vlrcta2').val();
		fecha = $('#fchemi').val();
		codsed = $('#codsed').val();
		codalm=$('#codalm').val();
		grupo=$('#grupo').val();
		grado=$('#grado').val();
		agnakd=$('#agnakd').val();
		 if(codtrc!='' && ctaknp2!='' && vlrcta2!=''){
						$.ajax({
						  url:"/sirco/Ingresos_c/agregarConceptos2/",
						  data: {'codtrc':codtrc,'ctaknp2':ctaknp2,'vlrcta2':vlrcta2,'fecha':fecha,'codsed':codsed,'codalm':codalm,'grado':grado,'grupo':grupo,'agnakd':agnakd},
						  type:"POST",
						  dataType:"json",
						  success: function(resp){
							 if(resp==1){
								$('#vlrcta2').val('');
								oTable.DataTable().ajax.reload();
								totales();
							}else{
								alert('Error al Insertar Datos');
							}
						  }	
			 			});  
					
				}else{
			alert('Campo pendiente por llenar');	  
		 }
   });
   
	   $(document).on('click', '.borrar<?php echo $ale; ?>', function () {
            var callback = function (resp) {
                new PNotify({
                    title: resp.title,
                    text: resp.msg,
                    type: resp.type,
                    styling: 'bootstrap3'
                });
                if (resp.type == 'success') {
                    oTable.DataTable().ajax.reload();
                }
                totales();
            };
            ajaxGenerico('/sirco/Documento_contable_c/eliminar/', {"oid": $(this).attr('oid')}, callback);
        });
			
			
			$('#save<?php echo $ale; ?>').click(function () {
            var coddoc = $('#coddoc').val();
            if (coddoc != '') {
                var data = $('#cabecera').serialize();
                if ($('#cabecera').validationEngine('validate', {promptPosition: "topLeft", scroll: false})) {
                    var callback = function (resp) {
                        new PNotify({
                            title: resp.title,
                            text: resp.msg,
                            type: resp.type,
                            styling: 'bootstrap3'
                        });
                        if (resp.type == 'success') {
                            oTable.DataTable().ajax.reload();
                            $('#save<?php echo $ale; ?>').css('display', 'none');
                            totales();
                            documentos();
                            $("#form_agregar")[0].reset();
                            $("#cabecera")[0].reset();
                            window.open('/sirco/Imprimir_doc_c/imprime_doc_laser/' + resp.datos, '_blank');
                        }
                    };
                    ajaxGenerico('/sirco/Documento_contable_c/generardoc', data, callback);
                } else {
                    new PNotify({
                        title: 'Concepto',
                        text: 'Falta Llenar Campos Obligatorios',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                }
            } else {
                new PNotify({
                    title: 'Documento Contable',
                    text: 'Por Favor Seleccione el Documento Contable',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        });
		
	    }); <!--Fin Ready-->
		
	function documentos(){
    $.post('/sirco/Cntdoc_c/selectdocumentos', function (resp) {
    $.each(resp, function (i, v) {
    $('#coddoc').append('<option value="' + v.coddoc + '">' + v.coddoc + ' - ' + v.nomdoc + '</option>');
            });
            $('#coddoc').trigger("chosen:updated");
        }, 'json');
    }
	
		function sedes(){
		$.post('/sirco/Sedes_c/selectsedesdoc/', function (resp) {
            $.each(resp, function (i, v) {
                $('#codsed').append('<option value="' + v.codsed + '">' + v.codsed + ' - ' + v.nomsed + '</option>');
            });
            $('#codsed').trigger("chosen:updated");
        }, 'json');
		}
		
		function credito(){
		$.post('/sirco/Ingresos_c/credito/', function (resp) {
           $.each(resp, function (i, v) {
                $('#ctaknp').append('<option value=" ' + v.ctaknp + ' - ' +  v.codknp + ' - ' + v.nomknp + ' ">' + v.ctaknp + ' - ' + v.codknp + ' - ' + v.nomknp + '</option>');
            });
            $('#ctaknp').trigger("chosen:updated");
        }, 'json');
		}
		
		function caja(){
		$.post('/sirco/Ingresos_c/caja/', function (resp) {
            $.each(resp, function (i, v) {
                $('#ctaknp2').append('<option value=" ' + v.ctaknp + ' - ' +  v.codknp + ' - ' + v.nomknp + ' ">' + v.ctaknp + ' - ' + v.codknp + ' - ' + v.nomknp + '</option>');
            });
            $('#ctaknp2').trigger("chosen:updated");
        }, 'json');
		}
		
		
		   function cargarDatosProvedor(codtrc) {
        $.post('/sirco/informe_c/cargarDatosProvedor', {"codtrc": codtrc}, function (ans) {
            if (ans.err == '1') {
                $('#nomtrc').val(ans.nomtrc);
            } else {
                $('#codtrc').val('');
                $('#nomtrc').val('');
            }
        }, 'JSON');
    }
	
	 function totales() {
        $.ajax({
            url: '/sirco/Documento_contable_c/totales',
            type: 'POST',
            dataType: 'JSON',
            data: {},
            success: function (ans) {
                $('#debito').val(ans.a.debito);
                $('#debito').trigger('blur');
                $('#credito').val(ans.a.credito);
                $('#credito').trigger('blur');
                $('#saldo').val(ans.a.saldo);
                $('#saldo').trigger('blur');
                if (ans.a.saldo == 0) {
                    $('#save<?php echo $ale; ?>').css('display', 'inline-block');
                }
                else {
                    $('#save<?php echo $ale; ?>').css('display', 'none');
                }
            }
        });
    }
		
	</script>	
	