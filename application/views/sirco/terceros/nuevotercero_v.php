<style type="text/css">
	.pjur{display:none;}
</style>
<div class="row">
<form id="registro" name="registro" method="post" class="form-horizontal"  role="form">

<div class="col-md-2">
	  <label for="codtrc">Numero de Identificacion</label>
</div>
<div class="col-md-4">
	  <input type="text" id="codtrc"  name="codtrc" class="form-control" onkeypress="return validar_texto(event)"/>
</div>
<div class="clearfix"></div>

<div class="form-group">
<div class="col-md-2">
<label for="tiptrc">Tipo de Persona:</label>
</div>
<div class="col-md-4">
  <select class="chosen-select"  data-placeholder="Seleccione Tipo Indentificacion"  name="tiptrc" id="tiptrc">
    <option value=""></option>                                   
  </select> 
</div>

<div class="col-md-2">
<label for="tpodoc">Tipo de Identificacion:</label>
</div>
<div class="col-md-4">
  <select class="chosen-select"  data-placeholder="Seleccione Tipo Indentificacion"  name="tpodoc" id="tpodoc">                                 
  </select> 
</div>
</div>

<div class="col-md-2">
<label class="pnat" for="nomuno">Primer Nombre</label>
</div>
<div class="col-md-4">
<input type="text" id="nomuno" name="nomuno" class="form-control pnat"/>
</div>

<div class="col-md-2">
<label class="pnat" for="nomdos">Segundo Nombre</label>
</div>
<div class="col-md-4">
<input type="text" id="nomdos" name="nomdos" class="form-control pnat" />
</div>

<div class="col-md-2">
<label class="pnat" for="apeuno">Primer Apellido</label>
</div>
<div class="col-md-4">
<input type="text" id="apeuno" name="apeuno" class="form-control pnat"/>
</div>

<div class="col-md-2">
<label class="pnat" for="apedos">Segundo Apellido</label>
</div>
<div class="col-md-4">
<input type="text" id="apedos" name="apedos" class="form-control pnat" />
</div>

<div class="col-md-2">
<label class="pjur" for="nomtrc">Nombre</label>
</div>
<div class="col-md-10">
<input type="text" id="nomtrc" name="nomtrc" class="form-control pjur" />
</div>

<div class="col-md-2">
<label class="" for="teltrc">Telefono:</label>
</div>
<div class="col-md-4">
<input type="text" id="teltrc" name="teltrc" class="form-control" />
</div>

<div class="col-md-2">
<label class="" for="celtrc">Celular:</label>
</div>
<div class="col-md-4">
<input type="text" id="celtrc" name="celtrc" class="form-control" />
</div>

<div class="col-md-2">
<label class="" for="dirtrc">Dirección:</label>
</div>
<div class="col-md-10">
<textarea id="dirtrc" name="dirtrc" class="form-control" ></textarea>
</div>

<div class="col-md-12 col-md-offset-2">
<div class="form-group">
	<button type="button" id="guardar<?php echo $ale; ?>" class="btn btn-success" ><i class="fa fa-save"></i> Guardar</button>
</div>
</div>

</form>
</div>

