<?php
class trashm1 extends CI_Model{
	var $bism = "Robb";
	
	function doyou($in=''){
		return "Did you like ".(($in!='')?$in:'this')."?";
	}
}
?>