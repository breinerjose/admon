<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenidos Sysadmin</title>
    <link rel="shortcut icon" href="/res/images/favicon.ico"/>
    <link rel="stylesheet" href="/res/jquery/css/jquery-ui.custom.css"/>
    <script type="text/javascript" language="javascript" src="../res/vendors/jquery/dist/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../res/js/jquery-ui.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function() {
		 $('.recuperar').click(function(){
		   $("#recuperar").dialog({
							resizable: false,
							height:180,
							width:250,
							position: 'top',
							modal: true,
						    buttons: {'Aceptar': function() {
								var cod = $('#identificacion').val();
								if(cod != ''){
									$.post('/base/usuario_c/recuperarClave',{'codusr':cod},function(resp){
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
.panel-heading {
    padding: 5px 15px;
}

.panel-footer {
	padding: 1px 15px;
	color: #A0A0A0;
}
p.footer{
		text-align: right;
		font-size: 13px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
.profile-img {
	width: 96px;
	height: 96px;
	margin: 0 auto 10px;
	display: block;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
}
</style>
</head>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class="container" style="margin-top:40px">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Inicia sesión para continuar</strong></div>
					<div class="panel-body">
						<form role="form" method="post" name="login" id="login" action="../login_c/">
							<fieldset>
								<div class="row">
									<div class="center-block">
	               					<img class="profile-img" src="/res/images/login.png" alt="Login">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control" placeholder="Usuario" name="user" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control" placeholder="Clave" name="pass" type="password" value="">
											</div>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-lg btn-primary btn-block" value="Ingresar">
											<br>											
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<div class="panel-footer ">
						 <p class="footer"><a href="#" class="recuperar"> Recuperar Contraseña </a></p>
					</div>
                </div>
			</div>
		</div>
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