<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_gambar extends CI_Model{
	// Ambil berita tertentu
	function get($id_gambar){
		$res = array();
		if(is_numeric($id_gambar)){
			$sql = "SELECT * FROM dinamic_media WHERE media_key='gambar' AND media_id=".$id_gambar;
			$res = $this->mysql->get_data($sql);
		}
		return $res;
	}
	
	// Ambil daftar gambar
	// order string 'id'|'created'|'viewed'
	// request_order string 'desc'|'asc'
	// limit int
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_media WHERE media_key='gambar'";
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
	
	// Input gambar
	function insert($gambar){
		if($gambar['media_id']>0){
			//mysql_query("UPDATE dinamic_posts SET post_created='".$berita['start']."', post_updated=NOW(), post_expired='".$berita['stop']."', post_title='".$berita['judul']."', post_content='".$berita['isi']."',post_marquee='".$berita['marquee']."' WHERE post_id=".$berita['post_id']);
			
		}else{
			$maxid = $this->mysql->get_maxid('media_id','dinamic_media');
			//mysql_query("INSERT INTO dinamic_posts(post_id,post_userid,post_created,post_expired,post_title,post_content,post_status,post_commentstatus,post_marquee) VALUES(".$maxid.",1,'".$berita['start']."','".$berita['stop']."','".$berita['judul']."','".$berita['isi']."',1,1,'".$berita['marquee']."')");
		}
	}
	
	// Delete berita
	function delete($id_gambar){
		mysql_query("DELETE FROM dinamic_media WHERE media_id=".$id_gambar);
	}
}
?>