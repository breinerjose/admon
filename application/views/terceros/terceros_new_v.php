<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laboratorio CLinico La Castellana</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link href="../res/bootstrap/css/bootstrap-chosen.css" rel="stylesheet">
</head>
<body>
<center><img src="http://lacastellana.em-empire.net/admin/images/logo960X130conmarco.png" class="img-responsive" alt="Laboratorio CLinico"></center>
    <div class="container">
      <form data-toggle="validator" role="form">
	     <!--Inicio //-->
		<div class="form-group">
		<div class="form-inline row">
		<!--parte a-->
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Tipo Identificacion:</label>
            <div class="form-group col-sm-4">
          <select data-placeholder="Choose a Country" class="chosen-select" style="width:235px" name="nom_tipidentificacion" id="nom_tipidentificacion" >
              <option value="CC">Cedula de Ciudadania</option>
      		  <option value="CE">Cedula de Extrangeria</option>
              <option value="RC">Registro Civil</option>
              <option value="TI">Tarjeta de Identidad</option>
            </select>
		  <div class="help-block with-errors"></div>
		  </div>
		<!--  parte b-->
		  <label class="control-label col-md-2 col-sm-2 col-xs-12"># Identificacion:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="id_cliente" name="id_cliente" size="30" placeholder="Numero Identifacacion"  required >
		  </div>
<!--		  fin b-->
		  </div>
        </div>
	<!--	Fin-->
       <!-- //-->
		<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Primer Nombre:</label>
            <div class="form-group col-sm-4">
          <input type="text" class="form-control" size="30" id="primer_nombre" name="primer_nombre" placeholder="Primer Nombre" required>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Segundo Nombre:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" size="30" placeholder="Segundo Nombre" >
		  </div>
		  </div>
        </div>
	<!--	//-->
	<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Primer Apellido:</label>
            <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"  size="30" placeholder="Primer Apellido" required>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Segundo Apellido:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"  size="30" placeholder="Segundo Apellido" >
		  </div>
		  </div>
        </div>
	<!--	//-->
		<!--	//-->
	<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Fecha Nacimiento:</label>
            <div class="form-group col-sm-4">
         <input type="text" class="form-control" id="anio" name="anio" size="5" maxlength="4" minlength="4" placeholder="Año" 
		 data-error="Escriba los 4 digitos del Año Ejemplo 1980"required>
		 <input type="text" class="form-control" id="mes" name="mes" size="4" maxlength="2" minlength="2" placeholder="Mes" 
		 data-error="Escriba el mes con 2 Digitos Ejemplo 02, 04, etc" required>
		 <input type="text" class="form-control" id="dia" name="dia" size="4" maxlength="2" minlength="2" placeholder="Dia" 
		 data-error="Escriba el dia con 2 Digitos Ejemplo 02, 04, etc"required>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Natural De:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="naturalde" name="naturalde" size="30" placeholder="Ciudad Donde Nacio?" >
		  </div>
		  </div>
        </div>
	<!--	//-->
<!--Inicio //-->
		<div class="form-group">
		<div class="form-inline row">
		<!--parte a-->
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Estado Civil:</label>
            <div class="form-group col-sm-4">
          <select name="ecivil" id="ecivil" data-placeholder="Seleccione" class="chosen-select" style="width:235px" >
               <option value="SO">SOLTERO</option>
			   <option value="CA">CASADO</option>
			   <option value="VI">VIUDO</option>
			   <option value="UL">UNION LIBRE</option>
            </select>
		  <div class="help-block with-errors"></div>
		  </div>
		<!--  parte b-->
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Sexo:</label>
		  <div class="form-group col-sm-4">
          <select name="sexo" id="sexo" data-placeholder="Sexo" class="chosen-select" style="width:235px" >
               <option value="M">MASCULINO</option>
			   <option value="F">FEMENINO</option>
            </select>
		  </div>
<!--		  fin b-->
		  </div>
        </div>
	<!--	Fin-->
	
	
<!--Inicio //-->
		<div class="form-group">
		<div class="form-inline row">
		<!--parte a-->
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Escolaridad:</label>
            <div class="form-group col-sm-4">
          <select name="escolaridad" id="escolaridad" data-placeholder="Escolaridad" class="chosen-select" style="width:235px" >
               <option value="A">ANALFABETA</option>
			   <option value="P">PRIMARIA</option>
			   <option value="B">BACHILLER</option>
			   <option value="TCO">TECNICO</option>
			   <option value="TGO">TECNOLOGO</option>
			   <option value="U">UNIVERSITARIO</option>
            </select>
		  <div class="help-block with-errors"></div>
		  </div>
		<!--  parte b-->
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Jornada:</label>
		  <div class="form-group col-sm-4">
          <select name="jornada" id="jornada" data-placeholder="Jornada" class="chosen-select" style="width:235px" >
               <option value="M">MAÑANA</option>
			   <option value="T">TARDE</option>
			   <option value="N">NOCHE</option>
            </select>
		  </div>
