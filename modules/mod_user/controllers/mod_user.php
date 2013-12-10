<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_user extends KIP_Controller {

	public function index(){
		$this->load->model('data_user');
		
		$id_user = 1;
		
		$action = to_data(@$_POST['action']);
		
		switch($action){
			case 'login':
				$tmp['mail'] = to_data($_POST['email']);
				$tmp['pass'] = md5(to_data($_POST['password']));
				$data = $this->data_user->cek_login($tmp);
				if(intval(@$data['user_id'])>0){
					$new = array(
							'ID'=> $data['user_id'],
							'MAIL'=> $data['user_email'],
							'NAME'=> $data['user_fullname'],
							'GROUP'=> $data['user_groupid'],
							'LOGIN'=> true
						);
					$this->session->set_userdata($new);
					$new['status'] = 'success';
					if($data['user_id']==1){
						$new['next'] = 'admin';
					}else{
						$new['next'] = 'user';
					}
					echo json_encode($new);
				}else{
					echo json_encode(array('status'=>'failed'));
				}
				
				break;
		}
	}
	
	function logout(){
		$this->session->unset_userdata('ID');
		$this->session->unset_userdata('MAIL');
		$this->session->unset_userdata('NAME');
		$this->session->unset_userdata('GROUP');
		$this->session->unset_userdata('LOGIN');
		$this->session->sess_destroy();
		redirect(site_url().'home');
	}
}
?>