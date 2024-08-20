<form action="" method="POST" class="form-horizontal"  id="upd_form<?php echo $ale;?>"  name="upd_form<?php echo $ale;?>" role="form">
 <div class="row">	
 <div class="col-md-12">
  <div class="item form-group">
	   <center>
         <center><h2 class="text-primary">INFORMACION PERSONAL</h2></center>
       </center>
	   	<hr /> 
       </div>
 </div>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading"> Información Basica</div>
  <div class="panel-body">
  
  <div class="row">
	 <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">1er. Apellido:</label>
		<input type="text" class="form-control required" name="apeuno" id="apeuno">
       </div>
     </div>
	 
	 <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">2do. Apellido:</label>
		<input type="text" class="form-control" name="apedos" id="apedos">
       </div>
     </div>
	 
	 <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">1er. Nombre:</label>
		<input type="text" class="form-control required" name="nomuno" id="nomuno">
       </div>
     </div>
	 
	 <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">2do. Nombre:</label>
		<input type="text" class="form-control" name="nomdos" id="nomdos">
       </div>
     </div>
</div>

<div class="row">

 	<div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Tipo Identidad:</label>
		<select class="chosen-select required validar"  data-placeholder="Seleccione"  name="tipide" id="tipide">
        <option></option>
		<option value="RC">Registro Civil</option>
		<option value="TI">Tarjeta de Identidad</option>
		<option value="CC">Cedula de Ciudadania</option>
		<option value="CE">Cedula de Extranjeria</option>
        </select>
       </div>
     </div>
	 
	 
 	<div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Numero:</label>
		<input type="text" class="form-control required" name="nroide" id="nroide">
       </div>
     </div>
	 
	 
 	<div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Lugar de Expedición:</label>
		<input type="text" class="form-control required" name="expide" id="expide">
       </div>
     </div>
	 
	 <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Lugar de Nacimiento:</label>
		<input type="text" class="form-control required" name="lugnac" id="lugnac">
       </div>
     </div>
	
  </div>	 
  </div>
  </div>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading"> Información Complementaria</div>
  <div class="panel-body">

<div class="row">

	<div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Fecha de Nacimiento:</label>
		<input type="text" class="form-control required" name="fecnac" id="fecnac" placeholder="aaaa-mm-dd">
       </div>
     </div>
	 
	  <div class="col-md-1">
       <div class=" form-group">
        <label class="control-label">Sexo:</label>
		<select class="chosen-select required validar"  data-placeholder="Seleccione"  name="sexper" id="sexper">
        <option></option>
		<option>M</option>
		<option>F</option>
        </select>
       </div>
     </div>
	 
	 <div class="col-md-2">
       <div class=" form-group">
        <label class="control-label">Grupo Sanguineo:</label>
		<select class="chosen-select required validar"  data-placeholder="Seleccione"  name="grusan" id="grusan">
        <option></option>
		<option>O+</option>
		<option>O-</option>
		<option>A+</option>
		<option>A-</option>
		<option>B+</option>
		<option>B-</option>
		<option>AB+</option>
		<option>AB-</option>
        </select>
       </div>
     </div>
	 
	 
	  <div class="col-md-6">
       <div class=" form-group">
        <label class="control-label">Profesion:</label>
		<input type="text" class="form-control required" name="profes" id="profes" >
       </div>
     </div>
	 
	  <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Estado Civil:</label>
		<select class="chosen-select required validar"  data-placeholder="Seleccione"  name="estciv" id="estciv">
        <option value=""></option>
		<option>CASADO</option>
		<option>SOLTERO/A</option>
		<option>COMPROMETIDO/A</option>
		<option>DIVORCIADO/A</option>
		<option>VIUDO/A</option>
        </select> 
       </div>
     </div>
	 
	  <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label"># Hijos:</label>
		<input type="text" class="form-control" name="nrohij" id="nrohij" >
       </div>
     </div>
	 
 	<div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Direccion Residencial:</label>
		<input type="text" class="form-control" name="dirper" id="dirper" >
       </div>
     </div>
	 
	 <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Ciudad:</label>
		<input type="text" class="form-control" name="ciuper" id="ciuper" >
       </div>
     </div>
	 
	  <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Telefono:</label>
        <input type="text" class="form-control" name="telper" id="telper" />
       </div>
     </div>
	 
	  <div class="col-md-3">
       <div class=" form-group">
        <label class="control-label">Celular:</label>
		<input type="text" class="form-control" name="celper" id="celper" >
       </div>
     </div>
	 
	  <div class="col-md-6">
       <div class=" form-group">
        <label class="control-label">Email:</label>
		<input type="text" class="form-control" name="emlper" id="emlper" >
       </div>
     </div>


