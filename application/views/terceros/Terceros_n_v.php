

<script type="text/javascript">

    $(document).ready(function () {

        jQuery.validator.messages.required = "";

        $.validator.setDefaults({ignore: ":hidden:not(select)"});

        $('.chosen-select').chosen({no_results_text: "Resultado no encontrado!"});





        $("[data-mask='phone']").mask("(999)9999999");

        $("[data-mask='celular']").mask("9999999999");

        terceros();

        totales();

        consultarTipoIdentificacion();



        $('#regi_tercero').click(function () {

            var estado = validarSelect();



            if ($("form#registrar_tercero").validate().form() == true && estado == true) {

                $.ajax({

                    url: '/Terceros_c/terceros_i',

                    type: 'POST',

                    dataType: 'JSON',

                    data: $('form#registrar_tercero').serialize(),

                    success: function (ans) {

                        if (ans.err == '1') {

                            toastr.success('Datos Insertados Satisfactoriamente');

                            $('form#registrar_tercero').get(0).reset();

                            $('#nom_tipidentificacion').trigger('chosen:updated');
                            $('#stdusr').trigger('chosen:updated');


                            $('#new-tercero').css('display', 'none');

                            $('#tabla-terceros').css('display', 'block');

                            terceros();

                            totales();

                        } else
                            toastr.error(ans.msg);



                    }

                });



            }//else alert('Hay campos Requeridos');

        });









        $('#edi_tercero').click(function () {

            var estado = validarSelect();



            if ($("form#registrar_tercero").validate().form() == true && estado == true) {

                $.ajax({

                    url: '/Terceros_c/terceros_u',

                    type: 'POST',

                    dataType: 'JSON',

                    data: $('form#registrar_tercero').serialize(),

                    success: function (ans) {

                        if (ans.err == '1') {

                            toastr.success('Datos Editados Satisfactoriamente');

                            $('form#registrar_tercero').get(0).reset();

                            $('#nom_tipidentificacion').trigger('chosen:updated');
                            $('#stdusr').trigger('chosen:updated');

                            $('#new-tercero').css('display', 'none');

                            $('#tabla-terceros').css('display', 'block');

                            terceros();

                            totales();

                        } else
                            toastr.error('hubo un error al editar los datos');



                    }

                });



            }//else alert('Hay campos Requeridos');

        });

        $('#add_tercero').click(function () {

            $('form#registrar_tercero').get(0).reset();

            $('#nom_tipidentificacion').trigger('chosen:updated');

            $('#stdusr').trigger('chosen:updated');

            $('#new-tercero').css('display', 'block');

            $('#tabla-terceros').css('display', 'none');

            $('#regi_tercero').css('display', 'inline-block');

            $('#edi_tercero').css('display', 'none');

            $('#id_cliente').prop('readonly', false);



        });

        $('#cance_tercero').click(function () {

            $('#new-tercero').css('display', 'none');

            $('#tabla-terceros').css('display', 'block');

            terceros();

            totales();

        });



        $(document).on('click', '.d', function () {

            $('#regi_tercero').css('display', 'none');

            $('#edi_tercero').css('display', 'inline-block');

            $('#new-tercero').css('display', 'block');

            $('#tabla-terceros').css('display', 'none');

            $('#id_cliente').prop('readonly', true);

            $('form#registrar_tercero').get(0).reset();



            var id = $(this).attr('data-idc');

            var nom_tipidentificacion = $(this).attr('data-tip');

            var telefono_fijo = $(this).attr('data-fij');

            var telefono_movil = $(this).attr('data-mov');

            var direccion = $(this).attr('data-dir');

            var email = $(this).attr('data-ema');

            var nombre = $(this).attr('data-nom');

            $('#stdusr').val($(this).attr('stdusr'));

            $('#stdusr').trigger('chosen:updated');

            $('#valpla').val($(this).attr('valpla'));

            $('#ip').val($(this).attr('data-ip'));

            $('#mac').val($(this).attr('data-mac'));
			
			$('#fecafl').val($(this).attr('data-fecafl'));

            $('#nom_tipidentificacion').val(nom_tipidentificacion);



            $('#nom_tipidentificacion').val(nom_tipidentificacion);

            $('#nom_tipidentificacion').trigger('chosen:updated');

            $('#telefono_movil').val(telefono_movil);

            $('#telefono_fijo').val(telefono_fijo);

            $('#direccion').val(direccion);

            $('#email').val(email);

            $('#nombre').val(nombre);

            $('#id_cliente').val(id);

        });



        totales();

    });



    function totales() {

        $.ajax({

            url: '/Terceros_c/totales',

            type: 'POST',

            dataType: 'JSON',

            data: {},

            success: function (ans) {

                $('#total').val(ans.a.total);

                $('#total').trigger('blur');

            }

        });

    }



    function terceros() {

        var oTable = $('#listado_historias').dataTable({

            "bPaginate": true,

            "ordering": true,

            "bLengthChange": true,

            "responsive": true,

            "bInfo": true,

            "bFilter": true,

            "bDestroy": true,

            "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"},

            "ajax": {

                "url": "/Terceros_c/terceros/",

                "type": "POST",

                "data": {}



            }

        });

    }

    function consultarTipoIdentificacion() {

        $('#nom_tipidentificacion').empty();

        $('#nom_tipidentificacion').html('<option value=""></option');



        $.ajax({

            url: '/Terceros_c/tip_ide',

            type: 'POST',

            dataType: 'JSON',

            data: {"tipper": "1"},

            success: function (ans) {

                if (ans.e.err == '1') {

                    for (x in ans.a) {

                        $('<option/>').val(ans.a[x].codtip).text(ans.a[x].dsctip).appendTo('#nom_tipidentificacion');

                    }



                }

                $('#nom_tipidentificacion').trigger('chosen:updated');





            }

        });

    }



    function validarSelect() {

        var estado = true;

        $('.validar').each(function (index, element) {

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





</script>

<style type="text/css">

    .chosen-container{width: 100% !important;color:#333;}

    .chosen-container-single .chosen-single{line-height:32px;}

    .chosen-container-single .chosen-single div{top:5px;}

    td input.error{

        border-color:#3D7BCF; background:#DFEEFF;

    }

    td label.error{ display: none !important; }

    .form-group .error{border-color:#3D7BCF; background:#DFEEFF; }

    .input-group .error{border-color:#3D7BCF; background:#DFEEFF; }



</style>



<div id="new-tercero" style="display: none;" >

    <div class="x_title titulo" id="">

        <h2 class="color-info">Agregar Nuevo Tercero</h2>



        <div class="clearfix"></div>

    </div>

    <div class="x_content">     

        <div class="row">                           

            <form action="" method="POST" class="form-horizontal"  id="registrar_tercero" name="registrar_tercero" role="form">                          

                <div class="col-md-6">

                    <div class="form-group">

                        <label> Id Cliente / NIT</label>

                        <input class="form-control required" placeholder="CC/ NIT" id="id_cliente" name="id_cliente" type="text">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Tipo Indentificacion</label>

                        <select class="chosen-select required validar"  data-placeholder="Seleccione Tipo Indentificacion"  name="nom_tipidentificacion" id="nom_tipidentificacion">

                            <option value=""></option>                                   

                        </select>                           

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">

                        <label>Nombre </label>

                        <input class="form-control required" placeholder="Primer Nombre"  id="nombre" name="nombre" type="text">

                    </div>

                </div>

                <div class="clearfix"></div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label> Direccion </label>

                        <input class="form-control required" placeholder="Direccion"  id="direccion" name="direccion" type="text">

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group">

                        <label>Email</label>

                        <input class="form-control email" placeholder="Email"   id="email" name="email" type="text">



                    </div>

                </div> <div class="clearfix"></div>       

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Telefono Fijo  </label>

                        <input class="form-control" placeholder="Telefono Fijo" id="telefono_fijo" name="telefono_fijo" data-mask="phone" type="text">

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Telefono Movil  </label>

                        <input class="form-control required" placeholder="Telefono Movil" id="telefono_movil" data-mask='celular'  name="telefono_movil" type="text">

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Ip  </label>

                        <input class="form-control required" placeholder="xxx.xxx.xxx.xxx" id="ip" name="ip" type="text">

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Mac  </label>

                        <input class="form-control required" placeholder="00:00:00" id="mac"  name="mac" type="text">

                    </div>

                </div>
				
				<div class="col-md-3">

                    <div class="form-group">

                        <label>Fch. Afiliacion  </label>

                        <input class="form-control required" placeholder="aaaa-mm-dd" id="fecafl"  name="fecafl" type="text">

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Clave</label>

                        <input class="form-control" placeholder="Clave del Usuario" id="clave" name="clave" type="text">

                    </div>

                </div>



                <div class="col-md-3">

                    <div class="form-group">

                        <label>Valor Plan</label>

                        <input class="form-control" placeholder="$$$$" id="valpla" name="valpla" type="text">

                    </div>

                </div>



                <div class="col-md-3">

                    <div class="form-group">

                        <label>Estado</label>

                        <select class="chosen-select required validar"  data-placeholder="Activo / Inactivo"  name="stdusr" id="stdusr">

                            <option value=""></option>

                            <option value="Activo">Activo</option>

                            <option value="Inactivo">Inactivo</option>                                   

                        </select>  

                    </div>

                </div>



                <div class="clearfix"></div>

            </form>    

        </div>

        <br>

        <div class="row">

            <div class="form-group">

                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">

                    <button type="button" id="regi_tercero" class="btn btn-success">

                        <i class="fa fa-save"></i> Registrar Tercero</button>

                    <button class="btn btn-warning" id="edi_tercero" style="display: none;"><i class="fa fa-pencil"></i> Editar Datos</button> 

                    <button class="btn btn-danger" id="cance_tercero"><i class="fa fa-times"></i>Cancelar</button>



                </div>

            </div>



        </div>













    </div>

</div>



<div class="row" id="tabla-terceros">

    <div class="col-md-6">

        <div class="form-group">

            <button class="btn btn-primary" id="add_tercero"><i class="fa fa-plus"></i> Agregar Terceros</button>

        </div>

    </div>

    <div class="col-md-2">

        <div class="form-group">

            <span> Total Clientes</span> 

        </div>

    </div>

    <div class="col-md-4">

        <div class="form-group">

            <input class="form-control" id="total" name="total" type="text" disabled="disabled">

        </div>

    </div>

    <div class="col-md-12">

        <table class="table table-bordered table-striped dt-responsive " id="listado_historias">

            <thead>

                <tr>

                                                <!--<th width="10%">Fecha</th>-->

                    <th width="10%">Id</th>

                    <th width="32%">Nombre</th>

                    <th width="15%">Ip</th>

                    <th width="18%">Mac</th>

                    <th width="10%">Celular</th>

                    <th width="5%">Plan</th>

                    <th width="5%">Estado</th>

                    <th width="5%">Acciones</th>

                       <!-- <th width="8%">Id</th>

                        <th width="30%">Paciente</th>-->

                </tr>

            </thead>

            <tbody>

            </tbody>

        </table>

    </div>



</div>

