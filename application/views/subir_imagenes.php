<form method="post" id="imagen" enctype="multipart/form-data">
<select class="chosen-select valid_sele" id="codtrc" name="codtrc" data-placeholder="Seleccione Paciente" required>
<option value=""></option>           
     </select>
     <label class="control-label">Sello</label>
      <input type="file" name="sello">
        <div id="sello"></div>
     <label class="control-label">Firma</label>
      <input type="file" name="firma">
		<div id="firma"></div>
     <label class="control-label">Foto</label>
      <input type="file" name="foto">
      <div id="foto"></div>
 </form>
     <script>
     $(function(){
        $("input[name='sello']").on("change", function(){
            var formData = new FormData($("#imagen")[0]);
            var ruta = "/Terceros_c/sello/";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#sello").html(datos);
                }
            });
        });
     });
	 
	  $(function(){
        $("input[name='foto']").on("change", function(){
            var formData = new FormData($("#imagen")[0]);
            var ruta = "/Terceros_c/foto/";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#foto").html(datos);
                }
            });
        });
     });
	 
	  $(function(){
        $("input[name='firma']").on("change", function(){
            var formData = new FormData($("#imagen")[0]);
            var ruta = "/Terceros_c/firma/";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#firma").html(datos);
                }
            });
        });
     });
    </script>
    <script type="text/javascript">
	
    	$(document).ready(function(e) {
            init_wysiwyg();
			
			 $("#codtrc").chosen({no_results_text: "Resultado no encontrado!",allow_single_deselect: true});
		$.post('/Terceros_c/pacientes',function(resp){
		$.each(resp,function(i,v){
			$('#codtrc').append('<option value="'+v.id_cliente+'">'+v.id_cliente+' - '+v.nombre+'</option>');
		});	$('#codtrc').trigger("chosen:updated");
	},'json');
		
		$("#codtrc").on('change',function(){
		$("#firma").html('');
	    $("#foto").html('');
	    $("#sello").html('');
	});
			
			$(function(){
        $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            //formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "/recibe.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	     processData: false
            })
                .done(function(res){
                    $("#mensaje").html("Respuesta: " + res);
                });
        });
    });
	
        });
		
		
		function init_wysiwyg() {
			
		if( typeof ($.fn.wysiwyg) === 'undefined'){ return; }
		console.log('init_wysiwyg');	
			
        function init_ToolbarBootstrapBindings() {
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

       $('.editor-wrapper').each(function(){
			var id = $(this).attr('id');	//editor-one
			
			$(this).wysiwyg({
				toolbarSelector: '[data-target="#' + id + '"]',
				fileUploadError: showErrorAlert
			});	
		});
 
		
       
   
	
    };
    </script>
	
  