<div class="row">
 	<div class="col-md-6">
       <div class=" form-group">
        <label class="control-label">Nombre del Conyugue:</label>
		<input type="text" class="form-control" name="nomcon" id="nomcon" >
       </div>
     </div>
	 
	 <div class="col-md-6">
       <div class=" form-group">
        <label class="control-label">Con quien Vive:</label>
		<input type="text" class="form-control" name="vipper" id="vipper" >
       </div>
     </div>

</div>


<div class="row">
	 <div class="col-md-6">
       <div class=" form-group">
        <label class="control-label">Empresa:</label>
		<input type="text" class="form-control" name="emptra" id="emptra" >
       </div>
     </div>
	 <div class="col-md-6">
       <div class=" form-group">
        <label class="control-label">Cargo:</label>
		<input type="text" class="form-control" name="carper" id="carper" >
       </div>
     </div>				
</div>

</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading"> Información Academica</div>
  <div class="panel-body">
  
<div class="row">
	<div class="col-md-2">
       <div class=" form-group">
        <label class="control-label">Nivel Academico:</label>
		<select class="chosen-select required validar"  data-placeholder="Seleccione"  name="examen" id="examen">
        <option value=""></option>
		<option>N/A</option>
        <option>PRIMARIA</option>
		<option>BACHILLERATO</option>
		<option>TECNICO</option>
		<option>TECNOLOGO</option>
		<option>PROFESIONAL</option>
		<option>ESPECIALIZACION</option>
		<option>MAESTRIA</option>
		<option>PHD</option>   
        </select> 
       </div>
     </div>
	 
	 <div class="col-md-4">
       <div class=" form-group">
        <label class="control-label">Titulo Ontenido</label>
		<input type="text" class="form-control" name="apeuno" id="apeuno" >
       </div>
     </div>
	 
	 <div class="col-md-2">
       <div class=" form-group">
        <label class="control-label">Nivel Academico:</label>
		<select class="chosen-select required validar"  data-placeholder="Seleccione"  name="examen" id="examen">
        <option value=""></option>
		<option>N/A</option>
        <option>PRIMARIA</option>
		<option>BACHILLERATO</option>
		<option>TECNICO</option>
		<option>TECNOLOGO</option>
		<option>PROFESIONAL</option>
		<option>ESPECIALIZACION</option>
		<option>MAESTRIA</option>
		<option>PHD</option>   
        </select> 
       </div>
     </div>
	 
	 <div class="col-md-4">
       <div class=" form-group">
        <label class="control-label">Titulo Ontenido</label>
		<input type="text" class="form-control" name="apeuno" id="apeuno" >
       </div>
     </div>
	 
	</div>
	</div>
	</div>
	</div>
	</div>

<div class="col-md-12">
       <div class="item form-group">
       <center>
	   <button type="button" id="update_form<?php echo $ale;?>" style="margin-top: 5px;" class="btn btn-success">
                            <i class="fa fa-save"></i> Generar Orden</button>
       </center>
       </div>
     </div>
</form>	 
<script type="text/javascript">
$(document).ready(function(){
$('.chosen-select').chosen({no_results_text: "Resultado no encontrado!"});

$('#regi<?php echo $ale; ?>').click(function(){
                    var data = $('#registrar').serialize();
                    if ($('#registrar').validationEngine('validate', {promptPosition: "topLeft", scroll: false})) {
					var callback = function (resp) {
                        new PNotify({
                            title: resp.title,
                            text: resp.msg,
                            type: resp.type,
                            styling: 'bootstrap3'
                        });
                        if (resp.type == 'success') {
                           $('form#registrar').get(0).reset();
                        }
                    };
                    ajaxGenerico('/Doc_equivalente_c/registrar', data, callback);
					   }
					});
});
</script>