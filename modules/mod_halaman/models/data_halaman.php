<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_halaman extends CI_Model{
	// Ambil berita statis tertentu
	function get($id_berita){
		$res = array();
		if(is_numeric($id_berita) && $id_berita>0){
			$sql = "SELECT * FROM dinamic_posts WHERE post_static='1' AND post_id=".$id_berita;
			$res = $this->mysql->get_data($sql,'clean');
			$res['post_title'] = htmlspecialchars_decode(@$res['post_title']);
			$res['post_content'] = htmlspecialchars_decode(@$res['post_content']);
		}
		return $res;
	}
	
	// Ambil daftar berita
	// order string 'id'|'created'|'modified'
	// request_order string 'desc'|'asc'
	// limit int
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_posts WHERE post_static='1'";
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY post_id '.$request_order;
		}else if($order=='created'){
			$sql .= ' ORDER BY post_created '.$request_order;
		}else if($order=='modified'){
			$sql .= ' ORDER BY post_updated '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$tmp = $this->mysql->get_datas($sql,'clean');
		$res = array();
		foreach($tmp as $tmp){
			$tmp['post_title'] = htmlspecialchars_decode($tmp['post_title']);
			$tmp['post_content'] = htmlspecialchars_decode($tmp['post_content']);
			array_push($res,$tmp);
		}
		return $res;
	}
	
	// Input berita
	function insert($berita){
		$berita['judul'] = addslashes(htmlspecialchars($berita['judul']));
		$berita['isi'] = addslashes(htmlspecialchars($berita['isi']));
		if($berita['post_id']>0){
			mysql_query("UPDATE dinamic_posts SET post_created='".$berita['start']."', post_updated=NOW(), post_expired='".$berita['stop']."', post_title='".$berita['judul']."', post_content='".$berita['isi']."',post_marquee='".$berita['marquee']."' WHERE post_static='1' AND post_id=".$berita['post_id']);
			
		}else{
			$maxid = $this->mysql->get_maxid('post_id','dinamic_posts');
			mysql_query("INSERT INTO dinamic_posts(post_id,post_userid,post_created,post_expired,post_title,post_content,post_status,post_commentstatus,post_marquee,post_static) VALUES(".$maxid.",1,'".$berita['start']."','".$berita['stop']."','".$berita['judul']."','".$berita['isi']."',1,1,'".$berita['marquee']."','1')");
		}
	}
	
	// Delete berita
	function delete($id_berita){
		mysql_query("DELETE FROM dinamic_posts WHERE post_static='1' AND post_id=".$id_berita);
	}
}
?>