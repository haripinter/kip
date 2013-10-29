<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_tautan extends CI_Model{

	// Ambil tautan berdasarkan id
	function get($tautan_id){
		$sql = "SELECT * FROM dinamic_tautan WHERE tautan_id=".$tautan_id;
		$data = $this->mysql->get_data($sql,'clean');
		
		$med = array();
		$sql = "SELECT * FROM dinamic_media WHERE media_key='tautan' AND media_keyid=".$tautan_id;
		$med = $this->mysql->get_data($sql,'clean');
		if(count($med)>0){
			$data['media_thumbnail'] = $med['media_thumbnail'];
			$data['media_realname'] = $med['media_realname'];
			$data['media_id'] = $med['media_id'];
		}
		return $data;
	}
	
	// Ambil daftar tautan
	// order string 'id'|'created'|'modified'
	// request_order string 'desc'|'asc'
	// limit int
	function get_all($key=null,$order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_tautan";
		
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		switch($order){
			case 'id':
				$sql .= ' ORDER BY tautan_id '.$request_order;
				break;
				
			case 'order':
				$sql .= ' ORDER BY tautan_order '.$request_order;
				break;
		}
		
		if(intval($limit)>0){
			$sql .= 'LIMIT '.$limit;
		}
		
		$data = array();
		$tmp = $this->mysql->get_datas($sql,'clean');
		foreach($tmp as $tm){
			$dmb = array();
			$sql = "SELECT * FROM dinamic_media WHERE media_key='tautan' AND media_keyid=".$tm['tautan_id'];
			$med = $this->mysql->get_data($sql,'clean');
			if(count($med)>0){
				$tm['media_thumbnail'] = $med['media_thumbnail'];
				$tm['media_realname'] = $med['media_realname'];
				$tm['media_id'] = $med['media_id'];
			}
			array_push($data,$tm);
		}
		return $data;
	}
	
	// Input tautan
	function insert($tautan){
		$data = array();
		if($tautan['id']>0){
			$this->mysql->query("UPDATE dinamic_tautan SET tautan_title='".$tautan['title']."', tautan_link='".$tautan['link']."', tautan_option='".$tautan['option']."', tautan_status='".$tautan['status']."' WHERE tautan_id=".$tautan['id']);
			$data = $this->get($tautan['id']);
			$data['status'] = 'update';
		}else{
			$maxid = $this->mysql->get_maxid('tautan_id','dinamic_tautan');
			$this->mysql->query("INSERT INTO dinamic_tautan(tautan_id,tautan_title,tautan_link,tautan_option,tautan_status,tautan_order) VALUES(".$maxid.",'".$tautan['title']."', '".$tautan['link']."','".$tautan['option']."','".$tautan['status']."',".$maxid.")");
			$data = $this->get($maxid);
			$data['status'] = 'insert';
		}
		return $data;
	}
	
	// Delete tautan
	function delete($tautan_id){
		$this->mysql->query("DELETE FROM dinamic_tautan WHERE tautan_id=".$tautan_id);
		return $this->get($tautan_id);
	}
}
?>