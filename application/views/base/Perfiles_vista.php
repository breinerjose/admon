<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manejo de perfiles</title>
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_page.css" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_table.css"/>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/res/js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/res/js/validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery.validator.messages.required = "";
var oTable;
function dtl(){
		oTable = $('#perfiles').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"sScrollY" : '210px',
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/configuraciones/usuario_c/consultarPerfiles/",
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}	
	
	function cerrarDialogo(){
			$('#pagperfil').dialog('close');
			dtl();
			return false;
	}
$(document).ready(function(){
	
	dtl();
 	$( "a.agregar" ).button({
		icons:{primary:"ui-icon-disk"}
		}).on('click',function(){
		 if($("#registrar").validate().form()){
			$.ajax({
					url:"/configuraciones/usuario_c/agregarPerfil",
					data:$('form#registrar').serialize(),
					type:"POST",
					dataType:"json",
					success: function(resp){
						if(resp=='1'){
							alert('Insercción Exitosa');
							setTimeout(function(){ $('#registrar').get(0).reset();}, 1000);
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
		
		$('#perfiles').on('click','.edi', function(){
			var cod = $(this).attr('data-ide');var nom = $(this).attr('data-nom');
			$('#codigo').val(cod);$('#dscprf1').val(nom);
			$("#actualizar").dialog({
						resizable: false,
						height:280,
						width:400,
						title:'Actualizar Perfil',
						position:['mindle'],
						modal: true,
						show: {effect: 'bounce', duration: 350,times: 3},
						buttons: {'Actualizar': function() {
							                 if($("#formact").validate().form()){
													    $.ajax({
																url: "<?php echo base_url();?>configuraciones/usuario_c/actualizarPerfil",
																data:$('form#formact').serialize(),
																type: "POST",
																dataType:"json",
																success: function(datos){
																	if(datos=='1'){ 
																		$('.ui-dialog').remove();
																	    dtl();
																	}else{alert(datos.msg);}
															    }            
														});
												}else{
														alert('Campos Pendientes por llenar');	
												}		
									}
								}
				 		});
		     });
			 
	  $('#perfiles').on('click','.add',function(){
		var cod = $(this).attr('data-ide');
		$('<iframe id="pagperfil" frameborder="0" />').attr('src','/configuraciones/usuario_c/vistaPaginas/'+cod).dialog({
				resizable:false, 
				modal: true,
				width:600, 
				height:320, 
				title: 'Asignación de Paginas',
				close : function(v, ui){							
					$(this).remove();
				}
			}).width(600-25).height(320-25);	
	});

});

</script>
</head>
<style type="text/css">
.error{border-color:#223B8D;background:#FCBE80;}
#registrar p{display:inline-block;margin:0.25em;}
label.par{font-size:15px;font-weight:bold;color:#223B8D;}
.txt, .txt1{font-size:12px;padding:3px;width:280px;height:22px;}
.txt{width:100px}
.agregar{font-size:12px;padding:3px;}
table.display tr td{font-size:13px;}

table.display
{
    font-size: 0.9em;
    margin: 0 auto;
    background-color: #ffffff;
    box-shadow:black 1px 1px 5px;
    border-collapse: collapse;
     /* hack IE8 */
    border-collapse: collapse \0/;
    border-right: 2px inset #D3D3D3 \0/;
    border-bottom: 2px inset #D3D3D3 \0/;
     /* hack IE7 */
    *border-collapse: collapse;
    *border-right: 2px inset #D3D3D3;
    *border-bottom: 2px inset #D3D3D3;
}
table.display thead tr{
    background-color: #CC0000;
    color:white;
}
table.display th a{
   color:white;
}
table.display tr.odd
{
    background-color: #FFE8E8;
}

table.display tr.noDataRow td {
    text-align: center;
}

table.display table th.title
{
    text-align: center;
}


table.display th,td
{
    text-align: left;
    padding: 10px;
}

table.display td
{
    height: 1.6em;
    padding: 0 0.5em;
}

table.display td.editable
{
    width: 200px;
    height: 22px;
}

table.display th.sortable
{
    cursor: pointer;
}

table.display tr.loading {
    color: #dddddd;
    background-color: #f6f6f6;
}

tr.odd td.sorting_1 {
    background-color: #FCABAB;
    margin: 0.25em;
    padding: 0.25em;
}

tr.even td.sorting_1 {
    background-color: #F9DBDB;
    margin: 0.25em;
    padding: 0.25em;
}
table.display td.loading
{
    background:url(../../../recursos/images/loading.gif) no-repeat 4px center;
    padding-left: 24px;
    color: #aaaaaa;
    width: 176px;
}
#dscprf, #dscprf1{text-transform:capitalize;}
#actualizar{display:none;font-size:13px;}
</style>
</head>

<body>
<fieldset>
<legend><b>Parametros de Registro</b></legend>
<form id="registrar" name="registrar" method="post">
     <p>
    <label class="par">Descripcion</label><br>
     <input type="text" id="dscprf" name="dscprf" class="txt1 required"/>
    </p> 
    <p>
    	<a href="#" class="agregar">Guardar</a>
    </p>
</form>
</fieldset>
<br>
<table id="perfiles" cellpadding="0" cellspacing="0" class="display" width="100%">
	<thead>
    	<tr>
        	<th width="15%">Codigo</th>
            <th width="50%">Descripción</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="actualizar">
<form id="formact" id="formact" method="post">
     <p>
       <label class="par">Codigo</label><br>
       <input type="text" id="codigo" name="codigo" class="txt" readonly/>
    </p> 
     <p>
    <label class="par">Descripcion</label><br>
     <input type="text" id="dscprf1" name="dscprf1" class="txt1 required"/>
    </p> 
</form>
</div>
</body>
</html>