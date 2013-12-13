<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_userlevel extends KIP_Controller {

	public function index(){
		$this->allowed('root');
		$this->load->model('data_userlevel');
		
		$type   = to_data(@$_POST['type']);
		$action = to_data(@$_POST['action']);	
		switch($action){
			case 'save':
				$menu = array();
				$menu['menu_id']     = intval(@$_POST['menu_id']);
				$menu['menu_parent'] = intval(@$_POST['menu_parent']);
				$menu['menu_type']   = to_data(@$_POST['menu_type']);
				$menu['menu_icon']   = to_data(@$_POST['menu_icon']);
				$menu['menu_title']  = to_data(@$_POST['menu_title']);
				$menu['menu_link']   = to_data(@$_POST['menu_link']);
				
				$res = $this->data_menu->insert($menu);
				echo json_encode($res);
				
				break;
			
			case 'delete':
				$level = intval(@$_POST['id']);
				$res = $this->data_userlevel->delete_level($level);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		
		}
	}
}
?>