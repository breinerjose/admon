<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenidos Sysadmin AsapAseco</title>
    <link rel="shortcut icon" href="/res/images/favicon.ico"/>
    <script type="text/javascript" src="/res/js/jquery.js"></script>
    <script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function() {
		 $('.recuperar').click(function(){
		   $("#recuperar").dialog({
							resizable: false,
							height:180,
							width:420,
							position:['mindle'],
							modal: true,
						    buttons: {'Aceptar': function() {
								var cod = $('#identificacion').val();
								if(cod != ''){
									$.post('/configuraciones/usuario_c/recuperarClave',{'codusr':cod},function(resp){
						            //if(datos.err=='0')
							          $('#actpass').get(0).reset();
						              alert(resp.msg);	
									  $(this).dialog("close");					
					                 },'json');
		 						}else{
									alert('Hay campos Vacios');	
									$('#identificacion').css('background','#ccc');
								}
							},
							Cancelar: function() {$(this).dialog("close"); $("#loading").hide();}
							},
							 error: function() {$("#loading").hide();}
			});
		 });
       
    });
    </script>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background:url(/res/icons/base/diagonales_decalees.png) repeat scroll 0 0 rgba(0, 0, 0, 0);;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 20px 15px 15px 15px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 13px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		 border: 1px solid #D0D0D0;
   		 margin: 10px auto;
    	 width: 400px;
		 margin-top:180px;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	.txt{width:320px;height:25px;padding:3px;}
	.imagen{
		vertical-align:middle;
	    margin-bottom: -15px;
    	margin-left: -15px;
	 }
	#logueo{padding:0.25em;cursor:pointer;}
	.lgo{vertical-align:middle;}
	#mensg{background:#C00;color:#FFF;border-radius:5px;}
	#mensg img{vertical-align:middle;padding:0.25em;}
	#loading{ 
       display:    none;
       position:   fixed;
       z-index:    1000;
       top:        0;
       left:       0;
       height:     100%;
       width:      100%;
       background: rgba( 255, 255, 255, .8 ) url(/res/images/loader.gif) 50% 50% no-repeat;
     }
	</style>
</head>
<body>
<div id="container">
	<h1><span><img  class="imagen" src="/res/images/login.png"></span></h1>

	<div id="body">
    <form name="login" id="login" method="post" action="<?php echo base_url(); ?>configuraciones/login_c/">
		<p>
          <span><b>Usuario:</b></span><br>
          <input type="text" id="nombre" name="nombre" required class="txt" placeholder="Digite su Usuario"/>
        </p>
		<p>
         <span><b>Contraseña:</b></span><br>
          <input type="password" id="passw" name="pass" required class="txt" placeholder="Digite su Contraseña"/>
        </p>
		<p>
        <button type="submit" name="logueo" id="logueo"><img  class="lgo" src="/res/icons/base/tools_16.png"/>&nbsp;<b>Iniciar Sessión</b></button>
        </p>
        <p>
        <div id="mensg">
        	<?php
				if(isset($msg)){
					echo '<img src="/res/icons/sirco/alert.png"/>&nbsp;'.$msg; 
				}
			 ?>
        </div>
        </p>
        </form>
	</div>
	<p class="footer"><a href="#" class="recuperar">Recuperar <strong>Contraseña</strong></a></p>
</div>
<div id="recuperar" title="Recuperar Contraseña" style="display:none">
  <form id="actpass" name="actpass" method="post">
	<p>
    	<span>Documento de Identidad</span><br>
        <input type="text" id="identificacion" name="identificacion" required class="form-control" placeholder="Digite su Identificacion"/>
    </p>
    </form>
</div>
</body>
</html>