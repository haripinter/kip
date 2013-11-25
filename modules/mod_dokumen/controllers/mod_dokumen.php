<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_dokumen extends KIP_Controller {

	public function index(){
		$this->load->model('data_dokumen');
		
		$id_user = 1;
		
		$action = to_data(@$_POST['action']);	
		switch($action){
			case 'edit':
				$this->load->view('popup_input_dokumen');
			
				break;
			
			case 'upload':
				if(isset($_FILES['files'])){
					include_once(APPPATH.'../modules/uploader/UploadHandler.php');
					$ext = array('gif','jpg','jpeg','bmp','png','doc','docx','xls','xlsx','ppt','pptx','rtf','txt','odt','odp','odf','svg','csv','pps','pdf','zip','rar','tar','bz','gz','7z');
					$extension = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
					if(!in_array(strtolower($extension), $ext)){
						echo 'error';
						exit;
					}
					
					$folder = 'media/dokumen/';
					$option = array(
						'upload_dir' => $folder,
						'upload_url' => $folder
					);
					
					$upload_handler = new UploadHandler($option);
					$response = $upload_handler->response;
					$get_response = json_decode($response);
					$file = get_object_vars($get_response->files[0]);
					
					if($file['size']>0){
						$tmp['key'] = 'dokumen';
						$tmp['keyid'] = 0;
						$tmp['link'] = '';
						$tmp['title'] = to_data($file['name']);
						$tmp['realname'] = to_data($file['name']);
						$tmp['thumbnail'] = to_data(@$file['thumbnailUrl']);
						$tmp['userid'] = $id_user;
						$tmp['id'] = 0;
						
						$res = $this->data_dokumen->insert($tmp);
						if(@$res['media_id']>0){
							$get_response->files[0]->media_id = $res['media_id'];
							$get_response->files[0]->media_key = $res['media_key'];
							$get_response->files[0]->media_keyid = $res['media_keyid'];
							$get_response->files[0]->media_datetime = datetime_tgl($res['media_datetime']);
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
				$id = intval(@$_POST['id']);
				// remove existing file
				$cek = $this->data_dokumen->get($id);
				$folder = 'media/dokumen/';
				if(count($cek)>0){
					if($cek['media_realname']!='' && file_exists(urldecode($folder.$cek['media_realname']))){
						unlink(urldecode($folder.$cek['media_realname']));
					}
					if($cek['media_thumbnail']!='' && file_exists(urldecode($cek['media_thumbnail']))){
						unlink(urldecode($cek['media_thumbnail']));
					}
				}
				$res = $this->data_dokumen->delete($id);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
				
			case 'rename':
				$id = intval(@$_POST['id']);
				$data['media'] = $this->data_dokumen->get($id);
				$this->load->view('popup_edit_title',$data);
				
				break;
				
			case 'save':
				$media['id']    = intval(@$_POST['id']);
				$media['title'] = to_data(@$_POST['title']);
				$res = $this->data_dokumen->change_title($media);
				echo json_encode($res);
				
				break;
		
		}
	}
	
	function download($id){
		$this->load->model('data_dokumen');
		$id = intval($id);
		
		$id_user = 1;
		
		$media = $this->data_dokumen->get($id);
		$folder = 'media/dokumen/';
		$file = $folder.$media['media_realname'];
		
		if(file_exists(urldecode($file))) {
			$this->data_dokumen->viewed($media['media_id']);
			ob_start();
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.urlencode(basename($file)));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
	}
}
?>