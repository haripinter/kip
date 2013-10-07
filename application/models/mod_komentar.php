<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_komentar extends CI_Model{
	// Ambil komentar tertentu
	function get($comment_id){
		$res = array();
		if(is_numeric($comment_id)){
			$sql = "SELECT * FROM dinamic_comments WHERE comment_id=".$comment_id;
			$res = $this->mysql->get_data($sql);
		}
		return $res;
	}
	
	function get_all(){
		$res = array();
		return $res;
	}
	
	// Input komentar
	function insert($comment_id){
	}
	
	// Delete komentar
	function delete($comment_id){
	}
}
?>