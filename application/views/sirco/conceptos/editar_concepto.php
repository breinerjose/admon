<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<style>
*{ margin:0; padding:0;}
body{ font-family: 'Capriola',sans-serif; }

#codknp, #tpoknp, #nomknp, #ctaknp{border: 1px solid #CCCCCC;}

#codknp{  margin-left: 6px;
    margin-right: 150px;
    padding: 1px;
    width: 75px;}

#tpoknp{
    width: 100px;}

#nomknp{ margin-top: 8px;
    padding: 3px;
    width: 467px;}

#ctaknp{   margin-bottom: 10px;
    margin-top: 8px;
    padding: 4px;
    width: 405px;}
	
.ui-menu .ui-menu-item {
	background-color: #ccc;
    border: 1px solid #ccc;
    border-radius: 2px;
	font-size:9px;
}
.ui-menu .ui-menu-item:hover { cursor:pointer;}
#load{  left: 400px;
    position: absolute;
    top: 103px;}
	
#actualizar:hover{ cursor:pointer;}
</style>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/js/funciones.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script>
$(document).ready(function() {
	
	mayuscula('input#nomknp');
    
	$('#codknp').val('<?php echo $datos[0]['codknp']; ?>');
	$('#codigo').val('<?php echo $datos[0]['codknp']; ?>');
	$('#tpoknp option[value="<?php echo trim($datos[0]['tpoknp']); ?>"]').attr('selected',true);
	$('#nomknp').val('<?php echo $datos[0]['nomknp']; ?>');
	$('#ctaknp').val('<?php echo trim($datos[0]['ctaknp'])."-".trim($datos[0]['nomcta']); ?>');
	
	$.ajax({
		url:'<?php echo base_url(); ?>sirco/conceptos_c/complet_conceptos',
		type:"POST",
		dataType:"json",
		success: function(resp){
			var datos = [''];
			
			for ( var i = 0; i < resp.length; i = i + 1 ) {
				datos.push(resp[i].codcta+'-'+resp[i].nomcta);	
			}
			
			$( "#ctaknp" ).autocomplete({
			  source: datos
			});
		}	
	});
	
	$('#actualizar').click(function(e){
		e.preventDefault();
		cod = $('#codigo').val();
		nom = $('#nomknp').val();
		tpoknp = $('#tpoknp').val();
		ctaknp = $('#ctaknp').val();
		
		if(nom!='' && tpoknp!='' && ctaknp!=''){
			$('#loader').html('<div id="load"><img src="/res/icons/sirco/ajax-loader.gif"></div>');	
			
			$.ajax({
				url:'/sirco/conceptos_c/actualizar_conceptos',
				type:"POST",
				data:{'cod':cod,'nom':nom,'tpoknp':tpoknp,'ctaknp':ctaknp},
				success: function(resp){
					$('#load').remove();
					if(resp==0){
						alert('Concepto actualizado satisfactoriamente');
						window.parent.cerrar_editar();
					}else{
						alert('Ocurrio un error, intente más tarde');
					}
				}	
			});	
			
		}else{
			alert('No puede dejar campos vacios.');	
		}
	});
});
</script>
</head>
<body>
 <div class="campos">
    <p>
        Código <input type="text" id="codknp" readonly> 
        <input type="hidden" id="codigo" readonly> 
        Tipo de Movimiento 
        <select id="tpoknp"> 
            <option value=""></option> 
            <option value="Credito">Crédito</option> 
            <option value="Debito ">Débito </option> 
        </select>
    </p>
    <p>Nombre <input type="text" name="nomknp" id="nomknp"></p>
    <p>
        Cuenta contable <input type="text" name="ctaknp" id="ctaknp">
    </p>
    <p align="center"><button id="actualizar" cod='<?php echo $datos[0]['codknp']; ?>'><img src="/res/icons/sirco/edit.png"> Actualizar</button></p>
    <div id="loader"></div>
</div>
</body>
</html>