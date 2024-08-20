<script type="text/javascript">
function ingresos(anio,grado,grupo,tipo){
	window.open("/academico/Matricula_c/ingresos/"+anio+"/"+grado+"/"+grupo+"/"+tipo, "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1100, height=600");
}

$(document).ready(function(e) {
	$('#anio').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) { });
	$('#grado').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) { });
	$('#grupo').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) { });
	
	//SEDES
    anio();
    grado();
	grupo();
	
		$('#imprimir').button().on('click',function(e){
		e.preventDefault();
		var anio=$('#anio option:selected').text();
		var grado=$('#grado option:selected').text();
		if(grado == ''){grado='n';}
		var grupo=$('#grupo option:selected').text();
		if(grupo == ''){grupo='n';}
		
		window.open("/academico/Matricula_c/listado/"+anio+"/"+grado+"/"+grupo, "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1100, height=600");
		});
		
		$('#ingreso').button().on('click',function(e){
		e.preventDefault();
		var anio=$('#anio option:selected').text();
		var grado=$('#grado option:selected').text();
		if(grado == ''){grado='n';}
		var grupo=$('#grupo option:selected').text();
		if(grupo == ''){grupo='n';}
		ingresos(anio,grado,grupo,'A');
		});
		
		$('#ingreso_consolidado').button().on('click',function(e){
		e.preventDefault();
		var anio=$('#anio option:selected').text();
		var grado=$('#grado option:selected').text();
		if(grado == ''){grado='n';}
		var grupo=$('#grupo option:selected').text();
		if(grupo == ''){grupo='n';}
		ingresos(anio,grado,grupo,'B');
		});

	$('#cxc').button().on('click',function(e){
		e.preventDefault();
		var anio=$('#anio option:selected').text();
		var grado=$('#grado option:selected').text();
		if(grado == ''){grado='n';}
		var grupo=$('#grupo option:selected').text();
		if(grupo == ''){grupo='n';}
		
		window.open("/academico/Matricula_c/calcularcxc/"+anio+"/"+grado+"/"+grupo, "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1100, height=600");
		});
		
		$('#cxc_consolidado').button().on('click',function(e){
		e.preventDefault();
		var anio=$('#anio option:selected').text();
		var grado=$('#grado option:selected').text();
		if(grado == ''){grado='n';}
		var grupo=$('#grupo option:selected').text();
		if(grupo == ''){grupo='n';}
		
		window.open("/academico/Matricula_c/calcularcxcb/"+anio+"/"+grado+"/"+grupo, "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1100, height=600");
		});
		
	$('#salir').button().on('click',function(e){
		
	});

	//
});

function anio(){
				$.post('/academico/Matricula_c/anio',function(resp){
				$.each(resp,function(i,v){
					$('#anio').append('<option>'+v.anio+'</option>');
				});	$('#anio').trigger("chosen:updated");
			},'json'); 
		}			

function grado(){
	    $.post('/academico/Matricula_c/grado',function(resp){
		$.each(resp,function(i,v){
			$('#grado').append('<option>'+v.grado+'</option>');
		});	$("#grado").trigger("chosen:updated");	
	},'json');
}


function grupo(){
	    $.post('/academico/Matricula_c/grupo',function(resp){
		$.each(resp,function(i,v){
			$('#grupo').append('<option>'+v.grupo+'</option>');
		});$("#grupo").trigger("chosen:updated");	
	},'json');
}

</script>

<div id="capap">
   <h3>OPCIONES DE IMPRESIÓN</h3>

<div class="row">
        <div class="col-md-4">
        <div class="form-group">
		<span>Año:&nbsp;&nbsp;&nbsp;</span>
             <select id="anio" class="chosen-select" data-placeholder="Seleccione Año" style="width:300px;">
            </select>
		</div>
		</div>
		
		<div class="col-md-4">
        <div class="form-group">
		 <span>Grado:</span>
            <select id="grado" class="chosen-select" data-placeholder="Seleccione Grado" style="width:300px;">
    			<option value=""></option>
            </select>
		</div>
		</div>
		
		<div class="col-md-4">
        <div class="form-group">
		<span>Grupo:&nbsp;</span>
       <select id="grupo" data-placeholder="Seleccione Grupo" style="width:300px;"class="chosen-select">
	   <option value=""></option>
	   </select>
		</div>
		</div>
</div>
		
		<br />
<div class="row">
        <div class="col-md-2">
        <div class="form-group">
  			<a href="javascript:void(0);" id="ingreso" style="float:right;">
   			<center><img width="32px" height="32px" src="/res/icons/sirco/moneda.png" /><br/>&nbsp;&nbsp;Ingresos Detallado&nbsp;&nbsp;</center>
   			</a>
   		</div>
   		</div>
		
		<div class="col-md-2">
        <div class="form-group">
		   <a href="javascript:void(0);" id="ingreso_consolidado" style="float:right;">
   		   <center><img width="32px" height="32px" src="/res/icons/sirco/moneda.png" /><br/>&nbsp;&nbsp;Ingresos Consolidado&nbsp;&nbsp;</center>
   		   </a>
		</div>
   		</div>
		
		<div class="col-md-2">
        <div class="form-group">
			<a href="javascript:void(0);" id="cxc" style="float:right;">
  			<center><img width="32px" height="32px" src="/res/icons/sirco/recalcular.png" /><br/>&nbsp;&nbsp;CxC Detallado&nbsp;&nbsp;</center>
   			</a>
		</div>
   		</div>
		
		<div class="col-md-2">
        <div class="form-group">
			<a href="javascript:void(0);" id="cxc_consolidado" style="float:right;">
   			<center><img width="32px" height="32px" src="/res/icons/sirco/recalcular.png" /><br/>&nbsp;&nbsp;CxC Consolidado&nbsp;&nbsp;</center>
   			</a>
		</div>
   		</div>
		
		<div class="col-md-2">
        <div class="form-group">
		  <a href="javascript:void(0);" id="imprimir" style="float:right;">
   		  <center><img src="/res/icons/sirco/print-icon.png" /><br/>&nbsp;Listado Alumnos&nbsp;</center>
          </a>
		</div>
   		</div>
		
		<div class="col-md-2">
        <div class="form-group">
		
		</div>
   		</div>
 
 </div>  
