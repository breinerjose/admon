
                            <!-- AQUI VA EL CONTENIDO /-->
                            <div class="container">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="row">
                                            <form id="cabecera" name="cabecera">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Sede:</label>
                                                            <select id="codsed" name="codsed"  data-placeholder="Seleccione Sede" class="chosen-select valid_sele form-control">
                                                            </select>
                                                        </div>
                                                    </div>     

                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Tipo de Documento:</label>
                                                            <select id="coddoc" name="coddoc"  data-placeholder="Seleccione Tipo Documento" class="chosen-select valid_sele form-control">
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Fecha:</label>
                                                            <input type="text" id="fchcmp" name="fchcmp" class="form-control inputb input-sm validate[required]" readonly >
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1"> 
                                                        <div class="form-group">
                                                            <label> Año</label>
                                                            <input type="text" id="agnakd" name="agnakd" value="<?php echo date('Y'); ?>" class="form-control input-sm validate[required]" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1"> 
                                                        <div class="form-group">
                                                            <label> Per</label>
                                                            <input type="text" id="mesakd" name="mesakd" value="<?php $mes = date('n');
                                                            if ($mes < 7) {
                                                                echo "1";
                                                                } else {
                                                                    echo "2";
                                                                } ?>" 
                                                                class="form-control input-sm validate[required]" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="divider-dashed"></div>
                                                <form method="POST" role="form"  id="form_agregar" name="form_agregar" >

                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Cuenta:</label>
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
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <input type="text" id="nomnif" name="nomnif" required="required" class="form-control">
                                                            </div><!-- /input-group -->
                                                        </div><!-- /.col-lg-6 -->

                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>Tercero:</label>
                                                            </div>
                                                        </div><!-- /.col-lg-6 -->
                                                        <div class="col-md-2">
                                                            <div class="input-group">
                                                                <input type="text" id="codtrc" name="codtrc" required="required"   class="form-control">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-primary imgbuscar" id="imgbuscar" vista="#busquedatercerosa" ><i class="fa fa-search" aria-hidden="true"></i>
                                                                    </button>
                                                                </span>
                                                            </div><!-- /input-group -->
                                                        </div><!-- /.col-lg-2 -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <input type="text" id="nomtrc" name="nomtrc" required="required" class="form-control">
                                                            </div><!-- /input-group -->
                                                        </div><!-- /.col-lg-6 -->
                                                       
                                                       
                                                    </div><!-- /.row -->

                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label>C. Costo:</label>
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
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <input type="text" id="nomcts" name="nomcts" required="required" value="CENTRO DE COSTO POR DEFECTO" class="form-control">
                                                            </div><!-- /input-group -->
                                                        </div><!-- /.col-lg-6 -->
                                                    
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
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <input type="text" id="nomaux" name="nomaux" value="AUXILIAR POR DEFECTO"  required="required" class="form-control">
                                                            </div><!-- /input-group -->
                                                        </div><!-- /.col-lg-6 -->
                                                    </div><!-- /.row -->

                                                    <div id="factura" style="display: none;">

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
                                                    </div>    

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
                                                            <div class="form-group"></div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <div class="form-group"><label class="titulo">Débito:</label></div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="form-group">

                                                                <div class="form-group">
                                                                    <input name="debito" id="debito" class="form-control input-sm"  type="text" readonly="readonly" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <div class="form-group"><label class="titulo">Crédito:</label></div>
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
                                    </div>
                                </div>
                            </div>

                        <div class="x_content" >
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table class="table ogrid table-striped table-bordered dt-responsive nowrap display" id="tabconceptos" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">Cuenta</th>
                                                <th width="35%">Concepto</th>
                                                <th width="10%">Débito</th>
                                                <th width="10%">Crédito</th>
                                                <th width="10%">Tercero</th>
                                                <th width="10%">Factura</th>
                                                <th width="5%">C. Costo</th>
                                                <th width="5%">Base</th>
                                                <th width="10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div>  
                        </div>

                      

<script type="text/javascript">
    $(document).ready(function () {
        $('.buscar').on('shown.bs.modal', function () {
            $('.buscar input[type="search"]').focus();
        });

        $('.imgbuscar').click(function () {
            cod_vista = $(this).attr('vista');
            $(cod_vista).modal();
        });

        $('#coddoc').on('change', function () {
            if( $('#coddoc').val() == '04'){  $('#factura').css('display','block'); 
    $("#abnfac").chosen({allow_single_deselect: true, no_results_text: "Resultado no encontrado!"}); 
        }else{ $('#factura').css('display','none');  }
         });

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
        $('#codnif').keyup(function (event) {
            if (event.which == 13) {
                cargarDatosCuenta($(this).val());
                $("#coditm").focus();
            }
        });

        //pierde el focus
        $('#codnif').on('change', function () {
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

        $("#coddoc,#codsed").chosen({no_results_text: "Resultado no encontrado!"});
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
                    if (resp.type == 'success') {
                        oTable.DataTable().ajax.reload();
                        totales();
                    }
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
                    if (resp.type == 'success') {
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
                            oTable.DataTable().ajax.reload();
                            $('#save<?php echo $ale; ?>').css('display', 'none');
                            totales();
                            facturas(666);
                            documentos();
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
                if (resp.type == 'success') {
                    oTable.DataTable().ajax.reload();
                }
                totales();
            };
            ajaxGenerico('/sirco/Documento_contable_c/eliminar/', {"oid": $(this).attr('oid')}, callback);
        });
    });

function cargarDatosCuenta(codcta) {
    $.post('/sirco/informe_c/cargarDatosCuenta', {"codcta": codcta}, function (ans) {
        if (ans.err == '1') {
            $('#codnif').val(ans.codnif);
            $('#nomnif').val(ans.nomnif);
            porcta = parseFloat(ans.porcta);
        } else {
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

function totales() {
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

function documentos() {
    $.post('/sirco/Cntdoc_c/selectdocumentos', function (resp) {
        $.each(resp, function (i, v) {
            $('#coddoc').append('<option value="' + v.coddoc + '">' + v.coddoc + ' - ' + v.nomdoc + '</option>');
        });
        $('#coddoc').trigger("chosen:updated");
    }, 'json');
}
</script>