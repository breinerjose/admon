<script type="text/javascript">
    var oTable;
    function dtl(coddoc1, coddoc2, fecha1, fecha2, nrocmp1, nrocmp2, codsed, tipo_consult) {
        oTable = $('#informacion').dataTable({
            "bProcessing": true,
            "bDestroy": true,
            "bPaginate": true,
            "sScrollY": '310px',
            "sPaginationType": "full_numbers",
            "sAjaxSource": "/sirco/resumen_documentos_c/obtener_documentos/",
            "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},
            "fnServerData": function (sSource, aoData, fnCallback, oSettings) {
                oSettings.jqXHR = $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": {"coddoc1": coddoc1, "coddoc2": coddoc2, "fecha1": fecha1, "fecha2": fecha2, "nrocmp1": nrocmp1, "nrocmp2": nrocmp2, "codsed": codsed, "tipo_consult": tipo_consult},
                    "success": fnCallback
                });
            },
        });
    }
    $(document).ready(function (e) {

        dtl();

        $('#checkfechas').attr('checked', true);
        $('#checkfechas').prop('disabled', true);
        $('#fecha1').val('<?php echo date('Y-m-d'); ?>');
        $('#fecha2').val('<?php echo date('Y-m-d'); ?>');

        //buscar
        $('#buscar').on('click', function (e) {
            if ($('#fecha1').val() != '' && $('#fecha2').val() != '' && $('#coddoc1').val() != '' && $('#coddoc2').val() != '' && $('#nrocmp1').val() != '') {

                fecha1 = $('#fecha1').val();
                fecha2 = $('#fecha2').val();
                coddoc1 = $('#coddoc1').val();
                coddoc2 = $('#coddoc2').val();
                nrocmp1 = $('#nrocmp1').val();
                nrocmp2 = $('#nrocmp2').val();
                codsed = $('#codsed').val();
                tipo_consult = $('input[name="tipo_consult"]:checked').val();
                oTable.fnReloadAjax();
            } else {
                alert('Todos los parametros son obligatorios');
            }
        });


        $(document).on('click', '.imprimirLocal', function () {
            var id = $(this).attr('data-print');
            window.open('/sirco/imprimir_doc_c/imprimir_doc_local/' + id);
        });
        $(document).on('click', '.imprimirNif', function () {
            var id = $(this).attr('data-print');
            window.open('/sirco/imprimir_doc_c/imprimir_doc_nif/' + id);
        });

        $(document).on('click', '.imprimirCheque', function () {
            var id = $(this).attr('data-print');
            window.open('/sirco/imprimir_doc_c/imprimir_doc_cheque/' + id);
        });
        
        $('#fecha1').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).on('changeDate',function(e){
            $('#fecha2').datepicker('setStartDate',e['date']);
        });

        $('#fecha2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).on('changeDate',function(e){
            $('#fecha1').datepicker('setEndDate',e['date']);
        });
        
         $('#fecha2').datepicker('setStartDate','<?php echo date('Y-m-d'); ?>');
         $('#fecha1').datepicker('setEndDate','<?php echo date('Y-m-d'); ?>');
        
        
        $("#coddoc1").chosen({no_results_text: "Resultado no encontrado!"});        
        $.post('/sirco/Cntdoc_c/selectdocumentos', function (resp) {
            $.each(resp, function (i, v) {
                if (v.coddoc == 01)
                    $('#coddoc1').append('<option value="' + v.coddoc + '" selected>' + v.coddoc + ' - ' + v.nomdoc + '</option>');
                else
                    $('#coddoc1').append('<option value="' + v.coddoc + '">' + v.coddoc + ' - ' + v.nomdoc + '</option>');
            });
            $('#coddoc1').trigger("chosen:updated");
        }, 'json');
        
        $("#coddoc2").chosen({no_results_text: "Resultado no encontrado!"});
        $.post('/sirco/Cntdoc_c/selectdocumentos', function (resp) {
            $.each(resp, function (i, v) {
                if (v.coddoc == 99)
                    $('#coddoc2').append('<option value="' + v.coddoc + '" selected>' + v.coddoc + ' - ' + v.nomdoc + '</option>');
                else
                    $('#coddoc1').append('<option value="' + v.coddoc + '">' + v.coddoc + ' - ' + v.nomdoc + '</option>');
            });
            $('#coddoc2').trigger("chosen:updated");
        }, 'json');
        

        $("#codsed").chosen({no_results_text: "Resultado no encontrado!"});        
        $.post('/sirco/sedes_c/selectsedes', function (resp) {
            $.each(resp, function (i, v) {
                $('#codsed').append('<option value="' + v.codsed + '">' + v.codsed + ' - ' + v.nomsed + '</option>');
            });
            $('#codsed').trigger("chosen:updated");
        }, 'json');

        

        //TRATAMIENTO DE CHECKBOX 
        $('input[name="informe"]').on('click', function () {
            var parent = $(this).parent().attr('id');
            $('#' + parent + ' input[type=checkbox]').removeAttr('checked');
            $(this).attr('checked', 'checked');
        });


        $('#coddoc2').blur(function () {
            if ($('#checksede').is(':checked')) {
                if ($('#coddoc1').val() != '') {
                    coddoc1 = $('#coddoc1').val();
                    coddoc2 = $('#coddoc2').val();
                    llenar_sedes(coddoc1, coddoc2);
                } else {
                    alert('Seleccione la otra fuente');
                }
            }
        });

        $('#coddoc1').blur(function () {
            if ($('#checksede').is(':checked')) {
                if ($('#coddoc2').val() != '') {
                    coddoc1 = $('#coddoc1').val();
                    coddoc2 = $('#coddoc2').val();
                    llenar_sedes(coddoc1, coddoc2);
                } else {
                    alert('Seleccione la otra fuente');
                }
            }
        });

        $('#print').click(function (e) {
            fecha1 = $('#fecha1').val();
            fecha2 = $('#fecha2').val();
            coddoc1 = $('#coddoc1').val();
            coddoc2 = $('#coddoc2').val();
            nrocmp1 = $('#nrocmp1').val();
            nrocmp2 = $('#nrocmp2').val();
            codsed = $('#codsed').val();
            tipo_consult = $('input[name="tipo_consult"]:checked').val();

            if (fecha1 != '' && fecha2 != '' && coddoc1 != '' && coddoc2 != '' && nrocmp1 != '' && nrocmp2 != '' && codsed != '' && $('#codsed').val() != null) {
                window.open("/sirco/resumen_documentos_c/reporte/" + coddoc1 + "/" + coddoc2 + "/" + fecha1 + "/" + fecha2 + "/" + nrocmp1 + "/" + nrocmp2 + "/" + codsed + "/" + tipo_consult + "/Web");
            } else {
                alert('No pueden quedar campos vacios');
            }
        });

        $('#excel').click(function (e) {
            fecha1 = $('#fecha1').val();
            fecha2 = $('#fecha2').val();
            coddoc1 = $('#coddoc1').val();
            coddoc2 = $('#coddoc2').val();
            nrocmp1 = $('#nrocmp1').val();
            nrocmp2 = $('#nrocmp2').val();
            codsed = $('#codsed').val();
            tipo_consult = $('input[name="tipo_consult"]:checked').val();

            if (fecha1 != '' && fecha2 != '' && coddoc1 != '' && coddoc2 != '' && nrocmp1 != '' && nrocmp2 != '' && codsed != '' && $('#codsed').val() != null) {
                window.open("/sirco/resumen_documentos_c/reporte/" + coddoc1 + "/" + coddoc2 + "/" + fecha1 + "/" + fecha2 + "/" + nrocmp1 + "/" + nrocmp2 + "/" + codsed + "/" + tipo_consult + "/Excel");
            } else {
                alert('No pueden quedar campos vacios');
            }
        });
    });

