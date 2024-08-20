<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Informe General de usuarios</title>
<title>Paginas de Aplicaciones</title>
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
function dtl(sede,cargo,perfil,estado,apl,pag){
				oTable = $('#usuarios').dataTable( {
							"bProcessing": true,
							"bDestroy" : true,
							"bPaginate": true,
							"sScrollY" : '210px',
							"sPaginationType": "full_numbers",
							"sAjaxSource": "<?php echo base_url(); ?>usuario_c/consultarTodosusuarios/"+sede+'/'+cargo+'/'+perfil+'/'+estado+'/'+apl+'/'+pag,
							"oLanguage": {"sUrl": "<?php echo base_url(); ?>recursos/js/datatables/media/language/espanol.txt"}
				});
}	
$(document).ready(function() {
	   dtl('0','0','-1',$('#estado').val(),'0','0');
	   
	   $.post('<?php echo base_url();?>usuario_c/selectPerfil/',function(resp){
		if(resp=='1'){
			 alert('No hay datos para mostrar');
		}else{
			$('#perfil').append("<option value=''> Seleccione Perfil</option>");
			  for(i=0; i< resp.length; i++){
				$('<option/>').val(resp[i].codigo).text(resp[i].nombre).appendTo('#perfil');
			  }
		}
	},'json');
	
		$.post('<?php echo base_url();?>usuario_c/consultarSede/',function(resp){
		if(resp=='1'){
			 alert('No hay datos para mostrar');
		}else{
			$('#sede').append("<option value=''> Seleccione sede</option>");
			  for(i=0; i< resp.length; i++){
				$('<option/>').val(resp[i].codigo).text(resp[i].nombre).appendTo('#sede');
			  }
		}
	},'json');
	
	$.post('<?php echo base_url();?>usuario_c/consultarCargo/',function(resp){
		if(resp=='1'){
			 alert('No hay datos para mostrar');
		}else{
			$('#cargo').append("<option value=''> Seleccione Cargo</option>");
			  for(i=0; i< resp.length; i++){
				$('<option/>').val(resp[i].codigo).text(resp[i].nombre).appendTo('#cargo');
			  }
		}
	},'json');
	
	$.post('<?php echo base_url();?>usuario_c/selectAplicaciones/',function(resp){
		if(resp=='1'){
			 alert('No hay datos para mostrar');
		}else{
			$('#aplics').append("<option value=''> Seleccione Aplicación</option>");
			  for(i=0; i< resp.length; i++){
				$('<option/>').val(resp[i].codigo).text(resp[i].nombre).appendTo('#aplics');
			  }
		}
	},'json');
	
	$('#aplics').on('change',function(){
	 $('#codpag').html('');
	  var codapl = $(this).val();
	  if(codapl != ''){
	  		$.post('<?php echo base_url();?>usuario_c/selectPaginas/',{'codapl':codapl},function(resp){
				if(resp=='1'){
					 alert('No hay datos para mostrar');
				}else{
					$('#codpag').append("<option value=''> Seleccione Pagina</option>");
					  for(i=0; i< resp.length; i++){
						$('<option/>').val(resp[i].codigo).text(resp[i].nombre).appendTo('#codpag');
					  }
				}
			},'json');
	  }
	});
	
	$('.consulta').button({
		icons:{primary:"ui-icon-search"}
	}).on('click',function(){
			if($('#sede').val()==''){var sede ='0'}else{var sede = $('#sede').val();}
			if($('#aplics').val()==''){var apl ='0'}else{var apl = $('#aplics').val();}
			if($('#codpag').val()=='' || $('#codpag').val()== null){var pag ='0'}else{var pag = $('#codpag').val();}
			if($('#cargo').val()==''){var cargo ='0'}else{var cargo = $('#cargo').val();}
			if($('#perfil').val()==''){var codprf ='-1'}else{var codprf = $('#perfil').val();}
		 dtl(sede,cargo,codprf,$('#estado').val(),apl,pag);
	});
	
	
	
$('.imprimir').button({
	icons:{primary:"ui-icon-print"}
}).on('click',function(){
  if($('#sede').val()==''){
	  var sede ='0';
	  var ns = '-';
  }else{var sede = $('#sede').val();var ns = $('#sede option:selected').text();}
  if($('#cargo').val()==''){
	  var nc = '-';
	  var cargo ='0';
  }else{var cargo = $('#cargo').val();var nc = $('#cargo option:selected').text();}
  if($('#perfil').val()==''){
	  var np = '-';
	  var codprf ='-1';
  }else{var codprf = $('#perfil').val();var np = $('#perfil option:selected').text();}
   if($('#aplics').val()==''){
	  var nomapl = '-';
	  var codapl ='0';
  }else{var codapl = $('#aplics').val();var nomapl = $('#aplics option:selected').text();}
   if($('#codpag').val()=='' || $('#codpag').val()==null){
	  var nompag = '-';
	  var codpag ='0';
  }else{var codpag = $('#codpag').val();var nompag = $('#codpag option:selected').text();}
  var estado = $('#estado').val();
		
	 window.open('<?php echo base_url();?>usuario_c/generarInformeusuario/'+sede+'/'+cargo+'/'+codprf+'/'+estado+'/'+codapl+'/'+codpag+'/'+ns+'/'+nc+'/'+np+'/'+nomapl+'/'+nompag,'','scrollbars=yes,width=1000,height=550,left=450,top=250');
	});
	
	
});
</script>
<style type="text/css">
   .error{border-color:#223B8D;background:#FCBE80;}
    #consulta p{display:inline-block; font-size:13px;margin:3px;}
	.sel, .sel1, .sel2, .sel3, .sel4{width:250px; height:28px; padding:5px; font-size:12px;}
	label.par{font-size:15px;font-weight:bold;color:#223B8D;}
	.sel1{width:250px;}.sel2{width:150px;}.sel3{width:175px;}.sel4{width:350px;}
	
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

</style>
</head>

<body>
<fieldset>
	<legend><b>Parametros de consulta</b></legend>
    <form id="consulta" name="consulta" method="post">
        <p>
    	 <label class="par">perfil</label><br>
    	 <select id="perfil" name="perfil" class="sel required"></select>
    	</p> 
    	<p>
        	<label class="par">Sede</label><br>
            <select id="sede" name="sede" class="sel3"></select>
        </p>
        <p>
        	<label class="par">Departamento</label><br>
            <select id="cargo" name="cargo" class="sel1"></select>
        </p>
         <p>
         	<label class="par">estado</label><br>
        	 <select id="estado" name="estado" class="sel2">
             	<option value="generado">Generado</option>
                <option value="eliminado">Eliminado</option>
             </select>
        </p>
        <p>
        	<label>Aplicación</label><br>
            <select id="aplics" name="aplics" class="sel1"></select>
        </p>
         <p>
        	<label>Paginas</label><br>
            <select id="codpag" name="codpag" class="sel4"></select>
        </p>  
        <p>
        	<a href="#" class="consulta">Consultar</a>
        </p>
        <p>
        	<a href="#" class="imprimir">Generar informe</a>
        </p>
    
    </form>
</fieldset>
<br>
<table id="usuarios" cellpadding="0" cellspacing="0" class="display" width="100%">
	<thead>
    	<tr>
            <th width="13%">Aplicación</th>
            <th width="15%">Pagina</th>
        	<th width="13%">identificación</th>
            <th width="20%">Nombres Y Apellidos</th>
            <th width="10%">Perfil</th>
            <th width="10%">Sede</th>
            <th width="11">Departamento</th>
            <th width="8%">Estado</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</body>
</html>