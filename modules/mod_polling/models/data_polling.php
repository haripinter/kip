<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_polling extends CI_Model{
	// Ambil polling tertentu
	function get($id=0,$opt=''){
		$data = array();
		if($opt=='full'){
			$data['parent'] = array();
			$data['children'] = array();
			
			// jika polling_id dan option default
			// maka tampilkan polling yang sedang aktif
			/*
			if(intval($polling_id)==0){
				$polling = $this->mysql->get_data("SELECT polling_id FROM dinamic_pollings WHERE polling_status='on'");
				$polling_id = $polling['polling_id'];
			}*/
			
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='parent' AND polling_id=".$id;
			$res = $this->mysql->get_data($sql,'clean');
			$data['parent'] = $res;
			
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='".@$res['polling_id']."' ORDER BY polling_id";
			$res = $this->mysql->get_datas($sql,'clean');
			foreach($res as $ser){
				array_push($data['children'],$ser);
			}
		}else{
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_id=".$id;
			$data = $this->mysql->get_data($sql,'clean');
		}
		return $data;
	}
	
	// Ambil daftar polling
	// order string 'id'|'created'|'modified'
	// request_order string 'desc'|'asc'
	// limit int
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='parent'";
		
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY polling_id '.$request_order;
		}
		
		if(intval($limit)>0){
			$sql .= 'LIMIT '.$limit;
		}
		$parent = $this->mysql->get_datas($sql,'clean');
		$data = array();
		foreach($parent as $p){
			$dmb = array();
			$dmb['parent'] = $p;
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='".$p['polling_id']."' ORDER BY polling_id";
			$children = $this->mysql->get_datas($sql,'clean');
			$dmb['children'] = array();
			foreach($children as $c){
				array_push($dmb['children'],$c);
			}
			array_push($data,$dmb);
		}
		return $data;
	}
	
	function insert($polling){
		$id = $polling['id'];
		
		$status = 'insert';
		$cek = $this->get($id);
		
		if(count($cek)>0){
			if($polling['key']=='parent'){
				$this->mysql->query("UPDATE dinamic_pollings SET polling_name='".$polling['name']."', polling_start='".$polling['start']."', polling_stop='".$polling['stop']."' WHERE polling_id=".$id);
			}else{
				$this->mysql->query("UPDATE dinamic_pollings SET polling_name='".$polling['name']."' WHERE polling_id=".$id);
			}
			$status = 'update';
		}else{
			$id = $this->mysql->get_maxid('polling_id','dinamic_pollings')+1;
			if($polling['key']=='parent'){
				$this->mysql->query("INSERT INTO dinamic_pollings(polling_id,polling_key,polling_name,polling_start,polling_stop) VALUES(".$id.",'".$polling['key']."','".$polling['name']."','".$polling['start']."','".$polling['stop']."')");
			}else{
				$this->mysql->query("INSERT INTO dinamic_pollings(polling_id,polling_key,polling_name) VALUES(".$id.",'".$polling['key']."','".$polling['name']."')");
			}
		}
		
		$data = $this->get($id);
		$data['status'] = $status;
		return $data;
	}
	
	// Delete polling
	function delete($id){
		$this->mysql->query("DELETE FROM dinamic_pollings WHERE polling_id=".$id);
		return $this->get($id);
	}
	
	// Delete polling by parent
	function delete_all($id){
		$this->mysql->query("DELETE FROM dinamic_pollings WHERE polling_key=".$id);
		$this->mysql->query("DELETE FROM dinamic_pollings WHERE polling_id=".$id);
		return $this->get($id);
	}
	
	function change_name($polling){
		//$this->mysql->query("UPDATE dinamic_pollings SET polling_name='".$polling['polling_name']."' WHERE polling_id=".$polling['polling_id']);
		//$data = $this->get("SELECT polling_id,polling_name FROM dinamic_pollings WHERE polling_id=".$polling['polling_id'],'clean');
		//return $data;
	}
	
}
?>