</script>

<div class="container">
    <form id="datos">
        <div class="panel panel-primary">
            <div class="panel-heading">Opciones de búsqueda</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Fechas</label>
                            <input type="text" id="fecha1" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="margin-top:24px;">
                            <input type="text" id="fecha2" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fuente</label>
                            <select id="coddoc1" name="coddoc1" data-placeholder="Seleccione" class="chosen-select form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="margin-top:24px;">
                            <select id="coddoc2" name="coddoc2" data-placeholder="Seleccione" class="chosen-select form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Documento</label>
                            <input type="text" id="nrocmp1" value="000000" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group" style="margin-top:24px;">
                            <input type="text" id="nrocmp2" value="999999" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sede</label>
                            <select id="codsed" name="codsed" data-placeholder="Seleccione" class="chosen-select form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group" style="margin-top:24px;">
                            <input type="radio" name="tipo_consult" id="cuadrados" value="cuadrados" checked="checked"> Cuadrados
                            <input type="radio" name="tipo_consult" id="descuadrados" value="descuadrados"> Descuadrados
                            <input type="radio" name="tipo_consult" id="revertidos" value="revertido"> Revertidos                        
                            <input type="radio" name="tipo_consult" id="todos" value="todos"> Todos
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top:24px;">
                        <button type="button" class="btn btn-primary" id="print"><i class=""fa fa-print></i>Imprimir</button>
                        <button type="button" class="btn btn-success" id="excel"><i class=""fa fa-excel></i>Excel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="tabla">
    <table class="display" id="informacion" width="100%" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="05%">Fuente</th> 
                <th width="15%">Fecha</th>
                <th width="15%">Numero</th>
                <th width="20%">Debito</th>
                <th width="20%">Credito</th>
                <th width="25%">Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>