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
	
	function list_theme($mode='public'){
		$path = config_item('base_public_skin');
		if($mode=='admin'){
			$path = config_item('base_admin_skin');
		}
		
		$list = scandir($path);
		$tmps = array();
		foreach($list as $file){
			if($file!='.' && $file!='..'){
				array_push($tmps,$file);
			}
		}
		return $tmps;
	}
	
	function active_theme($mode='public'){
		$skin = $this->get('skin_frontpage');
		if($mode=='admin'){
			$skin = $this->get('skin_admin');
		}
		$data = ($skin['config_value']!='')? $skin['config_value'] : $skin['config_default'];
		return $data;
	}
}