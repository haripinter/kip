<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_polling extends CI_Model{
	// Ambil polling tertentu
	function get($id_polling=0){
		$tmp['parent'] = array();
		$tmp['children'] = array();
		if(is_numeric($id_polling)){
			if($id_polling==0){
				$polling = $this->mysql->get_data("SELECT polling_id FROM dinamic_pollings WHERE polling_status='on'");
				$id_polling = $polling['polling_id'];
			}
			
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='parent' AND polling_id=".$id_polling;
			$res = $this->mysql->get_data($sql,'clean');
			$tmp['parent'] = $res;
			
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='".@$res['polling_id']."' ORDER BY polling_id";
			$res = $this->mysql->get_datas($sql,'clean');
			foreach($res as $ser){
				array_push($tmp['children'],$ser);
			}
		}
		return $tmp;
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
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$parent = $this->mysql->get_datas($sql,'clean');
		$res = array();
		foreach($parent as $p){
			$dmb = array();
			$dmb['parent'] = $p;
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='".$p['polling_id']."' ORDER BY polling_id";
			$children = $this->mysql->get_datas($sql,'clean');
			$dmb['children'] = array();
			foreach($children as $c){
				array_push($dmb['children'],$c);
			}
			array_push($res,$dmb);
		}
		return $res;
	}
	
	function insert($polling){
		$polling_id = $this->mysql->get_maxid('polling_id','dinamic_pollings');
		$this->mysql->query("INSERT INTO dinamic_pollings(polling_id,polling_key,polling_name) VALUES(".$polling_id.",'".$polling['polling_key']."','".$polling['polling_name']."')");
		$res = $this->mysql->get_data("SELECT polling_id,polling_name FROM dinamic_pollings WHERE polling_id=".$polling_id,'clean');
		return $res;
	}
	
	// Delete polling
	function delete($id_polling){
		$this->mysql->query("DELETE FROM dinamic_pollings WHERE polling_id=".$id_polling);
		$this->mysql->query("DELETE FROM dinamic_pollings WHERE polling_key='".$id_polling."'");
	}
	
	function change_name($polling){
		$this->mysql->query("UPDATE dinamic_pollings SET polling_name='".$polling['polling_name']."' WHERE polling_id=".$polling['polling_id']);
		$res = $this->mysql->get_data("SELECT polling_id,polling_name FROM dinamic_pollings WHERE polling_id=".$polling['polling_id'],'clean');
		return $res;
	}
}
?>