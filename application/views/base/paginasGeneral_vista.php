<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Todas Las Paginas</title>
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_page.css" />
<link rel="stylesheet" href="/res/js/datatables/media/css/demo_table.css"/>
<link rel="stylesheet" href="/res/jquery/ui/css/siaweb/jquery-ui-1.9.2.custom.css"/>
<script type="text/javascript" src="/res/js/jquery.js"></script>
<script type="text/javascript" src="/res/jquery/ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/res/js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/res/js/validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
var oTable; var cod = '<?php echo $cod;?>';
function dtl(codigo){
		oTable = $('#paginas').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": false,
			"sScrollY" : '160px',
			"sAjaxSource": "<?php echo base_url(); ?>configuraciones/usuario_c/consultarPaginas/"+codigo,
			"oLanguage": {"sUrl": "<?php echo base_url(); ?>recursos/js/datatables/media/language/espanol.txt"}
		});
	}	
$(document).ready(function(){
	dtl(cod);
	
	$('a.actualizar').button({
		icons:{primary:"ui-icon-document"}
	}).on('click',function(){
		   var sData = oTable.$('input').serialize();
			if(sData != ''){
				sData+='&codigo='+cod;
			}			
			else{
				sData='&codigo='+cod;
			}
			$.ajax({
					url : '<?php echo base_url();?>configuraciones/usuario_c/asignarPaginasperfil/',
					type : 'POST',
					data : sData, 
					success : function (resp){
						if(resp == 0){
							alert('Proceso Exitoso');
							window.parent.cerrarDialogo();	
						}
					}//fin success
			});
	});
});
</script>
<style type="text/css">
table.display tr td{font-size:13px;}

table.display
{
    font-size: 0.9em;
    margin: 0 auto;
    background-color: #ffffff;
    box-shadow:black 1px 1px 5px;
    border-collapse: collapse;
     /* hack IE8 */
    border-collapse: collapse \0/;
    border-right: 2px inset #D3D3D3 \0/;
    border-bottom: 2px inset #D3D3D3 \0/;
     /* hack IE7 */
    *border-collapse: collapse;
    *border-right: 2px inset #D3D3D3;
    *border-bottom: 2px inset #D3D3D3;
}
table.display thead tr{
    background-color: #CC0000;
    color:white;
}
table.display th a{
   color:white;
}
table.display tr.odd
{
    background-color: #FFE8E8;
}

table.display tr.noDataRow td {
    text-align: center;
}

table.display table th.title
{
    text-align: center;
}


table.display th,td
{
    text-align: left;
    padding: 10px;
}

table.display td
{
    height: 1.6em;
    padding: 0 0.5em;
	border:1px dashed #CCCCCC;
}

table.display td.editable
{
    width: 200px;
    height: 22px;
}

table.display th.sortable
{
    cursor: pointer;
}

table.display tr.loading {
    color: #dddddd;
    background-color: #f6f6f6;
}

tr.odd td.sorting_1 {
    background-color: #FCABAB;
    margin: 0.25em;
    padding: 0.25em;
}

tr.even td.sorting_1 {
    background-color: #F9DBDB;
    margin: 0.25em;
    padding: 0.25em;
}
table.display td.loading
{
    background:url(../../../recursos/images/loading.gif) no-repeat 4px center;
    padding-left: 24px;
    color: #aaaaaa;
    width: 176px;
}
.actualizar{font-size:12px;}
</style>
</head>
<body>
<table id="paginas" cellpadding="0" cellspacing="0" class="display" width="100%">
	<thead>
    	<tr>
        	<th width="15%">Codigo</th>
            <th width="50%">Descripción</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<br><hr>
<a href="#" class="actualizar">Actualizar Datos</a>
</body>
</html>