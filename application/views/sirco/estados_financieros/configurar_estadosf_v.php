<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<style>
*{ margin:0; padding:0;}
body{ font-family: 'Capriola',sans-serif; }
#buscar img{ height: 12px;
    width: 12px;}	
#contenido,#abajo{
     border: 1px solid #CCCCCC;
    font-size: 14px;
    margin: 5px auto 0;
    padding: 10px;
    width: 850px;}
	
#tip_bal{  border: 1px solid #CCCCCC;
    margin-bottom: 10px;
    margin-right: 25px;
    padding: 2px;
    width: 480px;}
#cuenta{background-color: #e8e8e8;
    border: 1px solid #cccccc;
    margin-bottom: 10px;
    margin-right: 5px;
    padding: 2px;
    width: 590px;}
	
#ubicacion,#elemen{border: 1px solid #CCCCCC; padding: 2px;}
#ubicacion{ margin-right: 24px;
width: 110px; }
#elemen{ margin-right: 20px;
    width: 320px;}

button:hover{ cursor:pointer;}

#abajo{ height: 270px;
    margin-top: 5px;
    overflow-y: scroll;}

#tabla{}
.imgelim{height: 10px;
    width: 10px;}
	
#tabla .tr{ font-size: 11px;
    height: 20px;}
</style>
<link rel="stylesheet" type="text/css" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css">
<script src="/res/js/jquery.js"></script>
<script src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="/res/jquery/jquery.blockUI.js"></script>
<script type="text/javascript">

function llenar_tabla(codigo){
	$('#tabla').load('/sirco/configurar_estadosf_c/llenar_tabla_estadosf/'+codigo);
}

function cerrar_dep(codigo,nombre){
	$('#buscaar').dialog('close');
	$.ajax({
		url: '/sirco/configurar_estadosf_c/nom_cuenta',
		type:"POST",
		data:{'codigo':codigo},		
		success: function(resp){
			$('#cuenta').val(codigo+'-'+resp);
		}	
	});
	return false;	
}

$(document).ready(function() {
	
	$('form#datos')[0].reset();
	
    $.ajax({
		url: '/sirco/configurar_estadosf_c/combo_balance',
		type:"POST",
		dataType:"json",
		success: function(e){
			$.each(e,function(i,v){
				$('#tip_bal').append('<option value="'+v.codbal+'">'+v.nombal+'</option>');
			});
		}	
	});
	
	$.ajax({
		url: '/sirco/configurar_estadosf_c/combo_elm',
		type:"POST",
		dataType:"json",
		success: function(e){
			$.each(e,function(i,v){
				$('#elemen').append('<option value="'+v.nomelm+'">'+v.nomelm+'</option>');
			});
		}	
	});
	
	$('#buscar').on('click',function(e){
		e.preventDefault();
			cod_vista = $(this).attr('vista');
			$('<iframe id="buscaar" frameborder="0" />').attr('src','/sirco/puc_c/vista_buscar/dep').dialog({
						resizable:false, 
						modal: true,
						width:850, 
						height:400, 
						position:['middle',20],
						title: 'Busqueda..',
						close : function(v, ui){							
							$(this).remove();
						}
			}).width(850-20).height(400-20);	
	});
	
	$('#tip_bal').on('change',function(){
		codigo = $(this).val();	
		if(codigo!=''){
			llenar_tabla(codigo);
		}else{
			llenar_tabla('');	
		}
	});
	
	$('#agregar').on('click',function(e){
		e.preventDefault();
		tip_bal = $('#tip_bal').val();
		tipo = $('input[name="tipo"]:checked').val();
		cuenta = $('#cuenta').val();
		elemen = $('#elemen').val();
		ubicacion = $('#ubicacion').val();
		
		if($('input[name="tipo"]:radio').is(':checked') && tip_bal!='' && cuenta!='' && ubicacion>0){
			
			$.ajax({
				url: '/sirco/configurar_estadosf_c/agregar_estadof',
				data:{'tip_bal':tip_bal,'tipo':tipo,'cuenta':cuenta,'elemen':elemen,'ubicacion':ubicacion},
				type:"POST",
				success: function(resp){
					if(resp==0){	
						llenar_tabla(tip_bal);
						// limpiar campo
						$('#cuenta').val('');
						$('#ubicacion').val('');
					}else{
						alert('Ocurrio un error, intentelo más tarde');	
					}
				}
			});
			
		}else{ 
			alert('No debe dejar campos vacios y/o la ubicación no puede ser 0');
		}
	});
	
	$('#tabla').on('click','.eliminar',function(e){
		e.preventDefault();
		codigo = $(this).attr('id');
		if(confirm('¿En realidad desea eliminar el item seleccionado?')){
			$.ajax({
				url: '/sirco/configurar_estadosf_c/eliminar_estadof',
				type:"POST",
				data:{'codigo':codigo},
				success: function(resp){
					if(resp!='error'){	
					    var codi = $('#tip_bal').val();
						llenar_tabla(codi);
					}else{
						alert('Ocurrio un error intente más tarde.');	
					}
				}	
			});
		}
	});
});
</script>
</head>
<body>
<div id="contenido">
	<div id="arriba">
    	<form id="datos">
    	<p>
        <span>Tipo de balance</span><br/>
         <select id="tip_bal"><option value=""></option></select>
        	<input name="tipo" type="radio" value="D" checked="CHECKED"> Débito
            <input type="radio" name="tipo" value="C"> Crédito
        </p>
        <p>
        <span>Cuenta</span><br/>
        <input type="text" id="cuenta" name="cuenta" readonly> 
        <button id="buscar"> <img src="/res/icons/sirco/buscar.png"></button>
        </p>
        <p>
        	<select id="elemen"><option value=""></option></select>
            Ubicación <input type="text" id="ubicacion" name="ubicacion" value="0">
            <button id="agregar"> <img src="/res/icons/sirco/save.png"> Guardar</button>
        </p>
        </form>
    </div>
</div>
<div id="abajo">
    <div id="tabla">
    	
    </div>
</div>
</body>
</html>