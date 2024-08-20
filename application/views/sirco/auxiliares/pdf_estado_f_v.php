<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de Balance General</title>
<style type="text/css">
   /* body{font-size:10px;font-family:Verdana, Geneva, sans-serif;}
    hr{border:3px groove #DBDBDB;}
	.titulo{font-size:14px;font-weight:bold;}
	span.dirtel{color:#333;font-weight:bold;}
	h1{font-size:13px;text-align:center;font-weight:bold;}
	#cuerpo1, #cuerpo2{margin-top:3px;width:100%;font-size:11px;}
	table#datcuerpo tr th{border:1px solid #333;font-size:12px;}
	.firm{font-weight:bold;}
	#firma{margin-left:80px;}#firma2{margin-left:160px;}
	td img.chk{width:16px; height:16px;}
	td.just{border:1px solid #333; text-align:justify;vertical-align:top;}
	.vers{width:100%; text-align:right;font-size:11px;}
	.logo{height:60px;}
	#texto{width:99%;text-align:justify;font-size:10px;line-height:10px;}
	td.bnF1{border-bottom:1px dashed #666666; height:25px;}
	td.bnF2{border-bottom:1px dashed #666666; height:20px;}*/
	
			body{
			font-family:Verdana, Arial, Helvetica, sans-serif;
			font-size:10px;
			margin:0;
		
		}

td img.chk{width:16px; height:16px;}
	td.just{border:1px solid #333; text-align:justify;vertical-align:top;}
#texto{width:99%;text-align:justify;font-size:10px;line-height:10px;}
	td.bnF1{border-bottom:1px dashed #666666; height:25px;}
	td.bnF2{border-bottom:1px dashed #666666; height:20px;}
@page { margin: 90px 20px 35px 20px; }
 #logo { position: fixed; left: 0px;right: 0px; top: -120px; height: 100px; background-color:#fff; text-align:left }

 #logo2 { position: fixed; left: 140px; top: -180px; right: 0px; height: 100px; background-color:#fff; text-align:right; }
 
 .page p{
	 margin:0;
	 
	 }
</style>
</head>

<body>
<script type="text/php">
if ( isset($pdf) ) { 
    $pdf->page_script('
			$font = Font_Metrics::get_font("helvetica", "normal");
            $size = 6;
			//$pdf->line(50,50,50,50);
			$pageText = " <?php echo  utf8_encode(utf8_encode($nomtit)); ?>";
            $y = 20;
			$size = 10;
            $x = ($pdf->get_width() /2) - ( Font_Metrics::get_text_width($pageText, $font, $size) / 2);
            $pdf->text($x, $y, $pageText, $font, $size);
			
			$pageText = "<?php echo $titInf; ?>";
            $y = 35;
			$size = 9;
            $x = ($pdf->get_width() /2) - ( Font_Metrics::get_text_width($pageText, $font, $size) / 2);
            $pdf->text($x, $y, $pageText, $font, $size);
			
			$pageText = "<?php echo $titInf1; ?>";
            $y = 50;
			$size = 9;
            $x = ($pdf->get_width() /2) - ( Font_Metrics::get_text_width($pageText, $font, $size) / 2);
            $pdf->text($x, $y, $pageText, $font, $size);
			
			$w = $pdf->get_width(); 
			$y = 60; 
			$img_w = 60; 
			$img_h = 50; 
			$pdf->image("./res/icons/practica/logo2.png",  40 , $y - $img_h, $img_w, $img_h );
			
			
			   if ($PAGE_COUNT > 1) {
            $font = Font_Metrics::get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 12;
            $pageText = $PAGE_NUM . "/" . $PAGE_COUNT;
            $y = $pdf->get_height() - 24;
            $x = $pdf->get_width() - 15 - Font_Metrics::get_text_width($pageText, $font, $size);
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
	   ');
            
}   
 </script>
<div id="cuerpo" align="justify" style="margin-left:5px; margin-right:5px;">
 <table width="100%" id="infCuerpo" cellpadding="1" cellspacing="0">
 <?php  echo (isset($inform))? $inform : '<tr align="center">No hay registro para mostrar</tr>'; ?>
 </table>
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