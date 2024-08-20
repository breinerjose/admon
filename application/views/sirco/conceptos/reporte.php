<?php date_default_timezone_set("America/Bogota"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>

*{ margin:0; padding:0;}

body{ font-family: 'Capriola',sans-serif; }

#encabezado{border-bottom: 1px solid;
    border-top: 1px solid;
    margin: 15px auto 0;
    padding-bottom: 3px;
    width: 98%;}

#fecha{  font-size: 13px;
    position: absolute;
    right: 30px;
    text-align: center;
    top: 50px;
    width: 165px;}

#encabezado .nom{font-size: 18px;
 padding: 5px;
 	 margin-left: 25px;
    font-weight: bold;}
#encabezado .dir{font-size: 14px;
    margin-left: 30px;}
#encabezado .tel{ font-size: 14px;
    margin-left: 30px;}

#title{font-weight: bold;
    padding: 15px;
    text-align: center;}
	
.tabla{margin: 0 auto;
    width: 98%;}
	

#tabla  thead tr td{
	border-bottom: 1px solid;
    border-top: 1px solid;
    font-weight: bold;
    padding: 4px;
 }
 
#tabla  tbody tr td{
	 font-size: 14px;
    padding: 3px;
 }

</style>
</head>
<body>
<div id="encabezado">
	<p class="nom"><?php echo $cabecera[0]['nomcia']; ?></p>
	<p class="dir"><?php echo $cabecera[0]['dircia']; ?></p>
    <p id="fecha"><?php echo date('d/m/Y H:m:s'); ?></p>
	<p class="tel"><?php echo $cabecera[0]['telcia']; ?></p> 
</div>
<div id="title">LISTADO DE CONCEPTOS</div>
<div class="tabla" >
    <table width="100%" cellspacing="0px" cellpadding="0px" id="tabla">
    	<thead>
            <tr>
            	<td width="5">#</td>
                <td width="10%">CODIGO</td>
                <td width="45%">NOMBRE</td>
                <td width="20%">TIPO DE MOVIMIENTO</td>
                <td width="20%">CTA CONTABLE</td>
            </tr>
		 </thead>
         <tbody>        
			<?php 
                if(isset($datos)){
                    echo $datos;
                }		
            ?>
		</tbody>
    </table>
</div>
</body>
</html>