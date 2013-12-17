<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class KIP_Controller extends CI_Controller {

	var $ID_USER = 0;
	var $IS_LOGIN = false;
	var $LEVEL = '';

    public function __construct(){
		parent::__construct();
		
		$this->load->model('mod_config/data_config');
		$this->load->model('mod_menu/data_menu');
		$this->load->model('mod_berita/data_berita');
		
		$conf = $this->data_config->get_all();
		foreach($conf as $conf){
			$val = ($conf['config_value']!='')? $conf['config_value'] : $conf['config_default'];
			$this->config->set_item($conf['config_key'],$val);
		}
		
		$this->ID_USER = intval($this->session->userdata('id'));
		$this->LEVEL = $this->session->userdata('level');
		$this->IS_LOGIN = (intval(@$this->session->userdata('id'))>0)? true : false;
		$this->config->set_item('ID_USER',$this->ID_USER);
		$this->config->set_item('IS_LOGIN',$this->IS_LOGIN);
		
		$this->config->set_item('admin_theme',base_url().admin_skin(config_item('skin_admin')));
		$this->config->set_item('public_theme',base_url().home_skin(config_item('skin_frontpage')));
		
		$this->config->set_item('admin_menu',$this->data_menu->get_all('admin'));
		$this->config->set_item('public_menu',$this->data_menu->get_all('public'));
		
		//$form_login = $this->load->view("mod_user/view_login_form.php",null,true);
		//$this->config->set_item('form_login',$form_login);
		
		$this->config->set_item('base_admin_skin',APPPATH.'../skins/admin/');
		$this->config->set_item('base_public_skin',APPPATH.'../skins/frontpage/');
		
		$this->config->set_item('marquee',$this->data_berita->get_marquee());
		
	}
	
	function allowed($user='all'){
		$id = $this->ID_USER;
		$level = $this->LEVEL;
		switch($user){
			case 'all':
				if(!is_numeric($id) && intval($id)==0){
					$this->restrict();
				}
				break;
			case 'root':
				if($level!='root'){
					$this->restrict();
				}
				break;
		}
	}
	
	function restrict(){
		echo json_encode('_');
		exit();
	}
	
	function must_login($user='all'){
		$id = $this->ID_USER;
		$level = $this->LEVEL;
		switch($user){
			case 'all':
				if(!is_numeric($id) || intval($id)==0){
					redirect('login');
					exit();
				}
				break;
			case 'root':
				if($level!='root'){
					redirect('login');
					exit();
				}
				break;
		}
	}
	
	function must_logout(){
		if($this->IS_LOGIN){
			redirect('login');
		}
	}
}
?>