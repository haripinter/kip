<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class permohonan extends CI_Controller{
	public function index($action=null){
		$this->load->model('mod_setting');
		$this->load->model('mod_skin');
		$this->load->model('mod_user');
		$this->load->model('mod_permohonan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'important';
		
		$id_user = 14;
		$tmp = $data;
		$tmp['request'] = $this->mod_user->get($id_user);
		
		if(isset($_POST['permohonan'])){
			if($_POST['permohonan']=='simpan'){
				$tmp['userid'] = $id_user;
				$tmp['request_id'] = (isset($_POST['id_permohonan']))? $_POST['id_permohonan'] : 0;
				$tmp['information'] = (isset($_POST['informasi']))? $_POST['informasi'] : '';
				$tmp['reason'] = (isset($_POST['alasan']))? $_POST['alasan'] : '';
				$tmp['user'] = (isset($_POST['user_name']))? $_POST['user_name'] : '';
				$tmp['ktp'] = (isset($_POST['user_ktp']))? $_POST['user_ktp'] : '';
				$tmp['address'] = (isset($_POST['user_address']))? $_POST['user_address'] : '';
				$tmp['phone'] = (isset($_POST['user_phone']))? $_POST['user_phone'] : '';
				$tmp['email'] = (isset($_POST['user_email']))? $_POST['user_email'] : '';
				$tmp['usage'] = (isset($_POST['user_usage']))? $_POST['user_usage'] : '';
				$tmp['authname'] = (isset($_POST['auth_name']))? $_POST['auth_name'] : '';
				$tmp['authaddress'] = (isset($_POST['auth_address']))? $_POST['auth_address'] : '';
				$tmp['authphone'] = (isset($_POST['auth_phone']))? $_POST['auth_phone'] : '';
				
				$tmp['how'] = (isset($_POST['info_how']))? $_POST['info_how'] : '';
				$tmp['format'] = (isset($_POST['info_format']))? $_POST['info_format'] : '';
				$tmp['delivery'] = (isset($_POST['info_delivery']))? $_POST['info_delivery'] : '';
				$tmp['authfile'] = '';
				
				if(isset($_FILES['auth_file']) && $_FILES['auth_file']['error'] == 0){
					$allowed = array('png', 'jpg', 'jpeg', 'gif');
					$extension = pathinfo($_FILES['auth_file']['name'], PATHINFO_EXTENSION);
				
					if(in_array(strtolower($extension), $allowed)){
						$l = 'media/lampiran/';
						$nf = 'kuasa_'.$id_user.'.'.$extension;
						$n = 1;
						while(file_exists($l.$nf)){
							$nf = 'kuasa_'.$id_user.'('.$n++.').'.$extension;
						}
						if(move_uploaded_file($_FILES['auth_file']['tmp_name'], $l.$nf)){
							$tmp['authfile'] = $nf;
						}
					}
				}
				
				$tmp['request'] = $this->mod_permohonan->insert($tmp);
			}
			$data['content'] = $this->load->view('admin/modul/front_permohonan_view',$tmp,true);
		}else{
			$data['content'] = $this->load->view('admin/modul/front_permohonan',$tmp,true);
		}
		
		$this->load->view('skins/default/index',$data);
	}
	
	function view($reqest_id=0){
		$this->load->model('mod_setting');
		$this->load->model('mod_skin');
		$this->load->model('mod_user');
		$this->load->model('mod_permohonan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'important';
		
		//$id_user = 14;
		$tmp = $data;
		$tmp['request'] = $this->mod_permohonan->get($reqest_id);
		
		$data['content'] = $this->load->view('admin/modul/front_permohonan_view',$tmp,true);
		$this->load->view('skins/default/index',$data);
	}
	
	function edit($reqest_id=0){
		$this->load->model('mod_setting');
		$this->load->model('mod_skin');
		$this->load->model('mod_user');
		$this->load->model('mod_permohonan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'important';
		
		//$id_user = 14;
		$tmp = $data;
		$tmp['request'] = $this->mod_permohonan->get($reqest_id);
		
		$data['content'] = $this->load->view('admin/modul/front_permohonan',$tmp,true);
		$this->load->view('skins/default/index',$data);
	}
}
?>