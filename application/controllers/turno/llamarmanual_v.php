<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript">
	$(document).ready(function(){
			CargarTablaHistorias();
	});
	
	function CargarTablaHistorias(){
				var oTable = $('#listado_historias').dataTable({
							  "bPaginate": true,
							  "ordering": true,
							  "bLengthChange": true,
							  "responsive": true,
							  "bInfo": true,
							  "bFilter": true,
							  "bDestroy": true,
							  "sAjaxSource": "/Turno_c/listadobrigadas/",
							  "oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
    			});	
	}
	
	
	</script>
	</head>
<body>
<div class="container">
<div class="row">
	<div class="col-md-12">
	<div class="table-responsive">
	  <table class="table table-bordered table-striped dt-responsive " id="listado_historias">
				 <thead>
					<tr>
						<th width="5%">No. Historia</th>
						<th width="15%">Identificacion</th>
						<th width="35%">Nombre</th>
						<th width="35%">Empresa</th>
						<th width="10%">Fecha</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
	</table>
	</div>
	</div>
	</div>
</div>
</body>
</html>