<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<style>
*{ margin:0; padding:0;}
body{ font-family: 'Capriola',sans-serif; }
#buscar img{ height: 12px;
    width: 12px;}	

	


#cuenta {
    border: 1px solid #cccccc;
    margin-bottom: 10px;
    padding: 4px;
    width: 343px;
}
	
#ubicacion,#elemen{border: 1px solid #CCCCCC; padding: 2px;}
#ubicacion{ margin-right: 24px;
width: 110px; }
#elemen{ margin-right: 20px;
    width: 320px;}

button:hover{ cursor:pointer;}

#abajo{ height: 270px;
    margin-top: 5px;
    overflow-y: scroll;}

#tabla{}
.imgelim{height: 10px;
    width: 10px;}
	
#tabla .tr{ font-size: 11px;
    height: 20px;}
#contenido p.general {
    display: inline-block;
    height: 48px;
    width: 49%;
	float:left;
}
#contenido{
	border: 1px solid #999999;
    height: 170px;
    float:left;
    width: 99.6%;
	
	}
#contenido h2.cab {
    background: url("../../../../../res/icons/activos/cab.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    border-bottom: 1px dashed #999999;
    color: #333;
    font-size: 13px;
    margin: auto;
    padding: 0.1em;
    text-align: center;
}
#contenido2{
	border: 1px solid #999999;
    height: 400px;
    float:left;
    width: 99.6%;
	
	}
#contenido2 h2.cab {
    background: url("../../../../../res/icons/activos/cab.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    border-bottom: 1px dashed #999999;
    color: #333;
    font-size: 13px;
    margin: auto;
    padding: 0.1em;
    text-align: center;
}

.simb, .simb1{
	background-color: #EEEEEE;
    border-bottom: 1px solid #999999;
    border-left: 1px solid #999999;
    border-radius: 4px 0 0 4px;
    border-top: 1px solid #999999;
    color: #666666;
    display: inline-block;
    line-height: 1;
    padding: 6px 7px;
    text-align: center;
    vertical-align: top;
    white-space: nowrap;
}
.simba{
	background-color: #EEEEEE;
    border-bottom: 1px solid #999999;
    border-left: 1px solid #999999;
    border-radius: 4px 0 0 4px;
    border-top: 1px solid #999999;
    color: #666666;
    display: inline-block;
    line-height: 1;
    padding: 8.5px 7px;
    text-align: center;
    vertical-align: top;
    white-space: nowrap;
	float:left;
}
.simb1{
	border-radius: 0 4px 4px 0;
	border-left:none;
	border-right: 1px solid #999999;
	line-height: 0;
	 margin-left: -5px;
     padding: 6.5px 7px;
}
.error{border-color:#3D7BCF; background:#DFEEFF; }
button#agregar {
    margin-top: 17px;
}


</style>
<link rel="stylesheet" type="text/css" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css">
<link rel="stylesheet" href="/res/chosen/chosen.css" />
<link rel="stylesheet" href="/res/jboesch-Gritter/css/jquery.gritter.css" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_page.css" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_table.css"/>
<link rel="stylesheet" href="/res/jboesch-Gritter/css/jquery.gritter.css" />

<script src="/res/js/jquery.js"></script>
<script src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="/res/jquery/jquery.blockUI.js"></script>
 <script type="application/javascript" src="/res/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="/res/js/validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="/res/jboesch-Gritter/js/jquery.gritter.min.js"></script>
<script type="text/javascript" src="/res/js/datatables/media/js/jquery.dataTables.js"></script>
 <script type="text/javascript" src="/res/js/fnReloadAjax.js"></script>
<script type="text/javascript" src="/res/jboesch-Gritter/js/jquery.gritter.min.js"></script>

<script type="text/javascript">


function cerrar_dep(codnif,nomnif){
	$('#buscaar').dialog('close');
	//$('#cuenta').val(codnif+'-'+nomnif);
	$('#cuenta').val(codnif);
	/*$.ajax({
		url: '/sirco/estadosf_c/nom_cuenta',
		type:"POST",
		data:{'codigo':codigo,},		
		success: function(resp){
			$('#cuenta').val(codigo+'-'+resp);
		}	
	});*/
	return false;	
}
function buscarcta1(codigo,nombre){
	$('#buscaar').dialog('close');
	$('#cuenta').val(codigo);
	/*$.ajax({
		url: '/sirco/estadosf_c/nom_cuenta',
		type:"POST",
		data:{'codigo':codigo},		
		success: function(resp){
			$('#cuenta').val(codigo+'-'+resp);
		}	
	});*/
	return false;	
}
var oTable;var balance=0;
 $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

