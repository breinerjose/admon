<?php
	define('SQL_HOST', '127.0.0.1');
	define('SQL_DB', 'netempir_labcasb');
	define('SQL_USER', 'netempir_ladcasb');
	define('SQL_PASSW', 'Web2015+');
	$conn = mysql_connect(SQL_HOST, SQL_USER, SQL_PASSW) or die('No se pudo conectar a Base de datos local.');	
	mysql_select_db(SQL_DB, $conn);
$select2="SELECT * FROM historias where id_cliente='73118830'";
          $rselect2 = mysql_query($select2);
		  $rows = mysql_fetch_array($rselect2);
		 // print_r($rows);
		  //exit();


			while($rows = mysql_fetch_array($rselect2)){
			extract($rows); 
			$nombre  =  utf8_decode($nombre);
			echo $nombre;  
          $umarcha = "UPDATE historias SET nombre='$nombre' WHERE id_cliente='$id_cliente'";
   $rumarcha = mysql_query($umarcha)  or die (mysql_error());
   		  //echo "FACTURA REVERTIDA";
		  
		
		  }
		  	  
 ?>