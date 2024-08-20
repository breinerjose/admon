<style>
    table.display tbody tr td p input {width: 95%;}
    table.display th{font-size:14px; padding:2px; }
    table.display tbody tr td{font-size:15px; padding:1px 1px 1px 10px; color:#000000;}
</style>       
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary"> 
            <div class="panel-heading">SALDOS CONTABLES</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="datos">
                    <div class="form-group">
                        <label style="text-align:left" for="codcta" class="col-lg-1 col-md-1 control-label">Cuenta:</label>
                        <div class="col-lg-5 col-md-5">
                            <select id="codcta" name="codcta"  data-placeholder="Seleccione Cuenta" class="chosen-select"><option value=""></option></select>
                        </div>

                        <label style="text-align:left" for="codcts" class="col-lg-1 col-md-1 control-label">C Costo</label>
                        <div class="col-lg-5 col-md-5">
                            <select id="codcts" name="codcts"  data-placeholder="Seleccione Centro de Costo" class="chosen-select"><option value=""></option></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="text-align:left" for="codtrc" class="col-lg-1 col-md-1 control-label">Tercero</label>
                        <div class="col-md-2 col-lg-2"> 
                            <input type="text" id="codtrc" name="codtrc" class="form-control"  /> 
                        </div>

                        <div class="col-md-3">
                            <input type="text" id="nomtrc" class="form-control" name="nomtrc" >
                        </div>

                        <label style="text-align:left" for="codaux" class="col-lg-1 col-md-1 control-label">Auxiliar</label>
                        <div class="col-md-5 col-lg-5" >
                            <select id="codaux" name="codaux"  data-placeholder="Seleccione Auxiliar" class="chosen-select"><option value=""></option></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="text-align:left" for="tipo" class="col-lg-1 col-md-1 control-label">Tipo:</label>
                        <div class="col-md-2 col-lg-2">
                            <select class="chosen-select"  name="tipo" id="tipo">
                                <option>Niif</option>
                                <option>Pcga</option>
                            </select>
                        </div>

                        <label for="codsed" class="col-lg-1 col-md-1 control-label">Sede:</label>
                        <div class="col-md-2">
                            <select id="codsed" name="codsed"  data-placeholder="Seleccione" class="chosen-select"></select>
                        </div>

                        <label style="text-align:left" for="periodo" class="col-lg-1 col-md-1 control-label">Año:</label>
                        <div class="col-md-2">
                            <input name="periodo" type="number" id="periodo" value="<?php echo date("Y"); ?>" />
                        </div>

                        <label for="salant" class="col-lg-2 col-md-1 control-label">Saldo Anterior:</label>
                        <div class="col-md-1">
                            <select class="chosen-select" name="salant" id="salant">
                                <option>No</option>
                                <option>Si</option>
                            </select>
                        </div>
						</div>
						</form>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table class="table ogrid table-striped table-bordered dt-responsive nowrap display" id="saldos" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="20%">Saldo</th>
                    <th width="20%">Débito</th>
                    <th width="20%">Crédito</th>
                    <th width="20%">Saldo Periodo</th>
                    <th width="20%">Saldo Acumulado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="/res/sirco/funciones_saldos.js"></script>
<script>
    function cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant) {
        var oTable = $('#saldos').dataTable({
            "bProcessing": true,
            "bDestroy": true,
            "bPaginate": false,
            "ordering": false,
            "bLengthChange": false,
            "responsive": true,
            "bInfo": false,
            "bFilter": false,
            "ajax": {
                "url": "/sirco/Saldos_c/obtener_saldos/",
                "type": "POST",
                "data": {'tipo': tipo, 'codcta': codcta, 'codtrc': codtrc, 'periodo': periodo, 'codsed': codsed, 'codcts': codcts, 'codaux': codaux, 'salant': salant}
            }
        });
    }

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

    function cargarDatosProvedor(codtrc) {
        $.post('/sirco/informe_c/cargarDatosProvedor', {"codtrc": codtrc}, function (ans) {
            if (ans.err == '1') {
                $('#nomtrc').val(ans.nomtrc);
            } else {
                $('#codtrc').val('');
                $('#nomtrc').val('');
            }
        }, 'JSON');
    }

    $(document).ready(function () {

        $(".chosen-select").chosen({no_results_text: "Resultado no encontrado!"});

        $.post('/sirco/sedes_c/selectsedes', function (resp) {
            $.each(resp, function (i, v) {
                $('#codsed').append('<option value="' + v.codsed + '">' + v.codsed + ' - ' + v.nomsed + '</option>');
            });
            $('#codsed').trigger("chosen:updated");
        }, 'json');

        $.post('/sirco/cuentas_c/cuentas_cta', function (resp) {
            $.each(resp, function (i, v) {
                $('#codcta').append('<option value="' + v.codcta + '">' + v.codcta + ' - ' + v.nomcta + '</option>');
            });
            $('#codcta').trigger("chosen:updated");
        }, 'json');

        $.post('/sirco/centro_c/centro_costo', function (resp) {
            $.each(resp, function (i, v) {
                $('#codcts').append('<option value="' + v.codcts + '">' + v.codcts + ' - ' + v.nomcts + '</option>');
            });
            $('#codcts').trigger("chosen:updated");
        }, 'json');

        $.post('/sirco/auxiliar_c/auxiliares', function (resp) {
            $.each(resp, function (i, v) {
                $('#codaux').append('<option value="' + v.codaux + '">' + v.codaux + ' - ' + v.nomaux + '</option>');
            });
            $('#codaux').trigger("chosen:updated");
        }, 'json');

        $('#tipo').on('change', function () {
            $('#codcta').empty();
            tipo = $('#tipo').val();
            if (tipo == 'Pcga') {
                $("#codcta").chosen({no_results_text: "Resultado no encontrado!", allow_single_deselect: true});
                $.post('/sirco/cuentas_c/cuentas_cta', function (resp) {
                    $('#codcta').append('<option value="">Seleccione Cuenta Pcga</option>');
                    $.each(resp, function (i, v) {
                        $('#codcta').append('<option value="' + v.codcta + '">' + v.codcta + ' - ' + v.nomcta + '</option>');
                    });
                    $('#codcta').trigger("chosen:updated");
                }, 'json');

            } else {
                $('#codcta').empty();
                $(".codcta").chosen({no_results_text: "Resultado no encontrado!", allow_single_deselect: true});
                $.post('/sirco/cuentas_c/cuentas_nif', function (resp) {
                    $('#codcta').append('<option value="">Seleccione Cuenta Niif</option>');
                    $.each(resp, function (i, v) {
                        $('#codcta').append('<option value="' + v.codnif + '">' + v.codnif + ' - ' + v.nomnif + '</option>');
                    });
                    $('#codcta').trigger("chosen:updated");
                }, 'json');
            }
        });


        //Cambio de Saldo Acumulado
        $('#salant').on('change', function () {
            codcta = $('#codcta').val();
            periodo = $('#periodo').val();
            tipo = $('#tipo').val();
            codsed = $('#codsed').val();
            codtrc = $('#codtrc').val();
            codcts = $('#codcts').val();
            codaux = $('#codaux').val();
            salant = $('#salant').val();
            if (codcta != '' && periodo != '') {
                cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant);
            }//Cierro Validacion de Valores	 
        });

        //Codcta
        $('#codcta').on('change', function () {
            codcta = $('#codcta').val();
            periodo = $('#periodo').val();
            tipo = $('#tipo').val();
            codsed = $('#codsed').val();
            codtrc = $('#codtrc').val();
            codcts = $('#codcts').val();
            codaux = $('#codaux').val();
            salant = $('#salant').val();
            if (codcta != '' && periodo != '') {
                cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant);
            }//Cierro Validacion de Valores
        });
        //Codcta

        $('#codtrc').keyup(function (event) {
            if (event.which == 13) {
                $(this).trigger('blur');
            }
        }).blur(function () {
            cargarDatosProvedor($(this).val());
            codcta = $('#codcta').val();
            periodo = $('#periodo').val();
            tipo = $('#tipo').val();
            codsed = $('#codsed').val();
            codtrc = $('#codtrc').val();
            codcts = $('#codcts').val();
            codaux = $('#codaux').val();
            salant = $('#salant').val();
            if (codcta != '' && periodo != '') {
                cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant);
            }//Cierro Validacion de Valores	
        });

        $('#codsed').on('change', function () {
            codcta = $('#codcta').val();
            periodo = $('#periodo').val();
            tipo = $('#tipo').val();
            codsed = $('#codsed').val();
            codtrc = $('#codtrc').val();
            codcts = $('#codcts').val();
            codaux = $('#codaux').val();
            salant = $('#salant').val();
            if (codcta != '' && periodo != '') {
                cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant);
            }//Cierro Validacion de Valores	
        });

        $('#periodo').on('change', function () {
            codcta = $('#codcta').val();
            periodo = $('#periodo').val();
            tipo = $('#tipo').val();
            codsed = $('#codsed').val();
            codtrc = $('#codtrc').val();
            codcts = $('#codcts').val();
            codaux = $('#codaux').val();
            salant = $('#salant').val();
            if (codcta != '' && periodo != '') {
                cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant);
            }//Cierro Validacion de Valores	
        });

        $('#codcts').on('change', function () {
            codcta = $('#codcta').val();
            periodo = $('#periodo').val();
            tipo = $('#tipo').val();
            codsed = $('#codsed').val();
            codtrc = $('#codtrc').val();
            codcts = $('#codcts').val();
            codaux = $('#codaux').val();
            salant = $('#salant').val();
            if (codcta != '' && periodo != '') {
                cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant);
            }//Cierro Validacion de Valores	
        });

        $('#codaux').on('change', function () {
            codcta = $('#codcta').val();
            periodo = $('#periodo').val();
            tipo = $('#tipo').val();
            codsed = $('#codsed').val();
            codtrc = $('#codtrc').val();
            codcts = $('#codcts').val();
            codaux = $('#codaux').val();
            salant = $('#salant').val();
            if (codcta != '' && periodo != '') {
                cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant);
            }//Cierro Validacion de Valores	
        });


    });
</script>