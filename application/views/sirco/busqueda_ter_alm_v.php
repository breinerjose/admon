<div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="busqueda_ter_alm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terceros</h5>
                </div>
                <div class="modal-body">
            	
				 <div class="row">
				 <div class="col-md-4">
                 <div class="form-group">
                        <input name="alm_cmp_buscar" id="alm_cmp_buscar" class="form-control"  type="text">
                 </div>
                 </div>
				 <?php $Y = date('Y');?>
				 <div class="col-md-2">
                 <div class="form-group">
                        	<select id="alm_agnakd" name="alm_agnakd" class="form-control" >
							<option <?php if($Y == '2030') {?>selected="selected"<?php } ?> >2030</option>
							<option <?php if($Y == '2029') {?>selected="selected"<?php } ?> >2029</option>
							<option <?php if($Y == '2028') {?>selected="selected"<?php } ?> >2028</option>
							<option <?php if($Y == '2027') {?>selected="selected"<?php } ?> >2027</option>
							<option <?php if($Y == '2026') {?>selected="selected"<?php } ?> >2026</option>
							<option <?php if($Y == '2025') {?>selected="selected"<?php } ?> >2025</option>
							<option <?php if($Y == '2024') {?>selected="selected"<?php } ?> >2024</option>
							<option <?php if($Y == '2023') {?>selected="selected"<?php } ?> >2023</option>
							<option <?php if($Y == '2022') {?>selected="selected"<?php } ?> >2022</option>
							<option >2021</option>
							<option >2020</option>
							<option >2019</option>
							<option >2018</option>
							<option >2017</option>
  		 					</select>
                 </div>
                 </div>
				 
				 <div class="col-md-2">
                 <div class="form-group">
				 <button type="button" class="btn btn-success inline" id="btn_alumno_buscar"> Buscar </button>
				  </div>
                 </div>
				 
				 </div>
				 	 

                    <table id="tabegresos" cellpadding="0" cellspacing="0" class="display" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">Identificacion</th>
            					<th width="35">Terceros</th>
								<th width="10">Id Alumno</th>
								<th width="40">Datos Alumno</th>
    							<th width="5%"></th>
                            </tr>
                        </thead> 
                        <tbody>

                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
	


<script type="text/javascript">
var oTable; var busqueda;
$(document).ready(function(){

 $("#alm_cmp_buscar").focus();
 
	$('#btn_alumno_buscar').click(function () {	
	if($('#alm_cmp_buscar').val()!=''){
		  busqueda=$('#alm_cmp_buscar').val();
		  anio=$('#alm_agnakd').val();
			oTable.fnReloadAjax();
		}else{ alert ('debe escribir un valor a buscar');}
	});
	
	
	busqueda='';
	anio='';
	oTable = $('#tabegresos').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/sirco/terceros_c/cargarListadoTercerosAlumnos/",
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},
					     "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
																						oSettings.jqXHR = $.ajax( {
																						  "dataType": 'json',
																						  "type": "POST",
																						  "url": sSource,
																						  "data": { "busqueda" : busqueda, "agnakd" : anio										
																								   },
																						  "success": fnCallback
																						} );
																					  },
			
		});
		
		$(document).on('click','.seleccion',function(){
		    $('#nomtrc').val($(this).attr('nombre'));
			$('#codtrc').val($(this).attr('codigo'));
			$('#codalm').val($(this).attr('codalm'));
			$('#grado').val($(this).attr('grado'));
			$('#grupo').val($(this).attr('grupo'));
			$('#agnakd').val($(this).attr('agncnt'));
			$('#obscmp').val($(this).attr('datos'));
			$('#busqueda_ter_alm').modal('toggle');
		
		});
});
</script>