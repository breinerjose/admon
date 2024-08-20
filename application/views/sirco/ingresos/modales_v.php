   <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="busquedatercerosa">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terceros</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function table() {
                            $('#e').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/terceros_c/cargarListadoTerceros/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            table();
                            $('#e').on('click', '.cod', function () {
                                $('#codtrc').val($(this).attr('id'));
                                $('#nomtrc').val($(this).attr('nom'));
                                $('#busquedatercerosa').modal('toggle');
                            });
                        });
                    </script>

                    <table id="e" cellpadding="0" cellspacing="0" class="display" width="100%">
                        <thead>
                            <tr>
                                <th width="20%">Codigo</th>
                                <th width="40%">Nombres</th>
                            </tr>
                        </thead> 
                        <tbody>

                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>