<style type="text/css">	
.chosen-container{
    min-width: 250px;
}
</style>
<div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="mostrar_cuentas">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Cuentas Contables</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal"  id="registrar" name="registrar">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Cuenta <b style="color:#900">*</b></label>
                                <input class="form-control validate[required,maxSize[12]]" id="codcta" name="codcta" type="text">
                                <input type="hidden" id="codbal" name="codbal">
                                <input type="hidden" id="campo" name="campo">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Naturaleza<b style="color:#900">*</b></label><br>
                                <select id="signo" name="signo" class="chossen form-control" data-placeholder="Seleccione Naturaleza" style="width:150px;">
                                    <option value="1">Debito</option>
                                    <option value="-1">Crédito</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" style="margin-top:25px;">
                                <button type="submit" class="btn btn-success" id="save<?php echo $ale; ?>" ><i class="fa fa-save"></i> Guardar </button>
                            </div>
                        </div>
                    </form>
                </div>

                <table id="cuentas" cellpadding="0" cellspacing="0" class="display" width="100%">
                    <thead>
                        <tr>
                            <th width="15%">Codigo</th>
                            <th width="75%">Nombre</th>
                            <th width="5%"></th>
                        </tr>
                    </thead> 
                    <tbody>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
	  $('.buscar').on('shown.bs.modal', function () {
            $('.buscar input[type="search"]').focus();
        });
		
    $(document).on('click', '.eliminar<?php echo $ale; ?>', function () {
        var codcta = $(this).attr('codcta');
        var codbal = $('#codbal').val();
        var campo = $('#campo').val();
        var callback = function (resp) {
            new PNotify({
                title: resp.title,
                text: resp.msg,
                type: resp.type,
                styling: 'bootstrap3'
            });
            if (resp.type == 'success') {
                $('form#registrar').get(0).reset();
                oTable.DataTable().ajax.reload();
            }
        };
        ajaxGenerico('/sirco/Campos_c/eliminarCuenta', {"codcta": codcta, "codbal": codbal, "campo": campo}, callback);
    });

    var oTable = '';
    function table(codbal, campo) {
        oTable = $('#cuentas').dataTable({
            "bProcessing": true,
            "bDestroy": true,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},
            "ajax": {
                "url": "/sirco/Campos_c/cuentasAsociadas/",
                "type": "POST",
                "data": {"ale": "<?php echo $ale; ?>", "codbal": codbal, "campo": campo}
            }
        });
    }

    function agregraCuenta(codcta) {
        var signo = $('#signo').val();
        $.ajax({
            url: '/sirco/Campos_c/agregraCuenta',
            type: 'POST',
            data: {"campo": campo, "codbal": codbal, "codcta": codcta, "signo": signo},
            dataType: 'JSON',
            success: function (ans) {
                if (ans.err == '1') {
                    oTable.DataTable().ajax.reload();
                } else
                    alert(ans.msg);

            }
        });

    }

    $('#save<?php echo $ale; ?>').click(function () {
        $('#registrar').submit(function (e) {
            e.preventDefault();
            var data = $('#registrar').serialize();
            if ($('#registrar').validationEngine('validate', {promptPosition: "topLeft", scroll: false})) {
                var callback = function (resp) {
                    new PNotify({
                        title: resp.title,
                        text: resp.msg,
                        type: resp.type,
                        styling: 'bootstrap3'
                    });
                    if (resp.type == 'success') {
                        $('form#registrar').get(0).reset();
                        oTable.DataTable().ajax.reload();
                    }
                };
                ajaxGenerico('/sirco/Campos_c/agregraCuenta', data, callback);
            }
        });
    });
$('.chossen').chosen({no_results_text: "Resultado no encontrado!"}); 
</script>