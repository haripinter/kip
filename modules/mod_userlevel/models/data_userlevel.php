<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_userlevel extends CI_Model{
	
	function get_level($level_id){
		$data = array();
		$sql = "SELECT * FROM dinamic_userslevel WHERE level_id=".$level_id;
		$data = $this->mysql->get_data($sql,'clean');
		
		return $data;
	}
	
	function get_all_level($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_userslevel ";
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY level_id '.$request_order;
		}else{
			$sql .= ' ORDER BY level_order '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
	
	function delete_level($level_id){
		$this->mysql->query("DELETE FROM dinamic_userslevel WHERE level_id=".$level_id);
		return $this->get_level($level_id);
	}
	
	function insert($level){
		$res = array();
		if($level['id']>0){
			$this->mysql->query("UPDATE dinamic_userslevel SET level_name='".$level['name']."' WHERE level_id=".$level['id']);
			$data = $this->get_level($level['id']);
		}else{
			$maxid = $this->mysql->get_maxid('level_id','dinamic_userslevel');
			$order = $this->mysql->get_maxid('level_order','dinamic_userslevel');
			$this->mysql->query("INSERT INTO dinamic_userslevel(level_id,level_name,level_order) VALUES(".$maxid.",'".$level['name']."',".$order.")");
			$data = $this->get_level($maxid);
		}
		return $data;
	}
	
	function get_permission($param){
		$sql = "SELECT perm_id,perm_grant FROM dinamic_userslevel_perm WHERE perm_levelid=".$param['level_id']." AND perm_menuid=".$param['menu_id'];
		return $this->mysql->get_data($sql,'clean');
	}

	function change_permission($param){
		$sql = '';
		$check = $this->get_permission($param);
		if(@$check['perm_id']>0){
			$sql = "UPDATE dinamic_userslevel_perm SET perm_grant='".$param['grant']."' WHERE perm_levelid=".$param['level_id']." AND perm_menuid=".$param['menu_id'];
		}else{
			$maxid = $this->mysql->get_maxid('perm_id','dinamic_userslevel_perm');
			$sql = "INSERT INTO dinamic_userslevel_perm(perm_id,perm_levelid,perm_menuid,perm_grant) VALUES(".$maxid.",".$param['level_id'].",".$param['menu_id'].",'".$param['grant']."')";
		}
		$this->mysql->query($sql);
	}
	
	function get_all_permission(){
		$this->load->model('mod_menu/data_menu');
		$menus = $this->data_menu->get_all('admin','list');
		$level = $this->get_all_level();
		
		$data = array();
		foreach($menus as $menu){
			$tmp = array();
			$tmp['menu_id'] = $menu['menu_id'];
			$tmp['menu_title'] = $menu['menu_title'];
			$tmp['permission'] = array();
			foreach($level as $lvl){
				$dmp = array();
				$dmp['menu_id'] = $menu['menu_id'];
				$dmp['level_id'] = $lvl['level_id'];
				
				$perm = $this->get_permission($dmp);
				$dmp['perm_id'] = intval(@$perm['perm_id']);
				$dmp[$dmp['level_id']] = intval(@$perm['perm_grant']);
				array_push($tmp['permission'],$dmp);
			}
			array_push($data,$tmp);
		}
		return $data;
	}
	
}
?>