<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
					
	 function CalculaEdad($Y,$m,$d) {
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	
} 
 