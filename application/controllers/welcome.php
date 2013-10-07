<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class welcome extends CI_Controller {
	public function index(){
		$this->load->model('mod_setting');
		$this->load->model('mod_berita');
		$this->load->model('mod_skin');
		$this->load->model('mod_permohonan');
		$this->load->model('mod_pengaduan');
		
		$data = $this->kip->data();
		
		$data['site_url'] = $this->mod_setting->site_url();
		$data['root_path'] = $data['site_url'].'/admin/';
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'home';
		$data['stat_status_permohonan'] = $this->mod_permohonan->statistic();
		$data['stat_bulanan_permohonan'] = $this->mod_permohonan->statistic('bulanan');
		$data['stat_status_pengaduan'] = $this->mod_pengaduan->statistic();
		$data['stat_bulanan_pengaduan'] = $this->mod_pengaduan->statistic('bulanan');
		$data['posts'] = $this->mod_berita->get_all('created','DESC');
		$this->load->view('skins/default/index',$data);
	}
}