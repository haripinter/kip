<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_polling extends KIP_Controller {

	public function index(){
		$this->load->model('data_polling');
		
		$id_user = 1;
		
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'edit':
				$id = intval(@$_POST['id']);
				$data['polling'] = $this->data_polling->get($id);
				$this->load->view('popup_input_polling',$data);
			
				break;
				
			case 'view':
				$id = intval(@$_POST['id']);
				$data['polling'] = $this->data_polling->get($id,'full');
				$this->load->view('popup_pilihan',$data);
			
				break;
			
			case 'save':
				$section = to_data(@$_POST['section']);
				switch($section){
					case 'parent':
						$data['id'] = intval(@$_POST['id']);
						$data['key'] = 'parent';
						$data['name'] = to_data(@$_POST['name']);
						$data['start'] = tgl_datetime(@$_POST['start']);
						$data['stop']  = tgl_datetime(@$_POST['stop']);
				
						$result = $this->data_polling->insert($data);
						$result['polling_start'] = datetime_tgl(@$result['polling_start']);
						$result['polling_stop'] = datetime_tgl(@$result['polling_stop']);
						echo json_encode($result);
						
						break;
						
					case 'children':
						$key = intval($_POST['key']);
						$id = @$_POST['id'];
						$name = @$_POST['name'];
						$param = @$_POST['param'];
						
						$result = array();
						$jumlah = count($name);
						for($a=0; $a<$jumlah; $a++){
							$data = array();
							$data['id'] = intval($id[$a]);
							$data['key'] = $key;
							$data['name'] = to_data($name[$a]);
							$res = $this->data_polling->insert($data);
							$result[$param[$a].'_id'] = $res['polling_id'];
							$result[$param[$a].'_name'] = $res['polling_name'];
							$result[$param[$a].'_status'] = $res['status'];
						}
						
						echo json_encode($result);
						
						break;
				}
				
		
				break;
			
			case 'delete':
				$id = intval(@$_POST['id']);
				$res = $this->data_polling->delete($id);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
			
			case 'delete_all':
				$id = intval(@$_POST['id']);
				$res = $this->data_polling->delete_all($id);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		}
	}
}
?>