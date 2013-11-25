<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_slideshow extends CI_Model{
	// Ambil berita tertentu
	function get($media_id){
		$sql = "SELECT * FROM dinamic_media WHERE media_key='slideshow' AND media_id=".$media_id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	// Ambil daftar gambar
	// order string 'id'|'created'|'viewed'
	// request_order string 'desc'|'asc'
	// limit int
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_media WHERE media_key='slideshow'";
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
	
	// Input gambar
	function insert($media){
		if($media['id']>0){
			$this->mysql->query("UPDATE dinamic_media SET media_title='".$media['title']."', media_description='".$media['description']."', media_status='".$media['status']."', media_updated=NOW() WHERE media_key='slideshow' AND media_id=".$media['id']);
			$data = $this->get($media['id']);
			$data['status'] = 'update';
		}else{
			$maxid = $this->mysql->get_maxid('media_id','dinamic_media');
			$this->mysql->query("INSERT INTO dinamic_media(media_id,media_key,media_title,media_description,media_status,media_userid,media_datetime) VALUES(".$maxid.",'slideshow','".$media['title']."','".$media['description']."','on',".$media['userid'].",NOW())");
			$data = $this->get($maxid);
			$data['status'] = 'insert';
		}
		return $data;
	}
	
	// Delete berita
	function delete($media_id){
		$this->mysql->query("DELETE FROM dinamic_media WHERE media_id=".$media_id);
		return $this->get($media_id);
	}
	
	// ganti gambar
	function change_image($media){
		$this->mysql->query("UPDATE dinamic_media SET media_realname='".$media['realname']."', media_thumbnail='".$media['thumbnail']."' WHERE media_id=".$media['id']);
		return $this->get($media['id']);
	}
}
?>