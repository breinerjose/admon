<style>
    table.display tbody tr td p input {width: 95%;}
    table.display th{font-size:11px; padding:1px;}
    table.display tbody tr td{font-size:11px; padding:1px;}
    .inpeditdetdcm{width:161px;height:20px;margin:1px;}
</style>

<div class="container">
<div class="panel panel-primary">
            <div class="panel-heading">Generar Documento Contable desde Excel</div>
            <div class="panel-body">
                <div class="row">

    <form role="form" method="post" id="formulario" name="formulario" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <div class="item form-group"  style="margin-top: 24px;">
                    <input type="file" id="archivo" name="archivo">
                </div>
            </div>
            <div class="col-md-2">
                <div class="item form-group"  style="margin-top: 24px;">
                    <button type="button" id="importar" class="btn btn-success">Importar</button>
                </div>
            </div>
            <div class="col-md-2">
                <div class="item form-group">
                    <label class="control-label">Debito</label>
                    <input name="debito" class="form-control" id="debito" >
                </div>   
            </div>
            <div class="col-md-2">
                <div class="item form-group">
                    <label class="control-label">Credito</label>
                    <input name="credito" class="form-control" id="credito" >
                </div>   
            </div>
            <div class="col-md-2">
                <div class="item form-group">
                    <label class="control-label">Diferencia</label>
                    <input name="saldo" class="form-control" id="saldo">
                </div>   
            </div>
        </div>
    </form>

    <form role="form" method="post" id="formulariob" name="formulariob">
        <div class="row">        
            <div class="col-md-4">
                <div class="item form-group">
                    <label class="control-label">Documento</label>
                    <select id="coddoc" name="coddoc"  data-placeholder="Seleccione Tipo Documento" class="chosen-select valid_sele coddoc">
                        <option></option>
                    </select>
                </div>   
            </div>
            <div class="col-md-4">
                <div class="item form-group">
                    <label class="control-label">Sede</label>
                    <select id="codsed" name="codsed"  data-placeholder="Seleccione Sede"  class="chosen-select valid_sele codsed">
                        <option></option>
                    </select>
                </div>   
            </div>
            <div class="col-md-2">
                <div class="item form-group">
                    <label class="control-label">Fecha</label>
                    <input type="text" id="fchcmp" name="fchcmp" class="form-control required" readonly />
                </div>
            </div>

            <div class="col-md-2">
                <div class="item form-group">
                    <button type="button" id="generar" style="margin-top: 24px;" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                    </button>
                    <button type="button" id="imprimir" style="margin-top: 24px; margin-left:1px;" class="btn btn-primary">
                        <i class="fa fa-print"></i>
                    </button>
                    <button type="button" id="validar" style="margin-top: 24px; margin-left:1px;" class="btn btn-success">
                        <i class="fa fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    </div>
	</div>
	</div>
	</div>
    <div class="col-md-12">
        <table class="table table-bordered table-striped dt-responsive display" id="listado" >
            <thead>
                <tr>
                    <th width="10%">Cuenta</th>
                    <th width="30%">Detalle</th>
                    <th width="10%">Debito</th>
                    <th width="10%">Credito</th>
                    <th width="10%">Id</th>
                    <th width="25%">Nombre</th>
                    <th width="5%">X</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>	


<script type="text/javascript">
    $(document).ready(function () {
        $("#codsed").chosen({no_results_text: "Resultado no encontrado!"});
        $.post('/sirco/sedes_c/selectsedes', function (resp) {
            $.each(resp, function (i, v) {
                $('#codsed').append('<option value="' + v.codsed + '">' + v.codsed + ' - ' + v.nomsed + '</option>');
            });
            $('#codsed').trigger("chosen:updated");
        }, 'json');

        $('#fchcmp').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $("#coddoc").chosen({no_results_text: "Resultado no encontrado!"});
        $.post('/sirco/Cntdoc_c/selectdocumentos', function (resp) {
            $.each(resp, function (i, v) {
                $('#coddoc').append('<option value="' + v.coddoc + '">' + v.coddoc + ' - ' + v.nomdoc + '</option>');
            });
            $('#coddoc').trigger("chosen:updated");
        }, 'json');

        dtl();
        totales();
        $('#debito').autoNumeric('init');
        $('#credito').autoNumeric('init');
        $('#saldo').autoNumeric('init');

        $('#importar').click(function () {
            var formData = new FormData($("#formulario")[0]);
            var ruta = "/sirco/Doc_excel_c/importar/";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos)
                {
                    dtl();
                    totales();
                }
            });
        });

        $('#generar').click(function () {
            var estado = validarSelect();
            if ($('#saldo').val() == '0.00') {
                if ($("form#formulario").validate().form() && estado && $('#fchcmp').val() != '') {
                    $.ajax({
                        url: '/sirco/Doc_excel_c/generar/',
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('form#formulariob').serialize(),
                        success: function (ans)
                        {
                            if (ans.a.r == 0) {
                                alert('Documento Generado');
                                window.open('/sirco/imprimir_doc_c/imprime_doc_laser/' + ans.a.c);
                            }
                            if (ans.a.r == 1) {
                                alert('Periodo Cerrado');
                            }
                            if (ans.a.r == 2) {
                                alert('Error. Vefirique Validacion');
                            }
                            if (ans.a.r == 3) {
                                alert('errores de Validacion');
                                var id = Math.random();
                                window.open('/sirco/Doc_excel_c/validar/' + id);
                            }
                            $('#archivo').val('');
                            $('#fchcmp').val('');
                            dtl();
                            totales();

                        }
                    });
                } else
                    alert('Hay campos Requeridos');
            } else
                alert('Documento Descuadrado');
        });

        $('#validar').click(function () {
            var id = Math.random();
            window.open('/sirco/Doc_excel_c/validar/' + id);
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
            } else {
                td.html('<p class="detdcm" valor="' + valoranterior + '" campo="' + campo + '" oid="' + oid + '">' + valoranterior + '</p>');
            }
        });
        /*  Fin detdcm*/


    });

    function validarSelect() {
        var estado = true;
        $('.valid_sele').each(function (index, element) {
            if ($(this).val() == null || $(this).val() == '') {
                var cod = $(this).attr('id');
                $('div#' + cod + '_chosen ').addClass('chosen-container-active')
                estado = false;
            } else {
                $('div#' + cod + '_chosen ').removeClass('chosen-container-active');
                estado = true;
            }
        });
        return estado;
    }

    function totales(codcta, codcts) {
        $.ajax({
            url: '/sirco/Doc_excel_c/totales',
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

            }
        });
    }

    function actualizarCampo(valor, oid, campo) {
        var response;
        $.ajax({
            url: '/sirco/Doc_excel_c/actualizarCampo/',
            type: 'POST',
            dataType: 'JSON',
            data: {"valor": valor, "oid": oid, "campo": campo},
            async: false,
            success: function (ans) {
                response = ans;
                totales();
            }
        });
        return response;
    }

    function dtl() {

        tablatotales = $('#listado').dataTable({
            "scrollX": false,
            "bPaginate": true,
            "ordering": true,
            "bLengthChange": true,
            "responsive": true,
            "bInfo": true,
            "bFilter": true,
            "bDestroy": true,
            "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},
            "ajax": {
                "url": "/sirco/Doc_excel_c/detalle/",
                "type": "POST",
                "data": {"ale": "<?php echo $ale; ?>"}

            }
        });
    }
</script>