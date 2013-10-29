<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KIP_Config extends CI_Model {
	function get(){
		$sql  = "SELECT * FROM dinamic_config";
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
}