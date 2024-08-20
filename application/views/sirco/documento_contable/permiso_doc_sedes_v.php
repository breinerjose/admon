<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<title>Documentos Por Sedes</title>
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_page.css" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_table.css"/>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<link rel="stylesheet" href="/res/chosen/chosen.css" />
<script type="text/javascript" src="/res/jquery/jquery-1.8.2.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/res/js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/res/js/fnReloadAjax.js"></script>
<script type="text/javascript" src="/res/js/blockUI.js"></script>
 <script type="application/javascript" src="/res/chosen/chosen.jquery.js"></script>
<script type="text/javascript">

	var oTable;
	function dtl(doc,sede){
		oTable = $('#tabpersed').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"sScrollY" : '230px',
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/sirco/doc_sedes_c/llenar_tabla/"+doc+"/"+sede,
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}
	
	function cerrar(datos){
		$('#seleccionar').dialog('close');
		var valores='';
		for(var i=0; i<datos.length; i++){
			if(i==0){ valores = datos[i].value;	 }
			else{
				valores += ","+datos[i].value;		
			}
		}
		$('#documentos').val(valores);		
		return false;	
	}
	
	function combo_documento(){
		$.post('/sirco/doc_contable_c/documentos',function(resp){
			$('#documento').append('<option value=""></option>');
			$.each(resp,function(i,v){
				$('#documento').append('<option value="'+v.coddoc+'">'+v.nomdoc+'</option>');
			});	
		},'json');		
	}


$(document).ready(function() {
	dtl('','');
	
	$("#coddoc").chosen({no_results_text: "Resultado no encontrado!"});
		$.post('/sirco/documento_contable_c/selectdocumentos',function(resp){
		$.each(resp,function(i,v){
			$('#coddoc').append('<option value="'+v.coddoc+'">'+v.coddoc+' - '+v.nomdoc+'</option>');
		});	$('#coddoc').trigger("chosen:updated");
	},'json');
	
	$("#codsed").chosen({no_results_text: "Resultado no encontrado!"});
		$.post('/sirco/sedes_c/selectsedes',function(resp){
		$.each(resp,function(i,v){
			$('#codsed').append('<option value="'+v.codsed+'">'+v.codsed+' - '+v.nomsed+'</option>');
		});	$('#codsed').trigger("chosen:updated");
	},'json'); 
		
	$('#usuarios').val('');
	
		
	
	//COMPLETE USUARIOS
	$.post('/sirco/doc_sedes_c/usuarios',function(resp){
		var datos = [''];
			
		for ( var i = 0; i < resp.length; i = i + 1 ) {
			datos.push(resp[i].nriper+'--'+resp[i].nomtrc);	
		}
		
		$( "#usuarios" ).autocomplete({
		  source: datos
		});
	},'json');
	
	$('#asignar').button();
	
	$('#sedes').on('change',function(){
		sede = $(this).val();
		$('#documento').empty();
		combo_documento();
	});
	
	$('#documento').on('change',function(){
		sede = $('#sedes').val();
		doc = $(this).val();	
		if(sede!='' && sede!=null && doc!='' && doc!=null){
			dtl(doc,sede);
		}else{
			alert('Para llenar tabla debe seleccionar sede y usuario');	
		}
	});
	
	$('#asignar').on('click',function(){
		sede = $('#sedes').val();
		user = $('#usuarios').val();
		doc = $('#documento').val();
		if(sede!='' && sede!=null && doc!='' && doc!=null && user!=''){
		  $.post('/sirco/doc_sedes_c/asignar_documentos',{'sede':sede,'user':user,'doc':doc},function(resp){
				if(resp==1){
					dtl(doc,sede);
					$('#usuarios').val('');
				}else{
					alert('Ocurrio un problema, intente m&aacute;s tarde');		
				}
		  },'json');
		}else{
			alert('No puede dejar vacio los campos Sede, Usuario y Documento.');	
		}
	});
	
	$('#tabpersed').on('click','.elim',function(){
		datos = $(this).attr('id');
		sede = $('#sedes').val();
		doc = $('#documento').val();
		$.post('/sirco/doc_sedes_c/elim_persed',{'datos':datos},function(resp){
			if(resp==1){
				dtl(doc,sede);
			}else{
				alert('Ocurrio un problema, intente m&aacute;s tarde');		
			}
		},'json');
	});
	
});
</script>
<style>
*{ margin:0; padding:0; }
body{ font-family: 'Capriola',sans-serif; }
#contenido{font-size: 12px;
    width: 870px;}
#form_usu{margin-bottom: 15px;}
#form_usu p{   margin-bottom: 15px; }
#form_usu select,#form_usu input{  border: 1px solid #ccc;
    padding: 2px;}
#form_usu .linea{  margin-right: 15px;}
#asignar{ font-size: 10px; }
#documentos{margin-left: 3px;
    width: 144px;}
#sedes{margin-left: 3px; width: 270px;}
#documento{width: 255px;}
#usuarios{margin-left: 2px;
width: 520px;}
#btnasig{margin-left: 5px;
    margin-right: 5px;}
#tabla{ width: 767px;}
#tabla tbody td{ font-size:12px; padding: 1px 5px; }
.ui-autocomplete { font-size:12px;}
</style>
</head>
<body>
<div id="contenido">
	<form id="form_usu">
	 <p>
    	 <span class="line">Sede  <select id="codsed" name="codsed"  data-placeholder="Seleccione" style="width:280px;" 
                class="chosen-select"></select></span>
                
         <span class="line"> &nbsp;&nbsp; Documento  <select id="coddoc" name="coddoc"  data-placeholder="Seleccione Tipo Documento" style="width:380px;" 
                class="chosen-select"><option value=""></option>
  		 		</select></span>
     </p>
     <p>
        <span class="linea">
        	Usuario <input type="text" id="usuarios">
        </span>
        <span class="linea">
        	<a href="javascript:void(0);" id="asignar">Asignar</a>
        </span>
     </p>
    </form>
    
    <div id="tabla">
    	<table class="display" id="tabpersed" width="100%" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th width="55%">Usuario</th>
                    <th width="40%">Documento</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
</body>
</html>