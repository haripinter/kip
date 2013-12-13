<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_tautan extends KIP_Controller {

	public function index(){
		$this->allowed('root');
		$this->load->model('data_tautan');
		$this->load->model('mod_dokumen/data_dokumen');
		
		$id_user = $this->session->userdata('id');
		
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'edit':
				$tautan = intval(@$_POST['id']);
				$data['tautan'] = $this->data_tautan->get($tautan);
				$this->load->view('popup_input_tautan',$data);
			
				break;
			
			case 'save':
				$taut['id'] = intval(@$_POST['tautan_id']);
				$taut['title']     = to_data(@$_POST['title']);
				$taut['link']      = to_data(@$_POST['link']);
				$taut['option']    = to_data(@$_POST['option']);
				$taut['status']    = to_data(@$_POST['status']);
				
				$key = 'tautan';
				$resp = $this->data_tautan->insert($taut);
				
				if(isset($_FILES['files'])){
					include_once(APPPATH.'../modules/uploader/UploadHandler.php');
					$ext = array('gif','jpg','jpeg','bmp','png');
					$extension = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
					if(!in_array(strtolower($extension), $ext)){
						echo 'error';
						exit;
					}
					
					// remove existing file
					$cek = $this->data_dokumen->get_by_key($key,$resp['tautan_id']);
					$folder = 'media/tautan/';
					if(count($cek)>0){
						if($cek['media_realname']!='' && file_exists(urldecode($folder.$cek['media_realname']))){
							unlink(urldecode($folder.$cek['media_realname']));
						}
						if($cek['media_thumbnail']!='' && file_exists($cek['media_thumbnail'])){
							unlink(urldecode($cek['media_thumbnail']));
						}
					}
					
					$option = array(
						'upload_dir' => $folder,
						'upload_url' => $folder,
						'accept_file_types' => '/\.(gif|jpe?g|png|bmp)$/i'
					);
					
					$upload_handler = new UploadHandler($option);
					$response = $upload_handler->response;
					$get_response = json_decode($response);
					$file = get_object_vars($get_response->files[0]);
					
					if($file['size']>0){
						$tmp['key'] = $key;
						$tmp['keyid'] = $resp['tautan_id'];
						$tmp['link'] = '';
						$tmp['title'] = '';
						$tmp['realname'] = to_data($file['name']);
						$tmp['thumbnail'] = to_data($file['thumbnailUrl']);
						$tmp['userid'] = $id_user;
						$tmp['id'] = intval(@$cek['media_id']);
						
						$res = $this->data_dokumen->insert($tmp);
						if(@$res['media_id']>0){
							$get_response->files[0]->tautan_id = $resp['tautan_id'];
							$get_response->files[0]->tautan_title = $resp['tautan_title'];
							$get_response->files[0]->tautan_link = $resp['tautan_link'];
							$get_response->files[0]->tautan_option = $resp['tautan_option'];
							$get_response->files[0]->tautan_status = $resp['tautan_status'];
							$get_response->files[0]->status = $resp['status'];
						
							$get_response->files[0]->media_id = $res['media_id'];
							$get_response->files[0]->media_key = $res['media_key'];
							$get_response->files[0]->media_keyid = $res['media_keyid'];
							$get_response->files[0]->media_datetime = $res['media_datetime'];
							$get_response->files[0]->media_realname = $res['media_realname'];
							$get_response->files[0]->media_thumbnail = $res['media_thumbnail'];
							$get_response->files[0]->media_title = $res['media_title'];
							$get_response->files[0]->media_viewed = $res['media_viewed'];
						}
						$resp = $get_response;
					}
				}
				echo json_encode($resp);
		
				break;
			
			case 'delete':
				$tautan= intval(@$_POST['id']);
				$res = $this->data_tautan->get($tautan);
				$res = $this->data_dokumen->delete(intval(@$res['media_id']));
				$res = $this->data_tautan->delete($tautan);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		
		}
	}
}
?>