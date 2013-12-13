<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_menu extends CI_Model{
	// Ambil menu tertentu
	function get($menu_id){
		$data = array();
		$sql = "SELECT * FROM dinamic_menus WHERE menu_id=".$menu_id;
		$data = $this->mysql->get_data($sql,'clean');
		
		return $data;
	}
	
	// Ambil daftar menu dalam bentuk object
	function get_menu($type='public',$parent=0,$level=-1){
		$query = '';
		$perm  = $this->LEVEL;
		$user  = $this->ID_USER;
		if((string)$perm=='root'){
			$query = "SELECT * FROM dinamic_menus WHERE menu_type='".$type."' AND menu_parent=".$parent." ORDER BY menu_order";
		}else{
			$query = "SELECT * FROM dinamic_users,dinamic_userslevel,dinamic_userslevel_perm,dinamic_menus WHERE user_level=CAST(level_id AS CHAR(10)) AND perm_levelid=level_id AND menu_id=perm_menuid AND perm_grant='1' AND user_id=".$user." AND menu_type='".$type."' AND menu_parent=".$parent." ORDER BY menu_order";
		}
		
		$datas = $this->mysql->get_datas($query);
		$level++;
		$child = array();
		$data = array();
		foreach($datas as $temp){
			$child = $this->get_menu($type,$temp['menu_id'],$level);
			$temp['menu'] = $child;
			$temp['menu_level'] = $level;
			array_push($data,$temp);
		}
		return $data;
	}
	
	//ambil daftar menu dalam bentuk array table
	function list_menu($menu,$data){
		foreach($menu as $child){
			$childMenu = (isset($child['menu']))? $child['menu'] : array();
			array_push($data,$child);
			$this->list_menu($childMenu,&$data);
		}
		return $data;
	}
	
	function aa(){
		return $this->ID_USER;
	}
	
	// get all data by type and format
	// for
	function get_all($type,$format=null){
		$data = $this->get_menu($type);
		switch($format){
			case 'list':
				$rslt = array();
				$data = $this->list_menu($data,$rslt);
				break;
				
			case 'json':
				$data = json_encode($this->get_menu($type));
				break;
		}
		return $data;
	}
	
	// Get all icon
	function get_icons(){
		$data = $this->mysql->get_data("SELECT var_value FROM dinamic_vars WHERE var_key='icons'");
		return $data;
	}
	
	// Input menu
	function insert($menu){
		$check = $this->get($menu['menu_id']);
		$data = array();
		if(count($check)>0){
			$this->mysql->query("update dinamic_menus set menu_icon='".$menu['menu_icon']."', menu_title='".$menu['menu_title']."', menu_link='".$menu['menu_link']."', menu_parent=".$menu['menu_parent']." where menu_type='".$menu['menu_type']."' and menu_id=".$menu['menu_id']);
			$data = $this->get($menu['menu_id']);
			$data['status'] = 'update';
		}else{
			$maxid = $this->mysql->get_maxid('menu_id','dinamic_menus');
			$order = $this->mysql->get_maxid('menu_order','dinamic_menus');
			$this->mysql->query("insert into dinamic_menus(menu_id,menu_type,menu_icon,menu_title,menu_link,menu_parent,menu_order) values(".$maxid.",'".$menu['menu_type']."','".$menu['menu_icon']."','".$menu['menu_title']."','".$menu['menu_link']."',".$menu['menu_parent'].",".$order.")");
			$data = $this->get($maxid);
			$data['status'] = 'insert';
		}
		return $data;
	}
	
	// Delete menu
	function delete($menu_id){
		$this->mysql->query("delete from dinamic_menus where menu_id=".$menu_id);
		$data = $this->get($menu_id);
		return $data;
	}
	
}
?>