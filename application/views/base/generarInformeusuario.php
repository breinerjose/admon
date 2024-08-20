<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Informe Parametrizado de usuario</title>
<style type="text/css">
table#informe{
    font-size: 0.9em;
    margin: 0 auto;
    border:1px solid #666;
}
table#informe thead tr th{
    background: url(<?php echo base_url(); ?>recursos/images/patternb.png);	
	text-align:center;
	border:1px solid #666;
}
table#informe tr td{
   background: url(<?php echo base_url(); ?>recursos/images/pattern.png);
	border:1px dashed #666666;
	 height: 1.6em;
    padding: 0 0.5em;
}
table#informe th,td{
    text-align: left;
    padding: 10px;
}

table#informe tbody tr td.col{
	background:#0080C0;
	color:#fff;
}
</style>
</head>

<body>
<p>
	<h1><center>INFORME GENERAL DE USUARIOS</center></h1>
    <h3>
        	<b><span style="color:#900;">Sede:</b></span>&nbsp;<?php echo $sede; ?><br/>
            <b><span style="color:#900;">Cargo:</b></span>&nbsp;<?php echo $cargo; ?><br/>
            <b><span style="color:#900;">Perfil:</b></span>&nbsp;<?php echo $perfil; ?><br/>
            <b><span style="color:#900;">Estado:</b></span>&nbsp;<?php echo $estado; ?><br/>
            <b><span style="color:#900;">Aplicación:</b></span>&nbsp;<?php echo $aplics; ?><br/>
            <b><span style="color:#900;">Pagina:</b></span>&nbsp;<?php echo $pagina; ?><br/>
    </h3>
</p>
<table id="informe" cellpadding="1" cellspacing="0" width="100%">
	<thead>
    	<tr>
            <th>Aplicación</th>
            <th>Paginas</th>
        	<th>Identificación</th>
            <th>Nombre y Apellidos</th>
            <th>Perfil</th>
            <th>Sede</th>
            <th>Cargo</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
			if(isset($tabla)){
				if($tabla!='')
				foreach($tabla as $row){
					echo '<tr>';
					    echo '<td>'.$row['nomapl'].'</td>';
						echo '<td>'.$row['nompag'].'</td>';
						echo '<td>'.$row['identificacion'].'</td>';
						echo '<td>'.$row['nombres'].'</td>';
						echo '<td>'.$row['nomprf'].'</td>';
						echo '<td>'.$row['nomsed'].'</td>';
						echo '<td>'.$row['cargo'].'</td>';
						echo '<td>'.$row['estado'].'</td>';
					echo '</tr>';	
				
				}
				echo '<tr>';
						echo '<td colspan="2" class="col"><center><b>TOTAL USUARIOS</b></center></td>';
						echo '<td colspan="6" class="col"><center><b>'.$totalusu.' Usuarios</b></center></td>';	
				echo '</tr>';
			}
		
		?>
    </tbody>
</table>
</body>
</html>
