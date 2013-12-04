<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class KIP_Controller extends CI_Controller {

    public function __construct(){
		parent::__construct();
		
		$this->load->model('mod_config/data_config');
		$this->load->model('mod_menu/data_menu');
		
		$conf = $this->data_config->get_all();
		foreach($conf as $conf){
			$val = ($conf['config_value']!='')? $conf['config_value'] : $conf['config_default'];
			$this->config->set_item($conf['config_key'],$val);
		}
		$this->config->set_item('admin_theme',base_url().admin_skin(config_item('skin_admin')));
		$this->config->set_item('public_theme',base_url().home_skin(config_item('skin_frontpage')));
		
		$this->config->set_item('admin_menu',$this->data_menu->get_all('admin'));
		$this->config->set_item('public_menu',$this->data_menu->get_all('public'));
	}
}
?>