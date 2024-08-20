<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-primary">
                <div class="panel-heading">Impresión Estados Financieros</div>
                <div class="panel-body">

                    <div class="container">
                      <form class="form-horizontal" role="form" id="datos">

                           <div class="form-group">
						   <label style="text-align:left" for="fecini" class="col-lg-2 col-md-2 control-label">Fecha Inicio</label>
                            <div class="col-md-4">
									 <input class="form-control input-sm fecha" id="fecini" name="fecini" type="text" readonly >
                                </div>

							<label style="text-align:left" for="fecfin" class="col-lg-2 col-md-2 control-label">Fecha Fin</label>
                            <div class="col-md-4">
                                    <input class="form-control input-sm fecha" id="fecfin" name="fecfin" type="text" readonly >
                                </div>
                            </div>

                                <div class="form-group">
                            <div class="col-md-6">
                                    <label class="control-label">Web&nbsp </label> <input type="radio" class="control-label" name="tipo_informe" value="web" checked >&nbsp&nbsp
                                    <label class="control-label">Pdf </label> <input class="control-label" type="radio" name="tipo_informe"  value="pdf" >&nbsp&nbsp
                                    <label class="control-label">Excel</label> <input class="control-label" type="radio" name="tipo_informe" value="excel" >&nbsp&nbsp
                                </div> 


                            <div class="col-md-6">
                                    <label>Analisis Vertical&nbsp;</label>  <input type="checkbox" id="vertical" name="checkk" class="chkkk" value="1" >
                                    <label>&nbsp;&nbsp;Comparativo&nbsp;</label><input name="check" type="checkbox" class="chkk" id="comparativo" value="1" checked="checked"> 
                                </div>
                            </div>

                                 <div class="form-group">
							<div class="col-md-6">
                           
                                    <label>Mostrar Cuenta en Cero&nbsp</label><input type="checkbox" id="cero" name="cero" class="chkk" value="1" >
                                </div>
                  

                            <div class="col-md-6">

                                     <label>Mostrar Numero de la Cuenta</label> <input type="checkbox" id="cuenta" name="cuenta" class="chkk" value="1">
                                </div>
                            </div>

                            <div class="form-group">
							<label style="text-align:left" for="tipobalance" class="col-lg-3 col-md-3 control-label"> Tipo Balance:</label>
                            <div class="col-md-9">
                                    <select id="tipobalance" class="chosen-select" data-placeholder="Seleccione Tipo de Balance">
                                    <option value=""></option>
                                    </select>
                                </div>
                            </div>
							
							<div class="form-group">
							<label style="text-align:left" for="nivel" class="col-lg-3 col-md-3 control-label"> Nivel:</label>
                            <div class="col-md-9">
                                    <select name="nivel" class="chosen-select" data-placeholder="Seleccione Nivel">
									<option value=""></option>
                                    <option value="azul">Auxiliar</option>
                                    <option value="amarillo">Sub Grupo</option>
                                    <option value="blanco">Grupo</option>
			                        </select>
                             </div>
							</div> 

                            <div class="form-group">
							<label style="text-align:left" for="nivel" class="col-lg-3 col-md-3 control-label"> Centro de Costo:</label>
                            <div class="col-md-9">
                                    <select id="centro" class="chosen-select" data-placeholder="Seleccione Centro de Costo">
    			            <option value=""></option>
                                    </select>
                            </div> 

							<label style="text-align:left" for="nivel" class="col-lg-3 col-md-3 control-label"> Sede:</label>
                            <div class="col-md-9" style="margin-top: 10px;">
                                      <select id="codsed" name="codsed"  data-placeholder="Seleccione" class="chosen-select">
									  </select> 
                                  </div>
                             </div>
							 
							        <div class="form-group">
							 <label style="text-align:left" for="nivel" class="col-lg-3 col-md-3 control-label"> Contabilidad:</label>
							  <div class="col-md-9" >
                                <label>Local&nbsp;</label><input type="radio" name="tipo"  value="Local" >&nbsp;&nbsp;&nbsp;
                                      <label>Niif&nbsp;</label><input type="radio" name="tipo" value="Niif" checked >
                                  </div>
								  </div>
								  <hr />

                                <div class="form-group">
								<div class="col-md-12">
                                   <button type="button" id="imprimir" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir </button>
                                </div>
                            </div> 
                            
                        </form >    
                    </div>


                </div>
                  </div> 
              </div >
         </div > 
     </div>
    <script type="text/javascript">
function generar_reporte(tbalance,nbalance,aniouno,mesuno,nommesuno,diauno,aniodos,mesdos,nommesdos,diados,tipo_informe,vertical,comparativo,c_costo,n_costo,tipo){
	window.open("/sirco/Estadosf_c/estadofinanciero/"+tbalance+"/"+nbalance+"/"+aniouno+"/"+mesuno+"/"+nommesuno+"/"+diauno+"/"+aniodos+"/"+mesdos+"/"+nommesdos+"/"+diados+"/"+tipo_informe+"/"+vertical+"/"+comparativo+"/"+c_costo+"/"+n_costo+"/"+tipo, "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1100, height=600");
}

