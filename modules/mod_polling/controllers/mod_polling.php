<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_polling extends KIP_Controller {

	public function index(){
		$this->load->model('data_polling');
		
		$id_user = 1;
		
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'view':
				$id = intval(@$_POST['id']);
				$data['polling'] = $this->data_polling->get($id);
				$this->load->view('popup_input_polling',$data);
			
				break;
				
			case 'edit':
				$id = intval(@$_POST['id']);
				$data['polling'] = $this->data_polling->get($id);
				$this->load->view('popup_pilihan',$data);
			
				break;
			
			case 'save':
				$data['id'] = intval(@$_POST['polling_id']);
				$data['name']    = to_data(@$_POST['name']);
				$data['start']   = tgl_datetime(@$_POST['start']);
				$data['stop']    = tgl_datetime(@$_POST['stop']);
				$data['status']  = to_data(@$_POST['status']);
				$data['value']   = to_data(@$_POST['value']);
				$data['percentage'] = to_data(@$_POST['percentage']);
				
				$section = to_data(@$_POST['section']);
				switch($section)
				
		
				break;
			
			case 'delete':
				$tautan= intval(@$_POST['id']);
				$res = $this->data_polling->delete($tautan);
				if(count($res)<1) echo 'ok';
				
				break;
		
		}
	}
}
?>