<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_pengaduan extends KIP_Controller {

	public function index(){
		$this->load->model('mod_pengaduan/data_pengaduan');
		$this->load->model('mod_permohonan/data_permohonan');
		
		$id_user = 2;
		
		$action = to_data(@$_POST['action']);
		
		switch($action){
			case 'get_references':
				$tmp['request'] = $this->data_permohonan->get_by_user($id_user);
				$this->load->view('mod_pengaduan/popup_references',$tmp);
				break;
				
			case 'save_references':
				$reqid = @$_POST['reqid'];
				$data = array();
				foreach($reqid as $id){
					$request = $this->data_permohonan->get($id);
					$request['request_datetime'] = datetime_tgl($request['request_datetime']);
					array_push($data,$request);
				}
				echo json_encode($data);
				break;
				
			case 'delete_file':
				$fol = 'media/lampiran/';
				$fname = @$_POST['fname'];
				$id = intval(@$_POST['id']);
				if(file_exists($fol.$fname)){
					unlink($fol.$fname);
					$this->data_pengaduan->remove_file($id,$fname);
					echo json_encode(array('status'=>'success'));
				}else{
					echo json_encode(array('status'=>'none'));
				}
				break;
			
			case 'change_status':
				$tmp['id'] = intval(@$_POST['id']);
				$tmp['status'] = to_data(@$_POST['status']);
				$tmp['reason'] = to_data(@$_POST['alasan']);
				
				$status = $this->data_pengaduan->status();
				$data = array();
				if(in_array($tmp['status'],$status)){
					$data = $this->data_pengaduan->set_status($tmp);
				}
				echo json_encode($data);
				break;
				
			case 'popup_status':
				$id = intval(@$_POST['id']);
				$tmp['complain'] = $this->data_pengaduan->get($id);
				$tmp['status'] = $this->data_pengaduan->status();
				$this->load->view('mod_pengaduan/popup_status_pengaduan',$tmp);
				break;
				
			case 'delete':
				$id = intval(@$_POST['id']);
				$request = $this->data_pengaduan->get($id);
				$data = array();
				$lampiran = @$request['complain_lampiran'];
				if(is_json($lampiran)){
					$fname = json_decode($lampiran);
					foreach($fname as $nm){
						$fol = 'media/lampiran/';
						$nam = $nm;
						if(file_exists($fol.$nam)){
							unlink($fol.$nam);
						}
					}
				}
				$data = $this->data_pengaduan->delete($id);
				echo (count(@$data['complain'])<1) ? json_encode(array('status'=>'success')) : json_encode(array()); 
				break;
		}
	}
}
?>