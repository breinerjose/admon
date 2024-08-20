       <div class="container">
       <div class="row">
       <form class="form-horizontal"  id="cabecera" name="cabecera">
        <div class="col-md-3">
            <label>Sede:</label>
            <select id="codsed" name="codsed"  data-placeholder="Seleccione Sede" class="chosen-select valid_sele form-control">
            </select>
        </div>     

        <div class="col-md-5">
            <label>Tipo de Documento:</label>
            <select id="coddoc" name="coddoc"  data-placeholder="Seleccione Tipo Documento" class="chosen-select valid_sele form-control">
                <option value=""></option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Fecha:</label>
            <input type="text" id="fchcmp" name="fchcmp" class="form-control input-sm validate[required]" readonly >
        </div>

        <div class="col-md-1"> 
            <label> Año</label>
            <input type="text" id="agnakd" name="agnakd" value="<?php echo date('Y'); ?>" class="form-control input-sm validate[required]" />
        </div>

        <div class="col-md-1"> 
            <label> Mes</label>
            <input type="text" id="mesakd" name="mesakd" value="<?php $mes = date('n'); if($mes < 7){echo "1";}else{echo "2";} ?>" 
			class="form-control input-sm validate[required]" />
        </div>
	    </form>
        <div class="col-md-12"><hr></div>
        <form class="form-horizontal"  id="form_agregar" name="form_agregar">
            <div class="col-md-1">Pcga:</div>
            <div class="col-md-2"><input type="text" id="codcta" name="codcta" class="form-control input-sm validate[required]" /> </div>
            <div class="col-md-9"> <input type="text" id="nomcta" name="nomcta" class="form-control input-sm"  readonly/></div>

            <div class="col-md-1">Niif:</div>
            <div class="col-md-2"><input type="text" id="codnif" name="codnif" class="form-control input-sm validate[required]" /> </div>
            <div class="col-md-9"> <input type="text" id="nomnif" name="nomnif" class="form-control input-sm"  readonly/></div>

            <div class="col-md-1">Item:</div>
            <div class="col-md-2"><input type="text" id="coditm" value="0000" name="coditm" class="form-control input-sm validate[required]" /> </div>
            <div class="col-md-9"> <input type="text" id="nomitm" name="nomitm"  value="ITEMS POR DEFECTO" class="form-control input-sm"  readonly/></div>

            <div class="col-md-1">Tercero:</div>
            <div class="col-md-2"><input type="text" id="codtrc" name="codtrc" class="form-control input-sm validate[required]" /> </div>
            <div class="col-md-9"><input type="text" id="nomtrc" name="nomtrc" class="form-control input-sm"  readonly/></div>

            <div class="col-md-1">Facturas:</div>

            <div class="col-md-11" style="margin-bottom: 10px;">
                <select id="abnfac" name="abnfac"  data-placeholder="Seleccione Factura" class="chosen-select form-control">
                    <option value=""></option>
                </select>
            </div>

            <div class="col-md-1">C. de costo:</div>
            <div class="col-md-2"><input type="text" id="codcts" name="codcts" value="000" class="form-control input-sm validate[required]" /> </div>
            <div class="col-md-9"><input type="text" id="nomcts" name="nomcts" value="CENTRO DE COSTO POR DEFECTO" class="form-control input-sm"  readonly/></div>

            <div class="col-md-1">Auxiliar:</div>
            <div class="col-md-2"><input type="text" id="codaux" name="codaux" value="000000" class="form-control input-sm validate[required]" /> </div>
            <div class="col-md-9"> <input type="text" id="nomaux" name="nomaux" value="AUXILIAR POR DEFECTO" class="form-control input-sm"  readonly/></div>

            <div class="col-md-8">
                <label>Concepto</label>
                <input type="text" id="detdcm" name="detdcm" value="" class="form-control input-sm validate[required]" />
            </div>
            <div class="col-md-2">
                <label>Valor:</label>
                <input type="text" id="valor" name="valor" class="form-control input-sm validate[required]"/> 
            </div>
            <div class="col-md-1" style="margin-top: 25px;"> 
                <button type="button" class="btn btn-success inline" id="credito<?php echo $ale; ?>" > Credito </button>
                <input type="hidden" id="basret" name="basret" value="" />
            </div>

            <div class="col-md-1" style="margin-top: 25px;"> 
                <button type="button" class="btn btn-primary inline" id="debito<?php echo $ale; ?>" > Debito </button>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <label class="titulo">Debito:</label>
                <div class="form-group">
                    <input name="debito" id="debito" class="form-control input-sm"  type="text" readonly="readonly" >
                </div>
            </div>

            <div class="col-md-2">
                <label class="titulo">Credito:</label>
                <div class="form-group">
                    <input name="credito" id="credito" class="form-control input-sm"  type="text" readonly="readonly" >
                </div>
            </div>

            <div class="col-md-2">
                <label class="titulo">Diferencia:</label>
                <div class="form-group">
                    <input name="saldo" id="saldo" class="form-control input-sm"  type="text" readonly="readonly" >
                </div>
            </div>

            <div class="col-md-2" align="center">
                <label class="titulo"></label>
                <div class="form-group" align="center">
                    <button type="button" class="btn btn-success" style="display: none;" id="save<?php echo $ale; ?>" ><i class="fa fa-save"></i> Guardar </button>
                </div>
            </div>

        </form>
    </div>
