<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends KIP_Controller {
	
	var $template = 'admin_template';
	
	public function __construct(){
		parent::__construct();
		
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
	
	function profil(){
		$this->load->model('mod_user/data_user');
		
		$id_user = 14;
		$tmp['user'] = $this->data_user->get($id_user);
		
		$data['content'] = $this->load->view('mod_user/view_profil',$tmp,true);
		$this->load->view($this->template,$data);
	}
	
	function permohonan(){
		$this->load->model('mod_permohonan/data_permohonan');
		
		$tmp['statistik_status'] = $this->data_permohonan->statistic();
		$tmp['statistik_bulanan'] = $this->data_permohonan->statistic('bulanan');
		$tmp['request'] = $this->data_permohonan->get_all('date','DESC');
		$data['content'] = $this->load->view('mod_permohonan/view_permohonan',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function pengaduan(){
		$this->load->model('mod_pengaduan/data_pengaduan');
		
		$tmp['alasan_pengaduan'] = $this->data_pengaduan->get_alasan();
		$tmp['statistik_status'] = $this->data_pengaduan->statistic();
		$tmp['statistik_bulanan'] = $this->data_pengaduan->statistic('bulanan');
		$tmp['complain'] = $this->data_pengaduan->get_all('date','DESC');
		
		$data['content'] = $this->load->view('mod_pengaduan/view_pengaduan',$tmp,true);
		$this->load->view($this->template,$data);
	}
	
	function halaman(){
		$this->load->model('mod_halaman/data_halaman');
		
		$tmp['berita'] = $this->data_halaman->get_all();
		$data['content'] = $this->load->view('mod_halaman/view_halaman',$tmp,true);
		
		$this->load->view($this->template,$data);
	}
	
	function berita(){
		$this->load->model('mod_berita/data_berita');
		
		$tmp['berita'] = $this->data_berita->get_all();
		$data['content'] = $this->load->view('mod_berita/view_berita',$tmp,true);
		
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
		
		$tmp['download'] = $this->data_dokumen->get_all('download','date','DESC');
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
	
}

?>