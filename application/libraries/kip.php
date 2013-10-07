<?php
class kip{
	var $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	
	function index(){
	}
	
	function skin($skin,$view=null,$data=null,$mode=null){
		$nview = 'skins/'.$skin.'/'.$view;
		if($skin=='root'){
			$nview = 'admin/'.$view;
		}
		
		/*
		if (is_null($data)){
			$data = array('body' => $body);
		}else if(is_array($data)){
			$data['body'] = $body;
		}else if(is_object($data)){
			$data->body = $body;
		}
		*/
		if(is_null($data)){
			$data = array();
		}
		
		$this->ci->load->view($nview,$data,$mode);
	}
	
	function data(){
		$data['header'] = 'Header Title Banyak';
		$data['footer'] = 'Ini Footer Title Banyak';
		//$data['root_path'] = 'root/';
		
		$data['kop_surat'] = 'Kabupaten KOta Indonesia';
		return $data;
	}
	
	function tgl_datetime($tgl){
		if(strlen($tgl)==10){
			$tmp = explode('/',$tgl);
			if(checkdate($tmp[1],$tmp[0],$tmp[2])){
				$jam = date('H:i:s');
				return $tmp[2].'-'.$tmp[1].'-'.$tmp[0].' '.$jam;
			}else{
				return date('Y-m-d H:i:s');
			}
		}else{
			return date('Y-m-d H:i:s');
		}
	}
	
	function datetime_tgl($datetime){
		if($datetime=='0000-00-00 00:00:00'){
			return '';
		}else if(strlen($datetime)==19){
			$tmp = explode('-',substr($datetime,0,10));
			return $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
		}else{
			return $datetime;
		}
	}
	
	function randkey($length=11) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$key = substr( str_shuffle( $chars ), 0, $length );
		return $key;
	}
}
?>