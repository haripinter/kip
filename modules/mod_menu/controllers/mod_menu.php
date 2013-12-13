<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_menu extends KIP_Controller {

	public function index(){
		$this->allowed('root');
		$this->load->model('data_menu');
		
		$type   = to_data(@$_POST['type']);
		$action = to_data(@$_POST['action']);	
		switch($action){
			case 'edit':
				$menu = intval(@$_POST['menu']);
				$icox = $this->data_menu->get_icons();
				$data['icox'] = json_decode($icox['var_value']);
				$data['menu'] = $menu;
				$data['type'] = $type;
				$data['list'] = $this->data_menu->get_all($type,'list');
				$data['data'] = $this->data_menu->get($menu);
				
				$this->load->view('popup_input_menu',$data);
			
				break;
			
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
				$menu = intval(@$_POST['menu']);
				$res = $this->data_menu->delete($menu);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		
		}
	}
}
?>