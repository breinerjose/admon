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

                   <div class="form-group" style="margin-top: 15px;">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Fechas: </label>
                            <input type="text" id="fecini" class="input-group-sm fecha" name="fecini" value="<?php echo date("Y-m-d"); ?>"></br>
                            <input type="text" id="fecfin" class="input-group-sm fecha" name="fecfin" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Cuentas Pcga: </label>
                            <input type="text" class="input-group-sm inputb" name="codctaa" id="codctaa">  
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#cuentas_detallea"  src="/res/icons/sirco/buscar.png"></a>
                            <br>
                            <input type="text" class="input-group-sm inputb" name="codctab" id="codctab" >  
                            <a href="javascript:void(0)"><img class="imgbuscar" vista="#cuentas_detalleb" src="/res/icons/sirco/buscar.png"></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Cuentas Niif: </label>
                            <input type="text" name="codnifa" id="codnifa" class="input-group-sm inputb">  
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#cuentas_niif_detallea" src="/res/icons/sirco/buscar.png"></a></br>
                            <input type="text" name="codnifb" id="codnifb" class="input-group-sm inputb">
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#cuentas_niif_detalleb" src="/res/icons/sirco/buscar.png"></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Terceros: </label>
                            <input type="text" name="codtrca" id="codtrca" class="input-group-sm inputb">
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#busquedatercerosa" src="/res/icons/sirco/buscar.png"></a></br>
                            <input type="text" name="codtrcb" id="codtrcb" class="input-group-sm inputb">
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#busquedatercerosb" src="/res/icons/sirco/buscar.png"></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Centro Costos: </label>
                            <input type="text" name="codctsa" id="codctsa" class="input-group-sm inputb">  
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#centros_costosa" src="/res/icons/sirco/buscar.png"></a></br>
                            <input type="text" name="codctsb" id="codctsb" class="input-group-sm inputb">
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#centros_costosb" src="/res/icons/sirco/buscar.png"></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Auxiliares: </label>
                            <input type="text" name="codauxa" id="codauxa" class="input-group-sm inputb">
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#auxiliaresa" src="/res/icons/sirco/buscar.png"></a></br>
                            <input type="text" name="codauxb" id="codauxb" class="input-group-sm inputb">
                            <a href="javascript:void(0)" ><img class="imgbuscar" vista="#auxiliaresb" src="/res/icons/sirco/buscar.png"></a>
                        </div>
                    </div>

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
                                $('#codctaa').val($(this).attr('id'));
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
                        function table() {
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
                            table();
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
                    <h5 class="modal-title">Cuentas Niif</h5>
              </div>
                <div class="modal-body">
                    <script type="text/javascript">
                        function table() {
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
                            table();
                            $('#c').on('click', '.cod', function () {
                                $('#codnifa').val($(this).attr('id'));
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
                        function table() {
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
                            table();
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
                                $('#codtrca').val($(this).attr('id'));
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
                        function table() {
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
                            table();
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
                        function table() {
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
                            table();
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
                        function table() {
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
                            table();
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
                        function table() {
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
                            table();
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
                        function table() {
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
                            table();
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