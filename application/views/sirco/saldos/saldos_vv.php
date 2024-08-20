<style>
    *{margin:0; padding:0;}
    body{font-family: 'Capriola',sans-serif; font-size:15px; }
    #datos p{ margin-bottom: 2px;
              margin-top: 1px;}
    #datoscuentas .tipcuenta{font-size: 12px;
                             font-weight: bold;}

    input{ border: 1px solid #CCCCCC;
           padding: 2px;
           width: 160px;}

    .salant {width:10px;}	

    #button:hover{ cursor: pointer;}
    #datoscuentas input{ background-color: #F5F5F5; cursor: default;}
</style>

<div class="container">
    <div class="x_title titulo" id="">
        <h2 class="color-info">Opciones de busqueda:</h2>
        <div class="clearfix"></div>
    </div>
    <form id="datos" class="form-horizontal" >
        <div class="row bg-info">

            <div class="col-md-5">
                <div class="form-group">
                    <label>Cuenta:&nbsp; </label>           
                    <select id="codcta" name="codcta"  data-placeholder="Seleccione Cuenta" class="chosen-select">
                        <option value=""></option>
                    </select>
                </div> 
            </div>

            <div class="col-md-7">
                <div class="form-group">
                    <label>C. de costo:</label>
                    <select id="codcts" name="codcts"  data-placeholder="Seleccione Centro de Costo" class="chosen-select"><option value=""></option></select>
                </div>    
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Tercero:</label>
                    <input type="text" id="codtrc" name="codtrc" class="form-control"  /> 
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group"  style="margin-top:25px;">
                    <input type="text" id="nomtrc" class="form-control" name="nomtrc" >
                </div>
            </div>

            <div class="col-md-6" >
                <div class="form-group">
                    <label> Auxiliar:</label>
                    <select id="codaux" name="codaux"  data-placeholder="Seleccione Auxiliar" class="chosen-select">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            
          
            <div class="clearfix"></div>


            <div class="col-md-2">
                <div class="form-group">
                    <label>Tipo:</label>
                    <select class="chosen-select"  name="tipo" id="tipo">
                        <option>Local</option>
                        <option>Niif</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Sede:</label>
                    <select id="codsed" name="codsed"  data-placeholder="Seleccione" class="chosen-select"></select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Periodo:</label><br>
                    <input name="periodo" type="number" id="periodo" value="<?php echo date("Y"); ?>" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Saldo Anterior:</label><br>
                    <select class="chosen-select" name="salant" id="salant">
                        <option>No</option>
                        <option>Si</option>
                    </select>
                </div>
            </div>

        </div>

        <div id="datoscuentas">
            <table id="tablasaldos" width="100%" height="300px">
                <tr>
                    <td>&nbsp;</td>
                    <td align="lefth"><span class="tipcuenta">D&eacute;bito&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                    <td align="left"><span class="tipcuenta">Cr&eacute;dito&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                    <td align="left"><span class="tipcuenta">Saldo Periodo&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Anterior</span></td>
                    <td><input type="text" readonly class="debito" id="de_saldo_ante" name="de_saldo_ante"></td>
                    <td><input type="text" readonly  class="credito"  id="cre_saldo_ante" name="cre_saldo_ante"></td>
                    <td><input type="text" readonly  class="periodo"  id="per_saldo_ante" name="per_saldo_ante"></td>
                    <td align="left"><span class="tipcuenta">Saldo Acumulado&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Enero</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_ene" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_ene" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_ene" name="saldo[]"></td>
                    <td><input type="text" class="acumulado" readonly id="saldo_acu_ene" name="saldo_acu_ene"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Febrero</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_feb" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_feb" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_feb" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_feb" name="saldo_acu_feb"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Marzo</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_mar" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_mar" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_mar" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_mar" name="saldo_acu_mar"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Abril</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_abr" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_abr" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_abr" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_abr" name="saldo_acu_abr"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Mayo</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_may" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_may" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_may" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_may" name="saldo_acu_may"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Junio</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_jun" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_jun" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_jun" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_jun" name="saldo_acu_jun"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Julio</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_jul" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_jul" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_jul" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_jul" name="saldo_acu_jul"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Agosto</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_agos" name="debito[]"></td>
                    <td><input type="text" readonly class="credito" id="saldo_cre_agos" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_agos" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_agos" name="saldo_acu_agos"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Septiembre</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_sep" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_sep" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_sep" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_sep" name="saldo_acu_sep"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Octubre</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_oct" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_oct" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_oct" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_oct" name="saldo_acu_oct"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Noviembre</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_nov" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_nov" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_nov" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_nov" name="saldo_acu_nov"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Diciembre</span></td>
                    <td><input type="text" readonly class="debito"  id="saldo_de_dic" name="debito[]"></td>
                    <td><input type="text" readonly class="credito"  id="saldo_cre_dic" name="credito[]"></td>
                    <td><input type="text" readonly class="periodo"  id="saldo_per_dic" name="saldo[]"></td>
                    <td><input type="text" class="acumulado"  readonly id="saldo_acu_dic" name="saldo_acu_dic"></td>
                </tr>
                <tr>
                    <td><span class="nomsaldo">Saldo Total</span></td>
                    <td><input type="text" readonly id="saldo_de_total" name="saldo_de_total"></td>
                    <td><input type="text" readonly id="saldo_cre_total" name="saldo_cre_total"></td>
                    <td><input type="text" readonly id="saldo_per_total" name="saldo_per_total"></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </form>
