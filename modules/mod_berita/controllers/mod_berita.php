<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_berita extends KIP_Controller {

	public function index(){
		$this->allowed();
		$this->load->model('data_berita');
		
		$id_user = $this->session->userdata('id');
		
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'save':
				$data['id'] = intval(@$_POST['id']);
				$data['title'] = to_data(@$_POST['title']);
				$data['content'] = to_data(@$_POST['content']);
				$data['start'] = tgl_datetime(@$_POST['start']);
				$data['stop'] = tgl_datetime(@$_POST['stop']);
				$data['marquee'] = to_data(@$_POST['marquee']);
				$data['userid'] = $id_user;
				
				$result = $this->data_berita->insert($data);
				
				echo json_encode($result);
				
				break;
			
			case 'delete':
				$id = intval(@$_POST['id']);
				$res = $this->data_berita->delete($id);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		}
	}
}
?>