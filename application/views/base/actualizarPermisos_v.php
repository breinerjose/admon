	<div class="table-responsive">
			<table class="table table-bordered table-striped dt-responsive " id="listado_historias">
				 <thead>
					<tr>
						<th width="15%">id-</th>
            			<th width="30%">Nombres Y Apellidos</th>
            			<th width="20%">Correo</th>
            			<th width="13%">Estado</th>
            			<th width="10%">Acciones</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
	</table>
	 <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input name="codusr" type="text" class="form-control" id="codusr" value="" readonly="readonly">
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="nomusr" type="text" class="form-control" id="nomusr" readonly="readonly">
                        </div>
                      </div>
	<table class="table table-bordered table-striped dt-responsive " id="permisos">
				 <thead>
					<tr>
						<th width="15%">Codigo</th>
                		<th width="40%">Descripción</th>
                		<th width="30%">Aplicación</th>
                		<th width="15%">Accion</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
	</table>
<script type="text/javascript">
	$(document).ready(function(){
			CargarUsuarios();
			$(document).on('click','.per<?php echo $ale; ?>',function(){
			var codigo=$(this).attr('data-ide');
			var nomusr=$(this).attr('data-nom');
			$('#codusr').val(codigo);	
			$('#nomusr').val(nomusr);
			permisos(codigo);				
		});
		
		$(document).on('click','.des<?php echo $ale; ?>',function(){
			var codigo=$(this).attr('data-ide');
			$.ajax({
                                url:'/base/Usuario_c/desactivar_usuario',
                                type:'POST',
                                dataType:'JSON',
                                data:{"codigo":codigo},
                                success:function(ans){
                                    if(ans.err=='1'){
                                       toastr.success('Usuario Desactivado Satisfactoriamente');                                
                                       CargarUsuarios();
                                     }else toastr.error('hubo un error');

                                }
                              });		
		});
		
		$(document).on('click','.act<?php echo $ale; ?>',function(){
			var codigo=$(this).attr('data-ide');
			$.ajax({
                                url:'/base/Usuario_c/activar_usuario',
                                type:'POST',
                                dataType:'JSON',
                                data:{"codigo":codigo},
                                success:function(ans){
                                    if(ans.err=='1'){
                                       toastr.success('Usuario Activado Satisfactoriamente');                             
                                       CargarUsuarios();
                                     }else toastr.error('hubo un error');

                                }
                              });
						
		});
		
		$(document).on('click','.CheckBoxs',function(){
	 		var codusr = $('#codusr').val();
			var codpag = $(this).val();
			$.ajax({
					url:'/base/Usuario_c/act_permiso',
					data:{'codusr':codusr,'codpag':codpag},
					type:"POST"	
				});
				
			});	
	});
	function CargarUsuarios(){
				var oTable = $('#listado_historias').dataTable({
							  "bPaginate": true,
							  "ordering": true,
							  "bLengthChange": true,
							  "responsive": true,
							  "bInfo": true,
							  "bFilter": true,
							  "bDestroy": true,
							  "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},							
								"ajax": {
									"url": "/base/Usuario_c/consultarUsuarios/",
									"type": "POST"   ,
									"data":{"ale":"<?php echo $ale;?>"}   		
								}
    });	
	}
	
	function permisos(codigo){
				var oTable = $('#permisos').dataTable({
							  "bPaginate": false,
							  "ordering": true,
							  "bLengthChange": true,
							  "responsive": true,
							  "bInfo": true,
							  "bFilter": true,
							  "bDestroy": true,
							  "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},							
								"ajax": {
									"url": "/base/Usuario_c/consultarPaginasuser/",
									"type": "POST",
									"data":{'codigo':codigo} 		
								}
    });	
	}
	
	</script>

    <!-- Custom Theme Scripts -->