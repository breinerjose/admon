<script type="text/javascript">
    
    $(document).ready(function () {
        $('#cuentas_locales').hide();
        
        $('.buscar').on('shown.bs.modal', function () {
            $('.buscar input[type="search"]').focus();
        });


        $('input:radio[name="tipo"]').click(function () {
            var tipo = $('input:radio[name="tipo"]:checked').val();
            if (tipo == 'Local') {
                $('#cuentas_niif').hide();
                $('#cuentas_locales').show();
            } else {
                $('#cuentas_niif').show();
                $('#cuentas_locales').hide();
            }
        });


        $("#codsed").chosen({no_results_text: "Resultado no encontrado!"});
        $.post('/sirco/Sedes_c/selectsedes', function (resp) {
            $.each(resp, function (i, v) {
                $('#codsed').append('<option value="' + v.codsed + '">' + v.codsed + ' - ' + v.nomsed + '</option>');
            });
            $('#codsed').trigger("chosen:updated");
        }, 'json');

        $('.imgbuscar').click(function () {
            cod_vista = $(this).attr('vista');
            $(cod_vista).modal();
           
        });

        $('#imprimir').button().on('click', function (e) {
            e.preventDefault();
            var tipo = $('input:radio[name="tipo"]:checked').val();
            var tipo_informe = $('input:radio[name="tipo_informe"]:checked').val();
            var tipimp = $('input:radio[name="tipimp"]:checked').val();
            var fecini = $('#fecini').val();
            var fecfin = $('#fecfin').val();

            if (fecini != '' && fecfin == '') {
                var fecfin = fecini;
            }
            if (fecini == '') {
                var fecini = 'n';
                var fecfin = 'n';
            }

            if (tipo == 'Niif') {
                var codctaa = $('#codnifa').val();
                codctaa = codctaa.trim();
                var codctab = $('#codnifb').val();
                codctab = codctab.trim();
                if (codctaa != '' && codctab == '') {
                    var codctab = codctaa;
                }
                if (codctaa == '') {
                    var codctaa = 'n';
                    var codctab = 'n';
                }
            } else {
                var codctaa = $('#codctaa').val();
                codctaa = codctaa.trim();
                var codctab = $('#codctab').val();
                codctab = codctab.trim();
                if (codctaa != '' && codctab == '') {
                    var codctab = codctaa;
                }
                if (codctaa == '') {
                    var codctaa = 'n';
                    var codctab = 'n';
                }
            }
            var codtrca = $('#codtrca').val();
            codtrca = codtrca.trim();
            var codtrcb = $('#codtrcb').val();
            codtrcb = codtrcb.trim();
            if (codtrca != '' && codtrcb == '') {
                var codtrcb = codtrca;
            }
            if (codtrca == '') {
                var codtrca = 'n';
                var codtrcb = 'n';
            }


            var codctsa = $('#codctsa').val();
            codctsa = codctsa.trim();
            var codctsb = $('#codctsb').val();
            codctsb = codctsb.trim();
            if (codctsa != '' && codctsb == '') {
                var codctsb = codctsa;
            }
            if (codctsa == '') {
                var codctsa = 'n';
                var codctsb = 'n';
            }


            var codauxa = $('#codauxa').val();
            codauxa = codauxa.trim();
            var codauxb = $('#codauxb').val();
            codauxb = codauxb.trim();
            if (codauxa != '' && codauxb == '') {
                var codauxb = codauxa;
            }
            if (codauxa == '') {
                var codauxa = 'n';
                var codauxb = 'n';
            }

            var codsed = ($('#codsed').val() == '' || $('#codsed').val() == null) ? 'n' : $('#codsed option:selected').text();//sede

            if ($('#fecini').val() != '') {
                window.open("/sirco/Anexo_c/anexo/" + fecini + "/" + fecfin + "/" + codctaa + "/" + codctab + "/" + codtrca + "/" + codtrcb + "/" + codctsa + "/" +
                        codctsb + "/" + codauxa + "/" + codauxb + "/" + tipimp + "/" + codsed + "/" + tipo + "/" + tipo_informe, "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1100, height=600");
            }
            else {
                alert('Debe Seleccionar Fecha Inicial');
            }

        });

        $('#excel').button().on('click', function (e) {
            e.preventDefault();
            var tipo = $('input:radio[name="tipo"]:checked').val();
            var tipo_informe = $('input:radio[name="tipo_informe"]:checked').val();
            var tipimp = $('input:radio[name="tipimp"]:checked').val();
            var saldo = $('input:radio[name="saldo"]:checked').val();
            var fecini = $('#fecini').val();
            var fecfin = $('#fecfin').val();

            if (fecini != '' && fecfin == '') {
                var fecfin = fecini;
            }
            if (fecini == '') {
                var fecini = 'n';
                var fecfin = 'n';
            }

            if (tipo == 'Niif') {
                var codctaa = $('#codnifa').val();
                codctaa = codctaa.trim();
                var codctab = $('#codnifb').val();
                codctab = codctab.trim();
                if (codctaa != '' && codctab == '') {
                    var codctab = codctaa;
                }
                if (codctaa == '') {
                    var codctaa = 'n';
                    var codctab = 'n';
                }
            } else {
                var codctaa = $('#codctaa').val();
                codctaa = codctaa.trim();
                var codctab = $('#codctab').val();
                codctab = codctab.trim();
                if (codctaa != '' && codctab == '') {
                    var codctab = codctaa;
                }
                if (codctaa == '') {
                    var codctaa = 'n';
                    var codctab = 'n';
                }
            }
            var codtrca = $('#codtrca').val();
            codtrca = codtrca.trim();
            var codtrcb = $('#codtrcb').val();
            codtrcb = codtrcb.trim();
            if (codtrca != '' && codtrcb == '') {
                var codtrcb = codtrca;
            }
            if (codtrca == '') {
                var codtrca = 'n';
                var codtrcb = 'n';
            }


            var codctsa = $('#codctsa').val();
            codctsa = codctsa.trim();
            var codctsb = $('#codctsb').val();
            codctsb = codctsb.trim();
            if (codctsa != '' && codctsb == '') {
                var codctsb = codctsa;
            }
            if (codctsa == '') {
                var codctsa = 'n';
                var codctsb = 'n';
            }


            var codauxa = $('#codauxa').val();
            codauxa = codauxa.trim();
            var codauxb = $('#codauxb').val();
            codauxb = codauxb.trim();
            if (codauxa != '' && codauxb == '') {
                var codauxb = codauxa;
            }
            if (codauxa == '') {
                var codauxa = 'n';
                var codauxb = 'n';
            }

            var codsed = ($('#codsed').val() == '' || $('#codsed').val() == null) ? 'n' : $('#codsed option:selected').text();//sede
            if ($('#check1').is(':checked')) {
                var acumulado = 1;
            } else {
                var acumulado = 0;
            }
            if ($('#fecini').val() != '') {
                window.open("/sirco/Anexo_c/exogena/" + fecini + "/" + fecfin + "/" + codctaa + "/" + codctab + "/" + codtrca + "/" + codtrcb + "/" + codctsa + "/" +
                        codctsb + "/" + codauxa + "/" + codauxb + "/" + tipimp + "/" + codsed + "/" + tipo + "/" + tipo_informe + "/" + saldo + "/" + acumulado);
            }
            else {
                alert('Debe Seleccionar Fecha Inicial');
            }

        });

    });
