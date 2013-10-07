<?php
class trash1 extends CI_Controller{
	function index(){
		echo "a";
		$this->kopi('susu');
	}
	
	function kopi($roti=''){
		echo "kopi dan ".$roti;
	}
}
?>