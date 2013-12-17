<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_user extends KIP_Controller {

	public function index(){
		$this->load->model('data_user');
		
		$action = to_data(@$_POST['action']);
		switch($action){
			case 'login':
				$tmp['mail'] = to_data($_POST['email']);
				$tmp['pass'] = md5(to_data($_POST['password']));
				$data = $this->data_user->cek_login($tmp);
				if(intval(@$data['user_id'])>0){
					$new = array(
							'id'=> $data['user_id'],
							'level'=> $data['user_level'],
							'email'=> $data['user_email'],
							'nama'=> $data['user_fullname'],
							'alamat'=> $data['user_address']
						);
					$this->session->set_userdata($new);
					$new['status'] = 'success';
					if((string)$data['user_level']=='root' || $data['user_level'] > 0){
						$new['next'] = 'admin';
					}else{
						$new['next'] = 'user';
					}
					echo json_encode($new);
				}else{
					echo json_encode(array('status'=>'failed'));
				}
				
				break;
				
			case 'change_status':
				$this->allowed('root');
				$tmp['id']    = intval($_POST['uid']);
				$tmp['status'] = intval($_POST['status']);
				$data = $this->data_user->change_status($tmp);
				
				if(is_numeric(@$data['user_status'])){
					$status = $data['user_status'];
					echo json_encode(array('status'=>'success',
									'status_user'=>status_user($status),
									'status_warna'=>warna_status_user($status)));
				}
				
				break;
				
			case 'change_level':
				$this->allowed('root');
				$tmp['id']    = intval($_POST['uid']);
				$tmp['level'] = intval($_POST['level']);
				$data = $this->data_user->change_level($tmp);
				
				if(is_numeric(@$data['user_level'])){
					$level = $data['level_name'];
					echo json_encode(array('status'=>'success',
									'level_name'=>$level));
				}
				
				break;
				
			case 'edit':
				$this->allowed('root');
				$id = intval(@$_POST['id']);
				$data['user'] = $this->data_user->get($id);
				$this->load->view('popup_input_user',$data);
				break;
				
			case 'save':
				$this->allowed('root');
				break;
			
			case 'delete':
				$this->allowed('root');
				$id = intval(@$_POST['id']);
				$dt = $this->data_user->delete($id);
				if(count($dt)<1) echo json_encode(array('status'=>'success'));
				break;
		}
	}
	
	function logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('alamat');
		$this->session->sess_destroy();
		redirect(site_url().'home');
	}
}
?>