$(document).ready(function(e) {
	$('#capa_fecini').hide();
	$('#capa_vertical').hide(); 
	
	
	$("#codsed").chosen({no_results_text: "Resultado no encontrado!"});
				$.post('/sirco/Sedes_c/selectsedes',function(resp){
				$.each(resp,function(i,v){
					$('#codsed').append('<option value="'+v.codsed+'">'+v.codsed+' - '+v.nomsed+'</option>');
				});	$('#codsed').trigger("chosen:updated");
			},'json'); 
			
	$(".chosen-select").chosen({allow_single_deselect: true});
	
	$('.fecha').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true	
	});		
	
	<!--$("#comparativo,#vertical").prop("checked", false);-->
	$('#centro').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) { });
	$('#tipobalance').chosen({allow_single_deselect:true,no_results_text: "Resultado no encontrado!"}).on("change", function (evt, params) { });
	
	//SEDES
    cargarCentro();
    tipobalance();
	
		$('#imprimir').button().on('click',function(e){
	 	
		e.preventDefault();
		
		var fecini = $('#fecini').val();
		var fecfin = $('#fecfin').val();
		if(fecini != '' && fecfin == ''){var fecfin = fecini;}  
		if(fecini == ''){var fecini='n'; var fecfin='n';}
		
		var balance=$('#tipobalance').val();
		var nombre=$('#tipobalance option:selected').text();
		var tipo = $('input:radio[name="tipo"]:checked').val();
		var tipo_informe = $('input:radio[name="tipo_informe"]:checked').val();
		if($('#cero').is(':checked')){var cero = 1;}else{ var cero = 0;}
		if($('#cuenta').is(':checked')){var cuenta = 1;}else{ var cuenta = 0;}
		if($('#vertical').is(':checked')){ var vertical = 1; }else{ var vertical = 0; }
		if($('#comparativo').is(':checked')){ var comparativo = 1; }
		
		if(tipo =='Local'){
		
		alert('Informes PCGA Por favor consultarlos en Sirco Escritorio');
		
		}
		//Informes Niif
		else{
			//Balance General
			if(balance == '0007'){
				if (comparativo == 1){
				if(fecini != '0' && fecfin != '0'){
		        window.open('/sirco/Estados_balance_n_c/balance_niif_compar/'+fecini+'/'+fecfin+'/'+balance+'/'+nombre+'/'+tipo_informe+'/'+vertical)
		        }else{alert ('Debe Seleccionar las Dos Fechas');}
				}else if(fecfin != ''){window.open('/sirco/Estados_balance_n_c/balance_niif/'+fecfin+'/'+balance+'/'+nombre+'/'+tipo_informe)}
				else{ alert ('Debe Escojer Fecha'); }
				}
			//ESTADO SITUACION FINANCIERA
			if(balance == '0008' || balance == '0013'){
				if (comparativo == 1){
				if(fecini != '0' && fecfin != '0'){
		        window.open('/sirco/Estados_financieros_n_c/imprimirReporte_compar/'+fecfin+'/'+fecini+'/'+balance+'/'+nombre+'/'+cero+'/'+cuenta+'/'+tipo_informe)
		        }else{alert ('Debe Seleccionar las Dos Fechas');}
				}else if(fecfin != ''){window.open('/sirco/Estados_financieros_n_c/imprimirReporte/'+fecfin+'/'+balance+'/'+nombre)}
				else{ alert ('Debe Escojer Fecha'); }
				}
			
			if(balance == '0009'){
				if (comparativo == 1){
				if(fecini != 'n' && fecfin != 'n' && fecini != fecfin){
		        window.open('/sirco/Estados_resultados_n_c/estadoderesultadointegral/'+fecfin+'/'+fecini+'/'+balance+'/'+nombre+'/'+comparativo+'/'+tipo_informe)
		        }else{alert ('Debe Escojer Las Dos Fechas');}
				}else if(fecfin != '') window.open('/sirco/Estados_resultados_n_c/estadoderesultadointegral/'+fecfin+'/'+fecini+'/'+balance+'/'+nombre+'/'+comparativo+'/'+tipo_informe)
				else{ alert ('Debe Escojer Fecha'); }}			
		
					//BALANCE DE PRUEBA - NIIF
			if(balance == '0010'){				
				if (comparativo == 1){
				if(fecini != 'n' && fecfin != 'n' && fecini != fecfin){
		        window.open('/sirco/Estados_balance_n_c/balance_prueba_niif_compar/'+fecini+'/'+fecfin+'/'+balance+'/'+nombre+'/'+tipo_informe)
		        }else{alert ('Debe Seleccionar las Dos Fechas');}
				}else if(fecfin != '')window.open('/sirco/Estados_balance_n_c/balance_prueba_niif/'+fecfin+'/'+balance+'/'+nombre+'/'+tipo_informe)
				else{ alert ('Este Escojer Fecha'); }}
				
			
			//BALANCE DE PRUEBA - NIIF
			if(balance == '0011'){
				if (comparativo == 1){
				if(fecini != 'n' && fecfin != 'n' && fecini != fecfin){
		        window.open('/sirco/Estados_cambio_patrimonio_c/estadocambiopatrimonio/'+fecini+'/'+fecfin+'/'+balance+'/'+nombre+'/'+comparativo+'/'+tipo_informe)
		        }else{alert ('Debe Escojer Las Dos Fechas');}
				}else if(fecfin != '') window.open('/sirco/Estados_cambio_patrimonio_c/estadocambiopatrimonio/'+fecfin+'/'+fecini+'/'+balance+'/'+nombre+'/'+comparativo+'/'+tipo_informe)
				else{ alert ('Debe Escojer Fecha'); }}
				
			//
			if(balance == '0012'){
				if (comparativo == 1){
				if(fecini != '0' && fecfin != '0'){
		        window.open('/sirco/Estados_flujo_efectivo_c/informe/'+fecini+'/'+fecfin+'/'+balance+'/'+nombre+'/'+comparativo+'/'+tipo_informe+'/'+vertical)
		        }else{alert ('Debe Seleccionar las Dos Fechas');}
				}else if(fecfin != ''){window.open('/sirco/Estados_flujo_efectivo_c/informe/'+fecfin+'/'+fecini+'/'+balance+'/'+nombre+'/'+comparativo+'/'+tipo_informe+'/'+vertical)}
				else{ alert ('Debe Escojer Fecha'); }
				}
				
				//
			if(balance == '0014'){
				window.open('/sirco/Estados_resultados_n_c/estadoderesultadointegralcomparativo/'+fecini+'/'+fecfin+'/'+balance+'/'+nombre+'/'+tipo_informe)
				}
			
			if(balance == '0015'){
				window.open('/sirco/Razonesf_c/informe_compar/'+fecini+'/'+fecfin+'/'+balance+'/'+nombre+'/'+tipo_informe)
				}		
					
			}
	});

	
	$('#salir').button().on('click',function(e){
		
	});

		
	//metodo de checkbox
	/*$('#vertical').click(function(){
		$('#comparativo').removeAttr('checked',true);
		 $('#aniodos ,#mesdos ,#diados').attr('disabled',true).css('display','none');
	});*/
	
	$('#comparativo').click(function(){
		$('#vertical').removeAttr('checked',true);
	   if($(this).is(':checked')){
		$('#capa_fecini').show();
		$('#capa_vertical').show();
	  }else{
		$('#capa_fecini').hide();
		$('#capa_vertical').hide();
	  }
	});
	
	//
	$('input:radio[name="tipo"]').click(function(){
		$('#tipobalance').empty();
		var tipo = $('input:radio[name="tipo"]:checked').val();
		 if(tipo=='Local'){
		$("#codcta").chosen({no_results_text: "Resultado no encontrado!",allow_single_deselect: true});
		$.post('/sirco/Estados_financieros_c/combo_balance',{"tipbal":"Local"},function(resp){
		$.each(resp,function(i,v){
			$('#tipobalance').append('<option value="'+v.codbal+'">'+v.codbal+' - '+v.nombal+'</option>');
		});	$('#tipobalance').trigger("chosen:updated");
		},'json');
			
		 }else{
			$(".tipobalance").chosen({no_results_text: "Resultado no encontrado!",allow_single_deselect: true});
			$.post('/sirco/Estados_financieros_c/combo_balance',{"tipbal":"Niif"},function(resp){
			$.each(resp,function(i,v){
			$('#tipobalance').append('<option value="'+v.codbal+'">'+v.codbal+' - '+v.nombal+'</option>');
			});	$('#tipobalance').trigger("chosen:updated");
			},'json');	
			 }
	});
	//
});

function cargarCentro(){
	$.post('/sirco/Centro_c/centro_costo',function(resp){
		$.each(resp,function(i,v){
			$('#centro').append('<option value="'+v.codcts+'">'+v.codcts+' - '+v.nomcts+'</option>');
		});	
		$("#centro").trigger("chosen:updated");	
	},'json');
}


function tipobalance(){
	$.post('/sirco/Estados_financieros_c/combo_balance',{"tipbal":"Niif"},function(resp){
		$.each(resp,function(i,v){
			$('#tipobalance').append('<option value="'+v.codbal+'">'+v.codbal+' - '+v.nombal+'</option>');
		});	
		$("#tipobalance").trigger("chosen:updated");	
	},'json');
}

</script>