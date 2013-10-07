<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class registrasi extends CI_Controller {
	public function index($action=null){
		$this->load->model('mod_setting');
		$this->load->model('mod_skin');
		$this->load->model('mod_user');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'important';
		
		if(isset($_POST['registrasi'])){
			$tmp = array();
			if($_POST['registrasi']=='simpan'){
				$tmp['user_id'] = 0;
				$tmp['email'] = (isset($_POST['email']))? $_POST['email'] : '';
				$tmp['pass1'] = (isset($_POST['pass1']))? $_POST['pass1'] : '';
				$tmp['pass2'] = (isset($_POST['pass2']))? $_POST['pass2'] : '';
				$tmp['fullname'] = (isset($_POST['nama']))? $_POST['nama'] : '';
				$tmp['address'] = (isset($_POST['alamat']))? $_POST['alamat'] : '';
				$tmp['phone'] = (isset($_POST['telepon']))? $_POST['telepon'] : '';
				$tmp['ktp'] = (isset($_POST['ktp']))? $_POST['ktp'] : '';
				$tmp['scanktp'] = (isset($_FILES['lampiran']))? $_FILES['lampiran'] : '';
				
				$go = true;
				// periksa captcha
				//if()
				
				if($tmp['email']=='' || $tmp['fullname']=='' || $tmp['address']=='' || $tmp['phone']=='' || $tmp['ktp']=='' || $tmp['scanktp']['size']==0 ){
					$go = false;
					$tmp['err'] = 'kosong';
				}
				
				if($go && ($tmp['pass1']!=$tmp['pass2'] or $tmp['pass1']=='')){
					$go = false;
					$tmp['err'] = 'password';
				}
				
				$tmp['scan_name'] = '';
				
				if($go){
					$allowed = array('png', 'jpg', 'jpeg', 'gif');
					if(isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0){
						$extension = pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION);
				
						if(!in_array(strtolower($extension), $allowed)){
							$tmp['err'] = 'image_error';
							$go = false;
						}else{
							$l = 'media/users/';
							$nf = $tmp['ktp'].'.'.$extension;
							$n = 1;
							while(file_exists($l.$nf)){
								$nf = $tmp['ktp'].'('.$n++.').'.$extension;
							}
							if(move_uploaded_file($_FILES['lampiran']['tmp_name'], $l.$nf)){
								$tmp['scan_name'] = $nf;
							}
						}
					}
				}
				
				if($go){
					$double = $this->mod_user->isdouble($tmp['email']);
					if(isset($double['user_id']) && $double['user_id']>0){
						if($double['user_status']==0){
							$tmp['err'] = 'double_inactive';
						}else if($double['user_status']==1){
							$tmp['err'] = 'double_active';
						}else{
							$tmp['err'] = 'double_banned';
						}
					}else{
						$tmp = $this->mod_user->insert($tmp);
						$tmp['err'] = 'registration_success';
					}
				}
			}else if($_POST['registrasi']=='aktivasi'){
				$tmp['kode'] = (isset($_POST['kode']))? $_POST['kode'] : '';
				$hasil = $this->mod_user->activate($tmp['kode']);
				if($hasil['result']=='success'){
					$tmp['err'] = 'activation_success';
				}else{
					$tmp['err'] = 'activation_expired';
				}
			}else if($_POST['registrasi']=='renew_activation_key'){
				$tmp['email'] = (isset($_POST['email']))? $_POST['email'] : '';
				$tmp = $this->mod_user->renew_activation($tmp['email']);
				$tmp['err'] = 'none';
			}
			$data['result'] = $tmp;
		}
		
		$data['content'] = $this->load->view('admin/modul/front_registrasi',$data,true);
		
		$this->load->view('skins/default/index',$data);
	}
	
	function aktivasi($key=null){
		$this->load->model('mod_setting');
		$this->load->model('mod_user');
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'registrasi';
		
		$tmp['kode'] = (isset($_POST['kode']))? $_POST['kode'] : '';
		$hasil = $this->mod_user->activate($tmp['kode']);
		if($hasil['result']=='success'){
			$tmp['err'] = 'activation_success';
		}else{
			$tmp['err'] = 'activation_expired';
		}
		$data['result'] = $tmp;
		$data['content'] = $this->load->view('admin/modul/front_registrasi',$data,true);
		
		$this->load->view('skins/default/index',$data);
	}
}
?>