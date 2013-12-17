<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_halaman extends KIP_Controller {

	public function index(){
		$this->allowed();
		$this->load->model('data_halaman');
		
		$id_user = $this->session->userdata('id');
		
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'save':
				$data['id'] = intval(@$_POST['id']);
				$data['title'] = to_data(@$_POST['title']);
				$data['content'] = to_data(@$_POST['content']);
				$data['link'] = to_alnum_dash(strtolower(@$_POST['link']));
				$data['userid'] = $id_user;
				
				$result = $this->data_halaman->insert($data);
				
				echo json_encode($result);
				
				break;
			
			case 'delete':
				$id = intval(@$_POST['id']);
				$res = $this->data_halaman->delete($id);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		}
	}
}
?>