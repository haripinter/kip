<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_berita extends CI_Model{
	// Ambil berita tertentu untuk admin
	function get($berita_id){
		$sql = "SELECT * FROM dinamic_posts WHERE ISNULL(post_static) AND post_id=".$berita_id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	// Ambil daftar berita untuk admin
	// order string 'id'|'created'|'modified'
	// request_order string 'desc'|'asc'
	// limit int
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_posts WHERE ISNULL(post_static)";
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY post_id '.$request_order;
		}else if($order=='created'){
			$sql .= ' ORDER BY post_start '.$request_order;
		}else if($order=='modified'){
			$sql .= ' ORDER BY post_updated '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
	
	// Ambil berita tertentu untuk frontsite
	function get_berita($berita_id){
		$sql = "SELECT * FROM dinamic_posts WHERE ISNULL(post_static) AND NOW()>=post_start AND NOW()<post_stop AND post_id=".$berita_id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	// Ambil daftar berita untuk frontsite
	// order string 'id'|'created'|'modified'
	// request_order string 'desc'|'asc'
	// limit int
	function get_berita_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_posts WHERE ISNULL(post_static) AND NOW()>=post_start AND NOW()<post_stop ";
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY post_id '.$request_order;
		}else if($order=='created'){
			$sql .= ' ORDER BY post_start '.$request_order;
		}else if($order=='modified'){
			$sql .= ' ORDER BY post_updated '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
	
	// Input berita
	function insert($berita){
		$data = array();
		if($berita['id']>0){
			$this->mysql->query("UPDATE dinamic_posts SET post_updated=NOW(), post_start='".$berita['start']."', post_stop='".$berita['stop']."', post_title='".$berita['title']."', post_content='".$berita['content']."',post_marquee='".$berita['marquee']."' WHERE ISNULL(post_static) AND post_id=".$berita['id']);
			$data = $this->get($berita['id']);
			$data['status'] = 'update';
		}else{
			$maxid = $this->mysql->get_maxid('post_id','dinamic_posts');
			$this->mysql->query("INSERT INTO dinamic_posts(post_id,post_userid,post_created,post_start,post_stop,post_title,post_content,post_status,post_commentstatus,post_marquee) VALUES(".$maxid.",".$berita['userid'].",NOW(),'".$berita['start']."','".$berita['stop']."','".$berita['title']."','".$berita['content']."',1,1,'".$berita['marquee']."')");
			$data = $this->get($maxid);
			$data['status'] = 'insert';
		}
		return $data;
	}
	
	// Delete berita
	function delete($berita_id){
		$this->mysql->query("DELETE FROM dinamic_posts WHERE ISNULL(post_static) AND post_id=".$berita_id);
		return $this->get($berita_id);
	}
	
	function map($id,$limit=3){
		$data = array();
		$current = $this->get($id);
		$before = $this->mysql->get_datas("SELECT * FROM dinamic_posts WHERE post_start<'".$current['post_start']."' AND NOW()>=post_start AND NOW()<post_stop ORDER BY post_start DESC LIMIT ".$limit,'clean');
		$after = $this->mysql->get_datas("SELECT * FROM dinamic_posts WHERE post_start>'".$current['post_start']."' AND NOW()>=post_start AND NOW()<post_stop ORDER BY post_start ASC LIMIT ".$limit,'clean');
		
		foreach($before as $d){
			array_push($data,$d);
		}
		array_push($data,$current);
		foreach($after as $d){
			array_push($data,$d);
		}
		return $data;
	}
	
	function get_marquee(){
		$sql  = "SELECT post_id as id,post_title as title FROM dinamic_posts WHERE post_marquee='on' AND NOW()>=post_start AND NOW()<post_stop AND post_static IS NULL ORDER BY post_created";
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
}
?>