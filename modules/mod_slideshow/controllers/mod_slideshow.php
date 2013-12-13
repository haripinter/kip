<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_slideshow extends KIP_Controller {

	public function index(){
		$this->allowed('root');
		$this->load->model('data_slideshow');
		
		$id_user = $this->session->userdata('id');
		
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'edit':
				$id = intval(@$_POST['id']);
				$data['media'] = $this->data_slideshow->get($id);
				$this->load->view('popup_input_slideshow',$data);
			
				break;
			
			case 'save':
				$media['id'] = intval(@$_POST['id']);
				$media['title'] = to_data(@$_POST['title']);
				$media['description'] = to_data(@$_POST['description']);
				$media['status'] = to_data(@$_POST['status']);
				$media['userid'] = intval($id_user);
				
				$resp = $this->data_slideshow->insert($media);
				
				if(isset($_FILES['files'])){
					include_once(APPPATH.'../modules/uploader/UploadHandler.php');
					$ext = array('gif','jpg','jpeg','bmp','png');
					$extension = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
					if(!in_array(strtolower($extension), $ext)){
						echo 'error';
						exit;
					}
					
					// remove existing file
					$folder = 'media/slideshow/';
					if($resp['status']=='update'){
						if($resp['media_realname']!='' && file_exists(urldecode($folder.$resp['media_realname']))){
							unlink(urldecode($folder.$resp['media_realname']));
						}
						if($resp['media_thumbnail']!='' && file_exists($resp['media_thumbnail'])){
							unlink(urldecode($resp['media_thumbnail']));
						}
					}
					
					$option = array(
						'upload_dir' => $folder,
						'upload_url' => $folder
					);
					
					$upload_handler = new UploadHandler($option);
					$response = $upload_handler->response;
					$get_response = json_decode($response);
					$file = get_object_vars($get_response->files[0]);
					
					if($file['size']>0){
						$tmp['id'] = intval($resp['media_id']);
						$tmp['realname'] = to_data($file['name']);
						$tmp['thumbnail'] = to_data($file['thumbnailUrl']);
						
						$res = $this->data_slideshow->change_image($tmp);
						
						if(@$res['media_id']>0){
							$get_response->files[0]->media_id = $res['media_id'];
							$get_response->files[0]->media_realname = $res['media_realname'];
							$get_response->files[0]->media_thumbnail = $res['media_thumbnail'];
							$get_response->files[0]->media_title = $res['media_title'];
							$get_response->files[0]->media_description = $res['media_description'];
							$get_response->files[0]->media_status = $res['media_status'];
							$get_response->files[0]->status = $resp['status'];
						}
						$resp = $get_response;
					}
				}
				echo json_encode($resp);
		
				break;
			
			case 'delete':
				$id = intval(@$_POST['id']);
				$resp = $this->data_slideshow->get($id);
				
				// remove existing file
				$folder = 'media/slideshow/';
				if($resp['media_realname']!='' && file_exists(urldecode($folder.$resp['media_realname']))){
					unlink(urldecode($folder.$resp['media_realname']));
				}
				if($resp['media_thumbnail']!='' && file_exists($resp['media_thumbnail'])){
					unlink(urldecode($resp['media_thumbnail']));
				}
				
				$res = $this->data_slideshow->delete($id);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		
		}
	}
}
?>