<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_skin extends CI_Model{
	// Ambil skin tertentu
	function get(){
		$res = 'skins/default/';
		return $res;
	}
	
	// Ambil daftar skin
	function get_all($order='',$request_order='ASC',$limit=0){
		$res = array();
		return $res;
	}
	
	// Input berita
	function insert(){
	}
	
	// Delete berita
	function delete(){
	}
}
?>