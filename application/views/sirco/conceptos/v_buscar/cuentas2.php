<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_page.css" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_table.css"/>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/res/js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	function table(){
		$('#cuentas').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"sScrollY" : '160px',
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/sirco/puc_c/obtener_cuentas_nvl/",
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}	

$(document).ready(function() {
    table();
	
	$('#cuentas').on('click','.cod',function(){
		codigo = $(this).attr('id');
		window.parent.cerrar_cuentas2(codigo);
	});
});
</script>
<style>
	body{ font-size:12px;}
</style>
</head>
<body>
<table id="cuentas" cellpadding="0" cellspacing="0" class="display" width="100%">
<thead>
<tr>
<th width="20%">Codigo</th>
<th width="40%">Nombres</th>
<th width="20%">Tipo</th>
<th width="20%">Nivel</th>
</tr>
</thead> 
<tbody>

</tbody>
</table>
</body>
</html>