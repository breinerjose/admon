<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laboratorio Clinico la Castellana </title>

    <!-- Bootstrap -->
    <link href="../res/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../res/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <!-- Custom Theme Style -->
    <link href="../res/build/css/custom.min.css" rel="stylesheet">
     <!-- jQuery -->
    <script src="../res/vendors/jquery/dist/jquery.min.js"></script>
   
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
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
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
                    <img src="../res/icons/base/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="../res/icons/base/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
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
	    <script src="../res/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	  <script src="../res/build/js/custom.min.js"></script>
    
    
    <!-- jQuery -->
    <!--<script type="text/javascript" language="javascript" src="../res/jquery/js/jquery.js"></script>-->
   <!-- <script src="../res/bootstrap/js/bootstrap.min.js"></script>-->
    
   <!-- Inicio Breiner-->
   <!-- <script type="text/javascript" language="javascript" src="/res/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="/res/js/dataTables.bootstrap.js"></script>
    <script src="/res/js/jquery.validate.min.js"></script>-->
   <!-- Fin Breiner-->
    
    <!-- <script src="../res/bootstrap/js/bootstrap-wysiwyg.min.js"></script>-->
    
  <!--  <script src="../res/fastclick/lib/fastclick.js"></script>-->
   <!-- <script src="../res/nprogress/nprogress.js"></script>-->
    <!--<script src="../res/bootstrap/js/bootstrap-progressbar.min.js"></script>-->
   
  <!--  <script src="../res/iCheck/icheck.min.js"></script>-->
   
   <!-- <script src="../res/js/jquery.hotkeys.js"></script>-->
   <!-- <script src="../res/google-code-prettify/src/prettify.js"></script>-->
   <!-- <script src="../res/js/jquery.tagsinput.js"></script>-->
    <!--<script src="../res/switchery/dist/switchery.min.js"></script>-->
   <!-- <script src="../res/select2/dist/js/select2.full.min.js"></script>-->
    <!--<script src="../res/js/autosize.min.js"></script>-->
    <!--<script src="../res/js/custom.min.js"></script>-->
<!--    <script src="../res/js/jquery.autocomplete.min.js"></script>
    <script src="../res/starrr/dist/starrr.js"></script>-->
  
    
    <script>
      $(document).ready(function() {
        function initToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
              'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
              'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          });
          $('a[title]').tooltip({
            container: 'body'
          });
          $('.dropdown-menu input').click(function() {
              return false;
            })
            .change(function() {
              $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function() {
              this.value = '';
              $(this).change();
            });

          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this),
              target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          });

          if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top,
              left: editorOffset.left + $('#editor').innerWidth() - 35
            });
          } else {
            $('.voiceBtn').hide();
          }
        }

        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        /*$('#editor').wysiwyg({
          fileUploadError: showErrorAlert
        });*/

        window.prettyPrint;
        prettyPrint();
      });
    </script>
    <!-- /bootstrap-wysiwyg -->

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select a state",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
		
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
		
      });
    </script>
    <!-- /Select2 -->

    <!-- jQuery Tags Input -->
    <script>
      function onAddTag(tag) {
        alert("Added a tag: " + tag);
      }

      function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
      }

      function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
      }

      /*$(document).ready(function() {
        $('#tags_1').tagsInput({
          width: 'auto'
        });
      });*/
    </script>
    <!-- /jQuery Tags Input -->

    <!-- Parsley -->

    <!-- Autosize -->
    <script>
      $(document).ready(function() {
        autosize($('.resizable_textarea'));
      });
    </script>
    <!-- /Autosize -->

  </body>
</html>