</div>

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
<script>
    $(document).ready(function () {
        var oTable = $('#tabconceptos').dataTable({
            "bPaginate": false,
            "ordering": true,
            "bLengthChange": true,
            "responsive": true,
            "bInfo": true,
            "bFilter": false,
            "ajax": {
                "url": "/sirco/Documento_contable_c/consultarConceptos/",
                "type": "POST",
                "data": {"ale": "<?php echo $ale; ?>"}
            }
        });
		
		totales();
		
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

        $("#abnfac").chosen({allow_single_deselect: true, no_results_text: "Resultado no encontrado!"});
        $("#coddoc,#codsed,#abnfac").chosen({no_results_text: "Resultado no encontrado!"});
        documentos();

        $.post('/sirco/Sedes_c/selectsedesdoc/', function (resp) {
            $.each(resp, function (i, v) {
                $('#codsed').append('<option value="' + v.codsed + '">' + v.codsed + ' - ' + v.nomsed + '</option>');
            });
            $('#codsed').trigger("chosen:updated");
        }, 'json');

        $('#fchcmp').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
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
                    if (resp.type == 'success'){
                        oTable.DataTable().ajax.reload();
						totales();}
                };
                ajaxGenerico('/sirco/Documento_contable_c/add_debito', data, callback);
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
                    if (resp.type == 'success'){
                        oTable.DataTable().ajax.reload();
									totales();
									}
                };
                ajaxGenerico('/sirco/Documento_contable_c/add_credito', data, callback);
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
		if (coddoc != ''){
		     var data = $('#cabecera').serialize();
            if ($('#cabecera').validationEngine('validate', {promptPosition: "topLeft", scroll: false})) {
                var callback = function (resp) {
                    new PNotify({
                        title: resp.title,
                        text: resp.msg,
                        type: resp.type,
                        styling: 'bootstrap3'
                    });
                    if (resp.type == 'success'){
                        oTable.DataTable().ajax.reload();
						$('#save<?php echo $ale; ?>').css('display', 'none');
						totales();
						facturas(666);
						documentos();
						$("#form_agregar")[0].reset();
						$("#cabecera")[0].reset();
						window.open('/sirco/Imprimir_doc_c/imprime_doc_laser/'+resp.datos,'_blank');
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
			}else{
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
				totales();
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
                if (resp.type == 'success'){ oTable.DataTable().ajax.reload(); }
				  totales();
            };
            ajaxGenerico('/sirco/Documento_contable_c/eliminar/', {"oid": $(this).attr('oid')}, callback);
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

    function totales(){
        $.ajax({
            url: '/sirco/Documento_contable_c/totales',
            type: 'POST',
            dataType: 'JSON',
            data: {},
            success: function (ans) {
                $('#debito').val(ans.a.debito);
                $('#debito').trigger('blur');
                $('#credito').val(ans.a.credito);
                $('#credito').trigger('blur');
                $('#saldo').val(ans.a.saldo);
                $('#saldo').trigger('blur');
                if (ans.a.saldo == 0) {
                    $('#save<?php echo $ale; ?>').css('display', 'inline-block');
                }
                else {
                    $('#save<?php echo $ale; ?>').css('display', 'none');
                }
            }
        });
    }
	
	function documentos(){
	 $.post('/sirco/Cntdoc_c/selectdocumentos', function (resp) {
            $.each(resp, function (i, v) {
                $('#coddoc').append('<option value="' + v.coddoc + '">' + v.coddoc + ' - ' + v.nomdoc + '</option>');
            });
            $('#coddoc').trigger("chosen:updated");
        }, 'json');
	}
</script>