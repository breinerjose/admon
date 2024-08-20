<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cambiar Contraseña</title>
<script type="text/javascript">
jQuery.validator.messages.required = "";jQuery.validator.messages.digits = "";
$(document).ready(function() {
	
	$('a.cambiar').button({
	  icons:{primary:"ui-icon-locked"}
	}).on('click',function(){
		if($("#cambiarpass").validate().form()){
				$.ajax({
						url:"/configuraciones/usuario_c/cambiarPassword",
						data:$('form#cambiarpass').serialize(),
						type:"POST",
						dataType:"json",
						success: function(resp){
							if(resp=='1'){
								 alert('Actualización Exitosa');
								 setTimeout(function(){ $('#cambiarpass').get(0).reset();}, 900);
							 }else{alert('Error al actualizar Contraseña');}
						}
				});
		 }else{
			alert('Hay campos pendientes por llenar');	
		 }	
	});
	
	$('#anterior').blur(function(){
		var pass = $('#anterior').val();
	   $.post('/configuraciones/usuario_c/verificarPassword',{'contr':pass},function(resp){
	   		if(resp!='1'){
				alert('La Contraseña no Coinciden');
				$('#anterior').val('');
			}
	   },'json');
	});
   /* */
});
</script>
<style type="text/css">
.nm{font-weight:bold;color:#000;}
.error{border-color:#223B8D;background:#FCBE80;}
#cambiarpass p{display:inline-block;margin:0.25em; font-size:13px;}
label.par{font-size:15px;font-weight:bold;color:#223B8D;}
label.error{background:none;color:#900;}
.txt{font-size:12px;padding:3px;width:370px;height:22px;}
</style>
</head>

<body>
<fieldset>
	<legend class="nm"><b>Parametross</b></legend>
    <form id="cambiarpass" name="cambiarpass" method="post">
    	<p>
    		<label class="par">Contraseña Anterior</label><br>
    		<input type="password" id="anterior" name="anterior" class="txt required" />
        </p>
        <p>
    		<label class="par">Nueva Contraseña</label><br>
    		<input type="password" id="nueva" name="nueva" class="txt required" minlength="6"/>
        </p>
        <p>
    		<label class="par">Repetir Contraseña</label><br>
    		<input type="password" id="rnueva" name="rnueva" class="txt required" minlength="6" equalTo="#nueva"/>
        </p>
        <p>
        	<a href="#" class="cambiar">Actualizar Contraseña</a>
        </p>
    </form>
</fieldset>
</body>
</html>