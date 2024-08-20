<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html;  es_CO.utf8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta charset=" es_CO.utf8"/>
        
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
 
        <title>Sysred</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="../res/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../res/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <link href="../res/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <link href="../res/build/css/custom.min.css" rel="stylesheet">
        <link href="../res/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../res/bootstrap/css/bootstrap-chosen.css" rel="stylesheet">
        <link href="../res/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../res/js/bootstrap-datepicker.min.css" />   
        <link rel="stylesheet" type="text/css" href="../res/js/bootstrap-datetimepicker.min.css" />  
        <link rel="stylesheet" href="/res/js/toastr/toastr.min.css"/>
        <link rel="stylesheet" type="text/css" href="/res/js/bootstrap.switch/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="/res/css/editor.css" />
        <link rel="stylesheet" type="text/css" href="../res/dist/bootstrap-clockpicker.min.css">
        <!-- PNotify -->
        <link href="/res/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="/res/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="/res/pnotify/dist/pnotify.nonblock.css" rel="stylesheet"> 
        <link href="/res/jquery.validationEngine/validationEngine.jquery.css" rel="stylesheet">
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Sysred</span></a>
                        </div>
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>&nbsp;</h3>
                                <ul class="nav side-menu">
                                    <?php echo $menu; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-footer hidden-small">

                        </div>
                    </div>
                </div>

                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right"><?PHP echo $nomtrc; ?>
                                <li><a href="../../"><i class="fa fa-sign-out pull-right"></i>Salir</a></li>
                            </ul>
                            </li>
                            <li>
                                <div class="text-center">                        
                                </div>
                            </li>
                            </ul>
                            </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_right">
                                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <!--corte-->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="col-md-12" id="formularios"></div>
                            </div> 
                        </div>
                    </div>
                    <!-- /page content -->
                    <!-- footer content -->
                    <footer>
                        <div class="pull-right">
                            aprendeconbreiner@gmail.com
                        </div>

                    </footer>
                    <!-- /footer content -->
                </div>
            </div>
            <!-- footer content -->
            <!-- /footer content -->
        </div>
    </div>
    <script type="text/javascript" language="javascript" src="../res/vendors/jquery/dist/jquery.js"></script>
    <script src="../res/js/chosen.jquery.js" type="text/javascript"></script>     
    <script type="text/javascript" language="javascript" src="../res/js/validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" language="javascript" src="../res/js/validation/localization/messages_es.js"></script>
    <script type="text/javascript" language="javascript" src="../res/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="../res/js/dataTables.bootstrap.js"></script>
    <script src="../res/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../res/js/moment.min.js"></script> 
    <script src="../res/js/basico.js"></script> 
            <!--<script src="../res/bootstrap/validador/validator.min.js"></script>-->
    <script type="text/javascript" src="../res/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="../res/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../res/vendors/switchery/dist/switchery.min.js"></script>
    <script src="../res/vendors/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="/res/js/toastr/toastr.min.js"></script>
    <script src="/res/js/jquery.maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="/res/js/bootstrap.switch/bootstrap-switch.min.js"></script>
    <script src="../res/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../res/js/bootstrap.switch/bootstrap-switch.min.js"></script> 
    <script type="text/javascript" src="../res/js/autoNumeric-min.js"></script>
    <script type="text/javascript" src="../res/dist/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript" src="../res/js/editor.js"></script>
    <!-- PNotify -->
    <script src="/res/pnotify/dist/pnotify.js"></script>
    <script src="/res/pnotify/dist/pnotify.buttons.js"></script>
    <script src="/res/pnotify/dist/pnotify.nonblock.js"></script>
    <script src="/res/pnotify/dist/pnotify.callbacks.js"></script>
    <script src="/res/pnotify/dist/pnotify,TabbedNotification.js"></script>
	<script src="/res/bootstrap/fnReloadAjax.js"></script>
    <script src="/res/jquery.validationEngine/jquery.validationEngine.js"></script>
    <script src="/res/jquery.validationEngine/jquery.validationEngine-es.js"></script>
    <!-- <script type="text/javascript" language="javascript" src="../res/js/DYMO.Label.Framework_2.0Beta.js"></script>-->
    <script src="../res/build/js/custom.min.js"></script>

    <!-- Flot -->
    
    <script>
        $(document).ready(function () {

            if (typeof toastr != 'undefined') {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }

            $('.mnu').click(function () {
                var url = $(this).attr('url');
                $('#formularios').load('/Login_c/cargarMenu', {"url": url});
                $('#formu2').attr('src', '');
            });
            $('.mnu2').click(function () {
                var url = $(this).attr('url');
                $('#formularios').html('');
                $('#formu2').attr('src', url);
            });


            var data1 = [
                [gd(2012, 1, 1), 17],
                [gd(2012, 1, 2), 74],
                [gd(2012, 1, 3), 6],
                [gd(2012, 1, 4), 39],
                [gd(2012, 1, 5), 20],
                [gd(2012, 1, 6), 85],
                [gd(2012, 1, 7), 7]
            ];

            var data2 = [
                [gd(2012, 1, 1), 82],
                [gd(2012, 1, 2), 23],
                [gd(2012, 1, 3), 66],
                [gd(2012, 1, 4), 9],
                [gd(2012, 1, 5), 119],
                [gd(2012, 1, 6), 6],
                [gd(2012, 1, 7), 9]
            ];
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                data1, data2
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    verticalLines: true,
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#fff'
                },
                colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                xaxis: {
                    tickColor: "rgba(51, 51, 51, 0.06)",
                    mode: "time",
                    tickSize: [1, "day"],
                    //tickLength: 10,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10
                },
                yaxis: {
                    ticks: 8,
                    tickColor: "rgba(51, 51, 51, 0.06)",
                },
                tooltip: false
            });

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            var options = {
                legend: false,
                responsive: false
            };
        });
    </script>


</nav>
	<?php $this->load->view('/sirco/s_modales_v'); ?>
	<?php $this->load->view('/sirco/busqueda_ter_alm_v'); ?>
</body>
</html>
