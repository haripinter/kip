<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_dokumen extends CI_Model{
	// Ambil berita tertentu
	function get($media_id){
		$data = array();
		$sql = "SELECT * FROM dinamic_media WHERE media_id=".$media_id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	// Ambil berita berdasarkan key dan keyid
	// biasanya untuk file dokumen
	function get_by_key($key,$id){
		$data = array();
		$sql = "SELECT * FROM dinamic_media WHERE media_key='".$key."' AND media_keyid=".$id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	// Ambil daftar berita
	// order string 'id'|'created'|'modified'
	// request_order string 'desc'|'asc'
	// limit int
	function get_all($key=null,$order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_media WHERE media_key='".$key."'";
		
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY media_id '.$request_order;
		}else if($order=='created'){
			$sql .= ' ORDER BY media_datetime '.$request_order;
		}else if($order=='viewed'){
			$sql .= ' ORDER BY media_viewed '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
	
	// Input media
	function insert($media){
		$data = array();
		if($media['id']>0){
			$this->mysql->query("UPDATE dinamic_media SET media_title='".$media['title']."',media_realname='".$media['realname']."', media_thumbnail='".$media['thumbnail']."', media_updated=NOW() WHERE media_key='".$media['key']."' AND media_id=".$media['id']);
			$data = $this->get($media['id']);
		}else{
			$maxid = $this->mysql->get_maxid('media_id','dinamic_media');
			$this->mysql->query("INSERT INTO dinamic_media(media_id,media_key,media_keyid,media_link,media_title,media_realname,media_thumbnail,media_userid,media_datetime) VALUES(".$maxid.",'".$media['key']."',".$media['keyid'].",'".$media['link']."','".$media['title']."','".$media['realname']."','".$media['thumbnail']."','".$media['userid']."',NOW())");
			$data = $this->get($maxid);
		}
		return $data;
	}
	
	// Delete berita
	function delete($media_id){
		$this->mysql->query("DELETE FROM dinamic_media WHERE media_id=".$media_id);
		return $this->get($media_id);
	}
	
	// Delete berita
	function delete_by_key($key,$id){
		$this->mysql->query("DELETE FROM dinamic_media WHERE media_key='".$key."' AND media_keyid=".$id);
		return $this->get_by_key($key,$id);
	}
	
	function change_title($media){
		$this->mysql->query("UPDATE dinamic_media SET media_title='".$media['title']."' WHERE media_id=".$media['id']);
		return $this->get($media['id']);
	}
	
	function viewed($media_id){
		$this->mysql->query("UPDATE dinamic_media SET media_viewed=IFNULL(media_viewed,0)+1 WHERE media_id=".$media_id);
		return $this->get($media_id);
	}
}
?>