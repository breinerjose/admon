<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="estado_financiero.xls"');
header('Cache-Control: max-age=0');
?>
<style type="text/css">
    body{font-size:12px;font-family:Verdana, Geneva, sans-serif;}
    hr{border:4px groove #DBDBDB;}
	.titulo{font-size:14px;font-weight:bold;}
	span.dirtel{color:#333;font-weight:bold;}
	h1{font-size:13px;text-align:center;font-weight:bold;}
	#cuerpo1, #cuerpo2{margin-top:5px;width:100%;font-size:11px;}
	table#datcuerpo tr th{border:1px solid #333;font-size:12px;}
	.firm{font-weight:bold;}
	#firma{margin-left:80px;}#firma2{margin-left:160px;}
	td img.chk{width:16px; height:16px;}
	td.just{border:1px solid #333; text-align:justify;vertical-align:top;}
	.vers{width:100%; text-align:right;font-size:11px;}
	.logo{height:60px;}
	#texto{width:99%;text-align:justify;font-size:10px;line-height:15px;}
	td.bnF1{border-bottom:1px dashed #666666; height:25px;}
	td.bnF2{border-bottom:1px dashed #666666; height:20px;}
	td.totales{ font-weight:bold; border-top:1px solid #000; border-bottom:1px solid #000; text-align:right;}
	td.saldo{ text-align:right;}
</style>
</head>

<body>
<hr>
<div id="cabecera">
    <table width="800" id="cabecera" cellpadding="1" cellspacing="0" align="center">
      <tr>
    	<td rowspan="4" width="20%">
        <img class="logo" src="/res/icons/sirco/logos.png"/>
        <!--  <?php
			   if($codimp==1){
			   echo '<img class="logo" src="/res/icons/sirco/logos.png"/>';
			   }else{
				  echo '<img class="logo" src="./res/icons/sirco/logos.png"/>'; 
			   }
		  ?>-->        </td>
        <td width="75%" align="center"><span class="titulo"><?php echo $nomtit; ?></span></td>
       </tr>
        <tr><td align="center"><span class="dirtel"><?php echo $titInf; ?></span></td></tr>
        <tr>
          <td align="center"><span class="dirtel"><?php echo $titInf1; ?></span></td>
        </tr>
        <tr><td align="center"><span class="dirtel"><?php echo $peso; ?></span></td></tr> 
    </table>
</div>
<hr>
<div id="cuerpo">
 <table width="100%" id="infCuerpo" cellpadding="1" cellspacing="0">
 <?php  echo (isset($inform))? $inform : '<tr align="center">No hay registro para mostrar</tr>'; ?>
 </table>
  <br>
 <br>
 <br>
 <br>
  <br>
 <br>
  <table width="100%" cellpadding="1" cellspacing="0">
 <tr>
 						<td><b><?php echo $rep_legal; ?></b></td>
						 <td><b><?php echo $contador; ?></b></td>
						 <td><b><?php echo $rev_fiscal; ?></b></td>
						 </tr>
						 <tr>
						 <td>Representante Legal</td>
						 <td>Contador(a)</td>
						 <td>Revisor Fiscal</td>
						 </tr>
						 <tr>
						 <td></td>
						 <td><?php echo $tpcontador; ?></td>
						 <td><?php echo $tprevfiscal; ?></td>
						</tr>
  </table>

</div>
</body>
</html>