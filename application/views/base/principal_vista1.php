<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>La castellana </title>
    <link href="../res/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../res/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../res/build/css/custom.min.css" rel="stylesheet">
    <link href="../res/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../res/bootstrap/css/bootstrap-chosen.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../res/js/bootstrap-datepicker.min.css" />
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>La Castellana</span></a>
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
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../res/icons/base/img.jpg" alt=""><span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
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
				<iframe src="../base/principal.html" name="formularios" id="formu2" width="100%" height="500px" frameborder="0" ></iframe>
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
       <script src="../res/js/jquery.blockUI.js" type="text/javascript"></script>  
   		<script type="text/javascript" language="javascript" src="../res/js/validation/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" language="javascript" src="../res/js/validation/localization/messages_es.js"></script>
    	<script type="text/javascript" language="javascript" src="../res/js/dataTables.bootstrap.js"></script>
		<script type="text/javascript" language="javascript" src="../res/js/jquery.dataTables.min.js"></script>
    	<script src="../res/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="../res/build/js/custom.min.js"></script>
        <script src="../res/js/moment.min.js"></script> 
		<script src="../res/bootstrap/validador/validator.min.js"></script>
    <script type="text/javascript" src="../res/js/bootstrap-datepicker.min.js"></script>
    
    <!-- Flot -->
    <script>
	$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
      $(document).ready(function() {
		  
//		   $(".select2_single").select2({
//          placeholder: "Select a state",
//          allowClear: true
//        });
//        $(".select2_group").select2({});
//        $(".select2_multiple").select2({
//          maximumSelectionLength: 4,
//          placeholder: "With Max Selection limit 4",
//          allowClear: true
//        });
		
		$('.mnu').click(function(){
			var url=$(this).attr('url');
			$('#formularios').load('/Login_c/cargarMenu',{"url":url});
			$('#formu2').attr('src','');
		});
		$('.mnu2').click(function(){
			var url=$(this).attr('url');
			$('#formularios').html('');
			$('#formu2').attr('src',url);
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
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

       // new Chart(document.getElementById("canvas1"), {
//          type: 'doughnut',
//          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
//          data: {
//            labels: [
//              "Symbian",
//              "Blackberry",
//              "Other",
//              "Android",
//              "IOS"
//            ],
//            datasets: [{
//              data: [15, 20, 30, 10, 30],
//              backgroundColor: [
//                "#BDC3C7",
//                "#9B59B6",
//                "#E74C3C",
//                "#26B99A",
//                "#3498DB"
//              ],
//              hoverBackgroundColor: [
//                "#CFD4D8",
//                "#B370CF",
//                "#E95E4F",
//                "#36CAAB",
//                "#49A9EA"
//              ]
//            }]
//          },
//          options: options
//        });
      });
    </script>
    <!-- /Doughnut Chart -->
    
    <!-- bootstrap-daterangepicker -->
   <script>
//      $(document).ready(function() {
//
//        var cb = function(start, end, label) {
//          console.log(start.toISOString(), end.toISOString(), label);
//          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//        };
//
//        var optionSet1 = {
//          startDate: moment().subtract(29, 'days'),
//          endDate: moment(),
//          minDate: '01/01/2012',
//          maxDate: '12/31/2015',
//          dateLimit: {
//            days: 60
//          },
//          showDropdowns: true,
//          showWeekNumbers: true,
//          timePicker: false,
//          timePickerIncrement: 1,
//          timePicker12Hour: true,
//          ranges: {
//            'Today': [moment(), moment()],
//            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//            'This Month': [moment().startOf('month'), moment().endOf('month')],
//            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//          },
//          opens: 'left',
//          buttonClasses: ['btn btn-default'],
//          applyClass: 'btn-small btn-primary',
//          cancelClass: 'btn-small',
//          format: 'MM/DD/YYYY',
//          separator: ' to ',
//          locale: {
//            applyLabel: 'Submit',
//            cancelLabel: 'Clear',
//            fromLabel: 'From',
//            toLabel: 'To',
//            customRangeLabel: 'Custom',
//            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
//            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
//            firstDay: 1
//          }
//        };
//        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
//        $('#reportrange').daterangepicker(optionSet1, cb);
//        $('#reportrange').on('show.daterangepicker', function() {
//          console.log("show event fired");
//        });
//        $('#reportrange').on('hide.daterangepicker', function() {
//          console.log("hide event fired");
//        });
//        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
//          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
//        });
//        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
//          console.log("cancel event fired");
//        });
//        $('#options1').click(function() {
//          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
//        });
//        $('#options2').click(function() {
//          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
//        });
//        $('#destroy').click(function() {
//          $('#reportrange').data('daterangepicker').remove();
//        });
//      });
//    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- gauge.js -->
<!--    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = 6000;
      gauge.animationSpeed = 32;
      gauge.set(3200);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
-->    <!-- /gauge.js -->
 </nav>
  </body>
</html>
