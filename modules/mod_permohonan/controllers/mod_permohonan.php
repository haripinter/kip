<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_permohonan extends KIP_Controller {

	public function index(){
		$this->load->model('mod_permohonan/data_permohonan');
		
		$id_user = 2;
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'change_status':
				$tmp['id'] = intval(@$_POST['id']);
				$tmp['status'] = to_data(@$_POST['status']);
				$tmp['reason'] = to_data(@$_POST['alasan']);
				
				$status = $this->data_permohonan->status();
				$data = array();
				if(in_array($tmp['status'],$status)){
					$data = $this->data_permohonan->set_status($tmp);
				}
				echo json_encode($data);
				break;
				
			case 'popup_status':
				$id = intval(@$_POST['id']);
				$tmp['request'] = $this->data_permohonan->get($id);
				$tmp['status'] = $this->data_permohonan->status();
				$this->load->view('mod_permohonan/popup_status_permohonan',$tmp);
				break;
				
			case 'delete':
				$id = intval(@$_POST['id']);
				$request = $this->data_permohonan->get($id);
				$data = array();
				if(@$request['request_authfile']!=''){
					$fol = 'media/lampiran/';
					$nam = @$request['request_authfile'];
					if(file_exists($fol.$nam)){
						unlink($fol.$nam);
					}
				}
				$data = $this->data_permohonan->delete($id);
				echo (count($data)<1) ? json_encode(array('status'=>'success')) : json_encode(array()); 
				break;
		}
	}
}
?>