<?php
class trash2 extends CI_Controller{
	function __construct(){
		//echo $this->_ci_view_path;
		parent::__construct();
	}
	
	function index(){
		/*$this->load->model('trash/trashm1');
		
		
		echo $this->trashm1->bism;
		echo "<br/>";
		echo "<br/>";
		
		echo $this->trashm1->doyou('Me');
		
		$data['gobi'] = "hihi";
		$data['bosh'] = $this->trashm1->bism;
		
		$der = &get_instance();
		try{
			if($der->load->database()) echo "hoho";
			echo "DATABASE OK!";
		}catch(Exception $e){
			echo "TIDADAAAAAK";
		}
		*/
		//$l = $this->view_path;
		//print_r($l);
		//echo "<br/><br/>";
		//print_r($this->load->view('as'));
	
		//print_r($der->db);
		
		$this->load->view('tes');
	}
	
	function kopi($roti=''){
		echo "kopi dan ".$roti;
	}
}
?>