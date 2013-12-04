<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_config extends CI_Model {
	
	function get($config_key){
		$sql = "SELECT * FROM dinamic_config WHERE config_key='".$config_key."'";
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	function get_all($format=null){
		$data = array();
		$sql  = "SELECT * FROM dinamic_config";
		$tmp = $this->mysql->get_datas($sql,'clean');
		if($format=='input'){
			foreach($tmp as $tm){
				$data[$tm['config_key']] = $tm['config_value'];
			}
		}else{
			$data = $tmp;
		}
		return $data;
	}
	
	function update($config){
		$this->mysql->query("UPDATE dinamic_config SET config_value='".$config['value']."' WHERE config_key='".$config['key']."'");
		return $this->get($config['key']);
	}
}