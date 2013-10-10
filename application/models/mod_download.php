<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_download extends CI_Model{
	// Ambil berita tertentu
	function get($id_media){
		$res = array();
		if(is_numeric($id_media)){
			$sql = "SELECT * FROM dinamic_media WHERE media_id=".$id_media;
			$res = $this->mysql->get_data($sql);
		}
		return $res;
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
		$res = $this->mysql->get_datas($sql);
		return $res;
	}
	
	// Input media
	function insert($media){
		$res = array();
		if($media['media_id']>0){
			$this->mysql->query("UPDATE dinamic_media SET media_title='".$media['title']."' WHERE media_key='".$media['key']."' AND media_id=".$media['media_id']);
			$res = $this->get($media['media_id']);
		}else{
			$maxid = $this->mysql->get_maxid('media_id','dinamic_media');
			$this->mysql->query("INSERT INTO dinamic_media(media_id,media_key,media_link,media_title,media_realname,media_thumbnail,media_userid,media_datetime) VALUES(".$maxid.",'".$media['key']."','".$media['link']."','".$media['title']."','".$media['realname']."','".$media['thumbnail']."','".$media['userid']."',NOW())");
			$res = $this->get($maxid);
		}
		return $res;
	}
	
	// Delete berita
	function delete($key,$id_media){
		$this->mysql->query("DELETE FROM dinamic_media WHERE media_key='".$key."' AND media_id=".$id_media);
	}
}
?>