<style>
    .col-md-2.col-sm-2.col-xs-12 .imgbuscar {
        /*! display: inline-block; */
        float: right;
    }
    .col-md-2.col-sm-2.col-xs-12 .inputb {
        margin-right: 2px;
        width: 85%;
            }
       .col-md-2.col-sm-2.col-xs-12 .fecha {
        margin-right: 2px;
        width: 85%;    
    }
</style> 

<div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="cuentas_detallea">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cuentas Pcga</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function table() {
                            $('#cuentas').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/cuentas_c/cuentas_cta_detalle/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            table();
                            $('#cuentas').on('click', '.cod', function () {
                                $('#codcta').val($(this).attr('id'));
                                $('#cuentas_detallea').modal('toggle');
                            });
                            
                            $('#fecini').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true
                            }).on('changeDate',function(e){
                                $('#fecfin').datepicker('setStartDate',e['date']);
                            });

                            $('#fecfin').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true
                            }).on('changeDate',function(e){
                                $('#fecini').datepicker('setEndDate',e['date']);
                            });

                             $('#fecfin').datepicker('setStartDate','<?php echo date('Y-m-d'); ?>');
                             $('#fecini').datepicker('setEndDate','<?php echo date('Y-m-d'); ?>');
         
                        });
                    </script>

                    <table id="cuentas" cellpadding="0" cellspacing="0" class="display" width="100%">
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

    <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="cuentas_detalleb">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cuentas Pcga</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tableb() {
                            $('#cuentasb').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/cuentas_c/cuentas_cta_detalle/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tableb();
                            $('#cuentasb').on('click', '.cod', function () {
                                $('#codctab').val($(this).attr('id'));
                                $('#cuentas_detalleb').modal('toggle');
                            });
                        });
                    </script>

                    <table id="cuentasb" cellpadding="0" cellspacing="0" class="display" width="100%">
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
    
    
    <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="cuentas_niif_detallea">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cuentas Pcga</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tablec() {
                            $('#c').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/cuentas_c/cuentas_nif_detalle/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tablec();
                            $('#c').on('click', '.cod', function () {
                                $('#codnif').val($(this).attr('id'));
								$('#nomnif').val($(this).attr('nom'));
                                $('#cuentas_niif_detallea').modal('toggle');
                            });
                        });
                    </script>

                    <table id="c" cellpadding="0" cellspacing="0" class="display" width="100%">
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

    <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="cuentas_niif_detalleb">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cuentas Niif</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tabled() {
                            $('#d').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/cuentas_c/cuentas_nif_detalle/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tabled();
                            $('#d').on('click', '.cod', function () {
                                $('#codnifb').val($(this).attr('id'));
                                $('#cuentas_niif_detalleb').modal('toggle');
                            });
                        });
                    </script>

                    <table id="d" cellpadding="0" cellspacing="0" class="display" width="100%">
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
    
    <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="busquedatercerosa">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terceros</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tablee() {
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
                            tablee();
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
    
    <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="busquedatercerosb">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terceros</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tablef() {
                            $('#f').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/terceros_c/cargarListadoTerceros/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tablef();
                            $('#f').on('click', '.cod', function () {
                                $('#codtrcb').val($(this).attr('id'));
                                $('#busquedatercerosb').modal('toggle');
                            });
                        });
                    </script>

                    <table id="f" cellpadding="0" cellspacing="0" class="display" width="100%">
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
    
     <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="centros_costosa">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Centros de Costo</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tableg() {
                            $('#g').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/Centro_c/centros_costos/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tableg();
                            $('#g').on('click', '.cod', function () {
                                $('#codctsa').val($(this).attr('id'));
                                $('#centros_costosa').modal('toggle');
                            });
                        });
                    </script>

                    <table id="g" cellpadding="0" cellspacing="0" class="display" width="100%">
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

     <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="centros_costosb">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Centros de Costo</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tableh() {
                            $('#h').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/Centro_c/centros_costos/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tableh();
                            $('#h').on('click', '.cod', function () {
                                $('#codctsb').val($(this).attr('id'));
                                $('#centros_costosb').modal('toggle');
                            });
                        });
                    </script>

                    <table id="h" cellpadding="0" cellspacing="0" class="display" width="100%">
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

     <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="auxiliaresa">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Centros de Costo</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tablei() {
                            $('#i').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/Auxiliares_c/auxiliares/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tablei();
                            $('#i').on('click', '.cod', function () {
                                $('#codauxa').val($(this).attr('id'));
                                $('#auxiliaresa').modal('toggle');
                            });
                        });
                    </script>

                    <table id="i" cellpadding="0" cellspacing="0" class="display" width="100%">
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

     <div class="modal fade bs-example-modal-lg buscar" tabindex="-1" role="dialog" id="auxiliaresb">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Centros de Costo</h5>
                </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function tablej() {
                            $('#j').dataTable({
                                "bProcessing": true,
                                "bDestroy": true,
                                "bPaginate": true,
                                "sPaginationType": "full_numbers",
                                "sAjaxSource": "/sirco/Auxiliares_c/auxiliares/",
                                "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
                            });
                        }

                        $(document).ready(function () {
                            tablej();
                            $('#j').on('click', '.cod', function () {
                                $('#codauxb').val($(this).attr('id'));
                                $('#auxiliaresb').modal('toggle');
                            });
                        });
                    </script>

                    <table id="j" cellpadding="0" cellspacing="0" class="display" width="100%">
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