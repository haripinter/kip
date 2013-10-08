<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pengaduan extends CI_Controller{
	public function index($action=null){
		$this->load->model('mod_setting');
		$this->load->model('mod_skin');
		$this->load->model('mod_user');
		$this->load->model('mod_permohonan');
		$this->load->model('mod_pengaduan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'important';
		
		//$id_user = 14;
		$id_request = 5;
		$tmp = $data;
		$tmp['complain'] = $this->mod_permohonan->get($id_request);
		$tmp['alasan_pengaduan'] = $this->mod_pengaduan->alasan_pengaduan();
		
		$tmp['reason'] = array();
		if(isset($_POST['pengaduan'])){
			if($_POST['pengaduan']=='simpan'){
				$tmp['requestid'] = $id_request;
				$tmp['complain_id'] = (isset($_POST['id_komplain']))? $_POST['id_komplain'] : 0;
				$tmp['reason'] = (isset($_POST['alasan']))? $_POST['alasan'] : array();
				$tmp['case'] = (isset($_POST['kasus']))? $_POST['kasus'] : '';
				$tmp['date'] = (isset($_POST['tanggal']))? $_POST['tanggal'] : date('Y/m/d');
				
				$tmp['date'] = $this->kip->tgl_datetime($tmp['date']);
				
				$tmp['reason'] = json_encode($tmp['reason']);
				
				$tmp['complain'] = $this->mod_pengaduan->insert($tmp);
			}
		}
		
		$data['content'] = $this->load->view('admin/modul/front_pengaduan',$tmp,true);
		
		$this->load->view('skins/default/index',$data);
	}
	
	function edit($complain_id=0){
		$this->load->model('mod_setting');
		$this->load->model('mod_skin');
		$this->load->model('mod_user');
		$this->load->model('mod_pengaduan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'important';
		
		//$id_user = 14;
		$tmp = $data;
		$tmp['complain'] = $this->mod_pengaduan->get($complain_id);
		$tmp['alasan_pengaduan'] = $this->mod_pengaduan->alasan_pengaduan();
		$tmp['status_default'] = $this->mod_pengaduan->status('default');
		if($tmp['status_default']['status']==$tmp['complain']['complain_status']){
			$data['content'] = $this->load->view('admin/modul/front_pengaduan',$tmp,true);
		}else{
			$data['content'] = $this->load->view('admin/modul/front_pengaduan_view',$tmp,true);
		}
		$this->load->view('skins/default/index',$data);
	}
	
	function view($complain_id=0){
		$this->load->model('mod_setting');
		$this->load->model('mod_skin');
		$this->load->model('mod_user');
		$this->load->model('mod_pengaduan');
		
		$data = $this->kip->data();
		$data['site_url'] = $this->mod_setting->site_url();
		$data['skin'] = $data['site_url'].'/skins/default/';
		$data['stage'] = 'important';
		
		//$id_user = 14;
		$tmp = $data;
		$tmp['complain'] = $this->mod_pengaduan->get($complain_id);
		$tmp['alasan_pengaduan'] = $this->mod_pengaduan->alasan_pengaduan();
		
		$data['content'] = $this->load->view('admin/modul/front_pengaduan_view',$tmp,true);
		$this->load->view('skins/default/index',$data);
	}
}
?>