$(document).ready(function() {
	var asInitVals = new Array();
		jQuery.validator.messages.required = "";
		$.validator.setDefaults({ ignore: ":hidden:not(select)" });

	oTable = $('#listado_configuraciones').dataTable( {
					  "bProcessing": true,
					  "bDestroy": true,
					  "blengthChange": true,
					  "sScrollY": "270px",
					  "bPaginate": false,
					   "iDisplayLength": 25, 
					  "sPaginationType": "full_numbers",
					  "sAjaxSource": "/sirco/estados_financieros_n_c/listadoConfiguracionesFinancierasNiff",
					  "oLanguage": {"sUrl":"/res/js/datatables/media/language/espanol.txt"},
					   "aaSorting": [[ 1, 'desc' ] ],
					     "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0] }],
					    "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
												oSettings.jqXHR = $.ajax( {
												  "dataType": 'json',
												  "type": "POST",
												  "url": sSource,
												  "data": { "balance":balance										
														   },
												  "success": fnCallback
												} );
											  },
					  "fnDrawCallback": function( settings ) {
						var allChecked = true;
						$('#listadoRembolso tbody tr').each(function() {
							$(this).find(':checkbox[name="recibo[]"]').each(function(){
								if (!$(this).is(':checked')) {
									allChecked = false;
									}
								});
							});
						$('#all').prop('checked', allChecked);},						  
			  });
			   $("tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					oTable.fnFilter( this.value, $("tfoot input").index(this) );
				} );
				$("tfoot input").each( function (i) {
					asInitVals[i] = this.value;
				} );
				
				$("tfoot input").focus( function () {
					if ( this.className == "search_init" )
					{
						this.className = "";
						this.value = "";
					}
				} );
				
				$("tfoot input").blur( function (i) {
					if ( this.value == "" )
					{
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				} );
	
	$('form#datos')[0].reset();
	$('#codbaa').chosen();
		$('#tip_bal').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) {
	codigo = $(this).val();	
		if(codigo!=''){
			cargarBaa(codigo);
			balance=codigo;
			oTable.fnReloadAjax();
			$("#codbab").empty().trigger("chosen:updated");
			$("#codbac").empty().trigger("chosen:updated");
		}else{
			balance=0;
			 oTable.fnReloadAjax();
			 $("#codbaa").empty().trigger("chosen:updated");
			 $("#codbab").empty().trigger("chosen:updated");

		}	 
	});
		$('#codbaa').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) {
	codigo = $(this).val();	
		if(codigo!=''){
			cargarBab(codigo);
		}else{
			 //$("#codbab").empty().trigger("chosen:updated");
		}	 
	});
	
	$('#codbab').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) {
	codigo = $(this).val();	
		if(codigo!=''){
			cargarBac(codigo);
		}else{
	
		}	 
	});
		$('#codbac').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) {
	codigo = $(this).val();	
		if(codigo!=''){
			//cargarBab(codigo);
		}else{
			
		}	 
	});

	

	
	$('#buscar').on('click',function(e){
		e.preventDefault();
			cod_vista = $(this).attr('vista');
			$('<iframe id="buscaar" frameborder="0" />').attr('src','/sirco/cuentas_c/vista_buscar/depnif_v/').dialog({
						resizable:false, 
						modal: true,
						width:850, 
						height:400, 
						position:['middle',20],
						title: 'Busqueda..',
						close : function(v, ui){							
							$(this).remove();
						}
			}).width(850-20).height(400-20);	
	});
	

	
	$('#agregar').on('click',function(e){
		e.preventDefault();
		
		 if($("#datos").validate().form()){	
			$.ajax({
				url: '/sirco/estados_financieros_n_c/agregarEstadoFinancierosNiff',
				data:$('#datos').serialize(),
				type:"POST",
				success: function(ans){
					if(ans.err=='1'){	
					$.extend($.gritter.options, {
						 position: 'mindle', 
						 fade_in_speed: 100, 
						 fade_out_speed: 100, 
						 time: 1000 
					});
				
					$.gritter.add({
						title: 'Volante Registrado',
						image: '/res/icons/09/ok.png',
						text: 'Satisfactoriamente',
						sticky: false//,
					});	
					 //$('#datos').get(0).reset();
					 $('#cuenta').val('');
					 oTable.fnReloadAjax();
					}else{
						alert(ans.msg);	
					}
				}
			});
			
		}else{ 
			alert('hay datos pendientes por llenar');
		}
	});
	
	$(document).on('click','.eliminar',function(){
		var codigo=$(this).attr('codigo');
		if(confirm('¿En realidad desea eliminar el item seleccionado?')){
			$.ajax({
				url: '/sirco/estados_financieros_n_c/eliminarConfiguracionEstadoFinancieroNiff',
				type:"POST",
				data:{'codigo':codigo},
				success: function(ans){
					if(ans.err=='1'){	
					    oTable.fnReloadAjax();
					}else{
						alert(ans.msg);	
					}
				}	
			});
		}
	});
	

});
  function cargarBaa(codbal){
	 $.post('/sirco/estados_financieros_n_c/cargarBaa',{"codbal":codbal},function(ans){
		 $('#codbaa').empty();
		 if(ans.err=='1'){
			 $('<option value=""></option>').appendTo('#codbaa');
			 for (i in ans.data){
				$('<option value="'+ans.data[i].codbaa+'">'+ans.data[i].nombaa+'</option>').appendTo('#codbaa');	 
			 }
			
			 
		 }else{
			alert(ans.msg);
		 }
		  $('#codbaa').trigger("chosen:updated");
	  },'JSON');
 }
   function cargarBab(codbaa){
	 $.post('/sirco/estados_financieros_n_c/cargarBab',{"codbaa":codbaa},function(ans){
		 $('#codbab').empty();
		 if(ans.err=='1'){
			 $('<option value=""></option>').appendTo('#codbab');
			 for (i in ans.data){
				$('<option value="'+ans.data[i].codbab+'">'+ans.data[i].nombab+'</option>').appendTo('#codbab');	 
			 }

		 }else{
			 alert(ans.msg);
		 }
		  $('#codbab').trigger("chosen:updated");
	  },'JSON');
 }
    function cargarBac(codbab){
	 $.post('/sirco/estados_financieros_n_c/cargarBac',{"codbab":codbab},function(ans){
		 $('#codbac').empty();
		 if(ans.err=='1'){
			 $('<option value=""></option>').appendTo('#codbac');
			 for (i in ans.data){
				$('<option value="'+ans.data[i].codbac+'">'+ans.data[i].nombac+'</option>').appendTo('#codbac');	 
			 }

		 }else{
			 alert(ans.msg);
		 }
		  $('#codbac').trigger("chosen:updated");
	  },'JSON');
 }
     function cerrarDialogonif(mensaje,codnif,nomnif){
	$('#buscaar').dialog('close');
	$.blockUI({ 
		   message: mensaje 
	});
	$.unblockUI();	
	$('#cuenta').val(codnif);
	
	return false;	
 }
