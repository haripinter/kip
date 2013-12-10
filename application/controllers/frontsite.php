<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class frontsite extends KIP_Controller {

	var $template = 'frontpage_template';
	var $ID_USER = 0;
	var $IS_LOGIN = false;
	
	public function __construct(){
		parent::__construct();
		$this->ID_USER = intval($this->session->userdata('ID'));
		$this->IS_LOGIN = (@$this->session->userdata('LOGIN'))? true : false;
	}
	
	public function index(){
		$this->load->model('mod_slideshow/data_slideshow');
		
		$tmp['slideshow'] = $this->data_slideshow->get_all();
		$data['content'] = $this->load->view('frontpage',$tmp,true);
		$data['page_type'] = 'home';
		$this->load->view($this->template,$data);
	}
	
	function berita($id=null){
		$this->load->model('mod_berita/data_berita');
		
		$id = intval($id);
		if($id>0){
			$tmp['berita'] = $this->data_berita->get_berita($id);
			$tmp['map'] = $this->data_berita->map($id);
			$data['content'] = $this->load->view('mod_berita/front_detail',$tmp,true);
			$data['page_type'] = 'semua_berita';
		}else{
			$tmp['berita'] = $this->data_berita->get_berita_all('created','DESC');
			$data['content'] = $this->load->view('mod_berita/front_list',$tmp,true);
			$data['page_type'] = 'detail_berita';
		}
		$this->load->view($this->template,$data);
	}
	
	function halaman($staticlink=''){
		$this->load->model('mod_halaman/data_halaman');
		
		$link = to_alnum_dash($staticlink);
		$tmp['halaman'] = $this->data_halaman->get_by_link($link);
		$data['content'] = $this->load->view('mod_halaman/front_detail',$tmp,true);
		$data['page_type'] = 'halaman';
		$this->load->view($this->template,$data);
	}
	
	function registrasi($action=null){
		$this->load->model('mod_user/data_user');
		
		$tmp_data = array();
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
					$double = $this->data_user->isdouble($tmp['email']);
					if(isset($double['user_id']) && $double['user_id']>0){
						if($double['user_status']==0){
							$tmp['err'] = 'double_inactive';
						}else if($double['user_status']==1){
							$tmp['err'] = 'double_active';
						}else{
							$tmp['err'] = 'double_banned';
						}
					}else{
						$tmp['pass'] = md5($tmp['pass1']);
						$tmp['keys'] = randkey(33);
						
						$allowed = array('png', 'jpg', 'jpeg', 'gif');
						if(isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0){
							$extension = pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION);
					
							if(!in_array(strtolower($extension), $allowed) || ($_FILES["lampiran"]["size"]/1024)>100){
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
						
						if($go){
							$tmp['scan'] = $tmp['scan_name'];
							$tmp = $this->data_user->insert($tmp);
							$tmp['err'] = 'registration_success';
						}
					}
				}
			}
			$tmp_data['result'] = $tmp;
		}
		
		$data['page_type'] = 'registrasi';
		$data['content'] = $this->load->view('mod_user/view_registrasi',$tmp_data,true);
		
		$this->load->view($this->template,$data);
	}
	
	function aktivasi($key=null){
		$this->load->model('mod_user/data_user');
		
		$tmp_data = array();
		
		$action = @$_POST['aktivasi'];
		$tmp['kode'] = to_data(@$_POST['kode']);
		
		if($key=='baru'){
			$action = 'renew_activation_key';
		}else if($key!=''){
			$action = 'aktivasi';
			$tmp['kode'] = to_data(@$_GET['key']);
		}
		
		switch($action){
			case 'aktifkan':
				$hasil = $this->data_user->activate($tmp['kode']);
				if($hasil['result']=='success'){
					$tmp['err'] = 'activation_success';
				}else{
					$tmp['err'] = 'activation_expired';
				}
				$tmp_data['result'] = $tmp;
		
				break;
				
			case 'renew_activation_key':
				$tmp['email'] = @$_POST['email'];
				$tmp = $this->data_user->renew_activation($tmp['email']);
				if(@$tmp['status']=='success'){
					$tmp['err'] = 'none';
				}else{
					$tmp['err'] = 'renew_activation';
				}
				$tmp_data['key'] = $key;
				$tmp_data['result'] = $tmp;
				
				break;
		}
		
		$data['page_type'] = 'aktivasi';
		$data['content'] = $this->load->view('mod_user/view_aktivasi',$tmp_data,true);
		
		$this->load->view($this->template,$data);
	}
	
	function download(){
		$this->load->model('mod_dokumen/data_dokumen');
		
		$tmp['dokumen'] = $this->data_dokumen->get_all('dokumen','date','DESC');
		$data['page_type'] = 'download';
		$data['content'] = $this->load->view('mod_dokumen/front_download',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function permohonan($view=null,$id=null){
		$this->must_login();
		
		
		$this->load->model('mod_permohonan/data_permohonan');
		$this->load->model('mod_user/data_user');
		
		$data = array();
		$id_user = $this->ID_USER;
		
		if(isset($_POST['permohonan'])){
			if($_POST['permohonan']=='simpan'){
				$tmp['userid'] = intval($id_user);
				$tmp['request_id'] = intval($_POST['id_permohonan']);
				$tmp['information'] = to_data($_POST['informasi']);
				$tmp['reason'] = to_data($_POST['alasan']);
				$tmp['user'] = to_data($_POST['user_name']);
				$tmp['ktp'] = to_data($_POST['user_ktp']);
				$tmp['address'] = to_data($_POST['user_address']);
				$tmp['phone'] = to_data($_POST['user_phone']);
				$tmp['email'] = to_data($_POST['user_email']);
				$tmp['usage'] = to_data($_POST['user_usage']);
				$tmp['authname'] = to_data($_POST['auth_name']);
				$tmp['authaddress'] = to_data($_POST['auth_address']);
				$tmp['authphone'] = to_data($_POST['auth_phone']);
				
				$tmp['how'] = to_data($_POST['info_how']);
				$tmp['format'] = to_data($_POST['info_format']);
				$tmp['delivery'] = to_data($_POST['info_delivery']);
				$tmp['authfile'] = '';
				
				
				$rnew = array();
				$go = true;
				if(isset($_FILES['auth_file']) && $_FILES['auth_file']['error'] == 0){
					$allowed = array('png', 'jpg', 'jpeg', 'pdf');
					$extension = pathinfo($_FILES['auth_file']['name'], PATHINFO_EXTENSION);
					
					$old = $this->data_permohonan->get($tmp['request_id']);
				
					if(in_array(strtolower($extension), $allowed) && ($_FILES["auth_file"]["size"]/1024)<=250){
						$l = 'media/lampiran/';
						$nf = 'kuasa_'.$id_user.'.'.$extension;
						$n = 1;
						while(file_exists($l.$nf)){
							$nf = 'kuasa_'.$id_user.'('.$n++.').'.$extension;
						}
						if(move_uploaded_file($_FILES['auth_file']['tmp_name'], $l.$nf)){
							$tmp['authfile'] = $nf;
						}
						if(@$old['request_authfile']!=''){
							$oldfile = $l.$old['request_authfile'];
							if(file_exists(urldecode($oldfile))){
								unlink($oldfile);
							}
						}
					}else{
						$go = false;
						$rnew['request_information'] = $tmp['information'];
						$rnew['request_reason'] = $tmp['reason'];
						$rnew['request_user'] = $tmp['user'];
						$rnew['request_ktp'] = $tmp['ktp'];
						$rnew['request_address'] = $tmp['address'];
						$rnew['request_phone'] = $tmp['phone'];
						$rnew['request_email'] = $tmp['email'];
						$rnew['request_usage'] = $tmp['usage'];
						$rnew['request_authname'] = $tmp['authname'];
						$rnew['request_authaddress'] = $tmp['authaddress'];
						$rnew['request_authphone'] = $tmp['authphone'];
						$rnew['request_how'] = $tmp['how'];
						$rnew['request_format'] = $tmp['format'];
						$rnew['request_delivery'] = $tmp['delivery'];
						$rnew['request_authfile'] = $tmp['authfile'];
					}
				}
				
				if($go){
					$tmp['request'] = $this->data_permohonan->insert($tmp);
					$data['content'] = $this->load->view('mod_permohonan/front_permohonan_view',$tmp,true);
				}else{
					$tmp['err'] = 'File lampiran tidak boleh lebih besar dari 250kB dan formatnya tidak sesuai.';
					$tmp['request'] = $rnew;
					$data['content'] = $this->load->view('mod_permohonan/front_permohonan',$tmp,true);
				}
			}
			
		}else{
			$id = intval($id);
			switch($view){
				case 'view':
					$tmp['request'] = $this->data_permohonan->get($id);
					$data['content'] = $this->load->view('mod_permohonan/front_permohonan_view',$tmp,true);
					break;
				
				case 'edit':
					$tmp['request'] = $this->data_permohonan->get($id);
					$data['content'] = $this->load->view('mod_permohonan/front_permohonan',$tmp,true);
					break;
					
				default:
					$tmp['request'] = $this->data_user->get($id_user);
					$data['content'] = $this->load->view('mod_permohonan/front_permohonan',$tmp,true);
			}
		}
		
		$data['page_type'] = 'permohonan';
		$this->load->view($this->template,$data);
	}
	
	function pengaduan($view=null,$id=null){
		$this->must_login();
		
		$this->load->model('mod_pengaduan/data_pengaduan');
		$this->load->model('mod_permohonan/data_permohonan');
		$this->load->model('mod_user/data_user');
		
		$data = array();
		$id_user = $this->ID_USER;
		
		//$id_request = 5;
		//$tmp['complain'] = $this->data_permohonan->get($id_request);
		$tmp['alasan_pengaduan'] = $this->data_pengaduan->alasan_pengaduan();
		$tmp['status_default'] = $this->data_pengaduan->status('active');
		
		$tmp['reason'] = array();
		if(isset($_POST['pengaduan'])){
			if($_POST['pengaduan']=='simpan'){
				$tmp['requestid'] = (isset($_POST['reqid']))? $_POST['reqid'] : array();
				$tmp['requestid'] = json_encode($tmp['requestid']);
				$tmp['complain_id'] = intval(@$_POST['id_komplain']);
				$tmp['case'] = to_data(@$_POST['kasus']);
				$tmp['date'] = (isset($_POST['tanggal']))? $_POST['tanggal'] : date('Y/m/d');
				$tmp['date'] = tgl_datetime($tmp['date']);
				$tmp['reason'] = (isset($_POST['alasan']))? $_POST['alasan'] : array();
				$tmp['reason'] = json_encode($tmp['reason']);
				
				$old = $this->data_pengaduan->get($tmp['complain_id']);
				$tmp['lampiran'] = @$old['complain_lampiran'];
				
				$go = true;
				if(isset($_FILES['lampiran'])){
					$dokumen = $_FILES['lampiran'];
					$allowed = array('zip', 'rar', '7z', 'tar', 'bz', 'gz', 'bz2', 'gz2', 'tgz', 'tbz2');
					foreach($dokumen['name'] as $berkas){
						$extension = pathinfo($berkas, PATHINFO_EXTENSION);
						if(!in_array(strtolower($extension), $allowed)){
							$go = false;
							$data['err'] = 'Maaf, lampiran harus berupa file terkompres.';
						}
					}
					
					foreach($dokumen['size'] as $size){
						if($size/1024>(5*1024)){
							$go = false;
							$data['err'] = 'Maaf, lampiran tidak boleh lebih besar dari 5MB.';
						}
					}
					
					if($go){
						$dokumens = array();
						if(is_json($tmp['lampiran']))
							$dokumens = json_decode($tmp['lampiran']);
							
						for($x=0; $x<count($dokumen['name']); $x++){
							$l = 'media/lampiran/';
							$n = 1;
							$nf = to_alnum_dash($dokumen['name'][$x]);
							while(file_exists($l.$nf)){
								$nf = $n++.'-'.to_alnum_dash($dokumen['name'][$x]);
							}
							if(move_uploaded_file($dokumen['tmp_name'][$x], $l.$nf)){
								array_push($dokumens,$nf);
							}
						}
						$tmp['lampiran'] = json_encode($dokumens);
					}else{
						$go = false;
						$rnew['complain_requestid'] = $tmp['requestid'];
						$rnew['complain_reason'] = $tmp['reason'];
						$rnew['complain_case'] = $tmp['case'];
						$rnew['complain_id'] = $tmp['complain_id'];
						$tmp['complain'] = $rnew;
					}
				}
				
				if($go){
					$tmp['complain'] = $this->data_pengaduan->insert($tmp);
					$data['content'] = $this->load->view('mod_pengaduan/front_pengaduan_view',$tmp,true);
				}
			}
		}else{
			$id = intval($id);
			$status = $this->data_pengaduan->get_status($id);
			if($view=='edit' && $tmp['status_default']['status']!=$status){
				$view = 'view';
			}
			
			switch($view){
				case 'view':
					$tmp['complain'] = $this->data_pengaduan->get($id);
					$data['content'] = $this->load->view('mod_pengaduan/front_pengaduan_view',$tmp,true);
					break;
				
				case 'edit':
					$tmp['complain'] = $this->data_pengaduan->get($id);
					$data['content'] = $this->load->view('mod_pengaduan/front_pengaduan',$tmp,true);
					break;
					
				default:
					$tmp['complain'] = $this->data_user->get($id_user);
					$data['content'] = $this->load->view('mod_pengaduan/front_pengaduan',$tmp,true);
			}
		}
		$data['page_type'] = 'pengaduan';
		$this->load->view($this->template,$data);
	}
	
	function login(){
		$data['page_type'] = 'login';
		$data['content'] = $this->load->view('mod_user/view_login',null,true);
		$this->load->view($this->template,$data);
	}
	
	function logout(){
		redirect('mod_user/logout');
	}
	
	private function must_login(){
		if(!$this->IS_LOGIN){
			redirect('login');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */