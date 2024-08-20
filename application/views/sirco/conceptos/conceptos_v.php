<div id="contenido">
	<form id="form_usu">
	  	<div class="row">
               
			   <div class="col-md-2">
               <div class="form-group">   
               <label>Tipo de Movimiento </label>
                <select id="tpoknp" class="form-control"> 
                    <option value=""></option> 
                    <option value="Credito">Crédito</option> 
                    <option value="Debito ">Débito </option> 
                </select>
                </div>
		        </div>
		   
		    	<div class="col-md-5">
             	<div class="form-group">   
                <label>Nombre</label>
                <input type="text" name="nomnif" id="nomnif" class="form-control" onkeyup="mayuscula(this);">
                </div>
		        </div>
		   
		   	   <div class="col-md-2">
                                                             <label>Cuenta</label>
															<div class="input-group">
															
                                                                <input type="text" id="codnif" name="codnif" class="form-control">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#cuentas_niif_detallea" ><i class="fa fa-search" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                            </div><!-- /input-group -->
                                                        </div>
		   
        		<div class="col-md-3">
             	<div class="form-group" style="margin-top:25px;"> 
               
                <button id="btn_guardar"><img src="/res/icons/sirco/save.png">Guardar</button>
                <button id="btn_imprimir"><img src="/res/icons/sirco/print.png"> </button>
				</div>
				</div>
				
        </div>
		</form>
    </div>

    <h3 class="titulo">Conceptos</h3>
    <div id="tabla">
    	<table id="tabla_conceptos" width="100%">
        	<thead>
            	<tr>
                	<th width="7%">Id</th>
                	<th width="33%">Nombre</th>
                	<th width="30%">Cuenta</th>
                	<th width="20%">Tipo cta</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
            	
            </tbody>
        </table>
    </div>
	
	<script type="text/javascript">
	function table(){
		$('#tabla_conceptos').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/sirco/conceptos_c/obtener_conceptos/",
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}	
	
	function cerrar_cuentas(codigo,nombre){
		$('#cuentas').dialog('close');
		$('#ctaknp').val(codigo+"-"+nombre);
		return false;		
	}
	
	function cerrar_editar(){
		$('#editar').dialog('close');
		table();
		return false;	
	}
	
	
$(document).ready(function() {
    table();
	
	$('.buscar').on('shown.bs.modal', function () {
            $('.buscar input[type="search"]').focus();
        });

        $('.imgbuscar').click(function () {
            cod_vista = $(this).attr('vista');
            $(cod_vista).modal();
        });
		
	$('#bctaknp').on('click',function(){
		$('<iframe id="cuentas" frameborder="0" />').attr('src','/sirco/conceptos_c/vista_buscar/cuentas').dialog({
					resizable:false, 
					modal: true,
					width:590, 
					height:280, 
					position:['middle',70],
					title: 'Cuentas contables',
					close : function(v, ui){							
						$(this).remove();
					}
		}).width(590-20).height(280-20);	
	});
	
	$('#tabla_conceptos').on('click','.editar',function(){
		cod = $(this).attr('id');
		$('<iframe id="editar" frameborder="0" />').attr('src','/sirco/conceptos_c/datos_editar/'+cod).dialog({
					resizable:false, 
					modal: true,
					width:590, 
					height:150, 
					position:['middle',100],
					title: 'Cuentas contables',
					close : function(v, ui){							
						$(this).remove();
					}
		}).width(590-20).height(150-20);	
	});
	
	$('#tabla_conceptos').on('click','.eliminar',function(){
		cod = $(this).attr('id');
		if(confirm('¿Seguro desea eliminar?')){
			$.ajax({
				url:'/sirco/conceptos_c/eliminar_conceptos',
				type:"POST",
				data:{'codknp':cod},
				success: function(resp){
					if(resp==0){
						alert('Concepto eliminado satisfactoriamente');
						table();
					}else{
						alert('Ocurrio un error, intente más tarde');	
					}
				}	
			});
		}
	});
	
	$('#btn_guardar').click(function(e){
		e.preventDefault();
		nom = $('#nomnif').val();
		tpoknp = $('#tpoknp').val();
		ctaknp = $('#codnif').val();
		
		if(nom!='' && tpoknp!='' && ctaknp!=''){
			$.ajax({
				url:'/sirco/conceptos_c/agregar_conceptos',
				type:"POST",
				data:{'nom':nom,'tpoknp':tpoknp,'ctaknp':ctaknp},
				success: function(resp){
					if(resp==0){
						alert('Concepto agregado satisfactoriamente');
						$('#nomnif').val('');
						$('#tpoknp').val('');
						$('#codnif').val('');
						table();	
					}else{
						alert('Ocurrio un error, intente más tarde');
					}
				}	
			});	
			
		}else{
			alert('No pueden ir campos vacios');	
		}
	});
	
	$('#btn_imprimir').click(function(e){
	   e.preventDefault();
	   window.open('/sirco/conceptos_c/reporte');
	});
	
	
});
function mayuscula(e) {
    e.value = e.value.toUpperCase();
}
</script>
