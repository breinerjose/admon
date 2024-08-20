<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vista de Certificados</title>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/res/jquery/ui/development-bundle/ui/i18n/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="/res/js/validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="/res/js/validation/localization/messages_es.js"></script>
<script type="text/javascript">
jQuery.validator.messages.required = "";
$(document).ready(function() {
    $('.actualizar').button({
		icons:{primary:"ui-icon-disk"}
	}).on('click', function(){
		if($("form#buscar").validate().form()){
			$.ajax({
				      url:"/configuraciones/configuracion_c/actualizarCorreo",
					  data: $('form#buscar').serialize(),
					  type:"POST",
					  dataType:"json",
					  success: function(resp){
						 if(resp=='1'){
							alert('Datos Actualizados Satisfactoriamente');
							setTimeout(function(){ $('#buscar').get(0).reset();}, 900);
							$('.actualizar').button ("disable");
						}else{
							alert('Error al actualizar Datos');
						}
					  }	
			 });
		}else{
			alert('Campos Pendientes por llenar');	
		}
		
	   
	});
	
	$('.buscarusu').button({
		icons:{primary:"ui-icon-search"}
	}).on('click',function(){
		var codigo = $('#numid').val();
		if(codigo!=''){
		 $.post('/pazysalvo/retirar_c/consultarusuario',{'numid':codigo},function(resp){
			  if(resp == '1'){
				 alert('No Existen datos relacionados a este documento. Verifique por favor...');
				 $('#numid, #correo, #nombres').val('');
				 $('.actualizar').button ("disable");
			  }else{
				 $('#nombres').val(resp.nombre);
				 $('.actualizar').button ("enable");
			  }
			},'json');
		}else{
			alert('Debe digitar Identificación');
			$('#numid').css('background','#ccc');	
		}
	});
	
	$('.actualizar').button ("disable");

});
</script>
<style type="text/css">
.error{border-color:#223B8D;background:#FCBE80;}
.txt, .txt1{
	width:300px;
	padding:3px;
	height:22px;
  }
 .txt1{width:430px;}
.bimg{
vertical-align:middle;
cursor:pointer;
}
#nombres{background:#F0F0F0;}
</style>
</head>
<body>
<form id="buscar" name="buscar" method="post">
    <p>
    <span>Identificación</span>n<br>
    <input type="text" id="numid" name="numid" class="txt required" placeholder="Digite Identificacion"/>
    <a href="#" class="buscarusu" title="Consultar">Buscar</a>
   </p>
	<p>
    <span>Nombres y Apellidos</span><br>
    <input type="text" id="nombres" name="nombres" class="txt1" readonly disabled />
   </p>	
   <p>
    <span>Correo Electronico</span><br>
    <input type="email" id="correo" name="correo" class="txt1 required" />
   </p>	
   <a href="#" class="actualizar">Actualizar Correo</a>
</form>
</body>
</html>