</script>
</head>
<body>
<div id="contenido">
<h2 class="cab">Configurar Estados Financieros</h2>
    	<form id="datos" name="datos"  method="post" action="#">
    	<p class="general">
        <span>Tipo de balance</span><br/>
         <select id="tip_bal" name="codbal" data-placeholder="Seleccione Balance" style="width:397px;" class="chosen-select required">
		 <option value=""></option>
		 <?php echo $balance;?></select>
        </p>
        <p class="general">
        <span>codbaa</span><br/>
         <select id="codbaa" name="codbaa" data-placeholder="Seleccione codbaa" style="width:397px;" class="chosen-select required"><option value=""></option></select>
        </p>
        	<p class="general">
        <span>codbab</span><br/>
         <select id="codbab" name="codbab" data-placeholder="Seleccione codbab" style="width:397px;" class="chosen-select required"></select>
        </p>
        <p class="general">
        <span>codbab</span><br/>
         <select id="codbac" name="codbac" data-placeholder="Seleccione codbac" style="width:397px;" class="chosen-select required"></select>
        </p>
        <p class="general">
        <span>Cuenta</span><br/>
        <input type="text" id="cuenta" name="cuenta" class="required" readonly>
        <a href="javascript:void(0);" id="buscar" title="Buscar Provedor"><span class="simb1"><img src="/res/icons/activos/buscar.png" height="16" /></span></a> 
        </p>
        <p class="general">
        	
            <button id="agregar"> <img src="/res/icons/sirco/save.png"> Guardar</button>
        </p>
        </form>
</div>
<div id="contenido2">
<h2 class="cab">listado de configuraciones</h2>
	<table id="listado_configuraciones" class="display" width="100%">
<thead>
<tr>

    <th width="25%">balance</th>
	<th width="15%">nombaa</th>
    <th width="15%">nombab</th>
    <th width="15%">nombac</th>
	<th width="10%">codcta</th>   
    <th width="15%">nomcta </th>
    <th width="5%"></th>      
</tr>
</thead>
<tbody>
</tbody>
  <tfoot align="center">
            <tr >
            	
                <th width="25%"><input type="text" name="search_balance" value="balance" class="search_init" /></th>    
                <th width="15%"><input type="text" name="search_nombaa" value="nombaa" class="search_init" /></th>
                <th width="15%"><input type="text" name="search_nombab" value="nombab" class="search_init" /></th>
                 <th width="15%"><input type="text" name="search_nombac" value="nombac" class="search_init" /></th>
                <th width="10%"><input type="text" name="search_codcta" value="codcta" class="search_init" /></th>
    		 	<th width="15%"><input type="text" name="search_nomcta" value="nomcta" class="search_init" /></th>
                <th width="5%"></th>
             </tr>            
    </tfoot>
</table>
    	
</div>
</body>
</html>