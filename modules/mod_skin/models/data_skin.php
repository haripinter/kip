<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_skin extends KIP_Model {
	
	function get($skin_id){
		$sql = "SELECT * FROM dinamic_settings WHERE setting_key='skin_admin' AND setting_status='default'";
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
}