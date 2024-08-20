<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laboratorio CLinico La Castellana</title>
 <link href="../res/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="../res/bootstrap/css/bootstrap-chosen.css" rel="stylesheet">
</head>
<body>
<center><img src="http://lacastellana.em-empire.net/admin/images/logo960X130conmarco.png" class="img-responsive" alt="Laboratorio CLinico"></center>
    <div class="container">
      <form data-toggle="validator" role="form">
	   <!--Inicio //-->
		<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Tipo Identificacion:</label>
            <div class="form-group col-sm-4">
          <select data-placeholder="Choose a Country" class="chosen-select" style="width:235px" >
              <option value="CC">Cedula de Ciudadania</option>
      		  <option value="CE">Cedula de Extrangeria</option>
              <option value="RC">Registro Civil</option>
              <option value="TI">Tarjeta de Identidad</option>
            </select>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12"># Identificacion:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="id_cliente" size="30" placeholder="Numero Identifacacion"  required >
		  </div>
		  </div>
        </div>
	<!--	Fin-->
       <!-- //-->
		<div class="form-group ">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Primer Nombre:</label>
            <div class="form-group col-sm-4">
          <input type="text" class="form-control" size="30" id="primer_nombre" placeholder="Primer Nombre" required>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Primer Nombre:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="segundo_nombre" size="30" placeholder="Segundo Nombre" >
		  </div>
		  </div>
        </div>
	<!--	//-->
	<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Primer Apellido:</label>
            <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="primer_apellido" size="30" placeholder="Primer Apellido" required>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Segundo Apellido:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="segundo_nombre" size="30" placeholder="Segundo Apellido" >
		  </div>
		  </div>
        </div>
	<!--	//-->
        <div class="form-group">
          <label for="inputEmail" class="control-label">Email</label>
          <input type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="control-label">Password</label>
          <div class="form-inline row">
            <div class="form-group col-sm-6">
              <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
              <div class="help-block">Minimum of 6 characters</div>
            </div>
            <div class="form-group col-sm-6">
              <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="radio">
            <label>
              <input type="radio" name="underwear" required>
              Boxers
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="underwear" required>
              Briefs
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="terms" data-error="Before you wreck yourself" required>
              Check yourself
            </label>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
	  </div>
    <!-- JS and analytics only. -->
    <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
 <script type="text/javascript" language="javascript" src="../res/vendors/jquery/dist/jquery.js"></script>
<script src="../res/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../res/js/chosen.jquery.js" type="text/javascript"></script> 
<script src="../res/bootstrap/validador/validator.min.js"></script>
<script>
      $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
      });
    </script>
</body>
</html>