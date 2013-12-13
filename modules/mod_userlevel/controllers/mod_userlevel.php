<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_userlevel extends KIP_Controller {

	public function index(){
		$this->allowed('root');
		$this->load->model('data_userlevel');
		
		$type   = to_data(@$_POST['type']);
		$action = to_data(@$_POST['action']);	
		switch($action){
			case 'save_level':
				$lid = @$_POST['lid'];
				$level = @$_POST['level'];
				
				for($a=0; $a<count($lid); $a++){
					$lv['id'] = $lid[$a];
					$lv['name'] = $level[$a];
					$this->data_userlevel->insert($lv);
				}
				
				$res['levels'] = $this->data_userlevel->get_all_level();
				$res['status'] = 'success';
				echo json_encode($res);
				
				break;
				
			case 'save_permission':
				$menu = @$_POST['menuid'];
				$level = @$_POST['levelid'];
				$pilih = @$_POST['pilih'];
				for($a=0; $a<count($menu); $a++){
					$tmp['menu_id'] = intval(@$menu[$a]);
					$tmp['level_id'] = intval(@$level[$a]);
					$tmp['grant'] = intval(@$pilih[$tmp['menu_id']][$tmp['level_id']]);
					$this->data_userlevel->change_permission($tmp);
				}
				echo json_encode(array('status'=>'success'));
				
				break;
			
			case 'delete':
				$level = intval(@$_POST['id']);
				$res = $this->data_userlevel->delete_level($level);
				if(count($res)<1) echo json_encode(array('status'=>'success'));
				
				break;
		
		}
	}
}
?>