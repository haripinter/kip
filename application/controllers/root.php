<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class root extends CI_Controller {
	var $data = array();
	public function index(){
		$this->load->model('mod_setting');
		$data['site_url'] = $this->mod_setting->site_url();
		$data['root_path'] = $data['site_url'].'/admin/';
		
		$data['content'] = $this->load->view('admin/modul/root_home',$data,true);
		$this->load->view('admin/admin',$data);
	}
	
	function profil(){
		$this->load->model('mod_setting');
		$this->load->model('mod_user');
		$data['site_url'] = $this->mod_setting->site_url();
		$data['root_path'] = $data['site_url'].'/admin/';
		
		$id_user = 14;
		$tmp['user'] = $this->mod_user->get($id_user);
		$tmp['site_url'] = $data['site_url'];
		$data['content'] = $this->load->view('admin/modul/root_profil',$tmp,true);
		$this->load->view('admin/admin',$data);
	}
	
	function berita($id_berita=null,$mode=null){
		$this->load->model('mod_setting');
		$data['site_url'] = $this->mod_setting->site_url();
		$data['root_path'] = $data['site_url'].'/admin/';
		if(!is_null($id_berita)){
			$id_berita = intval($id_berita);
		}
		
		$this->load->model('mod_berita');
		
		$view_all = true;
		
		// POST action -> (insert | update) - delete
		$tmp = $data;
		if($mode=='insert'){
			if(isset($_POST['berita']) && $_POST['berita']=='Zimpan'){
				$post_id = (isset($_POST['post_id']))? $_POST['post_id'] : 0;
				$judul = (isset($_POST['judul']))? $_POST['judul'] : ' ';
				$isi = (isset($_POST['isi']))? $_POST['isi'] : ' ';
				$start = (isset($_POST['start']))? $_POST['start'] : 'none';
				$stop = (isset($_POST['stop']))? $_POST['stop'] : 'none';
				$marquee = (isset($_POST['marquee']))? $_POST['marquee'] : 'none';
				
				$tmp = explode('/',$start);
				if(count($tmp)==3){
					if($start=='none' || !checkdate($tmp[1],$tmp[0],$tmp[2])){
						$start = date('Y-m-d H:i:s');
					}else{
						$start = $this->kip->tgl_datetime($start);
					}
				}else{
					$start = date('Y-m-d H:i:s');
				}
				
				$tmp = explode('/',$stop);
				if(count($tmp)==3){
					if($stop=='none'){
						$stop = '0000-00-00 00:00:00';
					}else if(!checkdate($tmp[1],$tmp[0],$tmp[2])){
						$start = $this->kip->tgl_datetime($stop);
					}
				}else{
					$stop = '0000-00-00 00:00:00';
				}
				
				$trash['post_id'] = $post_id;
				$trash['judul'] = $judul;
				$trash['isi'] = $isi;
				$trash['start'] = $start;
				$trash['stop'] = $stop;
				$trash['marquee'] = $marquee;
				$this->mod_berita->insert($trash);
				
			}else{
				$view_all = false;
			}
		}else if($mode=='delete'){
			$this->mod_berita->delete($id_berita);
		}else{
			$view_all = false;
		}
		$tmp = $data;
		if(!$view_all && (isset($id_berita) && $id_berita>=0)){
			$tmp['berita'] = $this->mod_berita->get($id_berita);
			$data['content'] = $this->load->view('admin/modul/root_berita_input',$tmp,true);
		}else{
			$tmp['berita'] = $this->mod_berita->get_all();
			$data['content'] = $this->load->view('admin/modul/root_berita_list',$tmp,true);
		}
		$this->load->view('admin/admin',$data);
	}
	
	/*
		$mode = view/edit
		$request_id = int(id_request)
	*/
	function permohonan($mode=null,$request_id=null){
		$this->load->model('mod_setting');
		$this->load->model('mod_permohonan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['root_path'] = $data['site_url'].'/admin/';
		
		$tmp = $data;
		if($mode=='view'){
			$tmp['status'] = $this->mod_permohonan->status();
			$tmp['request'] = $this->mod_permohonan->get($request_id);
			$data['content'] = $this->load->view('admin/modul/root_permohonan_view',$tmp,true);
		}else{
			$tmp['statistik_status'] = $this->mod_permohonan->statistic();
			$tmp['statistik_bulanan'] = $this->mod_permohonan->statistic('bulanan');
			$tmp['request'] = $this->mod_permohonan->get_all('date','DESC');
			$data['content'] = $this->load->view('admin/modul/root_permohonan_list',$tmp,true);
		}
		$this->load->view('admin/admin',$data);
	}
	
	function pengaduan($mode=null,$complain_id=null){
		$this->load->model('mod_setting');
		$this->load->model('mod_pengaduan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['root_path'] = $data['site_url'].'/admin/';
		
		$tmp = $data;
		if($mode=='view'){
			//$tmp['status'] = $this->mod_pengaduan->status();
			//$tmp['complain'] = $this->mod_pengaduan->get($request_id);
			//$data['content'] = $this->load->view('admin/modul/root_pengaduan_view',$tmp,true);
		}else{
			$tmp['alasan_pengaduan'] = $this->mod_pengaduan->get_alasan();
			$tmp['statistik_status'] = $this->mod_pengaduan->statistic();
			$tmp['statistik_bulanan'] = $this->mod_pengaduan->statistic('bulanan');
			$tmp['complain'] = $this->mod_pengaduan->get_all('date','DESC');
			$data['content'] = $this->load->view('admin/modul/root_pengaduan_list',$tmp,true);
		}
		$this->load->view('admin/admin',$data);
	}
	
	function informasi($id_berita=null,$mode=null){
		$this->load->model('mod_setting');
		$data['site_url'] = $this->mod_setting->site_url();
		$data['root_path'] = $data['site_url'].'/admin/';
		if(!is_null($id_berita)){
			$id_berita = intval($id_berita);
		}
		
		$this->load->model('mod_informasi');
		
		$view_all = true;
		
		// POST action -> (insert | update) - delete
		$tmp = $data;
		if($mode=='insert'){
			if(isset($_POST['berita']) && $_POST['berita']=='Zimpan'){
				$post_id = (isset($_POST['post_id']))? $_POST['post_id'] : 0;
				$judul = (isset($_POST['judul']))? $_POST['judul'] : ' ';
				$isi = (isset($_POST['isi']))? $_POST['isi'] : ' ';
				$start = (isset($_POST['start']))? $_POST['start'] : 'none';
				$stop = (isset($_POST['stop']))? $_POST['stop'] : 'none';
				$marquee = (isset($_POST['marquee']))? $_POST['marquee'] : 'none';
				
				$tmp = explode('/',$start);
				if(count($tmp)==3){
					if($start=='none' || !checkdate($tmp[1],$tmp[0],$tmp[2])){
						$start = date('Y-m-d H:i:s');
					}else{
						$start = $this->kip->tgl_datetime($start);
					}
				}else{
					$start = date('Y-m-d H:i:s');
				}
				
				$tmp = explode('/',$stop);
				if(count($tmp)==3){
					if($stop=='none'){
						$stop = '0000-00-00 00:00:00';
					}else if(!checkdate($tmp[1],$tmp[0],$tmp[2])){
						$start = $this->kip->tgl_datetime($stop);
					}
				}else{
					$stop = '0000-00-00 00:00:00';
				}
				
				$trash['post_id'] = $post_id;
				$trash['judul'] = $judul;
				$trash['isi'] = $isi;
				$trash['start'] = $start;
				$trash['stop'] = $stop;
				$trash['marquee'] = $marquee;
				$this->mod_informasi->insert($trash);
				
			}else{
				$view_all = false;
			}
		}else if($mode=='delete'){
			$this->mod_informasi->delete($id_berita);
		}else{
			$view_all = false;
		}
		$tmp = $data;
		if(!$view_all && (isset($id_berita) && $id_berita>=0)){
			$tmp['berita'] = $this->mod_informasi->get($id_berita);
			$data['content'] = $this->load->view('admin/modul/root_informasi_input',$tmp,true);
		}else{
			$tmp['berita'] = $this->mod_informasi->get_all();
			$data['content'] = $this->load->view('admin/modul/root_informasi_list',$tmp,true);
		}
		$this->load->view('admin/admin',$data);
	}
	
	/*
	function gambar($id_gambar=null,$mode=null){
		$data['root_path'] = 'http://localhost/airputih/admin/';
		if(!is_null($id_gambar)){
			$id_gambar = intval($id_gambar);
		}
		
		$this->load->model('mod_gambar');
		
		$view_all = true;
		
		// POST action -> (insert | update) - delete
		$tmp = null;
		if($mode=='insert'){
			if(isset($_POST['gambar']) && $_POST['gambar']=='Zimpan'){
				
				$post_id = (isset($_POST['post_id']))? $_POST['post_id'] : 0;
				$judul = (isset($_POST['judul']))? $_POST['judul'] : ' ';
				$isi = (isset($_POST['isi']))? $_POST['isi'] : ' ';
				$start = (isset($_POST['start']))? $_POST['start'] : 'none';
				$stop = (isset($_POST['stop']))? $_POST['stop'] : 'none';
				$marquee = (isset($_POST['marquee']))? $_POST['marquee'] : 'none';
				
				$tmp = explode('/',$start);
				if(count($tmp)==3){
					if($start=='none' || !checkdate($tmp[1],$tmp[0],$tmp[2])){
						$start = date('Y-m-d H:i:s');
					}else{
						$start = $this->kip->tgl_datetime($start);
					}
				}else{
					$start = date('Y-m-d H:i:s');
				}
				
				$tmp = explode('/',$stop);
				if(count($tmp)==3){
					if($stop=='none'){
						$stop = '0000-00-00 00:00:00';
					}else if(!checkdate($tmp[1],$tmp[0],$tmp[2])){
						$start = $this->kip->tgl_datetime($stop);
					}
				}else{
					$stop = '0000-00-00 00:00:00';
				}
				
				$trash['post_id'] = $post_id;
				$trash['judul'] = $judul;
				$trash['isi'] = $isi;
				$trash['start'] = $start;
				$trash['stop'] = $stop;
				$trash['marquee'] = $marquee;
				$this->mod_berita->insert($trash);
				
			}else{
				$view_all = false;
			}
		}else if($mode=='delete'){
			$this->mod_gambar->delete($id_gambar);
		}else{
			$view_all = false;
		}
		if(!$view_all && (isset($id_gambar) && $id_gambar>=0)){
			$tmp['gambar'] = $this->mod_gambar->get($id_gambar);
			$data['content'] = $this->load->view('admin/modul/root_gambar_input',$tmp,true);
		}else{
			$tmp['gambar'] = $this->mod_gambar->get_all();
			$data['content'] = $this->load->view('admin/modul/root_gambar_list',$tmp,true);
		}
		$this->load->view('admin/admin',$data);
	}
	*/
	
	
}