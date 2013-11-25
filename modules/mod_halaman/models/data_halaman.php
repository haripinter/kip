<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_halaman extends CI_Model{
	// Ambil berita statis tertentu
	function get($berita_id){
		$sql = "SELECT * FROM dinamic_posts WHERE post_static='1' AND post_id=".$berita_id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
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
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
	
	// Input berita
	function insert($berita){
		$data = array();
		if($berita['id']>0){
			$rex = $this->check_link($berita['link']);
			if(@$rex['post_id']>0){
				$berita['link'] .= '0';
			}
			
			$this->mysql->query("UPDATE dinamic_posts SET post_updated=NOW(), post_title='".$berita['title']."', post_content='".$berita['content']."', post_staticlink='".$berita['link']."' WHERE post_static='1' AND post_id=".$berita['id']);
			$data = $this->get($berita['id']);
			$data['status'] = 'update';
		}else{
			$maxid = $this->mysql->get_maxid('post_id','dinamic_posts');
			if($berita['link']==''){
				$berita['link'] = $maxid;
			}
			$rex = $this->check_link($berita['link']);
			if(@$rex['post_id']>0){
				$berita['link'] .= '0';
			}
			
			$this->mysql->query("INSERT INTO dinamic_posts(post_id,post_userid,post_created,post_title,post_content,post_status,post_static,post_staticlink) VALUES(".$maxid.",".$berita['userid'].",NOW(),'".$berita['title']."','".$berita['content']."',1,'1','".$berita['link']."')");
			$data = $this->get($maxid);
			$data['status'] = 'insert';
		}
		return $data;
	}
	
	// Delete berita
	function delete($berita_id){
		$this->mysql->query("DELETE FROM dinamic_posts WHERE post_static='1' AND post_id=".$berita_id);
		return $this->get($berita_id);
	}
	
	function check_link($link){
		return $this->mysql->get_data("SELECT post_id FROM dinamic_posts WHERE post_staticlink='".$link."'");
	}
	
	function get_by_link($link){
		$sql = "SELECT * FROM dinamic_posts WHERE post_static='1' AND post_staticlink='".$link."'";
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
}
?>