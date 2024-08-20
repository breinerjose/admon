<?php  
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function decodeUtf8($string){
		return utf8_decode($string); 
		//return ($string); 
	}

	function encodeUtf8($string){	
		return ($string);
		//return ($string);
	}