</script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <div class="panel panel-primary">
                <div class="panel-heading">OPCIONES DE IMPRESIÓN ANEXO DE BALANCE</div>
                <div class="panel-body">

     <?php $this->load->view('/sirco/modales_v'); ?>


                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Impresora: </label></br>
                            <input name="tipimp" type="radio" id="tipimp" value="punto" /> De Punto&nbsp;&nbsp;&nbsp;
                            <input name="tipimp" type="radio" id="tipimp" value="laser" checked  /> Laser
                        </div>
                    </div>


                    <div class="form-group" style="margin-top: 15px;">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Tipo Contabilidad: </label></br>
                            <input type="radio" name="tipo"  value="Local">
                            &nbsp;Pcga&nbsp;&nbsp;&nbsp;
                            <input name="tipo" type="radio" value="Niif" checked>
                            &nbsp;Niif 
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label> Sede: </label></br><select id="codsed" name="codsed"  data-placeholder="Seleccione" class="chosen-select"></select>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label> Tipo Informe: </label></br>
                            <input type="radio" name="tipo_informe" value="web" checked> Web&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="tipo_informe" value="pdf" > Pdf&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="tipo_informe" value="excel" > Excel&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-md-2 col-sm-2 col-xs-12" style="margin-top:25px;">
                            <button type="button" id="imprimir" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir </button>
                        </div>
                    </div>
                </div>
            </div>
            </div>


            <div class="col-md-12">
 <div class="panel panel-info">
                <div class="panel-heading">ARCHIVO EXCEL INFORMACION EXOGENA</div>
                <div class="panel-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="checkbox" value="acumulado" id="check1" name="check" /> <label> Saldo Acumulado&nbsp;&nbsp;</label>
                            <input type="radio" name="saldo" class="radio" value="debito" checked><label>&nbsp;Debito&nbsp;&nbsp;</label>
                            <input type="radio" name="saldo" class="radio" value="credito" ><label>&nbsp;Credito&nbsp;&nbsp;</label>
                            <input type="radio" name="saldo" class="radio" value="saldo" ><label>&nbsp;Saldo&nbsp;&nbsp;</label>
                            <button type="button" id="excel" class="btn btn-success"><i class="fa fa-sticky-note"></i> Generar Excel </button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        </div>
        </div>