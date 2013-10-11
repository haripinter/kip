<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_polling extends CI_Model{
	// Ambil polling tertentu
	function get($id_polling){
		$tmp = array();
		if(is_numeric($id_polling)){
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='parent' AND polling_id=".$id_polling;
			$res = $this->mysql->get_data($sql,'clean');
			array_push($tmp,$res);
			
			$sql = "SELECT * FROM dinamic_pollings WHERE polling_key='".$res['polling_id']."' ORDER BY polling_id";
			$res = $this->mysql->get_datas($sql,'clean');
			foreach($res as $ser){
				array_push($tmp,$ser);
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
		$res = $this->mysql->get_datas($sql,'clean');
		return $res;
	}
	
	// Input polling
	function insert($polling){
		$res = array();
		if($polling['media_id']>0){
			$this->mysql->query("UPDATE dinamic_media SET media_title='".$media['title']."' WHERE media_key='".$media['key']."' AND media_id=".$media['media_id']);
			$res = $this->get($media['media_id']);
		}else{
			$maxid = $this->mysql->get_maxid('polling_id','dinamic_pollings');
			$this->mysql->query("INSERT INTO dinamic_pollings(polling_id,polling_key,polling_name,polling_value,polling_status) VALUES()");
			$res = $this->get($maxid);
		}
		return $res;
	}
	
	// Delete polling
	function delete($id_polling){
		$this->mysql->query("DELETE FROM dinamic_pollings WHERE polling_key='".$id_polling."'");
		$this->mysql->query("DELETE FROM dinamic_pollings WHERE polling_key='parent' AND polling_id=".$id_polling);
	}
}
?>