<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_config extends CI_Model {
	
	function get($config_key){
		$sql = "SELECT * FROM dinamic_config WHERE config_key=".$setting_id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	function get_all(){
		$sql  = "SELECT * FROM dinamic_config";
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
}