<script>
function validar_texto(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    
    tecla_final = String.fromCharCode(tecla);
    
    return patron.test(tecla_final);
}
</script> 
<script type="text/javascript">
	$(document).ready(function() {
        $(".chosen-select").chosen({no_results_text: "Resultado no encontrado!"});
		
		//metodo llenar select tipo de documento dependiendo del cambio
		$('#codtrc').on('blur',function(){
		  var codigo = $('#codtrc').val();
		  if(codigo!=''){
		 $.post('/sirco/terceros_c/DatosTercero',{'codtrc':codigo},function(resp){
			  if(resp == '1'){
				 //alert('No Existen datos relacionados a este documento. Verifique por favor...');
				 //$('#codtrc, #emltrc, #teltrc').val('');
			  }else{
				 $('#emltrc').val(resp.emltrc);
				 $('#teltrc').val(resp.teltrc);
				 $('#nomuno').val(resp.nomuno);
				 $('#nomdos').val(resp.nomdos);
				 $('#apeuno').val(resp.apeuno);
				 $('#apedos').val(resp.apedos);
				 $('#celtrc').val(resp.celtrc);
				 $('#dirtrc').val(resp.dirtrc);
				 $('#nomtrc').val(resp.nomtrc);
				 $('#tiptrc').val(resp.tiptrc).trigger('chosen:updated');
				 tipodocumento(resp.tiptrc, resp.tpodoc); 
				  $('#tpodoc').val(resp.tpodoc).trigger('chosen:updated');
				 if(resp.tiptrc=='1'){
				   $('.pnat').css('display','block');
				   $('.pjur').css('display','none');
				 }else{
				     $('.pnat').css('display','none');
				   $('.pjur').css('display','block');
				 }
			  }
			},'json');
		}
	});
		
		//metodo llenar select tipo persona 
		tiptrc();
		
		//metodo llenar select tipo de documento dependiendo del cambio
		$('#tiptrc').on('change',function(){
		   var codigo = $(this).val();
		   $('#tpodoc').html('');
		   if(codigo != ''){
			   if(codigo=='2'){
			     $('.pnat').css("display","none");
			     $('.pjur').css("display","block");
			   }else{
				$('.pjur').css("display","none");  
			   	$('.pnat').css("display","block");
			   }
		      tipodocumento(codigo,''); 
		   }else{
			  $('.pjur').css("display","none");  
			  $('.pnat').css("display","block"); 
		   
		   }
		});
		
	
		//guardamos
		$('#guardar<?php echo $ale; ?>').click(function(){   
		var codtrc = $('#codtrc').val(); 
		var tpodoc = $('#ideper').val();
		var nomuno = $('#nomuno').val();
		var nomdos = $('#nomdos').val();
		var apeuno = $('#apeuno').val();
		var apedos = $('#apedos').val();
		var emltrc = $('#emltrc').val();
		var celtrc = $('#celtrc').val();
		var teltrc = $('#teltrc').val();
		var dirtrc = $('#dirtrc').val();
		var emltrc = $('#emltrc').val();
		var nomtrc = $('#nomtrc').val();
		
		
	 $.ajax({
				      url:"/sirco/terceros_c/insertarcnttrc",
					  data: $('form#registro').serialize(),
					  type:"POST",
					  dataType:"json",
					success: function(resp){
							if(resp == '1'){
								 alert('Tercero Registrado Satisfactoriamente');
								 document.getElementById("registro").reset();
							 }else{alert('Error al Registrar Persona');}
						}
				});
		
	});
/* fin comportamiento boton guardar informacion*/

    });

    function tiptrc() {
    $('#tiptrc').empty();
    $('#tiptrc').html('<option value=""></option');  
    $.post('/sirco/terceros_c/selectTipoper', function (resp) {
        $.each(resp, function (i, v) {
            $('#tiptrc').append('<option value="' + v.tipo + '">' + v.tipo + ' - ' + v.nombre + '</option>');
        });
        $('#tiptrc').trigger("chosen:updated");
    }, 'json');
	}

	 function tipodocumento(codigo,cod1) {
    $('#tpodoc').empty();
    $('#tpodoc').html('<option value=""></option');  
    $.post('/sirco/terceros_c/selectTipodoc',{'codper':codigo}, function (resp) {
        $.each(resp, function (i, v) {
            $('#tpodoc').append('<option value="' + v.tipo + '">' + v.tipo + ' - ' + v.nombre + '</option>');
        });
        $("#tpodoc [value='"+cod1+"']").attr("selected","selected");
        $('#tpodoc').trigger("chosen:updated");
    }, 'json');
}


</script>