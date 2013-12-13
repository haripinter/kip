<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends KIP_Controller {
	
	var $template = 'admin_template';
	
	public function __construct(){
		parent::__construct();
		//$this->allowed('root');
		//$this->must_login('root');
	}

	public function index(){
		$this->load->model('mod_permohonan/data_permohonan');
		$this->load->model('mod_pengaduan/data_pengaduan');
		
		$tmp['stat_status_permohonan'] = $this->data_permohonan->statistic();
		$tmp['stat_bulanan_permohonan'] = $this->data_permohonan->statistic('bulanan');
		$tmp['stat_status_pengaduan'] = $this->data_pengaduan->statistic();
		$tmp['stat_bulanan_pengaduan'] = $this->data_pengaduan->statistic('bulanan');
		
		$data['content'] = $this->load->view('admin',$tmp,true);
		$this->load->view($this->template,$data);
	}
	
	/*function profil(){
		$this->load->model('mod_user/data_user');
		
		$id_user = 1;
		$tmp['user'] = $this->data_user->get($id_user);
		
		$data['content'] = $this->load->view('mod_user/view_profil',$tmp,true);
		$this->load->view($this->template,$data);
	}*/
	
	function permohonan($view=null,$id=null){
		$this->load->model('mod_permohonan/data_permohonan');
		
		switch($view){
			case 'view':
				$id = intval($id);
				$tmp['request'] = $this->data_permohonan->get($id);
				$tmp['status'] = $this->data_permohonan->status();
				$data['content'] = $this->load->view('mod_permohonan/detail_permohonan',$tmp,true);
				break;
				
			default:
				$tmp['statistik_status'] = $this->data_permohonan->statistic();
				$tmp['statistik_bulanan'] = $this->data_permohonan->statistic('bulanan');
				$tmp['request'] = $this->data_permohonan->get_all('date','DESC');
				$data['content'] = $this->load->view('mod_permohonan/view_permohonan',$tmp,true);
		}
		
		$this->load->view($this->template,$data);
	}
	
	function pengaduan($view=null,$id=null){
		$this->load->model('mod_pengaduan/data_pengaduan');
		
		switch($view){
			case 'view':
				$id = intval($id);
				$tmp['complain'] = $this->data_pengaduan->get($id);
				$tmp['status'] = $this->data_pengaduan->status();
				$tmp['alasan_pengaduan'] = $this->data_pengaduan->alasan_pengaduan();
				$data['content'] = $this->load->view('mod_pengaduan/detail_pengaduan',$tmp,true);
				break;
				
			default:
				$tmp['alasan_pengaduan'] = $this->data_pengaduan->get_alasan();
				$tmp['statistik_status'] = $this->data_pengaduan->statistic();
				$tmp['statistik_bulanan'] = $this->data_pengaduan->statistic('bulanan');
				$tmp['complain'] = $this->data_pengaduan->get_all('date','DESC');
				
				$data['content'] = $this->load->view('mod_pengaduan/view_pengaduan',$tmp,true);
		}
		$this->load->view($this->template,$data);
	}
	
	function halaman($mode=null,$id=null){
		$this->load->model('mod_halaman/data_halaman');
		if($mode=='input'){
			$tmp['halaman'] = $this->data_halaman->get(intval($id));
			$data['content'] = $this->load->view('mod_halaman/input_halaman',$tmp,true);
		}else{
			$tmp['halaman'] = $this->data_halaman->get_all();
			$data['content'] = $this->load->view('mod_halaman/view_halaman',$tmp,true);
		}
		$this->load->view($this->template,$data);
	}
	
	function berita($mode=null,$id=null){
		$this->load->model('mod_berita/data_berita');
		
		if($mode=='input'){
			$tmp['berita'] = $this->data_berita->get(intval($id));
			$data['content'] = $this->load->view('mod_berita/input_berita',$tmp,true);
		}else{
			$tmp['berita'] = $this->data_berita->get_all('id');
			$data['content'] = $this->load->view('mod_berita/view_berita',$tmp,true);
		}
		$this->load->view($this->template,$data);
	}
	
	function slideshow(){
		$this->load->model('mod_slideshow/data_slideshow');
		
		$tmp['slideshow'] = $this->data_slideshow->get_all('slideshow','date','DESC');
		$data['content'] = $this->load->view('mod_slideshow/view_slideshow',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function dokumen(){
		$this->load->model('mod_dokumen/data_dokumen');
		
		$tmp['dokumen'] = $this->data_dokumen->get_all('dokumen','date','DESC');
		$data['content'] = $this->load->view('mod_dokumen/view_dokumen',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function polling(){
		$this->load->model('mod_polling/data_polling');
		
		$tmp['polling'] = $this->data_polling->get_all();
		$data['content'] = $this->load->view('mod_polling/view_polling',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function tautan(){
		$this->load->model('mod_tautan/data_tautan');
		
		$tmp['link'] = $this->data_tautan->get_all();
		$data['content'] = $this->load->view('mod_tautan/view_tautan',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function menu(){
		$this->load->model('mod_menu/data_menu');
		
		$tmp['menu_admin'] = $this->data_menu->get_all('admin','list');
		$tmp['menu_public'] = $this->data_menu->get_all('public','list');
		$data['content'] = $this->load->view('mod_menu/view_menu',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function config(){
		$this->load->model('mod_config/data_config');
		
		$tmp['admin_themes'] = $this->data_config->list_theme('admin');
		$tmp['public_themes'] = $this->data_config->list_theme('public');
		$tmp['admin_theme_active'] = $this->data_config->active_theme('admin');
		$tmp['public_theme_active'] = $this->data_config->active_theme('public');
		
		$tmp['config'] = $this->data_config->get_all('input');
		$data['content'] = $this->load->view('mod_config/view_config',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function pengguna(){
		$this->load->model('mod_user/data_user');
		
		$tmp['users'] = $this->data_user->get_all();
		$data['content'] = $this->load->view('mod_user/view_user',$tmp,true);
		$this->load->view($this->template,$data);
	}
	
	function userlevel(){
		$this->load->model('mod_userlevel/data_userlevel');
		
		$tmp['levels'] = $this->data_userlevel->get_all_level();
		$tmp['permission'] = $this->data_userlevel->get_all_permission();
		$data['content'] = $this->load->view('mod_userlevel/view_userlevel',$tmp,true);
		$this->load->view($this->template,$data);
	}
}

?>