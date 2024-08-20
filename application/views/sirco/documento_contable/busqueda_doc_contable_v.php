<style>

    #buscar:hover{ cursor:pointer; }

    #bctaknp{margin-right: 32px;}

    #tab_busqueda .btnst{
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 11px;
        padding: 2px;
        list-style:none;
        font-weight:bold;
        text-decoration:none;
    }

    #tab_busqueda .editt {
        background-color: #5bc0de;
        border-color: #46b8da;
        color: #fff;
    }

    #tab_busqueda .rvtirr {
        background-color: #5cb85c;
        border-color: #4cae4c;
        color: #fff;
    }
    #tab_busqueda .vrdet {
        background-color: #f0ad4e;
        border-color: #eea236;
        color: #fff;
    }
    .imgimprimirPuntos > img{
        height:21px;
    }
    .imgimprimirLaser > img{
        height:21px;
    }
    .imgimprimirCheque > img{
        height:21px;
    }
    .ocultar{display:none;}

</style>
<script type="text/javascript">

    function cerrarDialogo() {
        $('#buscarter1').dialog('close');
        return false;
    }
	
	function conceptos(nrodoc,ale){
		var oTable = $('#tabconceptos').dataTable({
		            "bProcessing": true,
			        "bDestroy" : true,
					"bPaginate": false,
					"ordering": true,
					"bLengthChange": true,
					"responsive": true,
					"bInfo": true,
					"bFilter": false,
					"ajax": {
						"url": "/sirco/Doc_contable_editar_c/consultarConceptos/",
						"type": "POST",
						"data": {"nrodoc": nrodoc ,"ale": ale}
					}
				});
	}
		
		var ooTable;
		
	function dtl(){
            var codsedb = ($('#codsedb').val() == '' || $('#codsedb').val() == null) ? '0' : $('#codsedb').val();//sede
            var coddocb = ($('#coddocb').val() == '' || $('#coddocb').val() == null) ? '0' : $('#coddocb').val();//tipo de documt
            var codctsb = ($('#codctsb').val() == '' || $('#codctsb').val() == null) ? '0' : $('#codctsb').val();//centro
            var codctab = ($('#codctab').val() == '' || $('#codctab').val() == null) ? '0' : $('#codctab').val();//centro
            var codnifb = ($('#codnifb').val() == '' || $('#codnifb').val() == null) ? '0' : $('#codnifb').val();//centro
            var fecha1 = ($('#fecha1').val() == '') ? '0' : $('#fecha1').val();//fecha uno
            var fecha2 = ($('#fecha2').val() == '') ? '0' : $('#fecha2').val();//fecha dos
            var nrocmpb = ($('#nrocmpb').val() == '') ? '0' : $('#nrocmpb').val();//cuenta 
            var nroegr = ($('#nroegr').val() == '') ? '0' : $('#nroegr').val();//egreso nro
            var codtrcb = ($('#codtrcb').val() == '') ? '0' : $('#codtrcb').val();//codtrc
            var ale = <?php echo $ale;?>;
            
		ooTable = $('#tab_busqueda').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/sirco/busqueda_doc_contable_c/consultarDatos/"+codsedb+"/"+coddocb+"/"+codctsb+"/"+codctab+"/"+codnifb+"/"+fecha1+"/"+fecha2+"/"+nrocmpb+"/"+nroegr+"/"+codtrcb+"/"+ale,
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0] }],
		   "fnDrawCallback": function( settings ) {
			var allChecked = true;
			$('#tab_busqueda tbody tr').each(function() {
				$(this).find(':checkbox[name="revertir[]"]').each(function(){
					if (!$(this).is(':checked')) {
						allChecked = false;
						}
					});
				});
			$('#all').prop('checked', allChecked);},
		});
	}

    $(document).ready(function () {

        $('#aprobar').button({icons: {primary: 'ui-icon-check'}}).click(function () {
            var total = ooTable.$('input.revertir_all[type="checkbox"]:checked').length;
            $('#mensaje').html(' Esta seguro que desea revertir ' + total + ' Documentos?');
            $("#confirmar_i").dialog({
                resizable: false,
                dialogClass: 'hide-close',
                height: 170,
                width: 360,
                position: ['mindle'],
                modal: true,
                show: {effect: 'bounce', duration: 350, times: 3},
                hide: "explode",
                buttons: {'Aceptar': function () {
                        $('.ui-dialog').remove();

                        var sData = oTable.$('input.revertir_all[type="checkbox"]:checked').serializeArray();
                        $.ajax({
                            url: '/sirco/documento_contable_c/revertirInformacionTodos',
                            type: 'POST',
                            data: sData,
                            beforeSend: function () {
                                $.blockUI({message: '<h2><img src="/res/images/pre-loader/Rounded stripes.gif" /> Revirtiendo Documentos Por Favor Espere...</h2>'});
                            },
                            success: function (ans) {
                                if (ans.err == '1') {
                                    $.extend($.gritter.options, {
                                        position: 'bottom-left',
                                        fade_in_speed: 100,
                                        fade_out_speed: 100,
                                        time: 900
                                    });

                                    $.gritter.add({
                                        title: 'Se revirtieron ' + total + ' Documentos',
                                        image: '/res/icons/practica/ok.png',
                                        text: ' Satisfactoriamente',
                                        sticky: false//,
                                    });
                                    /*oTable.ajax.reload();*/
                                    dtl();
                                  }
                                else
                                    (ans.msg);

                            }
                        });

                    },
                    Cancelar: function () {
                        $(this).dialog("close");
                    }
                }
            });



        });

        $("#codsedb").chosen({no_results_text: "Resultado no encontrado!"});
        $.post('/sirco/sedes_c/selectsedes', function (resp) {
            $.each(resp, function (i, v) {
                $('#codsedb').append('<option value="' + v.codsed + '">' + v.codsed + ' - ' + v.nomsed + '</option>');
            });
            $('#codsedb').trigger("chosen:updated");
        }, 'json');

        $("#codctab").chosen({no_results_text: "Resultado no encontrado!", allow_single_deselect: true});
        $.post('/sirco/cuentas_c/cuentas_cta', function (resp) {
            $.each(resp, function (i, v) {
                $('#codctab').append('<option value="' + v.codcta + '">' + v.codcta + ' - ' + v.nomcta + '</option>');
            });
            $('#codctab').trigger("chosen:updated");
        }, 'json');

        $("#codnifb").chosen({no_results_text: "Resultado no encontrado!", allow_single_deselect: true});
        $.post('/sirco/cuentas_c/cuentas_nif', function (resp) {
            $.each(resp, function (i, v) {
                $('#codnifb').append('<option value="' + v.codnif + '">' + v.codnif + ' - ' + v.nomnif + '</option>');
            });
            $('#codnifb').trigger("chosen:updated");
        }, 'json');

        $("#codctsb").chosen({no_results_text: "Resultado no encontrado!", allow_single_deselect: true});
        $.post('/sirco/centro_c/centro_costo', function (resp) {
            $.each(resp, function (i, v) {
                $('#codctsb').append('<option value="' + v.codcts + '">' + v.codcts + ' - ' + v.nomcts + '</option>');
            });
            $('#codctsb').trigger("chosen:updated");
        }, 'json');

        $('#fecha1,#fecha2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $(document).on('click', '.imprimirPuntos<?php echo $ale; ?>', function () {
            var id = $(this).attr('data-print');
            window.open('/sirco/imprimir_doc_c/imprimir_doc_puntos/' + id);
        });
        $(document).on('click', '.imprimirLaser<?php echo $ale; ?>', function () {
            var id = $(this).attr('data-print');
            window.open('/sirco/imprimir_doc_c/imprime_doc_laser/' + id);
        });

        $(document).on('click', '.imprimirCheque<?php echo $ale; ?>', function () {
            var id = $(this).attr('data-print');
            window.open('/sirco/imprimir_doc_c/imprimir_doc_cheque/' + id);
        });

        //boton editar
        $('#tab_busqueda').on('click', '.edit<?php echo $ale; ?>', function () {
            var idebtn = $(this).attr('data-id');
			$("#nrodoc").val(idebtn);
            var hab = $(this).attr('data-hab');
            if (hab == 'Abierto') {
                $('#busqueda').css('display','none');
		        $('#edicion').css('display','block');
                $("#abnfac").chosen({allow_single_deselect: true, no_results_text: "Resultado no encontrado!"});
				conceptos(idebtn,<?php echo $ale; ?>);
                totales(idebtn);

            } else
                alert('El Perido contable se encuentra cerrada');
        });
				
        //revertir 1 
        $('#tab_busqueda').on('click', '.rvtir<?php echo $ale; ?>', function () {
            var codigo = $(this).attr('data-id');
             $('#revertir').modal();
             $('#revertir').find('#codigo').val(codigo);    
        });

        $('#buscar<?php echo $ale; ?>').click(function (e) {
            e.preventDefault();
            dtl( );
        });
        
        $('#revertir-btn').click(function (e) { 
         var codigo = $('#codigo').val();
                            $.ajax({
                            url: "/sirco/documento_contable_c/revertirInformacion/",
                            data: {'codigo': codigo},
                            type: "POST",
                            dataType: "json",
                            success: function (resp) {
                                   new PNotify({
                                    title: resp.title,
                                    text: resp.msg,
                                    type: resp.type,
                                    styling: 'bootstrap3'
                                });
                                if (resp.tpo == '1') {
                                    /*oTable.ajax.reload();*/
                                    dtl();
                                } 
                            }
                        });
        $('#revertir').modal('toggle');             
        });
        
        $('#all').click(function (e) {
            var chk = $(this).prop('checked');
            var currentRows = $('#tab_busqueda tbody tr');
            $.each(currentRows, function () {
                $(this).find(':checkbox[name="revertir[]"]').each(function () {
                    $(this).prop('checked', chk);
                });
            });
            var total = ooTable.$('input.revertir_all[type="checkbox"]:checked').length;
            if (total > 0) {
                var x = $('.ocultar').css('display');
                if (x == 'none') {
                    $('.ocultar').css('display', 'inline-block');
                }
            }
            else {
                $('.ocultar').css('display', 'none');
            }
        });

        $(document).on('click', '.revertir_all', function () {
            var total = ooTable.$('input.revertir_all[type="checkbox"]:checked').length;
            if (total > 0) {
                var x = $('.ocultar').css('display');
                if (x == 'none') {
                    $('.ocultar').css('display', 'inline-block');
                }
            }
            else {
                $('.ocultar').css('display', 'none');
            }
        });
        
        $("#coddocb").chosen({no_results_text: "Resultado no encontrado!"});
        $.post('/sirco/Cntdoc_c/selectdocumentos', function (resp) {
            $.each(resp, function (i, v) {
                $('#coddocb').append('<option value="' + v.coddoc + '">' + v.coddoc + ' - ' + v.nomdoc + '</option>');
            });
            $('#coddocb').trigger("chosen:updated");
        }, 'json');
        
         $('#fchcmp').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        
		  $('#atras<?php echo $ale; ?>').click(function () {
		        $('#busqueda').css('display','block');
		        $('#edicion').css('display','none');
		     });
		  
         $('#debito<?php echo $ale; ?>').click(function () {

            var data = $('#form_agregar').serialize();
            if ($('#form_agregar').validationEngine('validate', {promptPosition: "topLeft", scroll: false})) {
                var callback = function (resp) {
                    new PNotify({
                        title: resp.title,
                        text: resp.msg,
                        type: resp.type,
                        styling: 'bootstrap3'
                    });
                    if (resp.type == 'success') {
                        conceptos($('#nrodoc').val(),<?php echo $ale; ?>);
                        totales($('#nrodoc').val());
                    }
                };
                ajaxGenerico('/sirco/Doc_contable_editar_c/add_debito', data, callback);
            } else {
                new PNotify({
                    title: 'Concepto',
                    text: 'Falta Llenar Campos Obligatorios',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        });

        $('#credito<?php echo $ale; ?>').click(function () {

            var data = $('#form_agregar').serialize();
            if ($('#form_agregar').validationEngine('validate', {promptPosition: "topLeft", scroll: false})) {
                var callback = function (resp) {
                    new PNotify({
                        title: resp.title,
                        text: resp.msg,
                        type: resp.type,
                        styling: 'bootstrap3'
                    });
                    if (resp.type == 'success') {
                        conceptos($('#nrodoc').val(),<?php echo $ale; ?>);
                        totales($('#nrodoc').val());
                    }
                };
                ajaxGenerico('/sirco/Doc_contable_editar_c/add_credito', data, callback);
            } else {
                new PNotify({
                    title: 'Concepto',
                    text: 'Falta Llenar Campos Obligatorios',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        });
        
         $('#save<?php echo $ale; ?>').click(function () {
            var coddoc = $('#coddoc').val();
            if (coddoc != '') {
                var data = $('#cabecera').serialize();
                if ($('#cabecera').validationEngine('validate', {promptPosition: "topLeft", scroll: false})) {
                    var callback = function (resp) {
                        new PNotify({
                            title: resp.title,
                            text: resp.msg,
                            type: resp.type,
                            styling: 'bootstrap3'
                        });
                        if (resp.type == 'success') {
                            /*oTable.DataTable().ajax.reload();*/
                            $('#save<?php echo $ale; ?>').css('display', 'none');
                            totales();
                            facturas(666);
                            $("#form_agregar")[0].reset();
                            $("#cabecera")[0].reset();
                            window.open('/sirco/Imprimir_doc_c/imprime_doc_laser/' + resp.datos, '_blank');
                        }
                    };
                    ajaxGenerico('/sirco/Documento_contable_c/generardoc', data, callback);
                } else {
                    new PNotify({
                        title: 'Concepto',
                        text: 'Falta Llenar Campos Obligatorios',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                }
            } else {
                new PNotify({
                    title: 'Documento Contable',
                    text: 'Por Favor Seleccione el Documento Contable',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        });
        
        /*Inicio detdcm*/
        var valoranterior = '';
        $('table.display tbody').on('click', '.detdcm', function (event) {
            var valor = $(this).attr('valor');
            var oid = $(this).attr('oid');
            var campo = $(this).attr('campo');
            valoranterior = valor;
            var td = $(this).parent();
            td.html('<p><input type="text" name="" oid="' + oid + '" campo="' + campo + '" class="inpeditdetdcm" value="' + valor + '" /></p>').find('input').focus();
        }).on('keyup', 'input.inpeditdetdcm', function (event) {
            if (event.which == 13) {
                $(this).trigger('blur');
            }

        }).on('blur', 'input.inpeditdetdcm', function () {
            var valor = $(this).val();
            var oid = $(this).attr('oid');
            var campo = $(this).attr('campo');
            var td = $(this).parent().parent();
            if (valor == '' || valoranterior == valor) {
                td.html('<p class="detdcm" valor="' + valoranterior + '" oid="' + oid + '" campo="' + campo + '">' + valoranterior + '</p>');
                return false;
            }
            var respuesta = actualizarCampo(valor, oid, campo);
            if (respuesta == 1) {
                td.html('<p class="detdcm" valor="' + valor + '" campo="' + campo + '" oid="' + oid + '">' + valor + '</p>');
                 totales($('#nrodoc').val());
            } else {
                td.html('<p class="detdcm" valor="' + valoranterior + '" campo="' + campo + '" oid="' + oid + '">' + valoranterior + '</p>');
            }

        });
        /*  Fin detdcm*/

        $(document).on('click', '.borrar<?php echo $ale; ?>', function () {
            var callback = function (resp) {
                new PNotify({
                    title: resp.title,
                    text: resp.msg,
                    type: resp.type,
                    styling: 'bootstrap3'
                });
                if (resp.type == 'success') {
                   conceptos($('#nrodoc').val(),<?php echo $ale; ?>);
                }
                 totales($('#nrodoc').val());
            };
            ajaxGenerico('/sirco/Documento_contable_c/eliminar/', {"oid": $(this).attr('oid')}, callback);
        });
        
          $('.buscar').on('shown.bs.modal', function () {
            $('.buscar input[type="search"]').focus();
        });

        $('.imgbuscar').click(function () {
            cod_vista = $(this).attr('vista');
            $(cod_vista).modal();
        });


        //enter	
        $('#codcta').keyup(function (event) {
            if (event.which == 13) {
                cargarDatosCuenta($(this).val());
                $("#coditm").focus();
            }
        });

        //pierde el focus
        $('#codcta').on('change', function () {
            cargarDatosCuenta($(this).val());
            $("#coditm").focus();
        });

        //enter		
        $('#coditm').keyup(function (event) {
            if (event.which == 13) {
                cargarDatosItem($(this).val());
                $("#codtrc").focus();
            }
        });

        //pierde el focus
        $('#coditm').on('change', function () {
            cargarDatosItem($(this).val());
            $("#codtrc").focus();
        });

        //enter
        $('#codtrc').keyup(function (event) {
            if (event.which == 13) {
                cargarDatosProvedor($(this).val());
                $("#codcts").focus();
            }
        });

        //pierde el focus
        $('#codtrc').on('change', function () {
            cargarDatosProvedor($(this).val());
            $("#codcts").focus();
        });

        //enter
        $('#codcts').keyup(function (event) {
            if (event.which == 13) {
                cargarCentroCosto($(this).val());
                $("#codaux").focus();
            }
        });

        //pierde el focus
        $('#codcts').on('change', function () {
            cargarCentroCosto($(this).val());
            $("#codaux").focus();
        });

        //enter	
        $('#codaux').keyup(function (event) {
            if (event.which == 13) {
                cargarAuxiliar($(this).val());
                $("#detdcm").focus();
            }
        });

        //pierde el focus
        $('#codaux').on('change', function () {
            cargarAuxiliar($(this).val());
            $("#detdcm").focus();
        });
        
    });

    
    function cargarDatosCuenta(codcta) {
        $.post('/sirco/informe_c/cargarDatosCuenta', {"codcta": codcta}, function (ans) {
            if (ans.err == '1') {
                $('#nomcta').val(ans.nomcta);
                $('#codnif').val(ans.codnif);
                $('#nomnif').val(ans.nomnif);
                porcta = parseFloat(ans.porcta);
            } else {
                $('#codcta').val('');
                $('#nomcta').val('');
                $('#codnif').val('');
                $('#nomnif').val('');
                porcta = parseFloat(0);
            }
        }, 'JSON');
    }
    
     function cargarDatosItem(coditm) {
        $.post('/sirco/Items_c/consultarItem', {"coditm": coditm}, function (ans) {
            if (ans.err == '1') {
                $('#nomitm').val(ans.nomitm);
            } else {
                $('#coditm').val('');
                $('#nomitm').val('');
            }
        }, 'JSON');
    }
    
     function cargarDatosProvedor(codtrc) {
        $.post('/sirco/informe_c/cargarDatosProvedor', {"codtrc": codtrc}, function (ans) {
            if (ans.err == '1') {
                $('#nomtrc').val(ans.nomtrc);
                facturas(codtrc);
            } else {
                $('#codtrc').val('');
                $('#nomtrc').val('');
                $('#abnfac').empty();
            }
        }, 'JSON');
    }
    
    function cargarCentroCosto(codcts) {
        $.post('/sirco/Centro_c/consultarCentroCosto', {"codcts": codcts}, function (ans) {
            if (ans.err == '1') {
                $('#nomcts').val(ans.nombre);
            } else {
                $('#codcts').val('');
                $('#nomcts').val('');
            }
        }, 'JSON');
    }
    
    function cargarAuxiliar(codaux) {
        $.post('/sirco/Auxiliar_c/consultarAuxiliar', {"codaux": codaux}, function (ans) {
            if (ans.err == '1') {
                $('#nomaux').val(ans.nomaux);
            } else {
                $('#codaux').val('');
                $('#nomaux').val('');
            }
        }, 'JSON');
    }
    
    function facturas(codtrc) {
        $('#abnfac').empty();
        $('#abnfac').html('<option value=""></option>');
        $.ajax({
            url: '/sirco/Facturas_c/facturas_doc/',
            type: 'POST',
            data: {"codtrc": codtrc},
            dataType: 'JSON',
            success: function (ans) {
                for (i in ans) {
                    $('<option/>').val(ans[i].nrocmp).text('Factura ' + ans[i].nrocmp + ' --- Vence ' + ans[i].venqts + ' --- Dias ' + ans[i].dias + ' --- Valor ' + ans[i].total + ' --- Abono ' + ans[i].abonos + ' --- Saldo ' + ans[i].saldo).appendTo('#abnfac');
                }
                $('#abnfac').trigger('chosen:updated');
            }
        });
    }
    
    function actualizarCampo(valor, oid, campo) {
        var response;
        $.ajax({
            url: '/sirco/Documento_contable_c/actualizarCampo/',
            type: 'POST',
            dataType: 'JSON',
            data: {"valor": valor, "oid": oid, "campo": campo},
            async: false,
            success: function (ans) {
                response = ans;

            }
        });
        return response;
    }
    
     function totales(nrodoc) {
        $.ajax({
            url: '/sirco/Doc_contable_editar_c/totales',
            type: 'POST',
            dataType: 'JSON',
            data: {"nrodoc":nrodoc},
            success: function (ans) {
                $('#debito').val(ans.a.debito);
                $('#debito').trigger('blur');
                $('#credito').val(ans.a.credito);
                $('#credito').trigger('blur');
                $('#saldo').val(ans.a.saldo);
                $('#saldo').trigger('blur');
            }
        });
    }
</script>
<div id="busqueda">
<div class="container">
<div class="panel panel-primary">
            <div class="panel-heading">Busqueda de Documentos Contables</div>
            <div class="panel-body">
    <div class="row">
        <form id="datos">
            <div class="col-md-3">
                <label>Sede:</label>
                <select id="codsedb" name="codsedb"  data-placeholder="Seleccione Sede" class="chosen-select valid_sele form-control">
                </select>
            </div> 

            <div class="col-md-5">
                <label>Tipo de Documento:</label>
                <select id="coddocb" name="coddocb"  data-placeholder="Seleccione Tipo Documento" class="chosen-select valid_sele form-control">
                    <option value=""></option>
                </select>
            </div>

            <div class="col-md-2">
                <label>Numero:</label>
                <input type="text" id="nrocmpb" name="nrocmpb" class="form-control input-sm validate[required]" >
            </div>

            <div class="col-md-2">
                <label>Egreso:</label>
                <input type="text" id="nroegr" name="nroegr" size="7" maxlength="7" class="form-control input-sm" >
                <input type="hidden" id="ale" name="ale" value="<?php echo $ale; ?>" >
            </div>

            <div class="col-md-2">
                <label>Fechas Inicial:</label>
                <input type="text" class="form-control input-sm" id="fecha1" name="fecha1" readonly>
            </div>

            <div class="col-md-2">
                <label>Fechas Final:</label>
                <input class="form-control input-sm" type="text" id="fecha2" name="fecha2" readonly>
            </div>

            <div class="col-md-4">
                <label>Centro de Costo:</label>
                <select id="codctsb" name="codctsb"  data-placeholder="Seleccione Centro de Costo" class="chosen-select chosen">
                    <option value=""></option>
                </select>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Cc/Nit:</label>
                    <input type="text" name="codtrcb" id="codtrcb" class="form-control input-sm">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nomtrcb" id="nomtrcb" class="form-control input-sm">
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Cuenta Local:</label>
                    <select id="codctab" name="codctab"  data-placeholder="Seleccione Cuenta" class="chosen-select">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Cuenta Niif:</label>
                    <select id="codnifb" name="codnifb"  data-placeholder="Seleccione Cuenta"  class="chosen-select">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col-md-4" align="center">
                <label class="titulo"></label>
                <div class="form-group" align="center">
                    <button type="button" class="btn  btn-primary" id="buscar<?php echo $ale; ?>" ><i class="fa fa-search"></i> Buscar Documento </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<div id="tabla">
    <table class="display" id="tab_busqueda" width="100%" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="5%"><input type="checkbox" id="all" name="all" /></th>
                <th width="10%">Año</th>
                <th width="10%">Mes</th>
                <th width="10%">Fuente</th>
                <th width="10%">Número</th>
                <th width="15%">Fecha</th>
                <th width="15%">Sede</th>
                <th width="25%">Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>    
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="revertir">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reversión de Comprobante</h4>
      </div>
      <div class="modal-body">
        <p>Esta seguro que desea revertir registro?</p>
        <input type="text" name="codigo" id="codigo"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="revertir-btn" class="btn btn-warning">Revertir</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<div id="edicion" style="display: none;">
<div class="container">
    <form   id="cabecera" name="cabecera">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>Sede:</label>
					<input type="text" id="codsed" name="codsed" class="form-control inputb input-sm validate[required]" readonly >
                </div>
            </div>     

            <div class="col-md-2">
                <div class="form-group">
                    <label>Documento:</label>
                   <input type="text" id="coddoc" name="coddoc" class="form-control inputb input-sm validate[required]" readonly >
                </div>
            </div>
			
			 <div class="col-md-2">
                <div class="form-group">
                    <label>Numero:</label>
                   <input type="text" id="nrocmp" name="nrocmp" class="form-control inputb input-sm validate[required]" readonly >
                </div>
            </div>
			
            <div class="col-md-2">
                <div class="form-group">
                    <label>Año Con:</label>
                    <input type="text" id="agncnt" name="agncnt" class="form-control inputb input-sm validate[required]" readonly >
                </div>
            </div>
			
			<div class="col-md-2">
                <div class="form-group">
                    <label>Mes Con:</label>
                    <input type="text" id="mescnt" name="mescnt" class="form-control inputb input-sm validate[required]" readonly >
                </div>
            </div>

            <div class="col-md-1"> 
                <div class="form-group">
                    <label> Año Akd</label>
                    <input type="text" id="agnakd" name="agnakd" value="" class="form-control input-sm validate[required]" readonly />
                </div>
            </div>

            <div class="col-md-1"> 
                <div class="form-group">
                    <label> Per Akd</label>
                    <input type="text" id="mesakd" name="mesakd" value="" class="form-control input-sm validate[required]" readonly />
                </div>
            </div>
			
			  <div class="col-md-1" style="margin-top:25px;"> 
                <div class="form-group">
                    <button type="button" class="btn btn-warning inline" id="atras<?php echo $ale; ?>" > Atras </button>
                </div>
            </div>
			
        </div>
    </form>
    <div class="divider-dashed"></div>
    <form method="POST" role="form"  id="form_agregar" name="form_agregar" >
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>Cta Pcga:</label>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" id="codcta" name="codcta" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#cuentas_detallea" ><i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" id="nomcta" name="nomcta" required="required" class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>Cta Niif:</label>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" id="codnif" name="codnif" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#cuentas_niif_detallea" ><i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" id="nomnif" name="nomnif" required="required" class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>Item:</label>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" id="coditm" name="coditm"value="0000" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#cuentas_detallea" ><i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" id="nomitm" name="nomitm" value="ITEMS POR DEFECTO" required="required" class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>Tercero:</label>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" id="codtrc" name="codtrc" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#busquedatercerosa" ><i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" id="nomtrc" name="nomtrc" required="required" class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div class="row">     
            <div class="col-md-1">
                <div class="form-group"><label>Facturas:</label></div>
            </div>
            <div class="col-md-11">
                <div class="form-group">
                    <select id="abnfac" name="abnfac"  data-placeholder="Seleccione Factura" class="chosen-select form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>C. de costo:</label>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" id="codcts" name="codcts" value="000" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#centros_costosa" ><i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" id="nomcts" name="nomcts" required="required" value="CENTRO DE COSTO POR DEFECTO" class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label>Auxiliar:</label>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-md-2">
                <div class="input-group">
                    <input type="text" id="codaux" name="codaux" value="000000" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#auxiliaresa" ><i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-2 -->
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" id="nomaux" name="nomaux" value="AUXILIAR POR DEFECTO"  required="required" class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div class="row">

            <div class="col-md-1 col-sm-1 col-xs-12">
                <div class="form-group">
                    <label>Concepto:</label>
                </div>
            </div><!-- /.col-lg-6 -->

            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="detdcm" name="detdcm" value="" class="form-control input-sm validate[required]" />
                </div>
            </div>

            <div class="col-md-1 col-sm-1 col-xs-12">
                <div class="form-group">
                    <label>Valor:</label>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" id="valor" name="valor" class="form-control input-sm validate[required]"/> 
                </div>
            </div>
            <div class="col-md-1"> 
                <div class="form-group">
                    <button type="button" class="btn btn-success inline" id="credito<?php echo $ale; ?>" > Credito </button>
                    <input type="hidden" id="basret" name="basret" value="" />
                </div>
            </div>

            <div class="col-md-1"> 
                <div class="form-group">
                    <button type="button" class="btn btn-primary inline" id="debito<?php echo $ale; ?>" > Debito </button>
                </div>
            </div>
        </div><!-- /.row -->
        <div class="divider-dashed"></div>
        <div class="row">

            <div class="col-md-1">
                <div class="form-group"><label class="titulo">Debito =></label></div>
            </div>

            <div class="col-md-2">
                <div class="form-group">

                    <div class="form-group">
                        <input name="debito" id="debito" class="form-control input-sm"  type="text" readonly="readonly" >
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group"><label class="titulo">Credito =></label></div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-group">
                        <input name="credito" id="credito" class="form-control input-sm"  type="text" readonly="readonly" >
                    </div>
                </div>
            </div>

            <div class="col-md-1">
                <div class="form-group"><label class="titulo">Diferencia:</label></div>
								   <input type="text" id="nrodoc" name="nrodoc" class="hidden" >
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <div class="form-group">
                        <input name="saldo" id="saldo" class="form-control input-sm"  type="text" readonly="readonly" >
                    </div>
                </div>
            </div>

            <div class="col-md-1" align="center">
                <div class="form-group">
                     <div class="form-group" align="center">
                        <button type="button" class="btn  btn-warning" style="display: none;" id="save<?php echo $ale; ?>" ><i class="fa fa-save"></i>Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div> 
<?php include('modales_v.php'); ?>
<div class="x_content" >
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table ogrid table-striped table-bordered dt-responsive nowrap display" id="tabconceptos" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">Cuenta</th>
                        <th width="25%">Concepto</th>
                        <th width="10%">Débito</th>
                        <th width="10%">Crédito</th>
                        <th width="10%">Tercero</th>
                        <th width="10%">Factura</th>
                        <th width="5%">C. Costo</th>
                        <th width="5%">Base</th>
                        <th width="10%">codnif</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>  
</div>   
</div>