<!--		  fin b-->
		  </div>
        </div>
	<!--	Fin-->
	
	<!-- //-->
		<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Eps:</label>
            <div class="form-group col-sm-4">
          <input type="text" class="form-control" size="30" id="eps" name="eps" placeholder="Escriba Eps" required>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Arl:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="arp" name="arp" size="30" placeholder="Escriba Arl" >
		  </div>
		  </div>
        </div>
	<!--	//-->
	<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Direccion:</label>
            <div class="form-group col-md-10 col-sm-10 col-xs-12">
          <input type="text" class="form-control" id="direccion"  name="direccion" size="108" placeholder="Direccion" required>
		  <div class="help-block with-errors"></div>
		  </div>
		  </div>
        </div>
	<!--	//-->
<!-- //-->
		<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Pais:</label>
            <div class="form-group col-sm-4">
          <input type="text" class="form-control" size="30" id="pais" name="pais" value="COLOMBIA" required>
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Ciudad:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="ciudad" name="ciudad"  size="30" value="CARTAGENA" placeholder="Escriba Arl" >
		  </div>
		  </div>
        </div>
	<!--	//-->	
	<!-- //-->
		<div class="form-group">
		<div class="form-inline row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Telefono Fijo:</label>
            <div class="form-group col-sm-4">
          <input type="text" class="form-control" size="30" id="telefono_fijo" name="telefono_fijo" maxlength="8" minlength="7" >
		  <div class="help-block with-errors"></div>
		  </div>
		  <label class="control-label col-md-2 col-sm-2 col-xs-12">Celular:</label>
		  <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="telefono_movil" name="telefono_movil"  size="30" maxlength="10" minlength="10" 		
		  required >
		  </div>
		  </div>
        </div>
	<!--	//-->
					<!--  //-->
  
        <div class="form-group">
		<div class="form-inline row">
           <label class="control-label col-md-2 col-sm-2 col-xs-12">E-mai:</label>
		   <div class="form-group col-sm-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="Este Email es Invalido" 
		  size="108" >
		  </div>
          <div class="help-block with-errors"></div>
		  </div>
        </div>
       
        <div class="form-group">
          <center><button type="submit" class="btn btn-primary">Guardar</button></center>
        </div>
      </form>
	  </div>
    <!-- JS and analytics only. -->
    <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/chosen.jquery.js" type="text/javascript"></script> 
<script src="../res/bootstrap/validador/validator.min.js"></script>
<script>
      $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
      });
    </script>
<script>
      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;
		
        if (submit){
          <!--this.submit();-->
		
	  var id_cliente = $("input[name=id_cliente]").val();
	  var nom_tipidentificacion=$('#nom_tipidentificacion').val();
	  var primer_nombre = $("input[name=primer_nombre]").val().toUpperCase();
	  var segundo_nombre = $("input[name=segundo_nombre]").val().toUpperCase();
	  var primer_apellido = $("input[name=primer_apellido]").val().toUpperCase();
	  var segundo_apellido = $("input[name=segundo_apellido]").val().toUpperCase();
   	  var telefono_fijo = $("input[name=telefono_fijo]").val();
      var telefono_movil = $("input[name=telefono_movil]").val();
      var direccion = $("input[name=direccion]").val();
      var email = $("input[name=email]").val();
      var sexo = $('#sexo').val();
      var pais = $("input[name=pais]").val();
   	  var anio = $("input[name=anio]").val();
      var mes = $("input[name=mes]").val();
      var dia = $("input[name=dia]").val();
      var naturalde = $("input[name=naturalde]").val();
      var ecivil = $('#ecivil').val();
      var escolaridad = $('#escolaridad').val();
      var jornada = $('#jornada').val();
      var eps = $("input[name=eps]").val();
      var arp = $("input[name=arp]").val();
      var ciudad = $("input[name=ciudad]").val();
	  var nombre = primer_nombre+' '+segundo_nombre+' '+primer_apellido+' '+segundo_apellido;
	  var fechanac = anio+'-'+mes+'-'+dia;
	  
	  
      $.ajax({
      url:   '/Terceros_c/insert_tercero/',
      data: {id_cliente,nom_tipidentificacion,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,telefono_fijo,telefono_movil,
	  direccion,email,sexo,pais,anio,mes,dia,naturalde,ecivil,escolaridad,jornada,eps,arp,ciudad,fechanac,nombre},
        type:  'post',
        success:  function (response) {
		alert('Registrado Correctamente');
	 window.location="http://www.lacastellana.co";
      }
  });
       }
	    return false;
      });
    </script>	
</body>
</html>