</div>
<script type="text/javascript" src="/res/sirco/funciones_saldos.js"></script>
<script>
    function cargar_saldo(tipo, codcta, codtrc, periodo, codsed, codcts, codaux, salant) {
        $.post('/sirco/Saldos_c/obtener_saldos', {'tipo': tipo, 'codcta': codcta, 'codtrc': codtrc, 'periodo': periodo, 'codsed': codsed, 'codcts': codcts, 'codaux': codaux, 'salant': salant}, function (resp) {
            if (resp == 0) {
                alert('No se encontro información');
                valores_en_cero();
            } else {
                valordebito = 0;
                valorcredito = 0;
                valorperiodo = 0;

                $.each(resp, function (i, v) {
                    $('#de_saldo_ante').val(formatearNumero(v.deb000)).attr('saldo', v.deb000);
                    $('#cre_saldo_ante').val(formatearNumero(v.cre000)).attr('saldo', v.cre000);
                    $('#saldo_de_ene').val(formatearNumero(v.deb001)).attr('saldo', v.deb001);
                    $('#saldo_cre_ene').val(formatearNumero(v.cre001)).attr('saldo', v.cre001);
                    $('#saldo_de_feb').val(formatearNumero(v.deb002)).attr('saldo', v.deb002);
                    $('#saldo_cre_feb').val(formatearNumero(v.cre002)).attr('saldo', v.cre002);
                    $('#saldo_de_mar').val(formatearNumero(v.deb003)).attr('saldo', v.deb003);
                    $('#saldo_cre_mar').val(formatearNumero(v.cre003)).attr('saldo', v.cre003);
                    $('#saldo_de_abr').val(formatearNumero(v.deb004)).attr('saldo', v.deb004);
                    $('#saldo_cre_abr').val(formatearNumero(v.cre004)).attr('saldo', v.cre004);
                    $('#saldo_de_may').val(formatearNumero(v.deb005)).attr('saldo', v.deb005);
                    $('#saldo_cre_may').val(formatearNumero(v.cre005)).attr('saldo', v.cre005);
                    $('#saldo_de_jun').val(formatearNumero(v.deb006)).attr('saldo', v.deb006);
                    $('#saldo_cre_jun').val(formatearNumero(v.cre006)).attr('saldo', v.cre006);
                    $('#saldo_de_jul').val(formatearNumero(v.deb007)).attr('saldo', v.deb007);
                    $('#saldo_cre_jul').val(formatearNumero(v.cre007)).attr('saldo', v.cre007);
                    $('#saldo_de_agos').val(formatearNumero(v.deb008)).attr('saldo', v.deb008);
                    $('#saldo_cre_agos').val(formatearNumero(v.cre008)).attr('saldo', v.cre008);
                    $('#saldo_de_sep').val(formatearNumero(v.deb009)).attr('saldo', v.deb009);
                    $('#saldo_cre_sep').val(formatearNumero(v.cre009)).attr('saldo', v.cre009);
                    $('#saldo_de_oct').val(formatearNumero(v.deb010)).attr('saldo', v.deb010);
                    $('#saldo_cre_oct').val(formatearNumero(v.cre010)).attr('saldo', v.cre010);
                    $('#saldo_de_nov').val(formatearNumero(v.deb011)).attr('saldo', v.deb011);
                    $('#saldo_cre_nov').val(formatearNumero(v.cre011)).attr('saldo', v.cre011);
                    $('#saldo_de_dic').val(formatearNumero(v.deb012)).attr('saldo', v.deb012);
                    $('#saldo_cre_dic').val(formatearNumero(v.cre012)).attr('saldo', v.cre012);

                });
                calcular_saldos_periodo();
                calcular_acumulado();
                calcular_totales();
            }
        }, 'json');
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
    function cerrarDialogoc(mensaje, codigo, nombre) {
        $('#buscaar').dialog('close');
        $.blockUI({
            message: mensaje
        });
        $.unblockUI();
        $('#' + idbot.split('_')[0]).val(codigo.trim());
        $('#nomtrc').val(nombre.trim());
        return false;
    }
    function cerrarDialogoc2(mensaje, codigo, nombre, por, codnif, nomnif) {
        $('#buscaar').dialog('close');
        $.blockUI({
            message: mensaje
        });
        $.unblockUI();
        $('#' + idbot.split('_')[0]).val(codigo.trim());
        $('#nomcta').val(nombre.trim());
        porcta = parseFloat(por);
        $('#codnif').val(codnif);
        $('#nomnif').val(nomnif);
        return false;
    }

    function formatearNumero(str) {
        return (str + "").replace(/\b(\d+)((\.\d+)*)\b/g, function (a, b, c) {
            return (b.charAt(0) > 0 && !(c || ".").lastIndexOf(".") ? b.replace(/(\d)(?=(\d{3})+$)/g, "$1,") : b) + c;
        });
    }

    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

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
            valores_en_cero();
            $('#codcta').empty();
            tipo = $('#tipo').val();
            if (tipo == 'Local') {
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
        valores_en_cero();

        // boton buscar cuenta
        $('.btnss').button().on('click', function () {
            idbot = "";
            var idebtn = $(this).attr('data-id');
            idbot = $(this).attr('data-nm');
            $('<iframe id="buscaar" frameborder="0" />').attr('src', '/sirco/documento_contable_c/vistaDocum/' + idebtn).dialog({
                resizable: false,
                modal: true,
                width: 950,
                height: 500,
                position: ['middle', 30],
                title: 'Busqueda..',
                close: function (v, ui) {
                    $(this).remove();
                }
            }).width(950 - 20).height(500 - 20);
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