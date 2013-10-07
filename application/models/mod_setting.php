<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_setting extends CI_Model{
	function site_url(){
		$sql = "SELECT setting_value AS site FROM dinamic_settings WHERE setting_key='site'";
		$site = $this->mysql->get_data($sql);
		return $site['site'];
	}
	
	function root_url(){
		$root = $this->site_url();
	}
}
?>