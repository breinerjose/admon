<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reporte de Balance General</title>
 <style>
		body{
			font-family:Verdana, Arial, Helvetica, sans-serif;
			font-size:11px;
			margin:0;
		
		}
#cabecera{margin-left: 10px;
    margin-top: 10px;
    width: 1100px;}
	
#cuerpo{margin-left: 10px;
    margin-top: 10px;
    width: 1100px;}
		
.titulo{font-size:14px;font-weight:bold;}
span.dirtel{color:#333;font-weight:bold;}
.logo{height:60px;}

#cajamenor {
	border:1px solid #000;
	 
	}		
#cajamenor tr th{

background:#005CB9;
color:#FFF;
border:1px solid #000;
		
}
#cajamenor tbody  tr td{
border-left:1px solid #000;
border-bottom:1px solid #000;
			
}
#cajamenor tbody td{
padding:4px;
			
}

@page { margin: 180px 50px; }
 #logo { position: fixed; left: 0px;right: 0px; top: -120px; height: 100px; background-color:#fff; text-align:left }

 #logo2 { position: fixed; left: 140px; top: -180px; right: 0px; height: 100px; background-color:#fff; text-align:right; }
 
 .page p{
	 margin:0;
	 
	 }
	 
#footer{}
#firma{width:400px; margin:0 auto;text-align:center;}
span.firma,span.firma1,span.firma2,span.firma3{font-size:14px; font-weight:bold;text-align:center;margin-left:130px;}
span.firma1{margin-left:300px;}
span.firma2{margin-left:57px;}
span.firma3{margin-left:170px;}
span.fch{color:#900;}
#tabfot tr td{border:1px solid #333;}
td.totales{ font-weight:bold; border-top:1px solid #000; border-bottom:1px solid #000; text-align:right;}
.cabe td { text-align:right;}
td.saldo{ text-align:right;}

		</style>
</head>
<body>
<div id="cabecera">
<hr>
    <table width="100%" id="cabecera" cellpadding="1" cellspacing="0">
      <tr>
    	<td rowspan="3" width="20%">
        <img class="logo" src="/res/icons/activos/logos.png"/>
        <!--  <?php
			   if($codimp==1){
			   echo '<img class="logo" src="/res/icons/activos/logos.png"/>';
			   }else{
				  echo '<img class="logo" src="./res/icons/activos/logos.png"/>'; 
			   }
		  ?>-->
        </td>
        <td width="75%" align="center"><span class="titulo"><?php echo $nomtit; ?></span></td>
       </tr>
        <tr><td align="center"><span class="dirtel"><?php echo $titInf; ?></span></td></tr>
        <tr><td align="center"><span class="dirtel"><?php echo $titInf1; ?></span></td></tr>    
    </table>
    <hr>
</div>
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
 <br>
  <table width="100%" cellpadding="1" cellspacing="0">
 <tr>
 						<td><b><?php echo encodeUtf8($rep_legal); ?></b></td>
						 <td><b><?php echo encodeUtf8($contador); ?></b></td>
						 <td><b><?php echo encodeUtf8($rev_fiscal); ?></b></td>
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