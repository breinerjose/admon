<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_page.css"/>
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_table.css"/>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<script src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/res/js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	function table(){
		$('#codaux').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": true,
			"sScrollY" : '160px',
			"sPaginationType": "full_numbers",
			"sAjaxSource": "/sirco/auxiliares_c/auxiliares/",
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}	

$(document).ready(function() {
    table();
	
	$('#codaux').on('click','.cod',function(){
		codigo = $(this).attr('id');
		window.parent.buscaraux1(codigo);
	});
});
</script>
<style>
	body{ font-size:12px;}
</style>
</head>
<body>
<table id="codaux" cellpadding="0" cellspacing="0" class="display" width="100%">
<thead>
<tr>
<th width="20%">Codigoo</th>
<th width="40%">Nombres</th>
</tr>
</thead> 
<tbody>

</tbody>
</table>
</body>
</html>