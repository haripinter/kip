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
	
}
?>