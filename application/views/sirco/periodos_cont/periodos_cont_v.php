<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-primary">
                <div class="panel-heading">Periodos Contable</div>
                <div class="panel-body">

                    <div class="container">
                        <form>
                            <div class="form-group col-md-2">
                                <label for="inputsm">Año</label>
                            </div>

                            <div class="form-group col-md-10" style="align:lefth;">
                                <select class="form-control" id="anio">
                                    <?php
                                    for ($i = 0; $i <= 13; $i++) {
                                        echo '<option value="' . (2013 + $i) . '">' . (2013 + $i) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div id="tabla">
                                    <table id="tabla_periodos" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="34%">Año</th>
                                                <th width="33%">Mes</th>
                                                <th width="33%">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function table(anio){
		$('#tabla_periodos').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": false,
                        "searching": false,
			"sAjaxSource": "/sirco/periodos_cont_c/llenar_tabla/"+anio,
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}
	
	function cerrar_editar(){
		$('#editar').dialog('close');
		table($('#anio').val(), $('#sede').val());
		return false;	
	}
	
	function deshabilitar(){ $('#tabla_periodos .selects').attr('disabled','disabled');  }

$(document).ready(function() {
	
	$('#anio').on('change',function(){
		table($('#anio').val());	
		if($('#cerrar_anio').prop('disabled')==true){
			alert('Usted no tiene permiso para realizar cierres de periodo/año contable.');
			deshabilitar();	
		}  
	});
	
	$.post('/sirco/periodos_cont_c/verificar_usuario',function(resp){
		table($('#anio').val());
		if(resp==1){ 
			$('#cerrar_anio').prop('disabled',true); 
			alert('Usted no tiene permiso para realizar cierres de periodo/año contable.');	
			deshabilitar();			
		}
	});
	
	$('#tabla_periodos').on('change','.selects',function(e){
		e.preventDefault();
		anio=$(this).attr('anio');
		mes=$(this).attr('mes');	
		std=$(this).val();
		$.post('/sirco/periodos_cont_c/actualizar_estado',{'anio':anio,'mes':mes,'std':std},			
		function(resp){
			if(resp==1){ 
				table(anio); 
			}else{ alert('El estado no pudo ser actualizado, intente más tarde.'); }
		});		
	});
	
	$('#cerrar_anio').click(function(e){
		e.preventDefault();	
		anio = $('#anio').val();
		if(confirm('¿En realidad desea cerrar el año seleccionado?')){
			$.post('/sirco/periodos_cont_c/cerrar_anio_contable',{'anio':anio},			
			function(resp){
				if(resp==1){ 
					table(anio); 
				}else{ alert('El año no pudo ser cerrado, intente más tarde.'); }
			});
		}
	});
	
});
</script>
