<script type="text/javascript">
$(document).ready(function() {
	
	$('a.cambiar').button({
	  icons:{primary:"ui-icon-locked"}
	}).on('click',function(){
		<!--if($("#cambiarpass").validate().form()){-->
				$.ajax({
						url:"/base/configuracion_c/cambiarPassword",
						data:$('form#cambiarpass').serialize(),
						type:"POST",
						dataType:"json",
						success: function(resp){
							if(resp == '1'){
								 alert('Actualización Exitosa');
								 setTimeout(function(){ $('#cambiarpass').get(0).reset();}, 900);
								 $('.cambiar').button ("disable");
							 }else{alert('Error al actualizar Contraseña');}
						}
				});
		 /*}else{
			alert('Hay campos pendientes por llenar');	
		 }	*/
	});
	
	$('.buscarusu').button({
		icons:{primary:"ui-icon-search"}
	}).on('click',function(){
		var num = $('#numid').val();
		if(num != ''){
	   <!--$.post('../base/configuracion_c/consultarusuario',{'numid':num},function(resp){-->
	   $.post('/base/configuracion_c/consultarusuario',{'numid':num},function(resp){
	   		if(resp!='1'){
				$('#nomtrc').val(resp.nomtrc);
				 $('.cambiar').button ("enable");
			}else{
			    alert('No existes datos para este usuario');
				$('#nomtrc','#numid').val('');
				 $('.cambiar').button ("disable");
			}
	   },'json');
		}else{alert('Debe digitar Un codigo')}
	});
	
	$('.cambiar').button ("disable");
   /* */
});
</script>
<style type="text/css">
.nm{font-weight:bold;color:#000;}
.error{border-color:#223B8D;background:#FCBE80;}
#cambiarpass p{display:inline-block;margin:0.25em; font-size:13px;}
label.par{font-size:15px;font-weight:bold;color:#223B8D;}
label.error{background:none;color:#900;}
.txt, .txt1, .txt2{font-size:12px;padding:3px;width:370px;height:22px;}
.txt1{background:#EFEFEF;}.txt2{width:320px;}
</style>
</head>

<body>
<fieldset>
	<legend class="nm"><b>Parametross</b></legend>
    <form id="cambiarpass" name="cambiarpass" method="post">
    	<p>
    		<label class="par">Numero Identificación</label><br>
    		<input type="text" id="numid" name="numid" class="txt2 required" />
            <a href="#" class="buscarusu" title="Consultar">Buscar</a>
        </p>
        <p>
    		<label class="par">Nombres Y Apellidos</label><br>
    		<input type="text" id="nomtrc" name="nomtrc" class="txt1" readonly disabled/>
        </p>
        <p>
    		<label class="par">Nueva Contraseña</label><br>
    		<input type="password" id="rnueva" name="rnueva" class="txt required" minlength="6" />
        </p>
        <p>
        	<a href="#" class="cambiar">Actualizar Contraseña</a>
        </p>
    </form>
</fieldset>
</body>
</html>