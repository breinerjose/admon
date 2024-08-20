<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Actualizar Usuario</title>
<link rel="stylesheet" type="text/css" href="/res/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/res/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/res/bootstrap/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/res/awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/res/bootstrap/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/res/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
	<script type="text/javascript" src="/recursos/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="/res/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/recursos/jquery/js/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" language="javascript" src="/res/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="/res/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="/recursos/js/validate/dist/jquery.validate.min.js"></script>
	<script type="text/javascript">
var oTable; var cod = '<?php echo $codusr;?>';
var perfil = '<?php echo $perf; ?>';
function dtl(codigo,perfusr){
		oTable = $('#paginasuser').dataTable( {
			"bProcessing": true,
			"bDestroy" : true,
			"bPaginate": false,
			"sScrollY" : '190px',
			"sAjaxSource": "/base/usuario_c/consultarPaginasuser/"+codigo+"/"+perfusr,
			"oLanguage": {"sUrl": "/res/js/datatables/media/language/espanol.txt"}
		});
	}	
$(document).ready(function(){
	dtl(cod,perfil);
	
	$('a.actualizar').button({
		icons:{primary:"ui-icon-document"}
	}).on('click',function(){
		   var sData = oTable.$('input').serialize();
			if(sData != ''){
				sData+='&codigo='+cod;
			$.ajax({
					url : '/base/usuario_c/actualizarPermisouser/',
					type : 'POST',
					data : sData, 
					success : function (resp){
						if(resp == 0){
							alert('Proceso Exitoso');
							window.parent.cerrarDialogo();	
						}
					}//fin success
			});
		 }else{
			alert('Seleccione Un dato Por favor');
			}
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
.nm{font-size:14px;color:#223B8D;font-weight:bold;}
</style>
</head>
<body>
<fieldset>
	<legend class="nm"><?php echo $nombres;?></legend>
    <table id="paginasuser" cellpadding="0" cellspacing="0" class="display" width="100%">
        <thead>
            <tr>
                <th width="15%">Codigo</th>
                <th width="45%">Descripción</th>
                <th width="30%">Aplicación</th>
                <th width="15%">Nivel</th>
                <th width="15%"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <br><hr>
    <a href="#" class="actualizar">Actualizar Datos</a>

</fieldset>

</body>
</html>